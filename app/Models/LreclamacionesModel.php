<?php

namespace App\Models;

use CodeIgniter\Model;

class LreclamacionesModel extends Model
{
    protected $table = 'reclamaciones';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombres',
        'apellidos',
        'tipo_documento',
        'numero_documento',
        'correo',
        'telefono',
        'departamento',
        'provincia',
        'distrito',
        'direccion',
        'detalle_producto',
        'numero_pedido',
        'detalle_solicitud'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

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
