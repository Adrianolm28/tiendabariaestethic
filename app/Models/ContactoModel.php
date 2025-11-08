<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactoModel extends Model
{
    protected $table            = 'contactos'; // Nombre de tu tabla de contactos
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false; // O true si quieres borrado lógico

    // Campos permitidos para inserción/actualización masiva
    protected $allowedFields    = [
        'tipo_documento',
        'numero_documento',
        'nombres',
        'email',
        'telefono',
        'descripcion',
        'created_at' // Cambiado de 'fecha_registro' a 'created_at'
    ];

    // Dates
    protected $useTimestamps = false; // Si no usas created_at, updated_at de CI
    // protected $createdField  = 'fecha_registro'; // Si quieres que CI maneje esto
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    // Puedes definir reglas de validación aquí también, pero ya las tienes en el controlador
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
