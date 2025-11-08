<?php

namespace App\Models;

use CodeIgniter\Model;

class CotizacionModel extends Model
{


    protected $table = 'cotizaciones';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_transaccion',
        'fecha',
        'status',
        'email',
        'id_cliente',
        'total',
        'dni',
        'nombre',
        'apellido',
        'telefono',
        'departamento',
        'provincia',
        'distrito',
        'direccion',
        'numero',
        'voucher_img',
        'descuento',
        'carrito'
    ];

    public function insertarCotización($datosCoti)
    {
        $this->insert($datosCoti);
        return $this->insertID();
    }

    public function obtenerCotizacion($idCotizazcion)
    {
        return $this->find($idCotizazcion);
    }
    public function getCotizacionByClienteId($clienteId)
    {
        return $this->where('id_cliente', $clienteId)->findAll();
    }

    public function getCotizacionId($idCotizazcion)
    {
        return $this->where('id', $idCotizazcion)->findAll();
    }
}
