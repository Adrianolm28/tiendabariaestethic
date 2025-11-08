<?php

namespace App\Controllers;

use App\Models\TestimoniosModel;

class Testimonios extends BaseController
{

    public function testimonios()
    {

        $testimonios = new TestimoniosModel();
        $data['testimonios'] = $testimonios->findAll();

        echo view("admin/admin_header.php");
        echo view('admin/testimonios', $data);
        echo view("admin/admin_footer");
    }

    public function store()
    {

        
        helper(['form', 'url']);

        $testimonios = new TestimoniosModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id');
            if (empty($id)) {

                $validationRules = [
                    'txtNombre' => 'required',
                    'txtEmpresa' => 'required',
                    'txtComentario' => 'required',
                    'imagen_testimonio' => 'uploaded[imagen_testimonio]|mime_in[imagen_testimonio,image/jpg,image/jpeg,image/png]|max_size[imagen_testimonio,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $imageFile = $this->request->getFile('imagen_testimonio');
                    $newFileName = $imageFile->getRandomName();

                    // Mover la imagen a la ubicación deseada
                    $imageFile->move(ROOTPATH . 'public/assets/image/others', $newFileName);

                    $data = [
                        'nombre' => $this->request->getPost('txtNombre'),
                        'empresa' => $this->request->getPost('txtEmpresa'),
                        'comentario' => $this->request->getPost('txtComentario'),
                        'imagen_testimonio' =>  $newFileName,
                    ];

                    $save = $testimonios->insert_data($data);

                    if ($save != false) {
                        $data = $testimonios->where('id', $save)->first();
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
                    'txtNombre' => 'required',
                    'txtEmpresa' => 'required',
                    'txtComentario' => 'required',
                    'imagen_testimonio' => 'mime_in[imagen_testimonio,image/jpg,image/jpeg,image/png]|max_size[imagen_testimonio,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        'nombre' => $this->request->getPost('txtNombre'),
                        'empresa' => $this->request->getPost('txtEmpresa'),
                        'comentario' => $this->request->getPost('txtComentario'),
                    ];

                    $imageFile = $this->request->getFile('imagen_testimonio');

                    if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                        $newFileName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/assets/image/others', $newFileName);
                        $data['imagen_testimonio'] = $newFileName;
                    }

                    // Realiza la actualización en la base de datos
                    if ($testimonios->update($id, $data)) {
                        $updatedData = $testimonios->where('id', $id)->first();
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

        $testimonios = new TestimoniosModel();

        $data = $testimonios->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    /* public function delete($id)
    {
        $testimonios = new TestimoniosModel();

        // Realiza la eliminación en la base de datos
        if ($testimonios->delete($id)) {
            echo json_encode(array("status" => true, "message" => "Eliminación exitosa"));
        } else {
            echo json_encode(array("status" => false, "message" => "Error al eliminar"));
        }
    }  */

    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $testimoniosModel = new TestimoniosModel();

        $data = ['estado' => $nuevoEstado];

        

        if ($testimoniosModel->update($id, $data)) {
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
}
