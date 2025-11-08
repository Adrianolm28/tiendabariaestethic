<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{


    protected $table      = 'banner';
    protected $primaryKey = 'id';
    protected $allowedFields = ['imagen1', 'text', 'estado'];
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('banner');
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
