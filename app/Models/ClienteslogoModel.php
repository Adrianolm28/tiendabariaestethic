<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteslogoModel extends Model {

    protected $table      = 'tbl_clientes_logo';
    protected $primaryKey = 'id';
    protected $allowedFields = ['icono_cliente',  'estado'];
    protected $db;

    public function __construct(){
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_clientes_logo');
    }


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