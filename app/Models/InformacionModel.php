<?php

namespace App\Models;

use CodeIgniter\Model;

class InformacionModel extends Model
{


    protected $table      = 'tbl_informacion';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'info_logo',
        'info_titulo',
        'info_descripcion',
        'info_icono1',
        'info_icono2',
        'info_icono3',
        'text_icono1',
        'text_icono2',
        'text_icono3',
        'estado',
    ];
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_informacion');
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
