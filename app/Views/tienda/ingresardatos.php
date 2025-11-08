<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>


<style>
    body {
        background-color: #eee;
    }

    #datos_comprador {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        border: none;

        padding: 20px;
    }

    #datos_comprador .form-group label {
        font-weight: bold;
        /* Hacer las etiquetas de formulario en negrita */
    }

    .producto-resumen img {
        width: 40px;
        height: auto;
        margin-right: 10px;
        border-radius: 5px;

    }

    #resumen-compra-form {
        margin-top: 20px;
        border-radius: 10px;
        border: 1px solid #ccc;
        padding: 20px;
        background-color: #fff;
        border: none;
    }

    #resumen-compra-form p {
        font-weight: bold;
    }

    .producto-resumen .precio {
        margin-left: 20%;
        font-size: 11px;
        font-weight: 400;
    }

    @media (min-width: 768px) {
        .producto-resumen .precio {
            margin-left: 25%;
            /* Ajusta este valor según tu diseño */
        }
    }

    @media (max-width: 768px) {
        .producto-resumen .precio {
            margin-left: 5%;
        }
    }

    .nombre {
        font-weight: 500;
        font-size: 11px;
    }

    .resumen-compra-container {
        text-align: justify;
        /* Justificar las imágenes */
        margin: 0 auto;
    }

    .producto-resumen {
        margin-bottom: 10px;
    }


    /*  barra de progreso */
    .stepper-wrapper {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .stepper-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;

        @media (max-width: 768px) {
            font-size: 12px;
        }
    }

    .stepper-item::before {
        position: absolute;
        content: "";
        border-bottom: 2px solid #ccc;
        width: 100%;
        top: 20px;
        left: -50%;
        z-index: 2;
    }

    .stepper-item::after {
        position: absolute;
        content: "";
        border-bottom: 2px solid #ccc;
        width: 100%;
        top: 20px;
        left: 50%;
        z-index: 2;
    }

    .stepper-item .step-counter {
        position: relative;
        z-index: 5;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ccc;
        margin-bottom: 6px;
    }

    .stepper-item.active {
        font-weight: bold;
    }

    .stepper-item.completed .step-counter {
        background-color: #4bb543;
    }

    .stepper-item.completed::after {
        position: absolute;
        content: "";
        border-bottom: 2px solid #4bb543;
        width: 100%;
        top: 20px;
        left: 50%;
        z-index: 3;
    }

    .stepper-item:first-child::before {
        content: none;
    }

    .stepper-item:last-child::after {
        content: none;
    }

    .form-check-label a {
        color: blue !important;
    }

    /* Estilos para el menú lateral */
    .sidebar-container {
        position: fixed;
        top: 0;
        bottom: 0;
        right: -250px;
        /* Inicialmente la barra lateral está fuera de la vista */
        width: 250px;
        background-color: #f0f0f0;
        overflow-y: auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: right 0.3s;
        /* Añadir transición para animar la aparición/desaparición de la barra lateral */
    }

    .sidebar-content {
        padding: 20px;
    }

    .sidebar-content>div {
        margin-bottom: 15px;
    }


    .activate-sidebar-btn {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 999;
        /* Asegurar que el botón esté por encima de la barra lateral */
        cursor: pointer;
    }

    .otro-medio-pago-button {
        padding: 0 1.7142857142857142em;
        font-family: "Helvetica Neue", Arial, sans-serif;
        font-size: 0.875em;
        line-height: 2.7142857142857144;
        background: #009ee3;
        border-radius: 0.2857142857142857em;
        color: #fff;
        cursor: pointer;
        border: 0;

    }

    .cotizar-button {
        padding: 0 1.7142857142857142em;
        font-family: "Helvetica Neue", Arial, sans-serif;
        font-size: 0.875em;
        line-height: 2.7142857142857144;
        background: #009ee3;
        border-radius: 0.2857142857142857em;
        color: #fff;
        cursor: pointer;
        border: 0;

    }

    /* arcodion */


    .accordion-item {
        padding: 1em;
        background-color: #ffffff;
        border-radius: 0.5em;
    }

    .accordion-item:not(:last-child) {
        margin-bottom: 1em;
    }

    .accordion-content {
        color: #606060;
        font-size: 0.8em;
        line-height: 1.8em;
    }

    label {
        font-size: 1em;
        display: flex;
        justify-content: space-between;
        color: #000000;
        cursor: pointer;
        font-weight: 500;
        padding: 1em 0;
    }

    input[type="checkbox"]~label .arrow {
        display: inline-block;
        transition: 1s;
    }

    input[type="checkbox"]:checked~label .arrow {
        transform: rotate(90deg);
    }

    input[type="checkbox"]:checked~label {
        color: #0083e9;
    }

    input[type="checkbox"]~.accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: 1s;
    }

    input[type="checkbox"]:checked~.accordion-content {
        max-height: 100vh;

        transition: 1s;
    }

    .tab-content {
        padding-top: 20px;
    }

    .btn_transferencia {
         border-style: none; 
    }
    
     @media (min-width: 360px) and (max-width: 430px) {
    .accordion-item {
        padding: 1em;
        background-color: transparent;
        border-radius: 0;
    }
    .accordion-content{
        color:#fff;
    }
</style>
<!-- 
 -->

<div class="container">



    <br>

    <div class="stepper-wrapper">
        <div class="stepper-item completed">
            <div class="step-counter">1</div>
            <div class="step-name">Carro</div>
        </div>
        <div class="stepper-item completed">
            <div class="step-counter">2</div>
            <div class="step-name">Entrega</div>
        </div>
        <div class="stepper-item active">
            <div class="step-counter">3</div>
            <div class="step-name">Pago</div>
        </div>

    </div>


    <!--   <?php print_r($usuarioAutenticado) ?> -->
    <h4>Datos del comprador</h4>
    <div class="row">

        <!-- <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-12">

                    <form id="datos_comprador" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dni">DNI</label>
                                    <input type="text" class="form-control" id="dni" name="dni" required maxlength="8" pattern="[0-9]{8}">

                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="apellido">Apellido</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="correo" name="correo" required>
                                </div>
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono" required maxlength="9">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <select class="form-control" id="departamento" name="departamento" required>
                                        <option value="">Seleccionar departamento</option>
                                        <?php foreach ($departamentos as $departamento) : ?>
                                            <option value="<?= $departamento['idDepa'] ?>"><?= $departamento['departamento'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="provincia">Provincia</label>
                                    <select class="form-control" id="provincia" name="provincia" required>
                                        <option value="">Seleccionar provincia</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="distrito">Distrito</label>
                                    <select class="form-control" id="distrito" name="distrito" required>
                                        <option value="">Seleccionar distrito</option>
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="direccion">Avenida/ Calle / Jirón</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                                </div>
                                <div class="form-group">
                                    <label for="numero">Número</label>
                                    <input type="text" class="form-control" id="numero" name="numero" required>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> -->

        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <form id="datos_comprador1" enctype="multipart/form-data">

                        <input type="hidden" id="tipo_entrega" name="tipo_entrega" value="envio">
                        <div class="accordion">
                            <!-- Item 1 -->
                            <div class="accordion-item">
                                <input type="checkbox" id="item-1" />
                                <label for="item-1" class="accordion-header">
                                    <span>E-mail:</span>
                                    <span class="arrow">
                                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                    </span>
                                </label>
                                <div class="accordion-content">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre_recojo" name="nombre_recojo" value="<?= $usuarioAutenticado['nombre_c'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="correo">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="correo" name="correo" value="<?= $usuarioAutenticado['correo'] ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Item 2 -->
                            <div class="accordion-item">
                                <input type="checkbox" id="item-2" />
                                <label for="item-2" class="accordion-header">
                                    <span>Identificación de la persona que va a recibir:</span>
                                    <span class="arrow">
                                        <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                    </span>
                                </label>
                                <div class="accordion-content">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="dni">DNI</label>
                                                <input type="text" class="form-control" id="dni" name="dni" required maxlength="8" pattern="[0-9]{8}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nombre">Nombres</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la persona que va a recibir" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="telefono">Teléfono</label>
                                                <input type="tel" class="form-control" id="telefono" name="telefono" required maxlength="9">
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <!-- Item 3 -->
                            <div class="accordion-item">
                                <input type="checkbox" id="item-3" />
                                <label for="item-3" class="accordion-header">
                                    <span>Envio:</span>
                                    <span class="arrow">
                                        <i class="fa fa-chevron-circle-right"></i>
                                    </span>
                                </label>
                                <div class="accordion-content">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item active">
                                            <a class="nav-link" data-toggle="tab" href="#envio" aria-expanded="true">Envío a domicilio</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#recojo">Recojo en tienda</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="">
                                        <!-- Envío a domicilio tab -->
                                        <div class="tab-pane active" id="envio" aria-labelledby="envio-tab">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="departamento">Departamento</label>
                                                        <select class="form-control" id="departamento" name="departamento" required>
                                                            <option value="">Seleccionar departamento</option>
                                                            <?php foreach ($departamentos as $departamento) : ?>
                                                                <option value="<?= $departamento['idDepa'] ?>"><?= $departamento['departamento'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="provincia">Provincia</label>
                                                        <select class="form-control" id="provincia" name="provincia" required>
                                                            <option value="">Seleccionar provincia</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="distrito">Distrito</label>
                                                        <select class="form-control" id="distrito" name="distrito" required>
                                                            <option value="">Seleccionar distrito</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="direccion">Avenida/ Calle / Jirón</label>
                                                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="numero">Número</label>
                                                        <input type="text" class="form-control" id="numero" name="numero" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Recojo tab -->
                                        <div class="tab-pane fade" id="recojo">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>Dirección de la empresa: <strong>Calle Juana Manrique de Luna 168 - San Miguel</strong></p>
                                                    <a class="btn btn-primary" href="https://www.google.com/maps/search/?api=1&query=Calle Juana Manrique de Luna 168 - San Miguel" target="_blank">Cómo llegar <i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                                </div>

                                                <div class="col-md-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="fecha_recojo">Fecha de recojo</label>
                                                        <input type="date" class="form-control" id="fecha_recojo" name="fecha_recojo" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="hora_recojo">Hora de recojo</label>
                                                        <input type="time" class="form-control" id="hora_recojo" name="hora_recojo" required>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="resumen-compra-container">
                <h4>Resumen de Compra</h4>
                <form id="resumen-compra-form">
                    <div id="resumen-productos">

                    </div>
                    <hr>
                    <div class="costo-envio">
                        <p>Costo de envío: <span id="costo-envio"></span></p>
                    </div>

                    <div class="subtotal">
                        <p>Subtotal: <span id="subtotal"></span></p>
                    </div>




                    <div class="descuento" id="descuento" style="display: none; font-weight: bold;">
                        <p>Descuento: <span id="descuento"></span></p>

                    </div>
                    <br>

                    <div class="total">
                        <p>Total: <span id="total"></span></p>
                    </div>

                    <div class="form-check d-inline-flex align-items-center">
                        <!-- <input class="form-check-input" type="checkbox" value="" id="terminos-condiciones"> -->
                        <label class="form-check-label ml-2" for="terminos-condiciones"><a href="#" title="ver terminos y condiciones" data-toggle="modal" data-target="#modalTerminosYCondiciones">
                                términos y condiciones
                            </a> </label>
                    </div>

                    <button id="continuar-compra-btna" style="background-color: #0C2941;" type="button" class="btn btn-success checkout-btn1"><i class="fas fa-shopping-cart"></i> Elegir Metodo de Pago</button>


                </form>

            </div>
        </div>


    </div>
    <hr>

    <!--     <div class="checkout-btn"></div>
    <br>
    <div class="otro_pago"></div>
    <br>
    <div class="cotizar_pago"></div> -->

    <div class="sidebar-container">

        <div class="sidebar">
            <div class="sidebar-content">
                <!-- Botón para Izipay -->

                <div class="checkout-btn"></div>
                <div class="izipay-btn-container"></div>
                <div class="otro_pago"></div>
                <div class="cotizar_pago"></div>
            </div>
        </div>
    </div>


</div>

<div class="modal fade" id="modalTerminosYCondiciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Términos y Condiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal para otro medio de pago -->
<div class="modal fade" id="otroMedioPagoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Otro medio de pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioPago" enctype="multipart/form-data">
                    <input type="hidden" name="metodoPago" id="metodoPago" value="mercadoPago">

                    <div class="form-group">
                        <div class="d-flex justify-content-around">
                            <button type="button" class="btn_transferencia" data-banco="BCP_Soles">
                                <img src="<?= base_url('public/assets/img_tienda/iconos/bcp.png') ?>" alt="BCP Soles" style="max-width: 35px;">
                            </button>
                          
                            <button type="button" class="btn_transferencia" data-banco="Yape">
                                <img src="<?= base_url('public/assets/img_tienda/iconos/yape.png') ?>" alt="Yape" style="max-width: 35px;">
                            </button>
                            <button type="button" class="btn_transferencia" data-banco="Plin">
                                <img src="<?= base_url('public/assets/img_tienda/iconos/plin11.jpg') ?>" alt="Plin" style="max-width: 35px;" onerror="this.onerror=null;this.src='<?= base_url('public/assets/img_tienda/iconos/default.png') ?>';">
                            </button>
                        </div>
                    </div>


                    <!-- Mostrar el número de cuenta de BCP por defecto -->
                    <div id="cuentaInfo" class="form-group">
                        <span id="numeroCuenta">Número de cuenta: <span>191-2565571-057</span></span>
                        <button type="button" id="copiarCuenta" class="btn btn-secondary btn-sm">
                        <i class="fas fa-copy"></i> 
                        </button>
                    </div>


                    <div class="form-group">
                        <label for="imagenVoucher">Adjuntar imagen:</label>
                        <input type="file" accept=".jpg, .jpeg, .png" class="form-control-file" id="imagenVoucher" name="imagenVoucher">
                    </div>


                    <div class="form-group form-check">

                        <input type="checkbox" class="form-check-input" id="agregarVoucher">
                        <label class="form-check-label" for="agregarVoucher">Agregar voucher</label>
                    </div>


                </form>

                <!-- Div para mostrar la imagen adjunta -->
                <div id="imagenAdjuntaContainer" style="max-width: 100%; max-height: 300px; overflow: auto;">

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="guardarCompra" type="button" class="btn btn-primary" disabled>Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- cotizar -->
<div class="modal fade" id="cotizarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cotizar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioPago" enctype="multipart/form-data">
                    <input type="hidden" name="metodoPago" id="metodoPago" value="mercadoPago">
                    <div class="form-group">
                        <label for="imagenVoucher">Adjuntar imagen:</label>
                        <input type="file" accept=".jpg, .jpeg, .png" class="form-control-file" id="imagenVoucher" name="imagenVoucher">
                    </div>


                    <div class="form-group form-check">

                        <input type="checkbox" class="form-check-input" id="agregarVoucher">
                        <label class="form-check-label" for="agregarVoucher">Agregar voucher</label>
                    </div>
                </form>

                <!-- Div para mostrar la imagen adjunta -->
                <div id="imagenAdjuntaContainer" style="max-width: 100%; max-height: 300px; overflow: auto;">

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button id="guardarCompra_1" type="button" class="btn btn-primary" disabled>Guardar</button>

            </div>
        </div>
    </div>
</div>




<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Suscríbete para más <strong>OFERTAS!</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Ingresa tu correo">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Suscríbete</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <!-- /row -->
    </div>
    <!-- /container -->
</div>



<script src="https://sdk.mercadopago.com/js/v2"></script>


<script>
    $(document).ready(function() {

        mostrarCuenta('BCP');

        // Manejar el clic en los botones de transferencia
        $('.btn_transferencia').on('click', function() {
            var banco = $(this).data('banco');
            mostrarCuenta(banco);
        });

        // Manejar el clic en el botón de copiar
        $('#copiarCuenta').on('click', function() {
            var numeroCuenta = $(this).data('copiar');
            navigator.clipboard.writeText(numeroCuenta).then(function() {
               
            }, function() {
                alert("No se pudo copiar el número.");
            });
        });

        function mostrarCuenta(banco) {
            var numeroCuenta = "";
            var titular = "";

            if (banco === 'BCP_Soles') {
                numeroCuenta = "191-2565571-0-57";
                titular = "Néstor Chávez Tapia";
           
            } else if (banco === 'Yape') {
                numeroCuenta = "902 487 281";
                titular = "Néstor Chávez Tapia";
            } else if (banco === 'Plin') {
                numeroCuenta = "949 453 997";
                titular = "Néstor Chávez Tapia";
            }

            $('#metodoPago').val(banco);
            $('#numeroCuenta').html(
                banco === 'BCP_Soles' || banco === 'BCP_Dolares'
                    ? "Número de cuenta: " + numeroCuenta
                    : "Número: " + numeroCuenta + "<br>Titular: " + titular
            );

            // Cambiar el texto del botón de copiar
            $('#copiarCuenta').data('copiar', numeroCuenta);
        }

        function openSidebar() {
            $('.sidebar-container').css('right', '0'); // Activar la barra lateral
        }

        // Función para cerrar la barra lateral
        function closeSidebar() {
            $('.sidebar-container').css('right', '-250px'); // Desactivar la barra lateral
        }

        // Al hacer clic en el botón #continuar-compra-btna, abrir la barra lateral
        $('#continuar-compra-btna').click(function() {
            openSidebar();
        });

        // Al hacer clic fuera de la barra lateral, cerrarla
        $(document).click(function(e) {
            if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('#continuar-compra-btna').length) {
                closeSidebar();
            }
        });

        var base_url = "<?php echo base_url() ?>";
        // Función para cargar los productos del carrito dinámicamente
        function cargarProductosCarrito() {
            var carritoGuardado = localStorage.getItem('carrito');

            if (!carritoGuardado || JSON.parse(carritoGuardado).length === 0) {
                window.location.href = '<?php echo site_url('tienda/carrito'); ?>';
                return;
            }

            var carrito = JSON.parse(carritoGuardado);
            var resumenProductos = $('#resumen-productos');
            var subtotal = 0;

            // Limpiar cualquier contenido previo del resumen de productos
            resumenProductos.empty();

            // Iterar sobre cada producto en el carrito
            carrito.forEach(function(producto) {

                var nombreAbreviado = producto.nombre.length > 10 ? producto.nombre.substring(0, 10) + '...' : producto.nombre;

                var filaProducto = $('<div class="producto-resumen"></div>');
                filaProducto.append('<img src="' + base_url + '/public/assets/img_tienda/productos/' + producto.imagen + '" >');
                filaProducto.append('<span class="nombre">' + nombreAbreviado + '</span>');

                var precioTotal = parseFloat(producto.precio) * parseInt(producto.cantidad);
                filaProducto.append('<span class="precio"> S/ ' + precioTotal.toFixed(2) + '</span>');

                // Agregar la fila al resumen de productos
                resumenProductos.append(filaProducto);

                // Calcular el subtotal sumando el precio de cada producto
                subtotal += parseFloat(precioTotal);
            });
            var descuento = <?php echo isset($descuento) ? $descuento : 0; ?>;


            var costoEnvio = 9.90;





            // Calcular el total aplicando el descuento si es mayor que 0
            var total = subtotal; // Inicializamos el total con el subtotal más el costo de envío
            if (descuento > 0) {
                var descuentoAplicado = total * (descuento / 100);
                total -= descuentoAplicado; // Restamos el descuento al total
            }

            total += costoEnvio;

            if (descuento > 0) {
                $('#descuento').text('Descuento: ' + descuento.toFixed(2) + '%');
                $('#descuento').show();
            } else {
                $('#descuento').hide();
            }

            // Mostrar el subtotal, costo de envío y total
            $('#subtotal').text(subtotal.toFixed(2));
            $('#costo-envio').text(costoEnvio.toFixed(2));
            $('#total').text(total.toFixed(2));


        }





        $('#dni').on('input', function() {
            var dni = $(this).val();

            // Realizar solicitud AJAX para obtener los datos del DNI
            $.ajax({
                url: '<?= base_url('checkout/getDNI_New') ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    dni: dni
                },
                success: function(response) {
                    console.log(response)
                    if (response.success) {
                        // Completar los campos de nombre y apellido con los datos obtenidos
                        $('#nombre').val(response.result.nombres);
                        $('#apellido').val(response.result.apellido_pat + ' ' + response.result.apellido_mat);
                    } else {
                        // Manejar el caso donde la consulta del DNI no fue exitosa
                        console.log('Error al consultar el DNI');
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar errores de la solicitud AJAX
                    console.error('Error al consultar el DNI:', error);
                }
            });
        });


        $('#departamento').change(function() {
            var departamentoId = $(this).val();
            if (departamentoId) {
                $.ajax({
                    url: '<?= base_url('checkout/obtenerProvincias/') ?>' + departamentoId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#provincia').empty();
                        $('#provincia').append('<option value="">Seleccionar provincia</option>');
                        $.each(data, function(key, value) {
                            $('#provincia').append('<option value="' + value.idProv + '">' + value.provincia + '</option>');
                        });
                    }
                });
            } else {
                $('#provincia').empty();
                $('#provincia').append('<option value="">Seleccionar provincia</option>');
            }
        });


        $('#provincia').change(function() {
            var provinciaId = $(this).val();
            if (provinciaId) {
                $.ajax({
                    url: '<?= base_url('checkout/obtenerDistritos/') ?>' + provinciaId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#distrito').empty();
                        $('#distrito').append('<option value="">Seleccionar distrito</option>');
                        $.each(data, function(key, value) {
                            $('#distrito').append('<option value="' + value.idDist + '">' + value.distrito + '</option>');
                        });
                    }
                });
            } else {
                $('#distrito').empty();
                $('#distrito').append('<option value="">Seleccionar distrito</option>');
            }
        });

        $('#distrito').change(function() {
            var distritoId = $(this).val();
            var distritoNombre = $('#distrito option:selected').text().toLowerCase();
            var provinciaNombre = $('#provincia option:selected').text().toLowerCase();
            var departamentoNombre = $('#departamento option:selected').text().toLowerCase();

            var costoEnvio = 15; // Default shipping cost

            // Check if the selected district is "San Miguel" in "Lima, Lima"
            if (distritoNombre === 'san miguel' && provinciaNombre === 'lima' && departamentoNombre === 'lima') {
                costoEnvio = 10;
            }

            $('#costo-envio').text(costoEnvio.toFixed(2));
            recalcularTotal();
        });

        function recalcularTotal() {
            var subtotal = parseFloat($('#subtotal').text());
            var descuento = parseFloat($('#descuento').text().replace('Descuento: ', '').replace('%', '')) || 0;
            var costoEnvio = parseFloat($('#costo-envio').text());

            var total = subtotal - (subtotal * (descuento / 100)) + costoEnvio;
            $('#total').text(total.toFixed(2));
        }


        function obtenerCarrito() {
            // Obtener el carrito del almacenamiento local
            var carritoGuardado = localStorage.getItem('carrito');

            // Convertir el string JSON a un objeto JavaScript
            var carrito = JSON.parse(carritoGuardado);

            return carrito;
        }


        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            var targetTab = $(e.target).attr("href"); // Pestaña activa
            var costoEnvio = 9.90;
            var tipoEntrega = '';

            if (targetTab === '#envio') {
                costoEnvio = 9.90;
                tipoEntrega = 'envio';
            } else if (targetTab === '#recojo') {
                costoEnvio = 0;
                tipoEntrega = 'recojo';
            }
            $('#tipo_entrega').val(tipoEntrega);

            $('#costo-envio').text(costoEnvio.toFixed(2));


            recalcularTotal();

            // Puedes agregar un console.log para verificar el tipo de entrega y su costo
            console.log('Tipo de entrega:', targetTab === '#envio' ? 'envio' : 'recojo');
            console.log('Costo de envío:', costoEnvio.toFixed(2));
        });

        // Función para recalcular el total u otras actualizaciones necesarias
        function recalcularTotal() {
            // Aquí puedes realizar cualquier cálculo adicional según los cambios de costoEnvio
            var subtotal = parseFloat($('#subtotal').text()); // Obtener el subtotal actual
            var descuento = parseFloat($('#descuento').text().replace('Descuento: ', '').replace('%', '')); // Obtener el descuento actual
            if (isNaN(descuento)) {
                descuento = 0;
            }

            // Calcular el total sumando el subtotal, aplicando descuento y sumando el costo de envío
            var total = subtotal - (subtotal * (descuento / 100)) + parseFloat($('#costo-envio').text());

            // Mostrar el total actualizado en la interfaz
            $('#total').text(total.toFixed(2));
        }


        $('.checkout-btn1').on('click', function() {
            // Obtener el carrito
            event.preventDefault();


            var tipoEntrega = $('#tipo_entrega').val();
            console.log(tipoEntrega);
            var costoEnvio = parseFloat($('#costo-envio').text())



            var carrito = obtenerCarrito();
            console.log('obteniendo', carrito)
            var formData = {
                dni: $('#dni').val(),
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                correo: $('#correo').val(),
                telefono: $('#telefono').val(),
                departamento: $('#departamento').val(),
                provincia: $('#provincia').val(),
                distrito: $('#distrito').val(),
                direccion: $('#direccion').val(),
                numero: $('#numero').val(),

                fecha_recojo: $('#fecha_recojo').val(),
                hora_recojo: $('#hora_recojo').val(),
                nombre_recojo: $('#nombre_recojo').val(),
                tipo_entrega: tipoEntrega,
                costo_envio: costoEnvio

            };

            var descuento = <?php echo isset($descuento) ? $descuento : 0; ?>;






            var regexDNI = /^[0-9]{8}$/;
            var regexNombreApellido = /^[a-zA-Z\s]+$/;
            var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var regexTelefono = /^[0-9]{9}$/;
            var regexDireccion = /^[a-zA-Z0-9\s,.#/-]+$/;
            var tabActive = $(".tab-pane.active").attr('id');


            



            if (!regexDNI.test(formData.dni)) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Por favor ingresa un DNI válido.',
                });
                return;
            }
            if (!regexNombreApellido.test(formData.nombre)) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Por favor ingresa un nombre válido.',
                });

                return;
            }
            if (!regexNombreApellido.test(formData.apellido)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Por favor ingresa un apellido válido.',
                });

                return;
            }
            if (!regexCorreo.test(formData.correo)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Por favor ingresa un correo electrónico válido.',
                });

                return;
            }
            if (!regexTelefono.test(formData.telefono)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Por favor ingresa un teléfono válido.',
                });
                return;
            }
            if (tabActive === 'envio') {
                if (formData.direccion.trim() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Por favor ingresa una dirección de envío.',
                    });
                    return;
                }
            }

            if (tabActive === 'recojo') {
                if (formData.fecha_recojo.trim() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Por favor ingresa una fecha de recojo.',
                    });
                    return;
                }

                if (formData.hora_recojo.trim() === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Por favor ingresa una hora de recojo.',
                    });
                    return;
                }
            }

            /*
            var camposTextoVacios = Object.values(formData).some(value => value === '');
            if (camposTextoVacios) {
                // Mostrar alerta con SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes completar todos los campos del formulario',
                });
                return;
            } */



            $.ajax({
                url: "<?php echo base_url('checkout/procesarPago') ?>",
                type: "POST",
                data: {
                    carrito: carrito,
                    formData: formData,
                    descuento: descuento
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Acceder a la ID de preferencia recibida en la respuesta
                        $('.checkout-btn').empty();
                        $('.otro_pago').empty();
                        $('.cotizar_pago').empty();
                        $('.izipay-btn-container').empty();



                        var preferenceId = response.preference_id;
                        var publickey = response.publickey;
                        console.log('publickey', publickey);

                        const mp = new MercadoPago(publickey);


                        mp.checkout({
                            preference: {
                                id: preferenceId
                            },
                            render: {
                                container: '.checkout-btn',
                                type: 'wallet',
                                label: 'Pagar con Mercado Pago',
                            }
                        });

                        var otroMedioDePagoButton = $('<button>', {
                            type: "submit",
                            class: "otro-medio-pago-button",
                            formmethod: "post",
                            text: "Otro medio de pago"
                        });

                        var cotizarButton = $('<button>', {
                            type: "submit",
                            class: "cotizar-button",
                            formmethod: "post",
                            text: "Cotizar"
                        });

                        var izipayBtn = $('<button>', {
                            type: "button",
                            class: "izipay-btn btn btn-primary",
                            text: "Pagar con Izipay"
                        });

                        $('.otro_pago').append(otroMedioDePagoButton);
                        $('.cotizar_pago').append(cotizarButton);

                        $('.otro-medio-pago-button').click(function() {

                            $('#imagenVoucher').val(null);
                            $('#imagenAdjuntaContainer').empty();
                            $('#otroMedioPagoModal').modal('show');
                        });



                        $('.cotizar-button').click(function() {

                            /*  $('#imagenVoucher').val(null);
                             $('#imagenAdjuntaContainer').empty();
                             $('#cotizarModal').modal('show'); */
                            var carrito = obtenerCarrito();
                            var file = $('#imagenVoucher')[0].files[0];
                            var carritoJSON = JSON.stringify(carrito);
                            var metodoPago = $('#metodoPago').val();
                            var formData = new FormData();
                            formData.append('dni', $('#dni').val());
                            formData.append('nombre', $('#nombre').val());
                            formData.append('apellido', $('#apellido').val());
                            formData.append('correo', $('#correo').val());
                            formData.append('telefono', $('#telefono').val());
                            formData.append('departamento', $('#departamento').val());
                            formData.append('provincia', $('#provincia').val());
                            formData.append('distrito', $('#distrito').val());
                            formData.append('direccion', $('#direccion').val());
                            formData.append('numero', $('#numero').val());
                            formData.append('imagenVoucher', file);
                            formData.append('metodoPago', metodoPago);
                            formData.append('carrito', carritoJSON);

                            console.log('aqui cotizazción', carritoJSON)

                            $.ajax({
                                url: "<?php echo base_url('checkout/guardarCotizacion') ?>",
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                dataType: 'json',
                                success: function(response) {
                                    if (response.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Cotizacion exitosa!',
                                            text: 'La Cotizacion se ha guardado correctamente.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(function() {
                                            // Redirigir al usuario a la página de confirmación
                                            window.location.href = "<?php echo base_url('checkout/cotizacionexitosa'); ?>";
                                        });

                                    } else {
                                        // Mostrar alerta de error
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: response.message
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error en la solicitud AJAX:', status, error);
                                }
                            });


                        });



                        $('.izipay-btn-container').append(izipayBtn);

                    } else {
                        alert("Error al procesar el pago: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);

                    alert("Error en la solicitud AJAX: " + error);
                }
            });





        });

        $('#guardarCompra').click(function() {

            var tipoEntrega = $('#tipo_entrega').val();
            console.log(tipoEntrega);
            var costoEnvio = parseFloat($('#costo-envio').text())



            var carrito = obtenerCarrito();
            var file = $('#imagenVoucher')[0].files[0];
            var carritoJSON = JSON.stringify(carrito);
            var metodoPago = $('#metodoPago').val();

            var ubicacionRecojo = $('#ubicacion_recojo').val(); // Obtener el valor del campo de ubicación de recojo
            var fechaRecojo = $('#fecha_recojo').val(); // Obtener el valor del campo de fecha de recojo
            var horaRecojo = $('#hora_recojo').val(); // Obtener el valor del campo de hora de recojo
            var nombreRecojo = $('#nombre_recojo').val();
            $(this).prop('disabled', true);
            // Crear un nuevo objeto FormData
            var formData = new FormData();
            formData.append('dni', $('#dni').val());
            formData.append('nombre', $('#nombre').val());
            formData.append('apellido', $('#apellido').val());
            formData.append('correo', $('#correo').val());
            formData.append('telefono', $('#telefono').val());
            formData.append('departamento', $('#departamento').val());
            formData.append('provincia', $('#provincia').val());
            formData.append('distrito', $('#distrito').val());
            formData.append('direccion', $('#direccion').val());
            formData.append('numero', $('#numero').val());
            formData.append('imagenVoucher', file);
            formData.append('metodoPago', metodoPago);
            formData.append('carrito', carritoJSON);

            // Añadir los nuevos campos para recojo
            formData.append('ubicacion_recojo', ubicacionRecojo);
            formData.append('fecha_recojo', fechaRecojo);
            formData.append('hora_recojo', horaRecojo);
            formData.append('nombre_recojo', nombreRecojo);
            formData.append('tipo_entrega', tipoEntrega);
            formData.append('costo-envio', costoEnvio);

            // Realizar la llamada AJAX
            $.ajax({
                url: "<?php echo base_url('checkout/guardarCompra') ?>",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Compra exitosa!',
                            text: 'La compra se ha guardado correctamente.',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            // Redirigir al usuario a la página de confirmación
                            window.location.href = "<?php echo base_url('checkout/confirmation'); ?>";
                        });

                    } else {
                        // Mostrar alerta de error
                        // Mostrar alerta de error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                        // Habilitar el botón "Guardar"
                        $('#guardarCompra').prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                }
            });
        });



        $('.izipay-btn-container').on('click', '.izipay-btn', function(event) {
            event.preventDefault();


            // Obtener el contenido del span dentro del div con clase "total" usando jQuery
            var total = $('#total').text().trim();

            // Convertir el total a un número flotante si es necesario
            var totalFloat = parseFloat(total);


            console.log('Total:', totalFloat);

            // Obtener los datos necesarios para la transacción
            var carrito = obtenerCarrito();
            var formData = {
                amount: totalFloat,
                dni: $('#dni').val(),
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                correo: $('#correo').val(),
                telefono: $('#telefono').val(),
                departamento: $('#departamento').val(),
                provincia: $('#provincia').val(),
                distrito: $('#distrito').val(),
                direccion: $('#direccion').val(),
                numero: $('#numero').val(),
                fecha_recojo: $('#fecha_recojo').val(),
                hora_recojo: $('#hora_recojo').val(),
                nombre_recojo: $('#nombre_recojo').val(),
                tipo_entrega: $('#tipo_entrega').val(),
                costo_envio: parseFloat($('#costo-envio').text()),
                carrito: carrito
            };

            console.log(carrito);


            $.ajax({
                url: "<?php echo base_url('payment/getToken') ?>",
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(response) {
                    console.log(response);


                    if (response.success) {
                        var formToken = response.data.formToken;
                        var paymentUrl = "<?php echo base_url('tienda/payment_form') ?>";


                        var redirectUrl = paymentUrl + "?formToken=" + formToken + "&formData=" + encodeURIComponent(JSON.stringify(response.data.formData));

                        // Redirigir a la página de formulario de pago
                        window.location.href = redirectUrl;
                    } else {
                        console.error('Error al obtener el token de pago.');
                    }


                },
                error: function(xhr, status, error) {
                    console.error('Error al realizar la solicitud AJAX:', error);
                }
            });

        });






        $('#imagenVoucher').change(function() {
            // Obtener el archivo seleccionado
            var file = this.files[0];

            // Verificar si se seleccionó un archivo
            if (file) {
                // Crear un objeto de tipo FileReader
                var reader = new FileReader();

                // Configurar la función de carga de la imagen
                reader.onload = function(e) {
                    // Crear un elemento <img> y establecer la fuente como la imagen cargada
                    var img = $('<img>').attr('src', e.target.result).css('max-width', '350px'); // Establecer el ancho máximo

                    // Mostrar la imagen en el contenedor
                    $('#imagenAdjuntaContainer').html(img);
                };

                // Leer el contenido del archivo como una URL de datos
                reader.readAsDataURL(file);
            }
        });
        // Función para manejar el cambio en el estado del checkbox
        $('#agregarVoucher').change(function() {
            // Verificar si el checkbox está marcado
            var isChecked = $(this).is(':checked');

            // Habilitar o deshabilitar el botón "Guardar" según el estado del checkbox
            $('#guardarCompra').prop('disabled', !isChecked);
        });



        cargarProductosCarrito();




    });
</script>




<?php echo $this->endSection(); ?>