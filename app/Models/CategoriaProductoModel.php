<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaProductoModel extends Model
{
    protected $table = 'categoria_producto';
    protected $primaryKey = 'id_categoria';
    protected $allowedFields = ['nombre', 'imagen_categoria', 'estado', 'descripcion','estado'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Otras configuraciones y métodos si son necesarios

    public function insert_data($data)
    {
        $result = $this->insert($data);
        if ($result) {
            return $this->insertID();
        } else {
            return false;
        }
    }
}
