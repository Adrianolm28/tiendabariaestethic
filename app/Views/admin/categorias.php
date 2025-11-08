  <section class="content">

    <!--   <?php

        print_r($categorias);

        ?> -->

      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Categorias</h3>

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
                                          <h4 class="modal-title">Agregar Nueva Categoria</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>



                                      <form method="post" action="<?php echo site_url('admin/categorias/store'); ?>" id="addCategorias" name="addCategorias" enctype="multipart/form-data">
                                          <input type="" id="id" name="id">

                                          <div class="card-body">
                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">titulo</label>
                                                  <input type="text" class="form-control" name="txtNombre_categoria" id="txtNombre_categoria" placeholder="">
                                              </div>

                                              <div class="form-group">
                                                  <label for="exampleInputEmail1">Descripcion</label>
                                                  <input type="text" class="form-control" name="txtDescripcion_categoria" id="txtDescripcion_categoria" placeholder="">
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

                      <?php
                        // echo "<pre>";
                        //print_r($categorias);

                        ?>
                      <div class="card-body">
                          <table id="categoriasTable" class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th>id</th>
                                      <th>Nombre</th>
                                      <th>Descripcion</th>
                                      <th>estado</th>
                                      <th width="280px">Acciones</th>
                                  </tr>
                              </thead>

                              <tbody>
                                  <?php foreach ($categorias as $item) : ?>
                                      <tr>
                                          <td><?= $item['id']; ?></td>
                                          <td><?= $item['nombre_categoria']; ?></td>
                                          <td><?= $item['descripcion_categoria']; ?></td>
                                          <td>
                                              <?= $item['estado'] == 1 ?  '<span class="me-1 badge bg-success">Activo</span>' : '<span class="me-1 badge bg-danger">Inactivo</span>'; ?>

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
      $(document).ready(function() {
          $('#categoriasTable').DataTable();

          $('#addCategorias').on('submit', function(event) {
              event.preventDefault(); // Prevenir el envío del formulario

              var form_data = new FormData(this);
              var form_action = $(this).attr('action');
              console.log(form_action);

              $.ajax({
                  data: form_data, // Los datos del formulario
                  url: form_action, // La URL para insertar datos
                  type: 'POST', // Método HTTP
                  dataType: 'json',
                  processData: false,
                  contentType: false,
                  success: function(res) {
                      // Manejar la respuesta del servidor (éxito o error)
                      console.log(res);
                      if (res.status) {
                          Swal.fire({
                              icon: 'success',
                              title: 'Guardado Exitosamente',
                              showConfirmButton: false,
                              timer: 1000
                          }).then(() => {
                              // Cerrar el modal después del éxito
                              $("#myModal").modal('hide'); //ocultamos el modal
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
                      // Manejar errores de conexión con el servidor
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
                  url: '<?= site_url('admin/categorias/edit/') ?>' + id, // Ajusta la URL según tu estructura de rutas
                  type: 'GET',
                  dataType: 'json',
                  success: function(res) {
                      if (res.status) {
                          // Llenar el formulario de edición con los datos recibidos
                          $('#myModal').modal('show');
                          $(' #id').val(res.data.id);
                          $(' #txtNombre_categoria').val(res.data.nombre_categoria);
                          $(' #txtDescripcion_categoria').val(res.data.descripcion_categoria);
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
                      url: '<?= site_url('admin/categorias/actualizar_estado/') ?>' + id + '/' + newStatus,
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




      });
  </script>