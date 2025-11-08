<div class="container">
 <!-- <?php echo print_r($soporte); ?>  -->
    <form method="post" action="<?php echo site_url('admin/soporte/store'); ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= esc($soporte[0]['id']) ?>">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Información Oficial</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <label class="control-label">
                                    <font color="red">(*)</font> <b>Titulo:</b>
                                </label>
                                <input id="txtTitulo_soporte" name="txtTitulo_soporte" type="text" class="form-control" value="<?= esc($soporte[0]['titulo_soporte']) ?>" placeholder="">
                            </div>
                            
                            <div class="col-6">
                                <label class="control-label">
                                    <font color="red">(*)</font> <b>Subtitulo:</b>
                                </label>
                                <textarea id="txtParrafo_soporte" name="txtParrafo_soporte" class="form-control" rows="3" placeholder="Enter ..."><?= esc($soporte[0]['parrafo_soporte']) ?></textarea>
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
                        <h3 class="card-title">Soporte</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 200px; max-height: 164px; line-height: 120px;">
                                        <img style="max-width: 120px; max-height: 144px; line-height: 140px;"  src="<?= base_url('public/assets/image/' . $soporte[0]['imagen_soporte']); ?>" alt="Imagen de la empresa">
                                    </div>
                                    <div>
                                        <input type="hidden" name="imagen_actual" id="imagen_actual" value="<?= esc($soporte[0]['imagen_soporte']) ?>">
                                        <label class="btn btn-primary btn-file">
                                            <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                            <input type="file" accept=".jpg, .jpeg, .png" name="imagen_soporte" id="imagen_soporte" style="display: none;">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label>Sub.1</label>
                                    
                                    <input id="txtSub1_soporte" name="txtSub1_soporte" type="text" class="form-control" value="<?= esc($soporte[0]['sub1_soporte']) ?>" placeholder="">
                                    <br>

                                    <textarea id="txtSub_parrafo1" name="txtSub_parrafo1" class="form-control" rows="3" placeholder="Enter ..."><?= esc($soporte[0]['sub_parrafo1']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Sub.2</label>
                                    
                                    <input id="txtSub2_soporte" name="txtSub2_soporte" type="text" class="form-control" value="<?= esc($soporte[0]['sub2_soporte']) ?>" placeholder="">
                                    <br>

                                    <textarea id="txtSub_parrafo2" name="txtSub_parrafo2" class="form-control" rows="3" placeholder="Enter ..."><?= esc($soporte[0]['sub_parrafo2']) ?></textarea>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Sub.3</label>

                                    <input id="txtSub3_soporte" name="txtSub3_soporte" type="text" class="form-control" value="<?= esc($soporte[0]['sub3_soporte']) ?>" placeholder="">
                                    <br>

                                    <textarea id="txtSub_parrafo3" name="txtSub_parrafo3" class="form-control" rows="3" placeholder="Enter ..."><?= esc($soporte[0]['sub_parrafo3']) ?></textarea>
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
