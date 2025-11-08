<?php

namespace App\Controllers;
use App\Models\CategoriaProductoModel;
use App\Models\PromocionesresponsiveModel;
use CodeIgniter\Controller;

class Promocionesresponsive extends Controller
{
    protected $bannertiendaModel;

    public function __construct()
    {
        // Carga el modelo correcto
        $this->bannertiendaModel = new PromocionesresponsiveModel();
    }

    public function index()
    {

        $categoriaModel = new CategoriaProductoModel();
        $data['categorias'] = $categoriaModel->findAll();
        $data['banners'] = $this->bannertiendaModel->findAll();
        return view('admin/promocionesresponsive', $data);
    }

    public function store()
    {
        helper(['form', 'url']);

        $bannertiendaModel = new PromocionesresponsiveModel();

        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');
            $data = [
                'id_categorias' => $this->request->getPost('id_categorias'),
                'id_subcategoria' => $this->request->getPost('id_subcategoria'),
                'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                'fecha_fin' => $this->request->getPost('fecha_fin'),
            ];
            if (empty($id)) {
                $validationRules = [
                    'id_categorias' => 'required',
                    'id_subcategoria' => 'required',
                    'fecha_inicio' => 'required|valid_date',
                    'fecha_fin' => 'required|valid_date',
                    'imagenbanner' => 'uploaded[imagenbanner]|mime_in[imagenbanner,image/jpg,image/jpeg,image/png]|max_size[imagenbanner,2048]',
                ];
                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('imagenbanner');
                    $newFileName = $imageFile->getRandomName();
                    $imageFile->move(ROOTPATH . 'public/assets/image/img_tienda/promocionesresponsive', $newFileName);
                    $uploadedPath = ROOTPATH . 'public/assets/image/img_tienda/promocionesresponsive/' . $newFileName;
                    $webpPath = ROOTPATH . 'public/assets/image/img_tienda/promocionesresponsive/' . pathinfo($newFileName, PATHINFO_FILENAME) . '.webp';
                    $this->convertToWebp($uploadedPath, $webpPath);
                    unlink($uploadedPath);
                    $data['estado'] = 1;
                    $data['imagenbanner'] = pathinfo($newFileName, PATHINFO_FILENAME) . '.webp';
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
                $validationRules = [
                    'id_categorias' => 'required',
                    'id_subcategoria' => 'required',
                    'fecha_inicio' => 'required|valid_date',
                    'fecha_fin' => 'required|valid_date',
                ];
                if ($this->request->getFile('imagenbanner')->isValid() && !$this->request->getFile('imagenbanner')->hasMoved()) {
                    $validationRules['imagenbanner'] = 'uploaded[imagenbanner]|mime_in[imagenbanner,image/jpg,image/jpeg,image/png]|max_size[imagenbanner,2048]';
                }
                if ($this->validate($validationRules)) {
                    if ($this->request->getFile('imagenbanner')->isValid() && !$this->request->getFile('imagenbanner')->hasMoved()) {
                        $imageFile = $this->request->getFile('imagenbanner');
                        $newFileName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/assets/image/img_tienda/promocionesresponsive', $newFileName);
                        $uploadedPath = ROOTPATH . 'public/assets/image/img_tienda/promocionesresponsive/' . $newFileName;
                        $webpPath = ROOTPATH . 'public/assets/image/img_tienda/promocionesresponsive/' . pathinfo($newFileName, PATHINFO_FILENAME) . '.webp';
                        $this->convertToWebp($uploadedPath, $webpPath);
                        unlink($uploadedPath);
                        $oldImage = $this->request->getPost('imagen_actual');
                        if ($oldImage && file_exists(ROOTPATH . 'public/assets/image/img_tienda/promocionesresponsive/' . $oldImage)) {
                            unlink(ROOTPATH . 'public/assets/image/img_tienda/promocionesresponsive/' . $oldImage);
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

    public function actualizar_estado($id, $nuevoEstado)
    {
        $bannertiendaModel = new PromocionesresponsiveModel();
        $data = ['estado' => $nuevoEstado];  // Usamos el parámetro $estado en lugar de $nuevoEstado
    
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
                    $image_path = FCPATH . 'public/assets/image/img_tienda/promocionesresponsive/' . $banner['imagenbanner'];
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