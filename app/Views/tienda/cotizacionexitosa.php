<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>

<br>


<style>
    @import url("https://fonts.googleapis.com/css2?family=Redressed&family=Ubuntu:wght@400;700&display=swap");

    :root {
        --bg-clr: #f5f5f5;
        --white: #fff;
        --primary-clr: #2f2929;
        --secondary-clr: #5265a7;
    }



    body {
        background: var(--bg-clr);
        font-size: 12px;
        line-height: 20px;
        color: var(--primary-clr);
        /*  padding: 0 20px; */
    }

    .invoice {
        width: 600px;
        max-width: 100%;
        height: auto;
        background: var(--white);
        padding: 50px 60px;
        position: relative;
        margin: 20px auto;
    }

    .w_15 {
        width: 15%;
    }

    .w_50 {
        width: 50%;
    }

    .w_55 {
        width: 55%;
    }

    .p_title {
        font-weight: 700;
        font-size: 14px;
    }

    .i_row {
        display: flex;
    }

    .text_right {
        text-align: right;
    }

    .invoice .header .i_row {
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .invoice .header .i_row:last-child {
        align-items: flex-end;
    }

    .invoice .header .i_row .i_logo p {
        font-family: "Redressed", cursive;
    }

    .invoice .header .i_row .i_logo p,
    .invoice .header .i_row .i_title h2 {
        font-size: 32px;
        line-height: 38px;
        color: var(--secondary-clr);
    }

    .invoice .header .i_row .i_address .p_title span {
        font-weight: 400;
        font-size: 12px;
    }

    .invoice .body .i_table .i_col p {
        font-weight: 700;
    }

    .invoice .body .i_table .i_row .i_col {
        padding: 12px 5px;
    }

    .invoice .body .i_table .i_table_head .i_row {
        border: 2px solid;
        border-color: var(--primary-clr) transparent var(--primary-clr) transparent;
    }

    .invoice .body .i_table .i_table_body .i_row:last-child {
        border-bottom: 2px solid var(--primary-clr);
    }

    .invoice .body .i_table .i_table_foot .grand_total_wrap {
        margin-top: 20px;
    }

    .invoice .body .i_table .i_table_foot .grand_total_wrap .grand_total {
        background: var(--secondary-clr);
        color: var(--white);
        padding: 10px 15px;
    }

    .invoice .body .i_table .i_table_foot .grand_total_wrap .grand_total p {
        display: flex;
        justify-content: space-between;
    }

    .invoice .footer {
        margin-top: 30px;
    }

    .top_line,
    .bottom_line {
        width: 25px;
        height: 175px;
        z-index: 1;
        position: absolute;
        background: var(--secondary-clr);
    }

    .top_line {
        top: 0;
        left: 0;
    }

    .bottom_line {
        bottom: 0;
        right: 0;
    }

    .top_line:before,
    .bottom_line:before {
        content: "";
        position: absolute;
        border: 13px solid;
    }

    .top_line:before {
        bottom: 0;
        left: 0px;
        border-color: transparent var(--white) var(--white) transparent;
    }

    .bottom_line:before {
        top: 0;
        left: 0px;
        border-color: var(--white) transparent transparent var(--white);
    }
</style>

<section>
    <div class="invoice">
        <div class="top_line"></div>
        <div class="header">



            <div class="i_row">
                <div class="i_logo">
                    <p>Cotizacion</p>
                </div>
                <div class="i_title">
                    <h2><?= esc($cotizacionExitosa['cotizacion']['id_transaccion']) ?></h2>
                    <p class="p_title text_right">
                        <?= strftime("%e de %B de %Y", strtotime($cotizacionExitosa['cotizacion']['fecha'])) ?>

                    </p>
                </div>
            </div>
            <div class="i_row">
                <div class="i_number">
                    <p class="p_title">Cotización N°: <?= esc($cotizacionExitosa['cotizacion']['id']) ?></p>
                </div>
                <div class="i_address text_right">

                    <p class="p_title">
                        Nombre: <br />
                        <span><?= esc($cotizacionExitosa['cotizacion']['nombre']) ?></span><br />

                    </p>
                </div>
            </div>
        </div>
        <div class="i_col w_50">
            <p class="p_title">Dirección:</p>
            <p><?= esc($cotizacionExitosa['cotizacion']['direccion']) ?></p>
        </div>

        <div class="i_row">
            <div class="i_col w_50">
                <p class="p_title">Correo:</p>
                <p><?= esc($cotizacionExitosa['cotizacion']['email']) ?></p>
            </div>
            <div class="i_col w_50">
                <p class="p_title">Teléfono:</p>
                <p><?= esc($cotizacionExitosa['cotizacion']['telefono']) ?></p>
            </div>
        </div>


        <div class="body">
            <div class="i_table">
                <div class="i_table_head">
                    <div class="i_row">
                        <div class="i_col w_15">
                            <p class="p_title">CANT</p>
                        </div>
                        <div class="i_col w_55">
                            <p class="p_title">DESCRIPCION</p>
                        </div>
                        <div class="i_col w_15">
                            <p class="p_title">PRECIO</p>
                        </div>
                        <div class="i_col w_15">
                            <p class="p_title">TOTAL</p>
                        </div>
                    </div>
                </div>
                <div class="i_table_body">

                    <?php
                    $totalCotizacion = 0; // Inicializamos la variable para el total
                    foreach ($cotizacionExitosa['cotizacion']['compraDetalles'] as $detalle) :
                        $totalDetalle = $detalle['cantidad'] * $detalle['precio']; // Calculamos el total por detalle
                        $totalCotizacion += $totalDetalle; // Sumamos al total de la cotización
                    ?>
                        <div class="i_row">
                            <div class="i_col w_15">
                                <p><?= esc($detalle['cantidad']) ?></p>
                            </div>
                            <div class="i_col w_55">
                                <p><?= esc($detalle['nombre']) ?></p>
                                <span><?= isset($detalle['descripcion']) ? esc($detalle['descripcion']) : '' ?></span>

                            </div>
                            <div class="i_col w_15">
                                <p>S/.<?= esc($detalle['precio']) ?></p>
                            </div>
                            <div class="i_col w_15">
                                <p>S/.<?= esc($detalle['cantidad'] * $detalle['precio']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="i_table_foot">
                    <div class="i_row">
                        <div class="i_col w_15">
                            <p></p>
                        </div>
                        <div class="i_col w_55">
                            <p></p>
                        </div>
                        <div class="i_col w_15">
                            <p>Sub Total</p>

                        </div>
                        <div class="i_col w_15">
                            <p>S/.<?= esc($cotizacionExitosa['cotizacion']['total']) ?></p>

                        </div>
                    </div>
                    <div class="i_row grand_total_wrap">
                        <div class="i_col w_50">
                        </div>
                        <div class="i_col w_50 grand_total">
                            <p><span>TOTAL:</span>
                                <span>S/.<?= esc($totalCotizacion) ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button id="btnGenerarPDF">Generar PDF</button>

        </div>
        <!-- <div class="footer">
            <div class="i_row">
                <div class="i_col w_50">
                    <p class="p_title">Payment Method</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque, dicta distinctio! Laudantium voluptatibus est nemo.</p>
                </div>
                <div class="i_col w_50 text_right">
                    <p class="p_title">Terms and Conditions</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque, dicta distinctio! Laudantium voluptatibus est nemo.</p>
                </div>
            </div>
        </div> -->
        <div class="bottom_line"></div>
    </div>
</section>


<script>
    $(document).ready(function() {
        vaciarCarrito();


        $('#btnGenerarPDF').click(function() {
            // Codificar la variable $cotizacionExitosa como parte de la URL
            var cotizacionExitosaData = encodeURIComponent(JSON.stringify(<?php echo json_encode($cotizacionExitosa); ?>));

            // Construir la URL con los datos de la cotización
            var url = "<?php echo base_url('checkout/generarPDF'); ?>";
            url += '?cotizacionExitosaData=' + cotizacionExitosaData;

            // Redirigir a la URL para generar el PDF
            window.location.href = url;
        });



        function vaciarCarrito() {
            $('#dni').val('');
            $('#nombre').val('');
            $('#apellido').val('');
            $('#correo').val('');
            $('#telefono').val('');
            $('#departamento').val('');
            $('#provincia').val('');
            $('#distrito').val('');
            $('#direccion').val('');
            $('#numero').val('');
            carrito = [];
            console.log(carrito);
            actualizarVistaCarrito();
            guardarCarritoEnLocalStorage();
        }


        /* function actualizarVistaCarrito() {
            var carritoDropdown = $('.cart-dropdown');
            var cartList = carritoDropdown.find('.cart-list');
            cartList.empty();

            var totalItems = 0;
            var subtotal = 0;

            carrito.forEach(function(producto) {
                totalItems += producto.cantidad;
                subtotal += producto.cantidad * producto.precio;

                var productoHtml = `
            <div class="product-widget">
                <div class="product-img">
                <img src="${base_url}/public/assets/img_tienda/productos/${producto.imagen}" alt="">
                </div>
                <div class="product-body">
                    <h3 class="product-name">${producto.nombre}</h3>
                    <h4 class="product-price">
                        <button class="btn btn-sm btn-secondary decrement-qty">-</button>
                        <span class="qty">${producto.cantidad}</span>
                        <button class="btn btn-sm btn-secondary increment-qty">+</button>
                        x S/.${(producto.precio * producto.cantidad).toFixed(2)}
                    </h4>
                </div>
                <button class="btn btn-sm btn-secondary delete"><i class="fa fa-close"></i></button>
            </div>
         `;
                cartList.append(productoHtml);
            });

            $('.cart-summary small').text(totalItems + ' Producto(s) seleccionados');
            carritoDropdown.find('.cart-summary h5').text('SUBTOTAL: S/.' + subtotal.toFixed(2));

            $('.decrement-qty').click(function() {
                var index = $(this).closest('.product-widget').index();
                if (carrito[index].cantidad > 1) {
                    carrito[index].cantidad--;
                    carrito[index].precioTotal = carrito[index].cantidad * carrito[index].precio;
                    actualizarVistaCarrito();
                    guardarCarritoEnLocalStorage();
                }
            });

            $('.increment-qty').click(function() {
                var index = $(this).closest('.product-widget').index();
                carrito[index].cantidad++;
                carrito[index].precioTotal = carrito[index].cantidad * carrito[index].precio;
                actualizarVistaCarrito();
                guardarCarritoEnLocalStorage();
            });

            $('.delete').click(function() {
                console.log('click en eliminar')
                var index = $(this).closest('.product-widget').index();
                carrito.splice(index, 1);
                console.log(carrito);
                actualizarVistaCarrito();

                guardarCarritoEnLocalStorage();
            });
        }

        function guardarCarritoEnLocalStorage() {
            localStorage.setItem('carrito', JSON.stringify(carrito));

        } */
    });
</script>

<?php echo $this->endSection(); ?>