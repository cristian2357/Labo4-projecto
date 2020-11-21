<?php

require Configuration::getAbsolutePath().'/fw/fw.php';
require Configuration::getAbsolutePath().'/models/EmpresaModel.php';
require Configuration::getAbsolutePath().'/models/SucursalesModel.php';
require Configuration::getAbsolutePath().'/views/Turnos.php';
require Configuration::getAbsolutePath().'/controllers/Utils/FechaHoraUtils.php';

$e = new EmpresaModel();
$s = new SucursalesModel();
$v = new Turnos();

$v->empresas = $e->getTodos();



if (isset($_POST['empresa'])) {
	$idEmpresa = $_POST['empresa'];
	$v->sucursales = $s->getSucursalesByEmpresa($idEmpresa);
	//TODO:falta idSucurasl, AJAX?
	//$diasPermitidosPorSucursal = $s->getDiasAtendidosBySucursal($idEmpresa, $idSucursal);
	//$v->fechasPosibles = FechaHoraUtils::getListaFechasEnDiasPermitidos()
}

$v->render();