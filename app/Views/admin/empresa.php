<div class="container">
 <!-- <?php echo print_r($datosEmpresa); ?> -->
    <form method="post" action="<?php echo site_url('admin/empresa/store'); ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= esc($datosEmpresa[0]['id']) ?>">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header" style="background:#1976d2;color:#fff;">
                        <h3 class="card-title">Información Oficial</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label class="control-label">
                                    <font color="red">(*)</font> <b>Dirección:</b>
                                </label>
                                <input id="txtDireccion" name="txtDireccion" type="text" class="form-control" value="<?= esc($datosEmpresa[0]['empresa_direccion']) ?>" placeholder="">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="control-label">
                                    <font color="red">(*)</font> <b>Teléfono:</b>
                                </label>
                                <input id="txtTelefono" name="txtTelefono" type="text" class="form-control" value="<?= esc($datosEmpresa[0]['empresa_telefono']) ?>" placeholder="">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="control-label">
                                    <font color="red">(*)</font> <b>Razón Social:</b>
                                </label>
                                <input id="txtRazonsocial" name="txtRazonsocial" type="text" class="form-control" value="<?= esc($datosEmpresa[0]['empresa_razonsocial']) ?>" placeholder="">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="control-label">
                                    <font color="red">(*)</font> <b>Correo:</b>
                                </label>
                                <input type="email" name="txtCorreo" id="txtCorreo" class="form-control" value="<?= esc($datosEmpresa[0]['empresa_correo'] ?? '') ?>" placeholder="">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3 mb-2">
                                <label class="control-label">
                                    <font color="red">(*)</font> WhatsApp Empresa:
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                    <input id="empresa_whatsapp" name="empresa_whatsapp" type="text" class="form-control" value="<?= esc($datosEmpresa[0]['empresa_whatsapp'] ?? '') ?>" placeholder="WhatsApp">
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="control-label">
                                    <font color="red">(*)</font> TikTok:
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-tiktok"></i></span>
                                    <input id="empresa_tiktok" name="empresa_tiktok" type="text" class="form-control" value="<?= esc($datosEmpresa[0]['empresa_tiktok'] ?? '') ?>" placeholder="TikTok">
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="control-label">
                                    <font color="red">(*)</font> Instagram:
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                    <input id="empresa_instagram" name="empresa_instagram" type="text" class="form-control" value="<?= esc($datosEmpresa[0]['empresa_instagram'] ?? '') ?>" placeholder="Instagram">
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="control-label">
                                    <font color="red">(*)</font> Facebook:
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                    <input id="empresa_facebook" name="empresa_facebook" type="text" class="form-control" value="<?= esc($datosEmpresa[0]['empresa_facebook'] ?? '') ?>" placeholder="Facebook">
                                </div>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label class="control-label">
                                    <font color="red">(*)</font> YouTube:
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-youtube"></i></span>
                                    <input id="empresa_youtube" name="empresa_youtube" type="text" class="form-control" value="<?= esc($datosEmpresa[0]['empresa_youtube'] ?? '') ?>" placeholder="YouTube">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Logo y Descripción</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 200px; max-height: 164px; line-height: 120px;">
                                        <img style="background-color:black;" src="<?= base_url('public/assets/image/others/logo/' . $datosEmpresa[0]['empresa_logo']); ?>" alt="Imagen de la empresa">
                                    </div>
                                    <div>
                                        <input type="hidden" name="imagen_actual" id="imagen_actual" value="<?= esc($datosEmpresa[0]['empresa_logo']) ?>">
                                        <label class="btn btn-primary btn-file">
                                            <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                            <input type="file" accept=".jpg, .jpeg, .png" name="empresa_logo" id="empresa_logo" style="display: none;">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea id="txtDescripcion" name="txtDescripcion" class="form-control" rows="3" placeholder="Enter ..."><?= esc($datosEmpresa[0]['empresa_descripcion']) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnGuardar" class="btn btn-success btn-pill">
    <i class="fa fa-save"></i> Guardar datos
</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php if (session()->getFlashdata('success')): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Guardado!',
        text: 'Los datos se han guardado correctamente.',
        confirmButtonColor: '#1976d2'
    });
</script>
<?php endif; ?>
