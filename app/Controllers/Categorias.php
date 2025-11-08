<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use App\Models\CategoriasModel;

class Categorias extends BaseController
{
    public function categorias()
    {

        $categorias = new CategoriasModel();
        $data['categorias'] = $categorias->findAll();

        echo view("admin/admin_header.php");
        echo view('admin/categorias', $data);
        echo view("admin/admin_footer");
    }

    public function store()
    {
        $categoriasModel = new CategoriasModel();

        $id = $this->request->getPost('id');

        $data = [
            'nombre_categoria' => $this->request->getPost('txtNombre_categoria'),
            'descripcion_categoria' => $this->request->getPost('txtDescripcion_categoria'),
            'estado' => 1,
        ];

        if (empty($id)) {
            // Si el ID está vacío, realiza una inserción
            if ($categoriasModel->insert($data)) {
                echo json_encode(array("status" => true, 'message' => 'Datos insertados con éxito.'));
            } else {
                echo json_encode(array("status" => false, 'message' => 'Error al insertar datos.'));
            }
        } else {
            // Si se proporciona un ID, realiza una actualización
            $existingData = $categoriasModel->find($id);

            if (!$existingData) {
                echo json_encode(array("status" => false, 'message' => 'ID no válido, los datos no se pueden actualizar.'));
                return;
            }

            if ($categoriasModel->update($id, $data)) {
                echo json_encode(array("status" => true, 'message' => 'Datos actualizados con éxito.'));
            } else {
                echo json_encode(array("status" => false, 'message' => 'Error al actualizar datos.'));
            }
        }
    }


    public function edit($id = null)
    {

        $categorias = new CategoriasModel();

        $data = $categorias->where('id', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }


    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $categorias = new CategoriasModel();
        $data = ['estado' => $nuevoEstado];

        if ($categorias->update($id, $data)) {
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
