<?php include("admin_header.php")  ?>

<section class="content">
   
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Banners Tienda</h3>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button id="btnAgregarBanner" class="btn btn-primary" type="button">
                                Registrar Nuevo +
                            </button>
                        </div>
                        <!-- Modal AGREGAR -->
                        <div class="modal fade" id="myModalAgregar">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Agregar Nuevo Banner</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div id="messageContainerAgregar"></div>
                                    <form method="post" action="<?php echo site_url('admin/bannertiendaresponsive/store'); ?>" id="addBannertienda" name="addBannertienda" enctype="multipart/form-data">
                                        <input type="hidden" id="id" name="id">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="id_categorias">Categoría:</label>
                                                    <select class="form-control" name="id_categorias" id="id_categorias">
                                                        <option value="">--Categorias--</option>
                                                        <?php foreach ($categorias as $cat) : ?>
                                                            <option value="<?= $cat['id_categoria'] ?>"><?= $cat['nombre'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="id_subcategoria">Sub Categoría:</label>
                                                    <select class="form-control" name="id_subcategoria" id="id_subcategoria">
                                                        <option value="">--Sub categorias--</option>
                                                        <!-- Opciones llenadas por JS -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="fecha_inicio">Fecha Inicio:</label>
                                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="fecha_fin">Fecha Fin:</label>
                                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                                                </div>
                                            </div>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div>
                                                    <input type="hidden" name="imagen_actual" id="imagen_actual" value="dddd">
                                                    <label class="btn btn-primary btn-file">
                                                        <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                                        <input type="file" accept=".jpg, .jpeg, .png" name="imagenbanner" id="imagenbanner" style="display: none;">
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
                        <div class="modal fade" id="myModalEditar">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Editar Banner</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div id="messageContainerEditar"></div>
                                    <form method="post" action="<?php echo site_url('admin/bannertiendaresponsive/store'); ?>" id="editBannertienda" name="editBannertienda" enctype="multipart/form-data">
                                        <input type="hidden" id="edit_id" name="id">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="edit_id_categorias">Categoría:</label>
                                                    <select class="form-control" name="id_categorias" id="edit_id_categorias">
                                                        <option value="">--Categorias--</option>
                                                        <?php foreach ($categorias as $cat) : ?>
                                                            <option value="<?= $cat['id_categoria'] ?>"><?= $cat['nombre'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="edit_id_subcategoria">Sub Categoría:</label>
                                                    <select class="form-control" name="id_subcategoria" id="edit_id_subcategoria">
                                                        <option value="">--Sub categorias--</option>
                                                        <!-- Opciones llenadas por JS -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="edit_fecha_inicio">Fecha Inicio:</label>
                                                    <input type="date" class="form-control" id="edit_fecha_inicio" name="fecha_inicio">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="edit_fecha_fin">Fecha Fin:</label>
                                                    <input type="date" class="form-control" id="edit_fecha_fin" name="fecha_fin">
                                                </div>
                                            </div>
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-preview fileupload-exists thumbnail" id="edit_lim" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div>
                                                    <input type="hidden" name="imagen_actual" id="edit_imagen_actual" value="">
                                                    <label class="btn btn-primary btn-file">
                                                        <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                                        <input type="file" accept=".jpg, .jpeg, .png" name="imagenbanner" id="edit_imagenbanner" style="display: none;">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnEditarGuardar" class="btn btn-success btn-pill"><i class="fa fa-save"></i> Guardar cambios</button>
                                            <button type="button" class="btn btn-danger btn-pill" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal editar -->


                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="bannertiendaTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Imagen</th>
                                    <th>Id_categoria</th>
                                    <th>estado</th>
                                    <th width="340px">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($banners as $item) : ?>
                                    <tr>
                                        <td><?= $item['id']; ?></td>
                                        <td><img src="<?= base_url('public/assets/image/img_tienda/bannerresponsive/' . $item['imagenbanner']); ?>" style="width:150px; height:90px;"></td>
                                       
                                        <td>
                                            <?= $item['id_categorias'] ?>
                                        </td>
                                        

                                       
                                        <td>
                                            <?= $item['estado'] == 1 ?  '<span class="me-1 badge bg-success">Activo</span>' : '<span class="me-1 badge bg-danger">Inactivo</span>'; ?>
                                        </td>
                                        <td>
                                            <a data-id="<?php echo $item['id']; ?>" class="btn btn-primary btnEdit">Editar</a>
                                            <a data-id="<?= $item['id']; ?>" data-estado="<?= $item['estado']; ?>" class="btn btn-warning btnDelete"><?= $item['estado'] == 1 ? 'Desactivar' : 'Activar'; ?></a>
                                            <a data-id="<?= $item['id']; ?>" class="btn btn-danger btnEliminarRegistro">Eliminar</a>
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
        $('#bannertiendaTable').DataTable();

        // Abrir modal agregar SOLO con el botón de agregar
        $('#btnAgregarBanner').on('click', function() {
            $('#myModalAgregar').modal('show');
            $('#addBannertienda')[0].reset();
            $('#lim').html('');
        });

        // Guardar nuevo banner
        $('#addBannertienda').on('submit', function(event) {
            event.preventDefault();
            var form_data = new FormData(this);
            var form_action = $(this).attr('action');
            $.ajax({
                data: form_data, 
                url: form_action, 
                type: 'POST', 
                dataType: 'json',
                processData: false, 
                contentType: false, 
                success: function(res) {
                    if (res.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado Exitosamente',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            $("#myModalAgregar").modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al Guardar',
                            text: 'Hubo un error al guardar los datos.',
                            confirmButtonColor: '#d33'
                        });
                    }
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Conexión',
                        text: 'Hubo un problema al conectar con el servidor.',
                        confirmButtonColor: '#d33'
                    });
                }
            });
        });

        // Abrir modal editar y cargar datos
        $('body').on('click', '.btnEdit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?= site_url('admin/bannertiendaresponsive/edit/') ?>' + id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        $('#myModalEditar').modal('show');
                        $('#edit_id').val(res.data.id);
                        $('#edit_id_categorias').val(res.data.id_categorias).trigger('change');
                        setTimeout(function() {
                            $('#edit_id_subcategoria').val(res.data.id_subcategoria);
                        }, 300);
                        $('#edit_fecha_inicio').val(res.data.fecha_inicio);
                        $('#edit_fecha_fin').val(res.data.fecha_fin);
                        $('#edit_imagen_actual').val(res.data.imagenbanner);
                        if (res.data.imagenbanner) {
                            $('#edit_lim').html('<img src="<?= base_url('public/assets/image/img_tienda/bannerresponsive/'); ?>' + res.data.imagenbanner + '" style="max-width: 200px; max-height: 150px;">');
                        } else {
                            $('#edit_lim').html('No hay imagen disponible');
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

        // Guardar edición
        $('#editBannertienda').on('submit', function(event) {
            event.preventDefault();
            var form_data = new FormData(this);
            var form_action = $(this).attr('action');
            $.ajax({
                data: form_data, 
                url: form_action, 
                type: 'POST', 
                dataType: 'json',
                processData: false, 
                contentType: false, 
                success: function(res) {
                    if (res.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Actualizado Exitosamente',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            $("#myModalEditar").modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al Actualizar',
                            text: 'Hubo un error al actualizar los datos.',
                            confirmButtonColor: '#d33'
                        });
                    }
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Conexión',
                        text: 'Hubo un problema al conectar con el servidor.',
                        confirmButtonColor: '#d33'
                    });
                }
            });
        });

        /* funcion cambiar de estado */
        $('body').on('click', '.btnDelete', function() {
            var id = $(this).data('id');
            var currentState = $(this).data('estado');
            var newStatus = (currentState == 1) ? 0 : 1;

            Swal.fire({
                title: '¿Estás seguro que deseas cambiar de estado?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cambiar estado',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                $.ajax({
                    url: '<?= site_url('admin/bannertiendaresponsive/actualizar_estado/') ?>' + id + '/' + newStatus,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                         location.reload(); 
                        console.log(res)
                          if (res.status) {

                            if (newStatus == 1) {
                                $(this).removeClass('btn-danger').addClass('btn-success').text('Activar');

                            } else {
                                $(this).removeClass('btn-success').addClass('btn-danger').text('Desactivar');
                            }

                          


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

        /* funcion eleminar */
        $('body').on('click', '.btnEliminarRegistro', function() {
            var id = $(this).data('id'); // Obtener el ID del registro a eliminar

            Swal.fire({
                title: '¿Estás seguro que deseas eleminar ?',
                text: 'Esta acción eliminará todo el registro y no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar registro',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('admin/bannertiendaresponsive/eliminar/') ?>' + id, // Usa la URL correcta
                        type: 'POST', // Usa POST para enviar los datos
                        dataType: 'json',
                        data: { "_method": "DELETE" }, // Incluye el método DELETE en los datos
                        success: function(res) {
                            if (res.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registro Eliminado',
                                    text: 'El registro ha sido eliminado correctamente.',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                location.reload(); // Recargar la página para reflejar los cambios
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'No se pudo eliminar el registro.'
                                });
                            }
                        },
                        error: function() {
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

        // Cargar subcategorías al cambiar categoría (agregar)
        $('#id_categorias').change(function() {
            var categoriaId = $(this).val();
            $.ajax({
                url: '<?php echo base_url('productos/obtenerSubcategorias'); ?>',
                type: 'post',
                dataType: 'json',
                data: { categoria_id: categoriaId },
                success: function(response) {
                    $('#id_subcategoria').empty().append('<option value="">--Sub categorias--</option>');
                    if (response.status) {
                        $.each(response.data, function(key, value) {
                            $('#id_subcategoria').append('<option value="' + value.id_subcategoria + '">' + value.nombre + '</option>');
                        });
                    }
                }
            });
        });
        // Cargar subcategorías al cambiar categoría (editar)
        $('#edit_id_categorias').change(function() {
            var categoriaId = $(this).val();
            $.ajax({
                url: '<?php echo base_url('productos/obtenerSubcategorias'); ?>',
                type: 'post',
                dataType: 'json',
                data: { categoria_id: categoriaId },
                success: function(response) {
                    $('#edit_id_subcategoria').empty().append('<option value="">--Sub categorias--</option>');
                    if (response.status) {
                        $.each(response.data, function(key, value) {
                            $('#edit_id_subcategoria').append('<option value="' + value.id_subcategoria + '">' + value.nombre + '</option>');
                        });
                    }
                }
            });
        });
    });
</script>


<?php include("admin_footer.php")  ?>