<?php

namespace App\Controllers;

use App\Models\HistorialEstadoCompraModel;

class Historialcompra extends BaseController
{
    public function obtenerSeguimiento()
    {
        $compraId = $this->request->getPost('compra_id');

        // Instanciar el modelo de seguimiento de compra
        $historial = new HistorialEstadoCompraModel();

        // Realizar una consulta para obtener el seguimiento de la compra por su ID
        /*  $seguimiento = $historial->where('compra_id', $compraId)->findAll(); */
        $seguimiento = $historial
            ->select('historial_estado_compra.*, motivos_estado.descripcion')
            ->join('motivos_estado', 'historial_estado_compra.motivo_id = motivos_estado.id_motivo')
            ->where('historial_estado_compra.compra_id', $compraId)
            ->orderBy('historial_estado_compra.id', 'ASC')  // Ordenar por el campo 'id' de forma ascendente
            ->findAll();

        // Devolver el seguimiento como respuesta JSON
        return $this->response->setJSON([
            'success' => true,
            'seguimiento' => $seguimiento
        ]);
    }
}
