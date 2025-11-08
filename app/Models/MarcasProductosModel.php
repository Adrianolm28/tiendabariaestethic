<?php

namespace App\Models;

use CodeIgniter\Model;

class MarcasProductosModel extends Model
{
    protected $table = 'marca_producto';
    protected $primaryKey = 'id_marca';
    protected $allowedFields = ['nombre', 'descripcion','estado'];
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
