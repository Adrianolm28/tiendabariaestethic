<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'id';
    protected $allowedFields = ['producto_id', 'usuario_nombre', 'correo', 'comentario', 'rating', 'created_at'];

    protected $useAutoIncrement = true;
    protected $useTimestamps = false;
}
