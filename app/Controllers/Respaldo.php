<?php

namespace App\Controllers;

use App\Models\RespaldoModel;

class Respaldo extends BaseController
{

    public function respaldo()
    {

        $respaldo = new RespaldoModel();
        $data['respaldo'] = $respaldo->findAll();


        echo view("admin/admin_header.php");
        echo view('admin/respaldo', $data);
        echo view("admin/admin_footer");
    }

    public function store()
    {
        helper(['form', 'url']);

        $servicios = new RespaldoModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id'); //verificamos si el id esta vacio.
            if (empty($id)) {

                $validationRules = [

                    'logo_respaldo' => 'uploaded[logo_respaldo]|mime_in[logo_respaldo,image/jpg,image/jpeg,image/png]|max_size[logo_respaldo,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('logo_respaldo');
                    $newFileName = $imageFile->getRandomName();

                    // Mover la imagen a la ubicación deseada
                    $imageFile->move(ROOTPATH . 'public/assets/image/others', $newFileName);

                    $data = [
                        
                        'logo_respaldo' =>  $newFileName,
                    ];

                    $save = $servicios->insert_data($data);

                    if ($save != false) {
                        $data = $servicios->where('id', $save)->first();
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
                 
                    'logo_respaldo' => 'mime_in[logo_respaldo,image/jpg,image/jpeg,image/png]|max_size[logo_respaldo,2048]',
                ];

                if ($this->validate($validationRules)) {
                    /* $data = [
               
                    ];
 */
                    $imageFile = $this->request->getFile('logo_respaldo');

                    if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                        $newFileName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/assets/image/others', $newFileName);
                        $data['logo_respaldo'] = $newFileName;
                    }

                    // Realiza la actualización en la base de datos
                    if ($servicios->update($id, $data)) {
                        $updatedData = $servicios->where('id', $id)->first();
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

        $respaldo = new RespaldoModel();

        $data = $respaldo->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $respaldo = new RespaldoModel();
        $data = ['estado' => $nuevoEstado];

        if ($respaldo->update($id, $data)) {
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
