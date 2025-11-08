<?php

namespace App\Controllers;

use App\Models\CategoriaProductoModel;
use App\Models\OfertasDescuentoModel;
use App\Models\SubcategoriaProductoModel;
use \CodeIgniter\Controller;


class Ofertasdescuento extends BaseController
{
    public function index()
    {
        $categoriaModel = new CategoriaProductoModel();
        $model = new OfertasDescuentoModel();

        // Desactivar ofertas expiradas
        $model->desactivarOfertasExpiradas();

        // Obtener ofertas con nombres de categoría y subcategoría
        $data['ofertas_descuento'] = $model->obtenerOfertasConNombres();
        $data['categorias'] = $categoriaModel->findAll();
        return view('admin/ofertasdescuento', $data);
    }







    public function store()
    {
        helper(['form', 'url']);

        $model = new OfertasDescuentoModel();



        if ($this->request->getPost()) {
            $id = $this->request->getPost('id');
            if (empty($id)) {



                $validationRules = [
                    'categoria_producto' => 'required',
                    'imagen_oferta' => 'mime_in[imagen_oferta,image/jpg,image/jpeg,image/png]|max_size[imagen_oferta,2048]',
                    'fecha_inicio' => 'required|valid_date',
                    'fecha_fin' => 'required|valid_date',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('imagen_oferta');
                    $webpPath = $this->convertirAWebP($imageFile, ROOTPATH . 'public/assets/img_tienda/img_ofertas');

                    if ($webpPath) {
                        $data = [
                            'id_categoria' => $this->request->getPost('categoria_producto'),
                            'id_subcategoria' => $this->request->getPost('subcategoria_producto'),
                            'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                            'fecha_fin' => $this->request->getPost('fecha_fin'),
                            'imagen_oferta' => basename($webpPath),
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

                    'categoria_producto' => 'required',
                    'imagen_oferta' => 'mime_in[imagen_oferta,image/jpg,image/jpeg,image/png]|max_size[imagen_oferta,2048]',
                    'fecha_inicio' => 'required|valid_date',
                    'fecha_fin' => 'required|valid_date',

                ];

                if ($this->validate($validationRules)) {

                    $data = [
                        'id_categoria' => $this->request->getPost('categoria_producto'),
                        'id_subcategoria' => $this->request->getPost('subcategoria_producto'),
                        'fecha_inicio' => $this->request->getPost('fecha_inicio'),
                        'fecha_fin' => $this->request->getPost('fecha_fin'),
                    ];

                    $imageFile = $this->request->getFile('imagen_oferta');

                    if (!empty($imageFile) && $imageFile->isValid() && !$imageFile->hasMoved()) {
                        $webpPath = $this->convertirAWebP($imageFile, ROOTPATH . 'public/assets/img_tienda/img_ofertas');
                        if ($webpPath) {
                            $data['imagen_oferta'] = basename($webpPath);
                        }
                    }


                    // Realiza la actualización en la base de datos
                    if ($model->update($id, $data)) {
                        $updatedData = $model->where('id_oferta', $id)->first();
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

        $model = new OfertasDescuentoModel();

        $data = $model->where('id_oferta', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }


    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $model = new OfertasDescuentoModel();
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

    public function desactivarOfertasVencidas()
    {
        $model = new OfertasDescuentoModel();
        $currentDate = date('Y-m-d');

        $model->where('fecha_fin <', $currentDate)
            ->set('estado', 0)
            ->update();

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Ofertas vencidas desactivadas correctamente.'
        ]);
    }


    public function eliminar_registro()
    {

        $model = new OfertasDescuentoModel();
        $id = $this->request->getPost('id');

        if($id){
            $banner = $model->find($id);
            if ($banner && !empty($banner['imagen_oferta'])) {
                // Construir la ruta completa a la imagen
                $image_path = FCPATH . 'public/assets/img_tienda/img_ofertas/' . $banner['imagen_oferta'];
    
                // Eliminar la imagen si existe
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $model->delete($id);
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Imagen eliminada y registro de base de datos eliminado.',
            ]);
            
        }else {
            
            return $this->response->setJSON([
                'status' => false,
                'message' => 'ID no válido o no proporcionado.',
            ]);
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
