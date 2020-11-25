<?php

class TurnosModel
{
    public function insertarTurno($idEmpresa, $idSucursal, $hora, $fecha, $idCliente)
    {
        $this->db->validar(
            array('fecha' => $fecha, 'hora' => $hora),
            array('fecha' => TipoDato::FECHA, 'hora', TipoDato::HORA)
        );

        if (!((new ClienteModel())->existeCliente($idEmpresa, $idCliente)))
            die("No existe el cliente para ingresar el turno");
        if (!((new SucursalesModel())->existeSucursal($idEmpresa, $idSucursal)))
            die("No existe la sucursal: $idSucursal para la empresa: $idEmpresa");

        $this->db->query("insert into turnos (idsucursales, idempresas, horario, fecha, idcliente) values
        ($idSucursal, $idEmpresa, str_to_date($hora,'%H:%i'), str_to_date($fecha,'%d/%m/%y'), $idCliente)");
    }

    public function getHorariosDisponibles($idEmpresa, $idSucursal, $fecha)
    {
        // crear Datetime con fecha y hora, cota inferior, despues sumarle los minutos de la operacion y verificar que no haya nada entre las dos cotas
    }
}
