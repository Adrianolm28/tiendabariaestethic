<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use App\Models\ServiciosModel;

class Servicios extends BaseController
{


    public function servicios()
    {

        $servicios = new ServiciosModel();
        $data['servicios'] = $servicios->findAll();

        echo view("admin/admin_header.php");
        echo view('admin/servicios', $data);
        echo view("admin/admin_footer");
    }

    public function store()
    {
        helper(['form', 'url']);

        $servicios = new ServiciosModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id'); //verificamos si el id esta vacio.
            if (empty($id)) {

                $validationRules = [
                    'txtTitulo' => 'required',
                    'txtDescripcion' => 'required',
                    'icono' => 'uploaded[icono]|mime_in[icono,image/jpg,image/jpeg,image/png]|max_size[icono,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('icono');
                    $newFileName = $imageFile->getRandomName();

                    // Mover la imagen a la ubicación deseada
                    $imageFile->move(ROOTPATH . 'public/assets/image/others', $newFileName);

                    $data = [
                        'titulo' => $this->request->getPost('txtTitulo'),
                        'descripcion' => $this->request->getPost('txtDescripcion'),
                        'icono' =>  $newFileName,
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
                    'txtTitulo' => 'required',
                    'txtDescripcion' => 'required',
                    'icono' => 'mime_in[icono,image/jpg,image/jpeg,image/png]|max_size[icono,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        'titulo' => $this->request->getPost('txtTitulo'),
                        'descripcion' => $this->request->getPost('txtDescripcion'),
                    ];

                    $imageFile = $this->request->getFile('icono');

                    if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                        $newFileName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/assets/image/others', $newFileName);
                        $data['icono'] = $newFileName;
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

        $servicios = new ServiciosModel();

        $data = $servicios->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }


    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $servicios = new ServiciosModel();
        $data = ['estado' => $nuevoEstado];

        if ($servicios->update($id, $data)) {
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
