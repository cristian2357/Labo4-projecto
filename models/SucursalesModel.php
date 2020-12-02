<?php

class SucursalesModel extends Model
{
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

        $this->db->query("select * from sucursales where idempresas = '$idEmpresa' ");
            
        return $this->db->fetchAll();
    }

    public function getDiasAtendidosBySucursal($idEmpresa, $idSucursal)
    {
        if (!$this->existeSucursal($idEmpresa, $idSucursal))
            die("No se ha encontrado la sucursal $idSucursal para la empresa $idEmpresa");

        $this->db->query("select * from sucursales_dias_disponibles where idempresa = $idEmpresa and idsucursal = $idSucursal");
        if ($this->db->numRows() != 1)
            die("No se han encontrado los dias de atencion para la sucursal $idSucursal de la empresa $idEmpresa");

        $diasAtendidosDb = $this->db->fetch();
        $nombreDias = array('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo');

        $diasAtendidos = array();
        foreach ($nombreDias as $dia)
            if ($diasAtendidosDb['atiende_' . $dia] == 'S')
                $diasAtendidos[] = array_search($dia, $nombreDias) + 1;  // ingreso el nro de dia de la semana

        return $diasAtendidos;
    }

    public function agregarDiasDisponibles($sucursal, $empresa, $lu, $ma, $mi, $ju, $vi, $sa, $do) {
        $this->db->query("INSERT INTO sucursales_dias_disponibles
        (idsucursal, idempresa, atiende_lunes, atiende_martes, atiende_miercoles, atiende_jueves, atiende_viernes, atiende_sabado, atiende_domingo)
        VALUES
        ('$sucursal', '$empresa', '$lu', '$ma', '$mi', '$ju', '$vi', '$sa', '$do' )
        ");
    } 

    public function getSucursalById($idEmpresa, $idSucursal)
    {
        if (!$this->existeSucursal($idEmpresa, $idSucursal))
            die("No se ha encontrado la sucursal $idSucursal para la empresa $idEmpresa");

        $this->db->query("select direccion, date_format(hora_apertura,'%H:%i') as hora_apertura, 
        date_format(hora_cierre,'%H:%i') as hora_cierre 
        from sucursales where idempresas = $idEmpresa and idsucursales = $idSucursal");
        if ($this->db->numRows() != 1)
            die("No se han encontrado los horarios para la sucursal $idSucursal de la empresa $idEmpresa");

        return $this->db->fetch();
    }
    public function getSucursal($idSucursal){
        $this->db->query("SELECT * FROM sucursales WHERE idSucursales='$idSucursal' ");
        return $this->db->fetch();
    }

    public function agregarSucursal($sucursal, $hora_apertura, $hora_cierre, $empresa){
        $this->db->query("INSERT INTO sucursales (idempresas, direccion, hora_apertura, hora_cierre)
                            VALUES ('$empresa', '$sucursal', str_to_date('$hora_apertura','%H:%i'), str_to_date('$hora_cierre','%H:%i')) ");
    }

    public function getSucursalByDireccion($idempresa, $direccion) {
        $this->db->query("SELECT * FROM  sucursales WHERE idempresas = '$idempresa' AND direccion = '$direccion' ");
        return $this->db->fetch();
    }
}
