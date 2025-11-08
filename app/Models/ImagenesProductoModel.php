<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagenesProductoModel extends Model
{
    protected $table = 'imagenes_producto';
    protected $primaryKey = 'id_imagen';
    protected $allowedFields = ['id_producto', 'nombre_archivo', 'orden', 'estado'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function producto()
    {
        return $this->belongsTo(ProductoModel::class, 'id_producto');
    }

    public function getImagenPrincipal($idProducto)
    {
        return $this->where('id_producto', $idProducto)
            ->where('orden', 1)
            ->first();
    }
}
