<?php

class EmpresaModel extends Model
{
    public function getTodos()
    {
        $this->db->query("SELECT * FROM empresas");
        return $this->db->fetchAll();
    }

    public function existeEmpresa($idEmpresa)
    {
        $this->db->validar(array('idEmpresa' => $idEmpresa), array('idEmpresa' => TipoDato::ENTERO_POSITIVO));
        $this->db->query("SELECT * FROM empresas where idempresas = $idEmpresa ");
        return $this->db->numRows() == 1;
    }

    public function getOperacionesByEmpresa($idEmpresa)
    {
        if (!$this->existeEmpresa($idEmpresa))
            throw new empresaException("No existe la empresa para la que se solicitan las operaciones");

        $this->db->query("SELECT * FROM operaciones where idempresas = $idEmpresa ");
        return $this->db->fetchAll();
    }

    public function getDatosEmpresa($idEmpresa)
    {
        if (!$this->existeEmpresa($idEmpresa))
            throw new empresaException("No existe la empresa solicitada");

        $this->db->query("SELECT * FROM empresas where idempresas = $idEmpresa ");
        return $this->db->fetch();
    }    
}

class empresaException extends Exception {}
