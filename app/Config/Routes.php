<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
// Ruta para mostrar el formulario de contacto
$routes->get('/contacto', 'ContactoController::index');

// Ruta para procesar el envío del formulario de contacto
$routes->post('/enviar-correo', 'ContactoController::enviarCorreo');
$routes->get('blog', 'Home::blog');
$routes->get('equipo', 'Home::equipo');
$routes->get('blog_detalle', 'Home::blog_detalle');
$routes->get('/tienda', 'Tienda::index');
$routes->get('/lreclamaciones', 'Lreclamaciones::index');
$routes->get('/shop', 'Tienda::shop');
$routes->get('/tienda/verproducto/(:num)', 'Tienda::verproducto/$1');
$routes->get('/tienda/payment_form', 'PaymentController::index');



$routes->post('payment/getToken', 'PaymentController::getToken');
$routes->post('payment/process', 'PaymentController::process');

$routes->post('payment/handlePaymentResponse', 'PaymentController::handlePaymentResponse');

// app/Config/Routes.php

$routes->post('payment/ipn', 'PaymentController::handleIPN');

$routes->post('payment/handleIPN', 'PaymentController::handleIPN');

$routes->get('tienda/contarCompras/(:num)', 'Tienda::contarCompras/$1');



/* reporetes */
$routes->get('reportes/ventasMensuales', 'Reportes::ventasMensuales');
$routes->get('reportes/productosMasVendidos', 'Reportes::productosMasVendidos');
$routes->get('reportes/ventasSemanales', 'Reportes::ventasSemanales');
$routes->get('reportes/gananciasMensuales', 'Reportes::gananciasMensuales');
$routes->get('reportes/totalPedidosMesActual', 'Reportes::totalPedidosMesActual');
$routes->get('reportes/totalClientesPedidosMesActual', 'Reportes::totalClientesPedidosMesActual');
$routes->get('reportes/ventasPorCategoria', 'Reportes::ventasPorCategoria');
$routes->get('reportes/ordenesRecientes', 'Reportes::ordenesRecientes');
$routes->get('reportes/mostVisited', 'Dashboard::mostVisited');
$routes->get('reportes/visitasPorFecha', 'Reportes::visitasPorFecha');
$routes->get('reportes/totalVisitasPorFecha', 'Reportes::totalVisitasPorFecha');

// Ruta para registrar visitantes
$routes->get('register-visitor', 'VisitorController::registerVisitor');

/* rutas penel admin */

// Elimina TODAS las rutas que empiezan con /admin fuera del grupo protegido
/* $routes->get('/admin/banner', 'Banner::banner');
$routes->get('/admin/productos', 'Productos::index');
$routes->get('/admin/bannertienda', 'Bannertienda::index');
$routes->get('/admin/bannertiendaresponsive', 'Bannertiendaresponsive::index');
$routes->get('/admin/promocionesresponsive', 'Promocionesresponsive::index');
$routes->get('/admin/masbuscadoresponsive', 'Masbuscadoresponsive::index');
$routes->get('/admin/ofertas', 'Ofertas::index');
$routes->get('/admin/categoriaproductos', 'Categoriaproductos::index');
$routes->get('/admin/subcategorias', 'Subcategorias::index');
$routes->get('/admin/marcasproductos', 'Marcasproductos::index');
$routes->get('/admin/configuraciontienda', 'Configuraciontienda::index');
$routes->get('/admin/servicios', 'Servicios::servicios');
$routes->get('/admin/clientes_logo', 'ClientesLogo::clienteslogo');
$routes->get('/admin/testimonios', 'Testimonios::testimonios');
$routes->get('/admin/nosotros', 'Nosotros::nosotros');
$routes->get('/admin/empresa', 'Empresa::empresa');
$routes->get('/admin/respaldo', 'Respaldo::respaldo');
$routes->get('/admin/carousel', 'Carousel::carousel');
$routes->get('/admin/soporte', 'Soporte::soporte');
$routes->get('/admin/planes', 'Planes::planes');
$routes->get('/admin/informacion', 'Informacion::informacion');
$routes->get('/admin/categorias', 'Categorias::categorias');
$routes->get('/admin/posts', 'Posts::posts');
$routes->get('/admin/compras', 'Compras::index');
$routes->get('/admin/cotizacion', 'Cotizacion::index');
$routes->get('/admin/clientes', 'Clientes::index');
$routes->get('/admin/usuarios', 'Usuarios::index');
$routes->get('/admin/ofertasdescuento', 'Ofertasdescuento::index');
$routes->get('/admin/anunciotienda', 'Anunciotienda::index');
$routes->get('/admin/categoriaspc', 'Categoriaspc::index'); */

//$routes->add('enviar-email', 'Home::sendEmail');
//$routes->get('enviar-correo', 'Home::enviarCorreo');
//$routes->get('enviar-correo', 'Home::enviarCorreo');
//$routes->post('enviar-correo', 'Home::enviarCorreo');
//Login
$routes->get('/sesion', 'Login::index');
$routes->post('sesion/login/process', 'Login::process');
//CRUD rutas
$routes->post('admin/banner/store', 'Banner::store');
$routes->post('admin/bannertienda/store', 'Bannertienda::store');
$routes->get('admin/banner/edit/(:num)', 'Banner::edit/$1');
$routes->get('admin/bannertienda/edit/(:num)', 'Bannertienda::edit/$1');
$routes->post('admin/bannertienda/actualizar_estado/(:num)/(:num)', 'Bannertienda::actualizar_estado/$1/$2');
$routes->delete('admin/bannertienda/eliminar/(:num)', 'Bannertienda::eliminar/$1');


//CRUD servicios
$routes->post('admin/servicios/store', 'Servicios::store');
$routes->get('admin/servicios/edit/(:num)', 'Servicios::edit/$1');
$routes->post('admin/servicios/actualizar_estado/(:num)/(:num)', 'Servicios::actualizar_estado/$1/$2');


//CRUD usuarios
$routes->post('admin/usuarios/store', 'Usuarios::store');
$routes->get('admin/usuarios/edit/(:num)', 'Usuarios::edit/$1');

//CRUD clientes_logo
$routes->post('admin/clienteslogo/store', 'ClientesLogo::store');
$routes->get('admin/clienteslogo/edit/(:num)', 'ClientesLogo::edit/$1');
$routes->post('admin/clienteslogo/actualizar_estado/(:num)/(:num)', 'ClientesLogo::actualizar_estado/$1/$2');

//CRUD Testimonios
$routes->post('admin/testimonios/store', 'Testimonios::store');
$routes->get('admin/testimonios/edit/(:num)', 'Testimonios::edit/$1');
$routes->post('admin/testimonios/actualizar_estado/(:num)/(:num)', 'Testimonios::actualizar_estado/$1/$2');


//CRUD Respaldo
$routes->post('admin/respaldo/store', 'Respaldo::store');
$routes->get('admin/respaldo/edit/(:num)', 'Respaldo::edit/$1');
$routes->post('admin/respaldo/actualizar_estado/(:num)/(:num)', 'Respaldo::actualizar_estado/$1/$2');


//ofertas_descuento
$routes->post('admin/ofertasdescuento/store', 'Ofertasdescuento::store');
$routes->get('admin/ofertasdescuento/edit/(:num)', 'Ofertasdescuento::edit/$1');
$routes->post('admin/ofertasdescuento/actualizar_estado/(:num)/(:num)', 'Ofertasdescuento::actualizar_estado/$1/$2');
$routes->post('admin/ofertasdescuento/eliminar', 'Ofertasdescuento::eliminar_registro');


//Empresa
$routes->post('admin/empresa/store', 'Empresa::store');

//Soporte
$routes->post('admin/soporte/store', 'Soporte::store');

//carousel
$routes->post('admin/carousel/store', 'Carousel::store');
$routes->get('admin/carousel/edit/(:num)', 'Carousel::edit/$1');
$routes->post('admin/carousel/actualizar_estado/(:num)/(:num)', 'Carousel::actualizar_estado/$1/$2');
$routes->post('admin/carousel/delete/(:num)', 'Carousel::delete/$1'); // Nueva ruta para eliminar

//Planes
$routes->post('admin/planes/guardarDatos', 'Planes::guardarDatos');
$routes->post('admin/planes/eliminarDato', 'Planes::eliminarDato');

//informacion
$routes->post('admin/informacion/store', 'Informacion::store');

$routes->post('admin/configuraciontienda/store', 'Configuraciontienda::store');
/* $routes->post('admin/planes/eliminarElemento', 'Planes::eliminarElemento'); */

$routes->post('admin/lreclamaciones/store', 'Lreclamaciones::store');

//categorias
$routes->post('admin/categorias/store', 'Categorias::store');
$routes->get('admin/categorias/edit/(:num)', 'Categorias::edit/$1');
$routes->post('admin/categorias/actualizar_estado/(:num)/(:num)', 'Categorias::actualizar_estado/$1/$2');

//posts
$routes->post('admin/posts/store', 'Posts::posts');


//tienda
$routes->post('productos/getProductos', 'Productos::getProductos');
$routes->post('productos/getProductosAdmin', 'Productos::getProductosAdmin');
$routes->post('productos/filtrarPorSubcategoria', 'Productos::filtrarPorSubcategoria');
$routes->post('productos/getProductosConDescuento', 'Productos::getProductosConDescuento');

//admin productos
$routes->post('productos/obtenerSubcategorias', 'Productos::obtenerSubcategorias');

$routes->post('marcasproductos/getMarcas', 'Marcasproductos::getMarcas');
$routes->post('categoriaproductos/getCategoriaproductos', 'Categoriaproductos::getCategoriaproductos');
$routes->post('admin/subcategoria/store', 'Subcategorias::store');
$routes->get('admin/subcategorias/edit/(:num)', 'Subcategorias::edit/$1');
$routes->post('admin/subcategorias/actualizar_estado/(:num)/(:num)', 'Subcategorias::actualizar_estado/$1/$2');

$routes->post('subcategorias/getSubcategorias', 'Subcategorias::getSubcategorias');


$routes->post('productos/filtrarPorCategorias', 'Productos::filtrarPorCategorias');
$routes->post('productos/filtrarPorMarca', 'Productos::filtrarPorMarca');
$routes->post('productos/filtrarPorPrecio', 'Productos::filtrarPorPrecio');


$routes->get('tienda/obtenerImagenesProducto/(:num)', 'Tienda::obtenerImagenesProducto/$1');

//compra detalles
$routes->get('compras/lista_ajax', 'Compras::lista_ajax');
$routes->get('compras/detalle_compra/(:num)', 'Compras::detalle_compra/$1');

$routes->get('cotizacion/detalle_cotizacion/(:num)', 'Cotizacion::detalle_cotizacion/$1');

$routes->get('compras/test-filtrar-compras', 'Compras::detalle_compra');

$routes->get('cotizacion/listarCotizaciones', 'Cotizacion::listarCotizaciones');

$routes->post('admin/productos/store', 'Productos::store');
$routes->get('admin/productos/edit/(:num)', 'Productos::edit/$1');
$routes->post('admin/productos/eliminarImagen', 'Productos::eliminarImagen');
$routes->post('admin/productos/actualizar_estado/(:num)/(:num)', 'Productos::actualizar_estado/$1/$2');
$routes->post('admin/productos/eliminar/(:num)', 'Productos::eliminar/$1');
$routes->post('admin/productos/eliminarPdf', 'Productos::eliminarPdf');
$routes->post('admin/categoriaproductos/store', 'Categoriaproductos::store');
$routes->get('admin/categoriaproductos/edit/(:num)', 'Categoriaproductos::edit/$1');
$routes->post('admin/categoriaproductos/actualizar_estado/(:num)/(:num)', 'Categoriaproductos::actualizar_estado/$1/$2');

$routes->post('admin/marcasproductos/store', 'Marcasproductos::store');
$routes->get('admin/marcasproductos/edit/(:num)', 'Marcasproductos::edit/$1');
$routes->post('admin/marcasproductos/actualizar_estado/(:num)/(:num)', 'Marcasproductos::actualizar_estado/$1/$2');


$routes->post('usuarios/registro', 'Usuarios::registro');
$routes->get('usuarios/cerrarSesion', 'Usuarios::cerrarSesion');
$routes->post('usuarios/iniciarSesion', 'Usuarios::iniciarSesion');
$routes->post('usuarios/recuperarClave', 'Usuarios::recuperarClave');


$routes->get('productos/obtenerCategorias', 'Productos::obtenerCategorias');

$routes->get('tienda/carrito', 'Carrito::index');

//checkout
$routes->get('tienda/checkout', 'Checkout::index');



// En el archivo app/Config/Routes.php

$routes->get('checkout/getDNI_New', 'Checkout::getDNI_New');

$routes->post('checkout/getDatosFromAPI_Sunac_new', 'Checkout::getDatosFromAPI_Sunac_new');

//ubigeos
$routes->get('checkout/cargarUbigeoData', 'Checkout::cargarUbigeoData');

$routes->get('checkout/obtenerProvincias/(:num)', 'Checkout::obtenerProvincias/$1');
$routes->get('checkout/obtenerDistritos/(:num)', 'Checkout::obtenerDistritos/$1');



$routes->get('checkout/ingresarDatos', 'Checkout::ingresarDatos');
$routes->post('checkout/procesarCarrito', 'Checkout::procesarCarrito');


$routes->get('checkout/formulario', 'Checkout::formulario');
$routes->post('checkout/procesarPago', 'Checkout::procesarPago');

$routes->post('IzipayController/realizarPago', 'IzipayController::realizarPago');

$routes->get('checkout/compraexitosa', 'Checkout::compraexitosa');


$routes->get('checkout/confirmation', 'Checkout::confirmation');
$routes->get('checkout/cotizacionexitosa', 'Checkout::cotizacionexitosa');

// En tu archivo app/Config/Routes.php

$routes->get('tienda/clientecompra/(:num)', 'Clientecompra::index/$1');
$routes->get('clientecompra/obtenerDetallesCompra/(:num)', 'Clientecompra::obtenerDetallesCompra/$1');


$routes->post('compras/cambiar_estado', 'Compras::cambiar_estado');


$routes->post('checkout/guardarCompra', 'Checkout::guardarCompra');
$routes->post('checkout/guardarCotizacion', 'Checkout::guardarCotizacion');


$routes->post('checkout/enviarCotizacionAPI', 'Checkout::enviarCotizacionAPI');





//api
/* $routes->get('productos/cargar-api', 'Productos::cargarProductosApi'); */
$routes->post('admin/productos/cargarProductosApi', 'Productos::cargarProductosApi');
$routes->post('productos/guardarProductosSeleccionados', 'Productos::guardarProductosSeleccionados');

$routes->post('productos/buscarProductosPorTexto', 'Productos::buscarProductosPorTexto');

$routes->get('productos/obtenerProductosPorCategoria', 'Productos::obtenerProductosPorCategoria');
$routes->get('productos/obtenerProductosPorMarca', 'Productos::obtenerProductosPorMarca');

//cupon

$routes->post('cupon/validarCupon', 'Cupon::validarCupon');
$routes->get('cupon/obtenerDescuento', 'Cupon::obtenerDescuento');
$routes->get('cupon/eliminarDescuento', 'Cupon::eliminarDescuento');

//review

$routes->post('review/agregarReview', 'Review::agregarReview');

$routes->get('cupones', 'Cupon::index');

//PDF
$routes->get('checkout/generarPDF', 'Checkout::generarPDF');



$routes->post('productos/ordenar_imagenproducto', 'Productos::ordenar_imagenproducto');

//reviews obtener
$routes->get('review/mostrarReviews/(:num)', 'Review::mostrarReviews/$1');


$routes->post('compras/actualizar_estado', 'Compras::actualizar_estado');
$routes->post('compras/obtener_estado', 'Compras::obtener_estado');
$routes->post('compras/obtenermotivoestado', 'Compras::obtenermotivoestado');

$routes->post('historialcompra/obtenerSeguimiento', 'Historialcompra::obtenerSeguimiento');

$routes->post('clientecompra/obtenerSeguimiento', 'Historialcompra::obtenerSeguimiento');

/* cron */
$routes->get('ofertasdescuento/desactivarOfertasVencidas', 'Ofertasdescuento::desactivarOfertasVencidas');


/* Ofertas */
$routes->post('admin/ofertas/store', 'Ofertas::store');
$routes->get('admin/ofertas/edit/(:num)', 'Ofertas::edit/$1');
$routes->get('admin/ofertas/actualizar_estado/(:num)/(:num)', 'Ofertas::actualizar_estado/$1/$2');
$routes->delete('admin/ofertas/eliminar/(:num)', 'Ofertas::eliminar/$1');




/* slider principal celular */

$routes->post('admin/bannertiendaresponsive/store', 'Bannertiendaresponsive::store');
$routes->get('admin/bannertiendaresponsive/edit/(:num)', 'Bannertiendaresponsive::edit/$1');
$routes->post('admin/bannertiendaresponsive/actualizar_estado/(:num)/(:num)', 'Bannertiendaresponsive::actualizar_estado/$1/$2');
$routes->delete('admin/bannertiendaresponsive/eliminar/(:num)', 'Bannertiendaresponsive::eliminar_registro/$1');


/* promociones celular */ 
$routes->post('admin/promocionesresponsive/store', 'Promocionesresponsive::store');
$routes->get('admin/promocionesresponsive/edit/(:num)', 'Promocionesresponsive::edit/$1');
$routes->post('admin/promocionesresponsive/actualizar_estado/(:num)/(:num)', 'Promocionesresponsive::actualizar_estado/$1/$2');
$routes->delete('admin/promocionesresponsive/eliminar/(:num)', 'Promocionesresponsive::eliminar_registro/$1');


/* mas buscados celular */
$routes->post('admin/masbuscadoresponsive/store', 'Masbuscadoresponsive::store');
$routes->get('admin/masbuscadoresponsive/edit/(:num)', 'Masbuscadoresponsive::edit/$1');
$routes->post('admin/masbuscadoresponsive/actualizar_estado/(:num)/(:num)', 'Masbuscadoresponsive::actualizar_estado/$1/$2');
$routes->delete('admin/masbuscadoresponsive/eliminar/(:num)', 'Masbuscadoresponsive::eliminar_registro/$1');


/* anunciotienda */ 
/* $routes->post('admin/anunciotienda/store', 'anunciotienda::store');
$routes->get('admin/anunciotienda/edit/(:num)', 'anunciotienda::edit/$1');
$routes->post('admin/anunciotienda/actualizar_estado/(:num)/(:num)', 'Anunciotienda::actualizar_estado/$1/$2');
$routes->delete('admin/anunciotienda/eliminar/(:num)', 'anunciotienda::eliminar_registro/$1'); */

/* categorias pc */ 
$routes->post('admin/categoriaspc/store', 'Categoriaspc::store');
$routes->get('admin/categoriaspc/edit/(:num)', 'Categoriaspc::edit/$1');
$routes->post('admin/categoriaspc/update', 'Categoriaspc::update');
$routes->post('admin/categoriaspc/actualizar_estado/(:num)/(:num)', 'Categoriaspc::actualizar_estado/$1/$2');
$routes->delete('admin/categoriaspc/eliminar_registro/(:num)', 'Categoriaspc::eliminar_registro/$1');
$routes->post('admin/categoriaspc/update', 'Categoriaspc::update');



//anunciotienda

$routes->post('admin/anunciotienda/store', 'Anunciotienda::store');
$routes->get('admin/anunciotienda/edit/(:num)', 'Anunciotienda::edit/$1');
$routes->post('admin/anunciotienda/actualizar_estado/(:num)/(:num)', 'Anunciotienda::actualizar_estado/$1/$2');



$routes->get('/sesion', 'Login::index');
$routes->post('sesion/login/process', 'Login::process');
$routes->post('sesion/login/logout', 'Login::logout');

// Solo debe existir el grupo protegido:
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('banner', 'Banner::banner');
    $routes->get('productos', 'Productos::index');
    $routes->get('bannertienda', 'Bannertienda::index');
    $routes->get('bannertiendaresponsive', 'Bannertiendaresponsive::index');
    $routes->get('promocionesresponsive', 'Promocionesresponsive::index');
    $routes->get('masbuscadoresponsive', 'Masbuscadoresponsive::index');
    $routes->get('ofertas', 'Ofertas::index');
    $routes->get('categoriaproductos', 'Categoriaproductos::index');
    $routes->get('subcategorias', 'Subcategorias::index');
    $routes->get('marcasproductos', 'Marcasproductos::index');
    $routes->get('configuraciontienda', 'Configuraciontienda::index');
    $routes->get('servicios', 'Servicios::servicios');
    $routes->get('clientes_logo', 'ClientesLogo::clienteslogo');
    $routes->get('testimonios', 'Testimonios::testimonios');
    $routes->get('nosotros', 'Nosotros::nosotros');
    $routes->get('empresa', 'Empresa::empresa');
    $routes->get('respaldo', 'Respaldo::respaldo');
    $routes->get('carousel', 'Carousel::carousel');
    $routes->get('soporte', 'Soporte::soporte');
    $routes->get('planes', 'Planes::planes');
    $routes->get('informacion', 'Informacion::informacion');
    $routes->get('categorias', 'Categorias::categorias');
    $routes->get('posts', 'Posts::posts');
    $routes->get('compras', 'Compras::index');
    $routes->get('cotizacion', 'Cotizacion::index');
    $routes->get('clientes', 'Clientes::index');
    $routes->get('usuarios', 'Usuarios::index');
    $routes->get('ofertasdescuento', 'Ofertasdescuento::index');
    $routes->get('anunciotienda', 'Anunciotienda::index');
    $routes->get('categoriaspc', 'Categoriaspc::index');
    // CRUD y POST/DELETE admin
    $routes->post('banner/store', 'Banner::store');
    $routes->post('bannertienda/store', 'Bannertienda::store');
    $routes->get('banner/edit/(:num)', 'Banner::edit/$1');
    $routes->get('bannertienda/edit/(:num)', 'Bannertienda::edit/$1');
    $routes->post('bannertienda/actualizar_estado/(:num)/(:num)', 'Bannertienda::actualizar_estado/$1/$2');
    $routes->delete('bannertienda/eliminar/(:num)', 'Bannertienda::eliminar_registro/$1');
    $routes->post('servicios/store', 'Servicios::store');
    $routes->get('servicios/edit/(:num)', 'Servicios::edit/$1');
    $routes->post('servicios/actualizar_estado/(:num)/(:num)', 'Servicios::actualizar_estado/$1/$2');
    $routes->post('usuarios/store', 'Usuarios::store');
    $routes->get('usuarios/edit/(:num)', 'Usuarios::edit/$1');
    $routes->post('clienteslogo/store', 'ClientesLogo::store');
    $routes->get('clienteslogo/edit/(:num)', 'ClientesLogo::edit/$1');
    $routes->post('clienteslogo/actualizar_estado/(:num)/(:num)', 'ClientesLogo::actualizar_estado/$1/$2');
    $routes->post('testimonios/store', 'Testimonios::store');
    $routes->get('testimonios/edit/(:num)', 'Testimonios::edit/$1');
    $routes->post('testimonios/actualizar_estado/(:num)/(:num)', 'Testimonios::actualizar_estado/$1/$2');
    $routes->post('respaldo/store', 'Respaldo::store');
    $routes->get('respaldo/edit/(:num)', 'Respaldo::edit/$1');
    $routes->post('respaldo/actualizar_estado/(:num)/(:num)', 'Respaldo::actualizar_estado/$1/$2');
    $routes->post('ofertasdescuento/store', 'Ofertasdescuento::store');
    $routes->get('ofertasdescuento/edit/(:num)', 'Ofertasdescuento::edit/$1');
    $routes->post('ofertasdescuento/actualizar_estado/(:num)/(:num)', 'Ofertasdescuento::actualizar_estado/$1/$2');
    $routes->post('ofertasdescuento/eliminar', 'Ofertasdescuento::eliminar_registro');
    $routes->post('empresa/store', 'Empresa::store');
    $routes->post('soporte/store', 'Soporte::store');
    $routes->post('carousel/store', 'Carousel::store');
    $routes->get('carousel/edit/(:num)', 'Carousel::edit/$1');
    $routes->post('carousel/actualizar_estado/(:num)/(:num)', 'Carousel::actualizar_estado/$1/$2');
    $routes->post('carousel/delete/(:num)', 'Carousel::delete/$1');
    $routes->post('planes/guardarDatos', 'Planes::guardarDatos');
    $routes->post('planes/eliminarDato', 'Planes::eliminarDato');
    $routes->post('informacion/store', 'Informacion::store');
    $routes->post('configuraciontienda/store', 'Configuraciontienda::store');
    $routes->post('lreclamaciones/store', 'Lreclamaciones::store');
    $routes->post('categorias/store', 'Categorias::store');
    $routes->get('categorias/edit/(:num)', 'Categorias::edit/$1');
    $routes->post('categorias/actualizar_estado/(:num)/(:num)', 'Categorias::actualizar_estado/$1/$2');
    $routes->post('posts/store', 'Posts::posts');
    $routes->post('productos/store', 'Productos::store');
    $routes->get('productos/edit/(:num)', 'Productos::edit/$1');
    $routes->post('productos/eliminarImagen', 'Productos::eliminarImagen');
    $routes->post('productos/actualizar_estado/(:num)/(:num)', 'Productos::actualizar_estado/$1/$2');
    $routes->post('categoriaproductos/store', 'Categoriaproductos::store');
    $routes->get('categoriaproductos/edit/(:num)', 'Categoriaproductos::edit/$1');
    $routes->post('categoriaproductos/actualizar_estado/(:num)/(:num)', 'Categoriaproductos::actualizar_estado/$1/$2');
    $routes->post('marcasproductos/store', 'Marcasproductos::store');
    $routes->get('marcasproductos/edit/(:num)', 'Marcasproductos::edit/$1');
    $routes->post('marcasproductos/actualizar_estado/(:num)/(:num)', 'Marcasproductos::actualizar_estado/$1/$2');
    $routes->post('subcategoria/store', 'Subcategorias::store');
    $routes->get('subcategorias/edit/(:num)', 'Subcategorias::edit/$1');
    $routes->post('subcategorias/actualizar_estado/(:num)/(:num)', 'Subcategorias::actualizar_estado/$1/$2');
    $routes->post('ofertas/store', 'Ofertas::store');
    $routes->get('ofertas/edit/(:num)', 'Ofertas::edit/$1');
    $routes->get('ofertas/actualizar_estado/(:num)/(:num)', 'Ofertas::actualizar_estado/$1/$2');
    $routes->delete('ofertas/eliminar/(:num)', 'Ofertas::eliminar/$1');
    $routes->post('bannertiendaresponsive/store', 'Bannertiendaresponsive::store');
    $routes->get('bannertiendaresponsive/edit/(:num)', 'Bannertiendaresponsive::edit/$1');
    $routes->post('bannertiendaresponsive/actualizar_estado/(:num)/(:num)', 'Bannertiendaresponsive::actualizar_estado/$1/$2');
    $routes->delete('bannertiendaresponsive/eliminar/(:num)', 'Bannertiendaresponsive::eliminar_registro/$1');
    $routes->post('promocionesresponsive/store', 'Promocionesresponsive::store');
    $routes->get('promocionesresponsive/edit/(:num)', 'Promocionesresponsive::edit/$1');
    $routes->post('promocionesresponsive/actualizar_estado/(:num)/(:num)', 'Promocionesresponsive::actualizar_estado/$1/$2');
    $routes->delete('promocionesresponsive/eliminar/(:num)', 'Promocionesresponsive::eliminar_registro/$1');
    $routes->post('masbuscadoresponsive/store', 'Masbuscadoresponsive::store');
    $routes->get('masbuscadoresponsive/edit/(:num)', 'Masbuscadoresponsive::edit/$1');
    $routes->post('masbuscadoresponsive/actualizar_estado/(:num)/(:num)', 'Masbuscadoresponsive::actualizar_estado/$1/$2');
    $routes->delete('masbuscadoresponsive/eliminar/(:num)', 'Masbuscadoresponsive::eliminar_registro/$1');
    $routes->post('categoriaspc/store', 'Categoriaspc::store');
    $routes->get('categoriaspc/edit/(:num)', 'Categoriaspc::edit/$1');
    $routes->post('categoriaspc/update', 'Categoriaspc::update');
    $routes->post('categoriaspc/actualizar_estado/(:num)/(:num)', 'Categoriaspc::actualizar_estado/$1/$2');
    $routes->delete('categoriaspc/eliminar_registro/(:num)', 'Categoriaspc::eliminar_registro/$1');
    $routes->post('anunciotienda/store', 'Anunciotienda::store');
    $routes->get('anunciotienda/edit/(:num)', 'Anunciotienda::edit/$1');
    $routes->post('anunciotienda/actualizar_estado/(:num)/(:num)', 'Anunciotienda::actualizar_estado/$1/$2');
    // Contactos admin
    $routes->get('contactos', 'Dashboard::contactosAdmin');
    $routes->get('../dashboard/contactosAdminAjax', 'Dashboard::contactosAdminAjax'); // Nota: ruta relativa, revisar si debe ser 'dashboard/contactosAdminAjax'
    $routes->post('contactos/delete/(:num)', 'Dashboard::contactosDelete/$1');
    // Actualizaciones específicas
    $routes->post('bannertiendaresponsive/update/(:num)', 'Bannertiendaresponsive::update/$1');
    $routes->post('promocionesresponsive/update/(:num)', 'Promocionesresponsive::update/$1');
    $routes->post('masbuscadoresponsive/update/(:num)', 'Masbuscadoresponsive::update/$1');
    // Cupones masivos
    $routes->match(['get', 'post'], 'generarMasivos', 'Cupon::generarMasivos');
    $routes->post('eliminarCupon/(:num)', 'Cupon::eliminarCupon/$1');
    // Administración de reviews
    $routes->get('review', 'Review::adminIndex');
    $routes->get('review/listar', 'Review::adminListar');
    $routes->get('review/editar/(:num)', 'Review::adminEditar/$1');
    $routes->post('review/eliminar', 'Review::adminEliminar');
    $routes->post('review/editar_guardar', 'Review::adminEditarGuardar');
    // ...agrega aquí otras rutas /admin si aparecen nuevas...
}); // <-- asegúrate de cerrar correctamente el grupo aquí

$routes->get('dashboard/visitasDetalle', 'Dashboard::visitasDetalle');
$routes->get('dashboard/visitasDetalleAjax', 'Dashboard::visitasDetalleAjax');
$routes->get('dashboard/stockDetalle', 'Dashboard::stockDetalle');
$routes->get('dashboard/stockDetalleAjax', 'Dashboard::stockDetalleAjax');
$routes->get('dashboard/pedidos', 'Dashboard::pedidos');
$routes->get('dashboard/pedidosAjax', 'Dashboard::pedidosAjax');
$routes->get('dashboard/clientes', 'Dashboard::clientes');
$routes->get('dashboard/clientesAjax', 'Dashboard::clientesAjax');
$routes->get('dashboard/ganancias', 'Dashboard::ganancias');
$routes->get('dashboard/gananciasAjax', 'Dashboard::gananciasAjax'); // <-- Agrega esta línea para el AJAX de ganancias
$routes->get('dashboard/totalGanancia', 'Dashboard::totalGanancia');
$routes->get('dashboard/totalPedidos', 'Dashboard::totalPedidos');
$routes->get('dashboard/totalStock', 'Dashboard::totalStock');
$routes->get('dashboard/ventasPorCategoria', 'Dashboard::ventasPorCategoria');
$routes->get('dashboard/ventasMensuales', 'Dashboard::ventasMensuales');
$routes->get('dashboard/ventasSemanales', 'Dashboard::ventasSemanales');
$routes->get('dashboard/mostVisitedUnique', 'Dashboard::mostVisitedUnique');
$routes->get('dashboard/clientesCompradores', 'Dashboard::clientesCompradores');
$routes->get('dashboard/clientesCompradoresAjax', 'Dashboard::clientesCompradoresAjax');
$routes->get('dashboard/clientes', 'Dashboard::clientesCompradores');
$routes->get('dashboard/clientesAjax', 'Dashboard::clientesCompradoresAjax');
$routes->get('dashboard/totalClientesCompradores', 'Dashboard::totalClientesCompradores');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}