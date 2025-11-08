<?php

namespace App\Controllers;

use App\Models\CategoriaProductoModel;
use App\Models\ConfiguracionTiendaModel;
use App\Models\LreclamacionesModel;

class Lreclamaciones extends BaseController
{
    protected $categoriaModel;
    protected $configModel;

    public function __construct()
    {

        $this->categoriaModel = new CategoriaProductoModel();
        $this->configModel = new ConfiguracionTiendaModel();
    }

    public function index()
    {
        $configuraciontienda = new ConfiguracionTiendaModel;

        $configtienda = $configuraciontienda->findAll();
        $categoriasFooter = $this->categoriaModel->findAll();
        $configTienda = $this->configModel->obtenerConfiguracion();

        if (session()->has('usuario_autenticado')) {
            $userData = session()->get();
        } else {

            $userData = [];
        }

        $data = [
            'userData' => $userData,
            'configtienda' => $configtienda,
            'categoriasFooter' => $categoriasFooter,
            'configTienda' => $configTienda,
        ];
        return view('tienda/lreclamaciones', $data);
    }

    public function store()
    {
        $data = [
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'tipo_documento' => $this->request->getPost('tipo_documento'),
            'numero_documento' => $this->request->getPost('numero_documento'),
            'correo' => $this->request->getPost('correo'),
            'telefono' => $this->request->getPost('telefono'),
            'departamento' => $this->request->getPost('departamento'),
            'provincia' => $this->request->getPost('provincia'),
            'distrito' => $this->request->getPost('distrito'),
            'direccion' => $this->request->getPost('direccion'),
            'detalle_producto' => $this->request->getPost('d_producto'),
            'numero_pedido' => $this->request->getPost('n_pedido'),
            'detalle_solicitud' => $this->request->getPost('d_solicitud')
        ];

        $reclamacionesModel = new LreclamacionesModel();

        if ($reclamacionesModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Reclamación enviada correctamente']);
        } else {
            // Si ocurrió algún error, devolver una respuesta JSON con el error
            return $this->response->setJSON(['success' => false, 'error' => 'Error al enviar la reclamación']);
        }
    }
}
