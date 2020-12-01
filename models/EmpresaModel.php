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
        $this->db->query("select * from empresas where idempresas = '$idEmpresa' ");
        return $this->db->numRows() == 1;
    }

    public function getOperacionesByEmpresa($idEmpresa)
    {
        if (!$this->existeEmpresa($idEmpresa))
            die("No existe la empresa para la que se solicitan las operaciones");

        $this->db->query("select * from operaciones where idempresas = $idEmpresa ");
        return $this->db->fetchAll();
    }

    public function getDatosEmpresa($idEmpresa)
    {
        if (!$this->existeEmpresa($idEmpresa))
            die("No existe la empresa solicitada");

        $this->db->query("select * from empresas where idempresas = '$idEmpresa' ");
        return $this->db->fetch();
    }

    public function getMinutosDuracionTurno($idEmpresa)
    {
        if (!$this->existeEmpresa($idEmpresa))
            die("No existe la empresa solicitada");

        $this->db->query("select * from operaciones where idempresas = $idEmpresa");
        if ($this->db->numRows() != 1)
            die("Error al encontrar el encontrar la duración del turno para la empresa: $idEmpresa");

        return $this->db->fetch()['duracion_minutos'];
    }
}
