<?php

namespace App\Models;

use CodeIgniter\Model;

class SubcategoriaProductoModel extends Model
{
    protected $table = 'subcategoria_producto';
    protected $primaryKey = 'id_subcategoria';
    protected $allowedFields = ['nombre', 'id_categoria_principal', 'estado', 'descripcion', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Otras configuraciones y métodos si son necesarios

    public function insert_data($data)
    {
        $result = $this->insert($data);
        if ($result) {
            return $this->insertID();
        } else {
            return false;
        }
    }


    public function getSubcategoriasWithCategoria()
    {
        return $this->select('subcategoria_producto.*, categoria_producto.nombre as categoria_nombre')
            ->join('categoria_producto', 'categoria_producto.id_categoria = subcategoria_producto.id_categoria_principal')
            ->findAll();
    }
}
