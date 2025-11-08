<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{


    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';
    /* protected $allowedFields = ['nombre', 'correo', 'celular', 'clave', 'estado']; */
    /*  protected $allowedFields = ['nombre', 'correo', 'celular', 'documento_tipo', 'documento_numero', 'clave', 'estado']; */
    protected $allowedFields = ['nombre', 'correo', 'celular', 'documento_tipo', 'documento_numero', 'clave', 'estado', 'contacto', 'nombre_c'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $db;




    // Otros métodos del modelo

    public function insert_data($data)
    {
        if ($this->db->table($this->table)->insert($data)) {
            return $this->db->insertID();
        } else {
            return false;
        }
    }

    public function obtenerUsuarioPorId($idUsuario)
    {
        return $this->find($idUsuario);
    }

    /*  public function obtenerIdPorNombre($nombreUsuario)
    {
        $usuario = $this->where('nombre', $nombreUsuario)->first();
        return ($usuario) ? $usuario['id_usuario'] : null;
    } */


    public function obtenerIdPorNombre($nombreUsuarioOCorreo)
    {
        $usuario = $this->where('nombre', $nombreUsuarioOCorreo)
            ->orWhere('correo', $nombreUsuarioOCorreo)
            ->orWhere('celular', $nombreUsuarioOCorreo)
            ->first();

        return ($usuario) ? $usuario['id_usuario'] : null;
    }
}
