<?php

namespace App\Models;

use CodeIgniter\Model;

class PlanesModel extends Model {


    protected $table      = 'tbl_planes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['product', 'old_price', 'new_price','description','features','best_value'];
    protected $db;

    public function __construct() {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('tbl_planes');
    }

   
    // Otros métodos del modelo
    public function updatePlan($id, $data)
    {
        return $this->update($id, $data);
    }
    
    



}
