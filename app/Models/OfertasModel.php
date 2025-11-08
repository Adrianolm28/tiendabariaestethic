<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertasModel extends Model
{
    protected $table = 'ofertas_hot_deals';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'image',
        'days',
        'hours',
        'mins',
        'secs',
        'title',
        'description',
        'discount',
        'end_time',
        'estado',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;



    public function insert_data($data)
    {
        if ($this->db->table($this->table)->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
}
