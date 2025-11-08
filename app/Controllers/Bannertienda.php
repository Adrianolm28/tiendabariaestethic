<?php

namespace App\Controllers;

use App\Models\BannerTiendaModel;
use App\Models\CategoriaProductoModel;
use App\Models\ProductoModel;
use CodeIgniter\Controller;

class Bannertienda extends Controller
{
    protected $bannerModel;

    public function __construct()
    {
        // Carga el modelo BannerTiendaModel
        $this->bannerModel = new BannerTiendaModel();
    }

    public function index()
    {
        // Obtiene todos los banners

        $categoriaModel = new CategoriaProductoModel();
        $productoModel = new ProductoModel();  

        $data['categorias'] = $categoriaModel->findAll();
        $data['banners'] = $this->bannerModel->obtenerBanners();
        $data['productos'] = $productoModel->findAll(); 
       
        // Carga la vista
        return view('admin/bannertienda', $data);
    }

    public function store()
    {
        helper(['form', 'url']);

        $bannerModel = new BannerTiendaModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id');
            
            if (empty($id)) {
                $validationRules = [
                    'imagenbanner' => 'uploaded[imagenbanner]|mime_in[imagenbanner,image/jpg,image/jpeg,image/png,image/webp]|max_size[imagenbanner,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('imagenbanner');

                    $webpPath = $this->convertirAWebP($imageFile, ROOTPATH . 'public/assets/image/img_tienda/bannerstienda');

                    $data = [

                        'imagenbanner' =>  basename($webpPath),
                        'orden' => $this->request->getPost('orden'),
                        'id_categorias' => $this->request->getPost('id_categorias'),
                        'id_producto' =>$this->request->getPost('id_producto'),
                        'estado' => 1,

                    ];


                    

                    $save = $bannerModel->insert_data($data);

                    if ($save != false) {
                        $data = $bannerModel->where('id', $save)->first();
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
                    'imagenbanner' => 'mime_in[imagenbanner,image/jpg,image/jpeg,image/png,image/webp]|max_size[imagenbanner,2048]',
                
                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        'orden' => $this->request->getPost('orden'),
                        'id_categorias' => $this->request->getPost('id_categorias'),
                        'id_producto' =>$this->request->getPost('id_producto'),
                    ];

                    $imageFile = $this->request->getFile('imagenbanner');

                    if ($imageFile->isValid() && !$imageFile->hasMoved()) {

                        $webpPath = $this->convertirAWebP($imageFile, ROOTPATH . 'public/assets/image/img_tienda/bannerstienda');
                        $data['imagenbanner'] = basename($webpPath);
                    }

                    // Realiza la actualización en la base de datos
                    if ($bannerModel->update($id, $data)) {
                        $updatedData = $bannerModel->where('id', $id)->first();
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

        $bannerModel = new BannerTiendaModel();

        $data = $bannerModel->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $bannerModel = new BannerTiendaModel();
        $data = ['estado' => $nuevoEstado];

        if ($bannerModel->update($id, $data)) {
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


    public function eliminar($id)
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
            $nombreArchivoOriginal = $imagen->getRandomName();
            $rutaOriginal = $imagen->getTempName();
            $extension = strtolower(pathinfo($nombreArchivoOriginal, PATHINFO_EXTENSION));

            // Si ya es webp, solo mover el archivo
            if ($extension === 'webp') {
                $rutaWebP = $rutaDestino . '/' . $nombreArchivoOriginal;
                $imagen->move($rutaDestino, $nombreArchivoOriginal);
                return $rutaWebP;
            }

            // Crear una imagen a partir del archivo original
            if ($extension === 'jpg' || $extension === 'jpeg') {
                $imagenOriginal = imagecreatefromjpeg($rutaOriginal);
            } elseif ($extension === 'png') {
                $imagenOriginal = imagecreatefrompng($rutaOriginal);
            } else {
                // Si el archivo no es JPG, PNG ni WEBP, retornar false
                return false;
            }

            // Crear una imagen WebP vacía con el mismo tamaño
            $imagenWebP = imagecreatetruecolor(imagesx($imagenOriginal), imagesy($imagenOriginal));
            imagecopy($imagenWebP, $imagenOriginal, 0, 0, 0, 0, imagesx($imagenOriginal), imagesy($imagenOriginal));
            $nombreArchivoWebP = pathinfo($nombreArchivoOriginal, PATHINFO_FILENAME) . '.webp';
            $rutaWebP = $rutaDestino . '/' . $nombreArchivoWebP;
            imagewebp($imagenWebP, $rutaWebP);
            imagedestroy($imagenOriginal);
            imagedestroy($imagenWebP);
            return $rutaWebP;
        }
        return false;
    }
}