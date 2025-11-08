<?php

namespace App\Controllers;

use App\Models\EmpresaModel;

class Empresa extends BaseController
{


    public function empresa()
    {
        $empresa = new EmpresaModel();

        $datosEmpresa = $empresa->findAll();

        $data = [
            'datosEmpresa' => $datosEmpresa,
        ];


        echo view("admin/admin_header.php");
        echo view('admin/empresa', $data);
        echo view("admin/admin_footer");
    }

    public function store()
    {
        helper(['form', 'url']);
        $empresa = new EmpresaModel();
    
        if ($this->request->getPost()) {
            
            $id = $this->request->getPost('id'); // Obtener el ID de la empresa que se va a actualizar
    
            $validationRules = [
                'txtDireccion' => 'required',
                'txtTelefono' => 'required',
                'txtRazonsocial' => 'required',
                'txtDescripcion' => 'required',
                'empresa_logo' => 'mime_in[empresa_logo,image/jpg,image/jpeg,image/png]|max_size[empresa_logo,2048]',
            ];
    
            if ($this->validate($validationRules)) {
                // Obtener los valores actualizados desde el formulario
                $data = [
                    'empresa_direccion' => $this->request->getPost('txtDireccion'),
                    'empresa_telefono' => $this->request->getPost('txtTelefono'),
                    'empresa_razonsocial' => $this->request->getPost('txtRazonsocial'),
                    'empresa_correo' => $this->request->getPost('txtCorreo'),
                    'empresa_descripcion' => $this->request->getPost('txtDescripcion'),
                    'empresa_tiktok' => $this->request->getPost('empresa_tiktok'),
                    'empresa_instagram' => $this->request->getPost('empresa_instagram'),
                    'empresa_facebook' => $this->request->getPost('empresa_facebook'),
                    'empresa_youtube' => $this->request->getPost('empresa_youtube'),
                    'empresa_whatsapp' => $this->request->getPost('empresa_whatsapp'),
                ];
    
                // Verificar si se está intentando actualizar la imagen de la empresa
                if ($this->request->getFile('empresa_logo')->isValid() && !$this->request->getFile('empresa_logo')->hasMoved()) {
                    $imageFile = $this->request->getFile('empresa_logo');
                    $newFileName = $imageFile->getRandomName();
    
                    // Mover la imagen a la ubicación deseada
                    $imageFile->move(ROOTPATH . 'public/assets/image/others/logo', $newFileName);
    
                    $data['empresa_logo'] = $newFileName;
                }
    
                // Realizar la actualización en la base de datos
                $result = $empresa->update($id, $data);
    
                if ($result) {
                    if ($this->request->isAJAX()) {
                        return $this->response->setJSON(['status' => true]);
                    }
                    return redirect()->to('admin/empresa')->with('success', true);
                } else {
                    if ($this->request->isAJAX()) {
                        return $this->response->setJSON(['status' => false, 'message' => 'Error al actualizar']);
                    }
                    echo json_encode(array("status" => false, 'message' => 'Error al actualizar'));
                }
            } else {
                // Manejar errores de validación
                if ($this->request->isAJAX()) {
                    return $this->response->setJSON(['status' => false, 'error' => $this->validator->getErrors()]);
                }
                echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
            }
        }
    }
    
}

