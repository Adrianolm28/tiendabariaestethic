<?php

namespace App\Controllers;

use App\Models\CarritoModel;
use App\Models\CategoriaProductoModel;
use App\Models\ConfiguracionTiendaModel;
use App\Models\SubcategoriaProductoModel;
use App\Models\UsuariosModel;
use \CodeIgniter\Controller;


class Carrito extends BaseController
{
    protected $carritoModel;
    protected $configModel;
    protected $categoriaModel;
    protected $categorias_productos;
    protected $subcategoria_productos;
    protected $usuarioModel;
    public function __construct()
    {
        $this->carritoModel = new CarritoModel();
        $this->configModel = new ConfiguracionTiendaModel();
        $this->categoriaModel = new CategoriaProductoModel();
        $this->categorias_productos = new CategoriaProductoModel();
        $this->subcategoria_productos = new SubcategoriaProductoModel();
        $this->usuarioModel = new UsuariosModel();
    }

    public function index()
    {
        if (session()->has('usuario_autenticado')) {
            $userData = session()->get();
        } else {

            $userData = $this->usuarioModel->find(999);
        }

        $idCliente = null;
        if (session()->has('usuario_autenticado')) {
            $usuarioAutenticado = session()->get('usuario_autenticado');
            $idCliente = $usuarioAutenticado['id'] ?? null;
        }

        $categorias_productos =$this->categorias_productos->findAll();
        $configTienda = $this->configModel->obtenerConfiguracion();
        $categoriasFooter = $this->categoriaModel->findAll();
        $subcategoria_productos =$this->subcategoria_productos->findAll();

        return view('tienda/carrito', [
            'userData' => $userData,
            'configTienda' => $configTienda,
            'categoriasFooter' =>  $categoriasFooter,
            'categorias_productos' => $categorias_productos,
            'subcategoria_productos' => $subcategoria_productos
        ]);
    }
}
