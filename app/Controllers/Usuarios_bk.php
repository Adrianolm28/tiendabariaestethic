<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Usuarios extends BaseController
{
    protected $usuariosModel;

    public function __construct()
    {
        $this->usuariosModel = new UsuariosModel();
    }

    public function index()
    {
        $usuarioModel = new UsuariosModel();
        $data['usuarios'] = $usuarioModel->where('estado', 1)->findAll();
        return view('admin/usuarios', $data);
    }

    public function store1()
    {

        $usuarioModel = new UsuariosModel();
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'clave' => password_hash($this->request->getPost('clave'), PASSWORD_DEFAULT),
            'estado' => 1 // Estado activo por defecto
        ];

        print_r($data);
    }

    public function store()
    {
        helper(['form', 'url']);

        $usuarioModel = new UsuariosModel();

        if ($this->request->getPost()) {

            $id = $this->request->getPost('id_usuario');
            if (empty($id)) {

                $validationRules = [
                    'nombre' => 'required',
                    'correo' => 'required',
                ];

                if ($this->validate($validationRules)) {
                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        'correo' => $this->request->getPost('correo'),
                        'celular' => $this->request->getPost('celular'),
                        'clave' => password_hash($this->request->getPost('clave'), PASSWORD_DEFAULT),
                       
                    ];

                    $save = $usuarioModel->insert_data($data);

                    if ($save != false) {
                        $data = $usuarioModel->where('id_usuario', $save)->first();
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
                    'correo' => 'required',
                ];


                if ($this->validate($validationRules)) {
                    $data = [
                        'nombre' => $this->request->getPost('nombre'),
                        'correo' => $this->request->getPost('correo'),
                        'celular' => $this->request->getPost('celular'),
                        'clave' => password_hash($this->request->getPost('clave'), PASSWORD_DEFAULT),
                    ];

                    // Realiza la actualización en la base de datos
                    if ($usuarioModel->update($id, $data)) {
                        $updatedData = $usuarioModel->where('id', $id)->first();
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

        $usuarioModel = new UsuariosModel();

        $data = $usuarioModel->where('id_usuario', $id)->first();

        if ($data) {
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false));
        }
    }

    public function registro()
    {
        // Validar datos del formulario de registro
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required',
            'correo' => 'required|valid_email|is_unique[usuarios.correo]',
            'celular' => 'required|numeric',
            'clave' => 'required|min_length[6]',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            // Mostrar errores de validación
            return $this->response->setJSON(['error' => $validation->getErrors()]);
        }

        // Insertar datos en la base de datos
        $usuarioModel = new UsuariosModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'celular' => $this->request->getPost('celular'),
            'clave' => password_hash($this->request->getPost('clave'), PASSWORD_DEFAULT),
            'estado' => 1 // Estado activo por defecto
        ];
        $usuarioId = $usuarioModel->insert_data($data);

        if (!$usuarioId) {
            // Error al insertar usuario
            return $this->response->setJSON(['error' => 'Error al registrar el usuario']);
        }

        return $this->response->setJSON(['success' => 'Usuario registrado con éxito', 'redirect' => site_url('tienda/shop')]);
    }


    public function iniciarSesionAutomatica($correo)
    {
        // Obtener los datos del usuario recién registrado
        $usuarioRegistrado = $this->usuariosModel->where('correo', $correo)->first();

        // Verificar si se encontró el usuario
        if ($usuarioRegistrado) {
            // Iniciar sesión con el ID del usuario
            session()->set('usuario_autenticado', true);
            session()->set('id_usuario', $usuarioRegistrado['id_usuario']);
            session()->set('nombre_usuario', $usuarioRegistrado['nombre']);
        }
    }


    public function iniciarSesion2()
    {
        $usuario = $this->request->getPost('usuario');
        $clave = $this->request->getPost('clave');

        // Validar los datos del formulario
        $validationRules = [
            'usuario' => 'required',
            'clave' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            // Si la validación falla, devolver errores de validación
            return $this->response->setJSON(['error' => $this->validator->getErrors()]);
        }

        $usuarioRegistrado = $this->usuariosModel->where('nombre', $usuario)->first();

        if ($usuarioRegistrado) {
            // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
            if (password_verify($clave, $usuarioRegistrado['clave'])) {
                // Iniciar sesión
                $idUsuario = $this->usuariosModel->obtenerIdPorNombre($usuario);

                // Iniciar sesión con el ID del usuario
                session()->set('usuario_autenticado', true);
                session()->set('id_usuario', $idUsuario);
                session()->set('nombre_usuario', $usuarioRegistrado['nombre']);

                // Devolver un mensaje de éxito
                return $this->response->setJSON(['success' => 'Inicio de sesión exitoso']);
            } else {
                // La contraseña es incorrecta
                return $this->response->setJSON(['error' => 'Contraseña incorrecta']);
            }
        } else {
            // El usuario no existe en la base de datos
            return $this->response->setJSON(['error' => 'El usuario no existe']);
        }
    }

    public function iniciarSesion()
    {

        $usuarioOEmail = $this->request->getPost('usuario');
        $clave = $this->request->getPost('clave');

        // Validar los datos del formulario
        $validationRules = [
            'usuario' => 'required',
            'clave' => 'required'
        ];

        if (!$this->validate($validationRules)) {
            // Si la validación falla, devolver errores de validación
            return $this->response->setJSON(['error' => $this->validator->getErrors()]);
        }


        $usuarioRegistrado = $this->usuariosModel->where('correo', $usuarioOEmail)
            ->orWhere('nombre', $usuarioOEmail)
            ->orWhere('celular', $usuarioOEmail)
            ->first();





        if ($usuarioRegistrado) {
            // Verificar si la contraseña proporcionada coincide con la almacenada en la base de datos
            if (password_verify($clave, $usuarioRegistrado['clave'])) {
                // Iniciar sesión
                $idUsuario = $this->usuariosModel->obtenerIdPorNombre($usuarioOEmail);

                // Iniciar sesión con el ID del usuario
                session()->set('usuario_autenticado', true);
                session()->set('id_usuario', $idUsuario);
                session()->set('nombre_usuario', $usuarioRegistrado['nombre']);

                // Devolver un mensaje de éxito
                return $this->response->setJSON(['success' => 'Inicio de sesión exitoso']);
            } else {
                // La contraseña es incorrecta
                return $this->response->setJSON(['error' => 'Contraseña incorrecta']);
            }
        } else {
            // El usuario no existe en la base de datos
            return $this->response->setJSON(['error' => 'El usuario no existe']);
        }
    }


    public function recuperarClave()
    {
        $usuario = $this->request->getPost('usuarioRecuperar');
        $correo = $this->request->getPost('correoRecuperar');
        $nuevaClave = $this->request->getPost('nuevaClave');

        // Verificar si se han proporcionado todos los datos del formulario
        if (empty($usuario) || empty($correo) || empty($nuevaClave)) {
            // Si falta alguno de los campos, devolver un error
            return $this->response->setJSON(['error' => 'Por favor, complete todos los campos del formulario.']);
        }

        // Validar los datos del formulario (puedes agregar más validaciones según tus requisitos)
        $validationRules = [
            'usuarioRecuperar' => 'required',
            'correoRecuperar' => 'required|valid_email',
            'nuevaClave' => 'required|min_length[6]'
        ];

        if (!$this->validate($validationRules)) {
            // Si la validación falla, devolver errores de validación
            return $this->response->setJSON(['error' => $this->validator->getErrors()]);
        }

        // Verificar si el usuario existe en la base de datos
        $usuarioRegistrado = $this->usuariosModel->where('nombre', $usuario)->first();

        if ($usuarioRegistrado) {
            // Verificar si el correo electrónico coincide con el usuario en la base de datos
            if ($usuarioRegistrado['correo'] == $correo) {
                // Generar una nueva contraseña aleatoria y actualizarla en la base de datos
                $nuevaClaveHash = password_hash($nuevaClave, PASSWORD_DEFAULT);
                $this->usuariosModel->set('clave', $nuevaClaveHash)->where('id_usuario', $usuarioRegistrado['id_usuario'])->update();



                // Devolver un mensaje de éxito
                return $this->response->setJSON(['success' => 'Contraseña recuperada exitosamente.']);
            } else {
                // El correo electrónico no coincide con el usuario en la base de datos
                return $this->response->setJSON(['error' => 'El correo electrónico proporcionado no coincide con el usuario.']);
            }
        } else {
            // El usuario no existe en la base de datos
            // Aquí puedes mostrar un mensaje sugerido para crear una cuenta
            return $this->response->setJSON(['error' => 'El usuario y/o correo electrónico no existen en nuestros registros. Si no tienes una cuenta, por favor crea una nueva.']);
        }
    }








    public function cerrarSesion()
    {
        // Eliminar los datos de sesión relacionados con la autenticación del usuario
        session()->remove('usuario_autenticado');
        session()->remove('nombre_usuario');

        // Redirigir a la página de inicio o a donde desees después de cerrar sesión
        return redirect()->to('/tienda');
    }
}
