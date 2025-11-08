<?php

namespace App\Controllers;

use App\Models\ConfiguracionTiendaModel;
use App\Models\IzipayCredentialsModel;
use CodeIgniter\Controller;

class Configuraciontienda extends Controller
{


    public function index()
    {
        $configuraciontienda = new ConfiguracionTiendaModel;
        $izipayCredentialsModel = new IzipayCredentialsModel();
        $configtienda = $configuraciontienda->findAll();
        $izipayCredentials = $izipayCredentialsModel->getCredentials();
        $data = [
            'configtienda' => $configtienda,
            'izipayCredentials' => $izipayCredentials
        ];

        // Carga la vista
        return view('admin/configuraciontienda', $data);
    }

    public function store1()
    {
        helper(['form', 'url']);
        $configuraciontienda = new ConfiguracionTiendaModel();

        if ($this->request->getPost()) {
            $id = $this->request->getPost('id'); // Paso 1: Obtener el ID

            $validationRules = [
                'ruc' => 'required',
                'razon_social' => 'required',
                'correo' => 'required',
                'sobre_nosotros' => 'required',
                'telefono' => 'required',
                'logo_t' => 'mime_in[logo_t,image/jpg,image/jpeg,image/png]|max_size[logo_t,2048]',
            ];

            if ($this->validate($validationRules)) { // Paso 2: Validación de datos
                // Paso 3: Obtener los valores actualizados desde el formulario
                $data = [
                    'ruc' => $this->request->getPost('ruc'),
                    'razon_social' => $this->request->getPost('razon_social'),
                    'correo' => $this->request->getPost('correo'),
                    'sobre_nosotros' => $this->request->getPost('sobre_nosotros'),
                    'telefono' => $this->request->getPost('telefono'),
                    'direccion' => $this->request->getPost('direccion'),
                    'subdominio' => $this->request->getPost('subdominio'),
                    'api_productos' => $this->request->getPost('api_productos'),
                    'public_key' => $this->request->getPost('public_key'),
                    'access_token' => $this->request->getPost('access_token'),
                ];

                $imageFile = $this->request->getFile('logo_t');

                if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                    $newFileName = $imageFile->getRandomName();
                    $imageFile->move(ROOTPATH . 'public/assets/img_tienda/logo_tienda', $newFileName);

                    $data['logo_t'] = $newFileName;
                }



                if ($configuraciontienda->update($id, $data)) {
                    echo json_encode(array("status" => true, 'message' => 'Datos actualizados correctamente.'));
                } else {
                    echo json_encode(array("status" => false, 'error' => 'No se pudieron insertar los datos.'));
                }
            } else {
                echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
            }
        }
    }


    public function store()
    {
        helper(['form', 'url']);

        $configuraciontienda = new ConfiguracionTiendaModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id');
            if (empty($id)) {


                $validationRules = [

                    'logo_t' => 'uploaded[logo_t]|mime_in[logo_t,image/jpg,image/jpeg,image/png]|max_size[logo_t,2048]',
                ];

                if ($this->validate($validationRules)) {

                    $imagenPrincipal = $this->request->getFile('logo_t');
                    $newFileName = $imagenPrincipal->getRandomName();
                    $imagenPrincipal->move(ROOTPATH . 'public/assets/img_tienda/logo_tienda', $newFileName);


                    $data = [

                        'ruc' => $this->request->getPost('ruc'),
                        'razon_social' => $this->request->getPost('razon_social'),
                        'correo' => $this->request->getPost('correo'),
                        'sobre_nosotros' => $this->request->getPost('sobre_nosotros'),
                        'telefono' => $this->request->getPost('telefono'),
                        'direccion' => $this->request->getPost('direccion'),
                        'subdominio' => $this->request->getPost('subdominio'),
                        'api_productos' => $this->request->getPost('api_productos'),
                        'public_key' => $this->request->getPost('public_key'),
                        'access_token' => $this->request->getPost('access_token'),
                        'api_token' => $this->request->getPost('api_token'),
                        'logo_t' =>  $newFileName,
                    ];

                    $save = $configuraciontienda->insert_data($data);

                    if ($save != false) {
                        // Insertar las imágenes adicionales en la tabla imagenes_producto

                        // Devolver respuesta exitosa
                        if ($this->request->isAJAX()) {
                            $data = $configuraciontienda->where('id', $save)->first();
                            echo json_encode(array("status" => true, 'data' => $data));
                        } else {
                            return redirect()->to('admin/configuraciontienda')->with('success', 'Datos guardados correctamente.');
                        }
                    } else {
                        if ($this->request->isAJAX()) {
                            echo json_encode(array("status" => false, 'data' => $data));
                        } else {
                            return redirect()->to('admin/configuraciontienda')->with('error', 'No se pudieron insertar los datos.');
                        }
                    }
                } else {
                    // Manejar errores de validación y carga de archivos
                    if ($this->request->isAJAX()) {
                        echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                    } else {
                        return redirect()->to('admin/configuraciontienda')->with('error', 'Error de validación o carga de imagen.');
                    }
                }
            } else {
                /* Aquí actualiza */
                $validationRules = [


                    'logo_t' => 'mime_in[logo_t,image/jpg,image/jpeg,image/png]|max_size[logo_t,2048]',
                ];

                if ($this->validate($validationRules)) {
                    $data = [

                        'ruc' => $this->request->getPost('ruc'),
                        'razon_social' => $this->request->getPost('razon_social'),
                        'correo' => $this->request->getPost('correo'),
                        'sobre_nosotros' => $this->request->getPost('sobre_nosotros'),
                        'telefono' => $this->request->getPost('telefono'),
                        'direccion' => $this->request->getPost('direccion'),
                        'subdominio' => $this->request->getPost('subdominio'),
                        'api_productos' => $this->request->getPost('api_productos'),
                        'public_key' => $this->request->getPost('public_key'),
                        'access_token' => $this->request->getPost('access_token'),
                        'api_token' => $this->request->getPost('api_token'),
                    ];

                    $imageFile = $this->request->getFile('logo_t');

                    if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                        $newFileName = $imageFile->getRandomName();
                        $imageFile->move(ROOTPATH . 'public/assets/img_tienda/logo_tienda', $newFileName);

                        $data['logo_t'] = $newFileName;
                    } else {
                        // No se subió una nueva imagen, mantener la existente
                        unset($data['logo_t']);
                    }



                    // Actualiza la información principal del producto
                    if ($configuraciontienda->update($id, $data)) {
                        // Inserta o actualiza las imágenes adicionales en la tabla imagenes_producto

                        // Devuelve una respuesta exitosa
                        $updatedData = $configuraciontienda->where('id', $id)->first();
                        if ($this->request->isAJAX()) {
                            echo json_encode(array("status" => true, 'data' => $updatedData));
                        } else {
                            return redirect()->to('admin/configuraciontienda')->with('success', 'Datos actualizados correctamente.');
                        }
                    } else {
                        if ($this->request->isAJAX()) {
                            echo json_encode(array("status" => false, 'message' => 'Error al actualizar'));
                        } else {
                            return redirect()->to('admin/configuraciontienda')->with('error', 'Error al actualizar');
                        }
                    }
                } else {
                    // Manejar errores de validación y carga de archivos
                    if ($this->request->isAJAX()) {
                        echo json_encode(array("status" => false, 'error' => $this->validator->getErrors()));
                    } else {
                        return redirect()->to('admin/configuraciontienda')->with('error', 'Error de validación o carga de imagen.');
                    }
                }
            }
        }
    }
}
