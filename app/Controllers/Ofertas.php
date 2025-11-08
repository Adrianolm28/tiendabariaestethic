<?php

namespace App\Controllers;

use App\Models\OfertasModel;
use \CodeIgniter\Controller;




class Ofertas extends BaseController
{


    public function index()
    {
        // Obtiene todos los banners
        $ofertasModel = new OfertasModel();
        $data['ofertas'] = $ofertasModel->where('estado', 1)->findAll();
        
        
        return view('admin/ofertas', $data);
    }



    public function store()
    {
        helper(['form', 'url']);

        $ofertasModel = new OfertasModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id');
            if (empty($id)) {

                $validationRules = [
                   
                    'image' => 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('image');
                    $newFileName = $imageFile->getRandomName();

                    // Mover la imagen a la ubicación deseada
                    $imageFile->move(ROOTPATH . 'public/assets/image/img_tienda/ofertasbanner', $newFileName);

                    $data = [
                   
                        'image' =>  $newFileName,
                        'secs' => $this->request->getPost('secs'),
                        'title' => $this->request->getPost('title'),
                        'description' => $this->request->getPost('description'),
                        'discount' => $this->request->getPost('discount'),
                    ];

                    $save = $ofertasModel->insert_data($data);

                    if ($save != false) {
                        $data = $ofertasModel->where('id', $save)->first();
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
                    /* 'texto' => 'required', */
                    'image' => 'mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        'image' =>  $newFileName,
                        'secs' => $this->request->getPost('secs'),
                        'title' => $this->request->getPost('title'),
                        'description' => $this->request->getPost('description'),
                        'discount' => $this->request->getPost('discount'),
                    ];

                    $imageFile = $this->request->getFile('image');

                    if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                        $newFileName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/assets/image/img_tienda/ofertasbanner', $newFileName);
                        $data['image'] = $newFileName;
                    }

                    // Realiza la actualización en la base de datos
                    if ($ofertasModel->update($id, $data)) {
                        $updatedData = $ofertasModel->where('id', $id)->first();
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

        $ofertasModel = new OfertasModel();

        $data = $ofertasModel->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function delete($id)
    {
        $banner = new OfertasModel();

        // Realiza la eliminación en la base de datos
        if ($banner->delete($id)) {
            echo json_encode(array("status" => true, "message" => "Eliminación exitosa"));
        } else {
            echo json_encode(array("status" => false, "message" => "Error al eliminar"));
        }
    }

    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $ofertasModel = new OfertasModel();
        $data = ['estado' => $nuevoEstado];

        if ($ofertasModel->update($id, $data)) {
            $response = [
                'status' => true,
                'message' => 'El estado del servicio ha cambiado correctamente.',
                'new_status' => $nuevoEstado
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'No se pudo cambiar el estado del servicio.'
            ];
        }

        return $this->response->setJSON($response);
    }

    public function eliminar($id = null)
    {
        $ofertasModel = new OfertasModel();

        if ($ofertasModel->delete($id)) {
            $response = [
                'status' => true,
                'message' => 'La oferta ha sido eliminada con éxito.'
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'No se pudo eliminar la oferta.'
            ];
        }

        return $this->response->setJSON($response);
    }

}
