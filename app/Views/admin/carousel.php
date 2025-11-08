<section class="content">
    <!-- <?php print_r($carousel); ?> -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Carousel Sistema</h3>

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
                                        <h4 class="modal-title">Agregar Nueva Imagen</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div id="messageContainer"></div>

                                    <form method="post" action="<?php echo site_url('admin/carousel/store'); ?>" id="addCarousel" name="addCarousel" enctype="multipart/form-data">
                                        <input type="hidden" id="id" name="id">

                                        <div class="card-body">

                                            <div class="fileupload fileupload-new" data-provides="fileupload">

                                                <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div>


                                                    <input type="hidden" name="imagen_actual" id="imagen_actual" value="dddd">
                                                    <label class="btn btn-primary btn-file">
                                                        <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                                        <input type="file" accept=".jpg, .jpeg, .png" name="imagen_carousel" id="imagen_carousel" style="display: none;">
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
                        <table id="carouselTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Imagen</th>
                                    <th>estado</th>
                                    <th width="280px">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($carousel as $item) : ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><img src="<?= base_url('public/assets/image/others/banner/' . $item['imagen_carousel']); ?>" style="width:80px; height:40px;object-fit: contain;"></td>
                                        <td>
                                            <?= $item['estado'] == 1 ?  '<span class="me-1 badge bg-success">Activo</span>' : '<span class="me-1 badge bg-danger">Inactivo</span>'; ?>
                                        </td>
                                        <td>
                                            <a data-id="<?php echo $item['id']; ?>" class="btn btn-primary btn-sm btnEdit">Editar</a>
                                            <a data-id="<?= $item['id']; ?>" data-estado="<?= $item['estado']; ?>" class="btn btn-sm btn-<?= $item['estado'] == 1 ? 'warning' : 'success'; ?> btnToggleStatus">
                                                <?= $item['estado'] == 1 ? 'Desactivar' : 'Activar'; ?>
                                            </a>
                                            <a data-id="<?= $item['id']; ?>" class="btn btn-danger btn-sm btnPermanentDelete">Eliminar</a>
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
    $(document).ready(function() {
        $('#carouselTable').DataTable();

        $('#addCarousel').on('submit', function(event) {
            event.preventDefault(); // Prevenir el envío del formulario
            var $form = $(this);
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
                            $("#myModal").modal('hide'); 
                            // Limpiar el formulario
                            $form[0].reset();
                            $('#lim').html(''); // Limpiar la previsualización de la imagen
                            location.reload(); // Recargar la página para ver los cambios
                        });
                    } else {
                        // Si la respuesta del servidor indica un error
                        let errorMsg = 'Hubo un error al guardar los datos.';
                        if (res.error) {
                            errorMsg += '<br>' + Object.values(res.error).join('<br>');
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al Guardar',
                            html: errorMsg,
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
            // Limpiar formulario antes de cargar nuevos datos
            $('#addCarousel')[0].reset();
            $('#id').val(''); // Asegurarse que el ID esté vacío para nuevos registros o se llene para editar
            $('#lim').html(''); // Limpiar previsualización

            $.ajax({
                url: '<?= site_url('admin/carousel/edit/') ?>' + id, // Ajusta la URL según tu estructura de rutas
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        // Llenar el formulario de edición con los datos recibidos
                        $('#myModal .modal-title').text('Editar Imagen'); // Cambiar título del modal
                        $('#myModal').modal('show');
                        $('#id').val(res.data.id); // Establecer el ID para la actualización
                        if (res.data.imagen_carousel) {
                            $('#lim').html('<img src="<?= base_url('public/assets/image/others/banner/'); ?>' + res.data.imagen_carousel + '" style="max-width: 200px; max-height: 150px;">');
                            $('#imagen_actual').val(res.data.imagen_carousel);
                        } else {
                            $('#lim').html('No hay imagen disponible');
                            $('#imagen_actual').val('');
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

        // Cambiar nombre de clase y lógica para btnToggleStatus
        $('body').on('click', '.btnToggleStatus', function() {
            var id = $(this).data('id');
            var currentState = $(this).data('estado');
            var newStatus = (currentState == 1) ? 0 : 1;
            var button = $(this); // Guardar referencia al botón

            Swal.fire({
                title: '¿Estás seguro?',
                text: `¿Quieres ${newStatus == 1 ? 'activar' : 'desactivar'} este elemento?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: `Sí, ${newStatus == 1 ? 'activar' : 'desactivar'}!`,
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) { // Asegurarse que el usuario confirmó
                    $.ajax({
                        url: '<?= site_url('admin/carousel/actualizar_estado/') ?>' + id + '/' + newStatus,
                        type: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            if (res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Estado cambiado',
                                    text: 'El estado del registro ha sido cambiado correctamente.',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // Recargar la página para ver los cambios
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: res.message || 'No se pudo cambiar el estado del registro.'
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
                }
            });
        });

        // Nueva lógica para el botón de eliminar permanente
        $('body').on('click', '.btnPermanentDelete', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: '¿Estás realmente seguro?',
                text: "¡Esta acción eliminará el elemento permanentemente y no se puede deshacer!",
                icon: 'error', // Usar ícono de error para mayor advertencia
                showCancelButton: true,
                confirmButtonColor: '#d33', // Botón de confirmación rojo
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, ¡eliminar permanentemente!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('admin/carousel/delete/') ?>' + id, // Nueva ruta
                        type: 'POST', // o 'DELETE' si configuras tu servidor para ello
                        dataType: 'json',
                        success: function(res) {
                            if (res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Eliminado',
                                    text: res.message || 'El elemento ha sido eliminado correctamente.',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // Recargar la página
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error al eliminar',
                                    text: res.message || 'No se pudo eliminar el elemento.'
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
                }
            });
        });

        // Al abrir el modal para "Registrar Nuevo", asegurar que el título sea correcto y el form esté limpio
        $('button[onclick="$(\'#myModal\').modal(\'show\');"]').on('click', function() {
            $('#myModal .modal-title').text('Agregar Nueva Imagen');
            $('#addCarousel')[0].reset();
            $('#id').val(''); // Limpiar ID
            $('#lim').html(''); // Limpiar previsualización de imagen
            $('#imagen_actual').val('');
        });


    });
</script>