<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracionTiendaModel extends Model
{


    protected $table = 'configuracion_tienda';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'ruc',
        'razon_social',
        'correo',
        'sobre_nosotros',
        'telefono',
        'direccion',
        'logo_t',
        'subdominio',
        'api_productos',
        'public_key',
        'access_token',
        'api_token'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'fecha_registro';
    protected $updatedField = null;
    protected $deletedField = null;
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $db = \Config\Database::connect();
        $builder = $db->table('configuracion_tienda');
    }



    public function insert_data($data)
    {
        $result = $this->insert($data);
        if ($result) {
            return $this->insertID();
        } else {
            return false;
        }
    }

    public function obtenerConfiguracion()
    {
        // Ejecutar una consulta para obtener todos los registros de la tabla
        $query = $this->findAll();

        // Verificar si se encontraron registros
        if ($query) {
            // Devolver los resultados encontrados
            return $query;
        } else {
            // Devolver un array vacío si no se encontraron registros
            return [];
        }
    }
}
