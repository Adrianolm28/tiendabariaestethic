<?php
include('plantilla/header.php');
?>
<!-- offcanvas -->

<aside id="offcanvas-nav">
    <nav class="m-nav">
        <button id="nav-cls-btn"><i class="fa-solid fa-xmark"></i></button>
        <div class="logo">
            <a href="<?php echo base_url('/'); ?>">
                <img src="./assets/image/others/logo/logo-vale1.png" alt="Logo de Valeapp" />
            </a>
        </div>
        <ul class="nav-links">
            <li class="dropdown"><a href="<?php echo base_url('/'); ?>">Inicio</a></li>
            <li class="dropdown"><a href="<?php echo base_url('#soporteSelect'); ?>">Características</a></li>
            <li class="dropdown"><a href="<?php echo base_url('#planesSelect'); ?>">Planes</a></li>
            <li class="dropdown"><a href="<?php echo base_url('/contacto'); ?>">Contacto</a></li>
        </ul>
        <ul class="social-icons">
            <li><a href="https://www.facebook.com/valeapp.sistemadefacturacion"><i class="fa-brands fa-facebook-f"></i></a></li>
            <li><a href="https://www.youtube.com/@valeapp-sistemadefacturaci5357"><i class="fa-brands fa-youtube"></i></a></li>
        </ul>
    </nav>
</aside>


<!-- offcanvas end -->

<main>
    <!-- banner part start  -->

    <?php foreach ($banner as $item) : ?>
        <section class="banner">
            <div class="container">
                <div class="row align-items-center  flex-column-reverse flex-lg-row">
                    <div class="col-lg-6">
                        <div class="banner-text">
                            <span class="mejores">LOS MEJORES </span>
                            <span class="precios">PRECIOS</span>
                            <div class="logo">
                                <span class="rotated-text">DEL</span>
                                <span class="normal-text">MERCADO</span>
                            </div>
                            <p><?= $item['text']; ?></p>

                            <div class="banner-vic-1">
                                <img src="./assets/image/others/victor/banner-vic-1.png" alt="Icono de banner del logotipo de banne" />
                            </div>

                        </div>

                        <div class="banner-btn">
                            <div class="banner-btn-item">
                                <div class="banner-btn-left">
                                    <div class="btn-style-1">
                                        <a href="<?php echo base_url('#sistemasSelect'); ?>">Conocenos<span><svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9 9.5L13 5.5M13 5.5L9 1.5M13 5.5L1 5.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>

                                            </span></a>
                                    </div>
                                </div>


                                <div class="banner-btn-right">
                                 
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="banner-img">
                            <div class="banner-item">
                                <div class="banner-pos">
                                    <img src="./assets/image/others/banner/<?= $item['imagen1'] ?>" alt="banner-thumb" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
    <!-- banner part end  -->

    <!-- Carousel -->

    <section id="soluciones" class="blog">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="blog-head">
                        <h2>Facturación electrónica para Emprendedores</h2>
                        <div class="blog-vic">
                            <img src="./assets/image/others/victor/blog-vic.png" alt="Victor en una imagen relacionada con la facturación electrónica" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mar-top">
                <?php foreach ($carousel as $item) : ?>
                    <div class="col-lg-4 m-r">
                        <div class="service-overelay"></div>
                        <div class="static-center-image">
                            <img class="bordered-image" style="width: 400px; height: auto; display: block; margin: 0 auto; " src="<?= base_url('public/assets/image/others/banner/' . $item['imagen_carousel']); ?>" alt="Imagen relacionada con la facturación electrónica para emprendedores">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Carousel -->

    <!-- about part star  -->

    <!--     <section class="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-position-img">
                        <div class="position-img">
                            <div class="about-img">
                                <img src="./assets/image/others/<?= esc($informacion[0]['info_logo']) ?>" alt="Logo de la empresa" />
                                <div class="about-overlay">
                                    <div class="icon">
                                        <a href="https://www.facebook.com/valeapp.sistemadefacturacion"><i class="fa-brands fa-facebook"></i> </a>
                                        <a href="https://www.youtube.com/@valeapp-sistemadefacturaci5357"><i class="fa-brands fa-youtube"></i> </a>
                                        <a href="https://walink.co/556331"><i class="fa-brands fa-whatsapp"></i> </a>
                                        <a href="https://www.tiktok.com/@valeapp.pe"><i class="fa-brands fa-tiktok"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-text">
                        <h2><?= esc($informacion[0]['info_titulo']) ?></h2>
                        <p><?= esc($informacion[0]['info_descripcion']) ?></p>
                        <div class="about-victor">
                            <img src="./assets/image/others/victor/about-vic.png" alt="Imagen de Victor" />
                        </div>
                    </div>

                    <div class="proress-item">
                         <div class="proress-item-inner">
                            <img src="<?= base_url('public/assets/image/' . $informacion[0]['info_icono1']); ?>" alt="Icono ISO 27001">
                            <h4>Iso 27001</h4>
                            <p><?= esc($informacion[0]['text_icono1']) ?></p>

                            <img src="<?= base_url('public/assets/image/' . $informacion[0]['info_icono2']); ?>" alt="Icono SUNAT">
                            <h4>SUNAT</h4>
                            <p><?= esc($informacion[0]['text_icono2']) ?></p>

                            <img src="<?= base_url('public/assets/image/' . $informacion[0]['info_icono3']); ?>" alt="Icono Expertos">
                            <h4>EXPERTOS</h4>
                            <p><?= esc($informacion[0]['text_icono3']) ?></p>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <div class="content_tegnex_importador" id="informacion">
        <div class="content_img_texgnes">
        <img src="<?php echo base_url('public/assets/image/tegnexbanner.jpg'); ?>" alt="" class="imagen_texnex"></a>
        </div>
        <div class="content_text">
        <img src="<?php echo base_url('public/assets/image/importador.png'); ?>" alt="" class="importador"></a>
        <p class="tegnex_text_importar">Tegnex es una empresa importadora y distribuidora de productos innovadores y tecnológicos. Con un enfoque en tecnología avanzada y en la detección de tendencias emergentes, Tegnex proporciona productos que combinan funcionalidad y diseño, respondiendo a las necesidades de un mercado en constante cambio. Nos esforzamos por ser el enlace entre la tecnología global y nuestros clientes, asegurando calidad, confiabilidad y un servicio excepcional.</p>

        <img src="<?php echo base_url('public/assets/image/5añosenlaindustria.png'); ?>" alt="" class="imagen_cinco_anos"></a>

        </div>
    </div>



    <!-- precios -->


    <!-- precios -->

    <!-- about part end  -->
    <!-- Service part start  -->

  <!--   <section class="service">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="service-head">
                        <h2>Por qué Valeapp es la mejor opción</h2>
                        <div class="service-vic">
                            <img src="./assets/image/others/victor/service.png" alt="Victor - Representación del servicio" />
                        </div>
                    </div>
                </div>

                <div class="col-lg-1"></div>

                <div class="col-lg-6">
                    <div class="service-text">
                        <p>
                            Damos vida a sus necesidades y, por ende, sus requerimientos, a través de un servicio de facturación electrónica excepcional que lo cautivará a usted y a sus clientes. Nuestro equipo de profesionales está aquí para abordar sus desafíos.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row mar-top">
                <?php foreach ($servicios as $item) : ?>
                    <?php if ($item['estado'] == 1) : ?>
                        <div class="col-lg-4 m-r">
                            <div class="service-item">
                                <div class="service-overelay"></div>
                                <div class="service-icon">
                                    <span>
                                        <img class="img-hover" style="width: 100px; height: auto; display: block; margin: 0 auto;" src="<?= base_url('public/assets/image/others/' . $item['icono']); ?>" alt="<?= $item['titulo']; ?>">
                                    </span>
                                </div>
                                <div class="service-item-text">
                                    <h3><?= $item['titulo']; ?></h3>
                                    <p><?= $item['descripcion']; ?></p>
                                </div>
                                <div class="service-btn">
                                    <a style="display: none;" href="#">Saber más <span> <i class="fa-solid fa-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section> -->






    <!-- Service part end  -->



    <!-- customers part start  -->

    <section class="customers">
        <div class="container">
      
            <div class="row" id="opiniones">
                <div class="col-lg-12">
                    <div class="customer-head">
                        <span>OPINIONES DE NUESTROS CLIENTES</span>
                        <h2>Qué dicen ellos!</h2>
                    </div>
                </div>
            </div>

            <div class="row customer-head-item-slick">
                <?php foreach ($testimonios as $item) : ?>
                    <?php if ($item['estado'] == 1) : ?>
                        <div class="col-lg-6 mart">
                            <div class="customer-head-item">
                                <div class="icon">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <div class="text">
                                    <p><?= $item['comentario']; ?></p>
                                </div>
                                <div class="customer-head-inner">
                                    <div class="customer-head-innner-df">
                                        <div class="customer-head-inner-img">
                                            <img src="<?= base_url('public/assets/image/others/' . $item['imagen_testimonio']); ?>" alt="<?= $item['nombre']; ?>" />
                                        </div>
                                        <div class="customer-head-inner-text">
                                            <h4><?= $item['nombre']; ?></h4>
                                            <p><?= $item['empresa']; ?></p>
                                        </div>
                                    </div>
                                    <div class="customer-head-inner-left">
                                        <img src="./assets/image/others/Customer-left.png" alt="Customer-thumb" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>




<!--     <section id="planesSelect" class="blog">
        <div class="container-precio">
            <div class="top">
                <div class="blog-head">
                    <h2>Conoce nuestros Planes a tu medida!</h2>
                    <div class="blog-vic">
                        <img src="./assets/image/others/victor/blog-vic.png" alt="Imagen Victor - Planes a tu medida" />
                    </div>
                </div>
                <div class="toggle-btn">
                    <span style="margin: 0.8em; font-size: 15px; font-weight: bold;">Mensual</span>
                    <label class="switch">
                        <input type="checkbox" id="checbox" onclick="check()" ; />
                        <span class="slider round"></span>
                    </label>
                    <span style="margin: 0.8em; font-size: 15px; font-weight: bold;">Anual</span>
                </div>
            </div>

            <div class="package-container">
                <?php foreach ($planes as $plan) : ?>
                    <div class="packages">
                        <h1 id="titulo-plan" class="titulo-banner"><?= ($plan['product']); ?></h1>
                        <h2 class="text1"><?= $plan['old_price']; ?></h2>
                        <h2 class="text2"><?= $plan['new_price']; ?></h2>
                        <span>+IGV / Mensual</span>
                        <ul class="list-precio">
                            <?php
                            $featuresArray = explode("|", $plan['features']);
                            $packageId = $plan['id'];

                            foreach ($featuresArray as $index => $feature) :
                            ?>
                                <li style="text-align: left; padding-right: 10px;">
                                    <i style="color: #00d664;" class="fas fa-check "></i> <?= $feature; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <a href="https://walink.co/75daf7" class="button button1">Seleccionar</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
 -->





    <!-- Project part start  -->
<!--     <div class="Project"></div> -->


  <!--   <section class="Project-two">
        <div class="container">
            <div class="row  project-bg  ">
                <div class="col-lg-5">
                    <div class="Project-head">
                        <h2>Conocenos como el mejor Sistema</h2>
                        <p>Somos una empresa comprometida con la excelencia en el servicio de facturacion. Nuestra misión es simplificar y optimizar el proceso de facturación y control de Negocio para nuestros clientes de t odo los rubros.</p>
                    </div>

                    <div class="Project-head-middel">
                        <div class="Project-head-middel-item">
                            <div class="icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="text">
                                <ul>
                                    <li>Ofrecemos un servicio optimizado y personalizado</li>
                                </ul>
                            </div>
                        </div>
                        <div class="Project-head-middel-item">
                            <div class="icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="text">
                                <ul>
                                    <li>Controles de ventas y productos en tiempo Real.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="Project-head-middel-item">
                            <div class="icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="text">
                                <ul>
                                    <li>Gestiona tu empresa desde cualquier lugar.</li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div style="display: none;" class="Project-btn">
                        <div class="btn-style-1">
                            <a href="#">Consultar <span><svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 9.5L13 5.5M13 5.5L9 1.5M13 5.5L1 5.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </span></a>
                        </div>
                    </div>
                </div>



                <div class="col-lg-7 Project-pt  ">
                    <div class="row Project-right-top  ">
                        <div class="col-lg-6 col-md-6">
                            <div class="Project-right-item">
                                <div class="Project-right-icon">
                                    <div class="icon">
                                        <span>
                                            <img src="./assets/image/others/icono-nuevo.png" alt="Ícono de clientes nuevos" />

                                        </span>
                                    </div>
                                </div>

                                <div class="Project-right-item-text">
                                    <h3> <span class="counter">2000</span></h3>
                                    <p>Clientes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 res-mt">
                            <div class="Project-right-item">
                                <div class="Project-right-icon">
                                    <div class="icon">
                                        <span>
                                            <svg width="44" height="35" viewBox="0 0 44 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.4288 5.19082C14.8997 4.07409 15.4446 3.07846 16.2653 2.24933C20.036 -1.55326 26.3915 -0.369259 28.4837 4.55509C28.7074 5.0815 28.8016 5.17905 29.2994 4.77709C31.1208 3.30382 33.1709 3.00782 35.2766 4.03709C37.3267 5.03777 38.4451 6.73472 38.4687 9.07076C38.4787 10.1354 38.4619 11.2016 38.472 12.2662C38.4888 14.0405 37.7707 15.4717 36.4353 16.5986C36.0805 16.8979 35.8585 17.199 35.9527 17.6699C36.0485 18.1559 36.4925 18.1105 36.8188 18.1946C37.9019 18.4738 39.027 18.6117 40.0226 19.1684C42.0509 20.3002 43.1357 22.0207 43.1727 24.3534C43.2013 26.1193 43.1845 27.8852 43.1761 29.6511C43.171 30.7342 42.9288 30.9697 41.8256 30.9747C40.0596 30.9814 38.2937 30.9999 36.5295 30.9646C35.8585 30.9512 35.5742 31.1278 35.5978 31.8543C35.6836 34.5486 35.5911 34.3451 33.0566 34.3417C30.5339 34.3383 28.0111 34.34 25.4901 34.34C25.1235 34.34 24.7518 34.3484 24.476 34.0457C24.2271 33.7699 24.1716 33.4453 24.3044 33.1072C24.4541 32.7288 24.7652 32.5522 25.1638 32.5489C26.2015 32.5405 27.2392 32.5068 28.2735 32.5506C28.9529 32.5792 29.1615 32.3084 29.1312 31.6659C29.0925 30.8553 29.1161 30.0413 29.1279 29.2273C29.1379 28.5748 29.3414 28.0181 30.11 28.0315C30.8282 28.045 31.0266 28.5832 31.0367 29.1987C31.0519 30.0665 31.0619 30.936 31.0401 31.8055C31.0266 32.3454 31.2385 32.5321 31.7818 32.5489C33.7596 32.6094 33.7545 32.6279 33.7108 30.6249C33.6973 30.0093 33.7209 29.3921 33.7058 28.7766C33.6385 25.8469 31.8995 23.647 29.0724 22.9289C28.0414 22.6665 26.9869 22.4866 25.9728 22.1738C25.2193 21.9417 24.9233 22.2276 24.6559 22.8785C24.0303 24.4072 23.3407 25.9108 22.6747 27.4244C22.4578 27.9155 22.261 28.4385 21.59 28.4385C20.9172 28.4402 20.7205 27.9172 20.5052 27.4261C19.8173 25.862 19.116 24.3029 18.4567 22.7271C18.2196 22.1603 17.9152 21.9585 17.2963 22.1368C16.3023 22.4244 15.2865 22.638 14.2791 22.8869C11.341 23.6134 9.55996 25.7241 9.39177 28.7429C9.33459 29.7773 9.39346 30.8166 9.36991 31.8526C9.35814 32.3622 9.56332 32.5489 10.0662 32.5405C12.5418 32.5001 12.0877 32.8382 12.1365 30.6148C12.1449 30.1943 12.1365 29.7739 12.1399 29.3534C12.1466 28.6925 12.2593 28.045 13.0834 28.0315C13.9058 28.0181 14.0538 28.6488 14.0571 29.3198C14.0622 30.1607 14.0739 31.0016 14.0571 31.8425C14.047 32.3403 14.2421 32.5522 14.7517 32.5405C15.6767 32.5203 16.6017 32.5354 17.5267 32.5405C18.1423 32.5438 18.5913 32.7911 18.5829 33.4621C18.5745 34.0827 18.1456 34.335 17.5654 34.3367C14.5667 34.34 11.568 34.3417 8.56937 34.3333C7.92523 34.3316 7.59055 33.9767 7.57878 33.3343C7.56869 32.8012 7.54346 32.268 7.57878 31.7366C7.61746 31.1345 7.35342 30.9629 6.78496 30.9697C4.99215 30.9932 3.19765 30.9814 1.40316 30.9764C0.241025 30.973 0.0106169 30.7493 0.00557146 29.6141C-0.00115579 27.8768 -0.00283761 26.1395 0.00557146 24.4005C0.0207078 21.7079 1.68907 19.4795 4.28074 18.7126C5.03083 18.4906 5.80447 18.3443 6.56296 18.1441C7.32987 17.9423 7.5586 17.2814 6.95987 16.8088C5.13006 15.3624 4.54815 13.4553 4.7012 11.2218C4.7466 10.5524 4.71129 9.87635 4.7096 9.20363C4.69951 6.79863 5.81456 5.04114 7.94037 4.02532C10.12 2.98428 12.1937 3.3526 14.0504 4.90155C14.1513 4.98227 14.2606 5.06132 14.4288 5.19082ZM27.2476 10.9039C27.5318 9.96381 26.9936 9.30622 25.998 8.87399C25.5641 8.68563 25.1537 8.42831 24.7652 8.15586C24.2405 7.78586 23.8083 7.73036 23.2936 8.22481C22.9186 8.58472 22.4191 8.82522 21.9566 9.08422C20.3555 9.98567 18.5896 10.0529 16.8187 10.0395C16.1813 10.0344 15.8651 10.2346 15.9357 10.909C15.9912 11.4371 15.9979 11.9702 16.0568 12.4966C16.4419 15.9208 19.7669 18.1694 23.0817 17.2562C25.7474 16.5246 27.2459 14.3096 27.2476 10.9039ZM41.3748 26.496C41.3731 26.496 41.3715 26.496 41.3715 26.496C41.3715 25.8805 41.3933 25.2633 41.3681 24.6477C41.2706 22.3319 40.1521 20.9561 37.9204 20.386C37.3788 20.2481 36.8188 20.164 36.2907 19.9874C35.7592 19.8091 35.5221 20.0194 35.3405 20.4852C34.9839 21.3968 34.6223 22.31 34.2086 23.1963C33.9933 23.6555 34.0051 23.9969 34.3028 24.4224C35.0361 25.4735 35.4464 26.6642 35.5843 27.9373C35.7172 29.1684 35.7038 29.123 36.9281 29.1853C37.7572 29.2273 38.1104 29.007 38.0297 28.1207C37.9557 27.3151 38.0146 26.4977 38.0179 25.6854C38.0196 25.0766 38.2483 24.6124 38.9227 24.6158C39.5988 24.6191 39.8158 25.09 39.8158 25.6972C39.8175 26.454 39.7939 27.2108 39.8259 27.9643C39.8477 28.4856 39.5433 29.1768 40.576 29.1886C41.6591 29.2004 41.3378 28.4738 41.3715 27.9239C41.3984 27.4496 41.3748 26.972 41.3748 26.496ZM1.80848 26.3884C1.80848 27.1789 1.83202 27.823 1.80175 28.4654C1.77316 29.0356 2.04225 29.1752 2.56025 29.1802C3.10515 29.1836 3.39947 29.0591 3.37593 28.4352C3.33893 27.5135 3.36583 26.5885 3.37088 25.6652C3.37424 25.0514 3.62315 24.604 4.29588 24.6175C4.91815 24.6292 5.15865 25.0581 5.16538 25.6349C5.1721 26.2791 5.16201 26.9232 5.1721 27.5657C5.20238 29.3232 4.84247 29.1533 6.87242 29.1735C7.36687 29.1785 7.58719 29.007 7.5771 28.4923C7.54514 26.9518 8.09846 25.5879 8.92591 24.3265C9.13278 24.012 9.195 23.7395 9.047 23.3931C8.61814 22.3907 8.19769 21.3833 7.78396 20.3742C7.63596 20.0143 7.44255 19.8361 7.01537 19.9605C6.18456 20.2027 5.32178 20.349 4.5061 20.6332C3.06479 21.1361 2.24238 22.1973 1.93798 23.6891C1.74457 24.6343 1.83707 25.5862 1.80848 26.3884ZM27.2577 7.43436C27.187 7.01054 27.1517 6.79359 27.1164 6.57663C26.6472 3.67887 24.0151 1.62201 21.1039 1.88101C18.2331 2.13664 15.9374 4.6745 15.9508 7.56218C15.9525 7.93722 16.0669 8.12895 16.4705 8.14913C18.894 8.26686 21.1796 7.97254 22.9287 6.03845C23.4013 5.51541 23.9193 5.48514 24.5062 5.83495C25.3656 6.34454 26.2351 6.84068 27.2577 7.43436ZM14.1278 11.3984C14.1278 11.0671 14.116 10.8148 14.1294 10.5642C14.1547 10.1068 13.9798 10.0328 13.5795 10.2144C11.6757 11.0755 9.64236 11.1983 7.5956 11.2302C6.50578 11.247 6.39815 11.3681 6.56801 12.4647C6.59324 12.6295 6.62519 12.7943 6.65546 12.9608C6.96492 14.6577 8.38773 15.8838 10.1839 16.0066C11.7884 16.1159 13.4853 14.91 13.9125 13.3123C14.0857 12.6648 14.1765 11.9954 14.1278 11.3984ZM32.885 16.015C34.841 15.9914 36.3159 14.572 36.6254 12.4142C36.7751 11.3748 36.6607 11.2538 35.6197 11.2285C33.9732 11.1898 32.3334 11.1192 30.7306 10.6449C30.1958 10.4868 29.5248 9.86121 29.1665 10.2632C28.8554 10.6113 29.032 11.4354 29.0673 12.0442C29.2002 14.3819 30.8097 16.0402 32.885 16.015ZM8.19937 9.32808C9.92155 9.33649 11.5849 9.08253 13.1725 8.36104C13.8385 8.05831 13.8923 7.70345 13.5105 7.13163C12.6747 5.87868 11.5125 5.29004 10.0225 5.39936C8.59459 5.50364 7.54682 6.22682 6.93464 7.51677C6.20306 9.06067 6.38133 9.32976 8.03287 9.32976C8.08669 9.32808 8.14219 9.32808 8.19937 9.32808ZM34.8696 9.32472C35.2883 9.32472 35.7071 9.31967 36.1276 9.3264C36.5346 9.33313 36.6388 9.15485 36.5985 8.74954C36.4337 7.14845 35.2614 5.79627 33.6923 5.45318C32.0996 5.10336 30.48 5.81141 29.6442 7.17536C29.3011 7.7354 29.3717 8.06336 29.9873 8.34758C31.5396 9.06572 33.176 9.32135 34.8696 9.32472ZM19.5953 20.1035C19.8358 21.7348 20.7222 23.1492 21.3697 24.6477C21.5883 25.1539 21.7968 24.7217 21.9028 24.488C22.2846 23.6504 22.6445 22.8028 23.0178 21.9635C23.3004 21.3278 23.5997 20.7123 23.5846 19.9756C23.5711 19.3551 23.3946 19.091 22.742 19.2457C22.0289 19.4139 21.2872 19.4375 20.5826 19.2642C19.8123 19.0725 19.4406 19.2104 19.5953 20.1035ZM13.4012 17.4529C13.3491 17.9322 13.6737 18.0483 14.0588 18.1391C15.0881 18.383 16.1325 18.5814 17.1197 18.98C17.2711 19.0406 17.4376 19.1751 17.5839 19.054C17.7521 18.9144 17.6764 18.6891 17.6646 18.499C17.6461 18.1744 17.3804 18.0365 17.1601 17.8717C16.6202 17.4697 16.1375 17.0123 15.7255 16.4758C15.0326 15.5743 15.0208 15.5727 14.1984 16.3547C13.8704 16.6675 13.344 16.8458 13.4012 17.4529ZM29.7821 17.4445C29.7821 17.4058 29.7838 17.3772 29.7821 17.3503C29.7686 17.1855 28.4383 15.6702 28.2802 15.6332C28.1541 15.6029 28.0582 15.6534 27.996 15.7543C27.3855 16.7432 26.548 17.5101 25.6398 18.2181C25.4127 18.3964 25.4497 18.7395 25.554 19.0052C25.6213 19.1751 25.7979 19.1011 25.9206 19.0456C26.9751 18.5764 28.1087 18.3914 29.217 18.1172C29.5971 18.0231 29.8191 17.8482 29.7821 17.4445ZM10.3588 21.4556C10.6599 20.7459 10.9273 20.1724 11.151 19.5838C11.7682 17.9524 11.5916 17.7573 10.0325 17.8448C9.21687 17.8902 9.00664 18.0769 9.23873 18.8656C9.48596 19.7133 9.82568 20.5357 10.3588 21.4556ZM32.8716 21.4926C33.1844 20.7644 33.4299 20.2111 33.6603 19.6511C34.3348 18.018 34.1918 17.8347 32.4747 17.8364C31.7868 17.8364 31.6153 18.1542 31.7464 18.7126C31.96 19.6342 32.3788 20.4751 32.8716 21.4926ZM27.4898 20.4684C27.4965 20.5105 27.5032 20.5525 27.5116 20.5946C28.5443 20.8519 29.5752 21.1092 30.66 21.3783C30.1975 19.8058 30.1975 19.8058 28.778 20.1539C28.3475 20.2599 27.9186 20.3641 27.4898 20.4684ZM15.5523 20.6114C15.5607 20.5559 15.5674 20.5021 15.5758 20.4466C15.0191 20.307 14.4473 20.2145 13.9108 20.0177C13.2499 19.7755 12.9118 20.016 12.7504 20.6366C12.6898 20.8653 12.4779 21.0621 12.599 21.3665C13.5845 21.1142 14.5684 20.862 15.5523 20.6114Z" fill="white" />
                                                <path d="M21.5977 15.6617C20.9788 15.6953 20.4389 15.4918 19.9865 15.0831C19.6182 14.7501 19.4735 14.3297 19.7628 13.884C20.0588 13.4282 20.5062 13.2617 20.9888 13.5678C21.4059 13.8319 21.7574 13.7764 22.156 13.5544C22.6118 13.3004 23.044 13.398 23.3333 13.8235C23.6478 14.286 23.5183 14.7333 23.1248 15.0966C22.6976 15.4935 22.1863 15.6903 21.5977 15.6617Z" fill="white" />
                                                <path d="M25.3131 11.5362C25.2139 12.0643 24.9128 12.4225 24.3662 12.4107C23.8146 12.3989 23.49 12.0205 23.5001 11.4824C23.5102 10.9358 23.8667 10.5944 24.4184 10.6162C24.9599 10.6381 25.2626 10.9829 25.3131 11.5362Z" fill="white" />
                                                <path d="M19.6504 11.5985C19.573 12.13 19.2383 12.4394 18.6985 12.399C18.1569 12.3587 17.8391 11.9904 17.8828 11.4404C17.9265 10.8905 18.3066 10.586 18.8414 10.6163C19.393 10.6483 19.6621 11.0149 19.6504 11.5985Z" fill="white" />
                                            </svg>


                                        </span>
                                    </div>
                                </div>

                                <div class="Project-right-item-text">
                                    <h3> <span class="counter">123</span>+</h3>
                                    <p>Empresa hablando de nosotros</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 martop">
                            <div class="Project-right-item">
                                <div class="Project-right-icon">
                                    <div class="icon">
                                        <span>
                                            <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M18.344 0.000357568C23.636 0.000357568 28.928 -0.0010727 34.2186 0.00178784C35.8948 0.00321811 36.7158 0.824193 36.7172 2.50047C36.7201 6.88711 36.7187 11.2723 36.7172 15.659C36.7172 15.8735 36.7287 16.0938 36.6843 16.2997C36.5985 16.6959 36.3282 16.9333 35.922 16.9162C35.523 16.899 35.2455 16.663 35.2069 16.2497C35.1711 15.8706 35.1854 15.4873 35.1854 15.1069C35.184 12.7469 35.1697 10.387 35.1954 8.02703C35.2026 7.44348 35.0295 7.24468 34.4274 7.24468C23.7247 7.26041 13.022 7.26041 2.31925 7.24325C1.67277 7.24182 1.52116 7.46065 1.52259 8.06994C1.53975 15.4587 1.5326 22.8489 1.53546 30.2377C1.53546 31.2432 1.75286 31.4634 2.74547 31.4649C7.01196 31.4677 11.2785 31.4677 15.5464 31.4649C16.5461 31.4634 16.672 31.2332 16.303 30.3092C16.0742 29.7342 15.8367 29.3137 15.0901 29.401C14.5824 29.4596 14.3135 29.0935 14.3106 28.5857C14.3035 27.5845 14.3006 26.5834 14.3106 25.5822C14.3164 24.9829 14.6754 24.6854 15.2346 24.7569C16.1156 24.8699 16.0927 24.1276 16.386 23.6627C16.6792 23.1979 16.426 22.9233 16.1214 22.6229C15.668 22.1767 15.6579 21.7033 16.1085 21.2456C16.7607 20.5834 17.42 19.9269 18.0794 19.2718C18.5628 18.7912 19.0506 18.817 19.5097 19.2976C19.7929 19.5936 20.0618 19.8196 20.4908 19.5421C20.9471 19.2461 21.7109 19.2947 21.6093 18.4079C21.5349 17.76 21.8968 17.4439 22.5518 17.4482C23.4572 17.4554 24.364 17.4611 25.2694 17.4454C25.9487 17.4339 26.3435 17.73 26.2677 18.4237C26.169 19.319 26.9514 19.2461 27.4019 19.5464C27.8353 19.8353 28.0999 19.5707 28.3773 19.2847C28.8479 18.8027 29.3313 18.807 29.809 19.2818C30.4512 19.9212 31.0906 20.5634 31.7313 21.2027C32.2062 21.6761 32.2233 22.1581 31.7442 22.6358C31.4667 22.9133 31.1864 23.1679 31.4682 23.6113C31.7728 24.0904 31.7356 24.8728 32.6596 24.7583C33.2732 24.6811 33.5749 25.053 33.5735 25.6694C33.5707 26.5991 33.5664 27.5288 33.5749 28.4584C33.5807 29.1092 33.2832 29.421 32.6238 29.4282C32.066 29.4339 31.2307 30.458 31.348 30.9929C31.4167 31.3061 31.6741 31.4549 31.9916 31.4577C32.7783 31.4634 33.5649 31.482 34.3516 31.452C35.0367 31.4263 35.1911 30.9557 35.1897 30.3607C35.1826 28.0251 35.1869 25.6894 35.1869 23.3524C35.1869 23.1378 35.1911 22.9233 35.1883 22.7088C35.184 22.1753 35.4157 21.7977 35.9706 21.8091C36.5285 21.8206 36.7244 22.2182 36.7215 22.7431C36.7158 23.9831 36.7215 25.2217 36.7215 26.4618C36.7215 27.8921 36.7315 29.3223 36.7172 30.7526C36.7044 32.0999 35.8062 33.0982 34.4717 32.9681C32.5452 32.7807 31.0062 33.2313 29.8191 34.8432C29.3685 35.4539 28.9323 35.3924 28.3602 34.8532C28.0555 34.5671 27.7967 34.3655 27.3719 34.6315C26.907 34.9233 26.1619 34.8904 26.2677 35.7757C26.3449 36.4308 25.9559 36.7254 25.3094 36.7183C24.3797 36.7082 23.4501 36.714 22.5204 36.7154C21.9011 36.7168 21.5378 36.4079 21.615 35.7957C21.7252 34.9175 21 34.929 20.5294 34.6372C20.0675 34.3512 19.79 34.5786 19.4868 34.8918C19.0134 35.3781 18.5271 35.3466 18.0565 34.8718C18.0236 34.8374 17.9807 34.8103 17.955 34.7717C16.878 33.1597 15.339 32.8994 13.5025 32.9624C9.83675 33.0882 6.16238 33.0024 2.49088 32.9981C0.821754 32.9967 0.00363966 32.1729 0.00363966 30.488C-0.000651154 21.1698 -0.000651154 11.8501 0.000779117 2.53051C0.000779117 0.80846 0.811742 0.00321811 2.54094 0.00178784C7.80862 -0.0010727 13.0763 0.000357568 18.344 0.000357568ZM18.3669 5.72144C23.7032 5.72144 29.0381 5.71286 34.3745 5.73288C34.9866 5.73574 35.2441 5.57984 35.1969 4.93336C35.1468 4.24683 35.1869 3.55315 35.1854 2.86233C35.1826 1.71668 35.0052 1.53647 33.861 1.53647C28.4775 1.53504 23.0939 1.53647 17.7104 1.53647C12.7802 1.53647 7.84867 1.53647 2.91853 1.53647C1.70709 1.53647 1.53975 1.70095 1.53689 2.87663C1.53546 3.52025 1.58123 4.16673 1.52402 4.80464C1.46109 5.51977 1.69279 5.74289 2.43224 5.7386C7.74283 5.70714 13.0549 5.72144 18.3669 5.72144ZM18.3941 23.0449C18.3812 23.1035 18.3812 23.2337 18.3254 23.3324C17.8978 24.1076 17.5745 24.9228 17.3142 25.7681C17.1941 26.1586 16.8537 26.3102 16.4618 26.273C15.7824 26.2086 15.831 26.6577 15.8324 27.104C15.8339 27.5288 15.7953 27.9464 16.4303 27.8935C17.0096 27.8463 17.2899 28.1753 17.4258 28.7059C17.5845 29.3309 17.8191 29.9331 18.1581 30.4837C18.4756 30.9986 18.4913 31.4792 18.0293 31.9011C17.5516 32.3373 17.9821 32.5504 18.2281 32.8065C18.4842 33.0711 18.7116 33.4501 19.1364 32.9752C19.5283 32.5376 19.996 32.5376 20.4908 32.8379C21.0644 33.1855 21.6851 33.4358 22.3344 33.6003C22.8737 33.7361 23.1712 34.0408 23.1283 34.6115C23.0782 35.2651 23.5344 35.1821 23.9392 35.1836C24.3468 35.185 24.7959 35.2565 24.7445 34.6072C24.7001 34.0336 25.0048 33.7361 25.5411 33.5988C26.1905 33.4344 26.8112 33.1855 27.3847 32.8365C27.881 32.5347 28.3459 32.5447 28.7392 32.9781C29.164 33.4472 29.39 33.0711 29.6474 32.8036C29.8963 32.5462 30.3154 32.3302 29.8391 31.8968C29.3757 31.4749 29.3986 30.9929 29.7146 30.4794C30.0536 29.9288 30.2882 29.3266 30.4469 28.7002C30.5828 28.1681 30.8674 27.8434 31.4453 27.8906C32.0846 27.9421 32.0488 27.5173 32.036 27.0968C32.0245 26.7035 32.1418 26.2258 31.4782 26.2744C30.8646 26.3188 30.5742 25.9855 30.4355 25.4248C30.2853 24.8227 30.0593 24.2406 29.7304 23.7128C29.3957 23.175 29.3814 22.6859 29.862 22.2353C30.3497 21.7777 29.8334 21.5874 29.616 21.3357C29.3885 21.074 29.1611 20.7307 28.7649 21.1669C28.3473 21.6246 27.8696 21.6318 27.3504 21.3114C26.7797 20.9581 26.1518 20.725 25.5039 20.5562C24.9976 20.4246 24.7015 20.1314 24.7473 19.5922C24.8002 18.97 24.4083 18.97 23.9707 18.98C23.5387 18.9901 23.0682 18.9028 23.1254 19.5951C23.1697 20.1357 22.8708 20.426 22.3659 20.5576C21.718 20.7264 21.0915 20.9624 20.5209 21.3142C20.0002 21.6346 19.524 21.6232 19.1063 21.1655C18.7073 20.7278 18.4827 21.0811 18.2553 21.34C18.0336 21.5903 17.5273 21.7819 18.0107 22.2411C18.2196 22.4413 18.3898 22.6744 18.3941 23.0449Z" fill="white" />
                                                <path d="M9.63292 22.1369C9.18096 22.1369 8.72756 22.1298 8.2756 22.1384C7.6377 22.1498 7.31303 21.8709 7.28871 21.2058C7.25581 20.309 6.61934 19.9572 5.78836 20.3691C5.20481 20.658 4.78431 20.5236 4.46679 19.9772C4.00052 19.1748 3.53425 18.3725 3.06941 17.5686C2.75475 17.0223 2.85201 16.5918 3.38693 16.2242C4.12209 15.7179 4.12638 15.0356 3.39981 14.5222C2.84629 14.1317 2.75332 13.6897 3.09659 13.1162C3.56 12.3396 4.00338 11.5515 4.45964 10.7706C4.79289 10.2013 5.21911 10.0612 5.83413 10.3915C6.5936 10.8006 7.26011 10.4058 7.28871 9.54339C7.31016 8.88976 7.6048 8.58082 8.25414 8.58511C9.18096 8.59083 10.1106 8.59655 11.0389 8.58225C11.6897 8.57224 11.9871 8.90263 12.0701 9.51622C12.2045 10.506 12.668 10.7706 13.5662 10.3486C14.1254 10.0855 14.5345 10.2142 14.8362 10.7248C15.3068 11.5243 15.7716 12.3296 16.2265 13.1377C16.544 13.7026 16.461 14.1646 15.8861 14.5408C15.1809 15.0027 15.1838 15.695 15.8618 16.1856C16.4868 16.639 16.5726 16.9593 16.1979 17.6359C15.7602 18.4268 15.3025 19.2077 14.8434 19.9872C14.5244 20.5279 14.0968 20.6566 13.5161 20.3591C12.7295 19.9558 12.186 20.2561 12.0758 21.1143C11.9714 21.9295 11.7554 22.1241 10.9202 22.1369C10.4897 22.1441 10.0606 22.1384 9.63292 22.1369ZM5.65248 12.1679C5.24485 12.3281 5.18478 12.7758 4.95737 13.089C4.77286 13.3451 4.90302 13.5253 5.13329 13.6754C5.53806 13.94 5.64819 14.3076 5.57811 14.7868C5.5209 15.1815 5.52376 15.5977 5.57525 15.9939C5.63389 16.4473 5.53234 16.8049 5.14331 17.0394C4.647 17.3398 4.94307 17.6502 5.13043 17.9305C5.31637 18.2065 5.35355 18.7071 5.94426 18.4468C6.47918 18.2123 8.52017 19.1834 8.75188 19.7269C8.79765 19.8328 8.82339 19.9586 8.81767 20.073C8.79049 20.6208 9.16236 20.6294 9.53424 20.5908C9.88751 20.5536 10.4196 20.8082 10.4453 20.1288C10.4639 19.6239 10.7728 19.3794 11.1905 19.1848C11.5338 19.0261 11.8713 18.8387 12.1788 18.6185C12.5564 18.3481 12.9225 18.2208 13.3717 18.4282C14.0239 18.7286 14.0267 18.0835 14.2556 17.7875C14.4572 17.5286 14.5874 17.2583 14.1612 17.0423C13.8007 16.8592 13.7178 16.5174 13.7278 16.1326C13.7421 15.6092 13.7392 15.0857 13.7278 14.5622C13.7192 14.2018 13.805 13.8871 14.1383 13.7141C14.6475 13.4509 14.4029 13.1391 14.2055 12.8459C14.0053 12.547 13.9709 12.0235 13.3445 12.2909C12.7767 12.5341 10.7285 11.5114 10.5082 10.935C10.4825 10.8693 10.4582 10.7963 10.4611 10.7277C10.4982 9.98249 9.95473 10.1513 9.52565 10.1212C9.07798 10.0898 8.77762 10.1899 8.80909 10.7305C8.82482 11.0109 8.68322 11.3083 8.42864 11.3656C7.49753 11.5772 6.89253 12.9102 5.65248 12.1679Z" fill="white" />
                                                <path d="M24.2886 15.693C23.1472 15.693 22.0059 15.6901 20.8659 15.6944C20.3525 15.6958 19.9391 15.5299 19.9205 14.9621C19.9005 14.3528 20.321 14.1611 20.8688 14.1611C23.1744 14.164 25.4814 14.1626 27.787 14.1626C28.3062 14.1626 28.691 14.3514 28.691 14.9292C28.691 15.5084 28.3019 15.693 27.7842 15.693C26.6185 15.693 25.4542 15.693 24.2886 15.693Z" fill="white" />
                                                <path d="M29.0214 12.2605C28.0446 12.2605 27.0691 12.2577 26.0922 12.262C25.5759 12.2648 25.1654 12.0875 25.1526 11.5211C25.1397 10.9104 25.5645 10.7273 26.1123 10.7287C28.0417 10.733 29.9697 10.7316 31.8991 10.7301C32.4112 10.7301 32.8202 10.8903 32.8331 11.471C32.846 12.0946 32.424 12.2648 31.8791 12.2634C30.9266 12.2577 29.974 12.2605 29.0214 12.2605Z" fill="white" />
                                                <path d="M6.71163 29.707C6.04655 29.7084 5.38148 29.7142 4.7164 29.7056C4.21867 29.6999 3.88255 29.4724 3.88255 28.9432C3.88398 28.4126 4.22153 28.1852 4.71926 28.1838C6.09661 28.1781 7.47396 28.1781 8.85131 28.1866C9.31901 28.1895 9.63796 28.4283 9.65369 28.9118C9.67086 29.4324 9.35191 29.6941 8.84845 29.7041C8.13761 29.717 7.4239 29.7056 6.71163 29.707Z" fill="white" />
                                                <path d="M9.61649 24.7496C10.1872 24.7496 10.7578 24.7396 11.3285 24.7525C11.7962 24.764 12.1137 24.9957 12.1266 25.4834C12.1395 26.0083 11.8162 26.2657 11.3142 26.27C10.1729 26.2815 9.03008 26.28 7.88873 26.2686C7.4196 26.2643 7.0935 26.0111 7.08062 25.5392C7.06632 25.0257 7.40244 24.7654 7.90303 24.7525C8.47371 24.7382 9.04582 24.7496 9.61649 24.7496Z" fill="white" />
                                                <path d="M21.5795 10.7493C21.8884 10.7493 22.2031 10.715 22.5063 10.7579C22.9082 10.8137 23.1413 11.0783 23.1428 11.4931C23.1442 11.9078 22.9153 12.2039 22.5134 12.2297C21.8512 12.2726 21.179 12.2783 20.5182 12.2239C20.1206 12.191 19.9003 11.875 19.9146 11.4645C19.9275 11.0869 20.1463 10.8194 20.5125 10.7665C20.8615 10.7164 21.2248 10.755 21.5809 10.755C21.5795 10.7536 21.5795 10.7508 21.5795 10.7493Z" fill="white" />
                                                <path d="M31.4729 15.6948C30.5303 15.6934 30.1127 15.4603 30.1113 14.9296C30.1084 14.399 30.5289 14.1602 31.4686 14.1602C32.497 14.1587 32.8674 14.3747 32.8431 14.9611C32.8202 15.5204 32.4912 15.6963 31.4729 15.6948Z" fill="white" />
                                                <path d="M24.4388 2.86126C26.773 2.86126 29.1086 2.86126 31.4428 2.86126C31.633 2.86126 31.8247 2.85983 32.0149 2.86698C32.5184 2.88414 32.843 3.11728 32.8359 3.64648C32.8287 4.13706 32.5198 4.36447 32.0492 4.38736C31.859 4.39737 31.6688 4.39451 31.4771 4.39451C26.7358 4.39451 21.9944 4.39451 17.2545 4.39451C17.1115 4.39451 16.9685 4.39165 16.8254 4.39308C16.3105 4.39737 15.9101 4.22431 15.8986 3.64362C15.8872 3.06722 16.2662 2.86412 16.7911 2.86126C16.9813 2.85983 17.173 2.8584 17.3632 2.8584C19.7217 2.86126 22.0802 2.86126 24.4388 2.86126Z" fill="white" />
                                                <path d="M23.9234 22.333C26.5122 22.3273 28.6748 24.4684 28.6891 27.0543C28.7034 29.6717 26.5308 31.8486 23.9134 31.8372C21.3275 31.8257 19.1821 29.666 19.1835 27.0787C19.1849 24.4927 21.3361 22.3387 23.9234 22.333ZM23.9435 30.2024C25.7156 30.1995 27.0572 28.8508 27.0529 27.0758C27.0486 25.3008 25.707 23.9664 23.9277 23.9692C22.1528 23.9721 20.8183 25.3137 20.8197 27.093C20.8226 28.8679 22.1642 30.2038 23.9435 30.2024Z" fill="white" />
                                                <path d="M9.64875 17.8419C8.23421 17.8405 7.15865 16.7692 7.16008 15.3604C7.16151 13.9631 8.24995 12.8818 9.66019 12.8789C11.0647 12.8761 12.1503 13.9631 12.146 15.369C12.1431 16.7793 11.0704 17.8434 9.64875 17.8419ZM9.64017 14.5094C9.09095 14.5237 8.76627 14.8741 8.8006 15.4234C8.8335 15.9611 9.15102 16.2744 9.66162 16.2615C10.1923 16.2486 10.5369 15.9139 10.567 15.3604C10.5927 14.8684 10.1636 14.4951 9.64017 14.5094Z" fill="white" />
                                            </svg>


                                        </span>
                                    </div>
                                </div>

                                <div class="Project-right-item-text">
                                    <h3> <span class="counter">120</span></h3>
                                    <p>Clientes en linea</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6  martop">
                            <div class="Project-right-item">
                                <div class="Project-right-icon">
                                    <div class="icon">
                                        <span>
                                            <img src="./assets/image/others/peru.png" alt="Ícono de Perú" />

                                        </span>
                                    </div>
                                </div>

                                <div class="Project-right-item-text">
                                    <h3> <span class="counter">100</span>k</h3>
                                    <p>Clientes Nuevos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </section> -->
<!--
    <div id="soporteSelect" class="about-4 ">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-4 col-md-6">
                    <div class="about-content">
                        <h3>Soporte

                        </h3>
                        <h2><?= esc($soporte[0]['titulo_soporte']) ?>
                        </h2>
                        <p><?= esc($soporte[0]['parrafo_soporte']) ?></p>
                        <div class="about-heading-img">
                            <img src="assets/image/vector/about-line.png" alt="Imagen de incono en soprote">
                        </div>


                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="about-img">
                        <img src="<?= base_url('public/assets/image/' . $soporte[0]['imagen_soporte']); ?>" alt="Imagen de soporte">
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="about-description">
                        <div class="about-testimonial d-flex">
                            <div class="about-icon">
                                <img src="assets/image/iconoSoporte1.png" alt="Icono de soporte">
                            </div>
                            <div class="about-tittle">
                                <h3><?= esc($soporte[0]['sub1_soporte']) ?></h3>
                                <p><?= esc($soporte[0]['sub_parrafo1']) ?></p>
                            </div>
                        </div>
                        <div class="about-testimonial d-flex">
                            <div class="about-icon">
                                <img src="assets/image/iconoSoporte2.png" alt="Icono de soporte">
                            </div>
                            <div class="about-tittle">
                                <h3><?= esc($soporte[0]['sub2_soporte']) ?></h3>
                                <p>
                                    <i class="fab fa-whatsapp"></i> <?= esc($soporte[0]['sub_parrafo2']) ?>

                                </p>
                            </div>
                        </div>
                        <div class="about-testimonial d-flex">
                            <div class="about-icon">
                                <img src="assets/image/iconoSoporte3.png" alt="Icono de soporte">
                            </div>
                            <div class="about-tittle">
                                <h3><?= esc($soporte[0]['sub3_soporte']) ?></h3>
                                <p><?= esc($soporte[0]['sub_parrafo3']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



     <section id="sistemasSelect" class="blog">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="blog-head">
                        <h2>Conoce nuestros sistemas.aaa</h2>
                        <div class="blog-vic">
                            <img src="./assets/image/others/victor/blog-vic.png" alt="blog-vic-thumb" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mar-top">
                <div class="col-lg-4 blog-p">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="./assets/image/others/ferreteria.jpg" alt="Imagen de ferreteria">
                        </div>
                        <div class="blog-inner">
                            <div class="blog-inner-btn">
                                <a>Sistema</a>
                                <a>Ferreterias</a>
                            </div>
                            <div class="blog-inner-text">
                                <a>Emite tus comprobantes cumpliendo la normativa de SUNAT..</a>
                            </div>
                            <div class="blog-btn">
                                <a>3 days read</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 blog-p">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="./assets/image/others/facturacion.jpg" alt="Imagen de Facturación" />
                        </div>
                        <div class="blog-inner">
                            <div class="blog-inner-btn">
                                <a>Sistema</a>
                                <a>Facturación Electronica</a>
                            </div>
                            <div class="blog-inner-text">
                                <a>Controla el stock de tu producto y mucho más!</a>
                            </div>
                            <div class="blog-btn">
                                <a>3 days read</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 blog-p">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="./assets/image/others/restaurant.jpg" alt="Imagen de restaurante"" />
                        </div>
                        <div class=" blog-inner">
                            <div class="blog-inner-btn">
                                <a>Sistema</a>
                                <a>Restaurantes</a>
                            </div>
                            <div class="blog-inner-text">
                                <a>Controla hasta el último sol que entra o sale de tu negocio..</a>
                            </div>
                            <div class="blog-btn">
                                <a>3 days read</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 blog-p">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="./assets/image/others/ropa.jpg" alt="Imagen de ropa y calzados" />
                        </div>
                        <div class="blog-inner">
                            <div class="blog-inner-btn">
                                <a>Sistema</a>
                                <a>Tiendas de Ropa y Calzados</a>
                            </div>
                            <div class="blog-inner-text">
                                <a>Controla el stock de tu producto! puedes controlarlo por Colores y Tallas!</a>
                            </div>
                            <div class="blog-btn">
                                <a>3 days read</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section> 


   <section class="skills">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="skill-text">
                        <h2>Contamos <br>
                            con el respaldo de.</h2>
                    </div>

                </div>
            </div>
            <div class="row mar-top">

                <?php foreach ($respaldo as $item) : ?>
                    <?php if ($item['estado'] == 1) : ?>
                        <div class="col-lg-4  m-r">
                            <div class="service-overelay"></div>
                            <img class="bordered-image" style=" height: auto; display: block; margin: 0 auto;" src="<?= base_url('public/assets/image/others/' . $item['logo_respaldo']); ?>" alt="Logo de respaldo">
                        </div>
                    <?php endif ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section> 

     skills part end  -->




</main>


<!-- footer part start  -->


<!-- nuestro equipo de ventas -->
<div class="container_equipo_ventas" id="equipo_ventas">
    <p class="title_equipo_ventas">
        Nuestro Equipo de Ventas
    </p>
    <div class="content_user_ventas">
        <img src="<?php echo base_url('public/assets/image/vendedora.png'); ?>" alt="Vendedora 1" class="">
        <img src="<?php echo base_url('public/assets/image/vendedora2.png'); ?>" alt="Vendedora 2" class="">
        <img src="<?php echo base_url('public/assets/image/vendedora3.png'); ?>" alt="Vendedora 3" class="">
    </div>
</div>


<!-- conocenos como la mejor tienda  -->

<div class="container_conocenos">
    <div class="content_herramientas">
        <div class="content_somos">
            <p class="title_somos">Conocenos como<br> la mejor tienda<br> de Herramientas</p>
           <p class="text_somos">Somos una tienda especializada en la venta
                de productos de ferretería, ofreciendo una
                amplia gama de herramientas, materiales y
                suministros para proyectos de construcción,
                reparación y mantenimiento. Contamos con
                productos de alta calidad y un equipo
                dispuesto a asesorarte para encontrar todo lo
                que necesitas.</p>
        </div>

        <div class="content_iconos">
            <div class="conten_iconos_fila1">
                <div class="conten_iconos">
                    <img src="<?php echo base_url('public/assets/image/mapa.png'); ?>" alt=""
                        class="img_iconos_somos"></a>
                    <p class="text_ico">Envios a todo <br>El Perú</p>
                </div>

                <div class="conten_iconos">
                    <img src="<?php echo base_url('public/assets/image/cubo.png'); ?>" alt=""
                        class="img_iconos_somos"></a>
                    <p class="text_ico">Productos <br>de Calidad</p>
                </div>
            </div>

            <div class="content_iconos_fila2">
                <div class="conten_iconos">
                    <img src="<?php echo base_url('public/assets/image/clientes.png'); ?>" alt=""
                        class="img_iconos_somos"></a>
                    <p class="text_ico">Clientes <br>Satisfechos</p>
                </div>

                <div class="conten_iconos">
                    <img src="<?php echo base_url('public/assets/image/dinero.png'); ?>" alt=""
                        class="img_iconos_somos"></a>
                    <p class="text_ico">Los mejores <br>precios del <br>Mercado</p>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- banner_tegnex -->
<img src="<?php echo base_url('public/assets/image/banner_tegnex.png'); ?>" alt="" class="banner_tegnex"></a>




<?php include('plantilla/footer.php')  ?>