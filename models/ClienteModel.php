<?php

class ClienteModel extends Model
{
    public function existeCliente($idEmpresa, $dniCliente)
    {
        if (!(new EmpresaModel())->existeEmpresa($idEmpresa))
            die("No existe la empresa ingresada para este cliente");

        $this->db->validar(array('dni' => $dniCliente), array('dni' => TipoDato::ENTERO_POSITIVO));
        $this->db->query("select * from clientes where dni = '$dniCliente' and idempresas = '$idEmpresa'");

        return $this->db->numRows() == 1;
    }

    public function getDatosCliente($idEmpresa, $dniCliente)
    {
        $this->db->validar(
            array('dni' => $dniCliente, 'idEmpresa' => $idEmpresa),
            array('dni' => TipoDato::ENTERO_POSITIVO, 'idEmpresa' => TipoDato::ENTERO_POSITIVO)
        );
        $this->db->query("select * from clientes where dni = $dniCliente and idempresas = $idEmpresa");
        return $this->db->fetch();
    }

    public function getDatosClienteById($idEmpresa, $idCliente)
    {
        $this->db->validar(
            array('dni' => $idCliente, 'idEmpresa' => $idEmpresa),
            array('dni' => TipoDato::ENTERO_POSITIVO, 'idEmpresa' => TipoDato::ENTERO_POSITIVO)
        );
        $this->db->query("select * from clientes where idclientes = $idCliente and idempresas = $idEmpresa");
        return $this->db->fetch();
    }

    public function insertarCliente($dniCliente, $nombre, $telefono, $idEmpresa)
    {
        $this->db->validar(
            array('dni' => $dniCliente, 'nombre' => $nombre, 'telefono' => $telefono),
            array('dni' => TipoDato::ENTERO_POSITIVO, 'nombre' => TipoDato::ALFANUMERICO, 'telefono' => TipoDato::ENTERO_POSITIVO)
        );
        $this->db->query("insert into clientes (nombre_cliente,telefono_cliente,idempresas,dni) values ('$nombre','$telefono','$idEmpresa','$dniCliente') ");
    }
}
