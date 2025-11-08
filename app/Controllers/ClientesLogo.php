<?php

namespace App\Controllers;


use \CodeIgniter\Controller;
use App\Models\ClienteslogoModel;
use App\Models\TestimoniosModel;

class ClientesLogo extends BaseController
{

    public function clienteslogo()
    {

        $clienteslogo = new ClienteslogoModel();
        $data['clienteslogo'] = $clienteslogo->findAll();

        echo view("admin/admin_header.php");
        echo view('admin/clientes_logo', $data);
        echo view("admin/admin_footer");
    }

    public function store()
    {
        helper(['form', 'url']);

        $clienteslogo = new ClienteslogoModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id'); //verificamos si el id esta vacio.
            if (empty($id)) {

                $validationRules = [
                    'icono_cliente' => 'uploaded[icono_cliente]|mime_in[icono_cliente,image/jpg,image/jpeg,image/png]|max_size[icono_cliente,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('icono_cliente');
                    $newFileName = $imageFile->getRandomName();

                    // Mover la imagen a la ubicación deseada
                    $imageFile->move(ROOTPATH . 'public/assets/image/others', $newFileName);

                    $data = [
                        'icono_cliente' =>  $newFileName,
                    ];

                    $save = $clienteslogo->insert_data($data);

                    if ($save != false) {
                        $data = $clienteslogo->where('id', $save)->first();
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
                    'icono_cliente' => 'mime_in[icono_cliente,image/jpg,image/jpeg,image/png]|max_size[icono_cliente,2048]',
                ];

                if ($this->validate($validationRules)) {
                    /* $data = [
                        'titulo' => $this->request->getPost('txtTitulo'),
                        'descripcion' => $this->request->getPost('txtDescripcion'),
                    ]; */

                    $imageFile = $this->request->getFile('icono_cliente');

                    if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                        $newFileName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/assets/image/others', $newFileName);
                        $data['icono_cliente'] = $newFileName;
                    }

                    // Realiza la actualización en la base de datos
                    if ($clienteslogo->update($id, $data)) {
                        $updatedData = $clienteslogo->where('id', $id)->first();
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

        $clienteslogo = new ClienteslogoModel();

        $data = $clienteslogo->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $clienteslogo = new ClienteslogoModel();
        $data = ['estado' => $nuevoEstado];

        if ($clienteslogo->update($id, $data)) {
            $response = [
                'status' => true,
                'message' => 'El estado del testimonios ha cambiado correctamente.',
                'new_status' => $nuevoEstado
            ];
        } else {
            $response = [
                +'status' => false,
                'message' => 'No se puede cambiar el estado del testimonioa.'
            ];
        }

        return $this->response->setJSON($response);
    }
}
