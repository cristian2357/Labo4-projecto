<?php

class CLienteModel
{
    public function existeCliente($idEmpresa, $idCliente)
    {
        if (!(new EmpresaModel())->existeEmpresa($idEmpresa))
            die("No existe la empresa ingresada para este cliente");

        $this->db->validar(array('idCliente', $idCliente), array('idCliente', TipoDato::NUMERICO));
        $this->db->query("select * from clientes where idcliente = $idCliente");

        return $this->db->numRows() == 1;
    }
}
