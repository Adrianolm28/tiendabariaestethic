<?php

namespace App\Models;

use CodeIgniter\Model;

class CuponModel extends Model
{
    protected $table = 'cupones_descuento';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codigo', 'descuento', 'fecha_expiracion', 'estado'];
    protected $useTimestamps = true;
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_actualizacion';

    // Método para insertar cupones masivos
    public function insertarCuponesMasivos(array $cupones)
    {
        return $this->insertBatch($cupones);
    }
}