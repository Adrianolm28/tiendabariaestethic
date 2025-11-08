<?php

// app/Models/UserModel.php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        //$builder = $db->table('users');
    }

    public function get_login($data){
        $usuario = $this->db->table('users');

       // return $data;
        $usuario->where($data);
        return $usuario->get()->getResultArray();
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

