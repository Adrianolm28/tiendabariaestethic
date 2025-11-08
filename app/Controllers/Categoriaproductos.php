<?php

namespace App\Controllers;

use App\Models\CategoriaProductoModel;
use \CodeIgniter\Controller;


class Categoriaproductos extends BaseController
{
    public function index()
    {
        $model = new CategoriaProductoModel();
        $data['categorias'] = $model->findAll();
        return view('admin/categoriaproductos', $data);
    }


    public function getCategoriaproductos()
    {
        $model = new CategoriaProductoModel();
        $categorias = $model->findAll();
        $data = [];
        foreach ($categorias as $categoria) {


            $data[] = [
                'id_categoria' => $categoria['id_categoria'],
                'nombre' => $categoria['nombre'],
                'imagen_categoria' => $categoria['imagen_categoria'],
                'descripcion' => $categoria['descripcion'],
                'estado' => $categoria['estado'],
                'acciones' => '<button class="btn btn-primary">Editar</button>'
            ];
        }
        return $this->response->setJSON(['data' => $data]);
    }


    /*  public function store()
    {
        helper(['form', 'url']);

        $model = new CategoriaProductoModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id_categoria');
            if (empty($id)) {
                $nombre = $this->request->getPost('nombre'); // Obtener el nombre del producto del formulario
                $existe_categoria = $model->where('nombre', $nombre)->first();

                if ($existe_categoria) {
                    // Si ya existe un producto con el mismo nombre, mostrar mensaje de error
                    echo json_encode(["status" => false, "error" => "Ya existe una Categoria con el mismo nombre"]);
                    return; // Detener el proceso de guardado
                }

                $validationRules = [
                    'nombre' => 'required',
                    'descripcion' => 'required',

                    'imagen_categoria' => 'mime_in[imagen_categoria,image/jpg,image/jpeg,image/png]|max_size[imagen_categoria,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('imagen_categoria');
                    $newFileName = $imageFile->getRandomName();

                    // Mover la imagen a la ubicación deseada
                    $imageFile->move(ROOTPATH . 'public/assets/img_tienda/categorias', $newFileName);

                    $data = [
                        'nombre' => $this->request->getPost('nombre'),

                        'descripcion' => $this->request->getPost('descripcion'),
                        'imagen_categoria' =>  $newFileName,
                    ];

                    $save = $model->insert_data($data);

                    if ($save != false) {
                        
                        $data = $model->where('id_categoria', $save)->first();
                        echo json_encode(array("status" => true, 'data' => $data));
                    } else {
                        echo json_encode(array("status" => false, 'data' => $data));
                    }
                } else {
                    // Manejar errores de validación y carga de archivos
                    echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                }
            } else {
               
                $validationRules = [
                    'nombre' => 'required',
                    'descripcion' => 'required',
                    'imagen_categoria ' => 'mime_in[imagen_categoria,image/jpg,image/jpeg,image/png]|max_size[imagen_categoria,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        'descripcion' => $this->request->getPost('descripcion'),

                    ];

                    $imageFile = $this->request->getFile('imagen_categoria');

                    if (!empty($imageFile) && $imageFile->isValid() && !$imageFile->hasMoved()) {
                        $newFileName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/assets/img_tienda/categorias', $newFileName);
                        $data['imagen_categoria'] = $newFileName;
                    }


                 
                    if ($model->update($id, $data)) {


                


                        $updatedData = $model->where('id_categoria', $id)->first();
                        echo json_encode(array("status" => true, 'data' => $updatedData));
                    } else {
                        echo json_encode(array("status" => false, 'message' => 'Error al actualizar'));
                    }
                } else {
               
                    echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                }
            }
        }
    }
 */


    public function store()
    {
        helper(['form', 'url']);

        $model = new CategoriaProductoModel();

        if ($this->request->getPost()) {
            $id = $this->request->getPost('id_categoria');
            if (empty($id)) {
                $nombre = $this->request->getPost('nombre'); // Obtener el nombre del producto del formulario
                $existe_categoria = $model->where('nombre', $nombre)->first();

                if ($existe_categoria) {
                    // Si ya existe un producto con el mismo nombre, mostrar mensaje de error
                    echo json_encode(["status" => false, "error" => "Ya existe una Categoria con el mismo nombre"]);
                    return; // Detener el proceso de guardado
                }

                $validationRules = [
                    'nombre' => 'required',
                    'descripcion' => 'required',
                    'imagen_categoria' => 'mime_in[imagen_categoria,image/jpg,image/jpeg,image/png]|max_size[imagen_categoria,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('imagen_categoria');
                    $webpPath = $this->convertirAWebP($imageFile, ROOTPATH . 'public/assets/img_tienda/categorias');

                    if ($webpPath) {
                        $data = [
                            'nombre' => $this->request->getPost('nombre'),
                            'descripcion' => $this->request->getPost('descripcion'),
                            'imagen_categoria' => basename($webpPath),
                        ];

                        $save = $model->insert_data($data);

                        if ($save != false) {
                            $data = $model->where('id_categoria', $save)->first();
                            echo json_encode(array("status" => true, 'data' => $data));
                        } else {
                            echo json_encode(array("status" => false, 'data' => $data));
                        }
                    } else {
                        echo json_encode(array("status" => false, 'error' => 'Error al convertir la imagen a WebP'));
                    }
                } else {
                    // Manejar errores de validación y carga de archivos
                    echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                }
            } else {
                /* Aqui actualiza */
                $validationRules = [
                    'nombre' => 'required',
                    'descripcion' => 'required',
                    'imagen_categoria' => 'mime_in[imagen_categoria,image/jpg,image/jpeg,image/png]|max_size[imagen_categoria,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        'descripcion' => $this->request->getPost('descripcion'),
                    ];

                    $imageFile = $this->request->getFile('imagen_categoria');

                    if (!empty($imageFile) && $imageFile->isValid() && !$imageFile->hasMoved()) {
                        $webpPath = $this->convertirAWebP($imageFile, ROOTPATH . 'public/assets/img_tienda/categorias');
                        if ($webpPath) {
                            $data['imagen_categoria'] = basename($webpPath);
                        }
                    }

                    // Realiza la actualización en la base de datos
                    if ($model->update($id, $data)) {
                        $updatedData = $model->where('id_categoria', $id)->first();
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


    public function edit($id = null)
    {

        $model = new CategoriaProductoModel();

        $data = $model->where('id_categoria', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }


    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $model = new CategoriaProductoModel();
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
}
