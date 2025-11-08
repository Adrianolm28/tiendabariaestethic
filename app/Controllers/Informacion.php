<?php

namespace App\Controllers;

use App\Models\InformacionModel;

class Informacion extends BaseController
{


    public function informacion()
    {

        $informacion = new InformacionModel();
        $data['informacion'] = $informacion->findAll();

        echo view("admin/admin_header.php");
        echo view('admin/informacion', $data);
        echo view("admin/admin_footer");
    }

    public function store()
    {
        helper(['form', 'url']);
        $informacion = new InformacionModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id'); // Obtener el ID de la empresa que se va a actualizar

            
            $validationRules = [
                'txtInfo_Titulo' => 'required',
                'txtInfo_descripcion' => 'required',
                'txtText_icono1' => 'required',
                'txtText_icono2' => 'required',
                'txtText_icono3' => 'required',
            ];

            // Verificar si se están subiendo imágenes
            $imageFields = ['info_logo', 'info_icono1', 'info_icono2', 'info_icono3'];
            foreach ($imageFields as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $validationRules[$field] = 'uploaded[' . $field . ']|mime_in[' . $field . ',image/jpg,image/jpeg,image/png]|max_size[' . $field . ',2048]';
                }
            }

            if ($this->validate($validationRules)) {
                // Obtener los valores actualizados desde el formulario
                $data = [
                    'info_titulo' => $this->request->getPost('txtInfo_Titulo'),
                    'info_descripcion' => $this->request->getPost('txtInfo_descripcion'),
                    'text_icono1' => $this->request->getPost('txtText_icono1'),
                    'text_icono2' => $this->request->getPost('txtText_icono2'),
                    'text_icono3' => $this->request->getPost('txtText_icono3'),
                ];

                // Procesar y mover las imágenes si se han subido
                foreach ($imageFields as $field) {
                    if (!empty($_FILES[$field]['name'])) {
                        $imageFile = $this->request->getFile($field);
                        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                            $newFileName = $imageFile->getRandomName();
                            $imageFile->move(ROOTPATH . 'public/assets/image/others', $newFileName);
                            $data[$field] = $newFileName;
                        }
                    }
                }

                // Realizar la actualización en la base de datos
                $result = $informacion->update($id, $data);

                if ($result) {
                    // Redirigir al usuario a la página de visualización de la empresa o a donde desees
                    return redirect()->to('admin/informacion');
                } else {
                    echo json_encode(array("status" => false, 'message' => 'Error al actualizar'));
                }
            } else {
                // Manejar errores de validación
                echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
            }
        }
    }
}
