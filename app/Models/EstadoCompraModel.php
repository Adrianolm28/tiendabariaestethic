<?php

namespace App\Models;

use CodeIgniter\Model;

class EstadoCompraModel extends Model
{
    protected $table = 'estado_compra';
    protected $primaryKey = 'id_estado';
    protected $allowedFields = ['nombre_estado'];
}

