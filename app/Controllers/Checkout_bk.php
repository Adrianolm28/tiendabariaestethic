<?php


namespace App\Controllers;

use App\Models\CategoriaProductoModel;


use App\Models\ComprasModel;
use App\Models\ConfiguracionTiendaModel;
use App\Models\CotizacionDetalleModel;
use App\Models\CotizacionModel;
use App\Models\DetalleCompraModel;
use App\Models\ProductoModel;
use App\Models\UbigeoModel;
use App\Models\UsuariosModel;
use CodeIgniter\CLI\Console;
use CodeIgniter\Controller;
use MercadoPago\Item;
use MercadoPago\Preference;
use CodeIgniter\Email\Email;
use CodeIgniter\Database\Exceptions\DatabaseException;
use Dompdf\Dompdf;
use Mpdf\Mpdf;

class Checkout extends BaseController
{
    const TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imtpa29waW9hQGdtYWlsLmNvbSJ9.D6Oj4KInXAwKPluyDnbsxo8sB9JVYvyhSzYG1JBbtkc";
    const TOKEN_DNI = "7e80775b-a28b-4c39-bc2f-12068472d66d-b35c52cb-1d9f-4200-a236-de854e770046";


    protected $db;
    protected $configModel;
    protected $categoriaModel;
    public function __construct()
    {
        $this->db = db_connect();
        $this->configModel = new ConfiguracionTiendaModel();
        $this->categoriaModel = new CategoriaProductoModel();
    }

    public function index()
    {
        $userData = null;
        if (session()->has('usuario_autenticado')) {
            $userData = [
                'nombre' => session('nombre_usuario'),

            ];
        }
        $configTienda = $this->configModel->obtenerConfiguracion();
        $categoriasFooter = $this->categoriaModel->findAll();
        return view('tienda/checkout', [
            'userData' => $userData,
            'configTienda' => $configTienda,
            'categoriasFooter' =>  $categoriasFooter
        ]);
    }



    /* public function procesarPago()
    {
        try {
            helper('url');
            $configTienda = $this->configModel->obtenerConfiguracion();
            $costoEnvio = 9.90;
           
            $usuarioAutenticado = session('usuario_autenticado');
            $formData = $this->request->getPost('formData');
            $carrito = $this->request->getPost('carrito');

            $descuento = isset($_POST['descuento']) ? $_POST['descuento'] : 0;

            $ubicacionRecojo = "Calle Juana Manrique de Luna 168 - San Miguel";

            echo "<pre>";
            print_r($_POST);

            session()->set('usuarioAutenticado', $usuarioAutenticado);
            session()->set('formData', $formData);
            session()->set('carrito', $carrito);
            session()->set('descuento', $descuento);


            if (empty($carrito) || !is_array($carrito)) {
                throw new \Exception('El carrito está vacío o no es válido.');
            }

            $accessToken = $configTienda[0]['access_token'];
            $publickey = $configTienda[0]['public_key'];

            \MercadoPago\SDK::setAccessToken($accessToken);
            $preference = new Preference();



            $productosM = [];
            foreach ($carrito as $producto) {
                $item = new Item();
                $item->id = $producto['id'];
                $item->title = $producto['nombre'];
                $item->quantity = $producto['cantidad'];

                $precio = $producto['precio'];
                if ($descuento > 0) {
                    $descuentoAplicado = $precio * ($descuento / 100);
                    $precio -= $descuentoAplicado;
                }



                $item->unit_price = $precio;
                $item->currency_id = "PEN";

                $productosM[] = $item;
            }

            $itemEnvio = new Item();
            $itemEnvio->id = "envio";
            $itemEnvio->title = "Costo de envío";
            $itemEnvio->quantity = 1;
            $itemEnvio->unit_price = $costoEnvio;
            $itemEnvio->currency_id = "PEN";
            $productosM[] = $itemEnvio;




            $preference->items = $productosM;



            // Configurar las URL de retorno
            $preference->back_urls = array(
                "success" => base_url("checkout/compraexitosa"),
                "fail" => base_url("tienda")
            );

            $preference->auto_return = "approved";
            $preference->binary_mode = true;
            $preference->save();

            return json_encode(['success' => true, 'preference_id' => $preference->id, 'publickey' => $publickey]);
        } catch (\Exception $e) {
            // Manejar la excepción
            return json_encode(['success' => false, 'message' => 'Error al procesar el pago: ' . $e->getMessage()]);
        }
    } */


    public function procesarPago()
    {
        try {
            helper('url');

            // Obtener la configuración de la tienda
            $configTienda = $this->configModel->obtenerConfiguracion();

            // Inicializar variables
            $usuarioAutenticado = session('usuario_autenticado');
            $formData = $this->request->getPost('formData');
            $carrito = $this->request->getPost('carrito');

            // Obtener el descuento del formulario o establecerlo en 0 si no está presente
            $descuento = isset($_POST['descuento']) ? $_POST['descuento'] : 0;

            // Establecer la ubicación de recojo por defecto (esto puede ser dinámico si es necesario)
            $ubicacionRecojo = "Calle Juana Manrique de Luna 168 - San Miguel";

            // Almacenar datos en sesión para usarlos en compraexitosa
            session()->set('usuarioAutenticado', $usuarioAutenticado);
            session()->set('formData', $formData);
            session()->set('carrito', $carrito);
            session()->set('descuento', $descuento);

            // Validar que el carrito no esté vacío y sea un array
            if (empty($carrito) || !is_array($carrito)) {
                throw new \Exception('El carrito está vacío o no es válido.');
            }

            // Configurar el acceso y la preferencia de MercadoPago
            $accessToken = $configTienda[0]['access_token'];
            $publickey = $configTienda[0]['public_key'];
            \MercadoPago\SDK::setAccessToken($accessToken);
            $preference = new Preference();

            // Construir los ítems del carrito
            $productosM = [];
            foreach ($carrito as $producto) {
                $item = new Item();
                $item->id = $producto['id'];
                $item->title = $producto['nombre'];
                $item->quantity = $producto['cantidad'];

                // Aplicar descuento si existe
                $precio = $producto['precio'];
                if ($descuento > 0) {
                    $descuentoAplicado = $precio * ($descuento / 100);
                    $precio -= $descuentoAplicado;
                }

                $item->unit_price = $precio;
                $item->currency_id = "PEN";

                $productosM[] = $item;
            }

            // Obtener el costo de envío desde $formData
            $costoEnvio = isset($formData['costo_envio']) ? $formData['costo_envio'] : 0;

            // Agregar el ítem de costo de envío a la preferencia de MercadoPago
            if ($costoEnvio > 0) {
                $itemEnvio = new Item();
                $itemEnvio->id = "envio";
                $itemEnvio->title = "Costo de envío";
                $itemEnvio->quantity = 1;
                $itemEnvio->unit_price = $costoEnvio;
                $itemEnvio->currency_id = "PEN";
                $productosM[] = $itemEnvio;
            }

            // Asignar los ítems a la preferencia de MercadoPago
            $preference->items = $productosM;

            // Configurar las URL de retorno
            $preference->back_urls = array(
                "success" => base_url("checkout/compraexitosa"),
                "fail" => base_url("tienda")
            );

            $preference->auto_return = "approved";
            $preference->binary_mode = true;
            $preference->save();

            // Devolver la respuesta JSON con la preferencia y clave pública
            return json_encode(['success' => true, 'preference_id' => $preference->id, 'publickey' => $publickey]);
        } catch (\Exception $e) {
            // Manejar la excepción
            return json_encode(['success' => false, 'message' => 'Error al procesar el pago: ' . $e->getMessage()]);
        }
    }




    /*  public function procesarCarrito()
    {
        try {



            $descuento = isset($_POST['descuento']) ? $_POST['descuento'] : 0;

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Carrito procesado correctamente',
                'descuento' => $descuento
            ]);
        } catch (\Exception $e) {
            // Manejar la excepción
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error al procesar el carrito: ' . $e->getMessage()]);
        }
    }
 */

    public function procesarCarrito()
    {
        try {
            // Obtener el descuento enviado desde la solicitud POST
            $descuento = $this->request->getPost('datos');

            print_r($descuento);

            // Aquí puedes realizar cualquier otra lógica necesaria para procesar el carrito

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Carrito procesado correctamente',
                'descuento' => $descuento // Devuelve el descuento en la respuesta JSON
            ]);
        } catch (\Exception $e) {
            // Manejar la excepción
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error al procesar el carrito: ' . $e->getMessage()]);
        }
    }



    public function ingresarDatos()
    {
        try {


            if (!session()->has('usuario_autenticado')) {
                return redirect()->to('/tienda/carrito')->with('error', 'Debes iniciar sesión para continuar.');
            }

            if (session()->has('usuario_autenticado')) {
                $userData = session()->get();
            } else {

                $userData = [];
            }

            $id_usuario = session()->get('id_usuario');

            $descuento = session()->get('descuento', 0);
            $usuarioModel = new UsuariosModel();
            $usuario = $usuarioModel->select('id_usuario, nombre, correo, celular, documento_tipo, documento_numero, estado, contacto, nombre_c')->find($id_usuario);


            /* print_r($usuario); */

            \MercadoPago\SDK::setAccessToken(getenv('MERCADOPAGO_ACCESS_TOKEN'));

            // Obtener los datos de ubicación
            $ubicacionData = json_decode($this->cargarUbigeoData(), true);
            // Obtener el descuento si está disponible



            // Obtener los datos del carrito del almacenamiento de sesión
            $session = session();
            $carrito = $session->get('carrito');

            $configTienda = $this->configModel->obtenerConfiguracion();
            $categoriasFooter = $this->categoriaModel->findAll();


            // Pasar los datos del carrito y los departamentos a la vista
            return view('tienda/ingresardatos', [
                'carrito' => $carrito,
                'departamentos' => $ubicacionData['departamentos'],
                'provincias' => $ubicacionData['provincias'],
                'distritos' => $ubicacionData['distritos'],
                'userData' => $userData,
                'usuarioAutenticado' => $usuario,
                'descuento' => $descuento,
                'configTienda' => $configTienda,
                'categoriasFooter' =>  $categoriasFooter

            ]);
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Error al obtener los datos del carrito: ' . $e->getMessage());
        }
    }



    public function getDNI_New()
    {
        try {
            $dni = $this->request->getGet('dni');

            if ($dni) {
                $url = "https://apirest.siga.com.pe/reniec?dni=$dni";
                $client = \Config\Services::curlrequest();
                $response = $client->request('GET', $url);

                if ($response->getStatusCode() == 200) {
                    $datos_dni = json_decode($response->getBody(), true);
                    return json_encode($datos_dni);
                } else {
                    return "Error al consultar el DNI. Código de estado: " . $response->getStatusCode();
                }
            } else {
                return "Por favor, proporcione un número de DNI.";
            }
        } catch (\Exception $e) {
            return "Error al procesar la solicitud: " . $e->getMessage();
        }
    }

    public function getDatosFromAPI_Sunac_new()
    {
        $ruc = $this->request->getPost('RUC');
        if (!empty($ruc)) {
            require_once(APPPATH . 'Libraries/Consulta_ruc/vendor/autoload.php');
            $cookie = array(
                'cookie' => array(
                    'use' => true,
                    'file' => APPPATH . "Libraries/Consulta_ruc/cookie.txt"
                )
            );
            $config = [
                'representantes_legales' => true,
                'cantidad_trabajadores' => true,
                'establecimientos' => true,
                'deuda' => true,
                'cookie' => $cookie
            ];

            $company = new \jossmp\sunat\ruc($config);
            $search1 = $company->consulta($ruc);
            $json = json_decode($search1, true);
            if ($json["success"]) {
                $result = $json["result"];
                $validar = substr($result["ruc"], 0, 2);
                $direccion = ($validar == '20') ? $result["direccion"] . ' ' . $result["departamento"] . ' ' . $result["provincia"] . ' ' . $result["distrito"] : "LIMA - PERU";
                $data = array(
                    "RUC" => $result["ruc"],
                    "RazonSocial" => $result["razon_social"],
                    "Condicion" => $result["condicion"],
                    "NombreComercial" => "",
                    "Tipo" => "",
                    "Inscripcion" => "",
                    "Estado" => $result["estado"],
                    "Direccion" => $direccion,
                    "SistemaEmision" => "-",
                    "ActividadExterior" => "-",
                    "SistemaContabilidad" => "-",
                    "Oficio" => "-",
                    "EmisionElectronica" => "-",
                    "PLE" => "-",
                    "representantes_legales" => array(),
                    "cantidad_trabajadores" => array()
                );
            } else {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://dniruc.apisperu.com/api/v1/ruc/' . $ruc . '?token=' . self::TOKEN);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $dataresult = curl_exec($ch);
                $dataS = json_decode($dataresult);
                curl_close($ch);

                if (isset($dataS->ruc)) {
                    $validar = substr($dataS->ruc, 0, 2);
                    $direccion = ($validar == '20') ? $dataS->direccion : "LIMA - PERU";
                    $data = array(
                        "RUC" => $dataS->ruc,
                        "RazonSocial" => $dataS->razonSocial,
                        "Condicion" => $dataS->condicion,
                        "NombreComercial" => $dataS->nombreComercial,
                        "Estado" => $dataS->estado,
                        "Direccion" => $direccion
                    );
                } else {
                    $data = array(
                        "success" => false,
                        "message" => "No se encontraron datos para el RUC proporcionado."
                    );
                }
            }
        } else {
            $data = array(
                "success" => false,
                "message" => "Ingrese un número RUC válido."
            );
        }

        return $this->response->setJSON($data);
    }



    public function cargarUbigeoData()
    {
        try {
            // Crear una instancia del modelo UbigeoModel
            $ubigeoModel = new UbigeoModel();

            // Obtener los datos de departamentos del modelo
            $departamentos = $ubigeoModel->listarDepartamentos();

            // Inicializar arrays para provincias y distritos
            $provincias = [];
            $distritos = [];
            foreach ($departamentos as $departamento) {
                $provincias[$departamento['idDepa']] = $ubigeoModel->listarProvincias($departamento['idDepa']);
                foreach ($provincias[$departamento['idDepa']] as $provincia) {
                    $distritos[$provincia['idProv']] = $ubigeoModel->listarDistritos($provincia['idProv']);
                }
            }

            // Retornar los datos como un array asociativo
            $data = ['departamentos' => $departamentos, 'provincias' => $provincias, 'distritos' => $distritos];

            // Convertir los datos a formato JSON
            $jsonData = json_encode($data);

            // Devolver los datos en formato JSON
            return $jsonData;
        } catch (\Exception $e) {
            // Manejar la excepción si ocurre algún error
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function obtenerProvincias($departamentoId)
    {
        // Crear una instancia del modelo UbigeoModel
        $ubigeoModel = new UbigeoModel();

        // Obtener las provincias del departamento especificado
        $provincias = $ubigeoModel->listarProvincias($departamentoId);

        // Devolver las provincias en formato JSON
        return json_encode($provincias);
    }
    public function obtenerDistritos($provinciaId)
    {
        // Crear una instancia del modelo UbigeoModel
        $ubigeoModel = new UbigeoModel();

        // Obtener las provincias del departamento especificado
        $provincias = $ubigeoModel->listarDistritos($provinciaId);

        // Devolver las provincias en formato JSON
        return json_encode($provincias);
    }

    public function compraexitosa1()
    {

        try {


            $this->db->transBegin();

            $sessionData = session()->get();
            $idUsuario = $sessionData['id_usuario'];

            $formData = session()->get('formData');
            $carrito = session()->get('carrito');
            $descuento = session()->get('descuento');

            $costoEnvio = 9.90;
            /*  $costoEnvio = floatval($this->request->getPost('costo_envio')); */
            // Obtener parámetros de la URL
            $paymentId = $this->request->getGet('payment_id');
            $status = $this->request->getGet('status');
            $paymentType = $this->request->getGet('payment_type');
            $merchantOrderId = $this->request->getGet('merchant_order_id');



            // Calcular el total de la compra
            $totalCompra = 0;
            foreach ($carrito as $producto) {
                $totalCompra += $producto['precio'] * $producto['cantidad'];
            }

            if ($descuento > 0) {
                $descuentoAplicado = $totalCompra * ($descuento / 100);
                $totalCompra -= $descuentoAplicado;
            }


            $totalCompra += $costoEnvio;



            // Verificar que todos los datos necesarios estén presentes
            if ($formData && $idUsuario && $carrito) {
                // Instanciar el modelo de compras
                $comprasModel = new \App\Models\ComprasModel();

                // Verificar si ya existe una compra con el mismo ID de transacción
                $compraExistente = $comprasModel->where('id_transaccion', $paymentId)->first();

                // Si no existe una compra con el mismo ID de transacción, proceder a registrar la compra
                if (!$compraExistente) {
                    // Crear datos para la nueva compra
                    $datosCompra = [
                        'id_transaccion' => $paymentId,
                        'fecha' => date('Y-m-d H:i:s'),
                        'status' => $status,
                        'email' => $formData['correo'],
                        'id_cliente' => $idUsuario,
                        'total' => $totalCompra,
                        'dni' => $formData['dni'],
                        'nombre' => $formData['nombre'],
                        'apellido' => $formData['apellido'],
                        'telefono' => $formData['telefono'],
                        'departamento' => $formData['departamento'],
                        'provincia' => $formData['provincia'],
                        'distrito' => $formData['distrito'],
                        'direccion' => $formData['direccion'],
                        'numero' => $formData['numero'],
                        'descuento' => $descuento,
                        'ubicacion_recojo' => $formData['ubicacion_recojo'] ?? 'Calle Juana Manrique de Luna 168 - San Miguel',
                        'fecha_recojo' => $formData['fecha_recojo'],
                        'hora_recojo' => $formData['hora_recojo'],
                        'nombre_recojo' => $formData['nombre_recojo'],
                        'tipo_entrega' => $formData['tipo_entrega'],
                    ];

                    // Insertar la nueva compra en la base de datos
                    $idCompra = $comprasModel->insert($datosCompra);

                    // Verificar si la inserción fue exitosa
                    if ($idCompra) {
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
                }
            }

            // Obtener la compra por su ID
            $compra = $comprasModel->find($idCompra);

            // Obtener los detalles de la compra
            $compraDetalles = $comprasModel
                ->select('compras.*, dc.*')
                ->join('detalle_compra dc', 'dc.id_compra = compras.id')
                ->where('compras.id', $idCompra)
                ->findAll();


            if (empty($compraDetalles)) {
                // Redirigir al usuario a la página de compras
                return redirect()->to(base_url('shop'));
            }

            $email = \Config\Services::email();

            $mensaje = '<html><body>';
            $mensaje .= '<h2>Detalles de tu compra</h2>';
            $mensaje .= '<p>Gracias por tu compra. Aquí están los detalles:</p>';
            $mensaje .= '<table border="1">';
            $mensaje .= '<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total por Producto</th></tr>'; // Agregar la columna para el total por producto
            $totalCompra = 0; // Inicializar el total de la compra
            foreach ($compraDetalles as $detalle) {
                // Calcular el total por producto
                $precioTotalProducto = $detalle['precio'] * $detalle['cantidad'];
                $totalCompra += $precioTotalProducto; // Sumar al total de la compra
                // Mostrar fila con detalles del producto y total por producto
                $mensaje .= '<tr>';
                $mensaje .= '<td>' . $detalle['nombre'] . '</td>';
                $mensaje .= '<td>' . $detalle['cantidad'] . '</td>';
                $mensaje .= '<td>' . $detalle['precio'] . '</td>';
                $mensaje .= '<td>' . $precioTotalProducto . '</td>';
                $mensaje .= '</tr>';
            }

            if ($descuento > 0) {
                // Calcular el descuento aplicado
                $descuentoAplicado = $totalCompra * ($descuento / 100);
                // Restar el descuento aplicado al total de la compra
                $totalCompra -= $descuentoAplicado;
                // Agregar fila para mostrar el descuento aplicado
                $mensaje .= '<tr>';
                $mensaje .= '<td colspan="3">Descuento</td>';
                $mensaje .= '<td>' . 'S/ ' . number_format($descuentoAplicado, 2) . '</td>';
                $mensaje .= '</tr>';
            }

            // Mostrar el total
            $mensaje .= '<tr>';
            $mensaje .= '<td colspan="3"><strong>Total:</strong></td>';
            $mensaje .= '<td>' . 'S/ ' . number_format($totalCompra + $costoEnvio, 2) . '</td>';
            $mensaje .= '</tr>';



            $mensaje .= '</table>';
            $mensaje .= '</body></html>';

            $email->setTo($formData['correo']);
            $email->setFrom('sigasoporte1@gmail.com', 'Corporación Siga S.A.C');
            $email->setSubject('Detalles de tu compra');
            $email->setMessage($mensaje);
            $email->setMailType('html');
            if ($email->send()) {
                // Correo electrónico enviado exitosamente
            } else {
                // Error al enviar el correo electrónico
            }



            $configTienda = $this->configModel->obtenerConfiguracion();
            $categoriasFooter = $this->categoriaModel->findAll();

            $this->db->transCommit();
            // Datos para pasar a la vista
            $data = [
                'paymentId' => $paymentId,
                'status' => $status,
                'paymentType' => $paymentType,
                'merchantOrderId' => $merchantOrderId,
                'compra' => $compra,
                'compraDetalles' => $compraDetalles,
                'configTienda' => $configTienda,
                'categoriasFooter' =>  $categoriasFooter
            ];


            session()->remove('carrito');
            session()->remove('descuento');
            session()->remove('formData');

            // Pasar los detalles del pago a la vista
            return view('tienda/compraexitosa', $data);
        } catch (\Exception  $e) {

            return redirect()->to(base_url('shop'));
        }
    }


    public function compraexitosa()
    {
        try {
            $this->db->transBegin();

            // Obtener datos de sesión
            $sessionData = session()->get();
            $idUsuario = $sessionData['id_usuario'];
            $formData = session()->get('formData');
            $carrito = session()->get('carrito');
            $descuento = session()->get('descuento');

            // Obtener costo de envío desde formData
            $costoEnvio = isset($formData['costo_envio']) ? floatval($formData['costo_envio']) : 0;

            // Obtener parámetros de la URL
            $paymentId = $this->request->getGet('payment_id');
            $status = $this->request->getGet('status');
            $paymentType = $this->request->getGet('payment_type');
            $merchantOrderId = $this->request->getGet('merchant_order_id');

            // Calcular el total de la compra
            $totalCompra = 0;
            foreach ($carrito as $producto) {
                $totalCompra += $producto['precio'] * $producto['cantidad'];
            }

            // Aplicar descuento si existe
            if ($descuento > 0) {
                $descuentoAplicado = $totalCompra * ($descuento / 100);
                $totalCompra -= $descuentoAplicado;
            }

            // Sumar el costo de envío al total de la compra
            $totalCompra += $costoEnvio;

            // Verificar que todos los datos necesarios estén presentes
            if ($formData && $idUsuario && $carrito) {
                // Instanciar el modelo de compras
                $comprasModel = new \App\Models\ComprasModel();

                // Verificar si ya existe una compra con el mismo ID de transacción
                $compraExistente = $comprasModel->where('id_transaccion', $paymentId)->first();

                // Si no existe una compra con el mismo ID de transacción, proceder a registrar la compra
                if (!$compraExistente) {
                    // Crear datos para la nueva compra
                    $datosCompra = [
                        'id_transaccion' => $paymentId,
                        'fecha' => date('Y-m-d H:i:s'),
                        'status' => $status,
                        'email' => $formData['correo'],
                        'id_cliente' => $idUsuario,
                        'total' => $totalCompra,
                        'dni' => $formData['dni'],
                        'nombre' => $formData['nombre'],
                        'apellido' => $formData['apellido'],
                        'telefono' => $formData['telefono'],
                        'departamento' => $formData['departamento'],
                        'provincia' => $formData['provincia'],
                        'distrito' => $formData['distrito'],
                        'direccion' => $formData['direccion'],
                        'numero' => $formData['numero'],
                        'descuento' => $descuento,
                        'ubicacion_recojo' => $formData['ubicacion_recojo'] ?? 'Calle Juana Manrique de Luna 168 - San Miguel',
                        'fecha_recojo' => $formData['fecha_recojo'],
                        'hora_recojo' => $formData['hora_recojo'],
                        'nombre_recojo' => $formData['nombre_recojo'],
                        'tipo_entrega' => $formData['tipo_entrega'],
                    ];

                    // Insertar la nueva compra en la base de datos
                    $idCompra = $comprasModel->insert($datosCompra);

                    // Verificar si la inserción fue exitosa
                    if ($idCompra) {
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
                }
            }

            // Obtener la compra por su ID
            $compra = $comprasModel->find($idCompra);

            // Obtener los detalles de la compra
            $compraDetalles = $comprasModel
                ->select('compras.*, dc.*')
                ->join('detalle_compra dc', 'dc.id_compra = compras.id')
                ->where('compras.id', $idCompra)
                ->findAll();

            // Verificar si hay detalles de compra
            if (empty($compraDetalles)) {
                // Redirigir al usuario a la página de compras
                return redirect()->to(base_url('shop'));
            }

            // Configurar y enviar el correo electrónico
            $email = \Config\Services::email();
            $mensaje = '<html><body>';
            $mensaje .= '<h2>Detalles de tu compra</h2>';
            $mensaje .= '<p>Gracias por tu compra. Aquí están los detalles:</p>';
            $mensaje .= '<table border="1">';
            $mensaje .= '<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total por Producto</th></tr>';

            // Calcular y mostrar detalles de cada producto comprado
            $totalCompra = 0;
            foreach ($compraDetalles as $detalle) {
                $precioTotalProducto = $detalle['precio'] * $detalle['cantidad'];
                $totalCompra += $precioTotalProducto;

                $mensaje .= '<tr>';
                $mensaje .= '<td>' . $detalle['nombre'] . '</td>';
                $mensaje .= '<td>' . $detalle['cantidad'] . '</td>';
                $mensaje .= '<td>' . $detalle['precio'] . '</td>';
                $mensaje .= '<td>' . $precioTotalProducto . '</td>';
                $mensaje .= '</tr>';
            }

            // Mostrar descuento aplicado si existe
            if ($descuento > 0) {
                $descuentoAplicado = $totalCompra * ($descuento / 100);
                $totalCompra -= $descuentoAplicado;

                $mensaje .= '<tr>';
                $mensaje .= '<td colspan="3">Descuento</td>';
                $mensaje .= '<td>' . 'S/ ' . number_format($descuentoAplicado, 2) . '</td>';
                $mensaje .= '</tr>';
            }

            // Mostrar el total de la compra
            $mensaje .= '<tr>';
            $mensaje .= '<td colspan="3"><strong>Total:</strong></td>';
            $mensaje .= '<td>' . 'S/ ' . number_format($totalCompra + $costoEnvio, 2) . '</td>';
            $mensaje .= '</tr>';

            $mensaje .= '</table>';
            $mensaje .= '</body></html>';

            // Configurar y enviar el correo electrónico
            $email->setTo($formData['correo']);
            $email->setFrom('sigasoporte1@gmail.com', 'Corporación Siga S.A.C');
            $email->setSubject('Detalles de tu compra');
            $email->setMessage($mensaje);
            $email->setMailType('html');

            // Enviar el correo electrónico y manejar el resultado
            if ($email->send()) {
                // Correo electrónico enviado exitosamente
            } else {
                // Error al enviar el correo electrónico
            }

            // Obtener configuraciones adicionales
            $configTienda = $this->configModel->obtenerConfiguracion();
            $categoriasFooter = $this->categoriaModel->findAll();

            // Confirmar la transacción de base de datos y limpiar datos de sesión
            $this->db->transCommit();
            session()->remove('carrito');
            session()->remove('descuento');
            session()->remove('formData');

            // Preparar datos para la vista de compra exitosa
            $data = [
                'paymentId' => $paymentId,
                'status' => $status,
                'paymentType' => $paymentType,
                'merchantOrderId' => $merchantOrderId,
                'compra' => $compra,
                'compraDetalles' => $compraDetalles,
                'configTienda' => $configTienda,
                'categoriasFooter' =>  $categoriasFooter
            ];

            // Cargar la vista de compra exitosa con los datos preparados
            return view('tienda/compraexitosa', $data);
        } catch (\Exception  $e) {
            // Manejar cualquier excepción y redirigir al usuario a la página de compras
            return redirect()->to(base_url('shop'));
        }
    }


    public function guardarCompra()
    {
        $this->db->transBegin();

        $costoEnvio = $this->request->getPost('costo-envio') ?? 0;

        $comprasModel = new \App\Models\ComprasModel();

        $sessionData = session()->get();
        $idUsuario = $sessionData['id_usuario'];
        $descuento = session()->get('descuento');
        /* $usuarioAutenticado = session()->get('usuarioAutenticado'); */

        $dni = $this->request->getPost('dni');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $correo = $this->request->getPost('correo');
        $telefono = $this->request->getPost('telefono');
        $departamento = $this->request->getPost('departamento');
        $provincia = $this->request->getPost('provincia');
        $distrito = $this->request->getPost('distrito');
        $direccion = $this->request->getPost('direccion');
        $numero = $this->request->getPost('numero');


        $ubicacionRecojo = $this->request->getPost('ubicacion_recojo') ?? 'Calle Juana Manrique de Luna 168 - San Miguel';
        $fechaRecojo = $this->request->getPost('fecha_recojo') ?? '';
        $horaRecojo = $this->request->getPost('hora_recojo') ?? '';
        $nombreRecojo = $this->request->getPost('nombre_recojo') ?? '';
        $tipoEntrega = $this->request->getPost('tipo_entrega') ?? '';


        /* print_r($_POST); */


        $carritoJSON = $this->request->getPost('carrito');

        // Recuperar la imagen adjunta
        $imagenVoucher = $this->request->getFile('imagenVoucher');

        $carrito = json_decode($carritoJSON, true);

        $total = 0;
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }

        if ($descuento > 0) {
            $descuentoAplicado = $total * ($descuento / 100);
            $total -= $descuentoAplicado;
        }


        /* $total += $costoEnvio; */
        $idTransaccion = 'P' . uniqid();

        $rutaImagenVoucher = '';
        if ($imagenVoucher->isValid() && !$imagenVoucher->hasMoved()) {
            // Genera un nombre único para la imagen
            $nombreImagen = $imagenVoucher->getRandomName();
            // Ruta donde se guardará la imagen
            $rutaImagenVoucher = ROOTPATH . 'public/assets/tienda/vouchers/' . $nombreImagen;
            // Mueve la imagen al directorio de destino
            $imagenVoucher->move(ROOTPATH . 'public/assets/tienda/vouchers', $nombreImagen);
        }

        $dataCompra = [
            'id_transaccion' => $idTransaccion,
            'fecha' => date('Y-m-d H:i:s'),
            'status' => 'Pendiente',
            'status_compra' => 2,
            'email' => $correo,
            'id_cliente' => $idUsuario,
            'total' => $total,
            'dni' => $dni,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono,
            'departamento' => $departamento,
            'provincia' => $provincia,
            'distrito' => $distrito,
            'direccion' => $direccion,
            'numero' => $numero,
            'voucher_img' => $nombreImagen,
            'descuento' => $descuento,
            'ubicacion_recojo' => $ubicacionRecojo,
            'fecha_recojo' => $fechaRecojo,
            'hora_recojo' => $horaRecojo,
            'nombre_recojo' => $nombreRecojo,
            'costo_envio' => $costoEnvio,
            'tipo_entrega' => $tipoEntrega

        ];




        $idCompra = $comprasModel->insert($dataCompra);

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

            $compra = $comprasModel->find($idCompra);

            // Obtener los detalles de la compra
            $compraDetalles = $comprasModel
                ->select('compras.*, dc.*')
                ->join('detalle_compra dc', 'dc.id_compra = compras.id')
                ->where('compras.id', $idCompra)
                ->findAll();





            foreach ($carrito as $producto) {
                // Obtener el ID y la cantidad del producto
                $idProducto = $producto['id'];
                $cantidadComprada = $producto['cantidad'];

                // Obtener el modelo del producto
                $productoModel = new \App\Models\ProductoModel();

                // Obtener el producto de la base de datos
                $productoDB = $productoModel->find($idProducto);

                // Verificar si se encontró el producto en la base de datos
                if ($productoDB) {
                    // Obtener el stock actual del producto
                    $stockActual = $productoDB['stock'];

                    // Calcular el nuevo stock
                    $nuevoStock = $stockActual - $cantidadComprada;

                    // Actualizar el stock del producto en la base de datos
                    $data = [
                        'stock' => $nuevoStock
                    ];
                    $productoModel->update($idProducto, $data);
                }
            }


            //correo


            $email = \Config\Services::email();

            $mensaje = '<html><body>';
            $mensaje .= '<h2>Detalles de tu compra</h2>';
            $mensaje .= '<p>Gracias por tu compra. Aquí están los detalles:</p>';
            $mensaje .= '<table border="1">';
            $mensaje .= '<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total por Producto</th></tr>';
            foreach ($compraDetalles as $detalle) {
                $precioTotalProducto = $detalle['precio'] * $detalle['cantidad']; // Calcula el precio total del producto
                // Mostrar fila con detalles del producto
                $mensaje .= '<tr>';
                $mensaje .= '<td>' . $detalle['nombre'] . '</td>';
                $mensaje .= '<td>' . $detalle['cantidad'] . '</td>';
                $mensaje .= '<td>' . 'S/ ' . number_format($detalle['precio'], 2) . '</td>';
                $mensaje .= '<td>' . 'S/ ' . number_format($precioTotalProducto, 2) . '</td>'; // Mostrar el precio total del producto
                $mensaje .= '</tr>';
            }
            // Mostrar el costo de envío
            $mensaje .= '<tr>';
            $mensaje .= '<td colspan="3">Costo de envío</td>';
            $mensaje .= '<td>' . 'S/ ' . number_format($costoEnvio, 2) . '</td>';
            $mensaje .= '</tr>';

            // Aplicar descuento si es mayor que 0
            if ($descuento > 0) {
                $mensaje .= '<tr>';
                $mensaje .= '<td colspan="3">Descuento</td>';
                $mensaje .= '<td>' . 'S/ ' . number_format($descuentoAplicado, 2) . '</td>';
                $mensaje .= '</tr>';
            }
            // Mostrar el total
            $mensaje .= '<tr>';
            $mensaje .= '<td colspan="3"><strong>Total:</strong></td>';
            $mensaje .= '<td>' . 'S/ ' . number_format($total + $costoEnvio, 2) . '</td>';
            $mensaje .= '</tr>';

            $mensaje .= '</table>';
            $mensaje .= '</body></html>';

            $email->setTo($correo);
            $email->setFrom('sigasoporte1@gmail.com', 'Corporación Siga S.A.C');
            $email->setSubject('Detalles de tu compra');
            $email->setMessage($mensaje);
            $email->setMailType('html');
            if ($email->send()) {
                // Correo electrónico enviado exitosamente
                $response = ['success' => true, 'message' => 'Correo electrónico enviado exitosamente'];
            } else {
                // Error al enviar el correo electrónico
                $response = ['success' => false, 'message' => 'Error al enviar el correo electrónico'];
            }


            $configTienda = $this->configModel->obtenerConfiguracion();
            $categoriasFooter = $this->categoriaModel->findAll();

            $this->db->transCommit();
            $datosCompra = [
                'paymentId' => $idTransaccion,
                'status' => 'pendiente',
                'compra' => $compra,
                'compraDetalles' => $compraDetalles,
                'configTienda' => $configTienda,
                'categoriasFooter' =>  $categoriasFooter,
                'costoEnvio' => $costoEnvio,
            ];


            /*  echo "<pre>";
            print_r($datosCompra); */

            session()->set('datosCompra', $datosCompra);

            session()->remove('carrito');
            session()->remove('descuento');
            session()->remove('formData');

            // Redirigir a la página de confirmación
            return $this->response->setStatusCode(200)->setJSON(['success' => true, 'redirect_url' => base_url('checkout/confirmation')]);
        }
    }






    public function confirmation()
    {
        if (session()->has('usuario_autenticado')) {
            $userData = session()->get();
        } else {

            $userData = [];
        }

        // Recuperar los datos de la compra de la sesión
        $datosCompra = session()->get('datosCompra');
        $configTienda = $this->configModel->obtenerConfiguracion();
        $categoriasFooter = $this->categoriaModel->findAll();

        // Verificar si los datos están disponibles
        if ($datosCompra) {
            // Pasar los datos a la vista de confirmación
            return view('tienda/confirmation', [
                'userData' => $userData,
                'datosCompra' => $datosCompra,
                'configTienda' => $configTienda,
                'categoriasFooter' =>  $categoriasFooter
            ]);
        } else {
            // Si los datos no están disponibles, redirigir a alguna página de error o manejarlo según sea necesario
            return redirect()->to(base_url('ruta/de/error'));
        }
    }




    public function guardarCotizacion123()
    {

        $sessionData = session()->get();
        $idUsuario = $sessionData['id_usuario'];
        // Cargar el modelo CotizacionModel


        $cotizacionModel = new CotizacionModel();
        $cotizacionDetalleModel  = new CotizacionDetalleModel();

        $dni = $this->request->getPost('dni');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $correo = $this->request->getPost('correo');
        $telefono = $this->request->getPost('telefono');
        $departamento = $this->request->getPost('departamento');
        $provincia = $this->request->getPost('provincia');
        $distrito = $this->request->getPost('distrito');
        $direccion = $this->request->getPost('direccion');
        $numero = $this->request->getPost('numero');

        $carritoJSON = $this->request->getPost('carrito');
        $descuento = session()->get('descuento');


        $idTransaccion = 'C' . uniqid();

        // Obtener los datos enviados mediante POST


        $carritoJSON = $this->request->getPost('carrito');
        $carrito = json_decode($carritoJSON, true);

        $total = 0;
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }



        // Aplicar descuento si es mayor que cero
        if ($descuento > 0) {
            $descuentoAplicado = $total * ($descuento / 100);
            $total -= $descuentoAplicado;
        }



        $datosCotizacion['total'] = $total;



        $datosCotizacion = [
            'id_transaccion' => $idTransaccion,
            'total' => $total,
            'dni' => $dni,
            'status' => 'COMPLETADO',
            'nombre' => $nombre,
            'apellido' =>  $apellido,
            'email' =>  $correo,
            'id_cliente' => $idUsuario,
            'telefono' =>  $telefono,
            'departamento' => $departamento,
            'provincia' => $provincia,
            'distrito' => $distrito,
            'direccion' => $direccion,
            'numero' => $numero,
            'descuento' =>  $descuento,
        ];


        $insertado = $cotizacionModel->insert($datosCotizacion);

        if ($insertado) {
            // Iterar sobre los productos del carrito y guardarlos como detalles de cotización
            foreach ($carrito as $producto) {
                $datosDetalleCoti = [
                    'id_cotizacion' => $insertado,
                    'id_producto' => $producto['id'],
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => $producto['cantidad']
                ];
                $cotizacionDetalleModel->insertarDetalleCoti($datosDetalleCoti);
            }
            $cotizacion = $cotizacionModel->find($insertado);



            $cotiDetalles = $cotizacionDetalleModel
                ->where('id_cotizacion', $insertado)
                ->findAll();

            $cotizacion['compraDetalles'] = $cotiDetalles;


            $cotizacionExitosa = [
                'paymentId' => $idTransaccion,
                'status' => 'pendiente',
                'cotizacion' => $cotizacion,

            ];
            session()->set('cotizacionExitosa', $cotizacionExitosa);



            $detallesProductos = [];
            foreach ($carrito as $producto) {
                $detallesProductos[] = [
                    'id_producto' => $producto['id'],
                    'producto_impuesto' => 18,
                    'precio' => $producto['precio'],
                    'precio_venta' => $producto['precio'],
                    'unidad_medida' => '1',
                    'cantidad' => $producto['cantidad'],
                    'cantidad_parcial' => $producto['cantidad'],
                    'detalle_importe' => $producto['precio'] * $producto['cantidad'],
                    'p_gratis' => 0,
                    'descuento' => 0
                ];
            }

            $dataAPI = [
                'fecha_venta' => date('d/m/Y'),
                'fecha_entrega' => date('d/m/Y'),
                'local_venta_id' => '1',
                'cliente_id' => '1',
                'vendedor_id' => '1',
                'tipo_documento' => '6',
                'tipo_impuesto' => '1',
                'tipo_pago' => '1',
                'moneda_id' => '1029',
                'impuesto' => 0.31,
                'subtotal' => $total - (0.31 * $total),
                'total_importe' => $total,
                'tasa' => '0.00',
                'c_pago_periodo' => '4',
                'periodo_per' => '30',
                'lugar_entrega' => '',
                'cotizacion_nota' => 'enviado desde tienda virtual',
                'detalles_productos' => json_encode($detallesProductos)
            ];


            // Enviar datos a la API
            $ch = curl_init('https://develop.siga.com.pe/api/cotizaciones/savecotizar');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataAPI);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'x-api-key: 1OQFd2zAopdlkDow2PIutVn0ImD7Dtw9edmT1o7S',
                'Content-Type: multipart/form-data'
            ]);
            $response = curl_exec($ch);
            curl_close($ch);

            if ($response === false) {
                return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error al enviar los datos a la API']);
            }

            return $this->response->setStatusCode(200)->setJSON(['success' => true, 'redirect_url' => base_url('checkout/cotizacionexitosa')]);
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al guardar la cotización'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }


    public function guardarCotizacion()
    {




        $sessionData = session()->get();
        $idUsuario = $sessionData['id_usuario'];
        // Cargar el modelo CotizacionModel



        $cotizacionModel = new CotizacionModel();
        $cotizacionDetalleModel  = new CotizacionDetalleModel();

        $dni = $this->request->getPost('dni');
        $nombre = $this->request->getPost('nombre');
        $apellido = $this->request->getPost('apellido');
        $correo = $this->request->getPost('correo');
        $telefono = $this->request->getPost('telefono');
        $departamento = $this->request->getPost('departamento');
        $provincia = $this->request->getPost('provincia');
        $distrito = $this->request->getPost('distrito');
        $direccion = $this->request->getPost('direccion');
        $numero = $this->request->getPost('numero');

        $carritoJSON = $this->request->getPost('carrito');
        $descuento = session()->get('descuento');


        $idTransaccion = 'C' . uniqid();

        // Obtener los datos enviados mediante POST


        $carritoJSON = $this->request->getPost('carrito');
        $carrito = json_decode($carritoJSON, true);


        $total = 0;
        foreach ($carrito as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }



        // Aplicar descuento si es mayor que cero
        if ($descuento > 0) {
            $descuentoAplicado = $total * ($descuento / 100);
            $total -= $descuentoAplicado;
        }

        $impuesto = $total * 0.18 / 1.18;
        $subtotal = $total - $impuesto;


        $datosCotizacion['total'] = $total;



        $datosCotizacion = [
            'id_transaccion' => $idTransaccion,
            'total' => $total,
            'dni' => $dni,
            'status' => 'COMPLETADO',
            'nombre' => $nombre,
            'apellido' =>  $apellido,
            'email' =>  $correo,
            'id_cliente' => $idUsuario,
            'telefono' =>  $telefono,
            'departamento' => $departamento,
            'provincia' => $provincia,
            'distrito' => $distrito,
            'direccion' => $direccion,
            'numero' => $numero,
            'descuento' =>  $descuento,
        ];




        $insertado = $cotizacionModel->insert($datosCotizacion);

        if ($insertado) {
            // Iterar sobre los productos del carrito y guardarlos como detalles de cotización
            foreach ($carrito as $producto) {
                $datosDetalleCoti = [
                    'id_cotizacion' => $insertado,
                    'id_producto' => $producto['id'],
                    'nombre' => $producto['nombre'],
                    'precio' => $producto['precio'],
                    'cantidad' => $producto['cantidad']
                ];
                $cotizacionDetalleModel->insertarDetalleCoti($datosDetalleCoti);
            }
            $cotizacion = $cotizacionModel->find($insertado);



            $cotiDetalles = $cotizacionDetalleModel
                ->where('id_cotizacion', $insertado)
                ->findAll();

            $cotizacion['compraDetalles'] = $cotiDetalles;


            $cotizacionExitosa = [
                'paymentId' => $idTransaccion,
                'status' => 'pendiente',
                'cotizacion' => $cotizacion,

            ];
            session()->set('cotizacionExitosa', $cotizacionExitosa);



            /* $detallesProductos = [];
            foreach ($carrito as $producto) {
                $detallesProductos[] = [
                    'id_producto' => $producto['id_sistema'] !== null ? $producto['id_sistema'] : $producto['id'],
                    'producto_impuesto' => 18,
                    'precio' => $producto['precio'],
                    'precio_venta' => $producto['precio'],
                    'unidad_medida' => '1',
                    'cantidad' => $producto['cantidad'],
                    'cantidad_parcial' => $producto['cantidad'],
                    'detalle_importe' => $producto['precio'] * $producto['cantidad'],
                    'p_gratis' => 0,
                    'descuento' => 0
                ];
            }

            $dataAPI = [
                'fecha_venta' => date('d/m/Y'),
                'fecha_entrega' => date('d/m/Y'),
                'local_venta_id' => '1',
                'cliente_id' => '1',
                'vendedor_id' => '1',
                'tipo_documento' => '6',
                'tipo_impuesto' => '1',
                'tipo_pago' => '1',
                'moneda_id' => '1029',
                'impuesto' => $impuesto,
                'subtotal' => $subtotal,
                'total_importe' => $total,
                'tasa' => '0.00',
                'c_pago_periodo' => '4',
                'periodo_per' => '30',
                'lugar_entrega' => '',
                'cotizacion_nota' => 'enviado desde tienda virtual',
                'detalles_productos' => json_encode($detallesProductos)
            ];


            // Enviar datos a la API
            $ch = curl_init('https://develop.siga.com.pe/api/cotizaciones/savecotizar');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataAPI);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'x-api-key: 1OQFd2zAopdlkDow2PIutVn0ImD7Dtw9edmT1o7S',
                'Content-Type: multipart/form-data'
            ]);
            $response = curl_exec($ch);
            curl_close($ch);

            if ($response === false) {
                return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error al enviar los datos a la API']);
            } */

            return $this->response->setStatusCode(200)->setJSON(['success' => true, 'redirect_url' => base_url('checkout/cotizacionexitosa')]);
        } else {
            $response = [
                'success' => false,
                'message' => 'Error al guardar la cotización'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    public function cotizacionexitosa()
    {
        if (session()->has('usuario_autenticado')) {
            $userData = session()->get();
        } else {

            $userData = [];
        }

        // Recuperar los datos de la compra de la sesión
        $cotizacionExitosa = session()->get('cotizacionExitosa');
        $configTienda = $this->configModel->obtenerConfiguracion();
        $categoriasFooter = $this->categoriaModel->findAll();

        // Verificar si los datos están disponibles
        if ($cotizacionExitosa) {
            // Pasar los datos a la vista de confirmación
            return view('tienda/cotizacionexitosa', [
                'userData' => $userData,
                'cotizacionExitosa' => $cotizacionExitosa,
                'configTienda' => $configTienda,
                'categoriasFooter' =>  $categoriasFooter
            ]);
        } else {
            return redirect()->to(base_url('ruta/de/error'));
        }
    }

    public function enviarCotizacionAPI()
    {
        // Obtener el ID de la cotización de los datos POST
        $cotizacionId = $this->request->getPost('cotizacion_id');

        // Obtener los detalles de la cotización
        $cotizacionDetalleModel = new CotizacionDetalleModel();
        $cotizacionDetalles = $cotizacionDetalleModel->where('id_cotizacion', $cotizacionId)->findAll();

        // Calcular el total sumando el precio de cada producto
        $total = 0;
        foreach ($cotizacionDetalles as $detalle) {
            $total += $detalle['precio'] * $detalle['cantidad'];
        }

        // Aplicar descuento si es mayor que cero
        $descuento = session()->get('descuento');
        if ($descuento > 0) {
            $descuentoAplicado = $total * ($descuento / 100);
            $total -= $descuentoAplicado;
        }

        // Calcular el impuesto y el subtotal
        $impuesto = round($total * 0.18 / 1.18, 2);
        $subtotal = round($total - $impuesto, 2);

        // Construir el array $detallesProductos
        $detallesProductos = [];
        foreach ($cotizacionDetalles as $detalle) {
            $productoModel = new ProductoModel();
            $producto = $productoModel->find($detalle['id_producto']);
            $idProducto = isset($producto['id_sistema']) ? $producto['id_sistema'] : $detalle['id_producto'];


            $detallesProductos[] = [
                'id_producto' => $idProducto,
                'producto_impuesto' => 18,
                'precio' => $detalle['precio'],
                'precio_venta' => $detalle['precio'],
                'unidad_medida' => '1',
                'cantidad' => $detalle['cantidad'],
                'cantidad_parcial' => $detalle['cantidad'],
                'detalle_importe' => $detalle['precio'] * $detalle['cantidad'],
                'p_gratis' => 0,
                'descuento' => 0
            ];
        }

        // Construir el array $dataAPI
        $dataAPI = [
            'fecha_venta' => date('d/m/Y'),
            'fecha_entrega' => date('d/m/Y'),
            'local_venta_id' => '1',
            'cliente_id' => '1',
            'vendedor_id' => '1',
            'tipo_documento' => '6',
            'tipo_impuesto' => '1',
            'tipo_pago' => '1',
            'moneda_id' => '1029',
            'impuesto' => $impuesto,
            'subtotal' => $subtotal,
            'total_importe' => $total,
            'tasa' => '0.00',
            'c_pago_periodo' => '4',
            'periodo_per' => '',
            'lugar_entrega' => '',
            'cotizacion_nota' => 'enviado desde tienda virtual',
            'detalles_productos' => json_encode($detallesProductos)
        ];



        // Ahora puedes usar $dataAPI donde lo necesites, como enviarlo a la API

        $ch = curl_init('https://develop.siga.com.pe/api/cotizaciones/savecotizar');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataAPI);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-api-key: 1OQFd2zAopdlkDow2PIutVn0ImD7Dtw9edmT1o7S',
            'Content-Type: multipart/form-data'
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response, true); // Convertir la respuesta JSON en un 
        if (isset($responseData['error'])) {
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'message' => 'Error en la respuesta de la API: ' . $responseData['error']]);
        } else {
            return $this->response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'Datos enviados correctamente a la API']);
        }
    }










    public function generarPDF()
    {
        $cotizacionExitosaData = $this->request->getGet('cotizacionExitosaData');
        $cotizacionExitosa = json_decode($cotizacionExitosaData, true);
        $configTienda = $this->configModel->obtenerConfiguracion();
        $categoriasFooter = $this->categoriaModel->findAll();

        // Cargar la vista en una variable
        $data = view('tienda/cotizacion_pdf', [
            'cotizacionExitosa' => $cotizacionExitosa,
            'configTienda' => $configTienda,
            'categoriasFooter' =>  $categoriasFooter
        ]);

        $html = $data;

        $mpdf = new Mpdf();

        // Generar el PDF
        $mpdf->WriteHTML($html);


        $nombreArchivo = 'cotizacion_' . $cotizacionExitosa['cotizacion']['id'] . '.pdf';

        $mpdf->Output($nombreArchivo, 'D');
    }
}
