<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{


    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['categoria_id', 'titulo', 'posts_description', 'contenido', 'banner_imagen', 'tags', 'estado'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('categorias');
    }

    
}
