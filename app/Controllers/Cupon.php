<?php


namespace App\Controllers;

use App\Models\CuponModel;

class Cupon extends BaseController
{

    public function index()
    {
        // Cargar el modelo de cupones
        $cuponModel = new CuponModel();

        // Obtener todos los cupones de descuento
        $cupones = $cuponModel->findAll();

        // Pasar los cupones a la vista
        return $this->response->setJSON($cupones);
    }



    public function validarCupon()
    {
        // Obtener el código del cupón enviado desde la solicitud
        $codigoCupon = $this->request->getPost('cupon');

        // Verificar si el código del cupón está presente
        if (!$codigoCupon) {
            // Si no se proporcionó un código de cupón, devolver un mensaje de error

            return $this->response->setJSON(['error' => 'No se proporcionó un código de cupón']);
        }

        // Cargar el modelo de cupones
        $cuponModel = new CuponModel();

        // Buscar el cupón en la base de datos
        $cupon = $cuponModel->where('codigo', $codigoCupon)
            ->where('estado', 'activo')
            ->where('fecha_expiracion >=', date('Y-m-d'))
            ->first();

        // Verificar si se encontró un cupón válido
        if (!$cupon) {
            // Si no se encontró un cupón válido, devolver un mensaje de error
            return $this->response->setJSON(['error' => 'El cupón no es válido o ha caducado']);
        }

        session()->set('descuento', $cupon['descuento']);

        // Devolver el descuento del cupón como respuesta
        /* return $this->response->setJSON(['descuento' => $cupon['descuento']]); */
        return $this->response->setJSON(['success' => true]);
    }


    public function obtenerDescuento()
    {
        // Obtener el descuento de la sesión
        $descuento = session()->get('descuento');

        // Verificar si el descuento es nulo o vacío
        if ($descuento === null || $descuento === '') {
            // Establecer el descuento como 0
            $descuento = 0;
        }

        // Devolver el descuento como respuesta JSON
        return $this->response->setJSON(['descuento' => $descuento]);
    }

    public function eliminarDescuento()
    {
        // Eliminar el descuento de la sesión
        session()->remove('descuento');

        // Devolver una respuesta de éxito
        return $this->response->setJSON(['success' => true]);
    }


      public function generarMasivos()
    {
        $cuponModel = new CuponModel();

        if ($this->request->getMethod() === 'post') {
            $cantidad = (int) $this->request->getPost('cantidad');
            $descuento = (int) $this->request->getPost('descuento');
            $vigencia = (int) $this->request->getPost('vigencia'); // días
            $estado = 'activo';

            $cupones = [];
            for ($i = 0; $i < $cantidad; $i++) {
                $codigo = strtoupper(bin2hex(random_bytes(4))); // 8 caracteres aleatorios
                $cupones[] = [
                    'codigo' => $codigo,
                    'descuento' => $descuento,
                    'fecha_expiracion' => date('Y-m-d', strtotime("+$vigencia days")),
                    'estado' => $estado
                ];
            }

            $cuponModel->insertarCuponesMasivos($cupones);

            // Obtener todos los cupones para mostrar en la tabla
            $cuponesExistentes = $cuponModel->orderBy('id', 'DESC')->findAll();

            return view('admin/generarMasivos', [
                'cupones' => $cuponesExistentes,
                'success' => "$cantidad cupones generados correctamente."
            ]);
        }

        // Si no es POST, muestra el formulario y la tabla con los cupones existentes
        $cuponesExistentes = $cuponModel->orderBy('id', 'DESC')->findAll();
        return view('admin/generarMasivos', [
            'cupones' => $cuponesExistentes
        ]);
    }

    public function eliminarCupon($id)
    {
        $cuponModel = new \App\Models\CuponModel();
        $cuponModel->delete($id);
        return redirect()->back()->with('success', 'Cupón eliminado correctamente.');
    }
}
