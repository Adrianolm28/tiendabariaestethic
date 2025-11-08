<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiciosModel extends Model
{


    protected $table      = 'tbl_servicios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['icono', 'titulo', 'descripcion', 'estado'];
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_servicios');
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
