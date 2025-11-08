<?php

namespace App\Models;

use CodeIgniter\Model;

class OfertasDescuentoModel extends Model
{
    protected $table = 'ofertas_descuento';
    protected $primaryKey = 'id_oferta';
    protected $allowedFields = ['imagen_oferta', 'nombre_oferta', 'tipo_oferta', 'id_categoria', 'id_subcategoria', 'id_producto', 'descuento', 'estado', 'fecha_inicio', 'fecha_fin'];

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

    public function desactivarOfertasExpiradas()
    {
        $fechaActual = date('Y-m-d');

        $this->where('fecha_fin <', $fechaActual)
            ->where('estado', 1) // Sólo desactivar si el estado es 1 (activo)
            ->set(['estado' => 0])
            ->update();
    }

    public function obtenerOfertasConNombres()
    {
        $builder = $this->db->table('ofertas_descuento od');
        $builder->select('
        od.*,
        cp.nombre as nombre_categoria,
        sp.nombre as nombre_subcategoria
    ');
        $builder->join('categoria_producto cp', 'cp.id_categoria = od.id_categoria', 'inner');
        $builder->join('subcategoria_producto sp', 'sp.id_subcategoria = od.id_subcategoria', 'left');
        return $builder->get()->getResultArray();
    }

 



}
