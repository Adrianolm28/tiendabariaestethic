<?php


namespace App\Controllers;

use App\Models\CategoriaProductoModel;
use App\Models\ComprasModel;
use App\Models\ConfiguracionTiendaModel;
use App\Models\DetalleCompraModel;
use App\Models\HistorialEstadoCompraModel;
use CodeIgniter\Controller;


helper(['session']);

class Clientecompra extends BaseController
{

    protected $configModel;
    protected $categoriaModel;
    public function __construct()
    {
        
        $this->configModel = new ConfiguracionTiendaModel();
        $this->categoriaModel = new CategoriaProductoModel();
    }


    public function index($idUsuario)
    {
        if (session()->has('usuario_autenticado')) {
            $userData = session()->get();
        } else {

            $userData = [];
        }
        session()->remove('compras_recientes');

        $comprasModel = new ComprasModel();
        $detalleCompraModel = new DetalleCompraModel();
        $historialEstadoCompraModel = new HistorialEstadoCompraModel(); 

        $compras = $comprasModel->getComprasByClienteId($idUsuario);


        $comprasConDetalles = [];


        foreach ($compras as $compra) {

            $detallesCompra = $detalleCompraModel->obtenerDetalleCompraPorId($compra['id']);
            $historialEstados = $historialEstadoCompraModel->where('compra_id', $compra['id'])->findAll();

            $compraConDetalles = $compra;
            $compraConDetalles['detalles'] = $detallesCompra;
            $compraConDetalles['historial_estados'] = $historialEstados;

            $comprasConDetalles[] = $compraConDetalles;
        }

        $configTienda = $this->configModel->obtenerConfiguracion();
        $categoriasFooter = $this->categoriaModel->findAll();

        return view(
            'tienda/clientecompra',
            [
                'idUsuario' => $idUsuario,
                'comprasConDetalles' => $comprasConDetalles,
                'userData' => $userData,
                'configTienda' => $configTienda,
                'categoriasFooter' =>  $categoriasFooter
            ]
        );
    }

    public function obtenerDetallesCompra($idCompra)
    {
        $comprasModel = new ComprasModel();
        $detalleCompraModel = new DetalleCompraModel();

        // Obtener los detalles de la compra según su ID
        $detallesCompra = $detalleCompraModel->obtenerDetalleCompraPorId($idCompra);


        
       
        // Devolver los detalles de la compra como respuesta JSON
        return $this->response->setJSON($detallesCompra);
    }
}
