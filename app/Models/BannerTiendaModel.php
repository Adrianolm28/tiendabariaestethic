<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerTiendaModel extends Model
{
    protected $table = 'bannertienda';
    protected $primaryKey = 'id';
    protected $allowedFields = ['imagenbanner','orden', 'id_categorias','id_producto' ,'estado' ];
    protected $useTimestamps = true;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_modificacion';

/*     public function insertarBanner($imagenbanner, $orden , $id_categorias ,$id_producto , $estado = 1)
    {
        $data = [
            'imagenbanner' => $imagenbanner,
            'orden' => $orden,
           'id_categorias' =>$id_categorias,
           'id_producto' =>$id_producto, 
            'estado' => $estado
        ];
        return $this->insert($data);
    }
 */

 public function insert_data($data)
 {
     $result = $this->insert($data);
     if ($result) {
         return $this->insertID();
     } else {
         return false;
     }
 }
    public function obtenerBanners()
    {
        return $this->findAll();
    }

    public function actualizarEstadoBanner($id, $estado)
    {
        $data = ['estado' => $estado];
        return $this->update($id, $data);
    }

   

    
}