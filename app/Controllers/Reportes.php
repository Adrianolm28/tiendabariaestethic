<?php


namespace App\Controllers;

use App\Models\ComprasModel;
use App\Models\DetalleCompraModel;
use CodeIgniter\Controller;




class Reportes extends BaseController
{

    public function ventasMensuales()
    {
        $comprasModel = new ComprasModel();
        $ventasMensuales = $comprasModel->obtenerVentasMensualesAprobadas();

        return $this->response->setJSON($ventasMensuales);
    }



    public function productosMasVendidos()
    {
        $detalleCompras = new DetalleCompraModel();
        $productos = $detalleCompras->obtenerProductosMasVendidosTotal();
        // Devuelve los datos en formato JSON
        return $this->response->setJSON($productos);
    }

    public function ventasSemanales()
    {
        $comprasModel = new ComprasModel();
        $ventasSemanales = $comprasModel->obtenerVentasDiariasSemana();

        return $this->response->setJSON($ventasSemanales);
    }


    public function gananciasMensuales()
    {
        $comprasModel = new ComprasModel();
        $gananciasMensuales = $comprasModel->obtenerGananciasMensualesGenerales();

        return $this->response->setJSON($gananciasMensuales);
    }

    // En tu controlador Reportes.php
    public function totalPedidosMesActual()
    {
        $comprasModel = new ComprasModel();
        $totalPedidos = $comprasModel->obtenerTotalPedidosMesActual();

        return $this->response->setJSON(['total_pedidos' => $totalPedidos]);
    }


    public function totalClientesPedidosMesActual()
    {
        $comprasModel = new ComprasModel();
        $totalClientes = $comprasModel->obtenerTotalClientesPedidosMesActual();

        return $this->response->setJSON(['total_clientes' => $totalClientes]);
    }


    public function ventasPorCategoria()
    {
        $comprasModel = new ComprasModel();
        $ventasPorCategoria = $comprasModel->obtenerVentasPorCategoria();

        return $this->response->setJSON($ventasPorCategoria);
    }

    /* public function ordenesRecientes()
    {
        $comprasModel = new ComprasModel();
        $ordenesRecientes = $comprasModel->obtenerOrdenesRecientes();

        return $this->response->setJSON($ordenesRecientes);
    } */

    public function ordenesRecientes()
    {
        $comprasModel = new ComprasModel();

        // Obtén las fechas de los parámetros de la solicitud
        $fechaInicio = $this->request->getGet('fechaInicio') ?: '2024-07-10 00:00:00';
        $fechaFin = $this->request->getGet('fechaFin') ?: '2024-07-12 23:59:59';

        // Si la fecha inicio es igual a la fecha fin, ajusta la fecha fin para incluir todo el día
        if ($fechaInicio === $fechaFin) {
            $fechaFin .= ' 23:59:59';
        }


        $ordenesRecientes = $comprasModel->obtenerOrdenesRecientes($fechaInicio, $fechaFin);

        return $this->response->setJSON($ordenesRecientes);
    }

    // Total de pedidos (todas las compras)
    public function totalPedidos()
    {
        $comprasModel = new ComprasModel();
        $totalPedidos = $comprasModel->obtenerTotalPedidos();
        return $this->response->setJSON(['total_pedidos' => $totalPedidos]);
    }
}
