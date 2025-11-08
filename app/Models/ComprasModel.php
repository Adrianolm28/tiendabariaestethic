<?php

namespace App\Models;

use CodeIgniter\Model;

class ComprasModel extends Model
{


    protected $table = 'compras';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_transaccion', 'fecha', 'status', 'email', 'id_cliente', 'total',
        'dni', 'nombre', 'apellido', 'telefono', 'departamento',
        'provincia', 'distrito', 'direccion', 'numero', 'tipo_entrega', 'voucher_img', 'status_compra', 'descuento', 'ubicacion_recojo', 'fecha_recojo', 'hora_recojo', 'estado_recojo', 'nombre_recojo', 'costo_envio', 'canal_pago'
    ];

    public function insertarCompra($datosCompra)
    {
        $this->insert($datosCompra);
        return $this->insertID();
    }

    public function obtenerCompraPorId($idCompra)
    {
        return $this->find($idCompra);
    }

    public function getComprasByClienteId($clienteId)
    {
        return $this->where('id_cliente', $clienteId)->findAll();
    }
    public function getComprasId($idCompra)
    {
        return $this->where('id', $idCompra)->findAll();
    }

    public function filtrarCompras(?string $estado = null, ?string $fecha_inicio = null, ?string $fecha_fin = null): array
    {
        $this->select('compras.*, estado_compra.nombre_estado AS status_compra');
        $this->join('estado_compra', 'estado_compra.id_estado = compras.status_compra', 'left');

        if ($estado !== null) {
            $this->where('status_compra', $estado);
        }

        if ($fecha_inicio !== null && $fecha_fin !== null) {
            $this->where('fecha >=', $fecha_inicio)
                ->where('fecha <=', $fecha_fin);
        }

        return $this->findAll();
    }


    public function obtenerVentasMensualesAprobadas()
    {
        $ventasMensuales = $this->select('MONTH(fecha) as mes, SUM(total) as total_mensual')
            ->where('status_compra', 1) // Filtrar por ventas aprobadas
            ->groupBy('mes')
            ->orderBy('mes', 'ASC')
            ->findAll();

        return $ventasMensuales;
    }

    public function obtenerVentasDiariasSemana()
    {
        $builder = $this->db->table($this->table);
        $builder->select('DATE(fecha) as dia, SUM(total + IFNULL(costo_envio,0)) as total_diario');
        $builder->where('YEARWEEK(fecha, 1) = YEARWEEK(CURDATE(), 1)');
        $builder->groupBy('dia');
        $builder->orderBy('dia', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function obtenerGananciasMensualesGenerales()
    {
        $query = $this->db->query("
            SELECT
                YEAR(c.fecha) AS anio,
                MONTH(c.fecha) AS mes,
                SUM(dc.cantidad * (p.precio - p.costo_producto)) AS ganancia_total
            FROM detalle_compra dc
            JOIN productos p ON dc.id_producto = p.id_producto
            JOIN compras c ON dc.id_compra = c.id
            WHERE c.status_compra = 1
            GROUP BY YEAR(c.fecha), MONTH(c.fecha)
            ORDER BY anio DESC, mes DESC
        ");

        return $query->getResult();
    }

    // En tu modelo de pedidos (por ejemplo, ComprasModel.php)
    public function obtenerTotalPedidosMesActual()
    {
        $fechaInicioMes = date('Y-m-01 00:00:00'); // Primer día del mes actual
        $fechaFinMes = date('Y-m-t 23:59:59');   // Último día del mes actual

        $query = $this->db->query("
            SELECT COUNT(*) as total_pedidos
            FROM compras
            WHERE status_compra = 1
            AND fecha BETWEEN '$fechaInicioMes' AND '$fechaFinMes'
        ");

        return $query->getRow()->total_pedidos;
    }

    public function obtenerTotalClientesPedidosMesActual()
    {
        $fechaInicioMes = date('Y-m-01 00:00:00'); // Primer día del mes actual
        $fechaFinMes = date('Y-m-t 23:59:59');   // Último día del mes actual

        $query = $this->db->query("
            SELECT COUNT(DISTINCT id_cliente) as total_clientes
            FROM compras
            WHERE status_compra = 1
            AND fecha BETWEEN '$fechaInicioMes' AND '$fechaFinMes'
        ");

        return $query->getRow()->total_clientes;
    }

    public function obtenerVentasPorCategoria()
    {
        $builder = $this->db->table('detalle_compra dc');
        $builder->select('
            p.categoria_producto AS categoria,
            cp.nombre AS nombre_categoria,
            SUM(dc.cantidad) AS cantidad_ventas,
            SUM(dc.cantidad * (p.precio - p.costo_producto)) AS total_ventas
        ');
        $builder->join('productos p', 'dc.id_producto = p.id_producto');
        $builder->join('compras c', 'dc.id_compra = c.id');
        $builder->join('(SELECT id_categoria, nombre FROM categoria_producto) cp', 'p.categoria_producto = cp.id_categoria');
        $builder->where('c.status_compra', 1);
        $builder->groupBy('p.categoria_producto, cp.nombre');
        $builder->orderBy('total_ventas', 'DESC');
        // $builder->limit(4); // Elimina el límite para mostrar todas las categorías

        $query = $builder->get();
        $result = $query->getResultArray();
        return $result;
    }

    public function obtenerOrdenesRecientes($fechaInicio, $fechaFin)
    {
        $builder = $this->db->table('productos p');
        $builder->select('
        p.id_producto,
        p.nombre,
        p.precio,
        p.stock,
        COALESCE(SUM(dc.cantidad), 0) AS veces_vendido,
        COALESCE(SUM(dc.cantidad * dc.precio), 0) AS total_ventas,
        (SELECT ip.nombre_archivo 
         FROM imagenes_producto ip 
         WHERE ip.id_producto = p.id_producto 
         AND ip.orden = 1 
         LIMIT 1) AS imagen_producto
    ');
        $builder->join('detalle_compra dc', 'dc.id_producto = p.id_producto', 'left');
        $builder->join('compras c', 'c.id = dc.id_compra AND c.status_compra = 1', 'left');

        // Filtrar por el rango de fechas
        $builder->where('c.fecha >=', $fechaInicio);
        $builder->where('c.fecha <=', $fechaFin);

        $builder->groupBy('p.id_producto');
        $builder->orderBy('veces_vendido', 'desc'); // Ordenar por cantidad vendida

        $query = $builder->get();
        return $query->getResultArray();
    }

    public function obtenerComprasRecientes($limite = 10)
    {
        return $this->orderBy('fecha', 'DESC')
            ->limit($limite)
            ->findAll();
    }

    public function obtenerTotalGanancia()
    {
        $builder = $this->db->table($this->table);
        $builder->select('SUM(total + IFNULL(costo_envio,0)) as total_ganancia');
        $builder->where('status_compra', 1); // Solo ventas reales
        $result = $builder->get()->getRow();
        return $result ? $result->total_ganancia : 0;
    }

    public function obtenerTotalGananciaReal()
    {
        $query = $this->db->query("
            SELECT SUM(dc.cantidad * (p.precio - p.costo_producto)) AS ganancia_total
            FROM detalle_compra dc
            JOIN productos p ON dc.id_producto = p.id_producto
            JOIN compras c ON dc.id_compra = c.id
            WHERE c.status_compra = 1
        ");
        $row = $query->getRow();
        return $row ? $row->ganancia_total : 0;
    }

    public function obtenerVentasMensuales()
    {
        $builder = $this->db->table($this->table);
        $builder->select('MONTH(fecha) as mes, SUM(total + IFNULL(costo_envio,0)) as total_mensual');
        $builder->where('status_compra', 1); // Solo ventas aprobadas
        $builder->groupBy('mes');
        $builder->orderBy('mes', 'ASC');
        return $builder->get()->getResultArray();
    }
}
