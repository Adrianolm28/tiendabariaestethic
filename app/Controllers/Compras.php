<?php


namespace App\Controllers;

use App\Models\ComprasModel;
use App\Models\DetalleCompraModel;
use App\Models\EstadoCompraModel;
use App\Models\HistorialEstadoCompraModel;
use App\Models\MotivosEstadoModel;
use CodeIgniter\Controller;




class Compras extends BaseController
{



    public function index()
    {
        // Obtener los estados de la tabla estado_compra
        $estadoCompraModel = new EstadoCompraModel();
        $data['estados'] = $estadoCompraModel->findAll();

        $motivosModel = new MotivosEstadoModel();
        $data['motivos'] = $motivosModel->findAll();

        // Cargar la vista de administración de compras y pasar los estados
        return view('admin/compras', $data);
    }


    public function lista_ajax()
    {
        $comprasModel = new ComprasModel();
        $detalleCompraModel = new DetalleCompraModel();


        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        $estado = $this->request->getGet('estado');

        $compras = $comprasModel
            ->select('compras.*, estado_compra.nombre_estado AS nombre_estado')
            ->join('estado_compra', 'estado_compra.id_estado = compras.status_compra', 'left');

        if (!empty($startDate) && !empty($endDate)) {
            // Agregar un día al endDate para incluir las compras del mismo día
            $endDate = date('Y-m-d', strtotime($endDate . ' +1 day'));
            $compras->where('compras.fecha >=', $startDate)
                ->where('compras.fecha <', $endDate);
        }

        // Aplicar el filtro por estado si se proporciona
        if (!empty($estado)) {
            $compras->where('compras.status_compra', $estado);
        }

        $compras->orderBy('compras.fecha', 'DESC');
        $compras = $compras->findAll();
        $data = [];

        foreach ($compras as $compra) {

            // Sumar el costo de envío al total de la compra si existe
            $totalCompra = $compra['total'];
            if (isset($compra['costo_envio']) && $compra['costo_envio'] > 0) {
                $totalCompra += $compra['costo_envio'];
            }

            $totalCompra = number_format($totalCompra, 2);

            // Obtener los detalles de compra para esta compra específica
            $detallesCompra = $detalleCompraModel->where('id_compra', $compra['id'])->findAll();


            $detalles = [];
            foreach ($detallesCompra as $detalle) {
                $detalles[] = [
                    'nombre' => $detalle['nombre'],
                    'precio' => $detalle['precio'],
                    'cantidad' => $detalle['cantidad'],

                ];
            }

            // Agregar los datos de la compra y sus detalles al array de datos
            $data[] = [
                'id' => $compra['id'],
                'id_transaccion' => $compra['id_transaccion'],
                'status' => $compra['status'],
                'fecha' => $compra['fecha'],
                'email' => $compra['email'],
                'cliente' => $compra['id_cliente'],
                'dni' => $compra['dni'],
                'nombre' => $compra['nombre'],
                'total' => $totalCompra,
                'voucher' => $compra['voucher_img'],
                'detalles' => $detalles,
                'nombre_estado' => $compra['nombre_estado'],
                'id_estado' => $compra['status_compra'],
                'canal_pago' => $compra['canal_pago'],

            ];
        }

        echo json_encode(['data' => $data]); // Devolver los datos como JSON
    }

     public function detalle_compra($idCompra)
    {
        $detalleCompraModel = new DetalleCompraModel();
        $comprasModel = new ComprasModel();

        // Obtener los detalles de compra para la compra específica
        $detallesCompra = $detalleCompraModel->where('id_compra', $idCompra)->findAll();

        // Obtener la información de la compra, incluyendo los nombres de departamento, provincia y distrito
        $compra = $comprasModel
            ->select('compras.*, 
                      ubdepartamento.departamento AS departamento_nombre, 
                      ubprovincia.provincia AS provincia_nombre, 
                      ubdistrito.distrito AS distrito_nombre')
            ->join('ubdepartamento', 'ubdepartamento.idDepa = compras.departamento', 'left')
            ->join('ubprovincia', 'ubprovincia.idProv = compras.provincia AND ubprovincia.idDepa = compras.departamento', 'left')
            ->join('ubdistrito', 'ubdistrito.idDist = compras.distrito AND ubdistrito.idProv = compras.provincia', 'left')
            ->find($idCompra);

        if (!$compra) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Compra no encontrada']);
        }

        // Registrar en el log los valores de provincia y distrito para depuración
        log_message('info', "Compra ID: $idCompra - Departamento: {$compra['departamento']}, Provincia: {$compra['provincia']}, Distrito: {$compra['distrito']}");

        // Asegurarse de que los campos de dirección no sean nulos
        $compra['direccion'] = $compra['direccion'] ?? 'No disponible';
        $compra['departamento_nombre'] = $compra['departamento_nombre'] ?? 'No disponible';
        $compra['provincia_nombre'] = $compra['provincia_nombre'] ?? 'No disponible';
        $compra['distrito_nombre'] = $compra['distrito_nombre'] ?? 'No disponible';

        // Registrar en el log si algún valor no está disponible
        if ($compra['provincia_nombre'] === 'No disponible' || $compra['distrito_nombre'] === 'No disponible') {
            log_message('error', "Valores faltantes para la compra ID: $idCompra. Provincia: {$compra['provincia']}, Distrito: {$compra['distrito']}");
        }

        // Devolver los detalles de compra y la información de la compra como JSON
        echo json_encode(['detalles' => $detallesCompra, 'compra' => $compra]);
    }


    public function actualizar_estado()
    {

        $comprasModel = new ComprasModel();
        $compraId = $this->request->getPost('compra_id');
        $estado = $this->request->getPost('estado');
        $idMotivo = $this->request->getPost('id_motivo');

        /* print_r($_POST);  */


        $data = [
            'status_compra' => $estado
        ];

        $result = $comprasModel->update($compraId, $data);

        // Verificar si la actualización fue exitosa
        if ($result) {

            $historialModel = new HistorialEstadoCompraModel();
            $historialData = [
                'compra_id' => $compraId,
                'estado_id' => $estado,
                'fecha_cambio' => date('Y-m-d H:i:s'),
                'motivo_id' => $idMotivo
            ];

            $historialModel->insert($historialData);
            // La actualización fue exitosa
            return $this->response->setJSON(['success' => true]);
        } else {
            // La actualización falló
            return $this->response->setJSON(['success' => false]);
        }
    }



    public function obtener_estado()
    {
        $compraId = $this->request->getPost('compra_id');

        if (!empty($compraId)) {
            // Instanciar el modelo de compras
            $comprasModel = new ComprasModel();

            // Obtener la compra por su ID
            $compra = $comprasModel->find($compraId);

            if (!empty($compra)) {
                // Instanciar el modelo de historial de estado de compra
                $historialModel = new HistorialEstadoCompraModel();

                // Obtener el historial de estados de la compra
                $historial = $historialModel->where('compra_id', $compraId)->orderBy('fecha_cambio', 'DESC')->findAll();

                // Obtener los motivos de estado para cada entrada en el historial
                $motivosModel = new MotivosEstadoModel();
                $motivos = $motivosModel->findAll(); // Obtener todos los motivos de estado

                /* foreach ($historial as &$estado) {
                    $motivo = $motivosModel->find($estado['id_motivo']);
                    $estado['motivo'] = $motivo; // Agregar el motivo al historial
                } */

                // Agregar el historial al campo "historial" de la compra
                $compra['historial'] = $historial;

                // Devolver la compra con su historial y los motivos como respuesta JSON
                return $this->response->setJSON([
                    'success' => true,
                    'compra' => $compra,
                    'motivos' => $motivos // Agregar los motivos al JSON de respuesta
                ]);
            }
        }

        // Si no se pudo obtener la compra, devolver una respuesta JSON indicando un error
        return $this->response->setJSON(['success' => false]);
    }

    public function obtenermotivoestado()
    {
        // Obtener el ID del estado enviado desde la solicitud AJAX
        $estadoId = $this->request->getPost('estado_id');

        // Verificar que se haya recibido un ID de estado
        if (!empty($estadoId)) {
            // Instanciar el modelo de motivos de estado
            $motivosModel = new MotivosEstadoModel();

            $motivo = $motivosModel->where('id_motivo', $estadoId)->first();

            if (!empty($motivo)) {
                // Devolver el motivo como respuesta JSON
                return $this->response->setJSON([
                    'success' => true,
                    'motivo' => $motivo
                ]);
            }
        }
        return $this->response->setJSON(['success' => false]);
    }

   
    
}
