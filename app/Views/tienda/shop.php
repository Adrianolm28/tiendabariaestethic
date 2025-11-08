<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>




<style>
/* Estilos para el botón */
#aplicar-filtro-precio {
    display: inline-block;
    background-color: #ff6e00;
    color: #fff;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    transition: background-color 0.3s ease;
    margin-top: 2px;
}

#aplicar-filtro-precio:hover {
    background-color: #0056b3;
}

/* Estilos específicos para el botón Aplicar Filtro */
#aplicar-filtro-precio {
    background-color: #ff6e00;
}

#aplicar-filtro-precio:hover {
    background-color: #da6309;

}

.product-transfer-price {
    margin-top: -10px;
}


/* Contenedor para el precio y el descuento */

.price-transfer-container {
    display: flex;
    /* Utiliza flexbox para alinear el precio y el descuento */
    align-items: center;
    /* Centra verticalmente los elementos */
}

/* Estilo del precio */
.product-transfer-price {
    font-size: 1.0em;
    /* Tamaño del texto del precio */
    font-weight: bold;
    /* Ajusta el grosor del texto */
    margin: 0;
    /* Elimina márgenes si es necesario */
}

/* Estilo del descuento */
.product-discount1 {
    font-size: 0.6em;
    color: #fff;
    background-color: #d10024;
    padding: 3px 8px;
    border-radius: 6px;
    margin-left: 0px;
    white-space: nowrap;
    font-weight: bold;
    position: relative;
    left: 45px;
    top: 19px;
}

.mas-vendidos-sidebar { display: block; }
.mas-vendidos-movil { display: none; }
@media (max-width: 844px) {
    .mas-vendidos-sidebar { display: none !important; }
    .mas-vendidos-movil { display: block !important; margin: 24px 0 0 0; }
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
                    </li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<style>
.lds-ring {
    position: absolute;
    top: 100%;
    /* left: 50%; */
    right: 400px;
    transform: translate(-50%, -50%);
    width: 190px;
    height: 80px;
}


.lds-ring div {
    box-sizing: border-box;
    display: block;
    background-color: #fff;
    position: absolute;
    width: 64px;
    height: 64px;
    margin: 8px;
    border: 8px solid #000;
    border-radius: 50%;
    animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #009FE3 transparent transparent transparent;
}

.lds-ring div:nth-child(1) {
    animation-delay: -0.45s;
}

.lds-ring div:nth-child(2) {
    animation-delay: -0.3s;
}

.lds-ring div:nth-child(3) {
    animation-delay: -0.15s;
}

@keyframes lds-ring {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

#productos-container {
    display: flex;
    flex-wrap: wrap;


}

@media (max-width: 767px) {
    #productos-container .col-xs-6 {
        width: 50%;
    }

    .add-to-cart {
        flex-direction: column;
    }

    .quantity-container {
        flex-direction: row;
        justify-content: center;
        padding: 5px;
    }

}

/* el papi */
</style>


<!-- SECTION -->



<div class="section">
    <!-- container -->

    <!-- pasamos el parametro id  -->
    <div class="container">
   
        <!-- <div class="sidebar_prueba">

			
		</div> -->

        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <div id="categoria-display"></div>

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Categorías</h3>
                    <div class="checkbox-filter">
                        <?php
        $categoria_seleccionada = isset($_GET['id_categoria2']) ? (int)$_GET['id_categoria2'] : null; // Conversión a entero y sanitización
        foreach ($categorias as $categoria) : ?>
                        <div class="input-checkbox">
                            <input type="checkbox" id="category-<?= $categoria['id_categoria'] ?>"
                                data-id="<?= $categoria['id_categoria'] ?>"
                                <?php if ($categoria_seleccionada === (int)$categoria['id_categoria']): ?>
                                checked="checked" <?php endif; ?>>
                            <label id="category-label-<?= $categoria['id_categoria'] ?>"
                                for="category-<?= $categoria['id_categoria'] ?>">
                                <span></span>
                                <?= $categoria['nombre'] ?>
                            </label>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>

                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Precio</h3>
                    <div class="price-filter">
                        <div id="price-slider"></div>
                        <div class="input-number price-min">
                            <input class="precio1" id="price-min" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                        <span>-</span>
                        <div class="input-number price-max">
                            <input class="precio2" id="price-max" type="number">
                            <span class="qty-up">+</span>
                            <span class="qty-down">-</span>
                        </div>
                    </div>
                    <button id="aplicar-filtro-precio">Aplicar Filtro</button>

                </div>
                <!-- /aside Widget -->

                <!-- aside Widget -->
         
                <!-- /aside Widget -->

                <!-- aside Widget -->
                <div class="aside mas-vendidos-sidebar">
                    <h3 class="aside-title">Mas vendidos</h3>

                    <?php if (!empty($productosMasVendidos)) : ?>
                    <?php foreach ($productosMasVendidos as $producto) : ?>
                    <div class="product-widget">
                        <div class="product-img">
                            <img src="<?= base_url('public/assets/img_tienda/productos/') . $producto['imagen_producto'] ?>"
                                alt="<?= $producto['nombre'] ?>">
                        </div>
                        <div class="product-body">
                            <p class="product-category"><?= $producto['nombre_categoria'] ?></p>
                            <h3 class="product-name"><a
                                    href="<?= base_url('tienda/verproducto/') . $producto['id_producto'] ?>"><?= $producto['nombre'] ?></a>
                            </h3>
                            <h4 class="product-price">S/. <?= $producto['precio'] ?> <del class="product-old-price">S/.
                                    <?= $producto['precio_anterior'] ?></del></h4>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <p>No hay productos más vendidos disponibles en este momento.</p>
                    <?php endif; ?>
                </div>


                <!-- /aside Widget -->
            </div>
            <!-- /ASIDE -->
            <div id="loader" class="lds-ring hidden">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <!-- STORE -->
            <div id="store" class="col-md-9">


                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <div class="store-sort">


                        <label>
                            MOSTRAR:
                            <select id="mostrar-select" class="input-select">

                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="0">Todos</option>
                            </select>
                        </label>
                    </div>
                    <!-- <ul class="store-grid">
						<li class="active"><a href="#" data-view="grid"><i class="fa fa-th"></i></a></li>
						<li><a href="#" data-view="list"><i class="fa fa-th-list"></i></a></li>
					</ul> -->


                </div>
                <!-- /store top filter -->

                <!-- store products -->
                <div id="productos-container" class="row">
                    <!-- product -->

                    <!-- /product -->
                </div>




                <div id="pagination-container" class="store-filter clearfix">
                    <!-- Aquí se insertará la paginación -->
                </div>


                <!-- Mas vendidos solo para móvil, al final de la columna de productos -->
                <div class="mas-vendidos-movil">
                    <h3 class="aside-title">Mas vendidos</h3>
                    <?php if (!empty($productosMasVendidos)) : ?>
                        <?php foreach ($productosMasVendidos as $producto) : ?>
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="<?= base_url('public/assets/img_tienda/productos/') . $producto['imagen_producto'] ?>"
                                        alt="<?= $producto['nombre'] ?>">
                                </div>
                                <div class="product-body">
                                    <p class="product-category"><?= $producto['nombre_categoria'] ?></p>
                                    <h3 class="product-name"><a
                                            href="<?= base_url('tienda/verproducto/') . $producto['id_producto'] ?>"><?= $producto['nombre'] ?></a>
                                    </h3>
                                    <h4 class="product-price">S/. <?= $producto['precio'] ?> <del class="product-old-price">S/.
                                            <?= $producto['precio_anterior'] ?></del></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>No hay productos más vendidos disponibles en este momento.</p>
                    <?php endif; ?>
                </div>
                <!-- /Mas vendidos móvil -->

                <!-- /store bottom filter -->
            </div>
            <!-- /STORE -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- NEWSLETTER -->
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
                        <a href="https://www.facebook.com/tegnexstore.pe" target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/tegnexventas/" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.tiktok.com/@tegnexstore" target="_blank">
                            <i class="fa fa-music"></i> <!-- TikTok usa ícono personalizado, podés cambiarlo si tenés otro -->
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/@corporaciontegnex7403" target="_blank">
                            <i class="fa fa-youtube"></i>
                        </a>
                    </li>
                </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>


<!-- /NEWSLETTER -->
<div class="modal fade" id="modalPro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>




<script src="<?= base_url('public/assets/tienda/js/jquery.min.js') ?>"></script>
<script>
function obtenerParametroURL(nombreParametro) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(nombreParametro);
}

// Función para obtener parámetros de la URL
function getUrlParameter(name) {
    var url = new URL(window.location.href);
    return url.searchParams.get(name);
}


$(document).ready(function() {

    var idSubcategoria = obtenerParametroURL('id_subcategoria');
    console.log('id_subcategoria:', idSubcategoria);

    var idCategoria = obtenerParametroURL('id_categoria');
    console.log('id_categoria:', idCategoria);

    function cargarProductosConDescuento() {
        var idCategoria = obtenerParametroURL('id_categoria');
        var idSubcategoria = obtenerParametroURL('id_subcategoria');

        var requestData = {};
        if (idCategoria) {
            requestData.id_categoria = idCategoria;
        }
        if (idSubcategoria) {
            requestData.id_subcategoria = idSubcategoria;
        }

        if (idCategoria || idSubcategoria) {
            $.ajax({
                url: '<?= site_url('productos/getProductosConDescuento') ?>',
                type: 'POST',
                dataType: 'json',
                data: requestData,
                success: function(response) {
                    console.log('trayendo productos por texto:', response);

                    $('#productos-container').empty();
                    response.data.forEach(function(producto) {
                        if (producto.estado == 1) {
                            var descuentoHtml = '';

                            if (parseFloat(producto.producto_descuento) > 0) {

                                var descuentoValue = parseFloat(producto
                                .producto_descuento);
                                var descuentoFormatted = Math.abs(descuentoValue) + '%';
                                descuentoHtml = '<span class="sale">' + descuentoFormatted +
                                    '</span>';
                            }


                            var precio = parseFloat(producto.precio);
                            var precioConDescuento = precio;
                            if (parseFloat(producto.producto_descuento) > 0) {

                                var descuento = parseFloat(producto.producto_descuento);
                                precioConDescuento = precio - (precio * (descuento / 100));
                            }
                            var precio = parseFloat(producto.precio_con_descuento) > 0 ?
                                parseFloat(producto.precio_con_descuento) : parseFloat(
                                    producto.precio);

                            /* console.log('aqui el precioass', precio) */

                            var productoHtml = `
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="public/assets/img_tienda/productos/${producto.imagen_producto}" alt="${producto.nombre}">
                                    <div class="product-label">
									${descuentoHtml}
                                        <span class="new">NUEVO</span>
                                    </div>
                                </div>
                                <div class="product-body">
								<p class="product-category">${producto.categoria_producto}</p>
								<h3 class="product-name"><a href="tienda/verproducto/${producto.id_producto}">${producto.nombre.substring(0, 20)}</a></h3>
                                    <h4 class="product-price">S/.${precio}<del class="product-old-price">${producto.precio_anterior}</del></h4>

								    <div class="add-to-cart">

                                      <div class="quantity-container">
                                         <button class="quantity-btn decrement-btn" data-id="${producto.id_producto}">-</button>
                                         <input type="text" id="quantity-${producto.id_producto}" class="product-quantity" value="1" min="1"  data-id="$    {producto.id_producto}">
                                         <button class="quantity-btn increment-btn" data-id="${producto.id_producto}">+</button>
                                      </div>

                                     <button class="add-to-cart-btn" 
		                                data-id="${producto.id_producto}" 
		                                data-sistema="${producto.id_sistema}" 
		                                data-nombre="${producto.nombre}" 
		                                data-precio="${producto.precio}"
		                                data-precio-con-descuento="${producto.precio_con_descuento}"
		                                data-cantidad="1"
		                                data-imagen="${producto.imagen_producto}">
	                                    <i class="fa fa-shopping-cart"></i> Agregar
                                      </button>
                                  </div>
                                   
                                </div>`;

                            // Agregar el HTML del producto al contenedor de productos
                            $('#productos-container').append(productoHtml);
                        }
                    });
                    $('#pagination-container').html(response.pagination);

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }

    function cargarProductosConFiltro() {
        var searchText = obtenerParametroURL('searchText');
        if (searchText) {
            $.ajax({
                url: '<?= site_url('productos/getProductos') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    searchText: searchText
                },
                success: function(response) {
                    console.log('trayendo productos por texto:', response);

                    $('#productos-container').empty();
                    response.data.forEach(function(producto) {
                        if (producto.estado == 1) {
                            var descuentoHtml = '';

                            if (parseFloat(producto.producto_descuento) > 0) {

                                var descuentoValue = parseFloat(producto
                                .producto_descuento);
                                var descuentoFormatted = Math.abs(descuentoValue) + '%';
                                descuentoHtml = '<span class="sale">' + descuentoFormatted +
                                    '</span>';
                            }


                            var precio = parseFloat(producto.precio);
                            var precioConDescuento = precio;
                            if (parseFloat(producto.producto_descuento) > 0) {

                                var descuento = parseFloat(producto.producto_descuento);
                                precioConDescuento = precio - (precio * (descuento / 100));
                            }
                            var precio = parseFloat(producto.precio_con_descuento) > 0 ?
                                parseFloat(producto.precio_con_descuento) : parseFloat(
                                    producto.precio);

                            /* console.log('aqui el precioass', precio) */

                            var productoHtml = `
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="public/assets/img_tienda/productos/${producto.imagen_producto}" alt="${producto.nombre}">
                                    <div class="product-label">
									${descuentoHtml}
                                        <span class="new">NUEVO</span>
                                    </div>
                                </div>
                                <div class="product-body">
								<p class="product-category">${producto.categoria_producto}</p>
								<h3 class="product-name"><a href="tienda/verproducto/${producto.id_producto}">${producto.nombre.substring(0, 20)}</a></h3>
                                    <h4 class="product-price">S/.${precio}<del class="product-old-price">${producto.precio_anterior}</del></h4>

								    <div class="add-to-cart">

                                      <div class="quantity-container">
                                         <button class="quantity-btn decrement-btn" data-id="${producto.id_producto}">-</button>
                                         <input type="text" id="quantity-${producto.id_producto}" class="product-quantity" value="1" min="1"  data-id="$    {producto.id_producto}">
                                         <button class="quantity-btn increment-btn" data-id="${producto.id_producto}">+</button>
                                      </div>

                                     <button class="add-to-cart-btn" 
		                                data-id="${producto.id_producto}" 
		                                data-sistema="${producto.id_sistema}" 
		                                data-nombre="${producto.nombre}" 
		                                data-precio="${producto.precio}"
		                                data-precio-con-descuento="${producto.precio_con_descuento}"
		                                data-cantidad="1"
		                                data-imagen="${producto.imagen_producto}">
	                                    <i class="fa fa-shopping-cart"></i> Agregar
                                      </button>
                                  </div>
                                   
                                </div>`;

                            // Agregar el HTML del producto al contenedor de productos
                            $('#productos-container').append(productoHtml);
                        }
                    });
                    $('#pagination-container').html(response.pagination);

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }


    function cargarProductosSubcategoria() {
        var subcategoriaid = obtenerParametroURL('subcategoriaid');
        if (subcategoriaid) {
            $.ajax({
                url: '<?= site_url('productos/getProductos') ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    subcategoriaid: subcategoriaid
                },
                success: function(response) {
                    console.log('trayendo productos por texto:', response);

                    $('#productos-container').empty();
                    response.data.forEach(function(producto) {
                        if (producto.estado == 1) {
                            var descuentoHtml = '';

                            if (parseFloat(producto.producto_descuento) > 0) {

                                var descuentoValue = parseFloat(producto
                                .producto_descuento);
                                var descuentoFormatted = Math.abs(descuentoValue) + '%';
                                descuentoHtml = '<span class="sale">' + descuentoFormatted +
                                    '</span>';
                            }


                            var precio = parseFloat(producto.precio);
                            var precioConDescuento = precio;
                            if (parseFloat(producto.producto_descuento) > 0) {

                                var descuento = parseFloat(producto.producto_descuento);
                                precioConDescuento = precio - (precio * (descuento / 100));
                            }
                            var precio = parseFloat(producto.precio_con_descuento) > 0 ?
                                parseFloat(producto.precio_con_descuento) : parseFloat(
                                    producto.precio);

                            /* console.log('aqui el precioass', precio) */

                            var productoHtml = `
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="public/assets/img_tienda/productos/${producto.imagen_producto}" alt="${producto.nombre}">
                                    <div class="product-label">
									${descuentoHtml}
                                        <span class="new">NUEVO</span>
                                    </div>
                                </div>
                                <div class="product-body">
								<p class="product-category">${producto.categoria_producto}</p>
								<h3 class="product-name"><a href="tienda/verproducto/${producto.id_producto}">${producto.nombre.substring(0, 20)}</a></h3>
                                    <h4 class="product-price">S/.${precio}<del class="product-old-price">${producto.precio_anterior}</del></h4>

								    <div class="add-to-cart">

                                      <div class="quantity-container">
                                         <button class="quantity-btn decrement-btn" data-id="${producto.id_producto}">-</button>
                                         <input type="text" id="quantity-${producto.id_producto}" class="product-quantity" value="1" min="1"  data-id="$    {producto.id_producto}">
                                         <button class="quantity-btn increment-btn" data-id="${producto.id_producto}">+</button>
                                      </div>

                                     <button class="add-to-cart-btn" 
		                                data-id="${producto.id_producto}" 
		                                data-sistema="${producto.id_sistema}" 
		                                data-nombre="${producto.nombre}" 
		                                data-precio="${producto.precio}"
		                                data-precio-con-descuento="${producto.precio_con_descuento}"
		                                data-cantidad="1"
		                                data-imagen="${producto.imagen_producto}">
	                                    <i class="fa fa-shopping-cart"></i> Agregar
                                      </button>
                                  </div>
                                   
                                </div>`;

                            // Agregar el HTML del producto al contenedor de productos
                            $('#productos-container').append(productoHtml);
                        }
                    });
                    $('#pagination-container').html(response.pagination);

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    }


    var productosFiltrados = [];

    function cargarProductos(page) {
        var productosPorPagina = $('#mostrar-select').val();

        $.ajax({
            url: '<?= base_url('productos/getProductos') ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                page: page,
                productosPorPagina: productosPorPagina
            },
            success: function(response) {
                console.log('cargando productos', response);
                $('#productos-container').empty();

                response.data.forEach(function(producto) {
                    if (producto.estado == 1) {
                        var descuentoHtml = '';

                        if (parseFloat(producto.producto_descuento) > 0) {

                            var descuentoValue = parseFloat(producto.producto_descuento);
                            var descuentoFormatted = Math.abs(descuentoValue) + '%';
                            descuentoHtml = '<span class="sale">' + descuentoFormatted +
                                '</span>';
                        }


                        var precio = parseFloat(producto.precio);
                        var precioConDescuento = precio;
                        if (parseFloat(producto.producto_descuento) > 0) {

                            var descuento = parseFloat(producto.producto_descuento);
                            precioConDescuento = precio - (precio * (descuento / 100));
                        }
                        var precio = parseFloat(producto.precio_con_descuento) > 0 ?
                            parseFloat(producto.precio_con_descuento) : parseFloat(producto
                                .precio);


                        /* precio_transferencia */
                        let precioTransferenciaHTML = '';
                        let descuentoTransferenciaHtml = '';
                        if (producto.precio_transferencia > 0) {
                            // Elimina los decimales del precio usando parseInt
                            let precioSinDecimales = parseInt(producto
                            .precio_transferencia);
                            let transfrenciaDescuentoSinDecimal = parseInt(producto
                                .descuento_transferencia);

                            precioTransferenciaHTML = `<div class="price-container">
                                 <span class="product-transfer-price">S/${precioSinDecimales}</span>`;

                            if (producto.descuento_transferencia) {
                                descuentoTransferenciaHtml =
                                    `<span class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                            }
                            precioTransferenciaHTML += `</div>`;
                        } else {
                            let precioSinDecimales = parseInt(producto
                            .precio_transferencia);
                            let transfrenciaDescuentoSinDecimal = parseInt(producto
                                .descuento_transferencia);

                            precioTransferenciaHTML =
                                `<div class="price-container">
                                 <span style="visibility: hidden"; class="product-transfer-price">S/${precioSinDecimales}</span>`;

                            if (producto.descuento_transferencia) {
                                descuentoTransferenciaHtml =
                                    `<span style="visibility: hidden"; class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                            }
                            precioTransferenciaHTML += `</div>`;
                        }
                        /* precio_transferencia */

                        let precioAnteriorSinDecimales = parseInt(producto.precio_anterior);

                        var productoHtml = `
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="public/assets/img_tienda/productos/${producto.imagen_producto}" alt="${producto.nombre}">
                                    <div class="product-label">
									${descuentoHtml}
                                        <span class="new">NUEVO</span>
                                    </div>
                                </div>
                                <div class="product-body">
								 <p class="product-category">${producto.categoria_producto}</p>
								 <h3 class="product-name"><a href="tienda/verproducto/${producto.id_producto}">${producto.nombre.substring(0, 20)}</a></h3>
								     ${descuentoTransferenciaHtml}
								     ${precioTransferenciaHTML}

									 
                                    <h4 class="product-price">S/${precio}<del class="product-old-price">S/${precioAnteriorSinDecimales}</del></h4>
									
	                            
								    <div class="add-to-cart">

                                      <div class="quantity-container">
                                         <button class="quantity-btn decrement-btn" data-id="${producto.id_producto}">-</button>
                                         <input type="text" id="quantity-${producto.id_producto}" class="product-quantity" value="1" min="1"  data-id="$    {producto.id_producto}">
                                         <button class="quantity-btn increment-btn" data-id="${producto.id_producto}">+</button>
                                      </div>

                                     <button class="add-to-cart-btn" 
		                                data-id="${producto.id_producto}" 
		                                data-sistema="${producto.id_sistema}" 
		                                data-nombre="${producto.nombre}" 
		                                data-precio="${producto.precio}"
		                                data-precio-con-descuento="${producto.precio_con_descuento}"
		                                data-preciotransferencia="${producto.precio_transferencia}"
		                                data-cantidad="1"
		                                data-imagen="${producto.imagen_producto}">
	                                    <i class="fa fa-shopping-cart"></i> Agregar
                                      </button>
                                  </div>
                                   
                                </div>`;




                        // Agregar el HTML del producto al contenedor de productos
                        $('#productos-container').append(productoHtml);
                    }


                });


                $('#pagination-container').html(response.pagination);


            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function filtrarPorCategoria(categoryId) {
        $.ajax({
            url: '<?php echo base_url('productos/filtrarPorCategorias'); ?>',
            type: 'POST',
            data: {
                categoryId: categoryId
            },
            dataType: 'json',
            success: function(response) {
                console.log('cargando Categorias', response);
                $('#productos-container').empty();
                productosFiltrados.push(...response);


                $.each(productosFiltrados, function(index, producto) {

                    var descuentoHtml = '';
                    if (parseFloat(producto.producto_descuento) > 0) {
                        var descuentoValue = parseFloat(producto.producto_descuento);
                        var descuentoFormatted = Math.abs(descuentoValue) + '%';
                        descuentoHtml = '<span class="sale">' + descuentoFormatted +
                            '</span>';
                    }

                    var precio = parseFloat(producto.precio);
                    var precioConDescuento = precio;
                    if (parseFloat(producto.producto_descuento) > 0) {

                        var descuento = parseFloat(producto.producto_descuento);
                        precioConDescuento = precio - (precio * (descuento / 100));
                    }
                    var precio = parseFloat(producto.precio_con_descuento) > 0 ? parseFloat(
                        producto.precio_con_descuento) : parseFloat(producto.precio);


                    let precioTransferenciaHTML = '';
                    let descuentoTransferenciaHtml = '';
                    if (producto.precio_transferencia > 0) {
                        // Elimina los decimales del precio usando parseInt
                        let precioSinDecimales = parseInt(producto.precio_transferencia);
                        let transfrenciaDescuentoSinDecimal = parseInt(producto
                            .descuento_transferencia);

                        precioTransferenciaHTML = `<div class="price-container">
                                 <span class="product-transfer-price">S/${precioSinDecimales}</span>`;

                        if (producto.descuento_transferencia) {
                            descuentoTransferenciaHtml =
                                `<span class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                        }
                        precioTransferenciaHTML += `</div>`;
                    } else {
                        let precioSinDecimales = parseInt(producto.precio_transferencia);
                        let transfrenciaDescuentoSinDecimal = parseInt(producto
                            .descuento_transferencia);

                        precioTransferenciaHTML =
                            `<div class="price-container">
                                 <span style="visibility: hidden"; class="product-transfer-price">S/${precioSinDecimales}</span>`;

                        if (producto.descuento_transferencia) {
                            descuentoTransferenciaHtml =
                                `<span style="visibility: hidden"; class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                        }
                        precioTransferenciaHTML += `</div>`;
                    }
                    let precioAnteriorSinDecimales = parseInt(producto.precio_anterior);


                    var productoHtml = `
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="public/assets/img_tienda/productos/${producto.imagen_producto}" alt="${producto.nombre}">
                                    <div class="product-label">
									${descuentoHtml}
                                        <span class="new">NUEVO</span>
                                    </div>
                                </div>
                                <div class="product-body">
								<p class="product-category">${producto.categoria_producto}</p>
								<h3 class="product-name"><a href="tienda/verproducto/${producto.id_producto}">${producto.nombre.substring(0, 20)}</a></h3>
                                     ${descuentoTransferenciaHtml}
								     ${precioTransferenciaHTML}

									 
                                    <h4 class="product-price">S/${precio}<del class="product-old-price">S/${precioAnteriorSinDecimales}</del></h4>
									
								    <div class="add-to-cart">

                                      <div class="quantity-container">
                                         <button class="quantity-btn decrement-btn" data-id="${producto.id_producto}">-</button>
                                         <input type="text" id="quantity-${producto.id_producto}" class="product-quantity" value="1" min="1"  data-id="$    {producto.id_producto}">
                                         <button class="quantity-btn increment-btn" data-id="${producto.id_producto}">+</button>
                                      </div>

                                     <button class="add-to-cart-btn" 
		                                data-id="${producto.id_producto}" 
		                                data-sistema="${producto.id_sistema}" 
		                                data-nombre="${producto.nombre}" 
		                                data-precio="${producto.precio}"
		                                data-precio-con-descuento="${producto.precio_con_descuento}"
		                                data-cantidad="1"
		                                data-imagen="${producto.imagen_producto}">
	                                    <i class="fa fa-shopping-cart"></i> Agregar
                                      </button>
                                  </div>
                                   
                                </div>`;

                    // Agregar el HTML del producto al contenedor de productos
                    $('#productos-container').append(productoHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


    function filtrarPorMarca(marcaId) {
        $.ajax({
            url: '<?php echo base_url('productos/filtrarPorMarca'); ?>',
            type: 'POST',
            data: {
                marcaId: marcaId // Cambia categoryId a marcaId
            },
            dataType: 'json',
            success: function(response) {
                console.log('cargando Marcas', response);
                $('#productos-container').empty();
                productosFiltrados.push(...response);

                $.each(productosFiltrados, function(index, producto) {

                    var descuentoHtml = '';
                    if (parseFloat(producto.producto_descuento) > 0) {
                        var descuentoValue = parseFloat(producto.producto_descuento);
                        var descuentoFormatted = Math.abs(descuentoValue) + '%';
                        descuentoHtml = '<span class="sale">' + descuentoFormatted +
                            '</span>';
                    }

                    var precio = parseFloat(producto.precio);
                    var precioConDescuento = precio;
                    if (parseFloat(producto.producto_descuento) > 0) {

                        var descuento = parseFloat(producto.producto_descuento);
                        precioConDescuento = precio - (precio * (descuento / 100));
                    }
                    var precio = parseFloat(producto.precio_con_descuento) > 0 ? parseFloat(
                        producto.precio_con_descuento) : parseFloat(producto.precio);

                    let precioTransferenciaHTML = '';
                    let descuentoTransferenciaHtml = '';
                    if (producto.precio_transferencia > 0) {
                        // Elimina los decimales del precio usando parseInt
                        let precioSinDecimales = parseInt(producto.precio_transferencia);
                        let transfrenciaDescuentoSinDecimal = parseInt(producto
                            .descuento_transferencia);

                        precioTransferenciaHTML = `<div class="price-container">
                                 <span class="product-transfer-price">S/${precioSinDecimales}</span>`;

                        if (producto.descuento_transferencia) {
                            descuentoTransferenciaHtml =
                                `<span class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                        }
                        precioTransferenciaHTML += `</div>`;
                    } else {
                        let precioSinDecimales = parseInt(producto.precio_transferencia);
                        let transfrenciaDescuentoSinDecimal = parseInt(producto
                            .descuento_transferencia);

                        precioTransferenciaHTML =
                            `<div class="price-container">
                                 <span style="visibility: hidden"; class="product-transfer-price">S/${precioSinDecimales}</span>`;

                        if (producto.descuento_transferencia) {
                            descuentoTransferenciaHtml =
                                `<span style="visibility: hidden"; class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                        }
                        precioTransferenciaHTML += `</div>`;
                    }
                    let precioAnteriorSinDecimales = parseInt(producto.precio_anterior);

                    var productoHtml = `
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="public/assets/img_tienda/productos/${producto.imagen_producto}" alt="${producto.nombre}">
                                    <div class="product-label">
									${descuentoHtml}
                                        <span class="new">NUEVO</span>
                                    </div>
                                </div>
                                <div class="product-body">
								<p class="product-category">${producto.marca_producto}</p>
								<h3 class="product-name"><a href="tienda/verproducto/${producto.id_producto}">${producto.nombre.substring(0, 20)}</a></h3>
								     ${descuentoTransferenciaHtml}
								     ${precioTransferenciaHTML}
                                    <h4 class="product-price">S/${precio}<del class="product-old-price">S/${precioAnteriorSinDecimales}</del></h4>
									
								    <div class="add-to-cart">

                                      <div class="quantity-container">
                                         <button class="quantity-btn decrement-btn" data-id="${producto.id_producto}">-</button>
                                         <input type="text" id="quantity-${producto.id_producto}" class="product-quantity" value="1" min="1"  data-id="$    {producto.id_producto}">
                                         <button class="quantity-btn increment-btn" data-id="${producto.id_producto}">+</button>
                                      </div>

                                     <button class="add-to-cart-btn" 
		                                data-id="${producto.id_producto}" 
		                                data-sistema="${producto.id_sistema}" 
		                                data-nombre="${producto.nombre}" 
		                                data-precio="${producto.precio}"
		                                data-precio-con-descuento="${producto.precio_con_descuento}"
		                                data-cantidad="1"
		                                data-imagen="${producto.imagen_producto}">
	                                    <i class="fa fa-shopping-cart"></i> Agregar
                                      </button>
                                  </div>
                                   
                                </div>`;

                    $('#productos-container').append(productoHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }



    $('input[id^="category-"]').on('change', function() {
        var categoryId = $(this).data('id');

        if ($(this).is(':checked')) {
            filtrarPorCategoria(categoryId);
        } else {


            // Vaciar el arreglo productosFiltrados
            productosFiltrados = [];


            // Verificar si hay otros checkboxes marcados
            var otrosCheckboxesMarcados = $('input[id^="category-"]:checked').length > 0;
            if (otrosCheckboxesMarcados) {
                // Si hay otros checkboxes marcados, volver a llenar productosFiltrados
                $('input[id^="category-"]:checked').each(function() {
                    filtrarPorCategoria($(this).data('id'));
                });
            } else {
                // Si ningún checkbox está marcado, llamar a cargarProductos()
                cargarProductos();
            }
        }
    });


    $('input[id^="brand-"]').on('change', function() {
        var marcaId = $(this).data('id');

        if ($(this).is(':checked')) {
            filtrarPorMarca(marcaId);
        } else {
            // Vaciar el arreglo productosFiltrados
            productosFiltrados = [];

            // Verificar si hay otros checkboxes de marca marcados
            var otrosCheckboxesMarcados = $('input[id^="brand-"]:checked').length > 0;
            if (otrosCheckboxesMarcados) {
                // Si hay otros checkboxes de marca marcados, volver a llenar productosFiltrados
                $('input[id^="brand-"]:checked').each(function() {
                    filtrarPorMarca($(this).data('id'));
                });
            } else {
                // Si ningún checkbox de marca está marcado, llamar a cargarProductos()
                cargarProductos();
            }
        }
    });



    function cargarProductosFiltradosPorPrecio(precioMin, precioMax) {

        $.ajax({
            url: '<?php echo base_url('productos/filtrarPorPrecio'); ?>',
            type: 'POST',
            data: {
                precioMin: precioMin,
                precioMax: precioMax
            },
            dataType: 'json',
            success: function(response) {
                console.log('aqui lsitando por precio', response);
                $('#productos-container').empty();
                response.forEach(function(producto) {

                    var descuentoHtml = '';
                    if (parseFloat(producto.producto_descuento) > 0) {
                        var descuentoValue = parseFloat(producto.producto_descuento);
                        var descuentoFormatted = Math.abs(descuentoValue) + '%';
                        descuentoHtml = '<span class="sale">' + descuentoFormatted +
                            '</span>';
                    }

                    // Determinar el precio a mostrar en función del descuento
                    var precio = parseFloat(producto.precio);
                    var precioConDescuento = parseFloat(producto.precio_con_descuento);
                    var precioFinal = precioConDescuento > 0 ? precioConDescuento : precio;

                    /* console.log('producto precio', precio);
                    console.log('producto PrecioFinal con Dscuento', precioFinal); */

                    let precioTransferenciaHTML = '';
                    let descuentoTransferenciaHtml = '';
                    if (producto.precio_transferencia > 0) {
                        // Elimina los decimales del precio usando parseInt
                        let precioSinDecimales = parseInt(producto.precio_transferencia);
                        let transfrenciaDescuentoSinDecimal = parseInt(producto
                            .descuento_transferencia);

                        precioTransferenciaHTML = `<div class="price-container">
                                 <span class="product-transfer-price">S/${precioSinDecimales}</span>`;

                        if (producto.descuento_transferencia) {
                            descuentoTransferenciaHtml =
                                `<span class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                        }
                        precioTransferenciaHTML += `</div>`;
                    } else {
                        let precioSinDecimales = parseInt(producto.precio_transferencia);
                        let transfrenciaDescuentoSinDecimal = parseInt(producto
                            .descuento_transferencia);

                        precioTransferenciaHTML =
                            `<div class="price-container">
                                 <span style="visibility: hidden"; class="product-transfer-price">S/${precioSinDecimales}</span>`;

                        if (producto.descuento_transferencia) {
                            descuentoTransferenciaHtml =
                                `<span style="visibility: hidden"; class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                        }
                        precioTransferenciaHTML += `</div>`;
                    }
                    let precioAnteriorSinDecimales = parseInt(producto.precio_anterior);

                    var productoHtml = `
                    <div class="col-md-4 col-xs-6">
                        <div class="product">
						<a href="tienda/verproducto/${producto.id_producto}" class="product-link">
                            <div class="product-img">
                                <img src="<?= base_url('public/assets/img_tienda/productos/') ?>${producto.imagen_producto}" alt="${producto.nombre}">
                                <div class="product-label">
								${descuentoHtml}
                                    <span class="new">NUEVO</span>
                                </div>
                            </div>
                            <div class="product-body">
							<h3 class="product-name"><a href="tienda/verproducto/${producto.id_producto}">${producto.nombre.substring(0, 20)}</a></h3>
							 ${descuentoTransferenciaHtml}
							 ${precioTransferenciaHTML}
							<h4 class="product-price">S/${precio}<del class="product-old-price">${precioAnteriorSinDecimales}</del></h4>

						<!--	<h4 class="product-price">S/${precioFinal.toFixed(2)}<del class="product-old-price">${precioAnteriorSinDecimales}</del></h4> -->
							
                              
                                <div class="add-to-cart">
							<button class="add-to-cart-btn" 
                                        data-id="${producto.id_producto}"
										data-sistema="${producto.id_sistema}" 
                                        data-nombre="${producto.nombre}" 
                                        data-precio="${producto.precio}"
										data-precio-con-descuento="${producto.precio_con_descuento}"
                                        data-cantidad="1"
                                        data-imagen="${producto.imagen_producto}">
                                    <i class="fa fa-shopping-cart"></i> Agregar
                                </button>
                            </div>
                            </div>
                            
                        </div>
						</a>
                    </div>`;
                    // Agregar el HTML del producto al contenedor de productos
                    $('#productos-container').append(productoHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function filtrarPorCategoria2(categoryId) {
        $.ajax({
            url: '<?php echo base_url('productos/filtrarPorCategorias'); ?>',
            type: 'POST',
            data: {
                categoryId: categoryId
            },
            dataType: 'json',
            success: function(response) {
                console.log('Productos filtrados:', response);

                // Limpiar el contenedor de productos antes de agregar nuevos
                $('#productos-container').empty();

                // Iterar sobre los productos devueltos y construir el HTML
                $.each(response, function(index, producto) {
                    var descuentoHtml = '';
                    if (parseFloat(producto.producto_descuento) > 0) {
                        var descuentoValue = parseFloat(producto.producto_descuento);
                        var descuentoFormatted = Math.abs(descuentoValue) + '%';
                        descuentoHtml = '<span class="sale">' + descuentoFormatted +
                            '</span>';
                    }

                    var precio = parseFloat(producto.precio);
                    var precioConDescuento = precio;
                    if (parseFloat(producto.producto_descuento) > 0) {
                        var descuento = parseFloat(producto.producto_descuento);
                        precioConDescuento = precio - (precio * (descuento / 100));
                    }

                    var precio = parseFloat(producto.precio_con_descuento) > 0 ? parseFloat(
                        producto.precio_con_descuento) : parseFloat(producto.precio);


                    let precioTransferenciaHTML = '';
                    let descuentoTransferenciaHtml = '';
                    if (producto.precio_transferencia > 0) {
                        // Elimina los decimales del precio usando parseInt
                        let precioSinDecimales = parseInt(producto.precio_transferencia);
                        let transfrenciaDescuentoSinDecimal = parseInt(producto
                            .descuento_transferencia);

                        precioTransferenciaHTML = `<div class="price-container">
                                 <span class="product-transfer-price">S/${precioSinDecimales}</span>`;

                        if (producto.descuento_transferencia) {
                            descuentoTransferenciaHtml =
                                `<span class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                        }
                        precioTransferenciaHTML += `</div>`;
                    } else {
                        let precioSinDecimales = parseInt(producto.precio_transferencia);
                        let transfrenciaDescuentoSinDecimal = parseInt(producto
                            .descuento_transferencia);

                        precioTransferenciaHTML =
                            `<div class="price-container">
                                 <span style="visibility: hidden"; class="product-transfer-price">S/${precioSinDecimales}</span>`;

                        if (producto.descuento_transferencia) {
                            descuentoTransferenciaHtml =
                                `<span style="visibility: hidden"; class="product-discount1">- ${transfrenciaDescuentoSinDecimal}%</span>`;
                        }
                        precioTransferenciaHTML += `</div>`;
                    }
                    let precioAnteriorSinDecimales = parseInt(producto.precio_anterior);

                    var productoHtml = `
                <div class="col-md-4 col-xs-6">
                    <div class="product">
                        <div class="product-img">
                            <img src="public/assets/img_tienda/productos/${producto.imagen_producto}" alt="${producto.nombre}">
                            <div class="product-label">
                                ${descuentoHtml}
                                <span class="new">NUEVO</span>
                            </div>
                        </div>
                        <div class="product-body">
                            <p class="product-category">${producto.categoria_producto}</p>
                            <h3 class="product-name">
                                <a href="tienda/verproducto/${producto.id_producto}">
                                    ${producto.nombre.substring(0, 20)}</a></h3>
                                    ${descuentoTransferenciaHtml}
								     ${precioTransferenciaHTML}
                             <h4 class="product-price">S/${precio}<del class="product-old-price">S/${precioAnteriorSinDecimales}</del></h4>


                            <div class="add-to-cart">
                                <div class="quantity-container">
                                    <button class="quantity-btn decrement-btn" data-id="${producto.id_producto}">-</button>
                                    <input type="text" id="quantity-${producto.id_producto}" class="product-quantity" value="1" min="1"  data-id="$    {producto.id_producto}">
                                    <button class="quantity-btn increment-btn" data-id="${producto.id_producto}">+</button>
                                </div>

                                <button class="add-to-cart-btn" 
		                            data-id="${producto.id_producto}" 
		                            data-sistema="${producto.id_sistema}" 
		                            data-nombre="${producto.nombre}" 
		                            data-precio="${producto.precio}"
		                            data-precio-con-descuento="${producto.precio_con_descuento}"
		                            data-cantidad="1"
		                            data-imagen="${producto.imagen_producto}">
	                                <i class="fa fa-shopping-cart"></i> Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;

                    // Agregar el HTML del producto al contenedor de productos
                    $('#productos-container').append(productoHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error al filtrar los productos:', xhr.responseText);
            }
        });
    } 



    var searchText = obtenerParametroURL('searchText');
    var subcategoriaid = obtenerParametroURL('subcategoriaid');
    var idCategoria2 = getUrlParameter('id_categoria2');

    var idSubcategoria = obtenerParametroURL('id_subcategoria');
    var idCategoria = obtenerParametroURL('id_categoria');

  

    /* if (idCategoria || idSubcategoria) {
    	cargarProductosConDescuento();
    } else {
    	if (!searchText && !subcategoriaid) {
    		cargarProductos();
    	} else {
    		cargarProductosConFiltro();

    		if (subcategoriaid) {
    			cargarProductosSubcategoria();
    		}
    	}
    } */

    if (idCategoria2 && (!idCategoria || idCategoria !== idCategoria2)) {
        // Llamar a la función con idCategoria2 si las condiciones se cumplen
        filtrarPorCategoria2(idCategoria2);
    } else if (idCategoria || idSubcategoria) {
        cargarProductosConDescuento();
    } else {
        if (!searchText && !subcategoriaid) {
            cargarProductos();
        } else {
            cargarProductosConFiltro();

            if (subcategoriaid) {
                cargarProductosSubcategoria();
            }
        }
    }

    /* cargarProductosSubcategoria(); */ //aki

    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        $('#loader').removeClass('hidden');

        var page = $(this).attr('href').split('page=')[1];
        cargarProductos(page);

        $('#store').css('opacity', 0);

        // Mostrar el loader
        $('#loader').removeClass('hidden');

        setTimeout(function() {
            // Ocultar el loader
            $('#loader').addClass('hidden');

            // Restaurar la opacidad normal del contenedor de la tienda después de 2 segundos
            $('#store').css('opacity', '1');
        }, 500);
    });



    $(document).on("click", "#view", function() {
        var idProducto = $(this).data('id-producto');
        console.log(idProducto);

        /* $.ajax({
        	url: '<?php echo base_url('tienda/obtenerImagenesProducto'); ?>/' + idProducto,

        	type: 'GET',
        	dataType: 'json',
        	success: function(response) {
        		console.log(response);

        		$('#modalPro').modal('show');
        	},
        	error: function(xhr, status, error) {
        		console.error(xhr.responseText);
        	}
        }); */

        $('#modalPro').modal('show');


    });




});
</script>


<?php echo $this->endSection(); ?>