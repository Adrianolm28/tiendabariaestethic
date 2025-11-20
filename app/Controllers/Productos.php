<?php

namespace App\Controllers;

use App\Models\CategoriaProductoModel;
use App\Models\ConfiguracionTiendaModel;
use App\Models\ImagenesProductoModel;
use App\Models\MarcasProductosModel;
use App\Models\ProductoModel;
use App\Models\SubcategoriaProductoModel;
use CodeIgniter\Controller;


class Productos extends BaseController
{
    public function index()
    {


        $productosApi = $this->cargarProductosApi();

        $model = new ProductoModel();
        $categoriaModel = new CategoriaProductoModel();
        $marcasModel = new MarcasProductosModel();
        $subcategoriaModel = new SubcategoriaProductoModel();
        $data['marcas'] = $marcasModel->findAll();
        $data['categorias'] = $categoriaModel->findAll();
        $data['productos'] = $model->findAll();
        $data['productosApi'] = $productosApi;

        $selectedCategoriaId = $this->request->getPost('categoria_producto');

        if ($selectedCategoriaId) {
            $data['subcategorias'] = $subcategoriaModel->where('id_categoria_principal', $selectedCategoriaId)->findAll();
        } else {
            $data['subcategorias'] = []; // Inicializar como array vacío si no se ha seleccionado categoría
        }



        return view('admin/productos', $data);
    }

    public function obtenerCategorias()
    {
        try {
            // Crear una instancia del modelo de categorías
            $categoriaModel = new CategoriaProductoModel();

            // Obtener todas las categorías
            $categorias = $categoriaModel->findAll(); // Suponiendo que tienes un método findAll en tu modelo

            // Verificar si se encontraron categorías
            if (!empty($categorias)) {
                // Devolver las categorías como JSON
                return $this->response->setJSON(['success' => true, 'categorias' => $categorias]);
            } else {
                // Si no se encontraron categorías
                return $this->response->setJSON(['success' => false, 'message' => 'No se encontraron categorías']);
            }
        } catch (\Exception $e) {
            // Capturar excepciones si ocurre algún error
            return $this->response->setJSON(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function obtenerSubcategorias()
    {
        // Verificar si es una solicitud AJAX
        if ($this->request->isAJAX()) {
            $categoriaId = $this->request->getPost('categoria_id');

            // Instanciar el modelo de subcategorías
            $subcategoriaModel = new SubcategoriaProductoModel();

            // Obtener las subcategorías según el ID de la categoría
            $subcategorias = $subcategoriaModel->where('id_categoria_principal', $categoriaId)->findAll();

            // Preparar la respuesta en formato JSON
            $response = [
                'status' => true,
                'data' => $subcategorias
            ];

            return $this->response->setJSON($response);
        } else {
            // Si no es una solicitud AJAX, redireccionar o manejar el error según sea necesario
            return redirect()->to(site_url()); // Ejemplo de redirección a la página principal
        }
    }



    public function cargarProductosApi1()
    {
        // Hacer la llamada a la API y obtener los datos
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://develop.develop.pe/api/productos/productos',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'x-api-key: 1OQFd2zAopdlkDow2PIutVn0ImD7Dtw9edmT1o7S'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        // Decodificar la respuesta JSON
        $productosapi = json_decode($response, true);

        // Devolver los datos como array PHP


        return $productosapi;
    }

    public function cargarProductosApi()
    {

        $configuracionModel = new ConfiguracionTiendaModel();
        $configuracion = $configuracionModel->first();

        if ($configuracion && !empty($configuracion['api_token']) && !empty($configuracion['api_productos'])) {
            $apiKey = $configuracion['api_token'];
            $urlApiProductos = rtrim($configuracion['api_productos'], '/') . '/api/productos/productos';
        } else {
            return "No se pudo obtener la clave API o el subdominio de la configuración de la tienda.";
        }



        try {
            // Datos a enviar en la solicitud POST
            $postData = array(
                // Aquí puedes agregar los datos que desees enviar en la solicitud POST
                // Ejemplo: 'key' => 'value'
            );

            // Convertir los datos a formato JSON
            $postDataJson = json_encode($postData);
            // Hacer la llamada a la API y obtener los datos
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $urlApiProductos,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $postDataJson,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'x-api-key: ' . $apiKey
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            // Decodificar la respuesta JSON
            $productosapi = json_decode($response, true);

            // Devolver los datos como array PHP
            return $productosapi;
        } catch (\Exception $e) {
            // Manejar cualquier excepción que ocurra
            return "Error al cargar los productos desde la API: " . $e->getMessage();
        }
    }


    /* public function cargarProductosApi()
    {
        // Hacer la llamada a la API y obtener los datos
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://sistemav7.siga.com.pe/api/productos/index',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'x-api-key: DmZrnCcPvI5zOjaEckk2hW68MrSFb78LYTF4aRgY'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        // Decodificar la respuesta JSON
        $productosapi = json_decode($response, true);

        // Devolver los datos como JSON
        return $this->response->setJSON($productosapi);
    } */


    public function filtrarPorSubcategoria()
    {
        $model = new ProductoModel();

        // Obtener el ID de la subcategoría de la solicitud
        $id_subcategoria = $this->request->getVar('id_subcategoria');

        // Verificar si se ha proporcionado un ID de subcategoría
        if (!$id_subcategoria) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'No se proporcionó el ID de la subcategoría.'
            ]);
        }

        // Filtrar productos por subcategoría
        $productos = $model->where('id_subcategoria', $id_subcategoria)->findAll();

        // Procesar los productos para construir el array de datos
        $data = [];
        foreach ($productos as $producto) {
            // Calcular el precio con descuento
            $precioConDescuento = $producto['precio'] - ($producto['precio'] * ($producto['producto_descuento'] / 100));

            // Obtener la categoría y la marca del producto
            $categoriaModel = new CategoriaProductoModel();
            $categoria = $categoriaModel->find($producto['categoria_producto']);
            $marcaModel = new MarcasProductosModel();
            $marca = $marcaModel->find($producto['marca']);

            // Obtener las imágenes adicionales del producto
            $imagenesModel = new ImagenesProductoModel();
            $imagenes = $imagenesModel->where('id_producto', $producto['id_producto'])->findAll();

            $imagenPrincipal = $imagenesModel->getImagenPrincipal($producto['id_producto']);

            // Construir el HTML de las imágenes adicionales
            $imagenesHTML = '';
            foreach ($imagenes as $imagen) {
                $imagenesHTML .= '<img src="' . base_url('public/assets/img_tienda/productos/' . $imagen['nombre_archivo']) . '" alt="Imagen">';
            }

            // Construir el array de datos del producto
            $data[] = [
                'id_producto' => $producto['id_producto'],
                'id_sistema' => $producto['id_sistema'],
                'imagen_producto' => $imagenPrincipal ? $imagenPrincipal['nombre_archivo'] : $producto['imagen_producto'],
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'caracteristicas' => $producto['caracteristicas'],
                'precio' => $producto['precio'],
                'precio_con_descuento' => $producto['producto_descuento'] == 0 ? "0.00" : ($producto['producto_descuento'] === "0.00" ? $producto['precio'] : number_format($precioConDescuento, 2, '.', '')),
                'precio_anterior' => $producto['precio_anterior'],
                'marca' => $marca['nombre'] ?? null,
                'modelo' => $producto['modelo'],
                'categoria_producto' => $categoria['nombre'] ?? null,
                'imagenes_adicionales' => $imagenesHTML,
                'id_categoria' => $categoria['id_categoria'] ?? null,
                'id_marca' => $marca['id_marca'] ?? null,
                'stock' => $producto['stock'],
                'estado' => $producto['estado'],
                'producto_descuento' => $producto['producto_descuento'],
                'delivery' => $delivery['delivery'],
                'acciones' => '<button class="btn btn-primary">Editar</button>',
            ];
        }

        // Devolver la respuesta JSON con los datos de los productos
        return $this->response->setJSON([
            'status' => true,
            'data' => $data
        ]);
    }







    public function getProductos()
    {
        $model = new ProductoModel();

        // Obtener el número de página actual de la solicitud
        $paginaActual = $this->request->getVar('page') ?? 1;

        // Obtener el número de productos por página de la solicitud
        $productosPorPagina = $this->request->getVar('productosPorPagina') ?? 10;

        // Inicializar la variable de paginación
        $paginacion = '';

        $searchText = $this->request->getVar('searchText');
        $subcategoriaid = $this->request->getVar('subcategoriaid');

        if ($searchText) {
            // Realizar búsqueda de productos por texto
            $productos = $model->buscarProductosPorTexto($searchText);
        } elseif ($subcategoriaid) {
            // Realizar búsqueda de productos por id_subcategoria
            $productos = $model->buscarProductosPorSubcategoria($subcategoriaid);
        } else {
            // Obtener todos los productos o productos paginados según la solicitud
            if ($productosPorPagina === '0') {
                // Cargar todos los productos sin paginación
                $productos = $model->findAll();
            } else {
                // Cargar productos paginados
                $totalProductos = $model->countAll();
                $productos = $model->paginate($productosPorPagina, '', $paginaActual);

                // Renderizar la paginación
                $paginacion = $model->pager->makeLinks($paginaActual, $productosPorPagina, $totalProductos);
                $paginacion = str_replace('First', 'Primero', $paginacion);
                $paginacion = str_replace('Previous', 'Anterior', $paginacion);
                $paginacion = str_replace('Next', 'Siguiente', $paginacion);
                $paginacion = str_replace('Last', 'Último', $paginacion);
            }
        }
        // Procesar los productos para construir el array de datos
        $data = [];
        foreach ($productos as $producto) {
            // Debug temporal:
            error_log('PRODUCTO VIDEO: ' . var_export($producto['producto_video'], true));
            // Calcular el precio con descuento
            $precioConDescuento = $producto['precio'] - ($producto['precio'] * ($producto['producto_descuento'] / 100));

            // Obtener la categoría y la marca del producto
            $categoriaModel = new CategoriaProductoModel();
            $categoria = $categoriaModel->find($producto['categoria_producto']);
            $marcaModel = new MarcasProductosModel();
            $marca = $marcaModel->find($producto['marca']);



            // Obtener las imágenes adicionales del producto
            $imagenesModel = new ImagenesProductoModel();
            $imagenes = $imagenesModel->where('id_producto', $producto['id_producto'])->findAll();

            $imagenPrincipal =  $imagenesModel->getImagenPrincipal($producto['id_producto']);

            // Construir el HTML de las imágenes adicionales
            $imagenesHTML = '';
            foreach ($imagenes as $imagen) {
                $imagenesHTML .= '<img src="' . base_url('public/assets/img_tienda/productos/' . $imagen['nombre_archivo']) . '" alt="Imagen">';
            }

            // Construir el array de datos del producto
            $data[] = [
                'id_producto' => $producto['id_producto'],
                'id_sistema' => $producto['id_sistema'],
                'imagen_producto' => $imagenPrincipal ? $imagenPrincipal['nombre_archivo'] : $producto['imagen_producto'],
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'caracteristicas' => $producto['caracteristicas'],
                'precio' => $producto['precio'],
                'precio_con_descuento' => $producto['producto_descuento'] == 0 ? "0.00" : ($producto['producto_descuento'] === "0.00" ? $producto['precio'] : number_format($precioConDescuento, 2, '.', '')),
                'precio_anterior' => $producto['precio_anterior'],
                'precio_transferencia' => $producto['precio_transferencia'] ?? "0.00",
                'descuento_transferencia' => $producto['descuento_transferencia'],
                'marca' => $marca['nombre'] ?? null,
                'modelo' => $producto['modelo'],
                'categoria_producto' => $categoria['nombre'] ?? null,
                'imagenes_adicionales' => $imagenesHTML,
                'id_categoria' => $categoria['id_categoria'] ?? null,
                'id_marca' => $marca['id_marca'] ?? null,
                'stock' => $producto['stock'],
                'estado' => $producto['estado'],
                'id_subcategoria' => $producto['id_subcategoria'],
                'producto_descuento' => $producto['producto_descuento'],
                'acciones' => '<button class="btn btn-primary">Editar</button>',
            ];
        }

        // Devolver la respuesta JSON con los datos de los productos y la paginación
        return $this->response->setJSON([
            'data' => $data,
            'pagination' => $paginacion,
        ]);
    }


    public function getProductosConDescuento()
    {
        $model = new ProductoModel();




        // Obtener el número de página actual de la solicitud
        $paginaActual = $this->request->getVar('page') ?? 1;

        // Obtener el número de productos por página de la solicitud
        $productosPorPagina = $this->request->getVar('productosPorPagina') ?? 10;

        // Inicializar la variable de paginación
        $paginacion = '';

        $categoriaid = $this->request->getPost('id_categoria');
        $subcategoriaid = $this->request->getPost('id_subcategoria');

        if (!empty($categoriaid)) {

            $productos = $model->buscarProductosConDescuentoPorCategoria($categoriaid);
        } elseif (!empty($subcategoriaid)) {

            $productos = $model->buscarProductosConDescuentoPorSubcategoria($subcategoriaid);
        } else {
            // Obtener todos los productos con descuento o productos con descuento paginados según la solicitud
            if ($productosPorPagina === '0') {
                // Cargar todos los productos con descuento sin paginación
                $productos = $model->buscarProductosConDescuento();
            } else {
                // Cargar productos con descuento paginados
                $totalProductos = $model->countAllDescuentos();
                $productos = $model->paginateProductosConDescuento($productosPorPagina, '', $paginaActual);

                // Renderizar la paginación
                $paginacion = $model->pager->makeLinks($paginaActual, $productosPorPagina, $totalProductos);
                $paginacion = str_replace('First', 'Primero', $paginacion);
                $paginacion = str_replace('Previous', 'Anterior', $paginacion);
                $paginacion = str_replace('Next', 'Siguiente', $paginacion);
                $paginacion = str_replace('Last', 'Último', $paginacion);
            }
        }

        // Procesar los productos para construir el array de datos
        $data = [];
        foreach ($productos as $producto) {
            // Calcular el precio con descuento
            $precioConDescuento = $producto['precio'] - ($producto['precio'] * ($producto['producto_descuento'] / 100));

            // Obtener la categoría y la marca del producto
            $categoriaModel = new CategoriaProductoModel();
            $categoria = $categoriaModel->find($producto['categoria_producto']);
            $marcaModel = new MarcasProductosModel();
            $marca = $marcaModel->find($producto['marca']);

            // Obtener las imágenes adicionales del producto
            $imagenesModel = new ImagenesProductoModel();
            $imagenes = $imagenesModel->where('id_producto', $producto['id_producto'])->findAll();

            $imagenPrincipal = $imagenesModel->getImagenPrincipal($producto['id_producto']);

            // Construir el HTML de las imágenes adicionales
            $imagenesHTML = '';
            foreach ($imagenes as $imagen) {
                $imagenesHTML .= '<img src="' . base_url('public/assets/img_tienda/productos/' . $imagen['nombre_archivo']) . '" alt="Imagen">';
            }

            // Construir el array de datos del producto
            $data[] = [
                'id_producto' => $producto['id_producto'],
                'id_sistema' => $producto['id_sistema'],
                'imagen_producto' => $imagenPrincipal ? $imagenPrincipal['nombre_archivo'] : $producto['imagen_producto'],
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'caracteristicas' => $producto['caracteristicas'],
                'precio' => $producto['precio'],
                'precio_con_descuento' => $producto['producto_descuento'] == 0 ? "0.00" : ($producto['producto_descuento'] === "0.00" ? $producto['precio'] : number_format($precioConDescuento, 2, '.', '')),
                'precio_anterior' => $producto['precio_anterior'],
                'marca' => $marca['nombre'] ?? null,
                'modelo' => $producto['modelo'],
                'categoria_producto' => $categoria['nombre'] ?? null,
                'imagenes_adicionales' => $imagenesHTML,
                'id_categoria' => $categoria['id_categoria'] ?? null,
                'id_marca' => $marca['id_marca'] ?? null,
                'stock' => $producto['stock'],
                'estado' => $producto['estado'],
                'id_subcategoria' => $producto['id_subcategoria'],
                'producto_descuento' => $producto['producto_descuento'],
                'delivery' => $delivery['delivery'],
                'acciones' => '<button class="btn btn-primary">Editar</button>',
            ];
        }

        // Devolver la respuesta JSON with los datos de los productos y la paginación
        return $this->response->setJSON([
            'data' => $data,
            'pagination' => $paginacion,
        ]);
    }


    public function getProductosAdmin()
    {
        $model = new ProductoModel();
        $productos = $model->findAll();

        $imagenesModel = new ImagenesProductoModel();

        $data = [];
        foreach ($productos as $producto) {
            // Debug: Verifica el contenido de cada producto
            error_log('DEBUG getProductosAdmin: producto=' . print_r($producto, true));
            $categoria = $this->obtenerCategoria($producto['categoria_producto'] ?? null);
            $marca = $this->obtenerMarca($producto['marca'] ?? null);
            $imagenes = $this->obtenerImagenes($producto['id_producto'] ?? null);

            $imagenPrincipal = $imagenesModel->getImagenPrincipal($producto['id_producto'] ?? null);

            $data[] = [
                'id_producto' => $producto['id_producto'] ?? null,
                'imagen_producto' => $imagenPrincipal ? $imagenPrincipal['nombre_archivo'] : ($producto['imagen_producto'] ?? ''),
                'nombre' => $producto['nombre'] ?? '',
                'descripcion' => $producto['descripcion'] ?? '',
                'caracteristicas' => $producto['caracteristicas'] ?? '',
                'precio' => $producto['precio'] ?? '',
                'precio_anterior' => $producto['precio_anterior'] ?? '',
                'precio_transferencia' => $producto['precio_transferencia'] ?? '',
                'marca' => $marca ? ($marca['nombre'] ?? null) : null,
                'modelo' => $producto['modelo'] ?? '',
                'categoria_producto' => $categoria ? ($categoria['nombre'] ?? null) : null,
                'imagenes_adicionales' => $imagenes,
                'stock' => $producto['stock'] ?? '',
                'estado' => $producto['estado'] ?? '',
                'producto_video' => isset($producto['producto_video']) ? $producto['producto_video'] : null,
                'id_subcategoria' => $producto['id_subcategoria'] ?? null,
                'descuento_transferencia' => $producto['descuento_transferencia'] ?? '',
                'delivery' => $producto['delivery'] ?? '',
                'acciones' => '<button class="btn btn-primary">Editar</button>',
            ];
        }

        // Debug: Verifica el array final antes de retornar
        error_log('DEBUG getProductosAdmin: data=' . print_r($data, true));

        return $this->response->setJSON(['data' => $data]);
    }

    private function obtenerCategoria($id_categoria)
    {
        $categoriaModel = new CategoriaProductoModel();
        return $categoriaModel->find($id_categoria);
    }

    private function obtenerMarca($id_marca)
    {
        $marcasModel = new MarcasProductosModel();
        return $marcasModel->find($id_marca);
    }

    private function obtenerImagenes($id_producto)
    {
        $imagenesModel = new ImagenesProductoModel();
        $imagenes = $imagenesModel->where('id_producto', $id_producto)->findAll();

        $imagenesData = [];
        foreach ($imagenes as $imagen) {
            $imagenesData[] = [
                'url' => base_url('public/assets/img_tienda/productos/' . $imagen['nombre_archivo']),
                'alt' => 'Imagen'
            ];
        }

        return $imagenesData;
    }

    private function obtenerImagenesHTML($id_producto)
    {
        $imagenesModel = new ImagenesProductoModel();
        $imagenes = $imagenesModel->where('id_producto', $id_producto)->findAll();

        $imagenesHTML = '';
        foreach ($imagenes as $imagen) {
            $imagenesHTML .= '<img src="' . base_url('public/assets/img_tienda/productos/' . $imagen['nombre_archivo']) . '" alt="Imagen">';
        }
        return $imagenesHTML;
    }

    public function store()
    {
        helper(['form', 'url']);

        $model = new ProductoModel();
        $imagenesModel = new ImagenesProductoModel();

        if ($this->request->getPost()) {

            $archivo = $this->request->getFiles('file');
            $producto_video = $this->request->getPost('producto_video');
            $pdfFile = $this->request->getFile('manual_pdf');


            $precio_anterior = $this->request->getPost('precio_anterior');
            $precio_transferencia = $this->request->getPost('precio_transferencia');


            $descuento_transferencia = 0;

            // Solo realiza el cálculo si `precio_transferencia` es mayor que 0
            if ($precio_transferencia > 0 && $precio_anterior > 0) {
                $descuento_transferencia = round((1 - $precio_transferencia / $precio_anterior) * 100, 2);
            }


            $id = $this->request->getPost('id_producto');
            if (empty($id)) {
                $nombrePro = $this->request->getPost('nombre');
                $producto_descuento = $this->request->getPost('producto_descuento');


                $existe_pro = $model->where('nombre', $nombrePro)->first();
                if ($existe_pro) {
                    // Si ya existe un producto con el mismo nombre, mostrar mensaje de error
                    echo json_encode(["status" => false, "error" => "Ya existe un producto con el mismo nombre"]);
                    return; // Detener el proceso de guardado
                }


                $validationRules = [
                    'nombre' => 'required',
                    /*  'imagen_producto' => 'uploaded[imagen_producto]|mime_in[imagen_producto,image/jpg,image/jpeg,image/png]|max_size[imagen_producto,2048]', */
                ];

                if ($this->validate($validationRules)) {



                    $archivoPDF = $this->request->getFile('manual_pdf');
                    if ($archivoPDF->isValid() && !$archivoPDF->hasMoved()) {
                        $newPdfName = $archivoPDF->getRandomName();

                        $archivoPDF->move(ROOTPATH . 'public/assets/tienda/manuales/' . $newPdfName);
                    }



                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        'descripcion' => $this->request->getPost('descripcion'),
                        'caracteristicas' => $this->request->getPost('caracteristicas'),
                        'precio' => $this->request->getPost('precio'),
                        'precio_anterior' => $this->request->getPost('precio_anterior'),
                        'precio_transferencia' => $this->request->getPost('precio_transferencia'),
                        'descuento_transferencia' => $descuento_transferencia,
                        'marca' => $this->request->getPost('marca'),
                        'modelo' => $this->request->getPost('modelo'),
                        'categoria_producto' => $this->request->getPost('categoria_producto'),
                        'id_subcategoria' => $this->request->getPost('subcategoria_producto'),
                        'imagen_producto' =>  'default.webp',
                        'producto_video' => $producto_video,
                        'manual_pdf' => $archivoPDF,
                        'producto_descuento' => $producto_descuento,
                        'stock' => $this->request->getPost('stock'),
                        'costo_producto' => $this->request->getPost('costo_producto'),
                        'delivery' => $this->request->getpost('delivery')


                    ];

                    $save = $model->insert_data($data);

                    if ($save != false) {
                        // Insertar las imágenes adicionales en la tabla imagenes_producto
                        foreach ($archivo['file'] as $indice => $imagen) {
                            $rutaDestino = ROOTPATH . 'public/assets/img_tienda/productos';
                            $rutaWebP = $this->convertirAWebP($imagen, $rutaDestino);
                            if ($rutaWebP) {
                                $nombreArchivoWebP = pathinfo($rutaWebP, PATHINFO_BASENAME);
                                $datosImagen = [
                                    'id_producto' => $save,
                                    'nombre_archivo' => $nombreArchivoWebP,
                                    'orden' => $indice + 1,
                                    'estado' => 'activo'
                                ];
                                $imagenesModel->insert($datosImagen);
                                unlink($imagen->getRealPath()); // Eliminar la imagen original después de la conversión
                            }
                        }

                        $apiResponse = $this->enviarProductoAApi($data);

                        // Verificar la respuesta de la API
                        $apiResult = json_decode($apiResponse, true);


                        if ($apiResult['response'] === 'success') {
                            $apiId = $apiResult['id'];

                            $data = $model->where('id_producto', $save)->first();
                            echo json_encode(array("status" => true, 'data' => $data, 'apiResponse' => $apiResult));


                            $model->update($save, ['id_sistema' => $apiId]);
                        } else {
                            echo json_encode(array("status" => false, 'message' => 'Producto guardado, pero hubo un error en la API', 'apiResponse' => $apiResult));
                        }
                    } else {
                        echo json_encode(array("status" => false, 'data' => $data));
                    }
                } else {
                    echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                }
            } else {
                /* Aquí actualiza */
                $validationRules = [
                    'nombre' => 'required',

                    /* 'imagen_producto' => 'mime_in[imagen_producto,image/jpg,image/jpeg,image/png]|max_size[imagen_producto,2048]', */
                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        'descripcion' => $this->request->getPost('descripcion'),
                        'caracteristicas' => $this->request->getPost('caracteristicas'),
                        'precio' => $this->request->getPost('precio'),
                        'precio_anterior' => $this->request->getPost('precio_anterior'),
                        'precio_transferencia' => $this->request->getPost('precio_transferencia'),
                        'descuento_transferencia' => $descuento_transferencia,
                        'marca' => $this->request->getPost('marca'),
                        'modelo' => $this->request->getPost('modelo'),
                        'categoria_producto' => $this->request->getPost('categoria_producto'),
                        'id_subcategoria' => $this->request->getPost('subcategoria_producto'),
                        'producto_descuento' => $this->request->getPost('producto_descuento'),
                        'stock' => $this->request->getPost('stock'),
                        'producto_video'  => !empty($producto_video) ? $producto_video : null,
                        'costo_producto' => $this->request->getPost('costo_producto'),
                        'stock' => $this->request->getPost('stock'),
                        'delivery' => $this->request->getpost('delivery')
                    ];



                    $pdfFile = $this->request->getFile('manual_pdf');

                    if ($pdfFile->isValid() && !$pdfFile->hasMoved()) {
                        $newPdfName = $pdfFile->getRandomName();
                        $pdfFile->move(ROOTPATH . 'public/assets/tienda/manuales/', $newPdfName);

                        $data['manual_pdf'] = 'public/assets/tienda/manuales/' . $newPdfName;
                    }


                    // Actualiza la información principal del producto
                    if ($model->update($id, $data)) {
                        // Inserta o actualiza las imágenes adicionales en la tabla imagenes_producto
                        foreach ($archivo['file'] as $indice => $imagen) {
                            // Procesar y guardar la imagen (similar a la lógica para crear una nueva imagen)
                            $rutaDestino = ROOTPATH . 'public/assets/img_tienda/productos';
                            $rutaWebP = $this->convertirAWebP($imagen, $rutaDestino);
                            if ($rutaWebP) {
                                $nombreArchivoWebP = pathinfo($rutaWebP, PATHINFO_BASENAME);
                                $datosImagen = [
                                    'id_producto' => $id,
                                    'nombre_archivo' => $nombreArchivoWebP,
                                    'orden' => $indice + 1,
                                    'estado' => 'activo'
                                ];
                                $imagenesModel->insert($datosImagen);
                                unlink($imagen->getRealPath()); // Eliminar la imagen original después de la conversión
                            }
                        }

                        /*  $apiResponse = $this->enviarProductoAApi($data);
                        $apiResult = json_decode($apiResponse, true); */
                        // Devuelve una respuesta exitosa
                        $updatedData = $model->where('id_producto', $id)->first();
                        echo json_encode(array("status" => true, 'data' => $updatedData));
                    } else {
                        echo json_encode(array("status" => false, 'message' => 'Error al actualizar'));
                    }
                } else {
                    // Manejar errores de validación y carga de archivos
                    echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                }
            }
        }
    }
    public function convertirAWebP($imagen, $rutaDestino)
    {
        // Verificar si la imagen es válida y no se ha movido
        if ($imagen->isValid() && !$imagen->hasMoved()) {
            // Obtener el nombre y la ruta temporal de la imagen original
            $nombreArchivoOriginal = $imagen->getRandomName();
            $rutaOriginal = $imagen->getTempName();

            // Obtener la extensión de la imagen original
            $extension = pathinfo($nombreArchivoOriginal, PATHINFO_EXTENSION);

            // Crear una imagen a partir del archivo original
            if ($extension === 'jpg' || $extension === 'jpeg') {
                $imagenOriginal = imagecreatefromjpeg($rutaOriginal);
            } elseif ($extension === 'png') {
                $imagenOriginal = imagecreatefrompng($rutaOriginal);
            } else {
                // Si el archivo no es JPG ni PNG, retornar false
                return false;
            }

            // Crear una imagen WebP vacía con el mismo tamaño
            $imagenWebP = imagecreatetruecolor(imagesx($imagenOriginal), imagesy($imagenOriginal));

            // Copiar la imagen original a la imagen WebP
            imagecopy($imagenWebP, $imagenOriginal, 0, 0, 0, 0, imagesx($imagenOriginal), imagesy($imagenOriginal));

            // Guardar la imagen WebP en la misma carpeta con una extensión diferente
            $nombreArchivoWebP = pathinfo($nombreArchivoOriginal, PATHINFO_FILENAME) . '.webp';
            $rutaWebP = $rutaDestino . '/' . $nombreArchivoWebP;

            // Guardar la imagen WebP
            imagewebp($imagenWebP, $rutaWebP);

            // Liberar memoria
            imagedestroy($imagenOriginal);
            imagedestroy($imagenWebP);

            // Retornar la ruta de la imagen WebP
            return $rutaWebP;
        }

        // Si la imagen no es válida, retornar false
        return false;
    }

    private function enviarProductoAApi($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://develop.valeapp.pe/api/productos/save_producto_flash',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'producto_nombre' => $data['nombre'],
                'codigo_interno' => '', // Puedes pasar un valor si lo tienes
                'precio' => $data['precio']
            ),
            CURLOPT_HTTPHEADER => array(
                'x-api-key: 1OQFd2zAopdlkDow2PIutVn0ImD7Dtw9edmT1o7S',
                'Cookie: newlevel_sess=323356b7d0dbabce596e9cb753e3f7192388b7eb'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }




    public function edit($id = null)
    {
        $productoModel = new ProductoModel();
        $imagenesProductoModel = new ImagenesProductoModel();

        // Buscar el producto por su ID
        $producto = $productoModel->find($id);

        // Buscar las imágenes asociadas a ese producto
        $imagenes = $imagenesProductoModel->where('id_producto', $id)
            ->orderBy('orden', 'ASC')
            ->findAll();
        // Verificar si el producto existe
        if ($producto !== null) {
            // Verificar si hay imágenes asociadas al producto
            if (!empty($imagenes)) {
                $response = [
                    "status" => true,
                    "producto" => $producto,
                    "imagenes" => $imagenes
                ];
            } else {
                // Si no hay imágenes asociadas, devuelve solo los datos del producto con un array vacío para las imágenes
                $response = [
                    "status" => true,
                    "producto" => $producto,
                    "imagenes" => []
                ];
            }
        } else {
            // Si el producto no existe, devuelve un estado falso
            $response = [
                "status" => false
            ];
        }

        // Devolver la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }



    public function eliminarImagen()
    {
        // Verificar si se ha enviado el ID de la imagen a eliminar
        $idImagen = $this->request->getPost('id');

        if ($idImagen) {
            // Carga el modelo de imágenes
            $imagenesModel = new ImagenesProductoModel();

            // Intenta eliminar la imagen de la base de datos
            if ($imagenesModel->delete($idImagen)) {
                // Si la eliminación fue exitosa, devuelve una respuesta JSON exitosa
                return $this->response->setJSON(['status' => true]);
            } else {
                // Si hubo un error al eliminar, devuelve una respuesta JSON con un mensaje de error
                return $this->response->setJSON(['status' => false, 'message' => 'Error al eliminar la imagen']);
            }
        } else {
            // Si no se proporcionó un ID de imagen, devuelve una respuesta JSON con un mensaje de error
            return $this->response->setJSON(['status' => false, 'message' => 'No se proporcionó un ID de imagen']);
        }
    }


    public function eliminarPdf()
    {
        $id_producto = $this->request->getPost('id_producto');
        if (!$id_producto) {
            return $this->response->setJSON(['status' => false, 'message' => 'ID de producto no recibido']);
        }

        // Obtener el producto
        $productoModel = new \App\Models\ProductoModel();
        $producto = $productoModel->find($id_producto);

        if (!$producto) {
            return $this->response->setJSON(['status' => false, 'message' => 'Producto no encontrado']);
        }

        $pdfPath = FCPATH . ltrim($producto['manual_pdf'], '/');
        // Eliminar archivo físico si existe
        if (!empty($producto['manual_pdf']) && file_exists($pdfPath)) {
            unlink($pdfPath);
        }

        // Actualizar campo manual_pdf en la base de datos
        $productoModel->update($id_producto, ['manual_pdf' => '']);

        return $this->response->setJSON(['status' => true, 'message' => 'PDF eliminado correctamente']);
    }


    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $model = new ProductoModel();
        $data = ['estado' => $nuevoEstado];

        if ($model->update($id, $data)) {
            $response = [
                'status' => true,
                'message' => 'El estado del servicio ha cambiado correctamente.',
                'new_status' => $nuevoEstado
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'No se pudo cambiar el estado des servicio',
            ];
        }

        return $this->response->setJSON($response);
    }

    public function filtrarPorCategorias()
    {
        $id_categoria = $this->request->getPost('categoryId');
        $productoModel = new ProductoModel();
        $productosFiltrados = $productoModel->filtrarPorCategoria($id_categoria);

        foreach ($productosFiltrados as &$producto) {



            if ($producto['producto_descuento'] <= 0) {
                $producto['precio_con_descuento'] = "0.00";
            } else {
                $precioConDescuento = $producto['precio'] - ($producto['precio'] * ($producto['producto_descuento'] / 100));
                $producto['precio_con_descuento'] = number_format($precioConDescuento, 2, '.', '');
            }
        }
        return $this->response->setJSON($productosFiltrados);
    }



    public function filtrarPorMarca()
    {
        // Obtener el ID de la marca seleccionada
        $id_marca = $this->request->getPost('marcaId');

        // Crear una instancia del modelo ProductoModel
        $productoModel = new ProductoModel();

        // Llamar a la función filtrarPorMarca del modelo para obtener los productos filtrados
        $productosFiltrados = $productoModel->filtrarPorMarca($id_marca);

        foreach ($productosFiltrados as &$producto) {
            if ($producto['producto_descuento'] <= 0) {
                $producto['precio_con_descuento'] = "0.00";
            } else {
                $precioConDescuento = $producto['precio'] - ($producto['precio'] * ($producto['producto_descuento'] / 100));
                $producto['precio_con_descuento'] = number_format($precioConDescuento, 2, '.', '');
            }
        }

        // Devolver los productos filtrados como JSON
        return $this->response->setJSON($productosFiltrados);
    }


    public function filtrarPorPrecio()
    {
        // Obtener los valores de precioMin y precioMax del cuerpo de la solicitud POST
        $precioMin = $this->request->getPost('precioMin');
        $precioMax = $this->request->getPost('precioMax');

        // Validar que los valores de precioMin y precioMax no estén vacíos y sean números válidos
        if (!is_numeric($precioMin) || !is_numeric($precioMax)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Los valores de precioMin y precioMax deben ser numéricos']);
        }

        // Crear una instancia del modelo ProductoModel
        $productoModel = new ProductoModel();

        // Llamar a la función filtrarPorPrecio del modelo para obtener los productos filtrados
        $productosFiltrados = $productoModel->filtrarPorPrecio($precioMin, $precioMax);



        // Devolver los productos filtrados como JSON
        return $this->response->setJSON($productosFiltrados);
    }

    public function guardarProductosSeleccionados()
    {
        $productosSeleccionados = $this->request->getPost('productosSeleccionados');


        $productoModel = new ProductoModel();



        foreach ($productosSeleccionados as $producto) {

            $data = [
                'nombre' => $producto['nombre'],
                'descripcion' => $producto['descripcion'],
                'caracteristicas' => $producto['caracteristicas'],
                'precio' => $producto['precio'],
                'marca' => null,
                'modelo' => null,
                'categoria_producto' => null,
                'imagen_producto' => 'default.png',
                'producto_video' =>  null,
                'manual_pdf' => null,
                'stock' => $producto['cantidad']

            ];



            $productoModel->insert($data);
        }



        return $this->response->setJSON(['success' => true, 'message' => 'Productos guardados exitosamente']);
    }


    public function buscarProductosPorTexto1()
    {
        $texto = $this->request->getPost('texto');

        $productoModel = new ProductoModel();
        $productos = $productoModel->buscarProductosPorTexto($texto);

        return $this->response->setJSON($productos);
    }



    public function buscarProductosPorTexto()
    {
        $texto = $this->request->getPost('texto');

        $productoModel = new ProductoModel();
        $productos = $productoModel->buscarProductosPorTexto($texto);

        return $this->response->setJSON($productos);
    }




    public function buscarYRedirigir()
    {
        $texto = $this->request->getGet('texto');

        $productoModel = new ProductoModel();
        $productos = $productoModel->buscarProductosPorTexto($texto);

        if (!empty($productos)) {
            // Redirigir al primer producto encontrado
            return redirect()->to(base_url('tienda/verproducto/' . $productos[0]['id_producto']));
        } else {
            // Mostrar mensaje de error o redirigir a una página de resultados vacíos
            return redirect()->to(base_url('tienda/no_se_encontraron_productos'));
        }
    }

    /* public function obtenerProductosPrecioBajo()
    {
        $productoModel = new ProductoModel();

        // Obtener productos con precio bajo
        $productos = $productoModel->productos_categorias();

        // Devolver los datos como JSON
        return $this->response->setJSON(['productos' => $productos]);
    } */

    public function obtenerProductosPorCategoria()
    {
        // Crear una instancia del modelo de productos
        $productoModel = new ProductoModel();

        // Obtener los productos de cada categoría
        $productosPorCategoria = $productoModel->productos_categorias();

        // Devolver los datos como JSON
        return $this->response->setJSON(['productosPorCategoria' => $productosPorCategoria]);
    }

    public function obtenerProductosPorMarca()
    {
        // Crear una instancia del modelo de productos
        $productoModel = new ProductoModel();

        // Obtener los productos de cada categoría
        $productosPorMarca = $productoModel->productos_marcas();

        // Devolver los datos como JSON
        return $this->response->setJSON(['productosPorMarca' => $productosPorMarca]);
    }

    public function ordenar_imagenproducto()
    {
        // Obtener los datos desde la solicitud POST
        $nuevoOrden = $this->request->getPost('nuevoOrden');

        // Comprobar si se ha recibido un array de nuevoOrden
        if (is_array($nuevoOrden)) {
            // Cargar el modelo de imágenes
            $imagenesProductoModel = new \App\Models\ImagenesProductoModel();

            // Iniciar una transacción para garantizar la integridad de los datos
            $imagenesProductoModel->db->transStart();

            // Iterar sobre el array y actualizar el orden en la base de datos
            foreach ($nuevoOrden as $index => $imagen) {
                $id_imagen = $imagen['id_imagen'];
                $orden = $index + 1; // Asegurarse de que el orden comienza en 1

                // Actualizar el campo 'orden' de cada imagen
                $imagenesProductoModel->update($id_imagen, ['orden' => $orden]);
            }


            // Completar la transacción
            $imagenesProductoModel->db->transComplete();

            // Comprobar si la transacción se completó correctamente
            if ($imagenesProductoModel->db->transStatus() === FALSE) {
                // Enviar una respuesta JSON indicando el fallo de la operación
                return $this->response->setJSON(['success' => false, 'message' => 'Error al actualizar el orden de las imágenes']);
            } else {
                // Enviar una respuesta JSON indicando el éxito de la operación
                return $this->response->setJSON(['success' => true, 'message' => 'Orden de las imágenes actualizado correctamente']);
            }
        } else {
            // Enviar una respuesta JSON indicando el fallo de la operación
            return $this->response->setJSON(['success' => false, 'message' => 'Datos no recibidos correctamente']);
        }
    }



    public function eliminar($id = null)
    {
        $model = new ProductoModel();
        if ($id && $model->find($id)) {
            if ($model->delete($id)) {
                return $this->response->setJSON(['status' => true]);
            } else {
                return $this->response->setJSON(['status' => false, 'message' => 'No se pudo eliminar el producto.']);
            }
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Producto no encontrado.']);
        }
    }
}
