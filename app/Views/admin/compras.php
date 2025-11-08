<?php include("admin_header.php")  ?>


<style>
    .my-custom-row {
        margin-bottom: 20px;

    }

    /* Estilo para los inputs */
    .my-input {
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 10px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    /* Estilo para los selects */
    .my-select {
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ced4da;
        border-radius: 10px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }


    .my-select:focus {
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
</style>



<section class="content">
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/multi_imagen.css') ?>">

    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">



                        <div class="row my-custom-row">
                            <div class="col-md-3">
                                <label for="daterange">Fecha:</label>
                                <input type="text" name="daterange" id="daterange" class="form-control my-input" />
                            </div>
                            <div class="col-md-3">
                                <label for="estado">Estado:</label>
                                <select name="estado" id="estado" class="form-control my-select">
                                    <?php foreach ($estados as $estado) : ?>

                                        <option value="<?= $estado['id_estado'] ?>"><?= $estado['nombre_estado'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button id="btnAplicarFiltros" class="btn btn-primary">Aplicar Filtros</button>
                            </div>
                        </div>


                        <div class="card-body">
                            <table id="comprasTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Id Transacción</th>
                                        <th>Orden estado</th>
                                        <th>fecha</th>
                                        <!-- <th>status</th> -->
                                        <th>email</th>

                                        <th>dni</th>
                                        <th>Canal</th>
                                        <th>total</th>
                                        <th>Estado</th>
                                        <th width="150px">Acciones</th>


                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>


                            </table>

                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>

            </div>

        </div>

</section>





<div class="modal fade" id="detalleCompra">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalle de Compra</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <!-- Pestañas -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#detallesPanel">Detalles</a>
                    </li>
                    <!-- Pestaña para Voucher -->
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#voucherPanel">Voucher</a>
                    </li>
                </ul>

                <!-- Contenido de las pestañas -->
                <div class="tab-content">
                    <!-- Panel de detalles -->
                    <div id="detallesPanel" class="tab-pane fade show active">
                        <!-- Contenido de los detalles de compra -->
                    </div>

                    <!-- Panel de Voucher -->
                    <div id="voucherPanel" class="tab-pane fade">
                        <!-- Contenido del panel de Voucher -->
                        <img id="voucherImage" src="" alt="Voucher">
                        <p id="voucherText"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="estado_compra">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Estado de la compra</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="formEstadoCompra" class="row">
                    <input type="hidden" name="compra_id" id="compra_id">
                    <div class="form-group col-md-6">
                        <label for="estado">Seleccione el nuevo estado:</label>
                        <select name="estado_compra_id" id="estado_compra_id" class="form-control my-select">
                            <option value="" selected disabled>Seleccionar</option>
                            <?php foreach ($estados as $estado) : ?>
                                <option value="<?= $estado['id_estado'] ?>"><?= $estado['nombre_estado'] ?></option>
                            <?php endforeach; ?>
                        </select>



                    </div>
                    <!-- Campo de entrada para el motivo -->
                    <div class="form-group col-md-6">
                        <label for="motivo">Motivo:</label>
                        <input type="text" name="motivo" id="motivo" class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
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

                </section>
            </div>
        </div>
    </div>
</div>




<!-- <script>
    $(function() {
        // Obtener la fecha actual
        var fechaActual = moment().format('YYYY-MM-DD');

        // Configurar el date range picker
        $('#daterange').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD', // Formato de fecha
                applyLabel: 'Aplicar', // Etiqueta para el botón de aplicar
                cancelLabel: 'Cancelar', // Etiqueta para el botón de cancelar
                fromLabel: 'Desde', // Etiqueta para el campo "desde"
                toLabel: 'Hasta', // Etiqueta para el campo "hasta"
                customRangeLabel: 'Personalizado', // Etiqueta para el rango personalizado
                weekLabel: 'S', // Etiqueta para la semana
                daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sá"], // Nombres de los días de la semana
                monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"], // Nombres de los meses
                firstDay: 1 // Primer día de la semana (0 para domingo, 1 para lunes, etc.)
            },
            startDate: fechaActual, // Fecha inicial (actual)
            endDate: fechaActual // Fecha final (actual)
        });

        // Capturar el evento de cambio en el date range picker
        $('#daterange').on('apply.daterangepicker', function(ev, picker) {
            console.log("Fecha seleccionada: " + picker.startDate.format('YYYY-MM-DD') + ' a ' + picker.endDate.format('YYYY-MM-DD'));
        });
    });
</script> -->

<script>
    let comprasTable;
    $(document).ready(function() {

        $('#daterange').daterangepicker({
            opens: 'left',
            locale: {
                format: 'YYYY-MM-DD',
                applyLabel: 'Aplicar',
                cancelLabel: 'Cancelar',
                daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                firstDay: 1
            }
        });


        comprasTable = $('#comprasTable').DataTable({
            "ajax": {
                "url": "<?php echo base_url('compras/lista_ajax'); ?>",
                "type": "GET"
            },
            "order": [
                [2, "desc"]
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "id_transaccion"
                },
                {
                    "data": "status"
                },
                {
                    "data": "fecha"
                },

                {
                    "data": "email"
                },

                {
                    "data": "dni"
                },
                {
                    "data": "canal_pago"
                },
                {
                    "data": "total"
                },
                {
                    "data": "nombre_estado"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        var btnDetalles = '<button type="button" class="btn btn-primary btnAbrirModal" data-compra-id="' + data.id + '"> <i class="fa fa-search"></i> </button>';

                        // Verificar si el estado es "Pendiente"
                        if (row.nombre_estado) {
                            // Si es "Pendiente", mostrar el botón de cambio de estado
                            var btnEstado = '<button type="button" class="btn btn-info btnEstado" data-compra-id="' + data.id + '" data-id_estado="' + row.id_estado + '"> <i class="fa fa-cog"></i>  </button>';

                            // Botón para ver el seguimiento
                            var btnSeguimiento = '<button type="button" class="btn btn-success btnSeguimiento" data-compra-id="' + data.id + '"><i class="fa fa-eye"></button>';

                            return btnDetalles + ' ' + btnEstado + ' ' + btnSeguimiento;
                        } else {
                            // Si no es "Pendiente", solo mostrar el botón de detalles
                            return btnDetalles;
                        }
                    }
                }


            ]
        });


        $('#btnAplicarFiltros').click(function() {
            // Obtener el rango de fechas seleccionado
            var startDate = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var endDate = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            // Obtener el estado seleccionado
            var estado = $('#estado').val();
            // Recargar los datos de la tabla con el nuevo rango de fechas y estado
            comprasTable.ajax.url("<?php echo base_url('compras/lista_ajax'); ?>?start_date=" + startDate + "&end_date=" + endDate + "&estado=" + estado).load();
        });





        /*   $(document).on('change', '#estado_compra_id', function() {
              var nuevoEstado = $(this).val();

              $('#estado_compra_id').val(nuevoEstado);
              console.log('estado seleccionado', nuevoEstado);


          }); */

        $(document).on('change', '#estado_compra_id', function() {
            var nuevoEstado = $(this).val();
            console.log('nuevo estado:', nuevoEstado);

            // Realizar una solicitud AJAX para obtener el motivo correspondiente al nuevo estado
            $.ajax({
                url: '<?php echo base_url('compras/obtenermotivoestado'); ?>',
                type: 'POST',
                data: {
                    estado_id: nuevoEstado
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.success && response.motivo) {
                        // Obtener el motivo y su nombre desde la respuesta
                        var idMotivo = response.motivo.id_motivo;
                        var nombreMotivo = response.motivo.nombre_motivo;

                        // Asignar el id_motivo y su nombre_motivo al campo de entrada motivo
                        $('#motivo').val(nombreMotivo);
                        $('#motivo').attr('data-id-motivo', idMotivo); // Opcional: si necesitas el ID del motivo en algún otro lugar

                    } else {
                        // Manejar el caso en que no se pueda obtener el motivo
                        console.error('Error al obtener el motivo del estado');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        });



        $('#formEstadoCompra').submit(function(event) {
            event.preventDefault(); // Evita que se envíe el formulario de forma convencional



            // Obtén el ID de la compra y el nuevo estado seleccionado
            var compraId = $('#compra_id').val();
            var nuevoEstado = $('#estado_compra_id').val();
            var idMotivo = $('#motivo').data('id-motivo');


            console.log('compra_id:', compraId);
            console.log('nuevo estado', nuevoEstado);

            console.log('motivoid', idMotivo);




            $.ajax({
                url: '<?php echo base_url('compras/actualizar_estado'); ?>',
                type: 'POST',
                data: {
                    compra_id: compraId,
                    estado: nuevoEstado,
                    id_motivo: idMotivo
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        // Cerrar el modal
                        $('#estado_compra').modal('hide');

                        // Mostrar una notificación de éxito con SweetAlert
                        Swal.fire({
                            title: 'Éxito',
                            text: 'El estado de la compra se ha actualizado correctamente.',
                            icon: 'success',
                            timer: 2000
                        }).then((result) => {
                            // Actualizar la tabla
                            comprasTable.ajax.reload();
                        });
                    } else {
                        // Manejar la respuesta si no hay éxito
                    }
                },
                error: function(xhr, status, error) {
                    // Maneja los errores de la solicitud AJAX aquí
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        });





        $(document).on('click', '.btnEstado', function() {
            var compraId = $(this).data('compra-id');

            console.log('ID de la compra:', compraId);

            var estadoId = $(this).data('id_estado'); // Corregido aquí
            console.log('ID del estado seleccionado:', estadoId);

            // Establecer el valor del campo oculto compra_id en el formulario
            $('#compra_id').val(compraId);

            // Mostrar el modal



            // Realizar una solicitud AJAX para recuperar el estado de la compra
            $.ajax({
                url: '<?php echo base_url('compras/obtener_estado'); ?>',
                type: 'POST',
                data: {
                    compra_id: compraId
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    // Verificar si la solicitud fue exitosa y si se recibió la compra

                    if (response.success && response.compra) {
                        // Obtener el estado de la compra
                        var compra = response.compra;
                        var historial = compra.historial;

                        // Obtener el último estado del historial
                        var ultimoEstado = historial[0];

                        // Obtener el motivo_id del último estado
                        var motivoId = ultimoEstado.motivo_id;

                        // Buscar el motivo correspondiente en la lista de motivos
                        var motivos = response.motivos;
                        var motivoNombre = '';
                        for (var i = 0; i < motivos.length; i++) {
                            if (motivos[i].id_motivo === motivoId) {
                                motivoNombre = motivos[i].nombre_motivo;
                                break;
                            }
                        }

                        // Mostrar el modal
                        $('#estado_compra').modal('show');

                        // Asignar el valor del motivo al campo de entrada
                        $('#motivo').val(motivoNombre);

                        // Asignar el valor del estado_compra al campo oculto
                        $('#estado_compra_id').val(compra.status_compra);
                    } else {
                        // Manejar la respuesta en caso de error o si no se recibió la compra
                        console.error('Error al obtener el estado de la compra');
                    }
                },


                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        });

        $(document).on('click', '.btnSeguimiento', function() {
            var compraId = $(this).data('compra-id');
            console.log('id de comora', compraId);
            var estadoId = $(this).data('id_estado'); // Corregido aquí
            console.log('ID del estado seleccionado:', estadoId);


            $.ajax({
                url: '<?php echo base_url('historialcompra/obtenerSeguimiento'); ?>',
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

        /* fas fa-exclamation-triangle bg-yellow */


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


     

              $(document).on('click', '.btnAbrirModal', function() {
            let compraId = $(this).data('compra-id');

            $.ajax({
                url: '<?php echo base_url('compras/detalle_compra/'); ?>' + compraId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let direccionCompleta = [
                        response.compra.direccion,
                        response.compra.departamento_nombre,
                        response.compra.provincia_nombre,
                        response.compra.distrito_nombre
                    ].filter(part => part.trim() !== '').join(', ');

                    if (!direccionCompleta) {
                        direccionCompleta = 'No disponible';
                    }

                    let compraHTML = `
                   <div class="container-fluid compra-detalle" style="padding: 16px;";>
                       <div class="row form-group">
                          <div class="col-md-6">
                            <p><strong>ID de Compra:</strong> ${response.compra.id}</p>
                          </div>
                        <div class="col-md-6">
                            <p><strong>Transacción:</strong> ${response.compra.id_transaccion}</p>
                        </div>
                       </div>
                       <div class="row form-group">
                         <div class="col-md-6">
                            <p><strong>Fecha:</strong> ${response.compra.fecha}</p>
                         </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> ${response.compra.status}</p>
                        </div>
                       </div>
                       <div class="row form-group">
                          <div class="col-md-6">
                            <p><strong>Email:</strong> ${response.compra.email}</p>
                          </div>
                        <div class="col-md-6">
                            <p><strong>Cliente:</strong> ${response.compra.nombre} ${response.compra.apellido}</p>
                        </div>
                       </div>
                       <div class="row form-group">
                          <div class="col-md-6">
                            <p><strong>Teléfono:</strong> ${response.compra.telefono}</p>
                          </div>
                        <div class="col-md-6">
                            <p><strong>Dirección:</strong> ${direccionCompleta}</p>
                        </div>
                       </div>
                       <div class="row form-group">
                          <div class="col-md-6">
                            <p><strong>Total:</strong> ${response.compra.total}</p>
                          </div>
                       </div>
                   </div>`;

                    // Generar los detalles de los productos
                    let detallesHTML = `
                    <table class="table table-bordered mt-3" id="detallesTable">
                       <thead style="background-color: #007bff; color: #fff;">
                          <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                          </tr>
                       </thead>
                     <tbody>`;
                    let totalCompra = 0;

                    $.each(response.detalles, function(index, detalle) {
                        let totalProducto = parseFloat(detalle.precio) * parseInt(detalle.cantidad);
                        totalCompra += totalProducto;

                        detallesHTML += `
                         <tr>
                            <td>${detalle.nombre}</td>
                            <td>${detalle.precio}</td>
                            <td>${detalle.cantidad}</td>
                            <td>${totalProducto.toFixed(2)}</td>
                         </tr>`;
                    });

                    // Sumar el costo de envío al total de la compra si existe
                    if (response.compra.costo_envio && parseFloat(response.compra.costo_envio) > 0) {
                        let costoEnvio = parseFloat(response.compra.costo_envio);
                        totalCompra += costoEnvio;

                        detallesHTML += `
                     <tr>
                       <td colspan="3" style="text-align: right;"><strong>Costo de Envío:</strong></td>
                       <td>${costoEnvio.toFixed(2)}</td>
                     </tr>`;
                    }

                    detallesHTML += `
                     <tr>
                       <td colspan="3" style="text-align: right;"><strong>Total de la  Compra:</strong></td>
                       <td>${totalCompra.toFixed(2)}</td>
                     </tr>
                     </tbody>
                  </table>`;


                    // Insertar los detalles de compra en el panel de detalles
                    $('#detallesPanel').html(compraHTML + detallesHTML);

                    // Obtener el nombre del voucher del response
                    let voucherNombre = response.compra.voucher_img;

                    // Construir la URL completa del voucher
                    let rutaVoucher = '<?php echo base_url("public/assets/tienda/vouchers/"); ?>' + voucherNombre;

                    if (voucherNombre) {
                        // Si hay un nombre de voucher, establecer la ruta de la imagen y aplicar estilos
                        $('#voucherImage').attr('src', rutaVoucher).css({
                            'width': '300px',
                            'display': 'block',
                            'margin': 'auto'
                        });
                        $('#voucherText').text('');
                    } else {
                        // Si no hay un nombre de voucher, mostrar un mensaje de "No hay voucher" centrado
                        $('#voucherImage').attr('src', '').css({
                            'display': 'none'
                        });
                        $('#voucherText').text('No hay voucher disponible.');
                    }

                    // Mostrar el modal
                    $('#detalleCompra').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });;





        function limpiarCampos() {
            $('#estado').val(''); // Limpiar el valor del select de estado
            $('#motivo').val(''); // Limpiar el valor del campo de texto de motivo
        }


    });
</script>







<?php include("admin_footer.php")  ?>