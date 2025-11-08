<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>
<style>
    body {
        background-color: #eee;
    }
</style>





<div class="container">
  
    <br>
    <h3 class="mt-4">Compra Exitosa</h3>
    <div class="row">
        <div class="col-md-4 d-flex justify-content-center mt-4">
            <div class="card p-3" style="background-color: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

                <div class="form-group text-center">
                    <label for="paymentId" class="font-weight-bold">Pago ID:</label>
                    <span id="paymentId"><?php echo $paymentId; ?></span>
                </div>
                <div class="form-group text-center">
                    <label for="status" class="font-weight-bold">Estado:</label>
                    <span id="status"><?php echo $status; ?></span>
                </div>
                <div class="form-group text-center">
                    <label for="paymentType" class="font-weight-bold">Tipo de Pago:</label>
                    <span id="paymentType"><?php echo $paymentType; ?></span>
                </div>
                <div class="form-group text-center">
                    <label for="merchantOrderId" class="font-weight-bold">Orden ID:</label>
                    <span id="merchantOrderId"><?php echo $merchantOrderId; ?></span>
                </div>

                <?php if (!empty($compra['ubicacion_recojo']) && $compra['fecha_recojo'] != '0000-00-00' && $compra['hora_recojo'] != '00:00:00' && !empty($compra['estado_recojo']) && !empty($compra['nombre_recojo'])) : ?>
                    <div class="form-group text-center mt-3">
                        <label class="font-weight-bold">Detalles de Recojo:</label>
                        <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($compra['ubicacion_recojo']); ?></p>
                        <p><strong>Fecha de Recojo:</strong> <?php echo date('d/m/Y', strtotime($compra['fecha_recojo'])); ?></p>
                        <p><strong>Hora de Recojo:</strong> <?php echo date('H:i', strtotime($compra['hora_recojo'])); ?></p>
                        <p><strong>Estado de Recojo:</strong> <?php echo htmlspecialchars($compra['estado_recojo']); ?></p>
                        <p><strong>Persona que Recoje:</strong> <?php echo htmlspecialchars($compra['nombre_recojo']); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-8">
            <div style="border-radius: 10px; overflow: hidden;">
                <table class="table" style="border-radius: 10px; border: none;">
                    <thead style="background-color: #007bff; color: #fff;">
                        <tr>
                            <th>Cantidad</th>
                            <th>Producto</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #fff;">
                        <?php
                        $totalCompra = 0;
                        $costoEnvio = ($compra['tipo_entrega'] == 'recojo') ? 0 : 9.90; 
                        $descuento = $compra['descuento'] ?? 0;
                        foreach ($compraDetalles as $detalle) :
                            // Calcula el importe para este detalle y acumula el total
                            $importe = $detalle['precio'] * $detalle['cantidad'];
                            $totalCompra += $importe;
                        ?>



                            <tr>
                                <td><?php echo $detalle['cantidad']; ?></td>
                                <td><?php echo $detalle['nombre']; ?></td>
                                <td><?php echo 'S/ ' . number_format($detalle['precio'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Agregar fila para el costo de envío -->
                        <tr>
                            <td colspan="2">Costo de envío</td>
                            <td><?php echo 'S/ ' . number_format($costoEnvio, 2); ?></td>
                        </tr>

                        <!-- Si hay descuento, mostrar la fila correspondiente -->
                        <?php if ($descuento > 0) : ?>
                            <tr>
                                <td colspan="2">Descuento %</td>
                                <!-- Calcular el descuento aplicado -->
                                <td><?php echo 'S/ ' . number_format(($totalCompra * $descuento) / 100, 2); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <!-- Calcular el nuevo total sumando el total de la compra con el costo de envío -->
                            <td>Total: <?php echo 'S/ ' . number_format($totalCompra + $costoEnvio - (($totalCompra * $descuento) / 100), 2); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
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

<script>
    $(document).ready(function() {
        vaciarCarrito();

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


        function actualizarVistaCarrito() {
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

        }
    });
</script>




<?php echo $this->endSection(); ?>