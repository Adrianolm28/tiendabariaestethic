<?php

namespace App\Models;

use CodeIgniter\Model;

class HistorialEstadoCompraModel extends Model
{
    protected $table = 'historial_estado_compra';
    protected $primaryKey = 'id';
    protected $allowedFields = ['compra_id', 'estado_id', 'fecha_cambio','motivo_id'];
}
 