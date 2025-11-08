<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>
<style>
    /* Estilos para el contenedor del stock */
    .stock-container {
        background-color: red;
        padding: 5px 10px;
        /* Ajusta el relleno según sea necesario */
        border-radius: 5px;
        /* Ajusta el radio del borde según sea necesario */
        text-align: center;
        /* Centra el contenido horizontalmente */
        width: 15%;
    }

    /* Estilos para el texto dentro del contenedor */
    .stock-container span {
        color: white;
        /* Color de texto blanco */
    }

    .trans-label {
        background-color: red;
        color: white;
        padding: 2px 8px;
        border-radius: 8px;
        font-size: 0.8em;
        margin-left: 10px;

    }

    .product-transfer-price {
        margin: 5px;
        font-size: 24px;
    }

    .custom-row-stock-cantidad {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 16px;
        margin-bottom: 10px;
        width: 100%;
    }

    .custom-stock {
        background: #e53935;
        color: #fff;
        font-size: 1.3em;
        font-weight: bold;
        border-radius: 12px;
        padding: 10px 0;
        width: 120px;
        min-width: 120px;
        margin: 0 10px;
        text-align: center;
        display: inline-block;
    }

    .custom-disponible {
        color: #e53935;
        font-weight: bold;
        text-align: center;
        margin-top: 8px;
        font-size: 1em;
        letter-spacing: 1px;
    }

    .custom-add-btn {
        background: #e53935;
        color: #fff;
        font-size: 2.5em;
        border-radius: 22px;
        padding: 38px 0;
        width: 100%;
        min-width: 260px;
        max-width: 700px;
        border: none;
        margin: 28px auto 28px auto;
        display: block;
        transition: background 0.2s;
        text-align: center;
        font-weight: bold;
        letter-spacing: 1px;
        box-shadow: 0 2px 12px rgba(229,57,53,0.12);
    }

    .custom-add-btn:hover {
        background: #b71c1c;
    }

        .custom-row-stock-cantidad {
            flex-direction: row;
            gap: 10px;
            align-items: center;
        }
        .custom-stock {
            width: 120px;
            min-width: 120px;
            margin: 0 10px;
            font-size: 1.1em;
            padding: 10px 0;
        }
        .custom-add-btn {
            width: 100%;
            min-width: 220px;
            max-width: 700px;
            font-size: 2.2em;
            padding: 32px 0;
        }
    }

        .custom-row-stock-cantidad {
            flex-direction: row;
            gap: 8px;
            align-items: center;
        }
        .custom-stock {
            width: 120px;
            min-width: 120px;
            font-size: 1em;
            padding: 10px 0;
        }
        .custom-add-btn {
            width: 100%;
            font-size: 1.7em;
            padding: 22px 0;
            max-width: 700px;
        }
    }

    @media (max-width: 480px) {
        .custom-add-btn {
            font-size: 1.3em;
            padding: 16px 0;
            max-width: 100%;
        }
        .custom-stock {
            font-size: 1em;
            padding: 10px 0;
        }
        .custom-disponible {
            font-size: 0.9em;
        }
    }
</style>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="<?= base_url() ?>">Inicio</a></li>
                    <li><a href="">Categorías</a></li>
                  
                    <li class="active"><?= $producto['nombre'] ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /container -->
</div>


<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <input id="productId" type="hidden" value="<?php echo $producto['id_producto'] ?>">

        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <!--  <div class="product-preview">
                        <img src="<?= base_url('public/assets/img_tienda/productos/' . $producto['imagen_producto']) ?>" alt="">
                    </div> -->

                    <?php foreach ($producto['imagenes'] as $imagen) : ?>
                        <div class="product-preview">
                            <img src="<?= base_url('public/assets/img_tienda/productos/' . $imagen['nombre_archivo']) ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs" class="product-preview">
                    <?php foreach ($producto['imagenes'] as $imagen) : ?>
                        <div class="product-preview">
                            <img src="<?= base_url('public/assets/img_tienda/productos/' . $imagen['nombre_archivo']) ?>" alt="">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- /Product thumb imgs -->


            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name"><?= $producto['nombre'] ?></h2>
                    <div>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a class="review-link" href="#">10 comentario(s) | Agrega tu comentario</a>
                    </div>
                    <div>



                         <?php if (isset($producto['precio_con_descuento']) && $producto['precio_con_descuento'] > 0) : ?>
                        <h3 class="product-transfer-price">S/<?= $producto['precio_con_descuento'] ?> <span
                                class="trans-label"><?= intval($producto['producto_descuento']) ?>%</span></h3>
                        <?php else : ?>
                        <h3 class="product-transfer-price">S/<?= $producto['precio'] ?></h3>
                        <?php endif; ?>





                        <?php if (isset($producto['precio_transferencia']) && $producto['precio_transferencia'] > 0) : ?>
                            <h3 class="product-transfer-price">
                                S/<?= $producto['precio_transferencia'] ?>
                                <span class="trans-label">transf</span>
                            </h3>
                        <?php endif; ?>


                        <h3 class="product-transfer-price">
                            <del style="color: #8d99ae;" class="product-old-price">S/<?= $producto['precio_anterior'] ?></del>
                        </h3>



                    </div>
                    <p><?= $producto['descripcion'] ?></p>

                    <!-- Sustituir stock/cantidad por el diseño flex -->
                    <div class="custom-row-stock-cantidad">
                        <div class="add-to-cart" style="margin-bottom:0;">
                            <div class="qty-label">
                                CANTIDAD
                                <div class="input-number">
                                    <input id="cantidad" type="number" value="1">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; align-items: center; min-width:70px;">
                            <div class="custom-stock">
                                Stock:<br>
                                <span style="font-size:1.5em; font-weight: bold; color: #fff;"><?= $producto['stock'] > 0 ? $producto['stock'] : '0'; ?></span>
                            </div>
                            <div class="custom-disponible">
                                <?= $producto['stock'] > 0 ? 'DISPONIBLE' : 'NO DISPONIBLE'; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Botón Agregar con diseño -->
                    <?php
                    function obtenerImagenPrincipal($imagenes)
                    {
                        foreach ($imagenes as $imagen) {
                            if ($imagen['orden'] == 1) {
                                return $imagen['nombre_archivo'];
                            }
                        }
                        return 'default.jpg';
                    }
                    $imagenPrincipal = obtenerImagenPrincipal($producto['imagenes']);
                    ?>
                    <button class="custom-add-btn"
                        data-id="<?= $producto['id_producto'] ?>"
                        data-nombre="<?= $producto['nombre'] ?>"
                        data-precio="<?= isset($producto['precio_con_descuento']) && $producto['precio_con_descuento'] > 0 ? $producto['precio_con_descuento'] : $producto['precio'] ?>"
                        data-imagen="<?= base_url('public/assets/img_tienda/productos/') . $imagenPrincipal ?>">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Agregar
                    </button>

                    <!-- Agregar botón para ver video si existe -->
                    <?php if (!empty($producto['producto_video'])): ?>
                        <button type="button" class="btn btn-success verVideoBtn" style="margin-bottom:10px;">
                            <i class="fa fa-play"></i> Ver video
                        </button>
                    <?php endif; ?>


                    <!--  <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                    </ul> -->

                    <ul class="product-links">
                        <li>Marca:</li>
                        <li><a href="#"><?= $producto['marca']; ?></a></li>

                    </ul>
                    <ul class="product-links">
                        <li>Modelo:</li>
                        <li><a href="#"><?= $producto['modelo']; ?></a></li>

                    </ul>

                    <ul class="product-links">
                        <?php
                        $pdfPath = FCPATH . ltrim($producto['manual_pdf'], '/');
                        if (!empty($producto['manual_pdf']) && file_exists($pdfPath)) : ?>
        <li>
            <a href="<?php echo base_url($producto['manual_pdf']) ?>" download>
                <img style="width: 70px;" src="<?php echo base_url('public/assets/tienda/img/pdf.png') ?>" alt=""> FICHA TÉCNICA
            </a>
        </li>
    <?php else : ?>
        <li>
            <span style="display:inline-flex;align-items:center;">
                <img style="width: 70px;" src="<?php echo base_url('public/assets/tienda/img/pdf.png') ?>" alt=""> 
                <span style="margin-left:8px;">No disponible</span>
            </span>
        </li>
    <?php endif; ?>
                    </ul>



                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <!-- Botón para compartir enlace de opiniones -->
                <div class="row mb-3">
                    <div class="col-md-12 text-right">
                      
                    </div>
                </div>
              <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                             <li class="active"><a data-toggle="tab" href="#tab2">Descripcion</a></li>
                        <li><a data-toggle="tab" href="#tab1">Caracteristicas</a></li>
                   
                        <li><a data-toggle="tab" href="#tab3">Reseñas (3)</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tbody>
                                            <?php
                                            $caracteristicas = explode('.', $producto['caracteristicas']);
                                            foreach ($caracteristicas as $caracteristica) {
                                                if (!empty($caracteristica)) {
                                                    echo '<tr><td><i class="fa fa-check"></i></td><td>' . trim($caracteristica) . '</td></tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade in active">
        <div class="row">
            <div class="col-md-12">
                <p>
                    <?php
                    if (!empty($producto['descripcion_larga'])) {
                        echo $producto['descripcion_larga'];
               
                    
                    } else {
                        echo 'Sin descripción disponible.';
                    }
                    ?>
                </p>
            </div>
        </div>
    </div>
    <!-- /tab2  -->

                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                            <span>4.5</span>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <ul class="rating">
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 80%;"></div>
                                                </div>
                                                <span class="sum">3</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 60%;"></div>
                                                </div>
                                                <span class="sum">2</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">

                                        </ul>
                                        <ul class="reviews-pagination">
                                            <!-- Los números de página se cargarán dinámicamente -->
                                        </ul>
                                    </div>


                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                            <div id="review-form">
                                <!-- Caja verde llamativa para el título -->
                                <div style="background:#4CAF50;color:#fff;text-align:center;padding:8px 0;border-radius:6px;font-weight:bold;margin-bottom:15px;font-size:18px;">
                                    Deja tu reseña Aquí!
                                </div>
                                <form class="review-form">
                                    <input id="producto_id" type="hidden" value="<?php echo $producto['id_producto'] ?>">
                                    <input id="nombre" class="input" type="text" placeholder="Tu nombre">
                                    <input id="correo" class="input" type="email" placeholder="correo">
                                    <textarea id="comentario" class="input" placeholder="Tu comentario"></textarea>
                                    <div class="input-rating">
                                        <span>Tu calificación: </span>
                                        <div class="stars">
                                            <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                            <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                            <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                            <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                            <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                        </div>
                                    </div>
                                    <button id="submit-review" class="primary-btn">Enviar</button>
                                </form>
                            </div>
                        </div>
                        <!-- /Review Form -->
                            </div>
                        </div>
                        <!-- /tab3  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->



<div class="section">
   
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Productos Relacionados</h3>

                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <!-- product -->
                                <?php foreach ($productosCategoria as $producto) : ?>
                                    <?php
                                    // Calcular el precio con descuento
                                    $precio = floatval($producto['precio']);
                                    $precioConDescuento = $precio;
                                    if (floatval($producto['producto_descuento']) > 0) {
                                        $descuento = floatval($producto['producto_descuento']);
                                        $precioConDescuento = $precio - ($precio * ($descuento / 100));
                                    }

                                    // Determinar el precio a mostrar (con o sin descuento)

                                    // Generar HTML para el descuento si aplica
                                    $descuentoHtml = '';
                                    if (floatval($producto['producto_descuento']) > 0) {
                                        $descuentoHtml = '<span class="sale">-' . $producto['producto_descuento'] . '%</span>';
                                    }
                                    ?>

                                    <div class="product">
                                        <a href="<?= base_url('tienda/verproducto/') . $producto['id_producto'] ?>">
                                            <div class="product-img">
                                                <img src="<?= base_url('public/assets/img_tienda/productos/') . $producto['imagen_principal'] ?>" alt="<?= $producto['nombre'] ?>">
                                                <div class="product-label">
                                                    <?= $descuentoHtml ?>
                                                    <span class="new">Nuevo</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category"><?= $producto['nombre_categoria'] ?></p>
                                                <h3 class="product-name"><a href="<?= base_url('tienda/verproducto/') . $producto['id_producto'] ?>"><?= substr($producto['nombre'], 0, 20) ?></a></h3>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <!-- <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                            </div> -->
                                                <div class="add-to-cart">
                                                        <i class="fa fa-shopping-cart"></i> Agregar
                                                    </button>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                                <!-- /product -->

                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>

    </div>

</div>


<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Suscríbete <strong>PARA MAS OFERTAS</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Ingresa tu correo">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribete</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="https://www.facebook.com/valeapp.sistemadefacturacion"><i class="fa fa-facebook"></i></a>
                        </li>
                        <!-- <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li> -->
                        <li>
                            <a href="https://www.instagram.com/valeapp.sistemadefacturacion/"><i class="fa fa-instagram"></i></a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<!-- Modal -->
<div class="modal fade" id="video" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        // Obtener la URL del video de YouTube
                        $videoUrl = trim($producto['producto_video']);

                        // Función mejorada para extraer el ID del video de la URL de YouTube
                        function obtenerIdDeVideoYoutube($url)
                        {
                            if (empty($url)) return '';
                            // Eliminar espacios y caracteres extra
                            $url = trim($url);
                            // Soporta formatos: https://www.youtube.com/watch?v=xxxx, https://youtu.be/xxxx, shorts, embed
                            if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $matches)) {
                                return $matches[1];
                            }
                            // Si solo se pone el ID directamente
                            if (preg_match('/^[A-Za-z0-9_-]{11}$/', $url)) {
                                return $url;
                            }
                            return '';
                        }

                        // Obtener el ID del video de la URL
                        $videoId = obtenerIdDeVideoYoutube($videoUrl);

                        // Construir la URL del video de YouTube con el ID
                        $videoSrc = $videoId ? ('https://www.youtube.com/embed/' . $videoId) : '';
                        ?>

                        <div class="embed-responsive embed-responsive-16by9">
                            <?php if ($videoSrc): ?>
                                <iframe id="iframeVideo" width="560" height="315" src="<?php echo $videoSrc; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            <?php else: ?>
                                <div style="color:red;text-align:center;padding:40px;">No se pudo cargar el video. Verifica la URL o el formato.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal para mostrar/copy link de opiniones -->
<div class="modal fade" id="modalLinkOpinion" tabindex="-1" aria-labelledby="modalLinkOpinionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLinkOpinionLabel">Enlace para dejar opinión</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Comparte este enlace con tus clientes para que dejen su opinión sobre este producto:</label>
        <div class="input-group">
          <input type="text" class="form-control" id="inputLinkOpinion" readonly value="<?= base_url('review/agregarReview?producto_id=' . $producto['id_producto']) ?>">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="btnCopyLinkOpinion">Copiar</button>
          </div>
        </div>
        <small class="form-text text-muted mt-2">Puedes enviar este enlace por correo a tus clientes.</small>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('public/assets/tienda/js/jquery.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        var qtyInput = $('#cantidad');
        var qtyUp = $('.qty-up');
        var qtyDown = $('.qty-down');

        // Incrementar cantidad al hacer clic en +
        qtyUp.click(function() {
            var currentValue = parseInt(qtyInput.val());
            qtyInput.val(currentValue + 1);
        });

        // Decrementar cantidad al hacer clic en -
        qtyDown.click(function() {
            var currentValue = parseInt(qtyInput.val());
            // Verificar que el valor no sea menor que 1 para evitar cantidades negativas
            if (currentValue > 1) {
                qtyInput.val(currentValue - 1);
            }
        });


        $('#submit-review').click(function(e) {
            e.preventDefault();

            // Obtener los datos del formulario
            var nombre = $('#nombre').val();
            var producto_id = $('#producto_id').val();
            var correo = $('#correo').val();
            var comentario = $('#comentario').val();
            var rating = $('input[name=rating]:checked').val();
            console.log(producto_id);

            // Enviar los datos al controlador
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('review/agregarReview'); ?>",
                data: {
                    nombre: nombre,
                    correo: correo,
                    comentario: comentario,
                    rating: rating,
                    producto_id: producto_id,
                },
                success: function(response) {
                    console.log(response); // Verificar la respuesta en la consola del 
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message
                        });
                        limpiarCampos();
                        cargarReviews();

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                }
            });
        });

        function limpiarCampos() {
            $('#nombre').val('');
            $('#correo').val('');
            $('#comentario').val('');
            $('input[name=rating]').prop('checked', false);
        }
        
        
         // --- NUEVO: Detener video al cerrar el modal ---
        $('#video').on('hidden.bs.modal', function () {
            var $iframe = $(this).find('iframe');
            $iframe.attr('src', $iframe.attr('src'));
        });



        $(document).on('click', '.verVideoBtn', function(e) {
            console.log('click video')
            $('#video').modal('show');
        });


        $('.custom-add-btn, .add-to-cart-btn').on('click', function() {
            var productId = $(this).data('id');
            var productName = $(this).data('nombre');
            var productPrice = parseFloat($(this).data('precio'));
            var productImage = $(this).data('imagen');
            var productQuantity = $('#cantidad').val();
            var filename = productImage.substring(productImage.lastIndexOf('/') + 1);

            // Verificar si hay un precio con descuento disponible y utilizarlo si es mayor que 0
            var discountedPrice = parseFloat($(this).data('precio-con-descuento'));
            if (!isNaN(discountedPrice) && discountedPrice > 0) {
                productPrice = discountedPrice;
            }

            var productoExistenteIndex = carrito.findIndex(function(item) {
                return item.id === productId;
            });
            if (productoExistenteIndex !== -1) {
                carrito[productoExistenteIndex].cantidad += parseInt(productQuantity);
            } else {
                var producto = {
                    id: productId,
                    nombre: productName,
                    precio: productPrice,
                    cantidad: parseInt(productQuantity),
                    imagen: filename
                };
                carrito.push(producto);
            }
            mostrarNotificacion();
            actualizarVistaCarrito();
            guardarCarritoEnLocalStorage();
        });





        function cargarReviews(page = 1) {
            var producto_id = $('#producto_id').val(); // Obtener el ID del producto

            $.ajax({
                type: "GET",
                url: "<?php echo base_url('review/mostrarReviews/'); ?>" + producto_id + '?page=' + page,
                dataType: "json",
                success: function(response) {
                    var reviewsList = $('#reviews .reviews');
                    var paginationList = $('#reviews .reviews-pagination');

                    reviewsList.empty(); // Limpiar la lista actual de reseñas
                    paginationList.empty(); // Limpiar la lista actual de paginación

                    // Iterar sobre las reseñas recibidas en la respuesta JSON
                    $.each(response.reviews, function(index, review) {
                        var listItem = $('<li>');
                        var reviewHTML = `
                        <div class="review-heading">
                            <h5 class="name">${review.usuario_nombre}</h5>
                            <p class="date">${review.created_at}</p>
                            <div class="review-rating">`;

                        // Agregar las estrellas correspondientes al rating
                        for (var i = 1; i <= 5; i++) {
                            if (i <= review.rating) {
                                reviewHTML += '<i class="fa fa-star"></i>';
                            } else {
                                reviewHTML += '<i class="fa fa-star-o empty"></i>';
                            }
                        }

                        reviewHTML += `
                            </div>
                        </div>
                        <div class="review-body">
                            <p>${review.comentario}</p>
                        </div>`;

                        listItem.html(reviewHTML);
                        reviewsList.append(listItem);
                    });

                    // Agregar los enlaces de paginación
                    paginationList.html(response.pagination);
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar las reseñas:', error);
                }
            });
        }
        cargarReviews();

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            cargarReviews(page);
        });


        // Mostrar modal con el link de opiniones
    $('#btnGenerarLinkOpinion').on('click', function() {
        $('#modalLinkOpinion').modal('show');
    });

    // Copiar link al portapapeles
    $('#btnCopyLinkOpinion').on('click', function() {
        var copyText = document.getElementById("inputLinkOpinion");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // Para móviles
        document.execCommand("copy");
        Swal.fire({
            icon: 'success',
            title: '¡Copiado!',
            text: 'El enlace ha sido copiado al portapapeles.',
            timer: 1200,
            showConfirmButton: false
        });
    });


    });
</script>


<?php echo $this->endSection(); ?>