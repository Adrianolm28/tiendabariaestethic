<?php

namespace App\Controllers;

use App\Models\UsuariosModel;

class Clientes extends BaseController
{

    public function index()
    {

        return view('admin/clientes');
    }


}
