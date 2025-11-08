<?php

namespace App\Controllers;

use App\Models\CategoriaProductoModel;
use App\Models\SubcategoriaProductoModel;
use \CodeIgniter\Controller;


class Subcategorias extends BaseController
{
    public function index()
    {
        $categoriaModel = new CategoriaProductoModel();
        $model = new SubcategoriaProductoModel();
        $data['subcategorias'] = $model->findAll();
        $data['categorias'] = $categoriaModel->findAll();
        return view('admin/subcategorias',$data);
    }


    public function getSubcategorias()
    {
        $model = new SubcategoriaProductoModel();
        $subcategorias = $model->getSubcategoriasWithCategoria();
        $data = [];
        foreach ($subcategorias as $sub) {


            $data[] = [
                'id_subcategoria' => $sub['id_subcategoria'],
                'nombre' => $sub['nombre'],
                'id_categoria_principal' => $sub['id_categoria_principal'],
                'categoria_nombre' => $sub['categoria_nombre'],
                'descripcion' => $sub['descripcion'],
                'estado' => $sub['estado'],
                'acciones' => '<button class="btn btn-primary">Editar</button>'
            ];
        }
        return $this->response->setJSON(['data' => $data]);
    }




    public function store()
    {
        helper(['form', 'url']);

        $model = new SubcategoriaProductoModel();

        if ($this->request->getPost()) {
            $id = $this->request->getPost('id_subcategoria');
            if (empty($id)) {
                $nombre = $this->request->getPost('nombre'); // Obtener el nombre del producto del formulario
                $existe_categoria = $model->where('nombre', $nombre)->first();

                if ($existe_categoria) {
                    // Si ya existe un producto con el mismo nombre, mostrar mensaje de error
                    echo json_encode(["status" => false, "error" => "Ya existe una Categoria con el mismo nombre"]);
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
                            'id_categoria_principal' => $this->request->getPost('categoria_producto'),
                            'estado' => 1,
                        ];

                        $save = $model->insert_data($data);

                        if ($save != false) {
                            $data = $model->where('id_subcategoria', $save)->first();
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
                        'id_categoria_principal' => $this->request->getPost('categoria_producto'),
                    ];

                

                    // Realiza la actualización en la base de datos
                    if ($model->update($id, $data)) {
                        $updatedData = $model->where('id_subcategoria', $id)->first();
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

        $model = new SubcategoriaProductoModel();

        $data = $model->where('id_subcategoria', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }


    public function actualizar_estado($id = null, $nuevoEstado)
    {
        $model = new SubcategoriaProductoModel();
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
