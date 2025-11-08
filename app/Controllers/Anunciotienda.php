<?php

namespace App\Controllers;

use App\Models\AnunciotiendaModel;
use App\Models\BannerTiendaModel;
use App\Models\CategoriaProductoModel;
use App\Models\ProductoModel;
use CodeIgniter\Controller;

class Anunciotienda extends Controller
{
    protected $anunciotiendaModel;

    public function __construct()
    {
        // Carga el modelo BannerTiendaModel
        $this->anunciotiendaModel  = new AnunciotiendaModel();
    }

    public function index()
    {

        $anunciotienda = $this->anunciotiendaModel->getAnunciosConDetalles();

        $categoriaModel = new CategoriaProductoModel();
        $anunciotiendaModel = new AnunciotiendaModel();
        $productoModel = new ProductoModel();

        $data['categorias'] = $categoriaModel->findAll();
        $data['anunciotienda'] = $anunciotienda;
        $data['productos'] = $productoModel->findAll();

        // Carga la vista
        return view('admin/anunciotienda', $data);
    }

    public function store()
    {
        helper(['form', 'url']);

        $anunciotiendaModel = new AnunciotiendaModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id');

            if (empty($id)) {
                $validationRules = [

                    'imagenanuncio' => 'uploaded[imagenanuncio]|mime_in[imagenanuncio,image/jpg,image/jpeg,image/png]|max_size[imagenanuncio,2048]',

                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('imagenanuncio');

                    $webpPath = $this->convertirAWebP($imageFile, ROOTPATH . 'public/assets/tienda/img');

                    $data = [

                        'imagen_anuncio' =>  basename($webpPath),
                        'id_categoria' => $this->request->getPost('id_categorias'),
                        'id_producto' => $this->request->getPost('id_producto'),
                        'estado' => 1,

                    ];




                    $save = $anunciotiendaModel->insert_data($data);

                    if ($save != false) {
                        $data = $anunciotiendaModel->where('id', $save)->first();
                        echo json_encode(array("status" => true, 'data' => $data));
                    } else {
                        echo json_encode(array("status" => false, 'data' => $data));
                    }
                } else {
                    // Manejar errores de validación y carga de archivos
                    echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                }
            } else {
                /* Aqui actualiza */
                $validationRules = [
                    'imagenanuncio' => 'mime_in[imagenanuncio,image/jpg,image/jpeg,image/png]|max_size[imagenanuncio,2048]',

                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        
                        'id_categoria' => $this->request->getPost('id_categorias'),
                        'id_producto' => $this->request->getPost('id_producto'),
                    ];

                    $imageFile = $this->request->getFile('imagenanuncio');

                    if ($imageFile->isValid() && !$imageFile->hasMoved()) {

                        $webpPath = $this->convertirAWebP($imageFile, ROOTPATH . 'public/assets/image/img_tienda/bannerstienda');
                        $data['imagen_anuncio'] = basename($webpPath);
                    }

                    // Realiza la actualización en la base de datos
                    if ($anunciotiendaModel->update($id, $data)) {
                        $updatedData = $anunciotiendaModel->where('id', $id)->first();
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

    public function edit($id = null)
    {

        $anunciotiendaModel = new AnunciotiendaModel();

        $data = $anunciotiendaModel->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $anunciotiendaModel = new AnunciotiendaModel();
        $data = ['estado' => $nuevoEstado];

        if ($anunciotiendaModel->update($id, $data)) {
            $response = [
                'status' => true,
                'message' => 'El estado del servicio ha cambiado correctamente.',
                'new_status' => $nuevoEstado
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'No se pudo cambiar el estado del servicio',
            ];
        }

        return $this->response->setJSON($response);
    }


    public function eliminar_registro($id)
    {
        // Asegúrate de usar el modelo correcto
        $banner = $this->bannerModel->find($id);

        if ($banner) {
            // Eliminar la imagen física si existe
            if ($banner['imagenbanner']) {
                $image_path = FCPATH . 'public/assets/image/img_tienda/bannertienda/' . $banner['imagenbanner'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            // Eliminar el registro en la base de datos
            $this->bannerModel->delete($id);

            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
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
}
