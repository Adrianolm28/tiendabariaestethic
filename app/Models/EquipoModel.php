<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipoModel extends Model
{


    protected $table      = 'tbl_equipo';
    protected $primaryKey = 'id';
    protected $allowedFields = ['imagen', 'nombre', 'area', 'columna1', 'estado'];
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_equipo');
    }


    // Otros métodos del modelo

    public function insert_data($data)
    {
        if ($this->db->table($this->table)->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

  
}
