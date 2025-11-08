<?php

namespace App\Controllers;

use App\Models\BannertiendaresponsiveModel;
use App\Models\CategoriaProductoModel;
use CodeIgniter\Controller;

class Bannertiendaresponsive extends Controller
{
    protected $bannertiendaModel;

    public function __construct()
    {
        // Carga el modelo correcto
        $this->bannertiendaModel = new BannertiendaresponsiveModel();
    }

    public function index()
    {
        $categoriaModel = new CategoriaProductoModel();
        $data['categorias'] = $categoriaModel->findAll();
        $data['banners'] = $this->bannertiendaModel->findAll();
        return view('admin/bannertiendaresponsive', $data);
    }

    public function store()
    {
        helper(['form', 'url']);

        $bannertiendaModel = new BannertiendaresponsiveModel();

        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');

            if (empty($id)) {
                $validationRules = [
                    'id_categorias' => 'required',
                    'imagenbanner' => 'uploaded[imagenbanner]|mime_in[imagenbanner,image/jpg,image/jpeg,image/png]|max_size[imagenbanner,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('imagenbanner');
                    $newFileName = $imageFile->getRandomName();
                    
                    // Ruta original
                    $imageFile->move(ROOTPATH . 'public/assets/image/img_tienda/bannerresponsive', $newFileName);
    
                    // Ruta de la imagen movida
                    $uploadedPath = ROOTPATH . 'public/assets/image/img_tienda/bannerresponsive/' . $newFileName;
                    
                    // Convertir a formato .webp
                    $webpPath = ROOTPATH . 'public/assets/image/img_tienda/bannerresponsive/' . pathinfo($newFileName, PATHINFO_FILENAME) . '.webp';
                    $this->convertToWebp($uploadedPath, $webpPath);
    
                    // Eliminar la imagen original después de convertirla (opcional)
                    unlink($uploadedPath);
    
                    $data = [
                        'id_categorias' => $this->request->getPost('id_categorias'),
                        'estado' => 1,
                        'imagenbanner' => pathinfo($newFileName, PATHINFO_FILENAME) . '.webp',
                    ];
    
                    $save = $this->bannertiendaModel->insert($data);
    
                    if ($save != false) {
                        $data = $bannertiendaModel->where('id', $save)->first();
                        echo json_encode(array("status" => true, 'data' => $data));
                    } else {
                        echo json_encode(array("status" => false, 'data' => $data));
                    }
                } else {
                    echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                }
            } else {
                // Lógica para actualizar
                $validationRules = [
                    'id_categorias' => 'required',
                ];

                // Solo validar imagen si se sube una nueva
                if ($this->request->getFile('imagenbanner')->isValid() && !$this->request->getFile('imagenbanner')->hasMoved()) {
                    $validationRules['imagenbanner'] = 'uploaded[imagenbanner]|mime_in[imagenbanner,image/jpg,image/jpeg,image/png]|max_size[imagenbanner,2048]';
                }

                if ($this->validate($validationRules)) {
                    $data = [
                        'id_categorias' => $this->request->getPost('id_categorias'),
                    ];

                    // Si hay nueva imagen, procesar
                    if ($this->request->getFile('imagenbanner')->isValid() && !$this->request->getFile('imagenbanner')->hasMoved()) {
                        $imageFile = $this->request->getFile('imagenbanner');
                        $newFileName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/assets/image/img_tienda/bannerresponsive', $newFileName);
                        $uploadedPath = ROOTPATH . 'public/assets/image/img_tienda/bannerresponsive/' . $newFileName;
                        $webpPath = ROOTPATH . 'public/assets/image/img_tienda/bannerresponsive/' . pathinfo($newFileName, PATHINFO_FILENAME) . '.webp';
                        $this->convertToWebp($uploadedPath, $webpPath);
                        unlink($uploadedPath);

                        // Eliminar imagen anterior si existe
                        $oldImage = $this->request->getPost('imagen_actual');
                        if ($oldImage && file_exists(ROOTPATH . 'public/assets/image/img_tienda/bannerresponsive/' . $oldImage)) {
                            unlink(ROOTPATH . 'public/assets/image/img_tienda/bannerresponsive/' . $oldImage);
                        }

                        $data['imagenbanner'] = pathinfo($newFileName, PATHINFO_FILENAME) . '.webp';
                    }

                    $save = $this->bannertiendaModel->update($id, $data);

                    if ($save !== false) {
                        $data = $bannertiendaModel->find($id);
                        echo json_encode(array("status" => true, 'data' => $data));
                    } else {
                        echo json_encode(array("status" => false, 'data' => $data));
                    }
                } else {
                    echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                }
            }
        }
    }

    public function edit($id = null)
    {
        $data = $this->bannertiendaModel->find($id);
        echo json_encode($data ? ["status" => true, 'data' => $data] : ["status" => false]);
    }

    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $bannertiendaModel = new BannertiendaresponsiveModel();
        $data = ['estado' => $nuevoEstado];

        if ($bannertiendaModel->update($id, $data)) {
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
            $banner = $this->bannertiendaModel->find($id);

            if ($banner) {
                // Eliminar la imagen física si existe
                if ($banner['imagenbanner']) {
                    $image_path = FCPATH . 'public/assets/image/img_tienda/bannerresponsive/' . $banner['imagenbanner'];
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }

                // Eliminar el registro en la base de datos
                $this->bannertiendaModel->delete($id);

                echo json_encode(['status' => true]);
            } else {
                echo json_encode(['status' => false]);
            }
    }

    private function convertToWebp($sourcePath, $destinationPath)
        {
            if (!file_exists($sourcePath)) {
                return false;
            }

            $imageType = mime_content_type($sourcePath);
            $image = null;

            switch ($imageType) {
                case 'image/jpeg':
                    $image = imagecreatefromjpeg($sourcePath);
                    break;
                case 'image/png':
                    $image = imagecreatefrompng($sourcePath);
                    break;
                default:
                    return false; // Formato no soportado
            }

            if ($image) {
                imagewebp($image, $destinationPath, 80); // Guardar como WebP
                imagedestroy($image);
                return true;
            }
            return false;
        }
   
}