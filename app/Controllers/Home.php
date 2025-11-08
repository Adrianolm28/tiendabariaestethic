<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use App\Models\CarouselModel;
use App\Models\CategoriasModel;
use App\Models\ServiciosModel;
use App\Models\ClienteslogoModel;
use App\Models\ComprasModel;
use App\Models\RespaldoModel;
use App\Models\TestimoniosModel;
use App\Models\EmpresaModel;
use App\Models\EquipoModel;
use App\Models\PlanesModel;
use App\Models\SoporteModel;
use App\Models\InformacionModel;


class Home extends BaseController
{
    protected $bannerModel;
    protected $serviciosModel;
    protected $clienteslogoModel;
    protected $testimoniosModel;
    protected $respaldoModel;
    protected $empresaModel;
    protected $carouselModel;
    protected $soporteModel;
    protected $planModel;
    protected $informacionModel;
    protected $categorias;
    protected $equipoModel;
  

    public function __construct()
    {
        // Inicializa los modelos para su uso
        $this->bannerModel = new BannerModel();
        $this->serviciosModel = new ServiciosModel();
        $this->clienteslogoModel = new ClienteslogoModel();
        $this->testimoniosModel = new TestimoniosModel();
        $this->respaldoModel = new RespaldoModel();
        $this->empresaModel = new EmpresaModel();
        $this->carouselModel = new CarouselModel();
        $this->soporteModel = new SoporteModel();
        $this->planModel = new PlanesModel();
        $this->informacionModel = new InformacionModel();
        $this->categorias = new CategoriasModel();
        $this->equipoModel = new EquipoModel();

    }

    public function index()
    {
        // Obtiene los datos de los modelos y los pasa a la vista
        $data['banner'] = $this->getBanners();
        $data['servicios'] = $this->getServicios();
        $data['clienteslogo'] = $this->getClientesLogo();
        $data['testimonios'] = $this->getTestimonios();
        $data['respaldo'] = $this->getRespaldo();
        $data['datosEmpresa'] = $this->getEmpresa();
        $data['carousel'] = $this->getCarousel();
        $data['soporte'] = $this->getSoporte();
        $data['planes'] = $this->getPrecio();
        $data['informacion'] = $this->getInformacion();
        return view('index', $data); // Carga la vista 'index' con los datos
    }

    public function contacto()
    {
        $data['banner'] = $this->getBanners();
        $data['servicios'] = $this->getServicios();
        $data['clienteslogo'] = $this->getClientesLogo();
        $data['testimonios'] = $this->getTestimonios();
        $data['respaldo'] = $this->getRespaldo();
        $data['datosEmpresa'] = $this->getEmpresa();

        return view('contacto', $data);
    }

    public function blog()
    {
        $data['banner'] = $this->getBanners();
        $data['servicios'] = $this->getServicios();
        $data['clienteslogo'] = $this->getClientesLogo();
        $data['testimonios'] = $this->getTestimonios();
        $data['respaldo'] = $this->getRespaldo();
        $data['datosEmpresa'] = $this->getEmpresa();
        $data['categorias'] = $this->getCategorias();

        return view('blog', $data);
    }

    public function blog_detalle()
    {
        $data['banner'] = $this->getBanners();
        $data['servicios'] = $this->getServicios();
        $data['clienteslogo'] = $this->getClientesLogo();
        $data['testimonios'] = $this->getTestimonios();
        $data['respaldo'] = $this->getRespaldo();
        $data['datosEmpresa'] = $this->getEmpresa();
        $data['categorias'] = $this->getCategorias();

        return view('blog_detalle', $data);
    }

    public function equipo()
    {

        $data['equipo'] = $this->getEquipo();
        $data['respaldo'] = $this->getRespaldo();
        $data['datosEmpresa'] = $this->getEmpresa();
        return view('equipo', $data);
    }



    public function enviarCorreo()
    {
        // Dirección de correo de destino
        $to = 'sigasoporte1@gmail.com';

        // Asunto del correo
        $subject = 'Solicitud de Información';

        // Construir el mensaje en formato HTML
        $message = '<html><body>';
        $message .= '<h1>Solicitud de Información</h1>';
        $message .= '<p><strong>RUC:</strong> ' . $this->request->getPost('ruc') . '</p>';
        $message .= '<p><strong>Nombres:</strong> ' . $this->request->getPost('nombres') . '</p>';
        $message .= '<p><strong>E-mail:</strong> ' . $this->request->getPost('email') . '</p>';
        $message .= '<p><strong>Teléfono:</strong> ' . $this->request->getPost('telefono') . '</p>';
        $message .= '<p><strong>Descripción:</strong> ' . $this->request->getPost('descripcion') . '</p>';
        $message .= '</body></html>';

        // Configurar el correo
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('paolosolisgomez1@gmail.com');
        $email->setSubject($subject);
        $email->setMessage($message);
        $email->setMailType('html'); // Indicar que el mensaje es HTML

        // Enviar el correo
        if ($email->send()) {
            echo "Solicitud enviada con éxito. Nos pondremos en contacto contigo pronto.";
            return redirect()->to('/contacto');
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }

   

    // Método para obtener los banners desde el modelo
    protected function getBanners()
    {
        return $this->bannerModel->findAll(); // Devuelve los datos de los banners
    }

    // Método para obtener los servicios desde el model
    protected function getServicios()
    {
        return $this->serviciosModel->findAll(); // Devuelve los datos de los servicios
    }

    protected function getClientesLogo()
    {
        return $this->clienteslogoModel->findAll(); // Devuelve los datos de los servicios
    }

    protected function getTestimonios()
    {
        return $this->testimoniosModel->findAll(); // Devuelve los datos de los servicios
    }

    protected function getRespaldo()
    {
        return $this->respaldoModel->findAll(); // Devuelve los datos de los servicios
    }

    protected function getEmpresa()
    {
        return $this->empresaModel->findAll(); // Devuelve los datos de los servicios
    }

    protected function getCarousel()
    {
        return $this->carouselModel->findAll(); // Devuelve los datos de los servicios
    }

    protected function getSoporte()
    {
        return $this->soporteModel->findAll(); // Devuelve los datos de los servicios
    }

    protected function getPrecio()
    {
        return $this->planModel->findAll(); // Devuelve los datos de los servicios
    }

    protected function getInformacion()
    {
        return $this->informacionModel->findAll(); // Devuelve los datos de los servicios
    }

    protected function getCategorias()
    {
        return $this->categorias->findAll(); // Devuelve los datos de los servicios
    }

    protected function getEquipo()
    {
        return $this->equipoModel->findAll(); // Devuelve los datos de los servicios
    }
}
