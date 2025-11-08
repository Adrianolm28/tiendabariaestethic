<?php include("admin_header.php") ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ofertas Tienda</h3>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary" type="button" onclick="$('#myModal').modal('show');">
                                Registrar Nueva Oferta
                            </button>
                        </div>
                        <!-- Modal AGREGAR -->
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Agregar Nueva Oferta</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div id="messageContainer"></div>
                                    <form method="post" action="<?= site_url('admin/ofertas/store'); ?>" id="addBannertienda" name="addBannertienda" enctype="multipart/form-data">
                                        <input type="hidden" id="id" name="id">
                                        <div class="card-body">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 200px; max-height: 150px;"></div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="secs">Banner u Oferta</label>
                                                            <input type="number" class="form-control" id="secs" name="secs" placeholder="Banner u Oferta">
                                                        </div>
                                                        <div class="col">
                                                            <label for="title">Título</label>
                                                            <input type="text" class="form-control" id="title" name="title" placeholder="Título">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="description">Descripción</label>
                                                            <input type="text" class="form-control" id="description" name="description" placeholder="Descripción">
                                                        </div>
                                                        <div class="col">
                                                            <label for="discount">Descuento (%)</label>
                                                            <input type="number" class="form-control" id="discount" name="discount" placeholder="Descuento (%)">
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="imagen_actual" id="imagen_actual" value="dddd">
                                                    <label class="btn btn-primary btn-file">
                                                        <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen 
                                                        <input type="file" accept=".jpg, .jpeg, .png" name="image" id="image" style="display: none;">
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
                    </div>
                    <div class="card-body">
                        <table id="bannerOfertas" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Imagen</th>
                                    <th>Banner u Oferta</th>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Descuento (%)</th>
                                    <th>Fecha de Finalización</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ofertas as $oferta): ?>
                                    <tr>
                                        <td><?= $oferta['id'] ?></td>
                                        <td><img src="<?= base_url('public/assets/image/img_tienda/ofertasbanner/' . $oferta['image']); ?>" style="width:140px; height:40px;"></td>
                                        <td><?= $oferta['secs'] ?></td>
                                        <td><?= $oferta['title'] ?></td>
                                        <td><?= $oferta['description'] ?></td>
                                        <td><?= $oferta['discount'] ?></td>
                                        <td><?= $oferta['end_time'] ?></td>
                                        <td>
                                            <?= $oferta['estado'] == 1 ? '<span class="me-1 badge bg-success">Activo</span>' : '<span class="me-1 badge bg-danger">Inactivo</span>'; ?>
                                        </td>
                                        <td>
                                            <a data-id="<?= $oferta['id']; ?>" class="btn btn-primary btnEdit">Editar</a>
                                            <a data-id="<?= $oferta['id']; ?>" data-estado="<?= $oferta['estado']; ?>" class="btn btn-<?= $oferta['estado'] == 1 ? 'danger' : 'success'; ?> btnDelete"><?= $oferta['estado'] == 1 ? 'Eliminar' : 'Activar'; ?></a>
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
</section>

<script>
    $(document).ready(function() {
        $('#bannerOfertas').DataTable();

        $('#addBannertienda').on('submit', function(event) {
            event.preventDefault();
            var form_data = new FormData(this);
            $.ajax({
                data: form_data,
                url: $(this).attr('action'),
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
                            $("#myModal").modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al Guardar',
                            text: res.message || 'Hubo un error al guardar los datos.',
                            confirmButtonColor: '#d33'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Conexión',
                        text: 'Hubo un problema al conectar con el servidor.',
                        confirmButtonColor: '#d33'
                    });
                }
            });
        });

        $('body').on('click', '.btnEdit', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '<?= site_url('admin/ofertas/edit/') ?>' + id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        $('#myModal').modal('show');
                        $('#id').val(res.data.id);
                        $('#title').val(res.data.title);
                        $('#description').val(res.data.description);
                        $('#discount').val(res.data.discount);
                        $('#secs').val(res.data.secs);
                        $('#imagen_actual').val(res.data.imagenbanner);
                        $('#lim').html(res.data.imagenbanner ? `<img src="<?= base_url('public/assets/image/img_tienda/ofertasbanner/'); ?>${res.data.imagenbanner}" style="max-width: 200px; max-height: 150px;">` : 'No hay imagen disponible');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo cargar la información de edición.'
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
        });

        $('body').on('click', '.btnDelete', function() {
            var id = $(this).data('id');
            var currentState = $(this).data('estado');
            var newStatus = currentState === 1 ? 0 : 1;
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
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= site_url('admin/ofertas/actualizar_estado/') ?>' + id + '/' + newStatus,
                        type: 'GET',
                        dataType: 'json',
                        data: { estado: newStatus },
                        success: function(res) {
                            if (res.status) {
                                Swal.fire('Actualizado', 'El estado ha sido cambiado con éxito.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un error al cambiar el estado.'
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error de Conexión',
                                text: 'No se pudo conectar con el servidor.'
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<?php include("admin_footer.php") ?>
