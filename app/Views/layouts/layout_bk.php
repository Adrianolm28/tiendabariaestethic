    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tienda Bariaestethic</title> 
        <meta name="description" content="Compra en línea en Valeapp. Ofrecemos una amplia gama de productos de calidad, desde electrónica hasta moda. ¡Visita nuestra tienda virtual ahora!">
        <meta name="keywords" content="tienda en línea, ecommerce, compra en línea, productos de calidad, mejores precios, electrónica, moda, Valeapp">
        <meta name="author" content="Valeapp">
        <meta name="robots" content="index, follow">
        <meta name="googlebot" content="index, follow">
        <link rel="icon" href="<?= base_url('public/assets/tienda/img/favvale.ico') ?>" type="image/x-icon" />
        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/bootstrap.min.css') ?>">
        <!-- Slick -->
        <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/slick.css') ?>">
        <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/slick-theme.css') ?>">
        <!-- nouislider -->
        <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/nouislider.min.css') ?>">
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/font-awesome.min.css') ?>">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/style.css') ?>">
        <!-- datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" />


        <link rel="stylesheet" href="<?= base_url('public/assets/whatsapp/plugin/components/Font Awesome/css/font-awesome.min.css') ?>" />
        <link rel="stylesheet" href=" <?= base_url('public/assets/whatsapp/plugin/whatsapp-chat-support.css') ?>" />



        <script src="<?= base_url('public/assets/tienda/js/jquery.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/tienda/js/bootstrap.min.js') ?>"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://kit.fontawesome.com/3708c7cfc7.js" crossorigin="anonymous"></script>



        <style>
            #user-dropdown-content {
                display: none;
                position: absolute;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 15px;
                z-index: 1000;
                box-shadow: 0px 0px 0px 2px #E4E7ED;
                margin-top: 10px;
            }

            #ver-compras-btn {
                background-color: #5bc0de;
                /* Color celeste */
                color: #fff;
                /* Color del texto */
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }

            #ver-compras-btn:hover {
                background-color: #46b8da;
                /* Cambio de color al pasar el mouse */
            }

            body {
                margin: 0;
            }

            .swiper {
                width: 100%;
                max-width: 1600px;
            }

            img .img-swiper {
                height: 225px;
                width: 100%;
                object-fit: cover;
            }

            @media (min-width: 1024px) {
                img .img-swiper {
                    height: 1344px;

                }
            }

            .swiper .swiper-button-prev,
            .swiper .swiper-button-next {
                --swiper-navigation-size: 20px;
                background-color: white;
                height: 70px;
                width: 50px;
                margin-top: -35px;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .swiper .swiper-button-prev {
                border-radius: 0 65px 65px 0;
                left: -10px;
            }

            .swiper .swiper-button-next {
                border-radius: 65px 0 0 65px;
                right: -10px;
            }

            .swiper:hover .swiper-button-prev,
            .swiper:hover .swiper-button-next {
                opacity: 1;
                ;
            }

            .swiper .swiper-pagination {
                --swiper-pagination-color: white;
                --swiper-pagination-bullet-size: 6px;
                --swiper-pagination-bullet-inactive-color: #000;
                --swiper-pagination-bullet-inactive-opacity: 0.25;
                --swiper-pagination-bullet-opacity: 1;
                --swiper-pagination-bullet-horizontal-gap: 2px;

            }

            .swiper .swiper-pagination-bullet {
                box-shadow: inset 0 0 0 1px #fff;
            }

            .swiper .swiper-pagination-bulletd-active {
                box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.25);
            }

            .swiper img {
                width: 100%;

                height: auto;

            }

            /* autocpmplete */

            #searchSuggestions {
                position: absolute;
                z-index: 999;
                background-color: #fff;
                border: 1px solid #ccc;
                /* Borde para separar del contenido */
                width: 100%;
                /* Ocupar todo el ancho */
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                /* Sombra para resaltar */
                padding: 10px;
                /* Espacio interno */
                display: none;
                /* Ocultar inicialmente */
            }

            .search-suggestion {
                cursor: pointer;

                padding: 5px 0;

            }

            .search-suggestion:hover {
                background-color: #f0f0f0;

            }

            #searchSuggestions {
                position: absolute;
                z-index: 999;
                background-color: #fff;
                border: 1px solid #ccc;
                width: 100%;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                padding: 10px;
                display: none;
                max-height: 200px;
                /* Altura máxima del contenedor */
                overflow-y: auto;
                font-weight: bold;
                /* Habilitar el desplazamiento vertical */
            }







            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {

                color: #666;
            }

            .form-group input[type=text],
            .form-group input[type=email],
            .form-group input[type=password],
            .form-group input[type=tel] {
                width: 100%;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ddd;

            }

            .checkbox label,
            .checkbox input {
                display: inline-block
            }

            .checkbox input {
                margin-right: 10px
            }

            .button-container {
                text-align: center
            }

            .button-container button {
                background-color: #ff6a00;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16 px
            }

            .form-control {
                background-color: #f0f0f0;

            }

            .col-form-labe {
                color: #7b6d6d;

            }

            .title-register {
                color: #f88939;
            }

            .parrf_login {
                color: #000;
                font-weight: bold;
            }

            .btn-login {
                background-color: #f88939;
                padding: 10px;
                border: none;
                border-radius: 20px;
                font-weight: bolder;
                font-size: 20px;
            }

            .modal-lg {
                max-width: 80%;

            }

            .modal-content {
                border-radius: 15px;

                padding: 20px;

            }

            @media (max-width: 768px) {
                .modal-lg {
                    max-width: 95%;
                    /* Reducir el ancho máximo para pantallas más pequeñas */
                }
            }

            /* Estilos específicos del sidebar */

            .sidebar_prueba {
                position: fixed;
                top: 0;
                bottom: 0;
                right: -300px;
                width: 300px;
                background-color: #fff;
                overflow-y: auto;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                transition: right 0.3s;
                z-index: 9999;
                pointer-events: auto;
                display: flex;
            }

            .sidebar_prueba .cart-list {
                background-color: #f9f9f9;
                padding: 10px;
                overflow-y: auto;
                background-color: #f9f9f9;
                /* Fondo ligeramente diferente */
            }

            .sidebar_prueba .product-widget {
                background-color: #f0f0f0;
                /* Fondo de cada producto diferente */
            }

            .sidebar_prueba .cart-summary {
                width: 100%;
                background-color: #e9e9e9;
                padding: 10px;

                position: sticky;
                bottom: 0;


            }

            /* Estilos específicos para el contenedor de botones */
            .sidebar_prueba .btn-group.d-flex {
                display: flex;

            }

            .sidebar_prueba .btn-group.d-flex .btn-primary {
                background-color: #f88939;
                color: #fff;
                width: 100%;
                padding: 5px;


            }


            .sidebar_prueba .btn-group.d-flex .btn-primary:hover {
                background-color: #e67227;
                /* Cambia el color de fondo cuando se pasa el mouse sobre el botón "Ver Carrito" */
            }


            /* Estilos para la capa de superposición */
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 9998;
                display: none;
            }


            .sidebar_active .overlay {
                display: block;
            }

            body.sidebar_active {
                overflow: hidden;

            }

            .header-logo {
                margin-left: -100px;

                padding-left: -100px;

            }

            @media (min-width: 768px) {

                /* Pantallas medianas y más grandes */
                .header-menu {
                    display: block;
                    /* Asegura que se muestra en pantallas más grandes */
                    margin-left: -300px;
                    padding-left: -300px;
                }
            }

            @media (min-width: 768px) {


                .header-logo {
                    margin-left: -50px;

                    padding-left: 0;
                }
            }

            @media (min-width: 992px) {

                .header-logo {
                    margin-left: -100px;

                    padding-left: 0;
                }
            }

            @media (max-width: 767px) {


                .header-logo {
                    margin-left: 0;

                    text-align: center;
                }
            }

            @media (max-width: 767px) {
                .men {
                    display: none;
                }

            }

            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                transition: .4s;
                border-radius: 34px;

            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                transition: .4s;
                border-radius: 50%;
                background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR82b1NCIAwkjcEnBl3Ri5-avqbNUwTyYQI_A&s');
                background-size: cover;
            }

            input:checked+.slider {
                background-color: #2196F3;
            }

            input:checked+.slider:before {
                transform: translateX(26px);
            }

            .slider.round {
                border-radius: 34px;

            }

            .slider.round:before {
                border-radius: 50%;

            }

            input[type="checkbox"]:checked+.slider:before {
                background-image: url('https://yt3.googleusercontent.com/XM8sH4UTRb5kyIL8QceSY9dbXKhyvCX6kqYsY3rHPkAwxI30ikkiYdnyNG10cba-wMfZX9po=s900-c-k-c0x00ffffff-no-rj');
                /* Imagen para cuando el checkbox no está marcado */
            }

            .listas_1 .enlace_link {
                margin: 3px;
                font-weight: bold;
                font-size: 12px;
            }


            .nav-tabs .nav-link.active {
                background-color: #FF6E00;
                color: #fff;
            }

            .nav-tabs .nav-link {
                background-color: #eee;
                color: #808080;

            }

            /* menu */
            #menu-dropdown {
                display: none;
                position: absolute;
                top: 200;
                left: 0;
                background-color: #f8f8f8;
                border: 1px solid #ccc;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                width: 100%;
                height: 700px;
                padding: 10px;
                z-index: 9999;
            }

            #menu-dropdown ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
                width: 20%;
            }

            #menu-dropdown ul li {
                padding: 5px 0;
                margin-right: 5px;
            }

            #menu-dropdown ul li a {
                text-decoration: none;
                color: #333;
                display: block;
                padding: 5px 10px;
            }

            #menu-dropdown ul li a:hover {
                color: #f19106;
            }

            #menu-dropdown ul li a:hover {
                color: #f19106;
            }

        
        

            .submenu-columns {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                /* Tres columnas iguales */
                gap: 20px;

            }

            .menu-content {
                display: flex;
                height: 100%;
            }


            .submenu-columns .column {
                list-style-type: none;
                padding: 0;
                margin: 0;
            }

            .submenu-columns .column ul li {
                padding: 10px 0;

            }

            .submenu-columns .column ul li a {
                text-decoration: none;
                color: #333;
                display: block;
            }

            .submenu-columns .column ul li a:hover {
                color: #f19106;
            }

            .iconsito {
                color: #e67227;
                font-size: 20px;
                margin-right: 8px;
            }

            .submenu-header {
                border-radius: 20px;
                text-align: center;
            }

            .submenu-header {
                text-decoration: underline;
                text-decoration-color: #FF6E00;

                text-underline-offset: 4px;

            }


            .submenu-title {
                margin: 0;
                /* Eliminar márgenes predeterminados */
                font-size: 1.1em;
                /* Tamaño de fuente del título */
                color: #333;
                /* Color del texto */
                line-height: 1.2;
                margin-bottom: 10px;
            }

            /* .submenu-derecho {
                display: none;
                position: absolute;
                top: 0;
                left: 290%;
                background-color: #fff;
                box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
                z-index: 1000;
                padding: 20px;
                min-width: 300px;
                border-radius: 10px;
            } */

            .submenu-derecho .submenu-columns {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                /* Cuatro columnas */
                gap: 20px;
                /* Espacio entre columnas */
                margin-top: 12px;
                overflow: hidden;
                /* Ocultar cualquier exceso de contenido */
            }

            .producto-item {
                text-align: center;
            }

            .producto-imagen {
                width: 100px;
                height: 100px;
                object-fit: cover;
                border-radius: 50%;
            }

            .producto-nombre {
                margin-top: 10px;
                font-size: 10px;
            }

            /* menu2 */
        </style>

    </head>

    <body>
        <!-- sidebard carrito -->
        <div class="overlay"></div>

        <!-- Anuncion -->




        <ul class="nav nav-tabs listas_1">

            <li class="nav-item lista_links">
                <a class="nav-link enlace_link " href="<?php echo base_url('/'); ?>">Mi Página Web <img style="width: 20px;" src="<?php echo base_url('public/assets/tienda/img/casa-gris.png'); ?>" alt=""></a>

            <li class="nav-item lista_links">
                <a class="nav-link enlace_link active" href="<?php echo base_url('/tienda'); ?>">Tienda Virtual <img style="width: 20px;" src="<?php echo base_url('public/assets/tienda/img/web_icon_white.png'); ?>" alt=""></a>
            </li>


        </ul>


        <header>

            <!-- links tienda y pagina  -->



            <!-- TOP HEADER -->
            <div id="top-header">
                <div class="container">
                    <ul class="header-links pull-left">
                        <li><a href="#"><i class="fa fa-phone"></i> +51<?= $configTienda[0]['telefono'] ?></a></li>
                        <li><a href="#"><i class="fa fa-envelope-o"></i> <?= $configTienda[0]['correo'] ?></a></li>
                        <li><a href="https://maps.app.goo.gl/45cD8YELrgUQzeRJ9"><i class="fa fa-map-marker"></i><?= $configTienda[0]['direccion'] ?></a></li>
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
                            <!-- <div id="user-dropdown-content">
                                <?php if (!empty($userData)) : ?>
                                    <a id="ver-compras-btn" href="<?= base_url('tienda/clientecompra/' . $userData['id_usuario']) ?>">
                                        <i class="fa fa-shopping-cart"></i> Ver Compras
                                    </a>
                                <?php endif; ?>
                            </div> -->


                        </li>
                        <?php if (empty($userData)) : ?>
                            <!-- Mostrar este enlace solo si no hay una sesión iniciada -->
                            <li><a href="#" data-toggle="modal" data-target="#registroModal"><i class="fa fa-lock"></i> Registrarse</a></li>

                            <li><a href="#" data-toggle="modal" data-target="#inicioSesionModal"><i class="fa fa-sign-in"></i> Iniciar sesión</a></li>
                        <?php else : ?>

                            <li><a href="<?php echo site_url('usuarios/cerrarSesion'); ?>"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>



            <!-- /TOP HEADER -->

            <!-- MAIN HEADER -->
            <div id="header">

                <!--   -->
                <!-- container -->
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <!-- LOGO -->
                        <div class="col-md-3">
                            <div class="header-logo">
                                <a href="<?php echo base_url('/'); ?>" class="logo">
                                    <img style="width: 160px; height: 43px;     margin-top: 10px;" src="<?= base_url('public/assets/tienda/img/logo-inner.png') ?>" alt="">
                                    <!-- <img src="./img/logo.png" alt=""> -->
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
                        <div class="col-md-5">
                            <div class="header-search">

                                <form id="searchForm">
                                    <!--  <select class="input-select">
                                        <option value="0">All Categories</option>
                                        <option value="1">Category 01</option>
                                        <option value="1">Category 02</option>
                                    </select> -->
                                    <input id="searchInput" class="input" placeholder="Buscar Aquí">
                                    <input type="hidden" id="idProducto" name="idProducto">
                                    <button style="background-color: #f19106;" type="#" class="search-btn"><i class="fa fa-search"></i></button>
                                    <div id="searchSuggestions"></div>
                                </form>
                            </div>
                        </div>
                        <!-- /SEARCH BAR -->



                        <!-- ACCOUNT -->
                        <div class="col-md-3 clearfix">
                            <div class="header-ctn">
                                <!-- Wishlist -->
                                <div>
                                    <?php if (!empty($userData)) : ?>
                                        <a href="<?= base_url('tienda/clientecompra/' . $userData['id_usuario']) ?>">
                                            <i class="fa fa-money"></i>
                                            <span>Compras</span>
                                            <!--  <div class="qty">2</div> -->
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <!-- /Wishlist -->
                                <!--  id="sidebar_car" 
                                data-toggle="dropdown"
                                -->
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
                                        

                                <div class="sidebar_prueba">
                                    <div class="cart-list">
                                        <!-- Contenido del carrito aquí -->
                                    </div>
                                    <div class="cart-summary">
                                        <small>0 Producto(s) seleccionados</small>
                                        <h5>SUBTOTAL: S/0.00</h5>
                                        <div class="btn-group d-flex" role="group">
                                            <button class="btn btn-sm btn-danger flex-fill vaciar">Vaciar</button>
                                            <a href="<?= base_url('tienda/carrito') ?>" class="btn btn-sm btn-primary flex-fill">Ver Carrito</a>
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
        <!-- <?php print_r($subcategoria_productos); ?> -->
        <!-- Menú desplegable -->
        <div id="menu-dropdown" class="menu-dropdown">
            <div class="menu-content">
                <ul class="menu-items">
                    <div class="submenu-header">
                        <h3 class="submenu-title">Categorias</h3>
                    </div>
                    <?php foreach ($categorias_productos as $categoria) : ?>
                        <li>
                            <a href="#" data-submenu="submenu-<?php echo $categoria['id_categoria']; ?>" id="<?php echo $categoria['id_categoria']; ?>">
                                <?php
                                // Definir el ícono según el ID de la categoría
                                $iconClass = '';
                                switch ($categoria['id_categoria']) {
                                    case 1: // Tecnología
                                        $iconClass = 'fas fa-laptop';
                                        break;
                                    case 2: // Celulares
                                        $iconClass = 'fas fa-mobile-alt';
                                        break;
                                    case 3: // Automotriz
                                        $iconClass = 'fas fa-car';
                                        break;
                                    case 4: // Suministros
                                        $iconClass = 'fas fa-box';
                                        break;
                                    case 5: // All in one
                                        $iconClass = 'fas fa-cube';
                                        break;
                                    case 6: // Laptops
                                        $iconClass = 'fas fa-laptop';
                                        break;
                                    case 7: // Impresoras
                                        $iconClass = 'fas fa-print';
                                        break;
                                    case 8: // Muebles
                                        $iconClass = 'fas fa-chair';
                                        break;
                                    default:
                                        $iconClass = 'fas fa-question'; // Ícono por defecto
                                        break;
                                }
                                ?>
                                <i class="<?php echo $iconClass; ?> iconsito"></i> <?php echo $categoria['nombre']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>

                </ul>



                <?php foreach ($categorias_productos as $categoria) : ?>
                    <div id="submenu-<?php echo $categoria['id_categoria']; ?>" class="submenu">
                        <div class="submenu-header">
                            <h3 class="submenu-title"><?php echo $categoria['nombre']; ?></h3>
                        </div>
                        <div class="submenu-columns">
                            <!-- Aquí puedes iterar sobre las subcategorías de cada categoría si es necesario -->
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Agrega más submenús según sea necesario -->


                <!-- Submenú adicional que se mostrará a la derecha -->
                <?php foreach ($subcategoria_productos as $sub_categoria) : ?>
                    <div id="submenu-derecho-<?php echo $sub_categoria['id_subcategoria']; ?>" class="submenu-derecho">
                        <div class="submenu-header">
                            <h5 class="submenu-title"><?php echo $sub_categoria['nombre']; ?></h5>
                        </div>
                        <div class="submenu-columns">
                            <!-- Aquí se iterarán los productos mediante AJAX -->
                        </div>


                    </div>
                <?php endforeach; ?>




            </div>
        </div>

        <!--  <div id="sidebarMenu" class="sidebar-menu">
            <div class="menu-content">
                <ul class="categories">
                    <?php foreach ($categorias_productos as $categoria) : ?>
                        <li class="category">
                            <?php
                            // Definir el ícono según el ID de la categoría
                            $iconClass = '';
                            switch ($categoria['id_categoria']) {
                                case 1: // Tecnología
                                    $iconClass = 'fas fa-laptop';
                                    break;
                                case 2: // Celulares
                                    $iconClass = 'fas fa-mobile-alt';
                                    break;
                                case 3: // Automotriz
                                    $iconClass = 'fas fa-car';
                                    break;
                                case 4: // Suministros
                                    $iconClass = 'fas fa-box';
                                    break;
                                case 5: // All in one
                                    $iconClass = 'fas fa-cube';
                                    break;
                                case 6: // Laptops
                                    $iconClass = 'fas fa-laptop';
                                    break;
                                case 7: // Impresoras
                                    $iconClass = 'fas fa-print';
                                    break;
                                case 8: // Muebles
                                    $iconClass = 'fas fa-chair';
                                    break;
                                default:
                                    $iconClass = 'fas fa-question'; // Ícono por defecto
                                    break;
                            }
                            ?>
                            <a href="#" class="category-title" data-subcategories="subcategory-<?php echo $categoria['id_categoria']; ?>"><i class="<?php echo $iconClass; ?> iconsito"></i> <?php echo $categoria['nombre']; ?></a>
                        </li>
                    <?php endforeach; ?>

                </ul>

                <div class="subcategories-container">
                    <?php foreach ($subcategoria_productos as $sub_categoria) : ?>
                        <ul id="subcategory-<?php echo $sub_categoria['id_subcategoria']; ?>" class="sub-categories">
                            <li class="sub-category"><a href="#" class="sub-category-title" data-products="products-1"><?php echo $sub_categoria['nombre']; ?></a></li>

                        </ul>

                    <?php endforeach; ?>
                </div>

                <div class="products-container">
                    <?php foreach ($subcategoria_productos as $sub_categoria) : ?>
                        <ul id="products-<?php echo $sub_categoria['id_subcategoria']; ?>" class="products">
                            <li class="product"><a href="#"><?php echo $sub_categoria['nombre']; ?></a></li>

                        </ul>


                    <?php endforeach; ?>
                </div>
            </div>
        </div> -->


        <nav id="navigation">
            <!-- container -->
            <div class="container">
                <!-- responsive-nav -->
                <div id="responsive-nav">
                    <!-- NAV -->
                    <ul class="main-nav nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url('/tienda'); ?>">Inicio</a></li>
                        <li><a href="<?php echo base_url('/shop'); ?>">Tienda</a></li>
                        <li><a href="<?php echo base_url('/tienda/carrito'); ?>">Ver Carrito</a></li>
                        <li><a href="<?php echo base_url('/contacto'); ?>">Contactanos</a></li>

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
                    <strong>Servicio al cliente</strong>

                    <div class="wcs_popup_header_description">
                        Chatea con nosotros en Whatsapp
                    </div>
                </div>
                <div class="wcs_popup_input" data-number="51936237541" data-availability='{ "monday":"07:00-22:30", "tuesday":"07:00-22:30", "wednesday":"07:00-22:30", "thursday":"07:00-22:30", "friday":"07:00-22:30", "saturday":"09:00-18:30", "sunday":"09:00-22:30" }'>
                    <img style="width: 40px" src="<?= base_url('public/assets/whatsapp/plugin/components/image/ico_admi.png') ?>" alt="" />
                    <sub style="display: inline-block; vertical-align: top; left: -7px; font-weight: bold;">Cobranza</sub>
                    <input type="text" placeholder="Escribir pregunta!" />
                    <i class="fa fa-play"></i>
                </div>
                <div class="wcs_popup_input" data-number="51924025059" data-availability='{ "monday":"07:00-22:30", "tuesday":"07:00-22:30", "wednesday":"07:00-22:30", "thursday":"07:00-22:30", "friday":"07:00-22:30", "saturday":"09:00-18:30", "sunday":"09:00-22:30" }'>
                    <img style="width: 40px" src="<?= base_url('public/assets/whatsapp/plugin/components/image/ico_soporte.png') ?>" alt="" />
                    <sub style="display: inline-block; vertical-align: top; left: -7px; font-weight: bold;">Soporte</sub>
                    <input type="text" placeholder="Escribir pregunta!" />
                    <i class="fa fa-play"></i>
                </div>
                <div class="wcs_popup_input" data-number="51937292341" data-availability='{ "monday":"07:00-22:30", "tuesday":"07:00-22:30", "wednesday":"07:00-22:30", "thursday":"07:00-22:30", "friday":"07:00-22:30", "saturday":"09:00-18:30", "sunday":"09:00-22:30" }'>
                    <img style="width: 40px" src="<?= base_url('public/assets/whatsapp/plugin/components/image/ico_ventas.png') ?>" alt="" />
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
                                    <li><a href="#"><i class="fa fa-map-marker"></i><?= $configTienda[0]['direccion'] ?></a></li>
                                    <li><a href="#"><i class="fa fa-phone"></i><?= $configTienda[0]['telefono'] ?></a></li>
                                    <li><a href="#"><i class="fa fa-envelope-o"></i><?= $configTienda[0]['correo'] ?></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <h3 class="footer-title">Categorias</h3>
                                <ul class="footer-links">
                                    <?php foreach ($categoriasFooter as $cf) : ?>
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
                                    <li><a>Nosotros</a></li>
                                    <li><a href="<?php echo base_url('/contacto'); ?>">Contactanos</a></li>
                                    <li><a href="#">Politicas de Privacidad</a></li>

                                    <li><a href="#">Terminos y Condiciones</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6">
                            <div class="footer">
                                <a href="<?php echo base_url('/lreclamaciones'); ?>">
                                    <img style="width: 200px;" src="<?= base_url('public/assets/image/libroreclamaciones.jpg') ?>" alt="">
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
                                <a target="_blank" href="https://www.templateshub.net">Templates Hub</a>
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



    
    

        <!-- jQuery Plugins -->
        <!-- Enlace para abrir el modal -->


        <!-- Modal de Registro -->



        <div class="modal fade" id="registroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <p class="parrf_login">Ingresa tus datos personales y disfruta de una experiencia de compra más rápida.</p>
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
                                            <input name="contacto" type="text" class="form-control" id="contacto" placeholder="Ingrese DNI" maxlength="8">
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
                                    Acepto los <a href="https://valeapp24.blogspot.com/2024/04/terminos-y-condiciones-de-politica-y.html" target="_blank">términos y condiciones y politica de privacidad</a>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="agregarTerminos2">
                                <label class="form-check-label" for="agregarTerminos2">
                                    Autorizo los <a href="https://valeapp24.blogspot.com/2024/04/terminos-y-condiciones-de-politica-y.html" target="_blank">fines adicionales</a> de tratamiento de mis datos
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#recuperarClaveModal">¿Olvidaste tu contraseña?</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-login" id="guardarUsuario" disabled>Crear Cuenta</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <!-- Modal de inicio de sesión -->
        <div class="modal fade" id="inicioSesionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form id="inicioSesionForm" action="<?php echo site_url('usuarios/iniciarSesion'); ?>" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Correo electrónico o teléfono" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                            <div class="text-center mt-3">
                                <a href="#" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#registroModal">¿No tienes una cuenta? Registrarse</a>
                            </div>
                            <hr>
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-link" data-dismiss="modal" data-toggle="modal" data-target="#recuperarClaveModal">¿Olvidaste tu contraseña?</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade" id="recuperarClaveModal" tabindex="-1" role="dialog" aria-labelledby="recuperarClaveModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="recuperarClaveModalLabel">Recuperar contraseña</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="recuperarClaveForm" action="<?php echo site_url('usuarios/recuperarClave'); ?>" method="POST">
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







        <script src="<?= base_url('public/assets/tienda/js/slick.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/tienda/js/nouislider.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/tienda/js/jquery.zoom.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/tienda/js/main.js') ?>"></script>


        <!--  -->

        <script src="<?= base_url('public/assets/whatsapp/plugin/components/jQuery/jquery-1.11.3.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/whatsapp/plugin/components/moment/moment.min.js') ?>"></script>
        <script src="<?= base_url('public/assets/whatsapp/plugin/components/moment/moment-timezone-with-data.min.js') ?>"></script>

        <script src="<?= base_url('public/assets/whatsapp/plugin/whatsapp-chat-support.js') ?>"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.js"></script> -->
        <script>
        



            function cerrarSubmenus() {
                $('.submenu, .submenu-derecho').hide();
            }

            $(document).ready(function() {

                //whatsapp
                $("#button-w").whatsappChatSupport({
                    defaultMsg: ""
                });

                /* menu */

                $('#menu-toggle').click(function(e) {
                    e.preventDefault();
                    $('#menu-dropdown').toggle();

                
                });

                // Mostrar submenú al pasar el mouse sobre el elemento principal
                /* $('#menu-dropdown ul li a').on('mouseenter', function(e) { */
                $('#menu-dropdown ul li a').on('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var submenuId = $(this).data('submenu');
                    var categoriaId = $(this).attr('id');

                    // Ocultar todos los submenús y submenús adicionales a la derecha
                    $('.submenu').hide();
                    $('.submenu-derecho').hide();

                    // Mostrar el submenú correspondiente
                    $('#' + submenuId).show();

                    // Obtener y posicionar los submenús adicionales a la derecha
                    var submenuWidth = $('#' + submenuId).outerWidth();
                    var submenusDerechos = $('#' + submenuId).find('.submenu-derecho');
                    submenusDerechos.each(function() {
                        $(this).css('left', submenuWidth + 'px');
                    });

                    // Realizar la petición AJAX para cargar las subcategorías
                    $.ajax({
                        url: '<?= base_url('productos/obtenerSubcategorias') ?>',
                        type: 'POST',
                        data: {
                            categoria_id: categoriaId
                        },
                        success: function(response) {
                            if (response.status) {
                                // Limpiar el submenú actual
                                $('#' + submenuId + ' .submenu-columns').empty();

                                // Construir el nuevo submenú con las subcategorías obtenidas
                                var columnsHtml = '';
                                var subcategories = response.data;
                                var itemsPerColumn = 7;
                                var numColumns = Math.ceil(subcategories.length / itemsPerColumn);

                                for (var i = 0; i < numColumns; i++) {
                                    columnsHtml += '<div class="column"><ul>';
                                    for (var j = 0; j < itemsPerColumn; j++) {
                                        var index = i * itemsPerColumn + j;
                                        if (index < subcategories.length) {
                                            columnsHtml += '<li><a href="#" data-subcategoria-id="' + subcategories[index].id_subcategoria + '">' + subcategories[index].nombre + '</a></li>';
                                        }
                                    }
                                    columnsHtml += '</ul></div>';
                                }

                                // Añadir las columnas al submenú
                                $('#' + submenuId + ' .submenu-columns').append(columnsHtml);
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Ocurrió un error al cargar las subcategorías. Por favor, inténtalo de nuevo.');
                        }
                    });
                });





                $(document).on('click', function(event) {
                    // Verificar si se hizo clic dentro del menú o en un elemento del menú
                    var isClickedInsideMenu = $(event.target).closest('#menu-dropdown').length > 0;
                    if (!isClickedInsideMenu) {
                        cerrarSubmenus();
                    }
                });


                function actualizarSubmenuDerecho(subcategoriaId, productos) {
                    var submenuDerecho = $('#submenu-derecho-' + subcategoriaId + ' .submenu-columns');
                    submenuDerecho.empty(); // Limpiar el contenido anterior del submenú

                    // Limitar el número de productos a mostrar a un máximo de 12
                    productos.slice(0, 12).forEach(function(producto) {
                        // Obtener las imágenes adicionales
                        var imagenesAdicionales = producto.imagenes_adicionales.split('<img src="').slice(1).map(function(img) {
                            return img.split('" alt="')[0];
                        });

                        // Construir el HTML para cada producto
                        var productoHtml = `
                        <a href="tienda/verproducto/${producto.id_producto}">
                    <div class="producto-container" data-id="${producto.id_producto}">
                        <div class="producto-item">
                            <img src="public/assets/img_tienda/productos/${producto.imagen_producto}" alt="${producto.nombre}" class="producto-imagen">
                            <div class="producto-info">
                                <p class="producto-nombre">${producto.nombre}</p>
                            </div>
                        </div>
                    </div>
                    </a>
                `;
                        submenuDerecho.append(productoHtml);
                    });
                }


                /* $(document).on('mouseenter', '.submenu a', function(e) { */
                $(document).on('click', '.submenu a', function(e) {
                    e.preventDefault();
                    var subcategoriaId = $(this).data('subcategoria-id');

                    $('.submenu-derecho').hide();

                    $('#submenu-derecho-' + subcategoriaId).show();
                    // Aquí puedes redirigir o filtrar según el ID de la subcategoría
                    console.log("Subcategoría ID: " + subcategoriaId);

                    $.ajax({
                        url: '<?= base_url('productos/filtrarPorSubcategoria') ?>',
                        type: 'POST',
                        data: {
                            id_subcategoria: subcategoriaId
                        },
                        success: function(response) {

                            console.log(response);
                            // Suponiendo que el servidor devuelve los productos en JSON
                            if (response.status) {
                                var productos = response.data;
                                actualizarSubmenuDerecho(subcategoriaId, productos);
                            } else {
                                alert('No se encontraron productos para esta subcategoría.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Ocurrió un error al filtrar los productos. Por favor, inténtalo de nuevo.');
                        }
                    });

                });


                /* $(document).on('click', '.submenu-derecho .producto-container', function() {
                    var idProducto = $(this).data('id');
                    console.log('Se hizo clic en el producto con ID:', idProducto);

                
                });
    */
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
                                alert('Ocurrió un error al intentar cotizar. Por favor, inténtalo de nuevo.');
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
                    if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('#sidebar_car').length) {
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
                                suggestion.append('<span class="product-name">' + producto.nombre + '</span>');
                                // Agregar la imagen del producto con tamaño 50x50 px
                                suggestion.append('<img src="<?php echo base_url('public/assets/img_tienda/productos/'); ?>' + producto.imagen_producto + '" alt="' + producto.nombre + '" style="width: 50px; height: 50px;">');
                                suggestion.data('id_producto', producto.id_producto);
                                // Agregar evento click para manejar la selección del producto
                                suggestion.on('click', function() {
                                    var nombreProducto = $(this).find('.product-name').text();
                                    var idProducto = $(this).data('id_producto');

                                    $('#searchInput').val(nombreProducto);
                                    $('#idProducto').val(idProducto);

                                    console.log('obtneiendo id', idProducto);

                                    window.location.href = '<?php echo base_url('tienda/verproducto/'); ?>' + idProducto;
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



                /* $('#searchSuggestions').on('mouseleave', function() {
                
                    $(this).css('display', 'none');
                }); */


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

                /* function obtenerDatosDesdeSunac(dni) {
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
                                $('#nombre').val(response.RazonSocial);
                            } else {
                                console.log('Error al consultar el RUC en Sunac');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error al consultar el RUC en Sunac:', error);
                        }
                    });
                }
    */

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

                                $('#nombre').val(response.result.nombres + ' ' + response.result.apellido_pat + ' ' + response.result.apellido_mat);

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

                                $('#nombre_c').val(response.result.nombres + ' ' + response.result.apellido_pat + ' ' + response.result.apellido_mat);

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

                    // Realizar una solicitud AJAX para enviar los datos del formulario
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
                        url: $(this).attr('action'), // URL del controlador y método de recuperación de contraseña
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
    </body>

    </html>