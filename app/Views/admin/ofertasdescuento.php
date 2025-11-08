<?php include("admin_header.php")  ?>



<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Orfertas Descuento</h3>

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
                                        <h4 class="modal-title">Ofertas Descuento</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div id="messageContainer"></div>

                                    <form method="post" action="<?php echo site_url('admin/ofertasdescuento/store'); ?>" id="addOfertasdescuento" name="addOfertasdescuento" enctype="multipart/form-data">
                                        <input type="hidden" id="id" name="id">

                                        <div class="card-body">

                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="categoria">Categoría:</label>
                                                    <select class="form-control" id="categoria_producto" name="categoria_producto">
                                                        <option value="">--Categorias--</option>
                                                        <?php foreach ($categorias as $cat) : ?>
                                                            <option value="<?= $cat['id_categoria'] ?>"><?= $cat['nombre'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="subcategoria_producto">Sub Categoría:</label>
                                                    <select class="form-control" id="subcategoria_producto" name="subcategoria_producto">
                                                        <option value="">--Sub categorias--</option>
                                                        <!-- Opciones de subcategorías se llenarán dinámicamente con JavaScript -->
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="fecha_inicio">Fecha Inicio:</label>
                                                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="fecha_fin">Fecha Fin:</label>
                                                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                                                </div>
                                            </div>

                                            <div class="fileupload fileupload-new" data-provides="fileupload">

                                                <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div>


                                                    <input type="hidden" name="imagen_actual" id="imagen_actual" value="dddd">
                                                    <label class="btn btn-primary btn-file">
                                                        <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                                        <input type="file" accept=".jpg, .jpeg, .png" name="imagen_oferta" id="imagen_oferta" style="display: none;">
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
                        <table id="ofertasdescuentoTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Imagen Oferta</th>

                                    <th>Categoria</th>
                                    <th>Subcategoria</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>estado</th>
                                    <th width="280px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ofertas_descuento as $od) : ?>
                                    <tr>
                                        <td><?= $od['id_oferta']; ?></td>
                                        <td><img src="<?= base_url('public/assets/img_tienda/img_ofertas/' . $od['imagen_oferta']); ?>" style="width:80px; height:60px;"></td>
                                        <td><?= $od['nombre_categoria']; ?></td>
                                        <td><?= $od['nombre_subcategoria']; ?></td>
                                        <td><?= $od['fecha_inicio']; ?></td>
                                        <td><?= $od['fecha_fin']; ?></td>
                                        <td>
                                            <?= $od['estado'] == 1 ?  '<span class="me-1 badge bg-success">Activo</span>' : '<span class="me-1 badge bg-danger">Inactivo</span>'; ?>
                                        </td>
                                        <td>
                                            <a data-id="<?php echo $od['id_oferta']; ?>" class="btn btn-primary btnEdit">Editar</a>
                                            <a data-id="<?= $od['id_oferta']; ?>" data-estado="<?= $od['estado']; ?>" class="btn btn-warning btnDelete"><?= $od['estado'] == 1 ? 'Desactivar' : 'Activar'; ?></a>
                                            <a data-id="<?= $od['id_oferta']; ?>" class="btn btn-danger btnEliminarRegistro">Eliminar</a>
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
    function selectSubcategoria(categoriaId, subcategoriaId) {
        // Realizar la solicitud AJAX para obtener subcategorías de una categoría específica
        $.ajax({
            url: '<?php echo base_url('productos/obtenerSubcategorias'); ?>',
            type: 'post',
            dataType: 'json',
            data: {
                categoria_id: categoriaId
            },
            success: function(response) {
                console.log(response);
                $('#subcategoria_producto').empty();
                $('#subcategoria_producto').append('<option value="">--Sub categorias--</option>');

                if (response.status) {
                    $.each(response.data, function(key, value) {
                        var selected = (value.id_subcategoria == subcategoriaId) ? 'selected' : '';
                        $('#subcategoria_producto').append('<option value="' + value.id_subcategoria + '" ' + selected + '>' + value.nombre + '</option>');
                    });
                } else {
                    console.log('Error al obtener las subcategorías');
                }
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error('Error en la solicitud AJAX:', status, error);
            }
        });
    }



    $(document).ready(function() {
        $('#bannertiendaTable').DataTable();





        $('#addOfertasdescuento').on('submit', function(event) {
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
                            // Cerrar el modal después del éxito

                            $("#myModal").modal('hide'); //ocultamos el modal
                            // Actualizar o recargar la tabla de portadas aquí si es necesario

                        });
                        location.reload();
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
            limpiarModal();
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?= site_url('admin/ofertasdescuento/edit/') ?>' + id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        // Llenar el formulario de edición con los datos recibidos
                        $('#myModal').modal('show');
                        $(' #id').val(res.data.id_oferta);


                        $('#categoria_producto').val(res.data.id_categoria);

                        $('#categoria_producto').trigger('change');

                        $('#subcategoria_producto').val(res.data.id_subcategoria);

                        $('#fecha_inicio').val(res.data.fecha_inicio);
                        $('#fecha_fin').val(res.data.fecha_fin);


                        if (res.data.imagen_oferta) {
                            $('#lim').html('<img src="<?= base_url('public/assets/img_tienda/img_ofertas/'); ?>' + res.data.imagen_oferta + '" style="max-width: 200px; max-height: 150px;">');
                        } else {
                            $('#lim').html('No hay imagen disponible');
                        }

                        selectSubcategoria(res.data.id_categoria, res.data.id_subcategoria);


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
                    url: '<?= site_url('admin/ofertasdescuento/actualizar_estado/') ?>' + id + '/' + newStatus,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {

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
                            location.reload();
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



        function limpiarModal() {
            $('#id').val('');
            $('#categoria_producto').val('');
            $('#subcategoria_producto').val('');
            $('#lim').html(''); // Limpiar la imagen previa
        }

       /*  funcion categorias productos */
        $('#categoria_producto').change(function() {
            var categoriaId = $(this).val();

            // Realizar la solicitud AJAX para obtener subcategorías
            $.ajax({
                url: '<?php echo base_url('productos/obtenerSubcategorias'); ?>',
                type: 'post',
                dataType: 'json',
                data: {
                    categoria_id: categoriaId
                },
                success: function(response) {
                    console.log(response);
                    $('#subcategoria_producto').empty();
                    $('#subcategoria_producto').append('<option value="">--Sub categorias--</option>');


                    if (response.status) {
                        $.each(response.data, function(key, value) {
                            $('#subcategoria_producto').append('<option value="' + value.id_subcategoria + '">' + value.nombre + '</option>');
                        });
                    } else {

                        console.log('Error al obtener las subcategorías');
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de la solicitud AJAX
                    console.error('Error en la solicitud AJAX:', status, error);
                }
            });
        });


        /* Función eliminar */
        $('body').on('click', '.btnEliminarRegistro', function () {
            var id = $(this).data('id'); // Obtener el ID del registro a eliminar

          
            $.ajax({
                url: '<?= site_url('admin/ofertasdescuento/eliminar') ?>', // URL sin el ID
                type: 'POST',
                data: { id: id }, // Enviar el ID como parte del cuerpo
                dataType: 'json',
                success: function (response) {
                    console.log('Respuesta del servidor:', response);

                    if(response.status){
                        swal.fire(
                        'Eliminado',
                        response.message,
                        'success'
                        ).then(()=>{
                            location.reload();
                        })
                    }

                   
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de Conexión',
                        text: 'Hubo un problema al conectar con el servidor.'
                    });
                    console.error('Error:', error);
                }
               
            });
               
               
            
        });




    });
</script>


<?php include("admin_footer.php")  ?>