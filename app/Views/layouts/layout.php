<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda en línea - Productos de calidad a los mejores precios | Valeapp</title>
    <meta name="description"
        content="Compra en línea en Valeapp. Ofrecemos una amplia gama de productos de calidad, desde electrónica hasta moda. ¡Visita nuestra tienda virtual ahora!">
    <meta name="keywords"
        content="tienda en línea, ecommerce, compra en línea, productos de calidad, mejores precios, electrónica, moda, Valeapp">
    <meta name="author" content="Valeapp">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <link rel="icon" href="<?= base_url('public/assets/tienda/img/iconb.png') ?>" type="image/x-icon" />
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/bootstrap.min.css') ?>">
    <!-- Slick -->
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/slick.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/slick-theme.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/layout.css') ?>">
    <!-- nouislider -->
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/nouislider.min.css') ?>">
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/font-awesome.min.css') ?>">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/style.css') ?>">
    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" />


    <link rel="stylesheet"
        href="<?= base_url('public/assets/whatsapp/plugin/components/Font Awesome/css/font-awesome.min.css') ?>" />
    <link rel="stylesheet" href=" <?= base_url('public/assets/whatsapp/plugin/whatsapp-chat-support.css') ?>" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    
        <script src="<?= base_url('public/assets/tienda/js/jquery.min.js') ?>"></script>

    <!-- link de bootrstrap iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


</head>

<body>
    <!-- sidebard carrito -->
    <div class="overlay"></div>

    <!-- Anuncion -->




    <ul class="nav nav-tabs listas_1">

        <li class="nav-item lista_links">
            <a class="nav-link enlace_link " href="<?php echo base_url('/'); ?>">Mi Página Web <img
                    src="<?php echo base_url('public/assets/tienda/img/casa-gris.png'); ?>"
                    alt="Imagen Casa Gris - Pagina Web" width="20" height="20"></a>

        <li class="nav-item lista_links">
            <a class="nav-link enlace_link active" href="<?php echo base_url('/tienda'); ?>">Tienda Virtual <img
                    src="<?php echo base_url('public/assets/tienda/img/web_icon_white.png'); ?>"
                    alt="Imagen Web - Tienda virtual" width="20" height="19"></a>
        </li>


    </ul>


    <header>






        <!-- links tienda y pagina  -->



        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">

                    <li>
                        <a href="javascript:void(0);" onclick="makeCallAndWhatsApp()">
                            <i class="fa fa-phone" style="transform: rotate(115deg);"></i> +51
                            <?= $configTienda[0]['telefono'] ?>
                        </a>
                    </li>

                    <script>
                    function makeCallAndWhatsApp() {
                        // Detectar si el usuario está en un dispositivo móvil
                        if (isMobile()) {
                            // Mostrar una ventana emergente con opciones
                            const choice = confirm("¿Deseas llamar o abrir WhatsApp?");

                            if (choice) {
                                // El usuario eligió "OK", abrir WhatsApp
                                window.open("https://wa.me/51953959730", "_blank");
                            } else {
                                // El usuario eligió "Cancelar", realizar la llamada telefónica
                                window.open("tel:+51<?= $configTienda[0]['telefono'] ?>", "_blank");
                            }
                        } else {
                            // Si no es móvil, por defecto, abrir WhatsApp
                            window.open("https://wa.me/51953959730", "_blank");
                        }
                    }

                    // Función para detectar si el dispositivo es móvil
                    function isMobile() {
                        return /Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
                    }
                    </script>


                    <li><a href="mailto:<?= $configTienda[0]['correo'] ?>" target="_blank"><i
                                class="fa fa-envelope-o"></i> <?= $configTienda[0]['correo'] ?></a></li>
                    <li class="hide-on-mobile"><a href="https://www.google.com/maps/place/Calle+930,+Magdalena+del+Mar+15076/@-12.0922915,-77.0591726,19z/data=!4m6!3m5!1s0x9105c9ab62f7b367:0x52d72a911112729f!8m2!3d-12.0922856!4d-77.0584323!16s%2Fg%2F11stx7jh0q?entry=ttu&g_ep=EgoyMDI1MTExNy4wIKXMDSoASAFQAw%3D%3D" target="_blank"><i
                                class="fa fa-map-marker"></i><?= $configTienda[0]['direccion'] ?></a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li id="user-container">
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <?php if (!empty($userData) && isset($userData['nombre_usuario'])) : ?>
                            <?php echo esc($userData['nombre_usuario']); ?>
                            <?php else : ?>
                            Invitado
                            <?php endif; ?>
                        </a>
                    </li>
                    <?php
                    // Define el ID del usuario predeterminado
                    $usuarioPredeterminadoID = 999;
                    ?>

                    <?php if (empty($userData) || (isset($userData['id_usuario']) && $userData['id_usuario'] == $usuarioPredeterminadoID)) : ?>
                    <!-- Mostrar este enlace solo si no hay una sesión iniciada o si el usuario es el predeterminado -->
                    <li><a href="#" data-toggle="modal" data-target="#registroModal"><i class="fa fa-lock"></i>
                            Registrarse</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#inicioSesionModal"><i class="fa fa-sign-in"></i>
                            Iniciar sesión</a></li>
                    <?php else : ?>
                    <!-- Mostrar estos enlaces cuando hay una sesión iniciada que no es el usuario predeterminado -->
                    <!--  <li><a href="#"><i class="fa fa-user"></i> Perfil</a></li> -->
                    <li><a href="<?php echo site_url('usuarios/cerrarSesion'); ?>"><i class="fa fa-sign-out"></i> Cerrar
                            sesión</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>


        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">

            <!--   -->
            <!-- container -->
            <div class="container ">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="<?php echo base_url('/'); ?>" class="logo">
                                <img style="width: 128px; height: 48px;     margin-top: 10px;"
                                    src="<?= base_url('public/assets/tienda/img/logob.png') ?>"
                                    alt="Logo de Tienda Virtual">

                            </a>
                        </div>
                    </div>

                    <div class="col-md-1 clearfix men">
                        <div class="header-ctn">

                            <div class="header-menu">
                                <a href="#" id="menu-toggle">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>

                                </a>
                            </div>


                        </div>
                    </div>



                    <!-- /LOGO -->



                    <!-- SEARCH BAR -->
                    <div class="col-md-5" id="buscador_responsive">
                        <div class="header-search">

                            <form id="searchForm">
                                <input id="searchInput" class="input" placeholder="Buscar Aquí">
                                <input type="hidden" id="idProducto" name="idProducto">
                                <button style="background-color: #f19106;" type="#" class="search-btn"><i
                                        class="fa fa-search"></i></button>
                                <div id="searchSuggestions"></div>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->



                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix man">
                        <div class="header-ctn ctn-2">
                            <!-- Wishlist -->
                            <div id="compras">
                                <?php if (!empty($userData)) : ?>
                                <a href="<?= base_url('tienda/clientecompra/' . $userData['id_usuario']) ?>">
                                    <i class="fa fa-money"></i>
                                    <span>Compras</span>
                                    <div class="qty"><?= session()->get('compras_recientes') ?? 0 ?></div>
                                </a>
                                <?php endif; ?>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div id="sidebar_car" class="dropdown">
                                <a class="dropdown-toggle" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Tu Carrito</span>
                                    <div class="qty">3</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="" alt="">

                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">PRODUCTOS AQUÍ</a></h3>
                                                <h4 class="product-price">
                                                    <button class="btn btn-sm btn-secondary decrement-qty">-</button>
                                                    <span class="qty"></span>
                                                    <button class="btn btn-sm btn-secondary increment-qty">+</button>

                                                </h4>


                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>


                                    </div>
                                    <div class="cart-summary">
                                        <small>3 Item(s) selected</small>
                                        <h5>SUBTOTAL: S/.</h5>
                                        <button class="btn btn-sm btn-danger vaciar"> vaciar</button>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="<?= base_url('tienda/carrito') ?>">Ver Carrito</a>
                                        <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Contactanos  -->
                            <div>
                                <?php if (!empty($userData)) : ?>
                                <a href="<?= base_url('contacto/') ?>">
                                    <img src="<?= base_url('public/assets/image/contactanos.png') ?>" alt="Contactanos"
                                        class="contacto"><br>
                                    <span>Contacto</span>
                                </a>
                                <?php endif; ?>
                            </div>

                            <div class="sidebar_prueba">
                                <div class="cart-list">
                                    <!-- Contenido del carrito aquí -->
                                </div>
                                <div class="cart-summary">
                                    <small>0 Producto(s) seleccionados</small>
                                    <h5>SUBTOTAL: S/0.00</h5>
                                    <div class="btn-group d-flex" role="group">
                                        <button class="btn btn-sm btn-danger flex-fill vaciar">Vaciar</button>
                                        <a href="<?= base_url('tienda/carrito') ?>"
                                            class="btn btn-sm btn-primary flex-fill">Ver Carrito</a>
                                        <a id="btn-cotizar" href="" class="btn btn-sm btn-primary flex-fill">Cotizar</a>
                                    </div>
                                </div>

                            </div>
                            <!-- sidebard -->



                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>



                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->



    </header>

    <div id="menu-dropdown" class="menu-dropdown">
        <div class="menu-content">
            <div class="column column-categorias">
                <!-- Lista de categorías -->
                <ul class="menu-items" id="categorias-list">

                    <!-- Aquí se agregarán dinámicamente las categorías -->


                </ul>
            </div>

            <div class="column">
                <!-- Submenús -->
                <div id="submenus-container">
                    <!-- Aquí se agregarán dinámicamente los submenús -->
                </div>
            </div>

            <div class="column">
                <!-- Productos -->
                <div class="submenu-derecho" id="productos-derecho">
                    <!-- Aquí se agregarán dinámicamente los productos -->
                </div>
            </div>
        </div>
    </div>


























    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url('/tienda'); ?>">Inicio</a></li>
                    <li><a href="<?php echo base_url('/shop'); ?>">Tienda</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>


    <?php echo $this->renderSection("contenido"); ?>


    <!-- <?= base_url('public/assets/whatsapp/plugin/components/image/ico_ventas.png') ?> -->

    <!-- whatsapp boton flotante -->
    <div class="whatsapp_chat_support wcs_fixed_right" id="button-w">
        <div class="wcs_button_label">Contáctanos</div>
        <div class="wcs_button wcs_button_circle">
            <span class="fa fa-whatsapp"></span>
        </div>

        <div class="wcs_popup">
            <div class="wcs_popup_close">
                <span class="fa fa-close"></span>
            </div>
            <div class="wcs_popup_header">
                <span class="fa fa-whatsapp"></span>
                <strong>Servicio al clientea</strong>

                <div class="wcs_popup_header_description">
                    Chatea con nosotros en Whatsapp
                </div>
            </div>

            <!-- <div class="wcs_popup_input" data-number="51924025059"
                data-availability='{ "monday":"07:00-22:30", "tuesday":"07:00-22:30", "wednesday":"07:00-22:30", "thursday":"07:00-22:30", "friday":"07:00-22:30", "saturday":"09:00-18:30", "sunday":"09:00-22:30" }'>
                <img src="<?= base_url('public/assets/whatsapp/plugin/components/image/ico_soporte.png') ?>"
                    alt="Imagen - Icono soporte" width="40" height="40" />
                <sub style="display: inline-block; vertical-align: top; left: -7px; font-weight: bold;">Soporte</sub>
                <input type="text" placeholder="Escribir pregunta!" />
                <i class="fa fa-play"></i>
            </div> -->
            <div class="wcs_popup_input" data-number="51953959730"
                data-availability='{ "monday":"07:00-22:30", "tuesday":"07:00-22:30", "wednesday":"07:00-22:30", "thursday":"07:00-22:30", "friday":"07:00-22:30", "saturday":"09:00-18:30", "sunday":"09:00-22:30" }'>
                <img src="<?= base_url('public/assets/whatsapp/plugin/components/image/ico_ventas.png') ?>"
                    alt="Imagen - Icono ventas" width="40" height="40" />
                <sub style="display: inline-block; vertical-align: top; left: -7px; font-weight: bold;">Ventas</sub>
                <input type="text" placeholder="Escribir pregunta!" />
                <i class="fa fa-play"></i>
            </div>
            <!-- <div class="wcs_popup_avatar">
            <img src="https://avatars.githubusercontent.com/janl?s=180" alt="">
        </div> -->
        </div>
    </div>


    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Sobre nosotros</h3>
                            <p><?= $configTienda[0]['sobre_nosotros'] ?></p>
                            <ul class="footer-links">
                                <li>
                                    <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($configTienda[0]['direccion']) ?>"
                                        target="_blank">
                                        <i class="fa fa-map-marker"></i><?= $configTienda[0]['direccion'] ?>
                                    </a>
                                </li>
                                <li><a href="https://wa.link/fryn84" target="_blank"><i
                                            class="fa fa-phone"></i><?= $configTienda[0]['telefono'] ?></a></li>
                                <li><a href="mailto:ventas@tegnex.pe" target="_blank"><i
                                            class="fa fa-envelope-o"></i><?= $configTienda[0]['correo'] ?></a></li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categorias</h3>
                            <ul class="footer-links">
                                <?php    
                                $categoriasExcluidas = ['Automotriz', 'Muebles']; // Lista de categorías a excluir
                                foreach ($categoriasFooter as $cf) : 
                                    if (in_array($cf['nombre'], $categoriasExcluidas)) {
                                        continue; // Saltar a la siguiente categoría si está en la lista de excluidas
                                    }
                                ?>
                                <li><a><?php echo $cf['nombre'] ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Información</h3>
                            <ul class="footer-links">
                                <li><a href="<?php echo base_url('public/assets/terminos-condiciones/privacidad.pdf'); ?>"
                                        target="_blank">Políticas de Privacidad</a></li>
                                <li><a href="#">Terminos y Condiciones</a></li>
                                <li><a href="<?php echo base_url('/contacto'); ?>">Contactanos</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <a href="<?php echo base_url('/lreclamaciones'); ?>">
                                <img src="<?= base_url('public/assets/image/libroreclamaciones.webp') ?>"
                                    alt="Imagen Libro de reclamaciones" width="200" height="140">
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <a target="_blank" href="https://valeapp.pe">Valeapp</a>
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- footer modo celular  -->
    <footer class="movil">
        <div class="accordion" >
            <div class="accordion-item">
                <div class="accordion-header" id="acordeon_responsivo">SOBRE NOSOTROS</div>
                <div class="accordion-content" id="acordeon_responsivo">
                    <p><?= $configTienda[0]['sobre_nosotros'] ?></p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header" id="acordeon_responsivo">CATEGORIAS</div>
                <div class="accordion-content" id="acordeon_responsivo">
                    <ul class="seba-list">
                        <?php    
                            $categoriasExcluidas = ['Automotriz', 'Muebles']; // Lista de categorías a excluir
                            foreach ($categoriasFooter as $cf) : 
                            if (in_array($cf['nombre'], $categoriasExcluidas)) {
                                continue; // Saltar a la siguiente categoría si está en la lista de excluidas
                            }
                        ?>
                        <li class="seba"><a><?php echo $cf['nombre'] ?></a></li>
                        <?php endforeach ?>
                    </ul>
                    <br>
                </div>

            </div>
            <div class="accordion-item">
                <div class="accordion-header" id="acordeon_responsivo">INFORMACIÓN</div>
                <div class="accordion-content" id="acordeon_responsivo">
                    <ul>
                        <li class="seba"><a
                                href="<?php echo base_url('public/assets/terminos-condiciones/privacidad.pdf'); ?>"
                                target="_blank">Políticas de Privacidad</a></li>
                        <li class="seba"><a href="#">Terminos y Condiciones</a></li>
                        <li class="seba"><a href="<?php echo base_url('/contacto'); ?>">Contactanos</a></li>
                        <br>
                    </ul>
                </div>
            </div>
        </div>
        <div class="caja-footer">
            <a href="<?php echo base_url('/lreclamaciones'); ?>">
                <img src="<?= base_url('public/assets/image/librodereclamaciones.webp') ?>"
                    alt="Imagen Libro de reclamaciones" width="280" height="60">
            </a>
            <br>
            <li><a href="#"><i class="bi bi-telephone-fill"></i> +51 <?= $configTienda[0]['telefono'] ?></a></li>
            <li><a href="#"><i class="fa fa-envelope-o"></i><?= $configTienda[0]['correo'] ?></a></li>
        </div>

    </footer>




    <!-- jQuery Plugins -->
    <!-- Enlace para abrir el modal -->


    <!-- Modal de Registro -->



    <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form id="registro-form" action="<?php echo site_url('usuarios/registro'); ?>" method="POST">
                        <input type="hidden" id="tipoDocumento" name="tipoDocumento" value="dni">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row text-center">
                                    <div class="form-group w-100">
                                        <h3 class="title-register"><i class="fa fa-user"></i> Regístrate</h3>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="form-group w-100">
                                        <p class="parrf_login">Ingresa tus datos personales y disfruta de una
                                            experiencia de compra más rápida.</p>
                                    </div>
                                </div>
                                <div class="row justify-content-center mb-4">
                                    <div class="form-group text-center">
                                        <label for="tipoDocumento">DNI</label>
                                        <label class="switch">
                                            <input type="checkbox" id="tipoDocumentoSwitch">
                                            <span class="slider round"></span>
                                        </label>
                                        <label for="tipoDocumento">RUC</label>
                                    </div>
                                </div>
                            </div>
                            <div id="dniFields" class="w-100">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dni" class="col-form-label">DNI:</label>
                                        <input type="text" class="form-control" id="dni" name="dni" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre" class="col-form-label">Nombres:</label>
                                        <input name="nombre" type="text" class="form-control" id="nombre">
                                    </div>
                                </div>

                            </div>
                            <div id="rucFields" class="w-100" style="display:none;">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ruc" class="col-form-label">RUC:</label>
                                        <input type="text" class="form-control" id="ruc" name="ruc" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="razonSocial" class="col-form-label">Razón Social:</label>
                                        <input name="razonSocial" type="text" class="form-control" id="razonSocial">
                                    </div>
                                </div>
                                <!-- extra -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="contacto" class="col-form-label">Contacto:</label>
                                        <input name="contacto" type="text" class="form-control" id="contacto"
                                            placeholder="Ingrese DNI" maxlength="8">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_c" class="col-form-label">Nombres:</label>
                                        <input name="nombre_c" type="text" class="form-control" id="nombre_c">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="correo" class="col-form-label">Correo:</label>
                                    <input type="email" class="form-control" name="correo" id="correo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="celular" class="col-form-label">Telefono / Movil:</label>
                                    <input name="celular" type="number" class="form-control" id="celular" maxlength="9">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="clave" class="col-form-label">Clave:</label>
                                    <input name="clave" type="password" class="form-control" id="clave">
                                </div>
                            </div>
                        </div>


                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="agregarTerminos1">
                            <label class="form-check-label" for="agregarTerminos1">
                                Acepto los <a
                                    href="https://valeapp24.blogspot.com/2024/04/terminos-y-condiciones-de-politica-y.html"
                                    target="_blank">términos y condiciones y politica de privacidad</a>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="agregarTerminos2">
                            <label class="form-check-label" for="agregarTerminos2">
                                Autorizo los <a
                                    href="https://valeapp24.blogspot.com/2024/04/terminos-y-condiciones-de-politica-y.html"
                                    target="_blank">fines adicionales</a> de tratamiento de mis datos
                            </label>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-link" data-dismiss="modal" data-toggle="modal"
                                    data-target="#recuperarClaveModal">¿Olvidaste tu contraseña?</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-login" id="guardarUsuario"
                                    disabled>Crear Cuenta</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal de inicio de sesión -->
    <div class="modal fade" id="inicioSesionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Iniciar sesión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí colocas tu formulario de inicio de sesión -->
                    <form id="inicioSesionForm" action="<?php echo site_url('usuarios/iniciarSesion'); ?>"
                        method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="usuario" name="usuario"
                                placeholder="Correo electrónico o teléfono" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal"
                                data-target="#registroModal">¿No tienes una cuenta? Registrarse</a>
                        </div>
                        <hr>
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-link" data-dismiss="modal" data-toggle="modal"
                                data-target="#recuperarClaveModal">¿Olvidaste tu contraseña?</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="recuperarClaveModal" tabindex="-1" role="dialog"
        aria-labelledby="recuperarClaveModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recuperarClaveModalLabel">Recuperar contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="recuperarClaveForm" action="<?php echo site_url('usuarios/recuperarClave'); ?>"
                        method="POST">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input type="text" class="form-control" id="usuarioRecuperar" name="usuarioRecuperar">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo electrónico:</label>
                            <input type="email" class="form-control" id="correoRecuperar" name="correoRecuperar">
                        </div>
                        <div class="form-group">
                            <label for="nuevaClave">Nueva contraseña:</label>
                            <input type="password" class="form-control" id="nuevaClave" name="nuevaClave">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar solicitud de recuperación</button>


                    </form>
                </div>
            </div>
        </div>
    </div>



    
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://kit.fontawesome.com/3708c7cfc7.js" crossorigin="anonymous"></script>


    <script src="<?= base_url('public/assets/tienda/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/tienda/js/slick.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/tienda/js/nouislider.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/tienda/js/jquery.zoom.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/tienda/js/main.js') ?>"></script>


    <!--  -->

    <!--   <script src="<?= base_url('public/assets/whatsapp/plugin/components/jQuery/jquery-1.11.3.min.js') ?>"></script> -->
    <script src="<?= base_url('public/assets/whatsapp/plugin/components/moment/moment.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/whatsapp/plugin/components/moment/moment-timezone-with-data.min.js') ?>">
    </script>

    <script src="<?= base_url('public/assets/whatsapp/plugin/whatsapp-chat-support.js') ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.js"></script> -->

   <!-- <script src="https://sandbox-checkout.izipay.pe/payments/v1/js/index.js"></script> -->
    <script>
    /*  script acordeon */

    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const accordionItem = header.parentElement;

            // Cierra otros elementos del acordeón
            document.querySelectorAll('.accordion-item').forEach(item => {
                if (item !== accordionItem) item.classList.remove('active');
            });

            // Abre/cierra el elemento actual
            accordionItem.classList.toggle('active');
        });
    });

    /*  fin acordeonm */


    function cerrarSubmenus() {
        $('.submenu, .submenu-derecho').hide();
    }

    function cargarCategorias() {
        $.ajax({
            url: '<?= base_url('productos/obtenerCategorias') ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Limpiar lista de categorías antes de agregar nuevas
                $('#categorias-list').empty();

                // Recorrer cada categoría y agregarla a la lista con ícono
                response.categorias.forEach(function(categoria) {



                    // Crear el elemento de lista de categoría con ícono usando template literals
                    const listItem = `
                    <li class="category">
                        <a href="#" class="category-title" data-categoria-id="${categoria.id_categoria}">
                            <img src="<?= base_url('public/assets/img_tienda/categorias/') ?>${categoria.imagen_categoria}" alt="${categoria.nombre}" style="max-width: 30px; max-height: 30px;"> ${categoria.nombre}
                        </a>
                    </li>
                `;

                    // Agregar el elemento a la lista de categorías
                    $('#categorias-list').append(listItem);

                    // Asignar evento click a cada categoría para cargar subcategorías y productos
                    $(document).on('click', '#categorias-list .category-title', function(e) {
                        e.preventDefault();
                        $('#productos-derecho').empty();
                        var categoriaId = $(this).data('categoria-id');
                        var submenuId = $(this).data('submenu');

                        // Ocultar todos los submenús y luego mostrar el correspondiente
                        $('.submenu').hide();
                        $('#' + submenuId).show();

                        // Obtener las subcategorías mediante AJAX
                        $.ajax({
                            url: '<?= base_url('productos/obtenerSubcategorias') ?>',
                            type: 'POST',
                            data: {
                                categoria_id: categoriaId
                            },
                            success: function(response) {
                                // Limpiar contenedor de submenús antes de agregar nuevas subcategorías
                                $('#submenus-container').empty();

                                // Crear el contenedor para la lista de subcategorías en grid
                                var gridContainer = $(
                                    '<div class="subcategorias-grid">');

                                // Recorrer cada subcategoría y construir su elemento en el grid
                                response.data.forEach(function(subcategoria) {
                                    // Crear el elemento de la subcategoría en el grid como un <a> en lugar de <div>
                                    var subcategoriaLink = $(
                                        '<a class="submenu-item">');
                                    subcategoriaLink.attr('href',
                                        '#'
                                    ); // Establecer el href deseado si es necesario
                                    subcategoriaLink.attr(
                                        'data-subcategoria-id',
                                        subcategoria.id_subcategoria
                                    );
                                    subcategoriaLink.html(
                                        `<p>${subcategoria.nombre}</p>`
                                    );

                                    // Agregar la subcategoría al contenedor del grid
                                    gridContainer.append(
                                        subcategoriaLink);
                                });

                                // Agregar el contenedor del grid al contenedor principal
                                $('#submenus-container').append(gridContainer);

                                // Simular clic en la primera subcategoría después de cargar categorías y productos

                            },
                            error: function(xhr, status, error) {
                                alert(
                                    'Ocurrió un error al cargar las subcategorías. Por favor, inténtalo de nuevo.'
                                );
                            }
                        });
                    });
                });

                setTimeout(function() {
                    const firstCategory = $('#categorias-list .category-title').first();
                    firstCategory.trigger('mouseenter');

                    // Simular clic en la primera subcategoría después de cargar categorías y productos
                    setTimeout(function() {
                        const firstSubcategory = $('#submenus-container .submenu-item')
                            .first();
                        firstSubcategory.trigger('mouseenter');
                    }, 200); // Esperar medio segundo para asegurar que los elementos estén listos
                }, 200);



            },
            error: function(error) {
                console.error('Error al cargar categorías:', error);
            }
        });
    }

    function cargarProductosPorSubcategoria(categoriaId) {
        $('#productos-derecho').empty();
        $.ajax({
            url: '<?= base_url('productos/filtrarPorSubcategoria') ?>',
            type: 'POST',
            data: {
                id_subcategoria: categoriaId
            },
            dataType: 'json',
            success: function(response) {
                // Limpiar contenedor de productos antes de agregar nuevos productos
                $('#productos-derecho').empty();

                // Obtener hasta los primeros 12 productos
                response.data.slice(0, 12).forEach(function(producto) {
                    var article = $('<article>'); // Utilizamos <article> en lugar de <div>
                    article.addClass('producto-item'); // Clase para cada producto



                    // Crear estructura HTML para cada producto en el grid
                    var contenidoProducto = `
                             <a href="tienda/verproducto/${producto.id_producto}">
                               <div class="producto-imagen">
                               <img src="<?= base_url('public/assets/img_tienda/productos/') ?>${producto.imagen_producto}" alt="${producto.nombre}" style="width: 90px;">
                               </div>
                               <div class="producto-info">
                                 <h3>${producto.nombre}</h3>
                               </div>
                           `;

                    article.html(contenidoProducto);

                    $('#productos-derecho').append(article);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar subcategorías:', error);
            }
        });
    }



    $(document).ready(function() {
        cargarCategorias();

        //whatsapp
        $("#button-w").whatsappChatSupport({
            defaultMsg: ""
        });

        /* menu */

        $('#menu-toggle').click(function(e) {
            e.preventDefault();
            $('#menu-dropdown').toggle();
            // Mostrar todos los submenús al abrir el menú
            $('.submenu').show();
            $('.submenu-derecho').show();
        });


        $(document).on('click', function(event) {
            var menuDropdown = $('#menu-dropdown');
            var menuToggle = $('#menu-toggle');

            // Verificar si el clic no está dentro del menú-dropdown ni en el botón de toggle
            if (!menuDropdown.is(event.target) && menuDropdown.has(event.target).length === 0 &&
                !menuToggle.is(event.target) && menuToggle.has(event.target).length === 0) {
                menuDropdown.hide();
                // Ocultar submenús también si es necesario
                $('.submenu').hide();
                $('.submenu-derecho').hide();
            }
        });






        $(document).on('mouseenter', '#categorias-list .category-title', function(e) {
            e.preventDefault();
            $('#productos-derecho').empty();
            var categoriaId = $(this).data('categoria-id');

            var submenuId = $(this).data('submenu');

            // Ocultar todos los submenús y luego mostrar el correspondiente
            $('.submenu').hide();
            $('#' + submenuId).show();

            // Obtener las subcategorías mediante AJAX
            $.ajax({
                url: '<?= base_url('productos/obtenerSubcategorias') ?>',
                type: 'POST',
                data: {
                    categoria_id: categoriaId
                },
                success: function(response) {
                    // Limpiar contenedor de submenús antes de agregar nuevas subcategorías
                    $('#submenus-container').empty();

                    // Crear el contenedor para la lista de subcategorías en grid
                    var gridContainer = $('<div class="subcategorias-grid">');

                    // Recorrer cada subcategoría y construir su elemento en el grid
                    response.data.forEach(function(subcategoria) {
                        // Crear el elemento de la subcategoría en el grid como un <a> en lugar de <div>
                        var subcategoriaLink = $('<a class="submenu-item">');
                        subcategoriaLink.attr('href',
                            '#'); // Establecer el href deseado si es necesario
                        subcategoriaLink.attr('data-subcategoria-id', subcategoria
                            .id_subcategoria);
                        subcategoriaLink.html(`<p>${subcategoria.nombre}</p>`);

                        // Agregar la subcategoría al contenedor del grid
                        gridContainer.append(subcategoriaLink);
                    });

                    // Agregar el contenedor del grid al contenedor principal
                    $('#submenus-container').append(gridContainer);
                },
                error: function(xhr, status, error) {
                    alert(
                        'Ocurrió un error al cargar las subcategorías. Por favor, inténtalo de nuevo.'
                    );
                }
            });
        });



        $(document).on('mouseenter', '#submenus-container .submenu-item', function(e) {
            e.preventDefault();

            var subcategoriaId = $(this).data('subcategoria-id');

            // Cargar productos por subcategoría mediante AJAX
            cargarProductosPorSubcategoria(subcategoriaId);
        });



        /* buscar producto por subcategorias */
        $(document).on('click', '#submenus-container .submenu-item', function(e) {
            e.preventDefault();

            var subcategoriaid = $(this).data('subcategoria-id');
            console.log(subcategoriaid);
            cargarProductosSubcategoria(subcategoriaid);

        });

        function cargarProductosSubcategoria(subcategoriaid) {
            $.ajax({
                url: '<?php echo base_url('productos/getProductos'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    subcategoriaid: subcategoriaid
                },
                success: function(response) {
                    console.log('trayendo productos subcategory:', response);
                    // Redirigir a la vista "tienda" con los productos filtrados
                    window.location.href = '<?= site_url('shop') ?>?subcategoriaid=' +
                        subcategoriaid;
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }



        /* menu */



        function updateRequiredFields() {
            if ($('#tipoDocumentoSwitch').is(':checked')) {
                $('#dni').prop('required', false);
                $('#nombre').prop('required', false);
                $('#ruc').prop('required', true);
                $('#razonSocial').prop('required', true);
                $('#contacto').prop('required', true);
                $('#nombre_c').prop('required', true);
                $('#tipoDocumento').val('ruc');
            } else {
                $('#dni').prop('required', true);
                $('#nombre').prop('required', true);
                $('#ruc').prop('required', false);
                $('#razonSocial').prop('required', false);
                $('#contacto').prop('required', false);
                $('#nombre_c').prop('required', false);
                $('#tipoDocumento').val('dni');
            }
        }

        $('#tipoDocumentoSwitch').change(function() {
            if ($(this).is(':checked')) {
                $('#dniFields').hide();
                $('#rucFields').show();
            } else {
                $('#dniFields').show();
                $('#rucFields').hide();
            }
            updateRequiredFields();
        });

        // Initial state
        if ($('#tipoDocumentoSwitch').is(':checked')) {
            $('#dniFields').hide();
            $('#rucFields').show();
        } else {
            $('#dniFields').show();
            $('#rucFields').hide();
        }
        updateRequiredFields();

        // Enable submit button only if terms are accepted
        $('.form-check-input').on('change', function() {
            if ($('#agregarTerminos1').is(':checked') && $('#agregarTerminos2').is(':checked')) {
                $('#guardarUsuario').prop('disabled', false);
            } else {
                $('#guardarUsuario').prop('disabled', true);
            }
        });


        function obtenerCarrito() {
            // Obtener el carrito del almacenamiento local
            var carritoGuardado = localStorage.getItem('carrito');

            // Convertir el string JSON a un objeto JavaScript
            var carrito = JSON.parse(carritoGuardado);

            return carrito;
        }

        $('#btn-cotizar').click(function(e) {
            e.preventDefault();
            // Obtén los datos del carrito. Asegúrate de que esto se ajuste a tu implementación real.

            var sesionIniciada = <?= session()->has('usuario_autenticado') ? 'true' : 'false' ?>;

            console.log(sesionIniciada);

            var carrito = obtenerCarrito();
            console.log('obteniendo', carrito)



            // Otros datos necesarios para la cotización
            var datosCotizacion = {
                dni: $('#dni').val(),
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                correo: $('#correo').val(),
                telefono: $('#telefono').val(),
                departamento: $('#departamento').val(),
                provincia: $('#provincia').val(),
                distrito: $('#distrito').val(),
                direccion: $('#direccion').val(),
                numero: $('#numero').val(),
                carrito: JSON.stringify(carrito)
            };


            if (sesionIniciada) {


                $.ajax({
                    url: '<?= base_url('checkout/guardarCotizacion') ?>',
                    type: 'POST',
                    data: datosCotizacion,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = response.redirect_url;
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        alert(
                            'Ocurrió un error al intentar cotizar. Por favor, inténtalo de nuevo.'
                        );
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Inicia Sesión',
                    text: 'Debes iniciar sesión para continuar',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    $('#registroModal').modal('show');
                });
            }
        });


        $("#productos-container").on("click", ".add-to-cart-btn", function() {
            // Tu lógica para agregar productos al carrito
            console.log('ctmre')

            $(".cart-dropdown").css({
                "opacity": 1,
                "visibility": "visible"
            });

            setTimeout(function() {
                $(".cart-dropdown").css({
                    "opacity": 0,
                    "visibility": "hidden"
                });
            }, 5000);
        });

        function openSidebar() {


            $('.sidebar_prueba').css('right', '0');
            $('body').addClass('sidebar_active');
        }

        function closeSidebar() {
            $('.sidebar_prueba').css('right', '-350px');
            $('body').removeClass('sidebar_active');
        }

        $('#sidebar_car').click(function() {
            openSidebar();
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('#sidebar_car')
                .length) {
                closeSidebar();
            }
        });

        // Detener la propagación del evento de clic dentro del sidebar
        $('.sidebar_prueba').click(function(e) {
            e.stopPropagation();
        });


        $('#searchInput').on('keyup', function() {
            var searchText = $(this).val();
            // Enviar solicitud AJAX al servidor
            $.ajax({
                url: '<?php echo base_url('productos/buscarProductosPorTexto'); ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    texto: searchText
                },
                success: function(response) {
                    // Limpiar las sugerencias anteriores
                    $('#searchSuggestions').empty();


                    response.forEach(function(producto) {
                        var suggestion = $('<div class="search-suggestion"></div>');
                        // Agregar el nombre del producto con una clase específica
                        suggestion.append('<span class="product-name">' + producto
                            .nombre + '</span>');
                        // Agregar la imagen del producto con tamaño 50x50 px
                        suggestion.append(
                            '<img src="<?php echo base_url('public/assets/img_tienda/productos/'); ?>' +
                            producto.imagen_producto + '" alt="' + producto
                            .nombre + '" style="width: 50px; height: 50px;">');
                        suggestion.data('id_producto', producto.id_producto);
                        // Agregar evento click para manejar la selección del producto
                        suggestion.on('click', function() {
                            var nombreProducto = $(this).find(
                                '.product-name').text();
                            var idProducto = $(this).data('id_producto');

                            $('#searchInput').val(nombreProducto);
                            $('#idProducto').val(idProducto);

                            console.log('obtneiendo id', idProducto);

                            window.location.href =
                                '<?php echo base_url('tienda/verproducto/'); ?>' +
                                idProducto;
                        });

                        // Agregar la sugerencia al contenedor
                        $('#searchSuggestions').append(suggestion);
                    });
                    // Mostrar el contenedor de sugerencias
                    $('#searchSuggestions').css('display', 'block');
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        });

        // Evento al hacer clic en el botón "Buscar"
        $('.search-btn').on('click', function(event) {
            // Prevenir el comportamiento por defecto del botón
            event.preventDefault();
            var searchText = $('#searchInput').val();

            if (searchText.trim() === '') {
                alert('Por favor, ingrese un término de búsqueda.');
                return;
            }

            $.ajax({
                url: '<?php echo base_url('productos/buscarProductosPorTexto'); ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    texto: searchText
                },
                success: function(response) {
                    /*  if (response.length > 0) {
                         // Redirigir al primer producto encontrado
                         window.location.href = '<?php echo base_url('tienda/verproducto/'); ?>' + response[0].id_producto;
                     } else {
                         alert('No se encontraron productos con el texto ingresado.');
                     } */
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        });

        $('#searchInput').on('keydown', function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                var searchText = $(this).val();
                console.log('haciendo click en enter');
                cargarProductosConFiltroYRedirigir(searchText);
            }
        });

        function cargarProductosConFiltroYRedirigir(searchText) {
            $.ajax({
                url: '<?php echo base_url('productos/getProductos'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    searchText: searchText
                },
                success: function(response) {
                    console.log('trayendo productos:', response);
                    // Redirigir a la vista "tienda" con los productos filtrados
                    window.location.href = '<?= site_url('shop') ?>?searchText=' + searchText;
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }



        $('#dni').on('input', function() {
            var dni = $(this).val();

            // Realizar solicitud AJAX para obtener los datos del DNI
            $.ajax({
                url: '<?= base_url('checkout/getDNI_New') ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    dni: dni
                },
                success: function(response) {
                    console.log(response)
                    if (response.success) {

                        $('#nombre').val(response.result.nombres + ' ' + response.result
                            .apellido_pat + ' ' + response.result.apellido_mat);

                    } else {

                        console.log('Error al consultar el DNI');
                        obtenerDatosDesdeSunac(dni);
                    }

                },
                error: function(xhr, status, error) {
                    // Manejar errores de la solicitud AJAX
                    console.error('Error al consultar el DNI:', error);

                }
            });
        });

        /* contacto */
        $('#contacto').on('input', function() {
            var dni = $(this).val();

            // Realizar solicitud AJAX para obtener los datos del DNI
            $.ajax({
                url: '<?= base_url('checkout/getDNI_New') ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    dni: dni
                },
                success: function(response) {
                    console.log(response)
                    if (response.success) {

                        $('#nombre_c').val(response.result.nombres + ' ' + response.result
                            .apellido_pat + ' ' + response.result.apellido_mat);

                    } else {

                        console.log('Error al consultar el DNI');
                        obtenerDatosDesdeSunac(dni);
                    }

                },
                error: function(xhr, status, error) {
                    // Manejar errores de la solicitud AJAX
                    console.error('Error al consultar el DNI:', error);

                }
            });
        });

        $('#ruc').on('input', function() {
            var dni = $(this).val();

            // Realizar solicitud AJAX para obtener los datos del DNI
            $.ajax({
                url: '<?= base_url('checkout/getDatosFromAPI_Sunac_new') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    RUC: dni
                },
                success: function(response) {
                    console.log('Datos obtenidos desde Sunac:', response);
                    // Manejar la respuesta de Sunac
                    if (response.RUC) {
                        $('#razonSocial').val(response.RazonSocial);
                    } else {
                        console.log('Error al consultar el RUC en Sunac');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al consultar el RUC en Sunac:', error);
                }
            });
        });

        $('#agregarTerminos1').change(function() {
            // Verificar si el checkbox está marcado
            var isChecked1 = $(this).is(':checked');
            var isChecked2 = $('#agregarTerminos2').is(':checked');

            // Activar o desactivar el botón según sea necesario
            $('#guardarUsuario').prop('disabled', !isChecked1 || !isChecked2);
        });

        $('#agregarTerminos2').change(function() {
            // Verificar si el checkbox está marcado
            var isChecked1 = $('#agregarTerminos1').is(':checked');
            var isChecked2 = $(this).is(':checked');

            // Activar o desactivar el botón según sea necesario
            $('#guardarUsuario').prop('disabled', !isChecked1 || !isChecked2);
        });




        $('#user-container a').click(function(e) {


            $('#user-dropdown-content').toggle();
        });



        $(document).click(function(e) {
            if (!$(e.target).closest('#user-container').length) {
                /* console.log('carra') */
                $('#user-dropdown-content').hide();
            }
        });


        // Escuchar el evento submit del formulario de registro
        $('#registro-form').submit(function(e) {
            e.preventDefault(); // Evitar el envío del formulario


            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // URL del controlador y método de registro
                data: $(this).serialize(), // Datos del formulario serializados
                dataType: 'json', // Esperar una respuesta JSON
                success: function(response) {
                    // Mostrar mensaje de éxito utilizando SweetAlert
                    if (response.success) {
                        // Mostrar mensaje de éxito utilizando SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro exitoso!',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 3000
                        }).then((result) => {
                            $('#registroModal').modal('hide');
                        });

                        limpiarCamposRegistro();
                    } else if (response.error && response.error.correo) {
                        // Mostrar mensaje de error si el correo ya está en uso
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'El correo ya existe'
                        });
                    } else {
                        // Otro tipo de error
                        console.error(response);
                    }

                    /* setTimeout(function() {
                        $('#inicioSesionModal').modal('show');
                    }, 2000); */

                    limpiarCamposRegistro();
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Manejar errores de solicitud AJAX
                    console.error(xhr.responseText);
                }
            });
        });



        $('#inicioSesionForm').submit(function(e) {
            e.preventDefault(); // Evitar el envío del formulario

            // Realizar una solicitud AJAX para enviar los datos del formulario
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'), // URL del controlador y método de inicio de sesión
                data: $(this).serialize(), // Datos del formulario serializados
                dataType: 'json', // Esperar una respuesta JSON
                success: function(response) {
                    // Verificar si la respuesta contiene un mensaje de éxito
                    if (response.success) {
                        // Mostrar mensaje de éxito utilizando SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: '¡Inicio de sesión exitoso!',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            // Recargar la página después de un breve período de tiempo
                            location.reload();
                        });
                    } else if (response.error) {
                        // Mostrar mensaje de error utilizando SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de solicitud AJAX
                    console.error(xhr.responseText);
                }
            });
        });

        $('#recuperarClaveForm').submit(function(e) {
            e.preventDefault(); // Evitar el envío del formulario

            // Realizar una solicitud AJAX para enviar los datos del formulario
            $.ajax({
                type: 'POST',
                url: $(this).attr(
                    'action'), // URL del controlador y método de recuperación de contraseña
                data: $(this).serialize(), // Datos del formulario serializados
                dataType: 'json', // Esperar una respuesta JSON
                success: function(response) {
                    // Verificar si la respuesta contiene un mensaje de éxito
                    if (response.success) {
                        // Mostrar mensaje de éxito utilizando SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: '¡Contraseña cambiada con éxito!',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            // Cerrar el modal de recuperación de contraseña
                            $('#recuperarClaveModal').modal('hide');
                            // Limpiar los campos del formulario
                            $('#usuarioRecuperar').val('');
                            $('#correoRecuperar').val('');
                            $('#nuevaClave').val('');
                            $('#inicioSesionModal').modal('show');
                        });
                    } else if (response.error) {
                        // Mostrar mensaje de error utilizando SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de solicitud AJAX
                    console.error(xhr.responseText);
                }
            });
        });


        function limpiarCamposRegistro() {
            $('#registro-form input[type="text"]').val('');
            $('#registro-form input[type="email"]').val('');
            $('#registro-form input[type="password"]').val('');
            $('#celular').val('');
        }

        // Cuando se hace clic en el botón de incrementar
        $(document).on('click', ".increment-btn", function() {
            var input = $(this).siblings('.product-quantity');
            var newValue = parseInt(input.val()) + 1;
            input.val(newValue);

            // Agregar clase para resaltar el botón
            $(this).addClass('btn-highlight');

            // Quitar clase después de un tiempo para deshacer el resaltado
            setTimeout(function() {
                $(".increment-btn").removeClass('btn-highlight');
            }, 300); // Ajustar el tiempo en milisegundos según sea necesario
        });

        // Cuando se hace clic en el botón de restar
        $(document).on('click', '.decrement-btn', function() {
            var input = $(this).siblings('.product-quantity');
            var newValue = parseInt(input.val()) - 1;
            if (newValue >= parseInt(input.attr('min'))) {
                input.val(newValue);

                // Agregar clase para resaltar el botón
                $(this).addClass('btn-highlight');

                // Quitar clase después de un tiempo para deshacer el resaltado
                setTimeout(function() {
                    $(".decrement-btn").removeClass('btn-highlight');
                }, 300); // Ajustar el tiempo en milisegundos según sea necesario
            }
        });

    });
    </script>
    <script>
    // Define una variable JavaScript con el valor de base_url
    var base_url = "<?php echo base_url(); ?>";
    </script>
    <script src="<?= base_url('public/assets/tienda/js/carrito/carrito.js') ?>"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    <script>
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        autoplay: {
            delay: 4000,
            pauseOnMouseEnter: false,
        },

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },


    });
    </script>
    <script>
    // Vaciar carrito en tiempo real desde cualquier botón .vaciar
    $(document).on('click', '.vaciar', function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Vaciar carrito?',
            text: '¿Estás seguro de que deseas eliminar todos los productos del carrito?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, vaciar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                if (typeof carrito !== "undefined") {
                    carrito = [];
                }
                localStorage.removeItem('carrito');
                if (typeof actualizarVistaCarrito === "function") {
                    actualizarVistaCarrito();
                }
                $(".cart-summary small").text("0 Producto(s) seleccionados");
                $(".cart-summary h5").text("SUBTOTAL: S/0.00");
                $(".dropdown-toggle .qty").text("0");
                $(".sidebar_prueba .cart-list").empty();
                $(".sidebar_prueba .cart-summary small").text("0 Producto(s) seleccionados");
                $(".sidebar_prueba .cart-summary h5").text("SUBTOTAL: S/0.00");
                // Lanzar evento personalizado para otras vistas (como la página de carrito)
                document.dispatchEvent(new Event('carritoVaciado'));
                Swal.fire('¡Carrito vaciado!', '', 'success');
            }
        });
    });
    </script>
</body>

</html>