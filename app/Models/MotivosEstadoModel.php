<?php

namespace App\Models;

use CodeIgniter\Model;

class MotivosEstadoModel extends Model
{
    protected $table = 'motivos_estado';
    protected $primaryKey = 'id_motivo';
    protected $allowedFields = ['nombre_motivo', 'descripcion'];

    // Otros métodos del modelo, si es necesario
}
