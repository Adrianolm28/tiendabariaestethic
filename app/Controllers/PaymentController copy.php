<?php

namespace App\Controllers;

use App\Libraries\IzipayController;
use Config\Izipay;

class PaymentController extends BaseController
{
    public function index()
    {
        // Configurar las claves y configuración de Izipay
        IzipayController::setDefaultUsername("50261865");
        IzipayController::setDefaultPassword("testpassword_Roch8gSznBljFoiWm0ZkUrvgEFYtLqtSzzoFV2idOqkWp");
        IzipayController::setDefaultPublicKey("50261865:testpublickey_oxsxi7xkLzuBrX6esasLYKFx8gzDkhwLjblU4JMIH7Ork");
        IzipayController::setDefaultHmacSha256("N8mGL9QPT2deHN1OL0W4I8SGgWysex5ahIcyFqS03Atmw");
        IzipayController::setDefaultEndpointApiRest("https://api.micuentaweb.pe");

        // Crear una instancia de IzipayController
        $izipay = new IzipayController();

        // Simular datos para la compra (ajustar según tu lógica real)
        $datos = [
            "amount" => $_POST["amount"] * 100,
            "currency" => "PEN",
            "customer" => [
                "email" => $_POST["email"],
            ],
            "orderId" => uniqid("MyOrderId"),
        ];

        // Realizar la solicitud a Izipay para obtener el token
        $response = $izipay->post("V4/Charge/CreatePayment", $datos);
        $formToken = $response["answer"]["formToken"];

        // Cargar la vista con los datos necesarios
        $data = [
            'formToken' => $formToken,
            'endpointApiRest' => "https://api.micuentaweb.pe", // Ajustar según tu configuración
            'publicKey' => "50261865:testpublickey_oxsxi7xkLzuBrX6esasLYKFx8gzDkhwLjblU4JMIH7Ork", // Ajustar según tu configuración
            'productName' => $_POST["product"],
            'productImage' => $_POST["image"],
            'amount' => $_POST["amount"],
            'firstName' => $_POST["firstName"],
            'lastName' => $_POST["lastName"],
            'email' => $_POST["email"],
        ];

        // Cargar la vista correspondiente (ajustar según tu estructura de vistas)
        return view('tienda/payment_form', $data);
    }

    public function handlePaymentResponse()
    {
        // Obtener los datos enviados por el formulario de pago
        $postData = $this->request->getPost();

        if (empty($postData)) {
            throw new \Exception("No se recibieron datos POST");
        }

        // Instancia de tu controlador de Izipay
        $payment = new \App\Libraries\IzipayController();

        // Verificar la firma
        if (!$payment->checkHash()) {
            throw new \Exception("Firma inválida");
        }

        // Analizar la respuesta del pago
        $answer = json_decode($postData["kr-answer"], true);
        $title = $answer['orderStatus'] != 'PAID' ? "Pago No Finalizado!" : "Pago Finalizado!";

        // Pasar datos a la vista
        return view('tienda/payment_response', [
            'title' => $title,
            'kr_hash' => $postData["kr-hash"],
            'kr_hash_algorithm' => $postData["kr-hash-algorithm"],
            'kr_answer_type' => $postData["kr-answer-type"],
            'kr_answer' => print_r($postData["kr-answer"], true),
            'endpoint_api_rest' => Izipay::$DEFAULT_ENDPOINT_APIREST
        ]);
    }






    public function createPayment($amount, $customerEmail)
    {
        $payment = new IzipayController();
        $requestData = [
            "amount" => $amount * 100, // Multiplica por 100 si la API de Izipay espera el monto en centavos
            "currency" => "PEN", // Cambia según la moneda que uses
            "customer" => [
                "email" => $customerEmail
            ],
            "orderId" => uniqid("Order_")
        ];

        // Aquí realiza la llamada a la API de Izipay para crear el pago
        $response = $payment->post("V4/Charge/CreatePayment", $requestData);

        // Retorna la respuesta de la API de Izipay
        return $response;
    }
}
