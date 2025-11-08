<?php include("admin_header.php")  ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Botón para generar/enviar link de opiniones -->
            <div class="col-12 mb-3">
                <button class="btn btn-success" id="btnGenerarLinkOpinion">
                    <i class="fas fa-link"></i> Enviar link para opiniones de clientes
                </button>
            </div>
            <!-- Tabla de reviews -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Administrar Reviews</h3>
                    </div>
                    <div class="card-body">
                        <table id="tablaReviews" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Comentario</th>
                                    <th>Rating</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los reviews con PHP o AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Editar Review -->
<div class="modal fade" id="modalEditarReview" tabindex="-1" aria-labelledby="modalEditarReviewLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="formEditarReview">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarReviewLabel">Editar Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="edit_id">
            <div class="form-group">
                <label for="edit_producto_id">Producto ID</label>
                <input type="text" class="form-control" id="edit_producto_id" name="producto_id" readonly>
            </div>
            <div class="form-group">
                <label for="edit_usuario_nombre">Usuario</label>
                <input type="text" class="form-control" id="edit_usuario_nombre" name="usuario_nombre" required>
            </div>
            <div class="form-group">
                <label for="edit_correo">Correo</label>
                <input type="email" class="form-control" id="edit_correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="edit_comentario">Comentario</label>
                <textarea class="form-control" id="edit_comentario" name="comentario" required></textarea>
            </div>
            <div class="form-group">
                <label for="edit_rating">Rating</label>
                <input type="number" class="form-control" id="edit_rating" name="rating" min="1" max="5" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal para mostrar links de opiniones por producto -->
<div class="modal fade" id="modalLinkOpinion" tabindex="-1" aria-labelledby="modalLinkOpinionLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLinkOpinionLabel">Enlaces para que clientes opinen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Busca el producto y copia el enlace para enviar a tu cliente:</label>
        <div class="table-responsive">
          <table class="table table-bordered table-sm" id="tablaProductosOpinion">
            <thead>
              <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Marca</th>
                <th>Enlace</th>
                <th>Copiar</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($productos as $prod): ?>
                <tr>
                  <td><?= $prod['id_producto'] ?></td>
                  <td><?= esc($prod['nombre']) ?></td>
                  <td><?= esc($prod['marca']) ?></td>
                  <td>
                    <input type="text" class="form-control form-control-sm enlace-opinion" readonly value="<?= base_url('review/agregarReview?producto_id=' . $prod['id_producto']) ?>">
                  </td>
                  <td>
                    <button class="btn btn-success btn-sm btnCopiarLinkOpinion"><i class="fa fa-copy"></i> Copiar</button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <small class="form-text text-muted mt-2">Puedes buscar y copiar el enlace de cualquier producto.</small>
      </div>
    </div>
  </div>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Cargar reviews por AJAX
    function cargarReviews() {
        $.get('<?= base_url('admin/review/listar') ?>', function(data) {
            let tbody = '';
            data.reviews.forEach(function(review) {
                tbody += `<tr>
                    <td>${review.id}</td>
                    <td>${review.producto_id}</td>
                    <td>${review.usuario_nombre}</td>
                    <td>${review.correo}</td>
                    <td>${review.comentario}</td>
                    <td>${review.rating}</td>
                    <td>${review.created_at ?? ''}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary btn-editar" data-id="${review.id}">Editar</button>
                        <button class="btn btn-sm btn-danger btn-eliminar" data-id="${review.id}">Eliminar</button>
                    </td>
                </tr>`;
            });
            $('#tablaReviews tbody').html(tbody);
        });
    }

    cargarReviews();

    // Eliminar review con SweetAlert
    $(document).on('click', '.btn-eliminar', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: '¿Seguro que desea eliminar este review?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('<?= base_url('admin/review/eliminar') ?>', { id: id }, function(resp) {
                    if (resp.success) {
                        cargarReviews();
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            text: 'El review ha sido eliminado correctamente.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo eliminar el review.'
                        });
                    }
                });
            }
        });
    });

    // Mostrar modal de edición y cargar datos
    $(document).on('click', '.btn-editar', function() {
        const id = $(this).data('id');
        $.get('<?= base_url('admin/review/editar/') ?>' + id, function(html) {
            // Si el backend retorna JSON, cambiar esto por .done y setear los campos
            // Aquí asumimos que retorna JSON con los datos del review
            let review;
            try {
                review = typeof html === 'string' ? JSON.parse(html) : html;
            } catch(e) {
                review = html.review || html;
            }
            $('#edit_id').val(review.id);
            $('#edit_producto_id').val(review.producto_id);
            $('#edit_usuario_nombre').val(review.usuario_nombre);
            $('#edit_correo').val(review.correo);
            $('#edit_comentario').val(review.comentario);
            $('#edit_rating').val(review.rating);
            $('#modalEditarReview').modal('show');
        });
    });

    // Guardar cambios de edición
    $('#formEditarReview').on('submit', function(e) {
        e.preventDefault();
        const datos = $(this).serialize();
        $.ajax({
            url: '<?= base_url('admin/review/editar_guardar') ?>',
            type: 'POST',
            data: datos,
            success: function(resp) {
                $('#modalEditarReview').modal('hide');
                cargarReviews();
                Swal.fire({
                    icon: resp.success ? 'success' : 'error',
                    title: resp.success ? 'Actualizado' : 'Error',
                    text: resp.message || (resp.success ? 'El review ha sido actualizado.' : 'No se pudo actualizar el review.'),
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    });

    // Inicializar DataTable si lo deseas
    $('#tablaReviews').DataTable();

    // Cerrar modal al presionar "Cancelar" (por si data-dismiss no funciona)
    $('#modalEditarReview .btn-secondary, #modalEditarReview .close').on('click', function() {
        $('#modalEditarReview').modal('hide');
    });

    // Mostrar modal con la tabla de productos y links
    $('#btnGenerarLinkOpinion').on('click', function() {
        $('#modalLinkOpinion').modal('show');
    });

    // Copiar link al portapapeles desde la tabla
    $(document).on('click', '.btnCopiarLinkOpinion', function() {
        var $input = $(this).closest('tr').find('.enlace-opinion');
        $input[0].select();
        $input[0].setSelectionRange(0, 99999);
        document.execCommand("copy");
        Swal.fire({
            icon: 'success',
            title: '¡Copiado!',
            text: 'El enlace ha sido copiado al portapapeles.',
            timer: 1200,
            showConfirmButton: false
        });
    });
});
</script>
<?php include("admin_footer.php") ?>
