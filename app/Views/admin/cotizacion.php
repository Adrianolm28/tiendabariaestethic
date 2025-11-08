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

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button id="btnAplicarFiltros" class="btn btn-primary">Aplicar Filtros</button>
                            </div>
                        </div>


                        <div class="card-body">
                            <table id="cotizacionTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Id Transacción</th>
                                        <th>fecha</th>
                                        <!-- <th>status</th> -->
                                        <th>email</th>

                                        <th>dni</th>
                                        <th>nombre</th>
                                        <th>total</th>
                                        <th>Acciones</th>



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




<script>
    let cotizacionTable;
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


        cotizacionTable = $('#cotizacionTable').DataTable({
            "ajax": {
                "url": "<?php echo base_url('cotizacion/listarCotizaciones'); ?>",
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
                    "data": "fecha"
                },

                {
                    "data": "email"
                },

                {
                    "data": "dni"
                },
                {
                    "data": "nombre"
                },
                {
                    "data": "total"
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        var btnDetalles = '<button type="button" class="btn btn-primary btnAbrirModal" data-cotizacion-id="' + data.id + '"> <i class="fa fa-search"></i> </button>';

                        var btnEnviar = '<button type="button" class="btn btn-info btnEnviar" data-compra-id="' + data.id + '"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>  </button>';

                        return btnDetalles + ' ' + btnEnviar;
                    }
                }



            ]
        });

        $(document).on('click', '.btnEnviar', function() {
            var cotizacionId = $(this).data('compra-id');

            console.log(cotizacionId);

            // Realizar una petición AJAX POST para enviar la cotización a la API
            $.ajax({
                url: '<?php echo base_url('checkout/enviarCotizacionAPI'); ?>',
                type: 'POST',
                data: {
                    cotizacion_id: cotizacionId
                },
                dataType: 'json',
                success: function(response) {

                    if (response.success) {
                        // Si la cotización se envió correctamente, mostrar un mensaje de éxito con SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000 // Cerrar automáticamente después de 2 segundos
                        });

                    } else {
                        // Si hubo un error al enviar la cotización, mostrar un mensaje de error con SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al enviar la cotización: ' + response.message
                        });
                    }

                },
                error: function(xhr, status, error) {
                    alert('Error al enviar la cotización: ' + error);
                }
            });
        });



        $('#btnAplicarFiltros').click(function() {

            console.log('filtrando')
            // Obtener el rango de fechas seleccionado
            var startDate = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            var endDate = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            // Obtener el estado seleccionado

            // Recargar los datos de la tabla con el nuevo rango de fechas y estado
            cotizacionTable.ajax.url("<?php echo base_url('cotizacion/listarCotizaciones'); ?>?start_date=" + startDate + "&end_date=" + endDate + "&estado=").load();
        });










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
            let cotizacionId = $(this).data('cotizacion-id');
            console.log(cotizacionId);
            $.ajax({
                url: '<?php echo base_url('cotizacion/detalle_cotizacion/'); ?>' + cotizacionId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    let compraHTML = `
                   <div class="container-fluid compra-detalle" style="padding: 16px;";>
                       <div class="row form-group">
                          <div class="col-md-6">
                            <p><strong>ID de Compra:</strong> ${response.cotizacion.id}</p>
                          </div>
                        <div class="col-md-6">
                            <p><strong>Transacción:</strong> ${response.cotizacion.id_transaccion}</p>
                        </div>
                       </div>
                       <div class="row form-group">
                         <div class="col-md-6">
                            <p><strong>Fecha:</strong> ${response.cotizacion.fecha}</p>
                         </div>
                       </div>
                       <div class="row form-group">
                          <div class="col-md-6">
                            <p><strong>Email:</strong> ${response.cotizacion.email}</p>
                          </div>
                        <div class="col-md-6">
                            <p><strong>Cliente:</strong> ${response.cotizacion.nombre} ${response.cotizacion.apellido}</p>
                        </div>
                       </div>
                       <div class="row form-group">
                          <div class="col-md-6">
                            <p><strong>Teléfono:</strong> ${response.cotizacion.telefono}</p>
                          </div>
                        <div class="col-md-6">
                            <p><strong>Dirección:</strong> ${response.cotizacion.direccion}, ${response.cotizacion.departamento}, ${response.cotizacion.provincia}, ${response.cotizacion.distrito}</p>
                        </div>
                       </div>
                       <div class="row form-group">
                          <div class="col-md-6">
                            <p><strong>Total:</strong> ${response.cotizacion.total}</p>
                          </div>
                       </div>
                   </div>`;

                    let detallesHTML = '<table class="table table-bordered" id="detallesTable">';
                    detallesHTML += '<thead style="background-color: #007bff; color: #fff;"><tr><th>Nombre</th><th>Precio</th><th>Cantidad</th><th>Total</th></tr></thead><tbody>';

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

                   

                    detallesHTML += `
                     <tr>
                       <td colspan="3" style="text-align: right;"><strong>Total de la  Compra:</strong></td>
                       <td>${totalCompra.toFixed(2)}</td>
                     </tr>
                     </tbody>
                  </table>`;

                    // Insertar los detalles de compra en el panel de detalles
                    $('#detallesPanel').html(compraHTML + detallesHTML);







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