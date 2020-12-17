<?php

class SucursalesModel extends Model
{
    public function existeSucursal($idEmpresa, $idSucursal)
    {
        $this->db->validar(
            array('idSucursal' => $idSucursal, 'idEmpresa' => $idEmpresa),
            array('idSucursal' => TipoDato::ENTERO_POSITIVO, 'idEmpresa' => TipoDato::ENTERO_POSITIVO)
        );
        $this->db->query("SELECT * FROM sucursales where idempresas = $idEmpresa and idsucursales = $idSucursal");
        return $this->db->numRows() == 1;
    }

    public function getSucursalesByEmpresa($idEmpresa)
    {
        $aux = new EmpresaModel();
        if (!$aux->existeEmpresa($idEmpresa))
            throw new validacionexception("No existe la empresa solicitada al buscar sucursales");

        $this->db->query("SELECT * from sucursales where idempresas = $idEmpresa ");
            
        return $this->db->fetchAll();
    }

    public function getDiasAtendidosBySucursal($idEmpresa, $idSucursal)
    {
        if (!$this->existeSucursal($idEmpresa, $idSucursal))
            throw new validacionexception("No se ha encontrado la sucursal $idSucursal para la empresa $idEmpresa");

        $this->db->query("SELECT * from sucursales_dias_disponibles where idempresa = $idEmpresa and idsucursal = $idSucursal");
        if ($this->db->numRows() != 1)
            throw new validacionexception("No se han encontrado los dias de atencion para la sucursal $idSucursal de la empresa $idEmpresa");

        $diasAtendidosDb = $this->db->fetch();
        $nombreDias = array('lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo');

        $diasAtendidos = array();
        foreach ($nombreDias as $dia)
            if ($diasAtendidosDb['atiende_' . $dia] == 'S')
                $diasAtendidos[] = array_search($dia, $nombreDias) + 1;  // ingreso el nro de dia de la semana

        return $diasAtendidos;
    }

    public function agregarDiasDisponibles($sucursal, $empresa, $lu, $ma, $mi, $ju, $vi, $sa, $do) {
        if (!$this->existeSucursal($empresa, $sucursal))
            throw new validacionexception("No se ha encontrado la sucursal $sucursal para la empresa $empresa");
        if (!ctype_alpha($lu)) throw new validacionexception();
        if (strlen($lu)!=1) throw new validacionexception();
        if (!ctype_alpha($ma)) throw new validacionexception();
        if (strlen($ma)!=1) throw new validacionexception();
        if (!ctype_alpha($mi)) throw new validacionexception();
        if (strlen($mi)!=1) throw new validacionexception();
        if (!ctype_alpha($ju)) throw new validacionexception();
        if (strlen($ju)!=1) throw new validacionexception();
        if (!ctype_alpha($vi)) throw new validacionexception();
        if (strlen($vi)!=1) throw new validacionexception();
        if (!ctype_alpha($sa)) throw new validacionexception();
        if (strlen($sa)!=1) throw new validacionexception();
        if (!ctype_alpha($do)) throw new validacionexception();
        if (strlen($do)!=1) throw new validacionexception();
        
        $this->db->query("INSERT INTO sucursales_dias_disponibles
        (idsucursal, idempresa, atiende_lunes, atiende_martes, atiende_miercoles, atiende_jueves, atiende_viernes, atiende_sabado, atiende_domingo)
        VALUES
        ($sucursal, $empresa, '$lu', '$ma', '$mi', '$ju', '$vi', '$sa', '$do' )
        ");
    } 

    public function getSucursalById($idEmpresa, $idSucursal)
    {
        if (!$this->existeSucursal($idEmpresa, $idSucursal))
            throw new validacionexception("No se ha encontrado la sucursal $idSucursal para la empresa $idEmpresa");

        $this->db->query("SELECT direccion, date_format(hora_apertura,'%H:%i') as hora_apertura, 
        date_format(hora_cierre,'%H:%i') as hora_cierre 
        from sucursales where idempresas = $idEmpresa and idsucursales = $idSucursal");
        if ($this->db->numRows() != 1)
            throw new validacionexception("No se han encontrado los horarios para la sucursal $idSucursal de la empresa $idEmpresa");

        return $this->db->fetch();
    }
    public function getSucursal($idSucursal){
        $this->db->validar(array('$idSucursal' => $idSucursal), array('$idSucursal' => TipoDato::ENTERO_POSITIVO));
        $this->db->query("SELECT * FROM sucursales WHERE idSucursales=$idSucursal ");
        return $this->db->fetch();
    }

    public function agregarSucursal($sucursal, $hora_apertura, $hora_cierre, $empresa){
        $this->db->validar(array('$sucursal' => $sucursal), array('$sucursal' => TipoDato::ALFANUMERICO));
        $this->db->validar(array('$empresa' => $empresa), array('$empresa' => TipoDato::ENTERO_POSITIVO));
        $this->db->query("INSERT INTO sucursales (idempresas, direccion, hora_apertura, hora_cierre)
                            VALUES ($empresa, $sucursal, str_to_date('$hora_apertura','%H:%i'), str_to_date('$hora_cierre','%H:%i')) ");
    }

    public function getSucursalByDireccion($idempresa, $direccion) {
        $this->db->validar(array('$idempresa' => $idempresa), array('$idempresa' => TipoDato::ENTERO_POSITIVO));
        $this->db->validar(array('$direccion' => $direccion), array('$direccion' => TipoDato::ALFANUMERICO));
        $this->db->query("SELECT * FROM  sucursales WHERE idempresas = $idempresa AND direccion = '$direccion' ");
        return $this->db->fetch();
    }
}

class validacionexception extends Exception {}
