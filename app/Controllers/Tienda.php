<?php

namespace App\Controllers;

use App\Models\AnunciotiendaModel;
use App\Models\BannerTiendaModel;
use App\Models\CategoriaProductoModel;
use App\Models\ComprasModel;
use App\Models\ConfiguracionTiendaModel;
use App\Models\DetalleCompraModel;
use App\Models\ImagenesProductoModel;
use App\Models\MarcasProductosModel;
use App\Models\OfertasDescuentoModel;
use App\Models\OfertasModel;
use App\Models\ProductoModel;
use App\Models\SubcategoriaProductoModel;
use App\Models\UsuariosModel;
use App\Models\BannertiendaresponsiveModel;
use App\Models\MasbuscadoresponsiveModel;
use App\Models\PromocionesresponsiveModel;
use App\Models\CategoriasPcModel;

class Tienda extends BaseController
{
    protected $productoModel;
    protected $categoriaModel;
    protected $marcasModel;
    protected $imagenProductoModel;
    protected $bannerModel;
    protected $configModel;
    protected $detalleCompraModel;
    protected $productosCategoria;
    protected $productosMarca;
    protected $ofertasModel;
    protected $productosVendidosCat;
    protected $productosVendidosMar;
    protected $productosVendidosMod;
    protected $categorias_productos;
    protected $subcategoria_productos;
    protected $orfertasdescuento;
    protected $usuarioModel;
    protected $comprasModel;
    protected $Bannertiendaresponsive;
    protected $Masbuscadoresponsive;
    protected $Promocionesresponsive;
    protected $CategoriasPc;
    protected $Anunciotienda;

    public function __construct()
    {
        // Cargar el modelo de Producto en el constructor
        $this->productoModel = new ProductoModel();
        $this->categoriaModel = new CategoriaProductoModel();
        $this->marcasModel = new MarcasProductosModel();
        $this->imagenProductoModel = new ImagenesProductoModel();
        $this->bannerModel = new BannerTiendaModel();
        $this->configModel = new ConfiguracionTiendaModel();
        $this->detalleCompraModel = new DetalleCompraModel();
        $this->ofertasModel = new OfertasModel();
        $this->productosVendidosCat = new DetalleCompraModel();
        $this->productosVendidosMar = new DetalleCompraModel();
        $this->productosVendidosMod = new DetalleCompraModel();
        $this->categorias_productos = new CategoriaProductoModel();
        $this->subcategoria_productos = new SubcategoriaProductoModel();
        $this->orfertasdescuento = new OfertasDescuentoModel();
        $this->usuarioModel = new UsuariosModel();
        $this->comprasModel = new ComprasModel();
        $this->Bannertiendaresponsive = new BannertiendaresponsiveModel();
        $this->Masbuscadoresponsive = new MasbuscadoresponsiveModel();
        $this->Promocionesresponsive = new PromocionesresponsiveModel();
        $this->CategoriasPc = new CategoriasPcModel();
        $this->Anunciotienda = new AnunciotiendaModel();
    }

    public function index()
    {
        helper('ConfigTiendaHelper');

        if (session()->has('usuario_autenticado')) {
            $userData = session()->get();
        } else {

            $userData = $this->usuarioModel->find(999);
        }


        $Anunciotienda = $this->Anunciotienda->getAnunciosConDetalles();

        $banners = $this->bannerModel->obtenerBanners();
        $configTienda = $this->configModel->obtenerConfiguracion();
        $categoriasFooter = $this->categoriaModel->findAll();
        $productosCategoria = $this->productoModel->productos_categorias();
        $productosMarca = $this->productoModel->productos_marcas();
        $ofertas = $this->ofertasModel->where('estado', 1)->findAll();
        $productosCat = $this->productosVendidosCat->obtenerProductosMasVendidos();
        $productosMar = $this->productosVendidosMar->obtenerProductosMasVendidosPorMarca();
        $productosMod = $this->productosVendidosMod->obtenerProductosMasVendidosPorModelo();
        $categorias_productos = $this->categorias_productos->findAll();
        $subcategoria_productos = $this->subcategoria_productos->findAll();
        $orfertasdescuento = $this->orfertasdescuento->findAll();
        $Bannertiendaresponsive = $this->Bannertiendaresponsive->obtenerBannersTiendaResponsive();
        $Masbuscadoresponsive = $this->Masbuscadoresponsive->obtenerBannersMasbuscadoResponsive();
        $Promocionesresponsive = $this->Promocionesresponsive->obtenerBannersPromocionesResponsive();
        $CategoriasPc = $this->CategoriasPc->obtenerCategoriasPc();

        // Pasar los datos del usuario a la vista
        return view('tienda/index', [
            'userData' => $userData,
            'banners' => $banners,
            'configTienda' => $configTienda,
            'categoriasFooter' =>  $categoriasFooter,
            'productosCategoria' => $productosCategoria,
            'productosMarca' => $productosMarca,
            'ofertas' => $ofertas,
            'productosCat' => $productosCat,
            'productosMar' => $productosMar,
            'productosMod' => $productosMod,
            'categorias_productos' => $categorias_productos,
            'subcategoria_productos' => $subcategoria_productos,
            'orfertasdescuento' => $orfertasdescuento,
            'bannerresponsive' => $Bannertiendaresponsive,
            'masbuscadoresponsive' => $Masbuscadoresponsive,
            'promocionesresponsive' =>  $Promocionesresponsive,
            'CategoriasPc' => $CategoriasPc,
            'anunciotienda' => $Anunciotienda
        ]);
    }



    public function shop()
    {

        if (session()->has('usuario_autenticado')) {
            $userData = session()->get();
        } else {

            $userData = $this->usuarioModel->find(999);
        }

        $configTienda = $this->configModel->obtenerConfiguracion();
        $categoriasFooter = $this->categoriaModel->findAll();
        $categorias = $this->categoriaModel->findAll();
        $marcas = $this->marcasModel->findAll();
        $categorias_productos = $this->categorias_productos->findAll();
        $productosConCategoria = $this->productoModel
            ->select('productos.*, categoria_producto.nombre as nombre_categoria')
            ->join('categoria_producto', 'productos.categoria_producto = categoria_producto.id_categoria')
            ->findAll();

        // Obtener los productos más vendidos
        $detalleCompraModel = new DetalleCompraModel();
        $productosMasVendidos = $detalleCompraModel->obtenerProductosMasVendidos();
        $subcategoria_productos = $this->subcategoria_productos->findAll();
        return view('tienda/shop', [
            'productos' => $productosConCategoria,
            'categorias' => $categorias,
            'marcas' => $marcas,
            'userData' => $userData,
            'configTienda' => $configTienda,
            'categoriasFooter' =>  $categoriasFooter,
            'productosMasVendidos' => $productosMasVendidos,
            'categorias_productos' => $categorias_productos,
            'subcategoria_productos' => $subcategoria_productos,
        ]);
    }




    public function verproducto($id_producto)
    {

        if (session()->has('usuario_autenticado')) {
            $userData = session()->get();
        } else {

            $userData = $this->usuarioModel->find(999);
        }

        $configTienda = $this->configModel->obtenerConfiguracion();
        $producto = $this->productoModel->find($id_producto);
        $categoriasFooter = $this->categoriaModel->findAll();

        if ($producto) {

            $precioConDescuento = '';
            if ($producto['producto_descuento'] > 0) {
                $precioConDescuento = $producto['precio'] - ($producto['precio'] * ($producto['producto_descuento'] / 100));
                $precioConDescuento = number_format($precioConDescuento, 2, '.', '');
            }

            $imagenes = $this->imagenProductoModel->where('id_producto', $id_producto)->findAll();

            $categoria = $this->categoriaModel->find($producto['categoria_producto']);
            $marca = $this->marcasModel->find($producto['marca']);

            // Add null checks
           
            $producto['marca'] = $marca ? $marca['nombre'] : 'Marca no disponible';

            $productosCategoria = $this->productoModel
                ->select('productos.*, categoria_producto.nombre as nombre_categoria, imagenes_producto.nombre_archivo as imagen_principal')
                ->join('categoria_producto', 'productos.categoria_producto = categoria_producto.id_categoria')
                ->join('imagenes_producto', 'productos.id_producto = imagenes_producto.id_producto AND imagenes_producto.orden = 1', 'left')
                ->where('productos.categoria_producto', $producto['categoria_producto'])
                ->where('productos.id_producto !=', $id_producto)
                ->findAll();

            $producto['imagenes'] = $imagenes;

          
            $categorias_productos = $this->categorias_productos->findAll();
            $subcategoria_productos = $this->subcategoria_productos->findAll();
            return view('tienda/verproducto', [
                'producto' => $producto,
                'productosCategoria' => $productosCategoria,
                'userData' => $userData,
                'configTienda' => $configTienda,
                'categoriasFooter' =>  $categoriasFooter,
                'categorias_productos' => $categorias_productos,
                'subcategoria_productos' => $subcategoria_productos
            ]);
        } else {

            return redirect()->to('/error');
        }
    }




    public function obtenerImagenesProducto($id_producto)
    {

        $imagenes = $this->imagenProductoModel->where('id_producto', $id_producto)->findAll();

        return $this->response->setJSON($imagenes);
    }
}
