<?php
namespace App\Models;

use CodeIgniter\Model;

class BannertiendaresponsiveModel extends Model
{
    protected $table      = 'bannerresponsive'; // Nombre de la tabla
    protected $primaryKey = 'id';     // Clave primaria de la tabla
    protected $allowedFields = ['imagenbanner', 'estado' , 'id_categorias'];
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

    public function obtenerBannersTiendaResponsive()
    {
        return $this->findAll();
    }

    public function actualizarEstadoBanner($id, $estado)
    {
        $data = ['estado' => $estado];
        return $this->update($id, $data);
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
