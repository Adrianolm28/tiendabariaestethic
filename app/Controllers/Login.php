<?php

// app/Controllers/Login.php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
    protected $filters = ['SessionAdmin'];

    public function index()
    {
        //$user = new UserModel();
        // Muestra la vista de inicio de sesión
        return view('sesion/login');
    }



    public function process()
    {
        $userModel = new UserModel();
        $usuario = $this->request->getPost('username');
        $password = $this->request->getPost('clave');
        $data = [
            'username' => $usuario
        ];

        // Verifica las credenciales del usuario
        $user = $userModel->get_login($data);

        if (count($user) > 0 && password_verify($password, $user[0]['clave'])) {
            // Las credenciales son válidas, guarda la sesión del usuario
            $session = session();
            $session->set('id', $user[0]['id']);
            $session->set('username', $user[0]['username']);
            $session->set('type', 'admin');
             $session->set('isLoggedIn', true);

            // Redirige al usuario a la página de administrador
            return redirect()->to('/admin')->with('mensaje', 'Inicio de sesión exitoso');
        } else {
            // Las credenciales no son válidas, muestra un mensaje de error
            echo "Error al iniciar sesión. Credenciales incorrectas.";
        }
    }

    public function registrar_usuario()
    {
        $userModel = new UserModel();
        $usuario = 'paolo';
        //$password = (string) $this->request->getPost('clave');
        $hashedPassword = password_hash('123456', PASSWORD_DEFAULT);

        $data = [
            'username' => $usuario,
            'clave' => $hashedPassword, // Almacena la contraseña hasheada
        ];
        $userModel->insert_data($data);
        return redirect()->to('/login');
    }


    public function logout()
    {
        // Destruye la sesión actual
        // Destruye la sesión actual
        $session = session();
        $session->destroy();

        // Redirige al usuario a la página de inicio de sesión con un mensaje
        return redirect()->to('/sesion')->with('mensaje', 'Sesión cerrada correctamente');
    }
}
