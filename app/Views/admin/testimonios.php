<section class="content">
    <!--  <?php print_r($testimonios); ?>  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Banners</h3>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary " type="button" onclick="$('#myModal').modal('show');">
                                Registrar Nuevo +
                            </button>


                        </div>
                        <!-- Modal AGREGAR -->
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Agregar Nuevo Testimonio</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div id="messageContainer"></div>

                                    <form method="post" action="<?php echo site_url('admin/testimonios/store'); ?>" id="addTestimonios" name="addTestimonios" enctype="multipart/form-data">
                                        <input type="hidden" id="id" name="id">

                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Nombre</label>
                                                    <input type="txtNombre" class="form-control" name="txtNombre" id="txtNombre" placeholder="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Empresa</label>
                                                    <input type="txtEmpresa" class="form-control" name="txtEmpresa" id="txtEmpresa" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Comentario</label>
                                                <textarea class="form-control" name="txtComentario" id="txtComentario" placeholder="" rows="4" autocomplete="off">-</textarea>
                                            </div>

                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 64px; max-height: 64px; line-height: 20px;"></div>
                                                <div>
                                                    <input type="hidden" name="imagen_actual" id="imagen_actual" value="dddd">
                                                    <label class="btn btn-primary btn-file">
                                                        <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                                        <input type="file" accept=".jpg, .jpeg, .png" name="imagen_testimonio" id="imagen_testimonio" style="display: none;">
                                                    </label>
                                                </div>
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
                        <!-- Modal -->
                        <!-- Modal Editar -->

                        <!-- Modal editar -->


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="testimoniosTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Empresa</th>
                                    <th>Comentario</th>
                                    <th>estado</th>
                                    <th width="280px">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($testimonios as $item) : ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><img src="<?= base_url('public/assets/image/others/' . $item['imagen_testimonio']); ?>" style="width:40px; height:40px;"></td>
                                        <td><?= $item['nombre']; ?></td>
                                        <td><?= $item['empresa']; ?></td>
                                        <td><?= $item['comentario']; ?></td>

                                        <td>
                                            <?= $item['estado'] == 1 ? '<span class="me-1 badge bg-success">Activo</span>' : '<span class="me-1 badge bg-danger">Inactivo</span>'; ?>
                                        </td>

                                        <td>
                                            <a data-id="<?php echo $item['id']; ?>" class="btn btn-primary btnEdit">Edit</a>
                                            <a data-id="<?= $item['id']; ?>" data-estado="<?= $item['estado']; ?>" class="btn btn-<?= $item['estado'] == 1 ? 'danger' : 'success'; ?> btnDelete"><?= $item['estado'] == 1 ? 'Delete' : 'Activar'; ?></a>

                                        </td>

                                    </tr>
                                <?php endforeach; ?>
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
    var testimoniosTable;
    $(document).ready(function() {
        $('#testimoniosTable').DataTable();

        $('#addTestimonios').on('submit', function(event) {
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

                        });
                    } else {
                        // Si la respuesta del servidor indica un error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al Guardar',
                            text: 'Hubo un error al guardar los datos.',
                            confirmButtonColor: '#d33'
                        });
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

        /* aqui editar */
        $('body').on('click', '.btnEdit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?= site_url('admin/testimonios/edit/') ?>' + id, // Ajusta la URL según tu estructura de rutas
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        // Llenar el formulario de edición con los datos recibidos
                        $('#myModal').modal('show');
                        $(' #id').val(res.data.id);
                        $(' #txtNombre').val(res.data.nombre);
                        $(' #txtEmpresa').val(res.data.empresa);
                        $(' #txtComentario').val(res.data.comentario);
                        if (res.data.imagen_testimonio) {
                            $('#lim').html('<img src="<?= base_url('public/assets/image/others/'); ?>' + res.data.imagen_testimonio + '" style="max-width: 200px; max-height: 150px;">');
                        } else {
                            $('#lim').html('No hay imagen disponible');
                        }

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo cargar la información de edición.'
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

        /* funcion eliminar */



        $('body').on('click', '.btnDelete', function() {
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
                    url: '<?= site_url('admin/testimonios/actualizar_estado/') ?>' + id + '/' + newStatus,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        location.reload();
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





        // Validar dimensiones de la imagen

        // Selecciona el elemento con el ID 'imagen_testimonio' y espera al evento 'change'
        $('#imagen_testimonio').on('change', function() {
            // Obtiene el archivo seleccionado en el input de tipo archivo
            const file = this.files[0];
            // Crea un objeto de imagen para cargar la imagen seleccionada
            const img = new Image();
            img.src = window.URL.createObjectURL(file);
            // Cuando la imagen se haya cargado completamente
            img.onload = function() {
                // Comprueba si el ancho y el alto de la imagen no son 64x64 píxeles
                if (img.width !== 64 || img.height !== 64) {
                    // Si las dimensiones no son correctas, muestra una alerta de error utilizando SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'La imagen debe tener dimensiones de 64x64 píxeles.',
                        confirmButtonColor: '#d33'
                    });
                    $('#imagen_testimonio').val(""); // Limpiar el campo de archivo
                }
            };
        });

    });
</script>