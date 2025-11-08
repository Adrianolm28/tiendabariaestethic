<?php include("admin_header.php") ?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Formulario para generar cupones masivos -->
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Generar Cupones Masivos</h3>
                    </div>
                    <form method="post" action="<?= base_url('admin/generarMasivos') ?>">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('success') || isset($success)): ?>
                                <div class="alert alert-success">
                                    <?= session('success') ?: $success ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <label for="cantidad">Cantidad de cupones</label>
                                <select name="cantidad" id="cantidad" class="form-control" required>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descuento">Descuento (%)</label>
                                <input type="number" name="descuento" id="descuento" class="form-control" min="1" max="100" required>
                            </div>
                            <div class="form-group">
                                <label for="vigencia">Vigencia (días)</label>
                                <input type="number" name="vigencia" id="vigencia" class="form-control" min="1" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Generar Cupones</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Tabla de cupones generados -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Listado de Cupones</h3>
                    </div>
                    <div class="card-body">
                        <table id="cuponesTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código</th>
                                    <th>Descuento (%)</th>
                                    <th>Expira</th>
                                    <th>Estado</th>
                                    <th>Creado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($cupones) && count($cupones) > 0): ?>
                                    <?php foreach ($cupones as $cupon): ?>
                                        <tr>
                                            <td><?= $cupon['id'] ?></td>
                                            <td><?= $cupon['codigo'] ?></td>
                                            <td><?= $cupon['descuento'] ?></td>
                                            <td><?= $cupon['fecha_expiracion'] ?></td>
                                            <td>
                                                <?php
                                                    $hoy = date('Y-m-d');
                                                    if ($cupon['estado'] == 'activo' && $cupon['fecha_expiracion'] < $hoy) {
                                                        // Si está activo pero ya expiró, mostrar como inactivo
                                                        echo '<span class="badge bg-danger">Inactivo</span>';
                                                    } elseif ($cupon['estado'] == 'activo') {
                                                        echo '<span class="badge bg-success">Activo</span>';
                                                    } else {
                                                        echo '<span class="badge bg-danger">Inactivo</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td><?= $cupon['fecha_creacion'] ?></td>
                                            <td>
                                                <form method="post" action="<?= base_url('admin/eliminarCupon/' . $cupon['id']) ?>" class="form-eliminar-cupon" style="display:inline;">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-danger btn-sm btn-eliminar-cupon">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No hay cupones registrados.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
        $('#cuponesTable').DataTable();

        // Interceptar el submit del formulario de eliminar
        $('.form-eliminar-cupon').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: '¿Seguro que deseas eliminar este cupón?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Mostrar Swal de éxito si hay mensaje de éxito en la sesión
        <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '<?= session('success') ?>',
            timer: 2000,
            showConfirmButton: false
        });
        <?php endif; ?>
    });
</script>
<?php include("admin_footer.php") ?>