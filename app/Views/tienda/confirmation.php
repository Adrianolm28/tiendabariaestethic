<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>

<style>
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
</style>
<div class="container mt-5">
    <!-- <?php if (session()->getFlashdata('compraExitosa')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('compraExitosa') ?>
        </div>
    <?php endif; ?> -->
    <br>
    <form>
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>ID de transacción:</strong> <?= $datosCompra['compra']['id_transaccion']; ?></li>
                    <li class="list-group-item"><strong>Fecha:</strong> <?= $datosCompra['compra']['fecha']; ?></li>
                    <li class="list-group-item"><strong>Estado:</strong> <?= $datosCompra['compra']['status']; ?></li>
                    <li class="list-group-item"><strong>Email:</strong> <?= $datosCompra['compra']['email']; ?></li>
                    <li class="list-group-item"><strong>Telefono:</strong> <?= $datosCompra['compra']['telefono']; ?></li>
                    <li class="list-group-item"><strong>Direccion:</strong> <?= $datosCompra['compra']['direccion']; ?></li>
                </ul>
            </div>
        </div>
    </form>

    <!-- Formulario de Detalles de Compra -->
    <form>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>ID de Transacción:</label>
                    <input type="text" class="form-control" value="<?= $datosCompra['compra']['id_transaccion']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Estado:</label>
                    <input type="text" class="form-control" value="<?= $datosCompra['compra']['status']; ?>" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Total:</label>
                    <input type="text" class="form-control" value="<?= 'S/ ' . number_format($datosCompra['compra']['total'], 2); ?>" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tipo Entrega:</label>
                    <input type="text" class="form-control" value="<?= $datosCompra['compra']['tipo_entrega'] ?>" readonly>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-md-12">
                <h3>Detalles de la Compra:</h3>
                <!-- Datatable para Detalles de la Compra -->
                <table id="detallesCompra" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color: #007bff; color: #fff;">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;

                        // Calcular el total de la compra sin aplicar descuento
                        foreach ($datosCompra['compraDetalles'] as $detalle) {
                            $precioTotalProducto = $detalle['precio'] * $detalle['cantidad'];
                            $total += $precioTotalProducto; // Suma al total de la compra
                            // Mostrar fila con detalles del producto
                            echo '<tr>';
                            echo '<td>' . $detalle['nombre'] . '</td>';
                            echo '<td>' . $detalle['cantidad'] . '</td>';
                            echo '<td>' . 'S/ ' . number_format($detalle['precio'], 2) . '</td>';
                            echo '<td>' . 'S/ ' . number_format($precioTotalProducto, 2) . '</td>';

                            echo '</tr>';
                        }

                        // Mostrar el costo de envío
                        $costoEnvio = $datosCompra['costoEnvio'];
                        echo '<tr>';
                        echo '<td colspan="2">Costo de envío</td>';
                        echo '<td></td>'; // Celda vacía para mantener la alineación con las otras columnas
                        if ($costoEnvio > 0) {
                            echo '<td>' . 'S/ ' . number_format($costoEnvio, 2) . '</td>';
                        } else {
                            echo '<td>Gratuito</td>';
                        }
                        echo '</tr>';

                        // Aplicar descuento si es mayor que 0
                        $descuento = $datosCompra['compra']['descuento'];
                        if ($descuento > 0) {
                            $descuentoAplicado = $total * ($descuento / 100);
                            $total -= $descuentoAplicado;
                            // Mostrar el descuento
                            echo '<tr>';
                            echo '<td colspan="2">Descuento</td>';
                            echo '<td></td>'; // Celda vacía para mantener la alineación con las otras columnas
                            echo '<td>' . 'S/ ' . number_format($descuentoAplicado, 2) . '</td>';
                            echo '</tr>';
                        }

                        // Mostrar el total
                        echo '<tr>';
                        echo '<td colspan="2"><strong>Total:</strong></td>';
                        echo '<td></td>'; // Celda vacía para mantener la alineación con las otras columnas
                        echo '<td>' . 'S/ ' . number_format($total + $costoEnvio, 2) . '</td>';
                        echo '</tr>';
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
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