<?php

require '../cfg/Configuration.php';
require Configuration::getAbsolutePath() . '/fw/fw.php';
require Configuration::getAbsolutePath() . '/models/EmpresaModel.php';
require Configuration::getAbsolutePath() . '/models/SucursalesModel.php';
require Configuration::getAbsolutePath() . '/models/TurnosModel.php';
require Configuration::getAbsolutePath() . '/views/cliente/FormAltaTurnoCliente.php';
require Configuration::getAbsolutePath() . '/controllers/Utils/FechaHoraUtils.php';

$e = new EmpresaModel();
$s = new SucursalesModel();
$v = new FormAltaTurnoCliente();
$t = new TurnosModel();


if (count($_POST) == 0) {
	$v->empresas = $e->getTodos();
	$v->render();
}

if (isset($_POST['empresa']) && !isset($_POST['puntoEntrada'])) {
	// Datos formulario alta turno
	$idEmpresa = $_POST['empresa'];
	$v->sucursales = $s->getSucursalesByEmpresa($idEmpresa);
	$v->empresa = $e->getDatosEmpresa($idEmpresa);
	//TODO:falta idSucurasl, AJAX?
	//$diasPermitidosPorSucursal = $s->getDiasAtendidosBySucursal($idEmpresa, $idSucursal);
	//$v->fechasPosibles = FechaHoraUtils::getListaFechasEnDiasPermitidos()
	$v->render();
} else if (isset($_POST['puntoEntrada']) && $_POST['puntoEntrada'] == 'H') {
	// Fechas x AJAX
	if (!isset($_POST['idEmpresa']) || !isset($_POST['idSucursal']))
		die("Faltan valores en la peticion con punto de entrada H");

	$idEmpresa = $_POST['idEmpresa'];
	$idSucursal = $_POST['idSucursal'];
	$v->sucursalSeleccionada = $s->getSucursalById($idEmpresa, $idSucursal);

	$diasAtendidos = $s->getDiasAtendidosBySucursal($idEmpresa, $idSucursal);
	$fechasSucursalAbierta = FechaHoraUtils::getListaFechasEnDiasPermitidos($diasAtendidos, FechaHoraUtils::getFechaHoy(), FechaHoraUtils::getFechaFutura(15));
	echo json_encode($fechasSucursalAbierta);
} else if (isset($_POST['puntoEntrada']) && $_POST['puntoEntrada'] == 'J') {
	// Horarios x AJAX
	if (!isset($_POST['idEmpresa']) || !isset($_POST['idSucursal']) || !isset($_POST['fecha']))
		die("Faltan valores en la peticion con punto de entrada J");
	
		$horariosDisponibles = $t->getHorariosDisponibles($_POST['idEmpresa'], $_POST['idSucursal'], $_POST['fecha']);

	echo json_encode($horariosDisponibles);
}
