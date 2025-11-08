<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
       
        // Verifica si el usuario tiene una sesión activa
        $uri = $request->uri->getPath();
        if ($uri !== 'sesion' && (!session()->has('type') || session('type') !== 'admin')) {
            // Redirige a la página de inicio de sesión si no cumple con las condiciones
            return redirect()->to(base_url('/sesion'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
