<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriasModel extends Model
{
    protected $table      = 'categorias';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nombre_categoria', 'descripcion_categoria', 'estado'];

    // Otras configuraciones de tu modelo si es necesario

    public function getCategorias()
    {
        // Puedes agregar métodos personalizados aquí para realizar consultas específicas
        return $this->findAll();
    }

    public function insert_data($data)
    {
        if ($this->db->table($this->table)->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
}
