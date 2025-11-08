<section class="content">

    <?php
    /* echo "<pre>";
    print_r($posts); */
    
    print_r($user);
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Posts</h3>

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



                                    <form method="post" action="<?php echo site_url('admin/posts/store'); ?>" id="addPosts" name="addPosts" enctype="multipart/form-data">
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
                        <table id="postsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>created_at/updated_at</th>
                                    <th>Titulo</th>
                                    <th>Autor</th>
                                    <th>Descripcion</th>
                                    <th width="280px">Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($posts as $item) : ?>
                                    <tr>
                                        <td><?php echo $item['id']; ?></td>
                                        <td><?php echo $item['updated_at']; ?></td>
                                        <td><?php echo $item['titulo']; ?></td>
                                        <td> <?= session()->username; ?></td>
                                        <td><?= $item['estado'] == 1 ? '<span class="me-1 badge bg-success">Publicado</span>' : '<span class="me-1 badge bg-danger">No publicado</span>'; ?></td>
                                        <td>
                                          
                                            <a href="#" class="btn btn-primary">Editar</a>
                                            <a href="#" class="btn btn-danger">Eliminar</a>
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