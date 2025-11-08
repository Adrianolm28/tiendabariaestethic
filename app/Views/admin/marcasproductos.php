<?php include("admin_header.php")  ?>



<section class="content">
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/multi_imagen.css') ?>">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Marcas</h3>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" id="btnAbrirModal">Crear Nueva Marca</button>
                        </div>


                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Agregar Nueva Categoria</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div id="messageContainer"></div>

                                    <form method="post" action="<?php echo site_url('admin/marcasproductos/store'); ?>" id="addMarcaspro" name="addMarcaspro" enctype="multipart/form-data">
                                        <input type="text" id="id_marca" name="id_marca">

                                        <div class="card-body">
                                            <div class="form-row">

                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Nombre</label>
                                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="">
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Descripcion</label>
                                                <textarea class="form-control" name="descripcion" id="descripcion" placeholder="" rows="4" autocomplete="off">-</textarea>
                                            </div>



                                        </div>


                                        <div class="modal-footer">
                                            <button type="submit" id="btnGuardar" class="btn btn-success btn-pill"><i class="fa fa-save"></i> Guardar datos</button>
                                            <button type="button" class="btn btn-danger btn-pill" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="marcasproductosTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>

                                    <th>nombre</th>
                                    <th>descripcion</th>

                                    <th>estado</th>
                                    <th width="280px">Acciones</th>
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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<script>
    let marcasproductosTable;
    $(document).ready(function() {


        $('#marcasproductosTable').DataTable({

            "ajax": {
                "url": "<?php echo base_url('marcasproductos/getMarcas'); ?>",
                "type": "POST"
            },
            "columns": [{
                    "data": "id_marca"
                },


                {
                    "data": "nombre"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": "estado",
                    "render": function(data, type, row) {
                        var estadoHtml = '';
                        if (data == 1) {
                            estadoHtml = '<span class="me-1 badge bg-success">Activo</span>';
                        } else {
                            estadoHtml = '<span class="me-1 badge bg-danger">Inactivo</span>';
                        }
                        return estadoHtml;
                    }
                },

                {
                    "data": null,
                    "render": function(data, type, row) {
                        var estado = row.estado;
                        var btnText = (estado == 1) ? 'Desactivar' : 'Activar';
                        var btnClass = (estado == 1) ? 'btn-danger' : 'btn-success';

                        return `
            <button class="btn btn-primary btn-editar" data-id="${row.id_marca}">Editar</button>
            <button class="btn ${btnClass} btn-desactivar" data-id="${row.id_marca}" data-estado="${estado}">${btnText}</button>
        `;
                    }
                }

            ]
        });

        $('#btnAbrirModal').click(function() {


            limpiarModal();
            $('#myModal').modal('show');


        });




        // Capturar clic en el botón de editar
        $(document).on('click', '.btn-editar', function() {
            console.log('Botón Editar clickeado');
            var idMarca = $(this).data('id');
            console.log(idMarca);

            $.ajax({
                url: '<?php echo base_url('admin/marcasproductos/edit/'); ?>' + idMarca,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);

                    $('#id_marca').val(response.data.id_categoria);
                    $('#nombre').val(response.data.nombre);
                    $('#descripcion').val(response.data.descripcion);

                    $('#myModal').modal('show');




                },
            });
        });

        // Evento de clic para el botón de eliminar imagen
        $(document).on('click', '.btn-desactivar', function() {
            // Obtener el ID de la imagen a eliminar
            var idMarca = $(this).data('id');


        });












        // Capturar clic en el botón de desactivar
        $(document).on('click', '.btn-desactivar', function() {
            var idProducto = $(this).data('id');



        });


        $('#addMarcaspro').on('submit', function(event) {
            event.preventDefault(); // Prevenir el envío del formulario

            var form_data = new FormData(this);
            var form_action = $(this).attr('action');

            $.ajax({
                data: form_data, // Los datos del formulario
                url: form_action, // La URL a la que se enviarán los datos
                type: 'POST', // El método HTTP utilizado para la solicitud
                dataType: 'json', // Tipo de datos que se espera recibir del servidor
                processData: false, // No procesar los datos, ya que FormData se encargará de ello
                contentType: false, // No configurar el tipo de contenido, ya que FormData se encargará de ello
                success: function(res) {
                    // La función que se ejecuta cuando la petición AJAX es exitosa
                    if (res.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado Exitosamente',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            // Cerrar el modal después del éxito
                            $("#myModal").modal('hide'); //ocultamos el modal
                            // Actualizar o recargar la tabla de portadas aquí si es necesario
                            $('#marcasproductosTable').DataTable().ajax.reload();
                        });
                    } else {
                        // Si la respuesta del servidor indica un error
                        if (res.error) {
                            // Si hay un mensaje de error específico, mostrarlo con Sweet Alert
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al Guardar',
                                text: 'Error al guardar: ' + res.error,
                                confirmButtonColor: '#d33'
                            });
                        } else {
                            // Si no hay un mensaje de error específico, mostrar un mensaje genérico
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al Guardar',
                                text: 'Hubo un error al guardar los datos.',
                                confirmButtonColor: '#d33'
                            });
                        }
                    }
                },
                error: function(data) {
                    // La función que se ejecuta cuando la petición AJAX falla
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Conexión',
                        text: 'Hubo un problema al conectar con el servidor.',
                        confirmButtonColor: '#d33'
                    });
                }
            });
        });


        function limpiarModal() {
            var idMarca = $('#id_marca').val();
            console.log('ID del producto:');
            $('#id_producto').val('');
            $('#nombre').val('');
            $('#descripcion').val('');

        }


        $('body').on('click', '.btn-desactivar', function() {
            var id = $(this).data('id');
            var currentState = $(this).data('estado');
            var newStatus = (currentState == 1) ? 0 : 1;

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cambiar estado',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                $.ajax({
                    url: '<?= site_url('admin/marcasproductos/actualizar_estado/') ?>' + id + '/' + newStatus,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {

                        if (res.status) {

                            /* location.reload(); */

                            // Actualizar el botón y la vista según el nuevo estado
                            if (newStatus == 1) {
                                $(this).removeClass('btn-danger').addClass('btn-success').text('Activar');

                            } else {
                                $(this).removeClass('btn-success').addClass('btn-danger').text('Desactivar');
                            }

                            // Recargar la tabla DataTables después de cambiar el estado con éxito


                            Swal.fire({
                                icon: 'success',
                                title: 'Estado cambiado',
                                text: 'El estado del registro ha sido cambiado correctamente.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            $('#marcasproductosTable').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo cambiar el estado del registro.'
                            });
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Conexión',
                            text: 'Hubo un problema al conectar con el servidor.'
                        });
                    }
                });
            });
        });

    });
</script>
<script src="<?= base_url('public/assets/tienda/js/multi_imagen.js') ?>"></script>



<?php include("admin_footer.php")  ?>