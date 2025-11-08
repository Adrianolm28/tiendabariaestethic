<?php

namespace App\Helpers;

defined('BASEPATH') OR exit('No direct script access allowed');

use App\Models\ConfiguracionTiendaModel;

if (!function_exists('obtener_config_tienda')) {
    function obtener_config_tienda()
    {
        $configuracionTiendaModel = new ConfiguracionTiendaModel();
        return $configuracionTiendaModel->findAll();
    }
}
