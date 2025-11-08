<?php

namespace App\Models;

use CodeIgniter\Model;

class IzipayModel extends Model
{

    protected $table = 'transacciones_izipay'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'id'; // Nombre de la clave primaria de la tabla

    protected $allowedFields = [
        'amount',
        'currency',
        'customer_email',
        'order_id',
        'transaction_id',
        'status',
        'created_at',
        'updated_at',
    ]; // Campos permitidos para insertar y actualizar

    protected $useTimestamps = true; // Habilitar timestamps (created_at y updated_at)

    protected $returnType = 'array'; // Tipo de datos que devuelve el modelo

    /**
     * Constructor del modelo
     */
    public function __construct()
    {
        parent::__construct();
        // Cargar configuraciones o inicializar variables necesarias
    }

    /**
     * Realiza una transacción de pago con Izipay.
     *
     * @param array $data Datos del formulario de pago.
     * @return array Respuesta de la transacción.
     */
    public function realizarPago($data)
    {
        $formData = [
            'amount' => $data['amount'] * 100,
            'currency' => 'PEN',
            'customer' => [
                'email' => $data['correo'],
            ],
            'orderId' => uniqid("MyOrderId"),
        ];

        // Llamar al método postWithCurl del controlador IzipayController o implementar la lógica aquí
        $response = $this->postWithCurl('V4/Charge/CreatePayment', $formData);

        // Guardar la transacción en la base de datos si es necesario
        if ($response['success']) {
            $this->save([
                'amount' => $formData['amount'],
                'currency' => $formData['currency'],
                'customer_email' => $formData['customer']['email'],
                'order_id' => $formData['orderId'],
                'transaction_id' => $response['answer']['transactionId'],
                'status' => 'paid', // Estado de la transacción
            ]);
        }

        return $response;
    }

    /**
     * Realiza una solicitud POST utilizando cURL.
     *
     * @param string $target Endpoint de la API.
     * @param array $data Datos a enviar en la solicitud.
     * @return array Respuesta de la solicitud.
     */
    protected function postWithCurl($target, $data)
    {
        $auth = $this->config->izipay['username'] . ':' . $this->config->izipay['password'];
        $url = $this->config->izipay['endpoint_api_rest'] . '/api-payment/' . $target;

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERPWD, $auth);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $raw_response = curl_exec($curl);
        $response = json_decode($raw_response, true);

        curl_close($curl);

        return $response;
    }
}
