<?php
require "../fw/Model.php";

class EmpresaModel extends Model
{
    public function existeEmpresa($idEmpresa)
    {
        $this->db->validar(array('idEmpresa' => $idEmpresa), array('idEmpresa' => TipoDato::ENTERO_POSITIVO));
        $this->db->query("select * from empresas where idempresas = $idEmpresa ");
        return $this->db->numRows() == 1;
    }

    public function getOperacionesByEmpresa($idEmpresa)
    {
        if (!$this->existeEmpresa($idEmpresa))
            die("No existe la empresa para la que se solicitan las operaciones");

        $this->db->query("select * from operaciones where idempresas = $idEmpresa ");
        return $this->db->fetchAll();
    }

    public function getDatosEmpresa($idEmpresa){
        if (!$this->existeEmpresa($idEmpresa))
            die("No existe la empresa solicitada");
           
        $this->db->query("select * from empresas where idempresas = $idEmpresa");
        return $this->db->fetchAll();
    }    
}