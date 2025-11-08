<?php

namespace App\Controllers;


class Nosotros extends BaseController
{


    public function nosotros()
    {
        echo view("admin/admin_header.php");
        echo view('admin/nosotros');
        echo view("admin/admin_footer");
    }
}
