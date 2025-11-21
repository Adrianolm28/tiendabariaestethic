<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Bariaestethic</title>
    <base href="<?php echo base_url('public') ?>/">

    <!-- Metaetiquetas adicionales -->
    <meta name="description" content="Tienda Bariaestethic">
    <meta name="keywords" content="Tienda Bariaestethic">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Valeapp">
    <link rel="canonical" href="https://tegnex.pe/">

    <!-- Open Graph Metadata -->
    <meta property="og:title" content="Tienda Bariaestethic">
    <meta property="og:description" content="Tienda Bariaestethic">
    <meta property="og:image" content="https://valeapp.pe/assets/tienda/img/og-image.png"> <!-- Aseg��rate de que esta URL sea correcta -->
    <meta property="og:url" content="https://tegnex.pe/">

    <!-- Font Awesome -->
    <link rel="icon" href="<?= base_url('public/assets/tienda/img/favvale.ico') ?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/venobox.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/precios.css">
    <script src="https://kit.fontawesome.com/3708c7cfc7.js" crossorigin="anonymous"></script>
    <!-- background-color: #FF6E00; -->
    <style>
        .nav .nav-tabs .listas_1 {
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }


        .listas_1 .enlace_link {
            margin: 4px;
            font-weight: bold;
            font-size: 14px;
        }

        .nav-tabs .nav-link.active {
            background-color: #FF6E00;
            color: #fff;
        }

        .nav-tabs .nav-link {
            background-color: #eee;
            color: #808080;

        }
    </style>
</head>

<?php
$validation = \Config\Services::validation();
?>
<!--   #FF6E00 -->

<body>

    <ul class="nav nav-tabs listas_1">

        <li class="nav-item lista_links">
            <a class="nav-link enlace_link active" href="<?php echo base_url('/'); ?>">Mi P&aacute;gina Web <img style="width: 20px;" src="<?php echo base_url('public/assets/tienda/img/iconotienda.png'); ?>" alt=""></a>
        </li>
        <li class="nav-item lista_links">
            <a class="nav-link enlace_link" href="<?php echo base_url('/tienda'); ?>">Tienda Virtual <img style="width: 20px;" src="<?php echo base_url('public/assets/tienda/img/web_icon_gris.png'); ?>" alt=""></a>
        </li>


    </ul>


    <header class="header">
        <div class="container">
            <div class="header-main">
                <div class="header-left">
                    <div class="hrader-left-item">
                        <div class="icon">
                            <span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.00006 8L9.78126 10.5208C11.1249 11.4165 12.8753 11.4165 14.2189 10.5208L18.0001 8M6.00006 21H18.0001C20.2092 21 22.0001 19.2091 22.0001 17V7C22.0001 4.79086 20.2092 3 18.0001 3H6.00006C3.79092 3 2.00006 4.79086 2.00006 7V17C2.00006 19.2091 3.79092 21 6.00006 21Z" stroke="#2662FA" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>

                        </div>

                        <div class="text">
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ventas@tegnex.pe" target="_blank">
                                <p>bariaestethic@mail.pe</p>
                            </a>
                        </div>
                    </div>
                    <div class="hrader-left-item">
                        <div class="icon">
                            <span> <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.0001 16L14.853 16.7354C15.1846 16.8018 15.5196 16.6379 15.6709 16.3354L15.0001 16ZM8.00006 9L7.66465 8.32918C7.36214 8.48043 7.1983 8.81544 7.26463 9.14709L8.00006 9ZM8.35408 8.82299L8.68949 9.49381L8.68949 9.49381L8.35408 8.82299ZM9.3166 6.29136L10.013 6.01281L9.3166 6.29136ZM8.50295 4.25722L7.80659 4.53576L8.50295 4.25722ZM19.7428 15.4971L19.4643 16.1935L19.7428 15.4971ZM17.7087 14.6835L17.9872 13.9871H17.9872L17.7087 14.6835ZM15.1771 15.646L15.8479 15.9814V15.9814L15.1771 15.646ZM16.2501 11C16.2501 11.4142 16.5858 11.75 17.0001 11.75C17.4143 11.75 17.7501 11.4142 17.7501 11H16.2501ZM16.6956 9.46927L17.3885 9.18225L16.6956 9.46927ZM14.5308 7.30448L14.8178 6.61157L14.5308 7.30448ZM13.0001 6.25C12.5858 6.25 12.2501 6.58579 12.2501 7C12.2501 7.41421 12.5858 7.75 13.0001 7.75V6.25ZM20.2501 11C20.2501 11.4142 20.5858 11.75 21.0001 11.75C21.4143 11.75 21.7501 11.4142 21.7501 11H20.2501ZM20.3911 7.93853L21.084 7.65152L20.3911 7.93853ZM16.0615 3.60896L16.3485 2.91605V2.91605L16.0615 3.60896ZM13.0001 2.25C12.5858 2.25 12.2501 2.58579 12.2501 3C12.2501 3.41421 12.5858 3.75 13.0001 3.75V2.25ZM20.2501 17.3541V19H21.7501V17.3541H20.2501ZM5.00006 3.75H6.646V2.25H5.00006V3.75ZM15.0001 16C15.1471 15.2646 15.1474 15.2646 15.1476 15.2646C15.1476 15.2647 15.1478 15.2647 15.1479 15.2647C15.1481 15.2648 15.1483 15.2648 15.1485 15.2648C15.1488 15.2649 15.1489 15.2649 15.1489 15.2649C15.1489 15.2649 15.1483 15.2648 15.1471 15.2645C15.1447 15.264 15.1401 15.2631 15.1332 15.2615C15.1194 15.2585 15.0968 15.2533 15.066 15.2459C15.0044 15.2309 14.9104 15.2066 14.7898 15.1711C14.5482 15.1 14.2017 14.9847 13.7955 14.8106C12.9796 14.461 11.944 13.8833 11.0304 12.9697L9.96973 14.0303C11.0561 15.1167 12.2705 15.789 13.2046 16.1894C13.6734 16.3903 14.0769 16.525 14.3666 16.6101C14.5116 16.6528 14.6285 16.6832 14.7115 16.7034C14.753 16.7135 14.786 16.721 14.8098 16.7263C14.8217 16.7289 14.8313 16.7309 14.8386 16.7325C14.8422 16.7332 14.8452 16.7339 14.8476 16.7343C14.8488 16.7346 14.8498 16.7348 14.8507 16.735C14.8512 16.7351 14.8516 16.7352 14.852 16.7352C14.8522 16.7353 14.8524 16.7353 14.8525 16.7353C14.8527 16.7354 14.853 16.7354 15.0001 16ZM11.0304 12.9697C10.1168 12.0561 9.53907 11.0204 9.18942 10.2046C9.01533 9.79836 8.90002 9.45184 8.82896 9.21025C8.79348 9.08962 8.76918 8.99565 8.7542 8.93406C8.74672 8.90329 8.74157 8.88065 8.73853 8.86687C8.73701 8.85999 8.73601 8.85532 8.73552 8.85296C8.73527 8.85178 8.73515 8.85118 8.73514 8.85117C8.73514 8.85116 8.73517 8.8513 8.73523 8.85159C8.73526 8.85174 8.7353 8.85192 8.73534 8.85214C8.73536 8.85225 8.7354 8.85244 8.73541 8.8525C8.73545 8.8527 8.7355 8.85291 8.00006 9C7.26463 9.14709 7.26467 9.14732 7.26472 9.14756C7.26474 9.14765 7.26479 9.1479 7.26483 9.14809C7.2649 9.14846 7.26498 9.14887 7.26507 9.14932C7.26526 9.15022 7.26547 9.15127 7.26572 9.15247C7.26621 9.15488 7.26684 9.15789 7.26759 9.1615C7.26911 9.16873 7.27117 9.17834 7.2738 9.19026C7.27906 9.21408 7.28661 9.2471 7.2967 9.28859C7.31688 9.37154 7.34727 9.48851 7.38991 9.6335C7.4751 9.92316 7.60979 10.3266 7.8107 10.7954C8.21105 11.7296 8.88331 12.9439 9.96973 14.0303L11.0304 12.9697ZM8.33547 9.67082L8.68949 9.49381L8.01867 8.15217L7.66465 8.32918L8.33547 9.67082ZM10.013 6.01281L9.19931 3.97868L7.80659 4.53576L8.62025 6.5699L10.013 6.01281ZM20.0214 14.8008L17.9872 13.9871L17.4302 15.3798L19.4643 16.1935L20.0214 14.8008ZM14.5062 15.3106L14.3292 15.6646L15.6709 16.3354L15.8479 15.9814L14.5062 15.3106ZM17.9872 13.9871C16.6593 13.4559 15.1459 14.0313 14.5062 15.3106L15.8479 15.9814C16.1386 15.3999 16.8265 15.1384 17.4302 15.3798L17.9872 13.9871ZM8.68949 9.49381C9.96874 8.85419 10.5441 7.34076 10.013 6.01281L8.62025 6.5699C8.86169 7.17351 8.60014 7.86143 8.01867 8.15217L8.68949 9.49381ZM6.646 3.75C7.15713 3.75 7.61676 4.06119 7.80659 4.53576L9.19931 3.97868C8.78168 2.93462 7.77048 2.25 6.646 2.25V3.75ZM21.7501 17.3541C21.7501 16.2296 21.0654 15.2184 20.0214 14.8008L19.4643 16.1935C19.9389 16.3833 20.2501 16.8429 20.2501 17.3541H21.7501ZM19.0001 20.25C10.5777 20.25 3.75006 13.4223 3.75006 5H2.25006C2.25006 14.2508 9.74929 21.75 19.0001 21.75V20.25ZM19.0001 21.75C20.5188 21.75 21.7501 20.5188 21.7501 19H20.2501C20.2501 19.6904 19.6904 20.25 19.0001 20.25V21.75ZM3.75006 5C3.75006 4.30964 4.30971 3.75 5.00006 3.75V2.25C3.48128 2.25 2.25006 3.48122 2.25006 5H3.75006ZM17.7501 11C17.7501 10.3762 17.6272 9.75855 17.3885 9.18225L16.0027 9.75628C16.166 10.1506 16.2501 10.5732 16.2501 11H17.7501ZM17.3885 9.18225C17.1498 8.60596 16.7999 8.08232 16.3588 7.64124L15.2982 8.7019C15.5999 9.00369 15.8393 9.36197 16.0027 9.75628L17.3885 9.18225ZM16.3588 7.64124C15.9177 7.20016 15.3941 6.85028 14.8178 6.61157L14.2438 7.99739C14.6381 8.16072 14.9964 8.40011 15.2982 8.7019L16.3588 7.64124ZM14.8178 6.61157C14.2415 6.37286 13.6238 6.25 13.0001 6.25V7.75C13.4269 7.75 13.8495 7.83406 14.2438 7.99739L14.8178 6.61157ZM21.7501 11C21.7501 9.85093 21.5237 8.71312 21.084 7.65152L19.6982 8.22554C20.0625 9.10516 20.2501 10.0479 20.2501 11H21.7501ZM21.084 7.65152C20.6443 6.58992 19.9998 5.62533 19.1872 4.81282L18.1266 5.87348C18.7998 6.5467 19.3338 7.34593 19.6982 8.22554L21.084 7.65152ZM19.1872 4.81282C18.3747 4.0003 17.4101 3.35578 16.3485 2.91605L15.7745 4.30187C16.6541 4.66622 17.4534 5.20025 18.1266 5.87348L19.1872 4.81282ZM16.3485 2.91605C15.2869 2.47633 14.1491 2.25 13.0001 2.25V3.75C13.9521 3.75 14.8949 3.93753 15.7745 4.30187L16.3485 2.91605Z" fill="#2662FA" />
                                </svg></span>

                        </div>
                        <div class="text">
                             <a href="https://wa.link/fryn84">+51 933696269</a>
                        </div>

                    </div>
                </div>



                <div class="header-right">

                    <div class="header-right-inner">
                        <div class="icon">
                            <a href="https://wa.link/fryn84"><i class="fa-brands fa-whatsapp"></i></a>
                            <a href="https://www.facebook.com/tegnexstore.pe"><i class="fa-brands fa-facebook"></i></a>
                            <a href="https://www.youtube.com/@corporaciontegnex7403" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                            <a href="https://www.tiktok.com/@tegnexstore?lang=es"><i class="fa-brands fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>



            </div>
        </div>





        <!-- menu part start -->


        <nav class="menu-bg">

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 menu-padding">

                        <div class="nav-main">
                            <div class="menu-main">
                                <div class="logo">
                                    <a href="<?php echo base_url('/'); ?>"> <img src="./assets/image/others/logo/logotegnex.png" alt="Logo de Valeapp - Plataforma de Facturaci��n Electr��nica" class="logotegnex"></a>
                                </div>


                                <div class="menu">





                                    <ul>
                                        <li><a href="<?php echo base_url('/#informacion'); ?>">Informacion</a></li>
                                        <li><a href="<?php echo base_url('/#opiniones'); ?>">Opiniones</a></li>
                                        <li><a href="<?php echo base_url('/#equipo_ventas'); ?>">Equipo de ventas</li>
                                        <li><a href="<?php echo base_url('/contacto'); ?>">Contacto </a></li>
                                        <!--   <li><a href="<?php echo base_url('#soluciones'); ?>">Nuestras sedes <i class="fa-sharp fa-solid fa-angle-down"></i> </a>



                                        </li>
                                        <li><a href="<?php echo base_url('#soporteSelect'); ?>"> Quienes somos<i class="fa-sharp fa-solid fa-angle-down"></i> </a>

                                            <ul>
                                                <li>
                                                    <a href="<?php echo base_url('#soporteSelect'); ?>">Soporte</a>
                                                </li>

                                            </ul>

                                        </li> -->
                                        <!-- <li><a class="blog_info" href="<?php echo base_url('/blog'); ?>">Blog <i class="fa-sharp fa-solid fa-angle-down"></i> </a>

                                             <ul>
                                                <li>
                                                    <a href="home-1-blog.html">Blog</a>
                                                </li>
                                                <li>
                                                    <a href="home-1-blog-2.html">Blog-02</a>
                                                </li>
                                                <li>
                                                    <a href="home-1blog-detalis.html">Blog-details</a>
                                                </li>
                                            </ul> 


                                        </li> -->


                                    </ul>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>




        </nav>
    </header>

    <!-- header part end  -->


    <!-- mobile navigation start -->
    <header class="mobile-header">
        <div class="container-full">
            <div class="mobile-header__container">
                <div class="p-left">
                    <div class="logo">
                        <a href="">
                            <img src="./assets/image/others/logo/logotegnex.png" alt="logo de Tegnex" class="logo_responsive"/>
                        </a>
                    </div>
                </div>
                <div class="p-right">
                    <button id="nav-opn-btn">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>