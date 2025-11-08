<?php include("admin_header.php")  ?>




<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios</h3>

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
                                        <h4 class="modal-title">Agregar Nuevo Usuario</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div id="messageContainer"></div>

                                    <form method="post" action="<?php echo site_url('admin/usuarios/store'); ?>" id="addUsuarios" name="addUsuarios" enctype="multipart/form-data">
                                        <input type="text" id="id" name="id">

                                        <div class="card-body">

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Nombre</label>
                                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="correo">Correo</label>
                                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleInputEmail1">Celular</label>
                                                    <input type="text" class="form-control" name="celular" id="celular" placeholder="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="clave">Clave:</label>
                                                    <input type="password" class="form-control" name="clave" id="clave" placeholder="">
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
                    <!-- <?php print_r($usuarios); ?> -->
                    <div class="card-body">
                        <table id="clientesTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($usuarios as $usuario) : ?>
                                    <tr>
                                        <td><?= $usuario['id_usuario'] ?></td>
                                        <td><?= $usuario['nombre'] ?></td>
                                        <td><?= $usuario['correo'] ?></td>
                                        <td><?= $usuario['celular'] ?></td>
                                        <td>
                                            <?= $usuario['estado'] == 1 ? '<span class="me-1 badge bg-success">Activo</span>' : '<span class="me-1 badge bg-danger">Inactivo</span>';
                                            ?>
                                        </td>
                                        <td>
                                            <a data-id="<?php echo $usuario['id_usuario']; ?>" class="btn btn-primary btnEdit">Editar</a>
                                            <a data-id="<?= $usuario['id_usuario']; ?>" data-estado="<?= $usuario['estado']; ?>" class="btn btn-<?= $usuario['estado'] == 1 ? 'danger' : 'success'; ?> btnDelete"><?= $usuario['estado'] == 1 ? 'Desactivar' : 'Activar'; ?></a>
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
        $('#clientesTable').DataTable();


        $('#addUsuarios').on('submit', function(event) {
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


        $('body').on('click', '.btnEdit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '<?= site_url('admin/usuarios/edit/') ?>' + id, // Ajusta la URL según tu estructura de rutas
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        // Llenar el formulario de edición con los datos recibidos
                        $('#myModal').modal('show');
                        $(' #id').val(res.data.id_usuario);
                        $(' #nombre').val(res.data.nombre);
                        $(' #correo').val(res.data.correo);
                        $(' #celular').val(res.data.celular);
                        $(' #clave').val(res.data.clave);


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
    });
</script>






<?php include("admin_footer.php")  ?>