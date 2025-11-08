<?php

namespace App\Models;

use CodeIgniter\Model;

class RespaldoModel extends Model{

    protected $table      = 'tbl_respaldo';
    protected $primaryKey = 'id';
    protected $allowedFields = ['logo_respaldo','estado'];
    protected $db;

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_respaldo');
    }

    // Otros métodos del modelo

    public function insert_data($data) {
        if($this->db->table($this->table)->insert($data))
        {
            return $this->db->insertID();
        }
        else
        {
            return false;
        }
    }

}