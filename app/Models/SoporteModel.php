<?php

namespace App\Models;

use CodeIgniter\Model;

class SoporteModel extends Model {


    protected $table      = 'tbl_soporte';
    protected $primaryKey = 'id';
    protected $allowedFields = ['titulo_soporte', 'parrafo_soporte', 'sub1_soporte','sub2_soporte','sub3_soporte','sub_parrafo1','sub_parrafo2','sub_parrafo3','imagen_soporte'];
    protected $db;

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_soporte');
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
