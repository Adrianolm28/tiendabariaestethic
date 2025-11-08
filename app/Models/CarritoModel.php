<?php

namespace App\Models;

use CodeIgniter\Model;

class CarritoModel extends Model
{
    protected $table = 'carrito';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'product_id', 'nombre_producto', 'cantidad', 'precio', 'precio_anterior', 'precio_descuento', 'imagen_producto'];

    public function agregarAlCarrito($data)
    {
        return $this->insert($data);
    }
    
}
