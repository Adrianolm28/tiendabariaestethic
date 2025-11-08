<?php

namespace App\Controllers;

use App\Models\ContactoModel;
use App\Models\RespaldoModel; // Asegúrate de que este modelo exista si lo usas en la vista
use App\Models\EmpresaModel; 
use CodeIgniter\Controller;
use Config\Services; // Para el servicio de email
use Throwable; // Importante para el bloque catch

class ContactoController extends Controller 
{
    public function index()
    {
        $data = [];
        // Cargar datos necesarios para la vista, por ejemplo, los logos de respaldo
        if (class_exists(\App\Models\RespaldoModel::class)) {
            $respaldoModel = new RespaldoModel();
            $data['respaldo'] = $respaldoModel->findAll();
        } else {
            $data['respaldo'] = []; // Proporciona un array vacío si el modelo no existe
        }

        // Cargar datos de la empresa --- AÑADE ESTAS LÍNEAS ---
        if (class_exists(\App\Models\EmpresaModel::class)) {
            $empresaModel = new EmpresaModel();
            // Suponiendo que solo hay una fila de datos de empresa o quieres la primera.
            // Ajusta esto según cómo almacenes y quieras recuperar los datos de la empresa.
            $data['datosEmpresa'] = $empresaModel->findAll(); // O $empresaModel->first(); si solo es una fila
        } else {
            $data['datosEmpresa'] = []; // Proporciona un array vacío si el modelo no existe o no hay datos
        }
        // --- FIN DE LÍNEAS AÑADIDAS ---

        return view('contacto', $data);
    }

    public function enviarCorreo()
    {
        try {
            // Helper para la validación
            $validation = Services::validation();

            // Definir reglas de validación
            $rules = [
                'tipo_documento'   => 'required',
                'numero_documento' => 'required|min_length[8]',
                'nombres'          => 'required|min_length[3]',
                'email'            => 'required|valid_email',
                'telefono'         => 'permit_empty|min_length[7]',
                'descripcion'      => 'required|min_length[10]',
            ];

            // Definir mensajes de error personalizados (opcional)
            $messages = [
                'numero_documento' => [
                    'required'   => 'El número de documento es obligatorio.',
                    'min_length' => 'El número de documento debe tener al menos 8 caracteres.'
                ],
                'nombres' => [
                    'required'   => 'El nombre es obligatorio.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.'
                ],
                'email' => [
                    'required'    => 'El correo electrónico es obligatorio.',
                    'valid_email' => 'Por favor, introduce un correo electrónico válido.'
                ],
                'descripcion' => [
                    'required'   => 'La descripción es obligatoria.',
                    'min_length' => 'La descripción debe tener al menos 10 caracteres.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                // Si la validación falla, devolver errores en JSON
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Error de validación.',
                    'errors'  => $validation->getErrors()
                ]);
            }

            // Si la validación es exitosa, procesar los datos
            $tipo_documento   = $this->request->getPost('tipo_documento');
            $numero_documento = $this->request->getPost('numero_documento');
            $nombres          = $this->request->getPost('nombres');
            $email_cliente    = $this->request->getPost('email');
            $telefono         = $this->request->getPost('telefono');
            $descripcion      = $this->request->getPost('descripcion');

            // Guardado en Base de Datos
            $contactoModel = new ContactoModel();
            $dataToSave = [
                'tipo_documento'   => $tipo_documento,
                'numero_documento' => $numero_documento,
                'nombres'          => $nombres,
                'email'            => $email_cliente,
                'telefono'         => $telefono,
                'descripcion'      => $descripcion,
                'created_at'       => date('Y-m-d H:i:s')
            ];
            
            if (!$contactoModel->save($dataToSave)) {
                $dbErrors = $contactoModel->errors();
                log_message('error', 'Error al guardar los datos del contacto en la base de datos. Detalles: ' . json_encode($dbErrors));
                // Considera devolver un error si el guardado es crítico
            }

            // Lógica para enviar el correo electrónico
            $emailService = Services::email();

            // Configuración del correo para el administrador
            $emailService->setFrom('sigasoporte1@gmail.com', 'Contacto Web Tegnex');
            $emailService->setTo('soportetegnex@tegnex.pe'); 
            $emailService->setReplyTo($email_cliente, $nombres);
            $emailService->setSubject('Nueva consulta de contacto desde la web - Tegnex');
            
            $mensajeEmailAdmin = "<h1>Nueva consulta de contacto</h1>";
            $mensajeEmailAdmin .= "<p><strong>Tipo de Documento:</strong> " . esc($tipo_documento) . "</p>";
            $mensajeEmailAdmin .= "<p><strong>Número de Documento:</strong> " . esc($numero_documento) . "</p>";
            $mensajeEmailAdmin .= "<p><strong>Nombres:</strong> " . esc($nombres) . "</p>";
            $mensajeEmailAdmin .= "<p><strong>Email del Cliente:</strong> " . esc($email_cliente) . "</p>";
            $mensajeEmailAdmin .= "<p><strong>Teléfono:</strong> " . esc($telefono) . "</p>";
            $mensajeEmailAdmin .= "<p><strong>Descripción:</strong><br>" . nl2br(esc($descripcion)) . "</p>";
            
            $emailService->setMessage($mensajeEmailAdmin);
            $emailService->setMailType('html'); 

            if ($emailService->send(false)) { 
                // Correo enviado exitosamente al administrador
                // Ahora, enviar correo de confirmación al cliente

                $emailService->clear(); // Limpiar destinatarios, asunto, mensaje, etc. para el nuevo correo.

                $emailService->setFrom('sigasoporte1@gmail.com', 'Soporte Tegnex'); // Remitente para el cliente
                $emailService->setTo($email_cliente); // Destinatario: el cliente
                $emailService->setSubject('Hemos recibido tu consulta - Tegnex');

                $mensajeCliente = "<p>Hola " . esc($nombres) . ",</p>";
                $mensajeCliente .= "<p>Gracias por ponerte en contacto con Tegnex. Hemos recibido tu consulta y te responderemos a la brevedad posible.</p>";
                $mensajeCliente .= "<p><strong>Resumen de tu mensaje:</strong></p>";
                $mensajeCliente .= "<blockquote>" . nl2br(esc($descripcion)) . "</blockquote>";
                $mensajeCliente .= "<p>Si tienes alguna pregunta adicional mientras tanto, no dudes en contactarnos.</p>";
                $mensajeCliente .= "<p>Saludos cordiales,<br>El equipo de Tegnex</p>";

                $emailService->setMessage($mensajeCliente);
                $emailService->setMailType('html');

                if (!$emailService->send(false)) {
                    // Opcional: Loguear error si el correo de confirmación al cliente falla
                    log_message('error', "Error al enviar email de confirmación al cliente: " . $email_cliente . " - " . $emailService->printDebugger(['headers']));
                }

                return $this->response->setJSON([
                    'status'  => 'success',
                    'message' => '¡Tu mensaje ha sido enviado correctamente! Nos pondremos en contacto contigo pronto. También hemos enviado una confirmación a tu correo electrónico.'
                ]);
            } else {
                // Loguear el error del email para depuración
                $debug = $emailService->printDebugger(['headers', 'subject', 'body']);
                log_message('error', "Error al enviar email: " . $debug);
                return $this->response->setJSON([
                    'status'  => 'error',
                    'message' => 'No se pudo enviar el correo en este momento. Por favor, inténtalo más tarde o contáctanos directamente.'
                    // 'debug_info' => $debug // No enviar esto al cliente en producción
                ]);
            }

        } catch (Throwable $e) { // Captura cualquier error o excepción
            log_message('error', "[ERROR FATAL] ContactoController::enviarCorreo: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Ocurrió un error inesperado en el servidor al procesar tu solicitud.'
            ])->setStatusCode(500); // Es bueno también setear el código de estado HTTP
        }
    }
}
