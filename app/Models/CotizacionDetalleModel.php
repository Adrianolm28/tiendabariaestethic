<?php

namespace App\Models;

use CodeIgniter\Model;

class CotizacionDetalleModel  extends Model
{

    protected $table = 'cotizacion_detalle';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_cotizacion', 'id_producto', 'nombre', 'precio', 'cantidad'];

    public function insertarDetalleCoti($datosDetalleCoti)
    {
        $this->insert($datosDetalleCoti);
        return $this->insertID();
    }



    public function obtenerDetalleCotiPorId($idDetalleCoti)
    {
        return $this->find($idDetalleCoti);
    }

   
}
