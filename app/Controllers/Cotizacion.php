<?php


namespace App\Controllers;

use App\Models\CotizacionDetalleModel;
use App\Models\CotizacionModel;

class Cotizacion extends BaseController
{



    public function index()
    {

        return view('admin/cotizacion');
    }

    public function listarCotizaciones()
{
    $cotizacionModel = new CotizacionModel();
    $cotizacionDetalleModel = new CotizacionDetalleModel();
    $startDate = $this->request->getGet('start_date');
    $endDate = $this->request->getGet('end_date');

    // Construir la consulta para obtener las cotizaciones
    $cotizacionesQuery = $cotizacionModel->select('*');

    // Aplicar el filtro de fechas si se proporcionan
    if (!empty($startDate) && !empty($endDate)) {
        // Agregar un día al endDate para incluir las cotizaciones del mismo día
        $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
        $cotizacionesQuery->where('fecha >=', $startDate)
                          ->where('fecha <', $endDate);
    }

    // Obtener las cotizaciones según la consulta construida
    $cotizaciones = $cotizacionesQuery->findAll();

    $data = [];

    // Iterar sobre cada cotización
    foreach ($cotizaciones as $cotizacion) {
        // Obtener los detalles de la cotización actual
        $detallesCotizacion = $cotizacionDetalleModel->where('id_cotizacion', $cotizacion['id'])->findAll();

        // Agregar los detalles a la cotización actual
        $cotizacion['detalles'] = $detallesCotizacion;

        // Agregar la cotización con sus detalles al array de datos
        $data[] = $cotizacion;
    }

    // Devolver los datos como JSON
    return json_encode(['data' => $data]);
}




    public function detalle_cotizacion($idCotizacion)
    {
        $cotizacionModel = new CotizacionModel();
        $cotizacionDetalleModel = new CotizacionDetalleModel();

        // Obtener los detalles de compra para la compra específica
        $detallesCotizacion = $cotizacionDetalleModel->where('id_cotizacion', $idCotizacion)->findAll();

        // Obtener la información de la compra, incluyendo el voucher
        $cotizacion = $cotizacionModel->find($idCotizacion);

        // Devolver los detalles de compra y la información de la compra como JSON
        echo json_encode(['detalles' => $detallesCotizacion, 'cotizacion' => $cotizacion]);
    }
}
