<?php

namespace App\Models;

use CodeIgniter\Model;

class UbigeoModel  extends Model
{
    protected $tableDepartamento = 'ubdepartamento';
    protected $tableProvincia = 'ubprovincia';
    protected $tableDistrito = 'ubdistrito';

    public function listarDepartamentos()
    {
        return $this->db->table($this->tableDepartamento)->get()->getResultArray();
    }

    public function listarProvincias($departamentoId)
    {
        return $this->db->table($this->tableProvincia)->where('idDepa', $departamentoId)->get()->getResultArray();
    }

    public function listarDistritos($provinciaId)
    {
        return $this->db->table($this->tableDistrito)->where('idProv', $provinciaId)->get()->getResultArray();
    }
}
