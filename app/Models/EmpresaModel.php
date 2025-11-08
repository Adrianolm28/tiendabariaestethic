<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model {

    protected $table      = 'tbl_empresa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'empresa_direccion',
        'empresa_telefono',
        'empresa_razonsocial',
        'empresa_correo',
        'empresa_descripcion',
        'empresa_logo',
        'empresa_tiktok',
        'empresa_instagram',
        'empresa_facebook',
        'empresa_youtube',
        'empresa_whatsapp'
    ];
    protected $db;

    public function __construct() {
        parent::__construct();
        $this->db = \Config\Database::connect();
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

