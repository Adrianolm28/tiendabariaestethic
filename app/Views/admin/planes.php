<section class="blog">
    <div class="container">
        <?php
       /*  echo  "<pre>";
        print_r($planes['0']['features']); */

        ?>
    </div>
</section>


<section class="blog">
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button class="btn btn-primary " type="button" onclick="$('#myModal').modal('show');">
            Registrar Nuevo +
        </button>


    </div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crear nueva Tabla</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <form id="packageForm">

                    <div class="card-body">
                        <input type="text" id="nombre" placeholder="Nombre de la tabla">
                        <input type="text" id="precio" placeholder="Precio">
                        <!-- Otros campos del package según tus necesidades -->

                    </div>


                </form>

                <div class="modal-footer">
                    <button type="submit" id="btnGuardar" class="btn btn-success btn-pill"><i class="fa fa-save"></i> Guardar datos</button>
                    <button type="button" class="btn btn-danger btn-pill" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>



    <div class="container-precio">

        <div class="top">
            <div class="blog-head">
                <h2>Conoce nuestros Planes a tu medida!</h2>
                <div class="blog-vic">

                </div>
            </div>
            <div class="toggle-btn">
                <span style="margin: 0.8em;">Anual</span>
                <label class="switch">
                    <input type="checkbox" id="checbox" onclick="check()" ; />
                    <span class="slider round"></span>
                </label>
                <span style="margin: 0.8em;">Mensual</span>
            </div>
        </div>

        <div class="package-container">
            <?php foreach ($planes as $plan) : ?>
                <div class="packages">
                    <h1 id="titulo-plan" class="titulo-banner"><?= $plan['product']; ?></h1>
                    <h2 class="text1"><?= $plan['new_price']; ?></h2>
                    <h2 class="text2"><?= $plan['old_price']; ?></h2>
                    <span>+IGV / Mensual</span>
                    <ul class="list-precio">
                        <?php
                        $featuresArray = explode("|", $plan['features']);
                        $packageId = $plan['id'];

                        foreach ($featuresArray as $index => $feature) :
                        ?>
                            <li>
                                <input id="editedData-<?= $packageId ?>-<?= $index ?>" type="text" class="editable-input" name="editedData[]" data-editable="features" data-id="<?= $packageId ?>" value="<?= $feature; ?>">
                                <input type="hidden" name="editedIndex" value="<?= $index ?>">
                                <!-- Agrega un botón o enlace para eliminar el input -->
                                <button style="border:none;" class="eliminar-elemento" data-package-id="<?= $packageId ?>" data-element="<?= $feature ?>" data-element-index="<?= $index ?>" type="button">
                                    <i style="color: red;" class="fas fa-trash"></i>
                                </button>


                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <!-- Botón "Añadir Nuevo" -->
                    <!-- <button class="agregar-campo">Añadir Nuevo</button> -->
                    <!-- Formulario individual para cada conjunto de campos de entrada -->
                    <form id="addFeatureForm" action="<?= site_url('admin/planes/guardarDatos'); ?>" method="POST">
                        <input type="hidden" name="action" value="add"> <!-- Cambia esto a "add" -->
                        <input type="hidden" name="packageId" value="<?= $packageId ?>">
                        <input type="text" class="edit-input" name="nuevoDato[]">
                        <button type="submit" class="guardar-nuevo-dat">Guardar</button>
                    </form>

                </div>
            <?php endforeach; ?>
        </div>


    </div>

    </div>
</section>
<script>
    $(document).ready(function() {
        $(".eliminar-elemento").click(function() {
            // Obtén el identificador del paquete y el índice del elemento
            var packageId = $(this).data("package-id");
            var elementIndex = $(this).data("element-index");
            var featureElement = $(this).closest('li');

            // Muestra un cuadro de diálogo de confirmación antes de eliminar el elemento
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará el elemento. ¿Estás seguro de que quieres continuar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Elimina visualmente el elemento del DOM
                    featureElement.remove();

                    // Envía una solicitud AJAX para eliminar el elemento en el servidor
                    $.ajax({
                        type: "POST",
                        url: '<?= site_url('admin/planes/eliminarDato'); ?>',
                        data: {
                            packageId: packageId,
                            elementIndex: elementIndex
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                Swal.fire('Eliminado', 'Elemento eliminado con éxito', 'success');
                            } else {
                                Swal.fire('Error', 'Error al eliminar el elemento', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Error al eliminar el elemento', 'error');
                        }
                    });
                }
            });
        });
    });

    
</script>