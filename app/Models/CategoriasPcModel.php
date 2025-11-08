<?php
namespace App\Models;

use CodeIgniter\Model;

class CategoriasPcModel extends Model
{
    protected $table      = 'categoriaspc'; // Nombre de la tabla
    protected $primaryKey = 'id';     // Clave primaria de la tabla
    protected $allowedFields = ['imagenbanner', 'estado',  'id_categorias', 'nombre_image', 'texto', ];
/*     protected $useTimestamps = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion'; */

    public function insert_data($data)
    {
        $result = $this->insert($data);
        if ($result) {
            return $this->insertID();
        } else {
            return false;
        }
    }

    public function obtenerCategoriasPc()
    {
        return $this->findAll();
    }

}
