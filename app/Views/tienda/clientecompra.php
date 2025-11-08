<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>
<style>
    /* Estilos para el contenedor principal */
    #contenido {
        /*         display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column; */
        padding: 50px;
    }

    #tablaCompras {
        width: 100%;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        font-size: 1.2rem;
        font-weight: 400;
    }

    #tablaCompras th,
    #tablaCompras td {
        /* padding: 8px; */
        text-align: left;
    }

    #tablaCompras th {
        background-color: #009fe3;
        color: #fff;
    }

    #tablaCompras tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #tablaCompras tbody tr:hover {
        background-color: #ddd;
    }

    #tablaCompras tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #tablaCompras tbody tr:hover {
        background-color: #ddd;
    }

    .timeline {
        margin: 0 0 45px;
        padding: 0;
        position: relative;
    }

    .timeline::before {
        border-radius: 0.25rem;
        background-color: #dee2e6;
        bottom: 0;
        content: "";
        left: 31px;
        margin: 0;
        position: absolute;
        top: 0;
        width: 4px;
    }

    .timeline>div {
        margin-bottom: 15px;
        margin-right: 10px;
        position: relative;
    }

    .timeline>div::before,
    .timeline>div::after {
        content: "";
        display: table;
    }

    .timeline>div>.timeline-item {
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
        border-radius: 0.25rem;
        background-color: #fff;
        color: #495057;
        margin-left: 60px;
        margin-right: 15px;
        margin-top: 0;
        padding: 0;
        position: relative;
    }

    .timeline>div>.timeline-item>.time {
        color: #999;
        float: right;
        font-size: 12px;
        padding: 10px;
    }

    .timeline>div>.timeline-item>.timeline-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        color: #495057;
        font-size: 16px;
        line-height: 1.1;
        margin: 0;
        padding: 10px;
    }

    .timeline>div>.timeline-item>.timeline-header>a {
        font-weight: 600;
    }

    .timeline>div>.timeline-item>.timeline-body,
    .timeline>div>.timeline-item>.timeline-footer {
        padding: 10px;
    }

    .timeline>div>.timeline-item>.timeline-body>img {
        margin: 10px;
    }

    .timeline>div>.timeline-item>.timeline-body>dl,
    .timeline>div>.timeline-item>.timeline-body ol,
    .timeline>div>.timeline-item>.timeline-body ul {
        margin: 0;
    }

    .timeline>div>.timeline-item>.timeline-footer>a {
        color: #fff;
    }

    .timeline>div>.fa,
    .timeline>div>.fas,
    .timeline>div>.far,
    .timeline>div>.fab,
    .timeline>div>.fal,
    .timeline>div>.fad,
    .timeline>div>.svg-inline--fa,
    .timeline>div>.ion {
        background-color: #adb5bd;
        border-radius: 50%;
        font-size: 16px;
        height: 30px;
        left: 18px;
        line-height: 30px;
        position: absolute;
        text-align: center;
        top: 0;
        width: 30px;
    }

    .timeline>div>.svg-inline--fa {
        padding: 7px;
    }

    .timeline>.time-label>span {
        border-radius: 4px;
        background-color: #fff;
        display: inline-block;
        font-weight: 600;
        padding: 5px;
    }

    .timeline-inverse>div>.timeline-item {
        box-shadow: none;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
    }

    .timeline-inverse>div>.timeline-item>.timeline-header {
        border-bottom-color: #dee2e6;
    }

    .dark-mode .timeline::before {
        background-color: #6c757d;
    }

    .dark-mode .timeline>div>.timeline-item {
        background-color: #343a40;
        color: #fff;
        border-color: #6c757d;
    }

    .dark-mode .timeline>div>.timeline-item>.timeline-header {
        color: #ced4da;
        border-color: #6c757d;
    }

    .dark-mode .timeline>div>.timeline-item>.time {
        color: #ced4da;
    }

    .bg-blue {
        background-color: #007bff !important;
    }

    .bg-yellow {
        background-color: #ffc107 !important;
    }

    .bg-green {
        background-color: #28a745 !important;
    }
    .btnSeguimiento, .verDetalle{
        font-size: 10px;
     
    }
</style>

<div id="contenido">
    <!--  <?php
            echo "<pre>";
            print_r($comprasConDetalles) ?> 
 -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
           <h4 class="text-center">Compras del Usuario <?= $userData['nombre'] ?></h2>
                <div id="compras" class="compras-body">

                    <div class="table-responsive">
                        <table id="tablaCompras" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Transacción</th>
                                    <th>Fecha</th>
                                    <th>T. Entrga</th>
                                    <th>Correo</th>
                                    <th>Cliente</th>
                                    <th>DNI</th>
                                    <th>Canal</th>
                                    <th>Ubicación</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                   <th style="width:70px;">Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($comprasConDetalles as $compra) : ?>
                                    <tr>
                                        <td><?= $compra['id'] ?></td>
                                        <td><?= $compra['id_transaccion'] ?></td>
                                        <td><?= $compra['fecha'] ?></td>
                                        <td><?= $compra['tipo_entrega'] ?></td>

                                        <td><?= $compra['email'] ?></td>
                                        <td><?= $compra['nombre'] ?></td>
                                        <td><?= $compra['dni'] ?></td>
                                        <td><?= $compra['canal_pago'] ?></td>
                                        <td><?= $compra['ubicacion_recojo'] ?></td>
                                        <td><?= number_format($compra['total'] + $compra['costo_envio'], 2) ?></td>


                                        <td>
                                            <?php if ($compra['status_compra'] == 2) : ?>
                                                Pendiente
                                            <?php elseif ($compra['status_compra'] == 3) : ?>
                                                Proceso
                                            <?php elseif ($compra['status_compra'] == 1) : ?>
                                                Approved
                                            <?php elseif ($compra['status_compra'] == 4) : ?>
                                                Rechazado
                                            <?php else : ?>
                                                <?= $compra['status_compra'] ?>
                                            <?php endif; ?>
                                        </td>





                                        <td>
                                            <!-- Icono de lupa como acción -->
                                            <a href="#" class="btn btn-primary verDetalle" data-compra-id="<?= $compra['id'] ?>">
                                                <i class="fas fa-search"></i> <!-- Usa la clase correspondiente al icono de lupa -->
                                            </a>

                                            <a type="button" class="btn btn-success btnSeguimiento" data-compra-id="<?= $compra['id'] ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>


    </div>
</div>

<div id="newsletter" class="section">
    <div class="container">
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
    </div>
</div>

<!-- Modal para mostrar los detalles de la compra -->
<div class="modal fade" id="detalleCompraModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de la Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí se mostrarán los detalles de la compra -->
                <div id="detalleCompraContent"></div>
                <img id="voucherImage" src="" alt="Voucher">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="seguimiento">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Seguimiento</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <section class="content">
                    <div class="container-fluid">

                        <!-- Timelime example  -->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- The time line -->
                                <div class="timeline">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-red">10 Feb. 2014</span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> 12:05</span>
                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a class="btn btn-primary btn-sm">Read more</a>
                                                <a class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-green"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> 5 mins ago</span>
                                            <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-yellow"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a class="btn btn-warning btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-green">3 Jan. 2014</span>
                                    </div>


                                    <!-- END timeline item -->
                                    <div>
                                        <i class="fas fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.timeline -->
                    <a href="<?= base_url("/shop") ?>">
                        <button type="button" class="btn btn-success"> Seguir comprando</button>
                    </a>
                </section>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#tablaCompras').DataTable({
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            },
            "order": [
                [0, "desc"]
            ]
        });

        $('#tablaCompras').on('click', '.verDetalle', function() {
            var compraId = $(this).data('compra-id');

            $.ajax({
                url: '<?php echo base_url('compras/detalle_compra/'); ?>' + compraId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    $('#detalleCompraContent').empty();
                    $('#voucherImage').attr('src', '').css({
                        'width': 'auto',
                        'display': 'none'
                    });



                    var compraInfoHtml = '<table class="table">';
                    compraInfoHtml += '<tbody>';
                    compraInfoHtml += '<tr><td>Nro</td><td>' + response.compra.id + '</td></tr>';
                    compraInfoHtml += '<tr><td>Transacción</td><td>' + response.compra.id_transaccion + '</td></tr>';
                    compraInfoHtml += '<tr><td>Fecha</td><td>' + response.compra.fecha + '</td></tr>';
                    compraInfoHtml += '<tr><td>DNI</td><td>' + response.compra.dni + '</td></tr>';
                    compraInfoHtml += '<tr><td>Nombre</td><td>' + response.compra.nombre + '</td></tr>';
                    compraInfoHtml += '<tr><td>Total</td><td>' + response.compra.total + '</td></tr>';
                    compraInfoHtml += '</tbody></table>';

                    $('#detalleCompraContent').html(compraInfoHtml);

                    var detallesHtml = '<table class="table">';
                    detallesHtml += '<thead><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr></thead>';
                    detallesHtml += '<tbody>';
                    var total = 0;
                    $.each(response.detalles, function(index, detalle) {
                        var detalleTotal = parseFloat(detalle.precio) * parseInt(detalle.cantidad);
                        detallesHtml += '<tr>';
                        detallesHtml += '<td>' + detalle.id + '</td>';
                        detallesHtml += '<td>' + detalle.nombre + '</td>';
                        detallesHtml += '<td>' + detalle.precio + '</td>';
                        detallesHtml += '<td>' + detalle.cantidad + '</td>';
                        detallesHtml += '<td>' + detalleTotal.toFixed(2) + '</td>';
                        detallesHtml += '</tr>';

                        total += detalleTotal;
                    });

                    // Añadir costo de envío al total
                    var costoEnvio = parseFloat(response.compra.costo_envio);
                    total += costoEnvio;

                    detallesHtml += '<tfoot>';
                    detallesHtml += '<tr>';
                    detallesHtml += '<td colspan="4">Costo de Envío</td>';
                    detallesHtml += '<td>' + costoEnvio.toFixed(2) + '</td>';
                    detallesHtml += '</tr>';
                    detallesHtml += '<tr>';
                    detallesHtml += '<td colspan="4"></td>';
                    detallesHtml += '<td>Total: ' + total.toFixed(2) + '</td>';
                    detallesHtml += '</tr>';
                    detallesHtml += '</tfoot>';

                    detallesHtml += '</tbody></table>';

                    $('#detalleCompraContent').append(detallesHtml);

                    let voucherNombre = response.compra.voucher_img;
                    // Construir la URL completa del voucher
                    let rutaVoucher = '<?php echo base_url("public/assets/tienda/vouchers/"); ?>' + voucherNombre;

                    if (voucherNombre) {
                        $('#voucherImage').attr('src', rutaVoucher).css({
                            'width': '300px',
                            'display': 'block',
                            'margin': 'auto'
                        });
                    } else {
                        $('#voucherPanel').html('<h3 style="text-align: center;">No hay voucher disponible.</h3>');
                    }



                    // Mostrar el modal
                    $('#detalleCompraModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });


        });


        $(document).on('click', '.btnSeguimiento', function() {
            var compraId = $(this).data('compra-id');
            console.log('id de comora', compraId);
            var estadoId = $(this).data('id_estado'); // Corregido aquí
            console.log('ID del estado seleccionado:', estadoId);
            /*  $('#seguimiento').modal('show'); */

            $.ajax({
                url: '<?php echo base_url('clientecompra/obtenerSeguimiento'); ?>',
                type: 'POST',
                data: {
                    compra_id: compraId
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);


                    $('.timeline').empty();

                    var fechaInicio = response.seguimiento[0].fecha_cambio;
                    var timelineStart = '<div class="time-label"><span class="bg-red">' + formatDate(fechaInicio) + '</span></div>';
                    $('.timeline').append(timelineStart);

                    response.seguimiento.forEach(function(item) {
                        var timelineItem = '<div>';
                        timelineItem += getIcon(item.estado_id, item.motivo_id);
                        timelineItem += '<div class="timeline-item">';
                        timelineItem += '<span class="time"><i class="fas fa-clock"></i>' + item.fecha_cambio + '</span>';
                        timelineItem += '<h3 class="timeline-header">' + formatDate(item.fecha_cambio) + '</h3>';
                        timelineItem += '<div class="timeline-body">' + item.descripcion + '</div>'; // Aquí se agrega la descripción
                        timelineItem += '</div>';
                        timelineItem += '</div>';

                        $('.timeline').append(timelineItem);
                    });

                    var timelineEnd = '<div><i class="fas fa-clock bg-gray"></i></div>';
                    $('.timeline').append(timelineEnd);



                    $('#seguimiento').modal('show');

                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });



        });


        function getIcon(estadoId, motivoId) {
            switch (estadoId) {
                case '2':
                    return '<i class="fas fa-shopping-cart bg-blue"></i>'; // Icono para estado "Pendiente"
                case '1':
                    return '<i class="fas fa-check-circle bg-green"></i>'; // Icono para estado "Completado"
                case '3':
                    return '<i class="fas fa-comments bg-yellow"></i>'; // Icono para estado "En proceso"
                default:
                    return '<i class="fas fa-exclamation-triangle bg-yellow"></i>'; // Icono predeterminado
            }
        }

        function formatDate(dateString) {
            var options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            var date = new Date(dateString);
            return date.toLocaleDateString('es-ES', options);
        }
    });
</script>
<?php echo $this->endSection(); ?>