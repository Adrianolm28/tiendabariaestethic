<?php

namespace App\Controllers;
use App\Models\CategoriaProductoModel;
use App\Models\CategoriasPcModel;
use CodeIgniter\Controller;

class Categoriaspc extends Controller{

    protected $bannertiendaModel;

    public function __construct()
    {
        // Carga el modelo correcto
       
        $this->categoriaPcModel = new CategoriasPcModel();
    }

    public function index()
    {
        $categoriaModel = new CategoriaProductoModel();
        $data['categorias'] = $categoriaModel->findAll();
        $data['categoriaspc'] = $this->categoriaPcModel->findAll();
        return view('admin/categoriaspc', $data);
    }

    public function store()
    {
        helper(['form', 'url']);
        $categoriaPcModel = new CategoriasPcModel();

        if ($this->request->getPost()) {
            $validationRules = [
                'id_categorias' => 'required',
                'nombre_image' => 'required',
                'texto' => 'required',
                'imagenbanner' => 'uploaded[imagenbanner]|mime_in[imagenbanner,image/jpg,image/jpeg,image/png]|max_size[imagenbanner,2048]',
            ];

            if ($this->validate($validationRules)) {
                $imageFile = $this->request->getFile('imagenbanner');
                $newFileName = $imageFile->getRandomName();
                $imageFile->move(ROOTPATH . 'public/assets/image/img_tienda/categoriaspc', $newFileName);

                $uploadedPath = ROOTPATH . 'public/assets/image/img_tienda/categoriaspc/' . $newFileName;
                $webpPath = ROOTPATH . 'public/assets/image/img_tienda/categoriaspc/' . pathinfo($newFileName, PATHINFO_FILENAME) . '.webp';
                $this->convertToWebp($uploadedPath, $webpPath);
                unlink($uploadedPath);

                $data = [
                    'id_categorias' => $this->request->getPost('id_categorias'),
                    'estado' => 1,
                    'nombre_image' => $this->request->getPost('nombre_image'),
                    'texto' => $this->request->getPost('texto'),
                    'imagenbanner' => pathinfo($newFileName, PATHINFO_FILENAME) . '.webp',
                ];

                if ($categoriaPcModel->insert($data)) {
                    return $this->response->setJSON(['status' => true, 'message' => 'Registro guardado correctamente.']);
                }
            }

            return $this->response->setJSON(['status' => false, 'error' => $this->validator->getErrors()]);
        }
    }
    
    /**
     * Función para convertir imágenes a formato WebP
     *
     * @param string $sourcePath Ruta de la imagen original
     * @param string $destinationPath Ruta de la imagen en formato WebP
     * @return void
     */
    private function convertToWebp($sourcePath, $destinationPath)
    {
        $imageType = mime_content_type($sourcePath);
    
        switch ($imageType) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($sourcePath);
                imagepalettetotruecolor($image); // Evitar problemas con transparencias
                break;
            default:
                return; // Formato no soportado
        }
    
        // Guardar como WebP
        imagewebp($image, $destinationPath, 80); // Calidad 80%
        imagedestroy($image);
    }
    
    
    public function edit($id = null)
    {

        $categoriaPcModel = new CategoriasPcModel();

        $data = $categoriaPcModel->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }


    public function actualizar_estado($id = null, $nuevoEstado)
    {
         $categoriaPcModel = new CategoriasPcModel();

        $data = ['estado' => $nuevoEstado];

        

        if ($categoriaPcModel->update($id, $data)) {
            $response = [
                'status' => true,
                'message' => 'El estado del testimonio ha cambiado correctamente.',
                'new_status' => $nuevoEstado
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'No se pudo cambiar el estado del testimonio.'
            ];
        }

        return $this->response->setJSON($response);
    }


    
    

    public function eliminar_registro($id)
    {
        $categoriaPcModel = new CategoriasPcModel();
        $registro = $categoriaPcModel->find($id);

        if ($registro) {
            // Eliminar la imagen física si existe
            $imagePath = FCPATH . 'public/assets/image/img_tienda/categoriaspc/' . $registro['imagenbanner'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Eliminar el registro de la base de datos
            if ($categoriaPcModel->delete($id)) {
                return $this->response->setJSON(['status' => true, 'message' => 'Registro eliminado correctamente.']);
            }
        }

        return $this->response->setJSON(['status' => false, 'message' => 'No se pudo eliminar el registro.']);
    }

    public function update()
    {
        helper(['form', 'url']);
    
        $categoriaPcModel = new CategoriasPcModel();
    
        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');
            $validationRules = [
                'id_categorias' => 'required',
                'nombre_image' => 'required',
                'texto' => 'required',
                'imagenbanner' => 'mime_in[imagenbanner,image/jpg,image/jpeg,image/png]|max_size[imagenbanner,2048]',
            ];
    
            if ($this->validate($validationRules)) {
                $data = [
                    'id_categorias' => $this->request->getPost('id_categorias'),
                    'nombre_image' => $this->request->getPost('nombre_image'),
                    'texto' => $this->request->getPost('texto'),
                ];
    
                // Handle image upload if a new image is provided
                if ($this->request->getFile('imagenbanner')->isValid()) {
                    $imageFile = $this->request->getFile('imagenbanner');
                    $newFileName = $imageFile->getRandomName();
    
                    // Move the new image
                    $imageFile->move(ROOTPATH . 'public/assets/image/img_tienda/categoriaspc', $newFileName);
    
                    // Convert to WebP
                    $uploadedPath = ROOTPATH . 'public/assets/image/img_tienda/categoriaspc/' . $newFileName;
                    $webpPath = ROOTPATH . 'public/assets/image/img_tienda/categoriaspc/' . pathinfo($newFileName, PATHINFO_FILENAME) . '.webp';
                    $this->convertToWebp($uploadedPath, $webpPath);
    
                    // Delete the original image after conversion
                    unlink($uploadedPath);
    
                    // Update the image path in the data array
                    $data['imagenbanner'] = pathinfo($newFileName, PATHINFO_FILENAME) . '.webp';
    
                    // Delete the old image if it exists
                    $oldImage = $this->request->getPost('imagen_actual');
                    if ($oldImage) {
                        $oldImagePath = ROOTPATH . 'public/assets/image/img_tienda/categoriaspc/' . $oldImage;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                }
    
                // Update the record
                if ($categoriaPcModel->update($id, $data)) {
                    return $this->response->setJSON(['status' => true, 'message' => 'Registro actualizado correctamente.']);
                } else {
                    return $this->response->setJSON(['status' => false, 'message' => 'No se pudo actualizar el registro.']);
                }
            } else {
                return $this->response->setJSON(['status' => false, 'error' => $this->validator->getErrors()]);
            }
        }
    }

}











