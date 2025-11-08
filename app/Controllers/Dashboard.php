<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ServiciosModel;
use App\Models\TestimoniosModel;
use App\Models\ClienteslogoModel;
use App\Models\CarouselModel;
use App\Models\MostVisitedModel;
use App\Models\ProductoModel;
use App\Models\VisitModel;
use App\Models\ComprasModel;
use App\Models\DetalleCompraModel;
use App\Models\EstadoCompraModel;
use App\Models\MotivosEstadoModel;
use App\Models\ContactoModel; // Asegúrate de importar el modelo de Contacto

class Dashboard extends BaseController
{

  public function Index()
  {
    $UserModel = new UserModel();
    $serviciosModel = new ServiciosModel();
    $testimoniosModel = new TestimoniosModel();
    $clienteslogoModel = new ClienteslogoModel();
    $carouselModel = new CarouselModel();

    // Calcula el stock total de productos activos
    $productoModel = new ProductoModel();
    $row = $productoModel->where('estado', 1)->selectSum('stock')->get()->getRow();
    $totalStock = $row && isset($row->stock) ? (int)$row->stock : 0;

    $mensaje = session('mensaje');

    echo view("admin/admin_header.php");
    echo view('admin/dashboard_view', [
      'mensaje' => $mensaje,
      'totalStock' => $totalStock,
      // ...otros datos si necesitas...
    ]);
    echo view("admin/admin_footer");
  }

  public function mostVisited()
  {
    $visitModel = new VisitModel();
    $data = $visitModel->getMostVisitedPages();
    return $this->response->setJSON($data);
  }

  public function mostVisitedUnique()
  {
    $visitModel = new VisitModel();
    $data = $visitModel->getMostVisitedPagesUnique();
    return $this->response->setJSON($data);
  }

  public function totalStock()
  {
    $productoModel = new ProductoModel();
    // Calcula el stock total de productos activos
    $row = $productoModel->where('estado', 1)->selectSum('stock')->get()->getRow();
    $totalStock = $row && isset($row->stock) ? (int)$row->stock : 0;
    return $this->response->setJSON(['total_stock' => $totalStock]);
  }

  public function stockDetalle()
  {
    echo view("admin/admin_header.php");
    echo view("admin/stock_detalle");
    echo view("admin/admin_footer.php");
  }

  public function stockDetalleAjax()
  {
    $fechaInicio = $this->request->getGet('fechaInicio');
    $fechaFin = $this->request->getGet('fechaFin');
    $productoModel = new \App\Models\ProductoModel();

    $builder = $productoModel->where('estado', 1);

    if ($fechaInicio) {
        $builder->where('updated_at >=', $fechaInicio . ' 00:00:00');
    }
    if ($fechaFin) {
        $builder->where('updated_at <=', $fechaFin . ' 23:59:59');
    }

    $data = $builder->findAll();
    return $this->response->setJSON($data);
  }

  public function visitasDetalle()
  {
    echo view("admin/admin_header.php");
    echo view("admin/visitas_detalle");
    echo view("admin/admin_footer.php");
  }

  public function visitasDetalleAjax()
  {
        $fechaInicio = $this->request->getGet('fechaInicio');
        $fechaFin = $this->request->getGet('fechaFin');

        $db = \Config\Database::connect();
        $builder = $db->table('visits');

        $select = "
            DATE(visited_at) as fecha,
            CASE
                WHEN page_name LIKE 'https://tegnex.pe/shop%' THEN 'https://tegnex.pe/shop'
                WHEN page_name LIKE 'https://tegnex.pe/tienda/verproducto/%' THEN 'https://tegnex.pe/tienda/verproducto/'
                ELSE page_name
            END as page_base,
            COUNT(DISTINCT visitor_id) as visitas_unicas
        ";

        // Solo filtra si el usuario selecciona fechas
        if ($fechaInicio && $fechaFin) {
            $builder->where('visited_at >=', $fechaInicio . ' 00:00:00');
            $builder->where('visited_at <=', $fechaFin . ' 23:59:59');
        }

        $builder->select($select, false)
            ->groupBy('fecha, page_base')
            ->orderBy('fecha', 'DESC'); // Cambia a descendente para que hoy esté primero

        $query = $builder->get();
        return $this->response->setJSON($query->getResultArray());
  }

  public function pedidos()
  {
    $estadoCompraModel = new EstadoCompraModel();
    $motivosModel = new MotivosEstadoModel();
    $data['estados'] = $estadoCompraModel->findAll();
    $data['motivos'] = $motivosModel->findAll();
    echo view("admin/admin_header.php");
    echo view("admin/pedidos", $data);
    echo view("admin/admin_footer.php");
  }

  public function pedidosAjax()
  {
    $comprasModel = new ComprasModel();
    $detalleCompraModel = new DetalleCompraModel();

    $startDate = $this->request->getGet('start_date');
    $endDate = $this->request->getGet('end_date');
    $estado = $this->request->getGet('estado');

    $compras = $comprasModel
      ->select('compras.*, estado_compra.nombre_estado AS nombre_estado')
      ->join('estado_compra', 'estado_compra.id_estado = compras.status_compra', 'left');

    if (!empty($startDate) && !empty($endDate)) {
      $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
      $compras->where('compras.fecha >=', $startDate)
        ->where('compras.fecha <', $endDate);
    }

    // Si no se selecciona estado, solo mostrar aprobados (status_compra = 1)
    if ($estado !== null && $estado !== '') {
      $compras->where('compras.status_compra', $estado);
    } else {
      $compras->where('compras.status_compra', 1);
    }

    // Ordenar por ID descendente
    $compras->orderBy('compras.id', 'DESC');

    $compras = $compras->findAll();
    $data = [];

    foreach ($compras as $compra) {
      $totalCompra = $compra['total'];
      if (isset($compra['costo_envio']) && $compra['costo_envio'] > 0) {
        $totalCompra += $compra['costo_envio'];
      }
      $totalCompra = number_format($totalCompra, 2);

      $detallesCompra = $detalleCompraModel->where('id_compra', $compra['id'])->findAll();
      $detalles = [];
      foreach ($detallesCompra as $detalle) {
        $detalles[] = [
          'nombre' => $detalle['nombre'],
          'precio' => $detalle['precio'],
          'cantidad' => $detalle['cantidad'],
        ];
      }

      $data[] = [
        'id' => $compra['id'],
        'id_transaccion' => $compra['id_transaccion'],
        'status' => $compra['status'],
        'fecha' => $compra['fecha'],
        'email' => $compra['email'],
        'cliente' => $compra['id_cliente'],
        'dni' => $compra['dni'],
        'nombre' => $compra['nombre'],
        'total' => $totalCompra,
        'voucher' => $compra['voucher_img'],
        'detalles' => $detalles,
        'nombre_estado' => $compra['nombre_estado'],
        'id_estado' => $compra['status_compra'],
        'canal_pago' => $compra['canal_pago'],
      ];
    }

    return $this->response->setJSON(['data' => $data]);
  }

  public function totalPedidos()
  {
    $comprasModel = new \App\Models\ComprasModel();
    $total = $comprasModel->where('status_compra', 1)->countAllResults(); // Solo ventas reales
    return $this->response->setJSON(['total_pedidos' => $total]);
  }

  public function ganancias()
  {
    echo view("admin/admin_header.php");
    echo view("admin/ganancias");
    echo view("admin/admin_footer.php");
  }

  public function gananciasAjax()
  {
    $startDate = $this->request->getGet('start_date');
    $endDate = $this->request->getGet('end_date');

    $db = \Config\Database::connect();
    $builder = $db->table('compras');

    $builder->select('id, fecha, total, costo_envio');
    $builder->where('status_compra', 1); // Solo aprobadas

    if (!empty($startDate) && !empty($endDate)) {
      $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
      $builder->where('fecha >=', $startDate)
              ->where('fecha <', $endDate);
    }

    $compras = $builder->orderBy('fecha', 'DESC')->get()->getResultArray();

    $data = [];
    $totalGanancia = 0;

    foreach ($compras as $compra) {
      $ganancia = floatval($compra['total']);
      if (isset($compra['costo_envio']) && $compra['costo_envio'] > 0) {
        $ganancia += floatval($compra['costo_envio']);
      }
      $totalGanancia += $ganancia;
      $data[] = [
        'id' => $compra['id'],
        'fecha' => $compra['fecha'],
        'ganancia' => number_format($ganancia, 2)
      ];
    }

    return $this->response->setJSON([
      'data' => $data,
      'total_ganancia' => number_format($totalGanancia, 2)
    ]);
  }

  public function totalGanancia()
  {
    $comprasModel = new \App\Models\ComprasModel();
    $totalGanancia = $comprasModel->obtenerTotalGanancia();
    return $this->response->setJSON(['total_ganancia' => number_format($totalGanancia, 2)]);
  }

  public function ventasMensuales()
  {
    $comprasModel = new \App\Models\ComprasModel();
    $data = $comprasModel->obtenerVentasMensuales();
    return $this->response->setJSON($data);
  }

  public function ventasSemanales()
  {
    $comprasModel = new \App\Models\ComprasModel();
    $data = $comprasModel->obtenerVentasDiariasSemana();
    return $this->response->setJSON($data);
  }

  public function ventasPorCategoria()
  {
    $comprasModel = new \App\Models\ComprasModel();
    $data = $comprasModel->obtenerVentasPorCategoria();
    return $this->response->setJSON($data);
  }

  public function clientesCompradores()
  {
    echo view("admin/admin_header.php");
    echo view("admin/clientes_compradores");
    echo view("admin/admin_footer.php");
  }

  public function clientesCompradoresAjax()
  {
    $db = \Config\Database::connect();
    $startDate = $this->request->getGet('start_date');
    $endDate = $this->request->getGet('end_date');

    $builder = $db->table('compras');
    $builder->select('id_cliente, nombre, apellido, email, COUNT(*) as total_pedidos, SUM(total + IFNULL(costo_envio,0)) as total_gastado');
    $builder->where('status_compra', 1);

    if (!empty($startDate) && !empty($endDate)) {
      $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
      $builder->where('fecha >=', $startDate)
              ->where('fecha <', $endDate);
    }

    $builder->groupBy('id_cliente, nombre, apellido, email');
    $builder->orderBy('total_gastado', 'DESC');
    $clientes = $builder->get()->getResultArray();
    return $this->response->setJSON($clientes);
  }

  public function contactosAdmin()
  {
    $data['title'] = "Administración de Contactos";
    $data['ruta'] = base_url('/public/'); // Ajusta esto si tu $ruta se define de otra manera

    // Asumiendo que tu estructura de vistas de admin es similar a esto:
    echo view('admin/admin_header', $data); // Carga el header del admin
    echo view('admin/contactos_admin', $data);   // Carga el contenido específico de esta página
    echo view('admin/admin_footer', $data);   // Carga el footer del admin
    
    // Si usas un sistema de layout más integrado, ajusta esto. Por ejemplo:
    // return view('admin/layout', ['content' => view('admin/contactos_admin', $data), 'title' => $data['title']]);
  }

  public function contactosAdminAjax()
  {
    $request = service('request');
    $contactoModel = new ContactoModel();

    $draw = $request->getVar('draw');
    $start = $request->getVar('start');
    $length = $request->getVar('length');
    $searchValue = $request->getVar('search')['value'] ?? '';
    
    $fechaInicio = $request->getVar('fechaInicio');
    $fechaFin = $request->getVar('fechaFin');

    // Construcción de la consulta
    $builder = $contactoModel;

    if (!empty($fechaInicio)) {
        $builder->where('DATE(created_at) >=', $fechaInicio);
    }
    if (!empty($fechaFin)) {
        $builder->where('DATE(created_at) <=', $fechaFin);
    }

    // Búsqueda global (opcional, puedes adaptarla a tus necesidades)
    if (!empty($searchValue)) {
        $builder->groupStart()
            ->like('nombres', $searchValue)
            ->orLike('email', $searchValue)
            ->orLike('numero_documento', $searchValue)
            ->orLike('descripcion', $searchValue)
            ->groupEnd();
    }
    
    $totalRecords = $builder->countAllResults(false); // false para no resetear la query
    
    // Aplicar ordenamiento (DataTables envía esto en $request->getVar('order'))
    $order = $request->getVar('order');
    if ($order) {
        $columnIdx = $order[0]['column'];
        $columnName = $request->getVar('columns')[$columnIdx]['data'];
        $sortDir = $order[0]['dir'];
        $builder->orderBy($columnName, $sortDir);
    } else {
        $builder->orderBy('created_at', 'DESC'); // Orden por defecto
    }

    // Paginación
    if ($length != -1) { // -1 para mostrar todos los registros
        $data = $builder->findAll($length, $start);
    } else {
        $data = $builder->findAll();
    }

    $output = [
        "draw" => intval($draw),
        "recordsTotal" => $contactoModel->countAll(), // Total sin filtros de búsqueda/fecha
        "recordsFiltered" => $totalRecords,
        "data" => $data
    ];

    return $this->response->setJSON($output);
  }

  public function contactosDelete($id = null)
  {
    if (!$this->request->isAJAX() || $this->request->getMethod(true) !== 'POST') {
        return $this->response->setStatusCode(403)->setJSON(['status' => 'error', 'message' => 'Acceso denegado.']);
    }

    $contactoModel = new ContactoModel();
    $contacto = $contactoModel->find($id);

    if ($contacto) {
        if ($contactoModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Contacto eliminado correctamente.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No se pudo eliminar el contacto.']);
        }
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Contacto no encontrado.'])->setStatusCode(404);
    }
  }

  public function clientes()
  {
    // Puedes personalizar la lógica según tus necesidades
    echo view("admin/admin_header.php");
    echo view("admin/clientes");
    echo view("admin/admin_footer.php");
  }

  public function clientesAjax()
  {
    // Implementa aquí la lógica para retornar los datos de clientes en formato JSON para DataTables
    $db = \Config\Database::connect();
    $clientes = $db->table('clientes')->get()->getResultArray();

    // DataTables espera un array con la clave 'data'
    return $this->response->setJSON(['data' => $clientes]);
  }

  public function totalClientesCompradores()
  {
    $db = \Config\Database::connect();
    $builder = $db->table('compras');
    $builder->select('COUNT(DISTINCT id_cliente) as total_clientes');
    $builder->where('status_compra', 1);
    $row = $builder->get()->getRow();
    $total = $row ? $row->total_clientes : 0;
    return $this->response->setJSON(['total_clientes' => $total]);
  }

  public function totalClientes()
  {
    $db = \Config\Database::connect();
    $total = $db->table('clientes')->countAllResults();
    return $this->response->setJSON(['total_clientes' => $total]);
  }

}
