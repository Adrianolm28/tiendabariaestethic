<?php include("admin_header.php")  ?>

<div class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo site_url('admin/configuraciontienda/store'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="credencialesTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="empresa-tab" data-bs-toggle="tab" data-bs-target="#empresa" type="button" role="tab" aria-controls="empresa" aria-selected="true">Empresa</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="credenciales-api-tab" data-bs-toggle="tab" data-bs-target="#credenciales-api" type="button" role="tab" aria-controls="credenciales-api" aria-selected="false">Credenciales API</button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="credencialesTabContent">
                            <div class="tab-pane fade show active" id="empresa" role="tabpanel" aria-labelledby="empresa-tab">
                                <!-- Contenido de la pestaña Empresa -->
                                <input id="id" name="id" type="hidden" value="<?= $configtienda[0]['id'] ?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="control-label">
                                            <font color="red">(*)</font> <b>RUC:</b>
                                        </label>
                                        <input id="ruc" name="ruc" type="text" class="form-control" value="<?= $configtienda[0]['ruc'] ?>" placeholder="Ingrese RUC">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label">
                                            <font color="red">(*)</font> <b>Razón Social:</b>
                                        </label>
                                        <input id="razon_social" name="razon_social" type="text" class="form-control" value="<?= $configtienda[0]['razon_social'] ?>" placeholder="Ingrese Razón Social">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">
                                            <font color="red">(*)</font> <b>Correo:</b>
                                        </label>
                                        <input id="correo" name="correo" type="text" class="form-control" value="<?= $configtienda[0]['correo'] ?>" placeholder="Ingrese Correo">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        <label class="control-label">
                                            <font color="red">(*)</font> <b>Sobre nosotros:</b>
                                        </label>
                                        <textarea id="sobre_nosotros" name="sobre_nosotros" class="form-control" rows="4" placeholder="Ingrese Información sobre la empresa"><?= $configtienda[0]['sobre_nosotros'] ?></textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">
                                            <font color="red">(*)</font> <b>Teléfono:</b>
                                        </label>
                                        <input id="telefono" name="telefono" type="text" class="form-control" value="<?= $configtienda[0]['telefono'] ?>" placeholder="Ingrese Teléfono">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">
                                            <font color="red">(*)</font> <b>Dirección:</b>
                                        </label>
                                        <input id="direccion" name="direccion" type="text" class="form-control" value="<?= $configtienda[0]['direccion'] ?>" placeholder="Ingrese Dirección">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-4">
                                        
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 200px; max-height: 164px; line-height: 120px;">
                                                <img style="max-width: 120px; max-height: 144px; line-height: 140px;" src="<?= base_url('public/assets/img_tienda/logo_tienda/' . $configtienda[0]['logo_t']); ?>" alt="">
                                            </div>
                                            <div>
                                                <input type="hidden" name="imagen_actual" id="imagen_actual" value="<?= esc($configtienda[0]['logo_t']) ?>">
                                                <label class="btn btn-primary btn-file">
                                                    <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                                    <input type="file" accept=".jpg, .jpeg, .png" name="logo_t" id="logo_t" style="display: none;">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="credenciales-api" role="tabpanel" aria-labelledby="credenciales-api-tab">
                                <!-- Contenido de la pestaña Credenciales API -->
                                <div class="mb-4">
                                    <h5 class="mb-3">Sistema Valeapp</h5>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font> <b>Subdominio:</b>
                                            </label>
                                            <input type="text" class="form-control" id="subdominio" name="subdominio" placeholder="Ingrese Subdominio" value="<?= $configtienda[0]['subdominio'] ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font> <b>API Productos:</b>
                                            </label>
                                            <input type="text" class="form-control" id="api_productos" name="api_productos" placeholder="Ingrese su API Productos" value="<?= $configtienda[0]['api_productos'] ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font> <b>Token api:</b>
                                            </label>
                                            <input type="text" class="form-control" id="api_token" name="api_token" placeholder="Ingrese su API Productos" value="<?= $configtienda[0]['api_token'] ?>">
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-4">
                                    <h5 class="mb-3">Método de Pago - Mercado Pago</h5>

                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font> <b>Public Key:</b>
                                            </label>
                                            <input type="text" class="form-control" id="public_key" name="public_key" placeholder="Ingrese su Public Key" value="<?= $configtienda[0]['public_key'] ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font> <b>Access Token:</b>
                                            </label>
                                            <input type="password" class="form-control" id="access_token" name="access_token" placeholder="Ingrese su Access Token" value="<?= $configtienda[0]['access_token'] ?>">
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-3">IziPay</h5>

                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font>Username <b>:</b>
                                            </label>
                                            <input type="text" class="form-control" id="username_izp" name="username_izp" placeholder="Ingrese su cod. Usuario" value="<?= $izipayCredentials['username'] ?? '' ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font>password <b>:</b>
                                            </label>
                                            <input type="text" class="form-control" id="password_izp" name="password_izp" placeholder="Ingrese su clave" value="<?= $izipayCredentials['password'] ?? '' ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font>Public key <b>:</b>
                                            </label>
                                            <input type="text" class="form-control" id="public_key_izp" name="public_key_izp" placeholder="Ingrese su Clave publica" value="<?= $izipayCredentials['public_key_izp'] ?? '' ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font>Hmac_sha <b>:</b>
                                            </label>
                                            <input type="text" class="form-control" id="Hmac_sha" name="Hmac_sha" placeholder="codigo de seguridad" value="<?= $izipayCredentials['hmac_sha256'] ?? '' ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="control-label">
                                                <font color="red">(*)</font>endpoint api <b>:</b>
                                            </label>
                                            <input type="text" class="form-control" id="end_point" name="end_point" placeholder="Ingrese su Access Token" value="<?= $izipayCredentials['endpoint_api_rest'] ?? '' ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnGuardar" class="btn btn-success btn-pill"><i class="fa fa-save"></i> Guardar datos</button>
                </div>
            </div>
        </div>

    </form>
</div>

<?php include("admin_footer.php")  ?>