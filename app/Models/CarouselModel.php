<?php

namespace App\Models;

use CodeIgniter\Model;

class CarouselModel extends Model {


    protected $table      = 'tbl_carousel';
    protected $primaryKey = 'id';
    protected $allowedFields = ['imagen_carousel', 'estado'];
    protected $db;

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_carousel');
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
