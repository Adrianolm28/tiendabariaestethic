<?php

namespace App\Controllers;

use App\Libraries\IzipayController;
use App\Models\ComprasModel;
use App\Models\DetalleCompraModel;
use App\Models\HistorialEstadoCompraModel;
use App\Models\IzipayCredentialsModel;
use Config\Izipay;

class PaymentController extends BaseController
{
    /* public function index1()
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
            "amount" => 50 * 100, // Simulación de monto (en centavos, por ejemplo, 100 soles)
            "currency" => "PEN", // Moneda
            "customer" => [
                "email" => 'paolosolisgomez1@gmail.com', // Correo electrónico del cliente
            ],
            "orderId" => uniqid("MyOrderId"), // ID de orden único
        ];

        // Realizar la solicitud a Izipay para obtener el token
        $response = $izipay->post("V4/Charge/CreatePayment", $datos);

        // Verificar si hubo algún error en la respuesta
        if (isset($response['error'])) {
            // Manejar el error, por ejemplo, mostrar un mensaje de error
            return "Error al procesar el pago: " . $response['error'];
        }

        // Obtener el formToken de la respuesta
        $formToken = $response["answer"]["formToken"];

        // Cargar la vista con los datos necesarios (puedes ajustar según tus necesidades)
        $data = [
            'formToken' => $formToken,
            'endpointApiRest' => $izipay->getEndpointApiRest(), // Obtener el endpoint API REST del controlador
            'publicKey' => $izipay->getPublicKey(), // Obtener la clave pública del controlador
            'productName' => "Producto de ejemplo", // Nombre del producto (ajustar según tu lógica)
            'productImage' => "https://example.com/product-image.jpg", // URL de imagen del producto (ajustar según tu lógica)
            'amount' => 100, // Monto del producto (ajustar según tu lógica)
            'firstName' => "Nombre", // Nombre del cliente (ajustar según tu lógica)
            'lastName' => "Apellido", // Apellido del cliente (ajustar según tu lógica)
            'email' => "cliente@example.com", // Correo electrónico del cliente (ajustar según tu lógica)
        ];

        // Cargar la vista correspondiente (ajustar según tu estructura de vistas)
        return view('tienda/payment_form', $data);
    } */

    protected $db;
    protected $izipayCredentials;
    private $_hmacSha256;
    public function __construct()
    {
        $this->db = db_connect();
        $this->izipayCredentials = new IzipayCredentialsModel();

        // Obtén el valor de _hmacSha256 desde la base de datos
        $credentials = $this->izipayCredentials->getCredentials();
        $this->_hmacSha256 = $credentials['hmac_sha256'];
    }



    public function index()
    {

        $credentials = $this->izipayCredentials->first();
        // Configurar las claves y configuración de Izipay
        /*    IzipayController::setDefaultUsername("50261865");
        IzipayController::setDefaultPassword("testpassword_Roch8gSznBljFoiWm0ZkUrvgEFYtLqtSzzoFV2idOqkWp");
        IzipayController::setDefaultPublicKey("50261865:testpublickey_oxsxi7xkLzuBrX6esasLYKFx8gzDkhwLjblU4JMIH7Ork");
        IzipayController::setDefaultHmacSha256("N8mGL9QPT2deHN1OL0W4I8SGgWysex5ahIcyFqS03Atmw");
        IzipayController::setDefaultEndpointApiRest("https://api.micuentaweb.pe"); */

        IzipayController::setDefaultUsername($credentials['username']);
        IzipayController::setDefaultPassword($credentials['password']);
        IzipayController::setDefaultPublicKey($credentials['public_key']);
        IzipayController::setDefaultHmacSha256($credentials['hmac_sha256']);
        IzipayController::setDefaultEndpointApiRest($credentials['endpoint_api_rest']);

        // Cargar la vista inicial sin datos dinámicos de pago
        return view('tienda/payment_form');
    }






    private function recalcularMontoTotal($carrito, $costoEnvio)
    {
        $totalAmount = 0;

        foreach ($carrito as $item) {
            $totalAmount += $item['precio'] * $item['cantidad'];
        }

        // Sumar el costo de envío al monto total
        $totalAmount += $costoEnvio;

        return $totalAmount;
    }





    /* public function getToken()
    {
        // Obtener los datos del formulario enviado por AJAX
        $formData = $this->request->getPost();
        $carrito = $this->request->getPost('carrito');

        // Calcular el monto total basado en el carrito
        $totalAmount = $this->recalcularMontoTotal($carrito, $formData['costo_envio']);



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
            "amount" => $totalAmount * 100, // Convertir a centavos si es necesario
            "currency" => "PEN",
            "language" => "ES",
            "customer" => [
                "email" => $formData['correo'],
                "billingDetails" => [
                    "firstName" => strtok($formData['nombre'], " "),
                    "lastName" => trim(substr($formData['nombre'], strpos($formData['nombre'], ' ') + 1)),
                    "address" => $formData['direccion'],
                    "phoneNumber" => $formData['telefono'],
                ],
            ],
            "orderId" => uniqid("MyOrderId"),

        ];

        $comprasModel = new ComprasModel();

        $response = $izipay->post("V4/Charge/CreatePayment", $datos);


        // Verificar si hubo algún error en la respuesta
        if (isset($response['error'])) {
            // Manejar el error, por ejemplo, devolver un error JSON
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al obtener el token de pago: ' . $response['error']
            ]);
        }

        // Obtener el formToken de la respuesta
        $formToken = $response["answer"]["formToken"];





        // Preparar los datos para la vista
        $data = [
            'formToken' => $formToken,
            'endpointApiRest' => $izipay->getEndpointApiRest(),
            'publicKey' => $izipay->getPublicKey(),
            'formData' => $formData

        ];

        // Devolver una respuesta JSON con éxito y los datos para la vista
        return $this->response->setJSON([
            'success' => true,
            'data' => $data
        ]);
    } */

    public function getToken()
    {

        $this->db->transBegin();

        $sessionData = session()->get();
        $idUsuario = $sessionData['id_usuario'];
        $descuento = session()->get('descuento');
        // Obtener los datos del formulario enviado por AJAX
        $formData = $this->request->getPost();
        $carrito = $this->request->getPost('carrito');

        $credentials = $this->izipayCredentials->first();

        // Calcular el monto total basado en el carrito
        $totalAmount = $this->recalcularMontoTotal($carrito, $formData['costo_envio']);

        // Configurar las claves y configuración de Izipay
        /* IzipayController::setDefaultUsername("50261865");
        IzipayController::setDefaultPassword("testpassword_Roch8gSznBljFoiWm0ZkUrvgEFYtLqtSzzoFV2idOqkWp");
        IzipayController::setDefaultPublicKey("50261865:testpublickey_oxsxi7xkLzuBrX6esasLYKFx8gzDkhwLjblU4JMIH7Ork");
        IzipayController::setDefaultHmacSha256("N8mGL9QPT2deHN1OL0W4I8SGgWysex5ahIcyFqS03Atmw");
        IzipayController::setDefaultEndpointApiRest("https://api.micuentaweb.pe"); */

        IzipayController::setDefaultUsername($credentials['username']);
        IzipayController::setDefaultPassword($credentials['password']);
        IzipayController::setDefaultPublicKey($credentials['public_key']);
        IzipayController::setDefaultHmacSha256($credentials['hmac_sha256']);
        IzipayController::setDefaultEndpointApiRest($credentials['endpoint_api_rest']);

        // Crear una instancia de IzipayController
        $izipay = new IzipayController();

        $orderId = "Order" . date('YmdHis') . uniqid();

        // Simular datos para la compra (ajustar según tu lógica real)
        $datos = [
            "amount" => $totalAmount * 100, // Convertir a centavos si es necesario
            "currency" => "PEN",
            "language" => "ES",
            "customer" => [
                "email" => $formData['correo'],
                "billingDetails" => [
                    "firstName" => strtok($formData['nombre'], " "),
                    "lastName" => trim(substr($formData['nombre'], strpos($formData['nombre'], ' ') + 1)),
                    "address" => $formData['direccion'],
                    "phoneNumber" => $formData['telefono'],
                ],
            ],
            "orderId" => $orderId,
        ];



        // Realizar la llamada a la API de Izipay para crear el pago
        $response = $izipay->post("V4/Charge/CreatePayment", $datos);

        // Verificar si hubo algún error en la respuesta
        if (isset($response['error'])) {
            // Manejar el error, por ejemplo, devolver un error JSON
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al obtener el token de pago: ' . $response['error']
            ]);
        }

        // Obtener el formToken de la respuesta
        if (isset($response["answer"]["formToken"])) {
            $formToken = $response["answer"]["formToken"];

            $ubicacionRecojo = $this->request->getPost('ubicacion_recojo');
            if ($formData['tipo_entrega'] === 'recojo') {
                $ubicacionRecojo = 'Calle Juana Manrique de Luna 168 - San Miguel';
            } else {
                $ubicacionRecojo = $formData['direccion'];
            }


            // Preparar los datos para la compra en tu tabla 'compras'
            $comprasModel = new ComprasModel();
            $datosCompra = [
                'id_transaccion' => $orderId,
                'fecha' => date('Y-m-d H:i:s'),
                'status' => 'pending',
                'email' => $formData['correo'],
                'id_cliente' => $idUsuario,
                'total' => $totalAmount,
                'dni' => $formData['dni'],
                'nombre' => strtok($formData['nombre'], " "),
                'apellido' => trim(substr($formData['nombre'], strpos($formData['nombre'], ' ') + 1)),
                'telefono' => $formData['telefono'],
                'departamento' => $formData['departamento'],
                'provincia' => $formData['provincia'],
                'distrito' => $formData['distrito'],
                'direccion' => $formData['direccion'],
                'numero' => $formData['numero'],
                'tipo_entrega' => $formData['tipo_entrega'],
                'voucher_img' => null,
                'status_compra' => 2,
                'descuento' => 0,
                'ubicacion_recojo' => $ubicacionRecojo,
                'fecha_recojo' => $formData['fecha_recojo'],
                'hora_recojo' => $formData['hora_recojo'],
                'estado_recojo' => 'pending',
                'notas_recojo' => null,
                'nombre_recojo' => $formData['nombre_recojo'],
                'costo_envio' => $formData['costo_envio'],
                'canal_pago' => 'Izipay'
            ];

            // Insertar datos en la tabla 'compras'
            $idCompra = $comprasModel->insert($datosCompra);

            // Verificar si se insertó correctamente
            if ($idCompra) {

                $historialEstadoCompraModel = new \App\Models\HistorialEstadoCompraModel();
                $estadoCompra = [
                    'compra_id' => $idCompra,
                    'estado_id' => 2, // ID del estado "pendiente"
                    'fecha_cambio' => date('Y-m-d H:i:s'),
                    'motivo_id' => 2,
                ];
                $historialEstadoCompraModel->insert($estadoCompra);


                // Instanciar el modelo de detalle de compra
                $detalleCompraModel = new \App\Models\DetalleCompraModel();

                // Iterar sobre cada producto en el carrito y agregar un detalle de compra para cada uno
                foreach ($carrito as $producto) {
                    $detalleCompra = [
                        'id_compra' => $idCompra,
                        'id_producto' => $producto['id'],
                        'nombre' => $producto['nombre'],
                        'precio' => $producto['precio'],
                        'cantidad' => $producto['cantidad']
                    ];

                    // Insertar el detalle de compra en la tabla detalle_compra
                    $detalleCompraModel->insert($detalleCompra);
                }
            }
        } else {

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: No se recibió un formToken válido.'
            ]);
        }


        $this->db->transCommit();

        $data = [
            'formToken' => $formToken,
            'endpointApiRest' => $izipay->getEndpointApiRest(),
            'publicKey' => $izipay->getPublicKey(),
            'formData' => $formData
        ];
        return $this->response->setJSON([
            'success' => true,
            'data' => $data
        ]);
    }



    public function handlePaymentResponse()
    {
        // Obtén los datos POST recibidos
        $postData = $this->request->getPost();


        // Verifica si se recibieron datos POST
        if (empty($postData)) {
            throw new \Exception("No se recibieron datos POST");
        }

        // Verifica si el hash recibido coincide con el hash calculado
        if (!$this->checkHash($postData)) {
            // Si no coincide, muestra el error de verificación de hash
            return view('tienda/payment_response', [
                'title' => "Error de verificación de hash",
                'message' => "El hash recibido no coincide con el hash calculado. La respuesta de pago no es válida."
            ]);
        }

        // Procesa el pago exitoso
        if ($postData["kr-answer-type"] === "V4/Payment") {
            $krAnswer = json_decode($postData["kr-answer"], true);


            $orderId = $krAnswer['orderDetails']['orderId'];
            $orderStatus = $krAnswer['orderStatus'];

            if ($orderStatus === "PAID") {
                $compraModel = new ComprasModel();

                // Busca la compra por id_transaccion
                $compra = $compraModel->where('id_transaccion', $orderId)->first();

                // Si se encuentra la compra, actualiza el campo status
                if ($compra) {
                    $compraModel->update($compra['id'], ['status' => 'PAID']);
                }
            }

            // Devuelve una vista con la respuesta de pago exitoso y detalles adicionales
            return view('tienda/payment_response', [
                'title' => "Pago exitoso",
                'message' => "El pago se realizó con éxito.",
                'details' => $krAnswer, // Puedes pasar más detalles según sea necesario
                'customer' => $krAnswer['customer'], // Ejemplo: información del cliente
                'transaction' => $krAnswer['transactions'][0] // Ejemplo: detalles de la transacción
            ]);
        }

        // Si el tipo de respuesta no es de pago, muestra un mensaje de pago fallido
        return view('tienda/payment_response', [
            'title' => "Pago fallido",
            'message' => "El pago no se realizó. Por favor, intente nuevamente."
        ]);
    }

    /* private function checkHash($postData)
    {


        // Define los algoritmos de hash soportados por tu aplicación
        $supportedHashAlgorithms = array("sha256_hmac");

        // Verifica si el algoritmo de hash recibido está soportado
        if (!in_array($postData["kr-hash-algorithm"], $supportedHashAlgorithms)) {
            return false;
        }

        // Define la clave según el algoritmo de hash recibido
        if ($postData['kr-hash-algorithm'] == "sha256_hmac") {
            $key = $this->_hmacSha256;
        } else {
            return false; // Manejo de otros algoritmos de hash si es necesario
        }

        // Normaliza los datos de respuesta para asegurar consistencia
        $krAnswer = $postData["kr-answer"];

        // Calcula el hash localmente usando HMAC con SHA-256 y tu clave
        $calculatedHash = hash_hmac("sha256", $krAnswer, $key);

        

        // Compara el hash recibido con el calculado localmente
        return hash_equals($postData['kr-hash'], $calculatedHash);
    } */

    /*   private function checkHash($postData)
    {
        // Define la clave HMAC-SHA-256 desde la configuración
        $shaKey = $this->_hmacSha256; // Usa la clave correcta de la tabla de claves de la API REST

        // Verifica que el algoritmo de hash recibido es soportado
        $supported_sign_algos = array('sha256_hmac');
        if (!isset($postData['kr-hash-algorithm']) || !in_array($postData['kr-hash-algorithm'], $supported_sign_algos)) {
            return [
                'success' => false,
                'message' => 'Algoritmo de hash no soportado o no presente.'
            ];
        }

        // Verifica que kr-answer y kr-hash estén presentes
        if (!isset($postData['kr-answer']) || !isset($postData['kr-hash'])) {
            return [
                'success' => false,
                'message' => 'Faltan datos necesarios: kr-answer o kr-hash.'
            ];
        }

        // Normaliza el JSON escapado en kr-answer
        $kr_answer = str_replace('\/', '/', $postData['kr-answer']);

        // Calcula el hash usando HMAC con SHA-256 y la clave
        $calculatedHash = hash_hmac('sha256', $kr_answer, $shaKey);

        // Imprime ambos hashes para depuración (en un entorno de producción, deberías remover esto)
       

        // Compara si el hash recibido coincide con el hash calculado
        if (hash_equals($postData['kr-hash'], $calculatedHash)) {
            return [
                'success' => true,
                'message' => 'El hash coincide correctamente.'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error de verificación de hash: el hash recibido no coincide con el hash calculado.',
                'calculatedHash' => $calculatedHash,
                'receivedHash' => $postData['kr-hash']
            ];
        }
    } */


    public function checkHash()
    {
        $supportedHashAlgoritm = array("sha256_hmac");

        // Verifica si el algoritmo de hash es soportado
        if (!in_array($_POST["kr-hash-algorithm"], $supportedHashAlgoritm)) {
            print_r("Algoritmo no soportado: " . $_POST["kr-hash-algorithm"] . "\n");
            return false;
        }

        // Determina la clave a utilizar, basada en el algoritmo
        if ($_POST['kr-hash-algorithm'] == "sha256_hmac") {
            $key = $this->_hmacSha256;
        } elseif ($_POST['kr-hash-algorithm'] == "password") {
            $key = "testpassword_Roch8gSznBljFoiWm0ZkUrvgEFYtLqtSzzoFV2idOqkWp";
        } else {
            print_r("Algoritmo no válido.\n");
            return false;
        }

        // Normaliza el JSON escapado en kr-answer
        $krAnswer = str_replace('\/', '/', $_POST["kr-answer"]);

        // Obtiene el hash recibido
        $hash = $_POST['kr-hash'];

        // Calcula el hash usando HMAC con SHA-256 y la clave determinada
        $calculateHash = hash_hmac("sha256", $krAnswer, $key);


        // Compara si el hash recibido coincide con el hash calculado
        return ($calculateHash == $hash);
    }









    public function handleIPN()
    {
        // Obtén los datos POST enviados por Izipay
        $postData = $this->request->getPost();

        // Verifica si se recibieron datos POST
        if (empty($postData)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'No se recibieron datos POST'
            ]);
        }

        // Verifica si el hash recibido coincide con el hash calculado
        if (!$this->checkHash($postData)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Error de verificación de hash: el hash recibido no coincide con el hash calculado.'
            ]);
        }

        // Procesa la notificación IPN según el tipo de respuesta
        if ($postData["kr-answer-type"] === "V4/Payment") {  // Aquí cambia a "V4/Payment"
            $ipnData = json_decode($postData["kr-answer"], true);

            // Aquí es donde agregarías la lógica de actualización
            $orderId = $ipnData['orderDetails']['orderId'];
            $orderStatus = $ipnData['orderStatus'];

            if ($orderStatus === "PAID") {
                $compraModel = new ComprasModel();
                $compra = $compraModel->where('id_transaccion', $orderId)->first();
                if ($compra) {
                    $compraModel->update($compra['id'], ['status' => 'PAID']);
                    // Puedes agregar lógica adicional aquí, como enviar un correo electrónico
                }
            }

            // Devuelve una respuesta de éxito
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Notificación de pago recibida y procesada correctamente.'
            ]);
        }

        // Si el tipo de respuesta no es "V4/Payment", devuelve un mensaje de error
        return $this->response->setStatusCode(400)->setJSON([
            'success' => false,
            'message' => 'Tipo de respuesta no válido para IPN.'
        ]);
    }
}
