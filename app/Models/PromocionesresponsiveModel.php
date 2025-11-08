<?php
namespace App\Models;

use CodeIgniter\Model;

class PromocionesresponsiveModel extends Model
{
    protected $table      = 'promocionesresponsive'; // Nombre de la tabla
    protected $primaryKey = 'id';     // Clave primaria de la tabla
    protected $allowedFields = ['imagenbanner', 'estado','id_categorias' ];
    protected $useTimestamps = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';

    public function insertarBanner($imagenbanner, $estado = 1)
    {
        $data = [
            'imagenbanner' => $imagenbanner,
            'estado' => $estado,
            'id_categorias' => $id_categorias
        ];
        return $this->insert($data);
    }

    public function obtenerBannersPromocionesResponsive()
    {
        return $this->findAll();
    }

    public function actualizarEstadoBanner($id, $estado)
    {
        $bannertiendaModel = new PromocionesresponsiveModel();
        $data = ['estado' => $nuevoEstado];

        if ($bannertiendaModel->update($id, $data)) {
            $response = [
                'status' => true,
                'message' => 'El estado del servicio ha cambiado correctamente.',
                'new_status' => $nuevoEstado
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'No se pudo cambiar el estado del servicio',
            ];
        }

        return $this->response->setJSON($response);
    }

    public function insert_data($data)
    {
        $result = $this->insert($data);
        if ($result) {
            return $this->insertID();
        } else {
            return false;
        }
    }



}
