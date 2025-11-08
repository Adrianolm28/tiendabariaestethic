<?php

namespace App\Controllers;

use App\Models\MarcasProductosModel;
use \CodeIgniter\Controller;


class Marcasproductos extends BaseController
{
    public function index()
    {
        $model = new MarcasProductosModel();
        $data['marcas'] = $model->findAll();
        return view('admin/marcasproductos',$data); 
    }


    public function getMarcas()
    {
        $model = new MarcasProductosModel();
        $marcas = $model->findAll();
        $data = [];
        foreach ($marcas as $categoria){

            
            $data[] = [
                'id_marca' => $categoria['id_marca'],
                'nombre' => $categoria['nombre'],
                'descripcion' => $categoria['descripcion'],
                'estado' => $categoria['estado'],
                'acciones' => '<button class="btn btn-primary">Editar</button>'
            ];
           
        }
        return $this->response->setJSON(['data' => $data]);
    } 
    

    public function store()
    {
        helper(['form', 'url']);

        $model = new MarcasProductosModel();
        if ($this->request->getPost()) {

            $id = $this->request->getPost('id_marca');
            if (empty($id)) {
                $nombre = $this->request->getPost('nombre'); // Obtener el nombre del producto del formulario
                $existe_marca = $model->where('nombre', $nombre)->first();

                if ($existe_marca) {
                    // Si ya existe un producto con el mismo nombre, mostrar mensaje de error
                    echo json_encode(["status" => false, "error" => "Ya existe una marca con el mismo nombre"]);
                    return; // Detener el proceso de guardado
                }

                $validationRules = [
                    'nombre' => 'required',
                    'descripcion' => 'required',
                  
                ];

                if ($this->validate($validationRules)) {
                

                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        
                        'descripcion' => $this->request->getPost('descripcion'),
                   
                    ];

                    $save = $model->insert_data($data);

                    if ($save != false) {
                        $data = $model->where('id_marca', $save)->first();
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
                    'nombre' => 'required',
                    'descripcion' => 'required',
                   
                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        'descripcion' => $this->request->getPost('descripcion'),
                        
                    ];

               


                    // Realiza la actualización en la base de datos
                    if ($model->update($id, $data)) {
                        $updatedData = $model->where('id_marca', $id)->first();
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

        $model = new MarcasProductosModel();

        $data = $model->where('id_marca', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }


    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $model = new MarcasProductosModel();
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
}
