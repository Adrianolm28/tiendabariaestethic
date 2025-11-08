<?= $this->extend('layouts/layout'); ?>
<?php echo $this->section('contenido'); ?>
<style>
    /* Estilo para todos los campos de entrada */
    input[type="text"],
    input[type="email"],
    select.form-control {
        border-radius: 10px;
        /* Radio del borde */
    }

    .line-reclamo1 {
        width: 50%;
        height: 2px;
        background-color: #0097fe;
    }

    .txt-reclamo {
        color: #4a6d90;
        font-size: 15px;
        font-weight: 300;
        text-align: justify;
        margin: 10px 0px 10px 0px;
    }
</style>




<div class="swiper">

    <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="https://lolotec.pe/front/images/reclamation-book.jpg" alt=""></div>

    </div>





</div>

<hr>

<div class="container mt-4">
    <h2>Datos</h2>
    <form>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label style="color: #0067a0;">Razón Social:</label>
                    <label id="razon_social"><?= $configtienda[0]['razon_social'] ?></label>
                </div>
                <div class="form-group">
                    <label style="color: #0067a0;">RUC:</label>
                    <label id="ruc"><?= $configtienda[0]['ruc'] ?></label>
                </div>
                <div class="form-group">
                    <label style="color: #0067a0;">Dirección:</label>
                    <label id="direccion"><?= $configtienda[0]['direccion'] ?></label>
                </div>
            </div>
            <p style="color: #0067a0;">Conforme a lo establecido en el Código de Protección y Defensa del Consumidor, <span> <?= $configtienda[0]['razon_social'] ?></span> cuenta con un Libro de Reclamaciones Virtual a su disposición. Por favor ingrese los datos requeridos en el formulario.</p>
        </div>
        
    </form>
</div>


<div class="container mt-4">



    <div class="row">
        <h3>Datos de contacto del consumidor reclamante</h3>

        <div class="col-md-12">


            <form id="formulario_reclamacion" name="formulario_reclamacion" action="<?= base_url('admin/lreclamaciones/store') ?>" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombres">Nombres:</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo_documento">Tipo de documento:</label>
                            <select class="form-control" id="tipo_documento" name="tipo_documento" required>
                                <option value="">Seleccionar</option>
                                <option value="DNI">DNI</option>
                                <option value="Carnet de extranjería">Carnet de extranjería</option>
                                <!-- Agrega más opciones según sea necesario -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="numero_documento">Número de documento:</label>
                            <input type="text" class="form-control" id="numero_documento" name="numero_documento" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo electrónico:</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono celular:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="departamento">Departamento:</label>
                            <input type="text" class="form-control" id="departamento" name="departamento" required>
                        </div>
                        <div class="form-group">
                            <label for="provincia">Provincia:</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" required>
                        </div>
                        <div class="form-group">
                            <label for="distrito">Distrito:</label>
                            <input type="text" class="form-control" id="distrito" name="distrito" required>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>
                </div>

                <h3>Detalle de la solicitud</h3>
                <hr>

                <div class="txt-reclamo"><strong>¿Qué es una queja?</strong> Es una disconformidad frente a una mala atención del proveedor, pero que no guarda relación directa con el producto o servicio adquirido.</div>

                <div class="txt-reclamo"><strong>¿Qué es un reclamo?</strong> Se produce cuando no estás conforme con el producto adquirido o servicio brindado. El proveedor tiene la obligación de darte una respuesta.</div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombres">Tipo de solicitud:</label>
                            <input type="text" class="form-control" id="t_solicitud" name="nombres" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Detalle del producto:</label>
                            <input type="text" class="form-control" id="d_producto" name="d_producto" required>
                        </div>


                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="departamento">Número de pedido:</label>
                            <input type="text" class="form-control" id="n_pedido" name="n_pedido" required>
                        </div>
                        <div class="form-group">
                            <label for="provincia">Detalle de la solicitud :</label>
                            <input type="text" class="form-control" id="d_solicitud" name="d_solicitud" required>
                        </div>

                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Enviar reclamación</button>
            </form>

        </div>
    </div>
</div>



<br>

<script>
    $(document).ready(function() {


        $('#formulario_reclamacion').on('submit', function(event) {
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
                    if (res.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado Exitosamente',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(() => {
                            // Cerrar el modal después del éxito

                            limpiarCamposFormulario();

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

        function limpiarCamposFormulario() {
            $('#formulario_reclamacion input[type="text"]').val('');
            $('#formulario_reclamacion input[type="email"]').val('');
        }


    });
</script>

<?php echo $this->endSection(); ?>