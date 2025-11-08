<?php

namespace App\Controllers;

use App\Models\SoporteModel;

class Soporte extends BaseController
{

    public function soporte()
    {
        $soporte = new SoporteModel();
        $data['soporte'] = $soporte->findAll();

        echo view("admin/admin_header.php");
        echo view('admin/soporte', $data);
        echo view("admin/admin_footer");
    }


    public function store()
    {
        helper(['form', 'url']);
        $soporte = new SoporteModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id'); // Obtener el ID de la empresa que se va a actualizar

            $validationRules = [
                'txtTitulo_soporte' => 'required',
                'txtParrafo_soporte' => 'required',
                'txtSub1_soporte' => 'required',
                'txtSub2_soporte' => 'required',
                'txtSub3_soporte' => 'required',
                'txtSub_parrafo1' => 'required',
                'txtSub_parrafo2' => 'required',
                'txtSub_parrafo3' => 'required',
                'imagen_soporte' => 'mime_in[imagen_soporte,image/jpg,image/jpeg,image/png]|max_size[imagen_soporte,2048]',
            ];

            if ($this->validate($validationRules)) {
                // Obtener los valores actualizados desde el formulario
                $data = [
                    'titulo_soporte' => $this->request->getPost('txtTitulo_soporte'),
                    'parrafo_soporte' => $this->request->getPost('txtParrafo_soporte'),
                    'sub1_soporte' => $this->request->getPost('txtSub1_soporte'),
                    'sub2_soporte' => $this->request->getPost('txtSub2_soporte'),
                    'sub3_soporte' => $this->request->getPost('txtSub3_soporte'),
                    'sub_parrafo1' => $this->request->getPost('txtSub_parrafo1'),
                    'sub_parrafo2' => $this->request->getPost('txtSub_parrafo2'),
                    'sub_parrafo3' => $this->request->getPost('txtSub_parrafo3'),
                ];

                // Verificar si se está intentando actualizar la imagen de la empresa
                if ($this->request->getFile('imagen_soporte')->isValid() && !$this->request->getFile('imagen_soporte')->hasMoved()) {
                    $imageFile = $this->request->getFile('imagen_soporte');
                    $newFileName = $imageFile->getRandomName();

                    // Mover la imagen a la ubicación deseada
                    $imageFile->move(ROOTPATH . 'public/assets/image', $newFileName);

                    $data['empresa_logo'] = $newFileName;
                }

                // Realizar la actualización en la base de datos
                $result = $soporte->update($id, $data);

                if ($result) {
                    // Redirigir al usuario a la página de visualización de la empresa o a donde desees
                    return redirect()->to('admin/soporte');
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
