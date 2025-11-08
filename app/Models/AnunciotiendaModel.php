<?php

namespace App\Models;

use CodeIgniter\Model;

class AnunciotiendaModel extends Model
{

    protected $table = 'anuncio_tienda';

    // Define la clave primaria de la tabla
    protected $primaryKey = 'id';

    // Especifica los campos que pueden ser insertados o actualizados
    protected $allowedFields = [
        'imagen_anuncio',
        'id_categoria',
        'id_producto',
        'estado',
        'fecha',
    ];

    protected $useTimestamps = false;
    // Otros métodos del modelo

    public function insert_data($data)
    {
        if ($this->db->table($this->table)->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }
    public function getAnunciosConDetalles()
    {
        return $this->select('anuncio_tienda.id, anuncio_tienda.imagen_anuncio, anuncio_tienda.estado, anuncio_tienda.fecha, anuncio_tienda.id_categoria, anuncio_tienda.id_producto, categoria_producto.nombre as nombre_categoria, productos.nombre as nombre_producto')
            ->join('categoria_producto', 'categoria_producto.id_categoria = anuncio_tienda.id_categoria', 'left') // Join con la tabla categoria_producto
            ->join('productos', 'productos.id_producto = anuncio_tienda.id_producto', 'left') // Join con la tabla productos
            ->findAll();
    }
}
