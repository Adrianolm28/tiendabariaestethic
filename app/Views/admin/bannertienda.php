<?php include("admin_header.php")  ?>



<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Banners Tienda</h3>

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
                                        <h4 class="modal-title">Agregar Nuevo Banner</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    




                                    <div id="messageContainer"></div>

                                    <form method="post" action="<?php echo site_url('admin/bannertienda/store'); ?>"
                                        id="addBannertienda" name="addBannertienda" enctype="multipart/form-data">
                                        <input type="hidden" id="id" name="id">

                                        <div class="card-body">

                                        <div class="container">
                                        <div class="form-group">
                                            <label for="categoria">Categoría</label>
                                            <select class="form-control" name="id_categorias" id="id_categorias">
                                                <option value="0">--Categorias--</option>
                                                <?php foreach ($categorias as $cat) : ?>
                                                            <option value="<?= $cat['id_categoria'] ?>"><?= $cat['nombre'] ?></option>
                                                        <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="texto">Producto</label>
                                            <select class="form-control" name="id_producto" id="id_producto">
                                                <option value="0">Productos</option>
                                                <?php foreach ($productos as $pro) : ?>
                                                            <option value="<?= $pro['id_producto'] ?>"><?= $pro['nombre'] ?></option>
                                                        <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="texto">Orden</label>
                                            <input type="number" class="form-control" name="orden" id="orden"
                                                placeholder="Ingrese el orden ">
                                        </div>
                                    </div>


                                            <div class="fileupload fileupload-new" data-provides="fileupload">

                                                <div class="fileupload-preview fileupload-exists thumbnail" id="lim"
                                                    style="max-width: 200px; max-height: 150px; line-height: 20px;">
                                                </div>
                                                <div>


                                                    <input type="hidden" name="imagen_actual" id="imagen_actual"
                                                        value="dddd">
                                                    <label class="btn btn-primary btn-file">
                                                        <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione
                                                        imagen
                                                        [+]
                                                        <input type="file" accept=".jpg, .jpeg, .png"
                                                            name="imagenbanner" id="imagenbanner"
                                                            style="display: none;">
                                                    </label>


                                                </div>
                                            </div>


                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" id="btnGuardar" class="btn btn-success btn-pill"><i
                                                    class="fa fa-save"></i> Guardar datos</button>
                                            <button type="button" class="btn btn-danger btn-pill"
                                                data-bs-dismiss="modal">Cerrar</button>
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
                        <table id="bannertiendaTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Imagen</th>
                                    <th>Orden</th>
                                    <th>Categoria</th>
                                    <th>Producto</th> 
                                    <th>Estado</th>
                                    <th width="280px">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($banners as $item) : ?>
                                <tr>
                                    <td><?= $item['id']; ?></td>
                                    <td><img src="<?= base_url('public/assets/image/img_tienda/bannerstienda/' . $item['imagenbanner']); ?>"
                                            style="width:300px; height:90px;"></td>

                                    <td><?= $item['orden']; ?></td>
                                    <td>
                                    <?php 
                                        // Busca el nombre de la categoría usando el id_categoria
                                        $categoriaModel = new \App\Models\CategoriaProductoModel();
                                        $categoria = $categoriaModel->find($item['id_categorias']);
                                                   echo is_array($categoria) && isset($categoria['nombre']) ? $categoria['nombre'] : 'N/A';
                                    ?>
                                    
                                    
                                    </td>
                                    <td>
                                        <?php 
                                            // Busca el nombre del producto usando el id_producto
                                            $productoModel = new \App\Models\ProductoModel();
                                            $producto = $productoModel->find($item['id_producto']);
                                                echo is_array($producto) && isset($producto['nombre']) ? $producto['nombre'] : 'N/A';
                                        ?>
                                    </td>


                                    <td>
                                        <?= $item['estado'] == 1 ?  '<span class="me-1 badge bg-success">Activo</span>' : '<span class="me-1 badge bg-danger">Inactivo</span>'; ?>
                                    </td>
                                    <td>
                                        <a data-id="<?php echo $item['id']; ?>"
                                            class="btn btn-primary btnEdit">Editar</a>
                                        <a data-id="<?= $item['id']; ?>" data-estado="<?= $item['estado']; ?>"
                                            class="btn btn-warning btnDelete"><?= $item['estado'] == 1 ? 'Desactivar' : 'Activar'; ?></a>
                                        <a data-id="<?= $item['id']; ?>"
                                            class="btn btn-danger btnEliminarRegistro">Eliminar</a>
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
                /* location.reload(); */
                if (res.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Guardado Exitosamente',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        // Cerrar el modal después del éxito

                        $("#myModal").modal('hide'); //ocultamos el modal
                        location.reload(); 
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
            url: '<?= site_url('admin/bannertienda/edit/') ?>' +
                id, // Ajusta la URL según tu estructura de rutas
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    // Llenar el formulario de edición con los datos recibidos
                    $('#myModal').modal('show');
                    $(' #id').val(res.data.id);
                    $('#id_categorias').val(res.data.id_categorias);
                    $('#id_producto').val(res.data.id_producto);
                    $('#orden').val(res.data.orden);

                    if (res.data.imagenbanner) {
                       
                        $('#lim').html(
                            '<img src="<?= base_url('public/assets/image/img_tienda/bannerstienda/'); ?>' +
                            res.data.imagenbanner +
                            '" style="max-width: 200px; max-height: 150px;">');
                           
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

    /* funcion actualizar estado  */
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
                url: '<?= site_url('admin/bannertienda/actualizar_estado/') ?>' + id +
                    '/' + newStatus,
                type: 'POST',
                dataType: 'json',
                success: function(res) {
                    location.reload();
                    console.log(res)
                    if (res.status) {



                        if (newStatus == 1) {
                            $(this).removeClass('btn-danger').addClass(
                                'btn-success').text('Activar');

                        } else {
                            $(this).removeClass('btn-success').addClass(
                                'btn-danger').text('Desactivar');
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
                url: '<?= site_url('admin/bannertienda/eliminar/') ?>' +
                    id, // Usa la URL correcta
                type: 'POST', // Usa POST para enviar los datos
                dataType: 'json',
                data: {
                    "_method": "DELETE"
                }, // Incluye el método DELETE en los datos
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
</script>


<?php include("admin_footer.php")  ?>