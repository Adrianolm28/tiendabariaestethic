<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use App\Models\PostsModel;
use App\Models\UserModel;

class Posts extends BaseController
{
    protected $userModel;
    public function __construct()
    {
       
        $this->userModel = new UserModel();
    }

    protected function getUsers()
    {
        return $this->userModel->findAll(); // Devuelve los datos de los banners
    }

    public function posts() 
    {

        $posts = new PostsModel();
        $data['posts'] = $posts->findAll();

        echo view("admin/admin_header.php");
        echo view('admin/posts',$data);
        echo view("admin/admin_footer");
    }

    
}
