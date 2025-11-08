<?php include("admin_header.php")  ?>

<style>
#updateDescuentoTrans {
    max-width: 90px;
    /* Ajusta el ancho del campo de entrada */
}
</style>

<section class="content">
    <link rel="stylesheet" href="<?= base_url('public/assets/tienda/css/multi_imagen.css') ?>">


    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Productos</h3>



                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-primary" id="btnAbrirModal">Crear Nuevo
                                Producto</button>
                        </div>

                        <button type="button" class="btn btn-primary" id="btnAbrirModalAPI">Productos Valeapp</button>

                        <div class="modal fade" id="crearProductoModal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Agregar Nuevo Producto</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <div class="modal-body">
                                        <form method="post" action="<?php echo site_url('admin/productos/store'); ?>"
                                            id="addProducto" name="addProducto" enctype="multipart/form-data">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs">

                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#datos">Datos del
                                                        Producto</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#imagenes">Imágenes del
                                                        Producto</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#video">Video</a>
                                                </li>
                                            </ul>

                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <!-- Datos del Producto -->
                                                <div id="datos" class="tab-pane active">
                                                    <div id="messageContainer"></div>


                                                    <!-- Campos de datos del producto -->
                                                    <input type="hidden" id="id_producto" name="id_producto">
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1">Nombre</label>
                                                                <input type="text" class="form-control" name="nombre"
                                                                    id="nombre" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1">Descripcion</label>
                                                                <input type="text" class="form-control"
                                                                    name="descripcion" id="descripcion" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">características</label>
                                                            <textarea class="form-control" name="caracteristicas"
                                                                id="caracteristicas" placeholder="" rows="4"
                                                                autocomplete="off">-</textarea>
                                                        </div>
                                                        <div class="row">

                                                            <div class="form-group col-md-3">
                                                                <label for="exampleInputEmail1">Precio anterior:</label>
                                                                <input type="text" class="form-control"
                                                                    name="precio_anterior" id="precio_anterior"
                                                                    placeholder="">
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label for="exampleInputEmail1">Precio:</label>
                                                                <input type="text" class="form-control" name="precio"
                                                                    id="precio" placeholder="">
                                                            </div>

                                                            <div class="form-group col-md-2">
                                                                <label for="exampleInputEmail1">Precio T:</label>
                                                                <input type="text" class="form-control"
                                                                    name="precio_transferencia"
                                                                    id="precio_transferencia" placeholder="">
                                                            </div>

                                                            <div class="form-group col-md-2">
                                                                <label for="exampleInputEmail1">Descuento %:</label>
                                                                <input type="text" class="form-control"
                                                                    name="producto_descuento" id="producto_descuento"
                                                                    placeholder="">
                                                            </div>

                                                            <div class="form-group col-md-2">
                                                                <label for="precio_descuento">Precio con
                                                                    descuento:</label>
                                                                <input type="text" class="form-control"
                                                                    name="precio_descuento" id="precio_descuento"
                                                                    placeholder="" readonly>
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label for="marca">Marca:</label>
                                                                <select class="form-control" id="marca" name="marca">
                                                                    <option value="">--Marca--</option>
                                                                    <?php foreach ($marcas as $marca) : ?>
                                                                    <option value="<?= $marca['id_marca'] ?>">
                                                                        <?= $marca['nombre'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-3">
                                                                <label for="exampleInputEmail1">Modelo:</label>
                                                                <input type="text" class="form-control" name="modelo"
                                                                    id="modelo" placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="categoria">Categoría:</label>
                                                                <select class="form-control" id="categoria_producto"
                                                                    name="categoria_producto">
                                                                    <option value="">--Categorias--</option>
                                                                    <?php foreach ($categorias as $cat) : ?>
                                                                    <option value="<?= $cat['id_categoria'] ?>">
                                                                        <?= $cat['nombre'] ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="subcategoria_producto">Sub
                                                                    Categoría:</label>
                                                                <select class="form-control" id="subcategoria_producto"
                                                                    name="subcategoria_producto">
                                                                    <option value="">--Sub categorias--</option>
                                                                    <!-- Opciones de subcategorías se llenarán dinámicamente con JavaScript -->
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="exampleInputEmail1">Costo Pro:</label>
                                                                <input type="number" class="form-control"
                                                                    name="costo_producto" id="costo_producto"
                                                                    placeholder="">
                                                            </div>
                                                            <div class="form-group col-md-2">
                                                                <label for="exampleInputEmail1">Stock:</label>
                                                                <input type="number" class="form-control" name="stock"
                                                                    id="stock" placeholder="stock">
                                                            </div>

                                                            <div class="form-group col-md-2">
                                                                <label for="delivery">Delivery</label>
                                                                <select class="form-control" name="delivery"
                                                                    id="delivery">
                                                                    <option value="1" selected>SI</option>
                                                                    <option value="0" selected>NO</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-4">
                                                                <label for="manual_pdf">Especificaciones
                                                                    Técnicas:</label>
                                                                <input type="file" class="form-control-file"
                                                                    id="manual_pdf" name="manual_pdf">
                                                                <div id="pdf_nombre_container" style="margin-top:5px;">
                                                                    <!-- Aquí se mostrará el nombre del PDF y la X para eliminar -->
                                                                </div>
                                                            </div>




                                                        </div>


                                                        <!-- <div class="fileupload fileupload-new" data-provides="fileupload">

                                                            <div class="fileupload-preview fileupload-exists thumbnail" id="lim" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                            <div>


                                                                <input type="hidden" name="imagen_actual" id="imagen_actual" value="dddd">
                                                                <label class="btn btn-primary btn-file">
                                                                    <i class="glyphicon glyphicon-cloud-upload"></i> Seleccione imagen [+]
                                                                    <input type="file" accept=".jpg, .jpeg, .png" name="imagen_producto" id="imagen_producto" style="display: none;">
                                                                </label>


                                                            </div>
                                                        </div> -->





                                                    </div>

                                                </div>

                                                <!-- Imágenes del Producto -->
                                                <div id="imagenes" class="tab-pane fade">
                                                    <div class="card-body">
                                                        <div class="drag-area">
                                                            <span class="visible">
                                                                Arratas y Soltar imagen
                                                                <span class="select" role="button"></span>
                                                            </span>

                                                            <input name="file[]" id="imagenes_input" type="file"
                                                                class="file" multiple />

                                                        </div>

                                                        <!-- IMAGE PREVIEW CONTAINER -->
                                                        <div class="container_p"></div>


                                                    </div>
                                                </div>
                                                <div id="video" class="tab-pane fade">
                                                    <div class="card-body">

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-md-3">
                                                                    <label for="producto_video"
                                                                        class="control-label">producto
                                                                        video(url):</label>
                                                                </div>

                                                                <div class="col-md-9">
                                                                    <input type="url" autocomplete="off"
                                                                        class='input-small input-square form-control'
                                                                        name="producto_video" id="producto_video"
                                                                        value="">

                                                                </div>
                                                            </div>


                                                            <div class="col-md-12">
                                                                <hr>
                                                                <div class="embed-responsive embed-responsive-16by9">


                                                                    <iframe id="iframeVideo" width="560" height="315"
                                                                        src="" title="YouTube video player"
                                                                        frameborder="0"
                                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                                        allowfullscreen></iframe>
                                                                </div>
                                                            </div>





                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" id="btnGuardar"
                                                    class="btn btn-success btn-pill"><i class="fa fa-save"></i> Guardar
                                                    datos</button>
                                                <button type="button" class="btn btn-danger btn-pill"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        </div>


                        <div class="modal fade" id="crearProductoModalApi">

                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <!-- <?php
                                            echo "<pre>";
                                            print_r($productosApi);
                                            ?> -->
                                    <div class="modal-header">
                                        <h4 class="modal-title"></h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex justify-content-end mb-3">
                                            <button id="btnEnviarProductos" class="btn btn-primary">Agregar
                                                Producto</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="productosApi" class="table table-striped table-bordered"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th><input type="checkbox" id="checkTodos"></th>
                                                        <th>ID</th>
                                                        <th>Código</th>
                                                        <th>Nombre</th>
                                                        <th>Precio</th>
                                                        <th>Descripción</th>
                                                        <th>Stock</th>
                                                        <!--                                                         <th>Delivery</th>
 -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($productosApi['productos'] as &$producto) : ?>
    <?php
    // Validar la clave 'producto_descripcion' para evitar error de array indefinido
    if (!isset($producto['producto_descripcion']) || empty($producto['producto_descripcion'])) {
        $producto['producto_descripcion'] = 'Descripción no disponible';
    }
    ?>
    <tr>
        <td><input type="checkbox" class="check-producto" data-id="<?= $producto['producto_id'] ?>"></td>
        <td><?= $producto['producto_id'] ?></td>
        <td><?= $producto['codigo'] ?></td>
        <td><?= $producto['producto_nombre'] ?></td>
        <td>
            <select class="select-precio">
                <?php foreach ($producto['unidad_precio'] as $unidadPrecio) : ?>
                    <option value="<?= $unidadPrecio['precio'] ?>">
                        <?= $unidadPrecio['precio'] ?> (<?= $unidadPrecio['nombre_unidad'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </td>
        <td><?= $producto['producto_descripcion'] ?></td>
        <td><input type="number" class="input-cantidad" value="<?= isset($producto['stock_total']['cantidad']) ? $producto['stock_total']['cantidad'] : 0 ?>" min="0"></td>
    </tr>
<?php endforeach; ?>
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="input-group desc_trans">
                                <input type="number" id="updateDescuentoTrans" class="form-control " step="0.01"
                                    value="0">
                                <button id="aplicarDescuento" class="btn btn-primary btn-sm">Desc %</button>

                            </div>



                            <div class="table-responsive">

                                <table id="productosTable" class="table table-bordered table-striped">



                                    <thead>

                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th class="text-center">Imagen</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Características</th>
                                            <th class="text-center">Precio</th>
                                            <th class="text-center">Precio anterior</th>
                                            <th class="text-center">Precio T. </th>
                                            <th class="text-center">Descuento Trans.</th>
                                            <th class="text-center">Marca</th>
                                            <th class="text-center">Modelo</th>
                                            <th class="text-center">Categoría</th>
                                            <th class="text-center">stock</th>
                                            <th class="text-center">Delivery</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center" width="280px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
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
/* ESCRIBI DESCUENTO */

// Obtener referencias a los elementos
const precioInput = document.getElementById('precio');
const descuentoInput = document.getElementById('producto_descuento');
const precioDescuentoInput = document.getElementById('precio_descuento');

// Función para calcular el precio con descuento
function calcularDescuento() {
    const precio = parseFloat(precioInput.value) || 0; // Convertir a número
    const descuento = parseFloat(descuentoInput.value) || 0; // Convertir a número

    if (precio > 0 && descuento >= 0) {
        const precioConDescuento = precio - (precio * (descuento / 100));
        precioDescuentoInput.value = precioConDescuento.toFixed(2); // Mostrar con 2 decimales
    } else {
        precioDescuentoInput.value = ''; // Limpiar si no es válido
    }
}

// Escuchar cambios en los inputs
precioInput.addEventListener('input', calcularDescuento);
descuentoInput.addEventListener('input', calcularDescuento);
</script>



<script>
let productosTable;




function reordenar_imagen() {
    $('.container_p').sortable({
        tolerance: 'pointer',
        update: function(event, ui) {
            var nuevoOrden = [];
            $('.container_p .image').each(function(index) {
                var idImagen = $(this).data('id-imagen');
                var idProducto = $(this).data('id-producto');
                nuevoOrden.push({
                    id_imagen: idImagen,
                    id_producto: idProducto,
                    orden: index
                });
            });
            console.log('Nuevo orden de imágenes:', nuevoOrden);


            $.ajax({
                url: '<?php echo base_url('productos/ordenar_imagenproducto'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    nuevoOrden: nuevoOrden
                },
                success: function(response) {
                    console.log(response);
                    actualizarPortada();
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        }
    });
}

function actualizarPortada() {
    $('.container_p .image').removeClass('portada').css('border', '1px dashed red');
    $('.container_p .image:first-child').addClass('portada').css('border', '3px dashed green');
}

function selectSubcategoria(categoriaId, subcategoriaId) {
    // Realizar la solicitud AJAX para obtener subcategorías de una categoría específica
    $.ajax({
        url: '<?php echo base_url('productos/obtenerSubcategorias'); ?>',
        type: 'post',
        dataType: 'json',
        data: {
            categoria_id: categoriaId
        },
        success: function(response) {
            console.log(response);
            $('#subcategoria_producto').empty();
            $('#subcategoria_producto').append('<option value="">--Sub categorias--</option>');

            if (response.status) {
                $.each(response.data, function(key, value) {
                    var selected = (value.id_subcategoria == subcategoriaId) ? 'selected' : '';
                    $('#subcategoria_producto').append('<option value="' + value.id_subcategoria +
                        '" ' + selected + '>' + value.nombre + '</option>');
                });
            } else {
                console.log('Error al obtener las subcategorías');
            }
        },
        error: function(xhr, status, error) {
            // Manejar errores de la solicitud AJAX
            console.error('Error en la solicitud AJAX:', status, error);
        }
    });
}



$(document).ready(function() {

    reordenar_imagen();

    $('#productosApi').DataTable();

    $('#aplicarDescuento').click(function() {
        var descuento = parseFloat($('#updateDescuentoTrans').val());

        // Validar que el descuento no sea NaN
        if (isNaN(descuento) || descuento < 0) {
            alert('Por favor, introduce un porcentaje de descuento válido.');
            return;
        }

        // Actualizar los valores en la columna "Descuento Trans."
        $('#productosTable').DataTable().rows().every(function() {
            var row = this.node();
            // Encontrar la celda de la columna de descuento
            $(row).find('td:eq(8)').text(descuento.toFixed(2) + '%');
        });
    });


    $('#categoria_producto').change(function() {
        var categoriaId = $(this).val();

        // Realizar la solicitud AJAX para obtener subcategorías
        $.ajax({
            url: '<?php echo base_url('productos/obtenerSubcategorias'); ?>',
            type: 'post',
            dataType: 'json',
            data: {
                categoria_id: categoriaId
            },
            success: function(response) {
                console.log(response);
                $('#subcategoria_producto').empty();
                $('#subcategoria_producto').append(
                    '<option value="">--Sub categorias--</option>');


                if (response.status) {
                    $.each(response.data, function(key, value) {
                        $('#subcategoria_producto').append('<option value="' + value
                            .id_subcategoria + '">' + value.nombre + '</option>'
                        );
                    });
                } else {

                    console.log('Error al obtener las subcategorías');
                }
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error('Error en la solicitud AJAX:', status, error);
            }
        });
    });


    $('#checkTodos').change(function() {
        $('.check-producto').prop('checked', $(this).prop('checked')).trigger('change');
    });


    var productosSeleccionados = [];

    // Checkbox de fila
    $('#productosApi').on('change', '.check-producto', function() {
        var producto_id = $(this).data('id');
        var codigo = $(this).closest('tr').find('td:nth-child(3)').text();
        var nombre = $(this).closest('tr').find('td:nth-child(4)').text();
        var descripcion = $(this).closest('tr').find('td:nth-child(6)').text().trim();
        var caracteristicas = null;
        var precio = $(this).closest('tr').find('.select-precio').val();
        var cantidad = $(this).closest('tr').find('.input-cantidad').val();



        if ($(this).is(':checked')) {
            // Agregar el producto seleccionado al array de productos seleccionados
            productosSeleccionados.push({
                producto_id: producto_id,
                codigo: codigo,
                nombre: nombre,
                descripcion: descripcion,
                caracteristicas: caracteristicas,
                precio: precio,
                cantidad: cantidad
            });
        } else {
            // Remover el producto deseleccionado del array de productos seleccionados
            productosSeleccionados = productosSeleccionados.filter(function(producto) {
                return producto.producto_id !== producto_id;
            });
        }

        // Imprimir el array de productos seleccionados en la consola
        console.log('Productos seleccionados:', productosSeleccionados);
    });



    $('#productosTable').DataTable({
        "ajax": {
            "url": "<?php echo base_url('productos/getProductosAdmin'); ?>",
            "type": "POST",
            "dataSrc": "data",
            "error": function(xhr, error, thrown) {
                console.error('DataTables AJAX error:', xhr.responseText);
                alert('Error en la carga de productos: ' + xhr.status + ' - ' + xhr.statusText);
            }
        },
        "order": [
            [0, "desc"] // Ordenar por la primera columna (índice 0) de forma descendente
        ],
        "columns": [{
                "data": "id_producto"
            },
            {
                "data": "imagen_producto",
                "render": function(data, type, row) {
                    return '<img src="<?php echo base_url('public/assets/img_tienda/productos/'); ?>' +
                        data + '" style="width: 50px;">';
                }
            },
            {
                "data": "nombre"
            },
            {
                "data": "descripcion",
                "render": function(data, type, row) {
                    return data.substring(0, 20); // Limitar a las primeras 10 letras
                }
            },
            {
                "data": "caracteristicas",
                "render": function(data, type, row) {
                    return data.substring(0, 20); // Limitar a las primeras 10 letras
                }
            },
            {
                "data": "precio"
            },
            {
                "data": "precio_anterior"
            },
            {
                "data": "precio_transferencia"
            },
            {
                "data": "descuento_transferencia",
                "render": function(data, type, row) {

                    return data ? data + '%' : '';
                }
            },
            {
                "data": "marca"
            },
            {
                "data": "modelo"
            },
            {
                "data": "categoria_producto"
            },
            {
                "data": "stock"
            },
            {
                "data": "delivery",
                "render": function(data, type, row) {
                    var deliveryValue = (data === null || data === undefined) ? 0 : data;
                    var deliveryHtml = '';
                    if (deliveryValue == 1) {
                        deliveryHtml = '<span class="badge bg-primary">SI</span>';
                    } else {
                        deliveryHtml = '<span class="badge bg-secondary">NO</span>';
                    }
                    return deliveryHtml;
                }
            },
            {
                "data": "estado",
                "render": function(data, type, row) {
                    var estadoHtml = '';
                    if (data == 1) {
                        estadoHtml = '<span class="me-1 badge bg-success">Activo</span>';
                    } else {
                        estadoHtml = '<span class="me-1 badge bg-danger">Inactivo</span>';
                    }
                    return estadoHtml;
                }
            },
            {
                "data": null,
                "render": function(data, type, row) {
                    var editIcon = '<i class="fas fa-edit"></i>';
                    var trashIcon = '<i class="fas fa-trash-alt"></i>';
                    var deleteIcon = '<i class="fas fa-times"></i>'; // Ícono de eliminar definitivo
                    var btnClass = (row.estado == 1) ? 'btn-danger' : 'btn-success';
                    return '<div class="d-flex justify-content-center gap-2">' +
                        '<button class="btn btn-primary btn-pill btn-sm btn-editar mx-1" data-id="' + row.id_producto + '" title="Editar">' + editIcon + '</button>' +
                        '<button class="btn ' + btnClass + ' btn-pill btn-sm btn-desactivar mx-1" data-id="' + row.id_producto + '" data-estado="' + row.estado + '" title="Desactivar/Activar">' + trashIcon + '</button>' +
                        '<button class="btn btn-danger btn-pill btn-sm btn-eliminar mx-1" data-id="' + row.id_producto + '" title="Eliminar producto">' + deleteIcon + '</button>' +
                        '</div>';
                }
            }
        ]
    });


    $('#btnAbrirModal').click(function() {


        limpiarModal();
        $('#crearProductoModal .modal-title').text('Agregar Nuevo Producto'); // <-- Cambia el título
        $('#crearProductoModal').modal('show');


    });

    $('#btnAbrirModalAPI').click(function() {
        $('#crearProductoModalApi').modal('show');
    });


    $('#btnEnviarProductos').click(function() {



        // Realizar la solicitud AJAX
        $.ajax({
            url: '<?php echo base_url('productos/guardarProductosSeleccionados'); ?>',
            type: 'POST',
            data: {
                productosSeleccionados: productosSeleccionados,

            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Mostrar un mensaje de éxito con SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message
                    });
                    $('#crearProductoModalApi').modal('hide');
                    location.reload();
                } else {
                    // Mostrar un mensaje de error con SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al guardar los productos. Por favor, inténtalo de nuevo.'
                    });
                }
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                alert('Error en la solicitud AJAX');
            }
        });
    });






    function obtenerIdDeVideoYoutube(url) {
        var videoId = url.split('v=')[1];
        var ampersandPosition = videoId.indexOf('&');
        if (ampersandPosition != -1) {
            videoId = videoId.substring(0, ampersandPosition);
        }
        return videoId;
    }


    // Capturar clic en el botón de editar
    $(document).on('click', '.btn-editar', function() {
        var idProducto = $(this).data('id');
        console.log(idProducto);
        /*  limpiarModal(); */
        $.ajax({
            url: '<?php echo base_url('admin/productos/edit/'); ?>' + idProducto,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                /* console.log(response); */

                $('#id_producto').val(response.producto.id_producto);
                $('#nombre').val(response.producto.nombre);
                $('#descripcion').val(response.producto.descripcion);
                $('#caracteristicas').val(response.producto.caracteristicas);
                $('#precio_anterior').val(response.producto.precio_anterior);
                $('#precio_transferencia').val(response.producto.precio_transferencia);
                $('#precio').val(response.producto.precio);
                $('#marca').val(response.producto.marca);
                $('#modelo').val(response.producto.modelo);

                $('#categoria_producto').val(response.producto.categoria_producto);
                /*  $('#subcategoria_producto').val(response.producto.id_subcategoria);  */

                $('#producto_video').val(response.producto.producto_video);
                $('#producto_descuento').val(response.producto.producto_descuento);
                $('#costo_producto').val(response.producto.costo_producto);
                $('#stock').val(response.producto.stock);


                $('#categoria_producto').trigger('change');


                $('#subcategoria_producto').val(response.producto.id_subcategoria);


                $('#crearProductoModal .modal-title').text('Editar Producto'); // <-- Cambia el título
                $('#crearProductoModal').modal('show');

                if (response.producto.producto_video) {
                    var videoUrl = response.producto.producto_video;
                    var videoId = obtenerIdDeVideoYoutube(videoUrl);
                    var iframeUrl = 'https://www.youtube.com/embed/' + videoId;
                    $('#iframeVideo').attr('src', iframeUrl);
                } else {
                    // Si no hay video, ocultar el iframe de video
                    $('#iframeVideo').hide();
                }

                // Mostrar la imagen del producto si existe
                if (response.producto.imagen_producto) {
                    $('#lim').html(
                        '<img src="<?= base_url('public/assets/img_tienda/productos/'); ?>' +
                        response.producto.imagen_producto +
                        '" style="max-width: 200px; max-height: 150px;">');
                } else {
                    $('#lim').html('No hay imagen disponible');
                }

                var imagenesHTML = '';

                if (response.imagenes && response.imagenes.length > 0) {
                    response.imagenes.forEach(function(imagen, index) {
                        var borderStyle = 'border: 1px dashed red;';
                        if (index === 0) {
                            borderStyle = 'border: 3px dashed green;';
                        }
                        imagenesHTML += '<div class="image" style="' + borderStyle +
                            '" data-id-imagen="' + imagen.id_imagen +
                            '" data-id-producto="' + imagen.id_producto + '">';
                        imagenesHTML +=
                            '<img src="<?= base_url('public/assets/img_tienda/productos/'); ?>' +
                            imagen.nombre_archivo + '" data-id="' + imagen
                            .id_imagen + '" />';
                        imagenesHTML +=
                            '<button type="button" id="eliminarImagen_' + imagen
                            .id_imagen +
                            '" class="btn btn-danger btn-eliminar-imagen" data-id="' +
                            imagen.id_imagen +
                            '" style="margin-top: 5px; border-radius:50%;">x</button>';
                        imagenesHTML += '</div>';
                    });
                } else {
                    imagenesHTML = '<p>No hay imágenes adicionales disponibles.</p>';
                }

                $('.container_p').html(imagenesHTML);

                selectSubcategoria(response.producto.categoria_producto, response.producto
                    .id_subcategoria);

                // Mostrar nombre del PDF si existe
                if (response.producto.manual_pdf) {
                    $('#pdf_nombre_container').html(
                        '<span id="pdf_nombre">' + response.producto.manual_pdf + '</span> ' +
                        '<button type="button" id="eliminar_pdf_btn" style="background:none;border:none;padding:0;margin-left:8px;vertical-align:middle;" title="Eliminar PDF">' +
                        '<svg width="20" height="20" viewBox="0 0 20 20" style="vertical-align:middle;" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                        '<circle cx="10" cy="10" r="10" fill="#f44336"/>' +
                        '<path d="M6 6L14 14M14 6L6 14" stroke="#fff" stroke-width="2" stroke-linecap="round"/>' +
                        '</svg></button>'
                    );
                } else {
                    $('#pdf_nombre_container').html('');
                }
            },
        });

    });





    $(document).on('click', '.btn-eliminar-imagen', function() {
        // Obtener el ID de la imagen a eliminar
        var idImagen = $(this).data('id');


        $.ajax({
            url: '<?php echo base_url('admin/productos/eliminarImagen'); ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                id: idImagen
            },
            success: function(response) {

                if (response.status) {

                    Swal.fire({
                        icon: 'success',
                        title: '¡Imagen eliminada!',
                        text: 'La imagen ha sido eliminada correctamente.'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            $('#eliminarImagen_' + idImagen).closest('.image')
                                .remove();
                        }
                    });
                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al eliminar la imagen.'
                    });
                }
            },
            error: function() {

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error en la solicitud AJAX.'
                });
            }
        });
    });












    // Capturar clic en el botón de desactivar
    $(document).on('click', '.btn-desactivar', function() {
        var idProducto = $(this).data('id');



    });


    $('#addProducto').on('submit', function(event) {

        event.preventDefault(); // Prevenir el envío del formulario

        var form_data = new FormData(this);
        var form_action = $(this).attr('action');
        var btnGuardar = $('#btnGuardar');

        // Deshabilitamos el botón de envío
        btnGuardar.prop('disabled', true);

        $.ajax({
            data: form_data, // Los datos del formulario
            url: form_action, // La URL a la que se enviarán los datos
            type: 'POST', // El método HTTP utilizado para la solicitud
            dataType: 'json', // Tipo de datos que se espera recibir del servidor
            processData: false, // No procesar los datos, ya que FormData se encargará de ello
            contentType: false, // No configurar el tipo de contenido, ya que FormData se encargará de ello
            success: function(res) {

                // La función que se ejecuta cuando la petición AJAX es exitosa
                if (res.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Guardado Exitosamente',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        // Cerrar el modal después del éxito

                        $("#crearProductoModal").modal('hide'); //ocultamos el modal
                        // Actualizar o recargar la tabla de portadas aquí si es necesario
                        $('#productosTable').DataTable().ajax.reload();
                        limpiarModal();
                    });
                } else {
                    if (res.error) {
                        // Si hay un mensaje de error específico, mostrarlo con Sweet Alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al Guardar',
                            text: 'Error al guardar: ' + res.error,
                            confirmButtonColor: '#d33'
                        });
                    } else {
                        // Si no hay un mensaje de error específico, mostrar un mensaje genérico
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al Guardar',
                            text: 'Hubo un error al guardar los datos.',
                            confirmButtonColor: '#d33'
                        });
                    }
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
            },
            complete: function() {
                // Habilitamos el botón de envío al finalizar la solicitud
                btnGuardar.prop('disabled', false);
            }

        });
    });

    function limpiarModal() {
        var idProducto = $('#id_producto').val();
        console.log('ID del producto:');
        $('#id_producto').val('');
        $('#nombre').val('');
        $('#descripcion').val('');
        $('#caracteristicas').val('');
        $('#precio').val('');
        $('#precio_anterior').val('');
        $('#marca').val('');
        $('#modelo').val('');
        $('#categoria_producto').val('');
        $('#subcategoria_producto').val('');
        $('#lim').html(''); // Limpiar la imagen previa
        $('#producto_video').val('');
        $('#iframeVideo').attr('src', '');
        $('#producto_descuento').val('');
        $('.container_p').html('');
        $('#pdf_nombre_container').html('');
    }

    $('#imagenes_input').on('change', function(event) {
        console.log('Input de imagen cambiado');
        var files = event.target.files;
        $('.container_p').empty(); // Limpiar las imágenes previas
        $.each(files, function(index, file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = $('<img>').attr('src', e.target.result);
                var div = $('<div>').addClass('image').append(
                    $('<span>').attr('onclick', 'delImage(' + index + ')').text('×'),
                    img
                );
                $('.container_p').append(div);
            }
            reader.readAsDataURL(file);
        });
    });

    $('body').on('click', '.btn-desactivar', function() {
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
                url: '<?= site_url('admin/productos/actualizar_estado/') ?>' + id +
                    '/' + newStatus,
                type: 'POST',
                dataType: 'json',
                success: function(res) {

                    if (res.status) {

                        /* location.reload(); */

                        // Actualizar el botón y la vista según el nuevo estado
                        if (newStatus == 1) {
                            $(this).removeClass('btn-danger').addClass(
                                'btn-success').text('Activar');

                        } else {
                            $(this).removeClass('btn-success').addClass(
                                'btn-danger').text('Desactivar');
                        }



                        Swal.fire({
                            icon: 'success',
                            title: 'Estado cambiado',
                            text: 'El estado del registro ha sido cambiado correctamente.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        $('#productosTable').DataTable().ajax.reload();
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

    $(document).on('click', '.btn-eliminar', function() {
        var idProducto = $(this).data('id');
        Swal.fire({
            title: '¿Deseas eliminar el producto?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Realizar la solicitud AJAX para eliminar el producto
                $.ajax({
                    url: '<?= site_url('admin/productos/eliminar/') ?>' + idProducto,
                    type: 'POST',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: 'El producto ha sido eliminado correctamente.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                            $('#productosTable').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo eliminar el producto.'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error de Conexión',
                            text: 'Hubo un problema al conectar con el servidor.'
                        });
                    }
                });
            }
        });
    });

    // Mostrar nombre del PDF y botón X al seleccionar archivo
    $('#manual_pdf').on('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var nombre = file.name;
            $('#pdf_nombre_container').html(
                '<span id="pdf_nombre">' + nombre + '</span> ' +
                '<button type="button" id="eliminar_pdf_btn" style="background:none;border:none;padding:0;margin-left:8px;vertical-align:middle;" title="Eliminar PDF">' +
                '<svg width="20" height="20" viewBox="0 0 20 20" style="vertical-align:middle;" fill="none" xmlns="http://www.w3.org/2000/svg">' +
                '<circle cx="10" cy="10" r="10" fill="#f44336"/>' +
                '<path d="M6 6L14 14M14 6L6 14" stroke="#fff" stroke-width="2" stroke-linecap="round"/>' +
                '</svg></button>'
            );
        } else {
            $('#pdf_nombre_container').html('');
        }
    });

    // Eliminar PDF seleccionado antes de guardar
    $('#pdf_nombre_container').on('click', '#eliminar_pdf_btn', function() {
        var idProducto = $('#id_producto').val();
        if (idProducto) {
            $.ajax({
                url: '<?= base_url('admin/productos/eliminarPdf') ?>',
                type: 'POST',
                data: { id_producto: idProducto },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        $('#manual_pdf').val('');
                        $('#pdf_nombre_container').html('');
                        Swal.fire({
                            icon: 'success',
                            title: 'PDF eliminado',
                            text: response.message,
                            timer: 1200,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo eliminar el PDF.'
                    });
                }
            });
        } else {
            $('#manual_pdf').val('');
            $('#pdf_nombre_container').html('');
        }
    });
});
</script>
<script src="<?= base_url('public/assets/tienda/js/multi_imagen.js') ?>"></script>



<?php include("admin_footer.php")  ?>