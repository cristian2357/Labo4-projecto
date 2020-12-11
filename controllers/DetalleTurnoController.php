<?php

require '../cfg/Configuration.php';
require Configuration::getAbsolutePath() . '/fw/fw.php';
require Configuration::getAbsolutePath() . '/views/cliente/DetalleTurnoView.php';
require Configuration::getAbsolutePath() . '/models/TurnosModel.php';
require Configuration::getAbsolutePath() . '/models/ClienteModel.php';
require Configuration::getAbsolutePath() . '/models/EmpresaModel.php';
require Configuration::getAbsolutePath() . '/models/SucursalesModel.php';

$vista = new DetalleTurnoView();
$turnoModel = new TurnosModel();
$clienteModel = new ClienteModel();
$empresaModel = new EmpresaModel();
$sucursalesModel = new SucursalesModel();


if (isset($_GET['turno']) and count($_POST) == 0) {
    $vista->turno = $turnoModel->getTurnoById($_GET['turno']);
    $vista->cliente = $clienteModel->getDatosClienteById($vista->turno['idempresas'], $vista->turno['idcliente']);
    $vista->empresa = $empresaModel->getDatosEmpresa($vista->turno['idempresas']);
    $vista->sucursal = $sucursalesModel->getSucursalById($vista->turno['idempresas'], $vista->turno['idsucursales']);
    $vista->render();
} else if (isset($_POST['punto-entrada']) && !empty($_POST['punto-entrada'])) {
    $idTurno = $_POST['id-turno'];
    if (!isset($idTurno))
        throw new Exception("No se ha informado el id del turno");

    $turnoModel->deleteTurno($idTurno);


    if ($_POST['punto-entrada'] == 'E'){
        header("Location: altaTurno-" . $_POST['id-empresas']);
    }else{
        header("Location: Inicio");
    }
}
