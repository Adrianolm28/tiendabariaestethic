<div class="container">
    <!-- <?php print_r($informacion); ?>  -->
    <form method="post" action="<?php echo site_url('admin/informacion/store'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= esc($informacion[0]['id']) ?>">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Información Valeapp</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">
                                    <font color="red">(*)</font> <b>Titulo:</b>
                                </label>
                                <input id="txtInfo_Titulo" name="txtInfo_Titulo" type="text" class="form-control" value="<?= esc($informacion[0]['info_titulo']) ?>" placeholder="">
                            </div>

                            <div class="col-6">
                                <label class="control-label">
                                    <font color="red">(*)</font> <b>Parrafo:</b>
                                </label>
                                <textarea id="txtInfo_descripcion" name="txtInfo_descripcion" class="form-control" rows="4" placeholder="Enter ..."><?= esc($informacion[0]['info_descripcion']) ?></textarea>
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
                        <h3 class="card-title">Imagenes</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 200px; max-height: 164px; line-height: 120px;">
                                        <img style="max-width: 120px; max-height: 144px; line-height: 140px;" src="<?= base_url('public/assets/image/others/' . $informacion[0]['info_logo']); ?>" alt="Imagen de la empresa">
                                    </div>
                                    <div>
                                        <input type="hidden" name="imagen_actual_info_logo" id="imagen_actual_info_logo" value="<?= esc($informacion[0]['info_logo']) ?>">
                                        <label class="btn btn-primary btn-file">
                                            <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                            <input type="file" accept=".jpg, .jpeg, .png" name="info_logo" id="info_logo" style="display: none;">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>Icono.1</label>

                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 39px; max-height: 39px; line-height: 39px; background-color: #000;">
                                            <img style="max-width: 39px; max-height: 39px; line-height: 39px;" src="<?= base_url('public/assets/image/' . $informacion[0]['info_icono1']); ?>" alt="Imagen de la empresa">
                                        </div>
                                        <div>
                                            <input type="hidden" name="imagen_actual_info_icono1" id="imagen_actual_info_icono1" value="<?= esc($informacion[0]['info_icono1']) ?>">
                                            <label class="btn btn-primary btn-file">
                                                <i class="glyphicon glyphicon-cloud-upload"></i> Seleccionar Icono [+]
                                                <input type="file" accept=".jpg, .jpeg, .png" name="info_icono1" id="info_icono1" style="display: none;">
                                            </label>
                                        </div>
                                    </div>

                                    <textarea id="txtText_icono1" name="txtText_icono1" class="form-control" rows="3" placeholder="Enter ..."><?= esc($informacion[0]['text_icono1']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Icono.2</label>

                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 39px; max-height: 39px; line-height: 39px; background-color: #000;">
                                            <img style="max-width: 39px; max-height: 39px; line-height: 39px; background:black;" src="<?= base_url('public/assets/image/' . $informacion[0]['info_icono2']); ?>" alt="Imagen de la empresa">
                                        </div>
                                        <div>
                                            <input type="hidden" name="imagen_actual_info_icono2" id="imagen_actual_info_icono2" value="<?= esc($informacion[0]['info_icono2']) ?>">
                                            <label class="btn btn-primary btn-file">
                                                <i class="glyphicon glyphicon-cloud-upload"></i> Seleccionar Icono [+]
                                                <input type="file" accept=".jpg, .jpeg, .png" name="info_icono2" id="info_icono2" style="display: none;">
                                            </label>
                                        </div>
                                    </div>

                                    <textarea id="txtText_icono2" name="txtText_icono2" class="form-control" rows="3" placeholder="Enter ..."><?= esc($informacion[0]['text_icono2']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Icono.3</label>

                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 39px; max-height: 39px; line-height: 39px; background-color: #000;">
                                            <img style="max-width: 39px; max-height: 39px; line-height: 39px; background:black;" src="<?= base_url('public/assets/image/' . $informacion[0]['info_icono3']); ?>" alt="Imagen de la empresa">
                                        </div>
                                        <div>
                                            <input type="hidden" name="imagen_actual_info_icono3" id="imagen_actual_info_icono3" value="<?= esc($informacion[0]['info_icono3']) ?>">
                                            <label class="btn btn-primary btn-file">
                                                <i class="glyphicon glyphicon-cloud-upload"></i> Seleccionar Icono [+]
                                                <input type="file" accept=".jpg, .jpeg, .png" name="info_icono3" id="info_icono3" style="display: none;">
                                            </label>
                                        </div>
                                    </div>

                                    <textarea id="txtText_icono3" name="txtText_icono3" class="form-control" rows="3" placeholder="Enter ..."><?= esc($informacion[0]['text_icono3']) ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnGuardar" class="btn btn-success btn-pill"><i class="fa fa-save"></i> Guardar datos</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>

$('#info_icono1').on('change', function() {
    // Obtiene el archivo seleccionado en el input de tipo archivo
    const file = this.files[0];
    // Crea un objeto de imagen para cargar la imagen seleccionada
    const img = new Image();
    img.src = window.URL.createObjectURL(file);
    
    // Cuando la imagen se haya cargado completamente
    img.onload = function() {
        // Comprueba si el ancho y el alto de la imagen no son más grandes que 40x40 píxeles
        if (img.width > 90 || img.height > 90) {
            // Si las dimensiones no son correctas, muestra una alerta de error utilizando SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La imagen debe tener dimensiones de 90x90 píxeles o menos.',
                confirmButtonColor: '#d33'
            });
            $('#info_icono1').val(""); // Limpiar el campo de archivo
        }
    };
});

</script>