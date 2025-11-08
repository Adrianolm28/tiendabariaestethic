<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>

<style>
    body {
        background-color: #eee;
    }

    /* Estilo para el formulario */
    #resumen-compra-form {
        margin-top: 20px;
        border-radius: 10px;
        border: 1px solid #ccc;
        padding: 20px;
        background-color: #fff;
    }

    /* Estilo para los campos de entrada */
    #resumen-compra-form .form-group {
        margin-bottom: 15px;
    }

    /* Estilo para la etiqueta de los campos */
    #resumen-compra-form label {
        font-weight: bold;
    }

    /* Estilo para los campos de entrada de solo lectura */
    #resumen-compra-form input[readonly] {
        background-color: #f5f5f5;
    }

    /* Estilo para la cabecera del DataTable */
    #carrito-table thead {
        background-color: #0a58ca;
        color: white;
    }

    .producto {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        border-bottom: 1px solid #ccc;
        padding: 10px;
        background-color: #fff;
        margin-bottom: 10px;
        border-radius: 10px;
    }

    /* Imagen del producto */
    .producto-imagen img {
        width: 100px;
        margin-right: 10px;
        border-radius: 8px;
    }

    /* Detalles del producto */
    .producto-detalle {
        flex: 1;
        margin-bottom: 10px;
    }

    .producto-detalle p {
        margin: 5px 0;
    }

    /* Contenedor de precios */
    .precios_carrito {
        display: flex;
        flex-direction: column;

        margin-right: 20px;
    }

    .producto-precio,
    .producto-precio-transferencia {

        font-weight: 500;
        margin: 0;
    }

    .producto-precio-transferencia {
        color: #666;
        font-size: 0.9em;
    }

    /* Contador de cantidad */
    .producto-cantidad {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    .producto-cantidad .btn-qty {
        margin: 5px;
        background-color: #0C2941;
        color: white;
    }

    /* Total del producto */
    .producto-total {
        font-weight: bold;
        margin-left: auto;
        margin-right: 20px;
    }

    /* Botón de eliminar */
    .producto-eliminar button {
        margin-left: auto;
        background-color: #e4022d;
        border: none;
        padding: 5px 10px;
        color: white;
        border-radius: 5px;
    }

    /* Cupón */
    .redeem-coupon {
        border: 2px dashed #ccc;
        padding: 10px;
        max-width: 300px;
        margin-bottom: 10px;
    }

    .code-text {
        font-weight: bold;
    }

    .redeem-coupon.d-none {
        display: none;
    }

    .close-btn {
        position: absolute;
        right: 20px;
        cursor: pointer;
    }

    .applied {
        color: rgb(0, 200, 0);
    }

    .cupon-error {
        color: red;
        font-weight: bold;
    }

    .cupon-error.d-none {
        display: none;
    }


    /* fin cupon */


    /* transferencia */

    /* General */
    .precio-transferencia-container {
        display: flex;
        align-items: center;
        margin-top: 5px;
        gap: 5px;
    }

    .producto-precio-transferencia {
        font-size: 0.9em;
        color: #d10024;
    }

    .precio-transferencia-label {
        background-color: #d10024;
        color: white;
        border-radius: 20px;
        padding: 5px;
        font-size: 0.8em;
        text-align: center;
        line-height: 1;
    }

    /* Responsive */

    @media (max-width: 768px) {


        .producto-nombre {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 10ch;
        }




    }

    .banner_resumen {
        background-color: #C2D8EA;
        padding: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-radius: 20px;
        margin-top: 5px;
        margin-bottom: 6px;
    }

    .banner-img {
        max-width: 35px;

    }
    .parraf_resumen{
        font-size: 1.0rem;
        font-weight: bold;
    }
</style>


<div class="container">
    <br>



    <h3 class="mt-4">Carrito</h3>
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div id="carrito-body" class="carrito-body">
                <!-- Aquí se agregarán dinámicamente los productos del carrito -->
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <h4>Resumen de Compra</h4>
            <form id="resumen-compra-form">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6 col-md-5 label-title"> <!-- Ajuste de columnas para dispositivos pequeños -->
                            <label for="subtotal">Subtotal:</label>
                        </div>
                        <div class="col-6 col-md-7">
                            <input type="text" class="form-control" id="subtotal" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6 col-md-5 label-title"> <!-- Ajuste de columnas para dispositivos pequeños -->
                            <label for="total">Total:</label>
                        </div>
                        <div class="col-6 col-md-7">
                            <input type="text" class="form-control" id="total" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="cupon">¿Tienes un cupón de descuento?</label>
                    <div class="row">
                        <div class="col-md-8">
                            <input name="cupon" type="text" class="form-control mr-2" id="cupon" placeholder="Codigo">
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary" id="aplicar-cupon-btn">Aplicar</button>
                        </div>

                    </div>

                </div>

                <div class="redeem-coupon d-none">
                    <button type="button" class="close-btn">&times;</button>
                    <div class="redeem-coupon-code">
                        <ul>
                            <li class="code-text applied">Se ha aplicado <b id="cupon-codigo"></b></li>
                            <li>Cupón de Valeapp</li>
                        </ul>
                    </div>
                </div>
                <div id="cupon-error" class="cupon-error d-none">El cupón no es válido o ha caducado</div>



                <button id="continuar-compra-btn" style="background-color: #0C2941;" type="button" class="btn btn-success">Continuar con la compra</button>


            </form>
            <div class="banner_resumen">
                <img src="<?= base_url('public/assets/img_tienda/iconos/bcp.png') ?>" alt="BCP" class="banner-img">
                <span class="parraf_resumen">¡Ahorra, pagando con transferencia y obten el mejor descuento!</span>
            </div>

        </div>


    </div>
    <a href="<?= base_url("/shop") ?>">
        <button type="button" class="btn btn-success"> Seguir comprando</button>
    </a>

</div>





<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Suscríbete para más <strong>OFERTAS!</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Ingresa tu correo">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Suscríbete</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<!-- <script>
    $(document).ready(function() {
        var tableCarrito = new DataTable('#carrito-table', {
            language: {
                url: '//cdn.datatables.net/plug-ins/2.0.2/i18n/es-ES.json',
            },
        });
    });
</script>
 -->
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/2.0.2/i18n/es-ES.json"></script>
<?php if (session()->has('error')) : ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= session('error') ?>',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                window.location.href = "<?php echo base_url('tienda/carrito'); ?>";
            });
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        var base_url = "<?php echo base_url() ?>";
        var subtotal = 0;

        function cargarCarritoDesdeLocalStorage() {
            // Siempre lee el localStorage, no el array global
            var carritoGuardado = localStorage.getItem('carrito');
            var carritoBody = document.getElementById('carrito-body');
            var continuarCompraBtn = document.getElementById('continuar-compra-btn');
            subtotal = 0;

            if (carritoGuardado && JSON.parse(carritoGuardado).length > 0) {
                var carrito = JSON.parse(carritoGuardado);
                carritoBody.innerHTML = '';
                carrito.forEach(function(producto) {
                    var divProducto = document.createElement('div');
                    divProducto.classList.add('producto');
                    divProducto.setAttribute('data-id', producto.id);

                    var precioTransferenciaHTML = '';
                    if (producto.precio_transferencia) {
                        var precioTransferenciaSinDecimales = parseInt(producto.precio_transferencia, 10);
                        precioTransferenciaHTML = `
                            <div class="precio-transferencia-container">
                                <p class="producto-precio-transferencia">S/.${precioTransferenciaSinDecimales}</p>
                                <span class="precio-transferencia-label">transf.</span>
                            </div>`;
                    }

                    divProducto.innerHTML = `
                        <div class="producto-imagen">
                            <img src="${base_url}/public/assets/img_tienda/productos/${producto.imagen}" alt="">
                        </div>
                        <div class="producto-detalle">
                            <p class="producto-nombre">${producto.nombre}</p>
                        </div>
                        <div class="precios_carrito">
                            ${precioTransferenciaHTML}
                            <p class="producto-precio">S/.${producto.precio}</p>
                        </div>
                        <div class="producto-cantidad">
                            <button class="btn btn-sm btn-secondary decrement2-qty btn-qty">-</button>
                            <span class="qty">${producto.cantidad}</span>
                            <button class="btn btn-sm btn-secondary increment1-qty btn-qty">+</button>
                        </div>
                        <div class="producto-total">S/.${producto.precio * producto.cantidad}</div>
                        <div class="producto-eliminar">
                            <button class="btn btn-sm btn-danger deletePro"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    `;
                    carritoBody.appendChild(divProducto);
                    subtotal += producto.precio * producto.cantidad;
                });
                continuarCompraBtn.disabled = false;
            } else {
                carritoBody.innerHTML = '<p>NO EXISTEN PRODUCTOS EN EL CARRITO</p>';
                continuarCompraBtn.disabled = true;
            }
            actualizarFormulario();
        }

        cargarCarritoDesdeLocalStorage();



        $(document).on('click', '.increment1-qty', function() {

            var row = $(this).closest('.producto');
            var qtyElement = row.find('.qty');
            var qty = parseInt(qtyElement.text());
            qty++;
            qtyElement.text(qty);
            actualizarTotal(row);
            actualizarCarritoLocalStorage(row);

        });

        $(document).on('click', '.decrement2-qty', function() {

            var row = $(this).closest('.producto');
            var qtyElement = row.find('.qty');
            var qty = parseInt(qtyElement.text());
            if (qty > 1) {
                qty--;
                qtyElement.text(qty);
                actualizarTotal(row);
                actualizarCarritoLocalStorage(row);
            }
        });


        function actualizarCarritoLocalStorage(row) {
            // Obtener el índice del producto en el carrito
            var index = $('.producto').index(row);

            // Obtener el carrito del localStorage
            var carritoGuardado = localStorage.getItem('carrito');
            if (carritoGuardado) {
                var carrito = JSON.parse(carritoGuardado);

                // Actualizar la cantidad en el carrito
                var cantidad = parseInt(row.find('.qty').text());
                carrito[index].cantidad = cantidad;

                // Guardar el carrito actualizado en el localStorage
                localStorage.setItem('carrito', JSON.stringify(carrito));
            }
            console.log('actualizando acrrito ', carrito)
        }

        function actualizarTotal(row) {
            var qty = parseInt(row.find('.qty').text());
            var priceString = row.find('.producto-precio').text(); // Obtener el precio como texto
            var price = parseFloat(priceString.replace('S/.', '')); // Convertir el precio a número eliminando 'S/.'


            var total = qty * price;
            row.find('.producto-total').text('S/.' + total); // Agregar 'S/.' al total antes de mostrarlo

            // Recalcular el subtotal
            subtotal = 0;
            $('.producto-total').each(function() {
                subtotal += parseFloat($(this).text().replace('S/.', ''));
            });

            // Actualizar el formulario con el nuevo subtotal y total
            actualizarFormulario();
        }

        /* function actualizarFormulario() {
            // Recalcular subtotal y total
            var subtotal = 0;
            $('.producto').each(function() {
                var qty = parseInt($(this).find('.qty').text());
                var priceString = $(this).find('.producto-precio').text(); // Obtener el precio como texto
                var price = parseFloat(priceString.replace('S/.', '')); // Convertir el precio a número eliminando 'S/.'


                subtotal += qty * price;
            });



            var nuevoSubtotal = subtotal;
            if (descuento > 0) {
                // Restar el descuento del subtotal
                nuevoSubtotal = subtotal - descuento;
            }

            // Actualizar subtotal y total en el formulario
            $('#subtotal').val('S/.' + subtotal);
            $('#total').val('S/.' + nuevoSubtotal);
        } */

        $('.deletePro').click(function() {
            var row = $(this).closest('.producto');
            var productId = row.data('id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Una vez eliminado, no podrás recuperar este producto del carrito.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminarlo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    var index = row.index();
                    carrito.splice(index, 1);

                    // Guardar el carrito actualizado en el localStorage
                    guardarCarritoEnLocalStorage();
                    console.log('Carrito actualizado en localStorage:', carrito);
                    // Quitar dinámicamente la fila de la tabla
                    row.remove();

                    // Actualizar el subtotal y el total en el formulario
                    actualizarFormulario();

                    console.log('Después de recargar la tabla');
                    Swal.fire(
                        '¡Eliminado!',
                        'El producto ha sido eliminado del carrito.',
                        'success'
                    );
                }
            });


            // Aquí puedes agregar la lógica para actualizar el carrito en el localStorage si es necesario
        });



        var descuento = 0;

        $('#aplicar-cupon-btn').click(function() {
            // Obtener el valor del cupón ingresado por el usuario
            var cupon = $('#cupon').val();


            if (cupon.trim() === '') {
                // Si el campo está vacío, eliminar el descuento de la sesión
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('cupon/eliminarDescuento'); ?>',
                    success: function(response) {
                        console.log('Descuento eliminado de la sesión');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar el descuento de la sesión:', error);
                    }
                });
                return;
            }

            // Validar el cupón y obtener el descuento correspondiente
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('cupon/validarCupon'); ?>',
                data: {
                    cupon: cupon
                },
                dataType: 'json',
                success: function(response) {
                    /*  console.log(response); */

                    if (response.success) {
                        // El cupón se validó correctamente, ahora obtener el descuento desde la sesión
                        $.ajax({
                            type: 'GET',
                            url: '<?php echo base_url('cupon/obtenerDescuento'); ?>',
                            dataType: 'json',
                            success: function(descuentoResponse) {
                                /*  console.log(descuentoResponse); */
                                // Manejar la respuesta del descuento
                                if (descuentoResponse.descuento) {
                                    // Aplicar el descuento en la interfaz de usuario
                                    var descuento = parseFloat(descuentoResponse.descuento);
                                    console.log('Descuento aplicado:', descuento);
                                    actualizarFormulario(descuento);
                                    $('#cupon-codigo').text(cupon);
                                    $('.redeem-coupon').removeClass('d-none');
                                    $('.cupon-error').addClass('d-none');
                                } else {
                                    // Si no hay descuento disponible
                                    descuento = 0;
                                    actualizarFormulario(descuento);
                                    $('.redeem-coupon').addClass('d-none');
                                    $('.cupon-error').removeClass('d-none');
                                }
                            },
                            error: function(xhr, status, error) {
                                // Manejar errores si es necesario al obtener el descuento
                                console.error('Error al obtener el descuento:', error);
                            }
                        });
                    } else {
                        // Si la validación del cupón no fue exitosa
                        console.error('Error al validar el cupón:', response.error); // Puedes manejar el error si lo deseas
                    }

                },
                error: function(xhr, status, error) {
                    // Manejar errores si es necesario
                    console.error('Error al validar el cupón:', error);
                }
            });
        });

        $('.close-btn').click(function() {
            $('.redeem-coupon').addClass('d-none');
            $('#cupon').val('');
            descuento = 0; // Restablecer el descuento
            actualizarFormulario(descuento);

        });
        $('#cupon').on('input', function() {
            var cupon = $(this).val();
            if (!cupon.trim()) {
                $('.redeem-coupon').addClass('d-none');
                $('.cupon-error').addClass('d-none');
            }
        });


        function actualizarFormulario(descuento) {
            // Recalcular subtotal y total
            var subtotal = 0;
            $('.producto').each(function() {
                var qty = parseInt($(this).find('.qty').text());
                var priceString = $(this).find('.producto-precio').text(); // Obtener el precio como texto
                var price = parseFloat(priceString.replace('S/.', '')); // Convertir el precio a número eliminando 'S/.'


                subtotal += qty * price;
            });

            var nuevoSubtotal = subtotal;


            var descuentoAplicado = subtotal * (descuento / 100);


            if (descuento > 0) {
                // Restar el descuento del subtotal
                nuevoSubtotal = subtotal - descuentoAplicado;
            }



            // Actualizar subtotal y total en el formulario
            $('#subtotal').val('S/.' + subtotal);
            $('#total').val('S/.' + nuevoSubtotal);
        }


        $('#continuar-compra-btn').click(function() {
            // Verificar si la sesión está iniciada
            var sesionIniciada = <?= session()->has('usuario_autenticado') ? 'true' : 'false' ?>;

            // Recopilar productos del carrito desde el localStorage
            var carritoGuardado = localStorage.getItem('carrito');
            var productos = JSON.parse(carritoGuardado);

            if ($('#cupon').val().trim() === '') {
                // Si el campo del cupón está vacío, eliminar el descuento de la sesión
                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('cupon/eliminarDescuento'); ?>',
                    success: function(response) {
                        console.log('Descuento eliminado de la sesión');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar el descuento de la sesión:', error);
                    }
                });


                window.location.href = "<?php echo base_url('checkout/ingresarDatos'); ?>";


                return;
            }

            if (sesionIniciada) {
                // Realizar la solicitud AJAX para obtener el descuento

                $.ajax({
                    type: 'GET',
                    url: '<?php echo base_url('cupon/obtenerDescuento'); ?>',
                    dataType: 'json',
                    success: function(descuentoResponse) {
                        // Manejar la respuesta del descuento
                        if (descuentoResponse.hasOwnProperty('descuento')) {
                            // Obtener el descuento del objeto de respuesta
                            var descuento = parseFloat(descuentoResponse.descuento);

                            // Verificar si el descuento es null o 0
                            if (descuento === null || descuento === 0) {
                                // Si el descuento es null o 0, redirigir a la página de ingresarDatos
                                window.location.href = "<?php echo base_url('checkout/ingresarDatos'); ?>";
                            } else {
                                // Si hay un descuento válido, continuar con el proceso normal
                                // Enviar el carrito con el descuento aplicado
                                var datos = {
                                    carrito: productos,
                                    descuento: descuento
                                };

                                console.log('datos', datos);

                                // Realizar la solicitud AJAX para procesar el carrito
                                $.ajax({
                                    type: 'POST',
                                    url: '<?= base_url('checkout/procesarCarrito') ?>',
                                    data: datos,
                                    success: function(response) {
                                        // Manejar la respuesta del controlador si es necesario
                                        console.log('Respuesta del servidor:', response);
                                        var descuentoAplicado = response.descuento;

                                        // Redirigir a la página de ingresarDatos con el descuento aplicado
                                        window.location.href = "<?php echo base_url('checkout/ingresarDatos'); ?>";
                                    },
                                    error: function(xhr, status, error) {
                                        // Manejar errores si es necesario
                                        console.error(xhr.responseText);
                                    }
                                });
                            }
                        } else {
                            console.error('No se pudo obtener el descuento');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Manejar errores si es necesario al obtener el descuento
                        console.error('Error al obtener el descuento:', error);
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
                    window.location.href = "<?php echo base_url('tienda/carrito'); ?>";
                });
            }
        });



        // Solo escucha el evento de vaciado global y refresca la vista del carrito en esta página
        document.addEventListener('carritoVaciado', function() {
            cargarCarritoDesdeLocalStorage();
            $('#subtotal').val('S/.0');
            $('#total').val('S/.0');
            $('.redeem-coupon').addClass('d-none');
            $('.cupon-error').addClass('d-none');
            $('#cupon').val('');
        });
        // Oculta los productos del carrito en la UI al hacer click en cualquier botón .vaciar
        $(document).on('click', '.vaciar', function () {
            $('#carrito-body').empty().append('<p>NO EXISTEN PRODUCTOS EN EL CARRITO</p>');
            $('#subtotal').val('S/.0');
            $('#total').val('S/.0');
            $('.redeem-coupon').addClass('d-none');
            $('.cupon-error').addClass('d-none');
            $('#cupon').val('');
        });
    });
</script>
<?php echo $this->endSection(); ?>