<?php

namespace App\Models;

use CodeIgniter\Model;

class DetalleCompraModel  extends Model
{

    protected $table = 'detalle_compra';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_compra', 'id_producto', 'nombre', 'precio', 'cantidad'];

    public function insertarDetalleCompra($datosDetalleCompra)
    {
        $this->insert($datosDetalleCompra);
        return $this->insertID();
    }



    public function obtenerDetalleCompraPorId($idDetalleCompra)
    {
        return $this->find($idDetalleCompra);
    }

    /*  public function obtenerProductosMasVendidos($limite = 3)
    {
        // Consulta SQL para obtener los productos más vendidos con su información completa
        $query = "SELECT p.id_producto, p.nombre, p.precio, p.precio_anterior, c.nombre AS nombre_categoria, i.nombre_archivo AS imagen_producto, SUM(dc.cantidad) as total_vendido 
        FROM detalle_compra dc
        JOIN productos p ON dc.id_producto = p.id_producto
        JOIN categoria_producto c ON p.categoria_producto = c.id_categoria
        LEFT JOIN imagenes_producto i ON p.id_producto = i.id_producto
        GROUP BY p.id_producto 
        ORDER BY total_vendido DESC
        LIMIT $limite";
        // Ejecutar la consulta y devolver los resultados
        return $this->db->query($query)->getResultArray();
    } */


    public function obtenerProductosMasVendidos($limite = 3)
    {
        // Consulta SQL para obtener los productos más vendidos con su información completa
        $query = "SELECT p.id_producto, p.nombre, p.precio, p.precio_anterior, c.nombre AS nombre_categoria, i.nombre_archivo AS imagen_producto, SUM(dc.cantidad) as total_vendido 
        FROM detalle_compra dc
        JOIN productos p ON dc.id_producto = p.id_producto
        JOIN categoria_producto c ON p.categoria_producto = c.id_categoria
        LEFT JOIN imagenes_producto i ON p.id_producto = i.id_producto
        GROUP BY p.id_producto 
        ORDER BY total_vendido DESC
        LIMIT $limite";
        // Ejecutar la consulta y devolver los resultados
        return $this->db->query($query)->getResultArray();
    }

    public function obtenerProductosMasVendidosPorMarca($limite = 3)
    {
        $query = $this->db->table('detalle_compra dc')
            ->select('p.marca, p.id_producto, p.nombre, p.precio, p.precio_anterior, p.imagen_producto, i.nombre_archivo AS imagen_producto, SUM(dc.cantidad) as total_vendido')
            ->join('productos p', 'dc.id_producto = p.id_producto')
            ->Join('imagenes_producto i', 'p.id_producto = i.id_producto', 'left')
            ->groupBy('p.marca, p.id_producto, p.nombre, p.precio, p.precio_anterior, p.imagen_producto')
            ->orderBy('total_vendido', 'DESC')
            ->limit($limite)
            ->get();

        return $query->getResultArray();
    }


    public function obtenerProductosMasVendidosPorModelo($limite = 3)
    {
        $query = "SELECT p.modelo, p.id_producto, p.nombre, p.precio, p.precio_anterior, p.imagen_producto,i.nombre_archivo AS imagen_producto, SUM(dc.cantidad) as total_vendido
              FROM detalle_compra dc
              JOIN productos p ON dc.id_producto = p.id_producto
              LEFT JOIN imagenes_producto i ON p.id_producto = i.id_producto
              GROUP BY p.modelo, p.id_producto, p.nombre, p.precio, p.precio_anterior, p.imagen_producto
              ORDER BY total_vendido DESC
              LIMIT $limite";

        return $this->db->query($query)->getResultArray();
    }

    public function obtenerProductosMasVendidosTotal()
    {
        // Consulta SQL para obtener los productos más vendidos con su información completa
        $query = "SELECT p.id_producto, p.nombre, p.precio, p.precio_anterior, c.nombre AS nombre_categoria, i.nombre_archivo AS imagen_producto, SUM(dc.cantidad) as total_vendido 
        FROM detalle_compra dc
        JOIN productos p ON dc.id_producto = p.id_producto
        JOIN categoria_producto c ON p.categoria_producto = c.id_categoria
        LEFT JOIN imagenes_producto i ON p.id_producto = i.id_producto
        GROUP BY p.id_producto 
        ORDER BY total_vendido DESC";

        // Ejecutar la consulta y devolver los resultados
        return $this->db->query($query)->getResultArray();
    }

   
}
