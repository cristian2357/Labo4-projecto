<?php

class TurnosModel extends Model
{
    public function insertarTurno($idEmpresa, $idSucursal, $hora, $fecha, $cliente)
    {
        $this->db->validar(
            array('fecha' => $fecha, 'hora' => $hora),
            array('fecha' => TipoDato::FECHA, 'hora' => TipoDato::HORA)
        );

        if (!((new SucursalesModel())->existeSucursal($idEmpresa, $idSucursal)))
            die("No existe la sucursal: $idSucursal para la empresa: $idEmpresa");

        $idCliente = $cliente['idclientes'];

        $this->db->query("insert into turnos (idsucursales, idempresas, horario, fecha, idcliente) values
        ('$idSucursal', '$idEmpresa', str_to_date('$hora','%H:%i'), str_to_date('$fecha','%d/%m/%y'), '$idCliente')");
    }

    public function getHorariosDisponibles($idEmpresa, $idSucursal, $fecha)
    {
        $turnosDiarios = $this->getTurnosDiariosBySucursal($idEmpresa, $idSucursal, $fecha);

        $sucursal = (new SucursalesModel())->getSucursalById($idEmpresa, $idSucursal);
        $duracionMinutos = (new EmpresaModel())->getDatosEmpresa($idEmpresa)['duracion_minuto_turno'];
        $dateTimeApertura = FechaHoraUtils::parseStringFechaHoraToDatetime($fecha, $sucursal['hora_apertura']);
        $dateTimeCierre = FechaHoraUtils::parseStringFechaHoraToDatetime($fecha, $sucursal['hora_cierre']);

        $strHorariosDisponibles = array();

        $dateTimeParcial = clone $dateTimeApertura;

        while ($dateTimeParcial < $dateTimeCierre) {                    // Creo vector de horarios disponibles separados por el mismo intervalo de tiempo segun empresa
            $strHorariosDisponibles[] = FechaHoraUtils::getHoraByDateTime($dateTimeParcial);
            FechaHoraUtils::addMinutesToDatetime($dateTimeParcial, $duracionMinutos);
        }

        foreach ($turnosDiarios as $turno)                               // Voy eliminando de los horarios disponibles los que ya esten asignados a un turno
            if ($indice = array_search($turno['horario'], $strHorariosDisponibles)) {
                unset($strHorariosDisponibles[$indice]);
                $strHorariosDisponibles = array_values($strHorariosDisponibles);
            }

        return $strHorariosDisponibles;
    }

    public function getTurnoByEmpresaSucursal($idEmpresa,$idsucursal) {
    	
        $this->db->query("select horario, fecha, date_format(horario,'%H:%i') as horario, 
        date_format(fecha,'%d/%m/%y') as fecha from turnos where idempresas = '$idEmpresa'
            AND idsucursales = '$idsucursal' ");
        return $this->db->fetchAll();
    }

    public function getTurnoCompleto($idEmpresa,$idsucursal) {
        
        $this->db->query("select horario, fecha, date_format(horario,'%H:%i') as horario, 
        date_format(fecha,'%d/%m/%y') as fecha, idcliente, nombre_cliente, telefono_cliente, DNI
        from turnos JOIN clientes
        where turnos.idcliente = clientes.idclientes and
        turnos.idempresas = '$idEmpresa'  AND turnos.idsucursales = '$idsucursal' ");
        return $this->db->fetchAll();
    }

    public function getTurnoByEmpresa($idEmpresa)
    {
        $this->db->query("select horario, fecha, date_format(horario,'%H:%i') as horario, 
        date_format(fecha,'%d/%m/%y') as fecha from turnos where idempresas = '$idEmpresa' ");
        return $this->db->fetchAll();
    }

    public function getTurnosDiariosBySucursal($idEmpresa, $idSucursal, $fecha)
    {
        $this->db->validar(
            array('idEmpresa' => $idEmpresa, 'idSucursal' => $idSucursal, 'fecha' => $fecha),
            array('idEmpresa' => TipoDato::ENTERO_POSITIVO, 'idSucursal' => TipoDato::ENTERO_POSITIVO, 'fecha' => TipoDato::FECHA)
        );

        $this->db->query("select idturnos, idsucursales, idempresas, date_format(horario,'%H:%i') as horario, date_format(fecha,'%d/%m/%Y') as fecha, idcliente from turnos
        where idsucursales = '$idSucursal' and idempresas = '$idEmpresa' and date_format(fecha,'%d/%m/%Y') = '$fecha'");

        return $this->db->fetchAll();
    }
}
