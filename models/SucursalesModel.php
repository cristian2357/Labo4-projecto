<?php

class SucursalesModel extends Model
{
    public function getSucursales($eid) {
        $this->db->query("SELECT s.idsucursal, s.direccion
                            FROM sucursales s LEFT JOIN empresas e ON e.empresa_id=s.empresa_id
                            WHERE s.empresa_id = $eid");
        return $this->db->fetchAll();
    }

    public function existeSucursal($idEmpresa, $idSucursal)
    {
        $this->db->validar(
            array('idSucursal' => $idSucursal, 'idEmpresa' => $idEmpresa),
            array('idSucursal' => TipoDato::ENTERO_POSITIVO, 'idEmpresa' => TipoDato::ENTERO_POSITIVO)
        );
        $this->db->query("select * from sucursales where idempresas = $idEmpresa and idsucursales = $idSucursal");
        return $this->db->numRows() == 1;
    }

    public function getSucursalesByEmpresa($idEmpresa)
    {
        $aux = new EmpresaModel();
        if (!$aux->existeEmpresa($idEmpresa))
            die("No existe la empresa solicitada al buscar sucursales");

        $this->db->query("select * from sucursales where idempresas = $idEmpresa");
        if ($this->db->numRows() != 1)
            die("No se encontraron sucursales para la empresa $idEmpresa");

        return $this->db->fetchAll();
    }

    public function getDiasAtendidosBySucursal($idEmpresa, $idSucursal)
    {
        if (!$this->existeSucursal($idEmpresa, $idSucursal))
            die("No se ha encontrado la sucursal $idSucursal para la empresa $idEmpresa");

        $this->db->query("select * from sucursales_dias_disponibles where idempresas = $idEmpresa and idsucursales = $idSucursal");
        if ($this->db->numRows != 1)
            die("No se han encontrado los dias de atencion para la sucursal $idSucursal de la empresa $idEmpresa");

        $diasAtendidosDb = $this->db->fetchAll();
        $nombreDias = array('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo');

        $diasAtendidos = array();
        foreach ($nombreDias as $dia)
            if ($diasAtendidosDb['atiende_' . $dia] == 'S')
                $diasAtendidos[] = array_seach($nombreDias[$dia]) + 1;  // ingreso el nro de dia de la semana

        return $diasAtendidos;
    }

    public function getSucursalById($idEmpresa, $idSucursal)
    {
        if (!$this->existeSucursal($idEmpresa, $idSucursal))
            die("No se ha encontrado la sucursal $idSucursal para la empresa $idEmpresa");

        $this->db->query("select direccion, date_format(hora_apertura,'%H:%i') as hora_apertura, 
        date_format(hora_cierre,'%H:%i') as hora_cierre 
        from sucursal where idempresas = $idEmpresa and idsucursales = $idSucursal");
        if ($this->db->numRows != 1)
            die("No se han encontrado los horarios para la sucursal $idSucursal de la empresa $idEmpresa");

        return $this->db->fetchAll();
    }
}
