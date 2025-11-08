<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\VisitModel;

class VisitLogger implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $visitModel = new \App\Models\VisitModel();
        $request = service('request');
        $response = service('response');

        $uriPath = $request->getUri()->getPath();

        // Solo registrar visitas para páginas públicas relevantes
        $publicPaths = [
            '', // home
            'tegnex',
            'tienda',
            'shop',
            'contacto',
            'informacion',
            'equipo',
            'blog',
            'blog_detalle',
            'lreclamaciones',
            'tienda/verproducto',
            // agrega más rutas públicas si lo necesitas
        ];

        $isPublic = false;
        foreach ($publicPaths as $path) {
            if ($uriPath === $path || strpos($uriPath, $path . '/') === 0) {
                $isPublic = true;
                break;
            }
        }

        // No registrar visitas para rutas no públicas
        if (!$isPublic) {
            return;
        }

        // Buscar cookie de visitante único
        $visitorId = $request->getCookie('visitor_id');
        if (!$visitorId) {
            $visitorId = bin2hex(random_bytes(16));
            // Setear cookie por 1 año
            $response->setCookie('visitor_id', $visitorId, 60*60*24*365);
        }

        $visitModel->insert([
            'page_name' => current_url(), // Guarda la URL completa
            'visited_at' => date('Y-m-d H:i:s'),
            'ip_address' => $request->getIPAddress(),
            'user_agent' => $request->getUserAgent(),
            'visitor_id' => $visitorId
        ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Si seteaste una cookie, debes devolver el response modificado
        return $response;
    }
}
