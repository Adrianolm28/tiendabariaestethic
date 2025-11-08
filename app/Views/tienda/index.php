<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>

<style>
    .product-name {
        margin-top: 0;
        margin-bottom: 10px;
        /* Espacio inferior para separaciÃ³n */
    }

    .product-name a {
        display: block;
        max-width: 100%;
        /* Limitar el ancho mÃ¡ximo */
        overflow: hidden;
        white-space: nowrap;
        /* Evitar que el texto se rompa */
        text-overflow: ellipsis;
        /* Mostrar puntos suspensivos si el texto es demasiado largo */
    }
    .responsive-video {
        width: 100%;
        height: auto;
        max-width: 100%;
    }
</style>





<div class="section">




    <!-- Capa de anuncio -->

    <!--  <div id="anuncioLayer">
        <?php foreach ($anunciotienda as $anuncio): ?>
            <div class="contenedor_imagen" onclick="window.location.href='<?= site_url('tienda/verproducto/' . $anuncio['id_producto']) ?>'">

                <img id="anuncioImage" src="<?= base_url('public/assets/tienda/img/' . $anuncio['imagen_anuncio']) ?>" alt="Anuncio"
                    width="488" height="563">

                <button id="cerrarAnuncio" onclick="cerrarAnuncio(); event.stopPropagation();">X</button>
            </div>
        <?php endforeach; ?>
    </div> -->

<style>
    @media screen and (max-width: 768px) {
        .anuncioImage {
            max-width: 90vw;
            max-height: 70vh;
            width: 320px !important;
            height: auto !important;
        }
        .contenedor_imagen {
            max-width: 340px !important;
            margin: 0 auto;
        }
    }

    @media screen and (min-width: 769px) {
        #anuncioLayer {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 9999;
        }
        .contenedor_imagen {
            max-width: 500px;
            max-height: 600px;
            margin: 0 auto;
        }
        .anuncioImage {
            width: 100%;
            height: auto;
            /* No max-width ni max-height for desktop, keep original */
            border-radius: 12px;
        }
    }
    #anuncioLayer .contenedor_imagen {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.18);
        padding: 0;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    #cerrarAnuncio {
        position: absolute;
        top: 8px;
        right: 8px;
        background: #fff;
        border: none;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        font-size: 20px;
        color: #e74c3c;
        font-weight: bold;
        z-index: 10;
        box-shadow: 0 1px 4px rgba(0,0,0,0.12);
        cursor: pointer;
        transition: background 0.2s;
    }
    #cerrarAnuncio:hover {
        background: #ffeaea;
    }
</style>

   <div id="anuncioLayer">
        <?php foreach ($anunciotienda as $anuncio): ?>
            <?php if ($anuncio['estado'] == 1): ?> <!-- Mostrar solo anuncios activos -->
                <div class="contenedor_imagen">
                    <img id="anuncioImage-<?= $anuncio['id'] ?>"
                        class="anuncioImage"
                        data-id-producto="<?= $anuncio['id_producto'] ?>"
                        data-id-categoria="<?= $anuncio['id_categoria'] ?>"
                        src="<?= base_url('public/assets/tienda/img/' . $anuncio['imagen_anuncio']) ?>"
                        alt="Anuncio" width="320" height="420">
                    <button id="cerrarAnuncio" onclick="cerrarAnuncio(); event.stopPropagation();">X</button>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>






    <div id="miSwiper2" class="swiper">
        <div class="swiper-wrapper">
            <?php
            // Ordena los banners por el campo 'orden'
            usort($banners, function ($a, $b) {
                return $a['orden'] <=> $b['orden'];
            });

            foreach ($banners as $banner) :
                if ($banner['estado'] == 1) :
            ?>
                    <div class="swiper-slide">
                        <?php if (pathinfo($banner['imagenbanner'], PATHINFO_EXTENSION) === 'mp4'): ?>
                            <video class="img-swiper mi-banner responsive-video" data-producto-id="<?= $banner['id_producto'] ?>"
                                data-categoria-id="<?= $banner['id_categorias'] ?>" autoplay muted loop>
                                <source src="<?= base_url('public/assets/video/bannerstienda/' . $banner['imagenbanner']) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        <?php else: ?>
                            <img class="img-swiper mi-banner" data-producto-id="<?= $banner['id_producto'] ?>"
                                data-categoria-id="<?= $banner['id_categorias'] ?>"
                                src="<?= base_url('public/assets/image/img_tienda/bannerstienda/' . $banner['imagenbanner']) ?>"
                                alt="Imagen Banner">
                        <?php endif; ?>
                    </div>
            <?php
                endif;
            endforeach;
            ?>
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-scrollbar"></div>
    </div>




    <!-- slider principal celular-->
    <div id="slider-principal" class="swiper">
        <div class="swiper-wrapper">
            <?php foreach ($bannerresponsive as $bresponsive) : ?>
                <?php if ($bresponsive['estado'] == 1) : ?>
                    <div class="swiper-slide">
                        <a href="" class="slider_principal_responsive" data-categoria2="<?= $bresponsive['id_categorias'] ?>">
                            <img class="img-swiper"
                                src="<?= base_url('public/assets/image/img_tienda/bannerresponsive/' . $bresponsive['imagenbanner']) ?>"
                                alt="Imagen Banner">
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>


        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>


        <div class="swiper-scrollbar"></div>
    </div>

    <!-- fin slider principal celular -->




    <!-- PROMOCIONES PC ESTATICAS -->
    <div class="content-categorias-promo">
        <?php foreach ($CategoriasPc as $categoriapc) : ?>
            <?php if ($categoriapc['estado'] == 1) : ?>
                <div class="categoria-item">
                    <!-- Imagen -->
                    <a href="" class="categorias_pc_img" data-categoria2="<?= $categoriapc['id_categorias'] ?>">
                        <img src="<?= base_url('public/assets/image/img_tienda/categoriaspc/' . $categoriapc['imagenbanner']) ?>"
                            alt="<?= $categoriapc['nombre_image'] ?>" class="categoria-imagen">
                        <div class="content-item">
                            <p class="name_imagen"><?= $categoriapc['nombre_image'] ?></p>
                            <!-- Texto o descripciÃ³n -->
                            <p class="name_texto"><?= $categoriapc['texto'] ?> <i class="bi bi-arrow-right-circle"></i> </p>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <!-- /PROMOCIONES PC ESTATICAS -->



    <!-- slider categorias celular-->
    <div id="slider-categorias" class="swiper">
        <div class="swiper-wrapper">
            <?php foreach ($promocionesresponsive as $poresponsive) : ?>
                <?php if ($poresponsive['estado'] == 1) : ?>
                    <div class="swiper-slide">
                        <a href="" class="slider_principal_responsive" data-categoria2="<?= $poresponsive['id_categorias'] ?>">
                            <img class="img-swiper"
                                src="<?= base_url('public/assets/image/img_tienda/promocionesresponsive/' . $poresponsive['imagenbanner']) ?>"
                                alt="Imagen Banner">
                    </div>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>


        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>


        <div class="swiper-scrollbar"></div>
    </div>

    <!-- fin categoria celular -->


    <!-- /container -->

    <!-- los mas buscados pc -->
    <div class="container-promo">
        <div class="  titulo_mas_buscados">
            <h2 class="titulo_promo">Los más Buscado!</h2>
        </div>

        <!-- row -->
            <div class="grid-gallery">
            <?php foreach ($orfertasdescuento as $of) : ?>
                <?php if ($of['estado'] == 1) : ?>
                    <div class="grid-item">
                      <a href="#" 
                           class="producto-img" 
                           data-id="<?= $of['id_oferta'] ?>" 
                           data-categoria="<?= $of['id_categoria'] ?>" 
                           data-subcategoria="<?= $of['id_subcategoria'] ?>" 
                           data-lightbox="gridImage">
                            <img src="<?= base_url('public/assets/img_tienda/img_ofertas/' . $of['imagen_oferta']) ?>" 
                                 alt="Imagen Producto">
                        </a>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>

        <!-- /shop -->

        <!-- /row -->
    </div>


    <!-- fin grilla -->


    <!-- /container -->
</div>
<!-- /SECTION -->

<!--IMAGEN PUBLICITARIO-->

<div class="imagen_profesional">
</div>



<!-- CARRUSEL DE CATEGORIAS -->
<div class="section">

    <div class="container">

        <div class="row">


            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title title_productos">Productos</h3>

                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">

                        </ul>
                    </div>
                </div>
            </div>

           

            <div class="col-md-12">

                <div class="row">
                    <div class="products-tabs">

                        <div id="tab1" class="tab-pane active">


                            <div class="slick-carousel" data-nav="#slick-nav-1">


                                <?php foreach ($productosCategoria as $proc) : ?>

                                    <?php
                                    $precio = floatval($proc['precio']);
                                    $precioConDescuento = $precio;
                                    if (floatval($proc['producto_descuento']) > 0) {
                                        $descuento = floatval($proc['producto_descuento']);
                                        $precioConDescuento = $precio - ($precio * ($descuento / 100));
                                    }

                                    $precioMostrar = $precioConDescuento > 0 ? $precioConDescuento : $precio;

                                    $descuentoHtml = '';
                                    if (floatval($proc['producto_descuento']) > 0) {
                                        $descuento = floatval($proc['producto_descuento']);
                                        $descuentoHtml = '<span class="sale">-' . rtrim(rtrim(number_format($descuento, 2), '0'), '.') . '%</span>';
                                    }


                                    // Manejo de precio de transferencia y su descuento
                                    $precioTransferencia = intval($proc['precio_transferencia']);
                                    $descuentoTransferenciaHtml = '';
                                    $precioTransferenciaHtml = '';

                                    if ($precioTransferencia > 0) {
                                        $precioTransferenciaHtml = '<div class="price-container"><span class="product-transfer-price">S/' . $precioTransferencia . '</span>';
                                        if (intval($proc['descuento_transferencia']) > 0) {
                                            $descuentoTransferenciaHtml = '<span class="product-discount1">- ' . intval($proc['descuento_transferencia']) . '%</span>';
                                        }
                                        $precioTransferenciaHtml .= '</div>';
                                    } else {
                                        $precioTransferenciaHtml = '<div class="price-container"><span style="visibility: hidden;" class="product-transfer-price">S/' . $precioTransferencia . '</span></div>';
                                        if (intval($proc['descuento_transferencia']) > 0) {
                                            $descuentoTransferenciaHtml = '<span style="visibility: hidden;" class="product-discount1">- ' . intval($proc['descuento_transferencia']) . '%</span>';
                                        }
                                    }
                                    $precioAnteriorSinDecimales = intval($proc['precio_anterior']);
                                    ?>


                                    <div class="product">
                                        <a href="<?= base_url('tienda/verproducto/') . $proc['id_producto'] ?>">
                                            <div class="product-img">
                                                <img src="<?= base_url('public/assets/img_tienda/productos/' . $proc['imagen_producto']) ?>"
                                                    alt="Imagen producto tienda" width="204" height="204">

                                                <div class="product-quantity-container"
                                                    style="display: flex; align-items: center; justify-content: start; ">
                                                    <?php if ($proc['delivery'] == 1): ?> <img
                                                            src="public/assets/image/delivery.png" alt="Entrega disponible"
                                                            class="delivery"> <?php endif; ?>
                                                </div>


                                                <div class="product-label">
                                                    <?= $descuentoHtml ?>
                                                    
                                                </div>
                                            </div>

                                            <div class="product-body">
                                           <p class="product-category"><?= $proc['nombre'] ?></p>

                                                <h3 class="product-name">
                                                    <a href="<?= base_url('tienda/verproducto/') . $proc['id_producto'] ?>">
                                                        <span class="product-name-text"><?= $proc['nombre'] ?></span>
                                                    </a>
                                                </h3>
                                                <div class="tranferencia">
                                                    <p class="fondo-tra">Transferencia</p>
                                                    <img src="<?= base_url('public/assets/image/bcp.webp') ?>"
                                                        alt="Contactanos" class="bcp-logo">
                                                </div>

                                                <?= $descuentoTransferenciaHtml ?>
                                                <?= $precioTransferenciaHtml ?>
                                                <h4 class="product-price">S/<?= $precioMostrar ?><del
                                                        class="product-old-price">S/<?= $precioAnteriorSinDecimales ?></del>
                                                </h4>

                                                <div class="add-to-cart">
                                                    <div class="container-card">
                                                        <div class="quantity-container">
                                                            <button class="quantity-btn decrement-btn"
                                                                data-id="<?= $proc['id_producto'] ?>">-</button>
                                                            <input type="text"
                                                                id="quantity-categoria-<?= $proc['id_producto'] ?>"
                                                                class="product-quantity" value="1" min="1"
                                                                data-id="<?= $proc['id_producto'] ?>">

                                                            <button class="quantity-btn increment-btn"
                                                                data-id="<?= $proc['id_producto'] ?>">+</button>
                                                        </div>

                                                        <button class="add-to-cart-btn"
                                                            data-id="<?= $proc['id_producto'] ?>"
                                                            data-nombre="<?= $proc['nombre'] ?>"
                                                            data-precio="<?= $precioMostrar ?>"
                                                    
                                                    
                                                            data-preciotransferencia="<?= $proc['precio_transferencia'] ?>"
                                                            data-cantidad="1"
                                                            data-imagen="<?= base_url('public/assets/img_tienda/productos/') . $proc['imagen_producto'] ?>">
                                                            <i class="fa fa-shopping-cart"></i> Agregar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                <?php endforeach ?>
                            </div>

                            <!-- products-slick-nav -->
                            <div id="slick-nav-1" class="slick-buttons-container"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>


<!-- mas buscados  celular-->
<div class="container_masbuscado_responsive">
    <?php $counter = 1; ?>
    <?php foreach ($masbuscadoresponsive as $masbuscados) : ?>
        <?php if ($masbuscados['estado'] == 1) : ?>
            <!-- El enlace debe envolver toda la imagen -->
            <a href="" class="carrusel_mas_buscado_celular" data-categoria2="<?= $masbuscados['id_categorias'] ?>">

                <?php if ($counter % 3 == 1) : ?>
                    <!-- Imagen 1, 4, 7, 10, ... (50%) -->
                    <div class="imagen-container" style="width: 50%; display: inline-block;">
                        <img src="<?= base_url('public/assets/image/img_tienda/masbuscadoresponsive/' . $masbuscados['imagenbanner']) ?>"
                            alt="Imagen Banner" class="imagen<?= $counter ?>" style="width: 100%; height:auto;">
                    </div>
                <?php elseif ($counter % 3 == 2) : ?>
                    <!-- Imagen 2, 5, 8, 11, ... (45%) -->
                    <div class="imagen-container" style="width: 45%; display: inline-block;">
                        <img src="<?= base_url('public/assets/image/img_tienda/masbuscadoresponsive/' . $masbuscados['imagenbanner']) ?>"
                            alt="Imagen Banner" class="imagen<?= $counter ?>" style="width: 100%; height: auto;">
                    </div>
                <?php elseif ($counter % 3 == 0) : ?>
                    <!-- Imagen 3, 6, 9, 12, ... (100%) -->
                    <div class="imagen-container" style="width: 96%; display: inline-block;">
                        <img src="<?= base_url('public/assets/image/img_tienda/masbuscadoresponsive/' . $masbuscados['imagenbanner']) ?>"
                            alt="Imagen Banner" class="imagen<?= $counter ?>" style="width: 100%; height: auto;">
                    </div>
                <?php endif; ?>

            </a> <!-- El cierre del enlace estÃ¡ aquÃ­, despuÃ©s de toda la imagen -->
            <?php $counter++; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>











<!-- ANUNCIO -->
<div class="swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
           
            <div class="anuncio2">
                <img src="<?= base_url('public/assets/tienda/img/anuncio2.webp')  ?>" alt="Imagen de anuncio"
                    width="100%" height="auto">
            </div>
        </div>
    </div>
</div>



<!-- slider ofertas pc -->
<div id="miSwiper" class="swiper">

    <div class="swiper-wrapper">
        <?php foreach ($ofertas as $oferta) : ?>
            <div class="swiper-slide">
                <?php
                $visibilityStyle = (empty($oferta['secs']) || $oferta['secs'] == 0) ? 'visibility: hidden;' : '';
                ?>
                <div id="hot-deal" class="section"
                    style="background-image: url('<?= base_url('public/assets/image/img_tienda/ofertasbanner/') . $oferta['image'] ?>');"
                    alt="DescripciÃ³n de la imagen relacionada con la oferta especial">
                    <!-- container -->
                    <div class="container" style="<?= $visibilityStyle ?>">
                        <!-- row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hot-deal">
                                    <input type="hidden" id="created_at" value="<?= $oferta['created_at'] ?>">
                                    <input type="hidden" id="end_time" value="<?= $oferta['end_time'] ?>">

                                    <ul id="countdown" class="hot-deal-countdown">
                                        <li>
                                            <div>
                                                <h3 id="days">00</h3>
                                                <span>Days</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <h3 id="hours">00</h3>
                                                <span>Hours</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <h3 id="minutes">00</h3>
                                                <span>Mins</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div>
                                                <h3 id="seconds">00</h3>
                                                <span>Secs</span>
                                            </div>
                                        </li>
                                    </ul>

                                    <h2 class="text-uppercase"><?= $oferta['title'] ?></h2>
                                    <p><?= $oferta['description'] ?><span>
                                            <p>%<?= $oferta['discount'] ?></p>
                                        </span> </p>
                                    <p>de descuento</p>
                                    <a class="primary-btn cta-btn" href="#">COMPRAR AHORA</a>
                                </div>
                            </div>
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /container -->
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <div class="swiper-pagination"></div>


    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>



</div>



<!-- SECTION  NUESTRAS MARCAS PC-->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Nuestras Marcas</h3>

                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">

                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="slick-carousel" data-nav="#slick-nav-2">
                                <!-- product -->
                                <?php foreach ($productosMarca as $prom) : ?>

                                    <?php
                                    $precio = floatval($prom['precio']);
                                    $precioConDescuento = $precio;
                                    if (floatval($prom['producto_descuento']) > 0) {
                                        $descuento = floatval($prom['producto_descuento']);
                                        $precioConDescuento = $precio - ($precio * ($descuento / 100));
                                    }

                                    $precioMostrar = $precioConDescuento > 0 ? $precioConDescuento : $precio;

                                    $descuentoHtml = '';
                                    if (floatval($prom['producto_descuento']) > 0) {
                                        $descuento = floatval($prom['producto_descuento']);
                                        $descuentoHtml = '<span class="sale">-' . rtrim(rtrim(number_format($descuento, 2), '0'), '.') . '%</span>';
                                    }


                                    $precioTransferenciaHTML = '';
                                    $descuentoTransferenciaHtml = '';
                                    if (floatval($prom['precio_transferencia']) > 0) {
                                        // Elimina los decimales del precio usando intval
                                        $precioSinDecimales = intval($prom['precio_transferencia']);
                                        $transfrenciaDescuentoSinDecimal = intval($prom['descuento_transferencia']);

                                        $precioTransferenciaHTML = '<div class="price-container">
                                         <span class="product-transfer-price">S/' . $precioSinDecimales . '</span>';

                                        if ($prom['descuento_transferencia']) {
                                            $descuentoTransferenciaHtml = '<span class="product-discount1">- ' . $transfrenciaDescuentoSinDecimal . '%</span>';
                                        }
                                        $precioTransferenciaHTML .= '</div>';
                                    } else {
                                        $precioSinDecimales = intval($prom['precio_transferencia']);
                                        $transfrenciaDescuentoSinDecimal = intval($prom['descuento_transferencia']);

                                        $precioTransferenciaHTML = '<div class="price-container">
                                         <span style="visibility: hidden;" class="product-transfer-price">S/' . $precioSinDecimales . '</span>';

                                        if ($prom['descuento_transferencia']) {
                                            $descuentoTransferenciaHtml = '<span style="visibility: hidden;" class="product-discount1">- ' . $transfrenciaDescuentoSinDecimal . '%</span>';
                                        }
                                        $precioTransferenciaHTML .= '</div>';
                                    }
                                    $precioAnteriorSinDecimales = intval($prom['precio_anterior']);
                                    ?>



                                    <div class="product">
                                        <div class="product-img">
                                            <img src="<?= base_url('public/assets/img_tienda/productos/' . $prom['imagen_producto']) ?>"
                                                alt="Imagen producto tienda" width="204" height="204">

                                            <div class="product-label">
                                                <?= $descuentoHtml ?>
                                                
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category"><?= $prom['nombre_marca'] ?></p>
                                            <p class="product-category"><?= $prom['nombre'] ?></p>
                                            <h3 class="product-name">
                                                <a href="<?= base_url('tienda/verproducto/') . $prom['id_producto'] ?>">
                                                    <span class="product-name-text"><?= $prom['nombre'] ?></span>
                                                </a>
                                            </h3>
                                            <div class="tranferencia">
                                                <p class="fondo-tra">Transferencia</p>
                                                <img src="<?= base_url('public/assets/image/bcp.webp') ?>" alt="Contactanos"
                                                    class="bcp-logo">
                                            </div>
                                            <?= $descuentoTransferenciaHtml ?>
                                            <?= $precioTransferenciaHTML ?>

                                            <h4 class="product-price">S/<?= $precioMostrar ?><del
                                                    class="product-old-price">S/<?= $precioAnteriorSinDecimales ?></del>
                                            </h4>

                                            <div class="add-to-cart">
                                                <div class="container-card">
                                                    <div class="quantity-container">
                                                        <button class="quantity-btn decrement-btn"
                                                            data-id="<?= $prom['id_producto'] ?>">-</button>
                                                        <input type="text" id="quantity-marca-<?= $prom['id_producto'] ?>"
                                                            class="product-quantity" value="1" min="1"
                                                            data-id="<?= $prom['id_producto'] ?>">


                                                        <button class="quantity-btn increment-btn"
                                                            data-id="<?= $prom['id_producto'] ?>">+</button>
                                                    </div>

                                                    <button class="add-to-cart-btn" data-id="<?= $prom['id_producto'] ?>"
                                                        data-nombre="<?= $prom['nombre'] ?>"
                                                        data-precio="<?= $precioMostrar ?>"
                                                
                                                        data-preciotransferencia="<?= $proc['precio_transferencia'] ?>"
                                                        data-cantidad="1"
                                                        data-imagen="<?= base_url('public/assets/img_tienda/productos/') . $prom['imagen_producto'] ?>">
                                                        <i class="fa fa-shopping-cart"></i> Agregar
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                <?php endforeach ?>
                                <!-- /product -->



                            </div>
                            <div id="slick-nav-2" class="slick-buttons-container"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row" id="mas-vendidos">
            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">MÃ¡s vendidos Categoria</h4>
                    <div class="section-nav">
                        <div id="slick-nav-3" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-3">
                    <div>
                        <!-- product widget -->
                        <?php foreach ($productosCat as $producto) : ?>
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="<?= base_url('public/assets/img_tienda/productos/' . $producto['imagen_producto']) ?>"
                                        alt="<?= htmlspecialchars($producto['nombre']) ?>" width="60" height="60">

                                </div>
                                <div class=" product-body">
                                    <p class="product-category"><?= esc($producto['nombre']) ?></p>
                                    <h3 class="product-name"><a
                                            href="<?= base_url('tienda/verproducto/') . $producto['id_producto'] ?>"><?= esc($producto['nombre']) ?></a>
                                    </h3>
                                    <h4 class="product-price">S/.<?= number_format($producto['precio'], 2) ?> <del
                                            class="product-old-price">S/.<?= number_format($producto['precio_anterior'], 2) ?></del>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">MÃ¡s vendidos Marca</h4>
                    <div class="section-nav">
                        <div id="slick-nav-4" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-4">
                    <div>
                        <!-- product widget -->
                        <?php foreach ($productosMar as $producto) : ?>
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="<?= base_url('public/assets/img_tienda/productos/' . $producto['imagen_producto']) ?>"
                                        alt="<?= htmlspecialchars($producto['nombre']) ?>" width="60" height="60">
                                </div>
                                <div class=" product-body">
                                    <p class="product-category"><?= esc($producto['nombre']) ?></p>
                                    <h3 class="product-name"><a
                                            href="<?= base_url('tienda/verproducto/') . $producto['id_producto'] ?>"><?= esc($producto['nombre']) ?></a>
                                    </h3>
                                    <h4 class="product-price">S/.<?= number_format($producto['precio'], 2) ?> <del
                                            class="product-old-price">S/.<?= number_format($producto['precio_anterior'], 2) ?></del>
                                    </h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                        <?php endforeach; ?>
                        <!-- /product widget -->

                    </div>


                </div>
            </div>

            <div class="clearfix visible-sm visible-xs"></div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">MÃ¡s vendidos Modelo</h4>
                    <div class="section-nav">
                        <div id="slick-nav-5" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-5">
                    <div>
                        <!-- product widget -->
                        <?php foreach ($productosMod as $producto) : ?>
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="<?= base_url('public/assets/img_tienda/productos/' . $producto['imagen_producto']) ?>"
                                        alt="<?= htmlspecialchars($producto['nombre']) ?>" width="60" height="60">
                                </div>
                                <div class=" product-body">
                                    <p class="product-category"><?= esc($producto['nombre']) ?></p>
                                    <h3 class="product-name"><a
                                            href="<?= base_url('tienda/verproducto/') . $producto['id_producto'] ?>"><?= esc($producto['nombre']) ?></a>
                                    </h3>
                                    <h4 class="product-price">S/.<?= number_format($producto['precio'], 2) ?> <del
                                            class="product-old-price">S/.<?= number_format($producto['precio_anterior'], 2) ?></del>
                                    </h4>
                                </div>
                            </div>
                            <!-- /product widget -->

                        <?php endforeach; ?>

                    </div>


                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
<!-- FIN  NUESTRAS MARCAS PC-->

<!-- productos vendidos celular -->
<div class="container-mas-vendidos">
    <div class="categoria-vendida">
        <h4 class="title2">MÃ¡s vendidos Categoria</h4>
        <!-- product widget -->
        <?php foreach ($productosCat as $producto) : ?>
            <div class="product-widget">
                <div class="product-img">
                    <img src="<?= base_url('public/assets/img_tienda/productos/' . $producto['imagen_producto']) ?>"
                        alt="<?= htmlspecialchars($producto['nombre']) ?>" width="60" height="60">

                </div>
                <div class=" product-body">
                    <p class="product-category"><?= esc($producto['nombre']) ?></p>
                    <h3 class="product-name"><a
                            href="<?= base_url('tienda/verproducto/') . $producto['id_producto'] ?>"><?= esc($producto['nombre']) ?></a>
                    </h3>
                    <h4 class="product-price">S/.<?= number_format($producto['precio'], 2) ?> <del
                            class="product-old-price">S/.<?= number_format($producto['precio_anterior'], 2) ?></del></h4>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="marca-vendida">
        <h4 class="title2">MÃ¡s vendidos Categoria</h4>
        <?php foreach ($productosMar as $producto) : ?>
            <!-- product widget -->
            <div class="product-widget">
                <div class="product-img">
                    <img src="<?= base_url('public/assets/img_tienda/productos/' . $producto['imagen_producto']) ?>"
                        alt="<?= htmlspecialchars($producto['nombre']) ?>" width="60" height="60">
                </div>
                <div class=" product-body">
                    <p class="product-category"><?= esc($producto['nombre']) ?></p>
                    <h3 class="product-name"><a
                            href="<?= base_url('tienda/verproducto/') . $producto['id_producto'] ?>"><?= esc($producto['nombre']) ?></a>
                    </h3>
                    <h4 class="product-price">S/.<?= number_format($producto['precio'], 2) ?> <del
                            class="product-old-price">S/.<?= number_format($producto['precio_anterior'], 2) ?></del></h4>
                </div>
            </div>
            <!-- /product widget -->

        <?php endforeach; ?>

    </div>
</div>


<!-- SUSCRIBETE PC-->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Suscribete para más<strong> Ofertas</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Email">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Suscribete</button>
                    </form>
                    <ul class="newsletter-follow">
                        <?php if (!empty($empresa[0]['empresa_facebook'])): ?>
                        <li>
                            <a href="<?= esc($empresa[0]['empresa_facebook']); ?>" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (!empty($empresa[0]['empresa_instagram'])): ?>
                        <li>
                            <a href="<?= esc($empresa[0]['empresa_instagram']); ?>" target="_blank">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (!empty($empresa[0]['empresa_youtube'])): ?>
                        <li>
                            <a href="<?= esc($empresa[0]['empresa_youtube']); ?>" target="_blank">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (!empty($empresa[0]['empresa_tiktok'])): ?>
                        <li>
                            <a href="<?= esc($empresa[0]['empresa_tiktok']); ?>" target="_blank">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (!empty($empresa[0]['empresa_twitter'])): ?>
                        <li>
                            <a href="<?= esc($empresa[0]['empresa_twitter']); ?>" target="_blank">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (!empty($empresa[0]['empresa_linkedin'])): ?>
                        <li>
                            <a href="<?= esc($empresa[0]['empresa_linkedin']); ?>" target="_blank">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php if (!empty($empresa[0]['empresa_pinterest'])): ?>
                        <li>
                            <a href="<?= esc($empresa[0]['empresa_pinterest']); ?>" target="_blank">
                                <i class="fa fa-pinterest"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>




<!-- ANUNCIo mapa del peru -->
<div class="swiper">
    <div class="swiper-slide">
       <img src="<?= base_url('public/assets/tienda/img/banner.jpg')  ?>" alt="Imagen de anuncio" width="1519"
            height="165">
    </div>
</div>


<script>
    function cerrarAnuncio() {
        // Ocultar la capa de anuncio
        var anuncioLayer = document.getElementById('anuncioLayer');
        anuncioLayer.style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Prevent closing the anuncioLayer when clicking outside the "X" button
        var anuncioLayer = document.getElementById('anuncioLayer');
        anuncioLayer.addEventListener('click', function(event) {
            if (event.target.id === 'cerrarAnuncio') {
                cerrarAnuncio();
            }
        });

        // Ensure the anuncioLayer remains visible
        const anuncioImages = document.querySelectorAll('.anuncioImage');
        anuncioImages.forEach(function(image) {
            image.addEventListener('mouseover', function() {
                // No timeout logic; keep the container visible
                console.log('Mouse over anuncio image, keeping it visible.');
            });
        });
    });
</script>
<script>
    $(document).ready(function() {


        // Manejador de evento para hacer clic en la imagen del anuncio
        $('.anuncioImage').on('click', function(e) {
            // Obtener los valores de data-id-producto y data-id-categoria
            var idProducto = $(this).data('id-producto');
            var idCategoria = $(this).data('id-categoria');

            console.log('producto', idProducto);
            console.log('categoria', idCategoria);

            // Validamos si existe idProducto o idCategoria
            if (idProducto && idProducto > 0) {
                // Si existe un id_producto, redirige al producto
                window.location.href = '<?= site_url('tienda/verproducto/') ?>' + idProducto;
            } else if (idCategoria && idCategoria > 0) {
                // Si existe un id_categoria, redirige a la categorÃ­a
                window.location.href = '<?= base_url('shop') ?>?id_categoria2=' + idCategoria;
            } else {
                // Si no hay id_producto ni id_categoria
                alert("No hay producto ni categorÃ­a vÃ¡lida.");
            }
        });


        $('.slick-carousel').each(function() {
            var $carousel = $(this);
            var navId = $carousel.data('nav');

            $carousel.slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                dots: true,
                arrows: false,
                prevArrow: '<button type="button" class="slick-prev_c"></button>',
                nextArrow: '<button type="button" class="slick-next_c"></button>',
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        }
                    }
                ]
            });

            // Mueve las flechas de navegaciÃ³n al contenedor adecuado
            $carousel.on('init', function(event, slick) {
                $(navId).append($carousel.find('.slick-prev_c'));
                $(navId).append($carousel.find('.slick-next_c'));
            });

            // Re-inicializa para asegurarse de que las flechas se muevan despuÃ©s de la configuraciÃ³n inicial
            $carousel.slick('setPosition');
        });


      $('.producto-img').on('click', function(e) {
    e.preventDefault();

    var idCategoria2 = $(this).data('categoria2');
    var idCategoria = $(this).data('categoria');

    console.log('id_categoria2:', idCategoria2);
    console.log('id_categoria:', idCategoria);

    // ...existing code...
});



        // Manejador de evento para clic en elementos con categorías
        $('.categorias_pc_img, .producto-img, .slider_principal_responsive, .carrusel_mas_buscado_celular').on('click', function(e) {
            e.preventDefault();

            // Obtener el ID de la categoría desde el atributo 'data-categoria2'
            var idCategoria2 = $(this).data('categoria2') || $(this).data('categoria'); // Compatibilidad con ambos atributos

            console.log('Categoría ID2: ', idCategoria2);

            // Redirigir siempre con id_categoria2
            if (idCategoria2) {
                var url = '<?= site_url('shop') ?>?id_categoria2=' + idCategoria2;
                window.location.href = url;
            } else {
                console.warn('No se encontró un ID de categoría válido.');
            }
        });


        $('.mi-banner').on('click', function(e) {
            e.preventDefault();

            // Obtener los IDs de producto y categorÃ­a desde los atributos data
            var idProducto = $(this).data('producto-id');
            var idCategoria = $(this).data('categoria-id');

            // Verificar las condiciones
            if (idCategoria === 0 && idProducto > 0) {
                // Redirigir a la pÃ¡gina del producto
                var urlProducto = '<?= site_url('tienda/verproducto') ?>/' + idProducto;
                window.location.href = urlProducto;

            } else if (idProducto === 0 && idCategoria > 0) {
                // Redirigir a la pÃ¡gina de categorÃ­a
                var urlCategoria = '<?= site_url('shop') ?>?id_categoria2=' + idCategoria;
                window.location.href = urlCategoria;

            } else {
                console.warn('Ambos ID son 0 o no vÃ¡lidos');
            }
        });

        $('input[type="checkbox"]:checked').each(function() {
            // CÃ³digo a ejecutar para cada checkbox marcado al cargar la pÃ¡gina
            console.log("Checkbox marcado:", $(this).data('id'));
        });




        /* 
                var anuncioImage = document.getElementById('anuncioImage');
                if (anuncioImage.complete) {
                    console.log('El anuncio se ha cargado correctamente.');
                } else {
                    console.log('El anuncio aÃºn se estÃ¡ cargando...');
                } */


        function updateCountdown() {
            // Obtener la fecha y hora actual
            var now = new Date().getTime();

            // Verificar si el elemento "end_time" existe
            var endTimeElement = document.getElementById("end_time");
            if (!endTimeElement) {
                console.error("El elemento con id 'end_time' no existe.");
                clearInterval(countdownInterval); // Detener el intervalo si el elemento no estÃ¡ presente
                return;
            }

            // Obtener la fecha y hora de finalizaciÃ³n de la oferta
            var endTimeValue = endTimeElement.value;
            var endTime = new Date(endTimeValue).getTime();

            // Validar que el valor sea una fecha vÃ¡lida
            if (isNaN(endTime)) {
                console.error("El valor de 'end_time' no es una fecha vÃ¡lida:", endTimeValue);
                clearInterval(countdownInterval);
                return;
            }

            // Calcular el tiempo restante hasta la fecha y hora de finalizaciÃ³n
            var timeLeft = endTime - now;

            // Calcular los dÃ­as, horas, minutos y segundos restantes
            var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            // Actualizar los elementos HTML con los nuevos valores
            updateElement("days", days);
            updateElement("hours", hours);
            updateElement("minutes", minutes);
            updateElement("seconds", seconds);

            // Si la cuenta regresiva ha terminado, detener la actualizaciÃ³n
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                console.log("La cuenta regresiva ha terminado.");
                // Puedes agregar aquÃ­ alguna acciÃ³n adicional cuando la cuenta regresiva termine
            }
        }

        // FunciÃ³n para actualizar un elemento del DOM de forma segura
        function updateElement(id, value) {
            var element = document.getElementById(id);
            if (element) {
                element.innerText = formatTime(value);
            } else {
                console.warn(`El elemento con id '${id}' no existe.`);
            }
        }

        // FunciÃ³n para agregar ceros a la izquierda si el valor es menor que 10
        function formatTime(time) {
            return time < 10 ? "0" + time : time;
        }

        // Actualizar la cuenta regresiva cada segundo
        var countdownInterval = setInterval(updateCountdown, 1000);

        // Actualizar la cuenta regresiva por primera vez al cargar la pÃ¡gina
        updateCountdown();


        $('.add-to-cart-btn').on('click', function() {
            var productId = $(this).data('id');
            var productName = $(this).data('nombre');
            var productPrice = parseFloat($(this).data('precio'));
            var productImage = $(this).data('imagen');
            var precio_transferencia = $(this).data('preciotransferencia')

            console.log('trayendo pt', precio_transferencia);

            // Obtener valor del input de cantidad segÃºn el contexto
            var inputQuantity;
            if ($(this).closest('#tab1').length > 0) {
                inputQuantity = $("#quantity-categoria-" + productId).val();
            } else if ($(this).closest('#tab2').length > 0) {
                inputQuantity = $("#quantity-marca-" + productId).val();
            }

            var productQuantity = 1; // Valor por defecto si el input estÃ¡ vacÃ­o o no es un nÃºmero
            if (inputQuantity && !isNaN(inputQuantity)) {
                productQuantity = parseInt(inputQuantity);
            }

            var filename = productImage.substring(productImage.lastIndexOf('/') + 1);

            // Verificar si hay un precio con descuento disponible y utilizarlo si es mayor que 0
            var discountedPrice = parseFloat($(this).data('precio-con-descuento'));
            if (!isNaN(discountedPrice) && discountedPrice > 0) {
                productPrice = discountedPrice;
            }

            // Verificar si el producto ya existe en el carrito
            var productoExistenteIndex = carrito.findIndex(function(item) {
                return item.id === productId;
            });
            if (productoExistenteIndex !== -1) {
                // Incrementar la cantidad si ya estÃ¡ en el carrito
                carrito[productoExistenteIndex].cantidad += parseInt(productQuantity);
            } else {
                // Agregar nuevo producto al carrito
                var producto = {
                    id: productId,
                    nombre: productName,
                    precio: productPrice,
                    cantidad: parseInt(productQuantity),
                    imagen: filename,
                    precio_transferencia: precio_transferencia,
                };
                carrito.push(producto);

                console.log('producto', producto);
            }

            // Funciones adicionales para mostrar notificaciÃ³n, actualizar vista de carrito, guardar en localStorage, etc.
            mostrarNotificacion();
            actualizarVistaCarrito();
            guardarCarritoEnLocalStorage();
        });





    });
</script>

<script>

$(document).on('click', '.mi-banner', function(e) {
    e.preventDefault();

    // Obtener los IDs de producto y categoría desde los atributos data
    var idProducto = $(this).data('producto-id');
    var idCategoria = $(this).data('categoria-id');

    // Verificar las condiciones
    if (idProducto > 0) {
        // Redirigir a la página del producto
        var urlProducto = '<?= site_url('tienda/verproducto') ?>/' + idProducto;
        window.location.href = urlProducto;
    } else if (idCategoria > 0) {
        // Redirigir a la página de la categoría
        var urlCategoria = '<?= site_url('shop') ?>?id_categoria2=' + idCategoria;
        window.location.href = urlCategoria;
    } else {
        console.warn('No se encontró un ID de producto o categoría válido.');
    }
});
</script>

<?php echo $this->endSection(); ?>