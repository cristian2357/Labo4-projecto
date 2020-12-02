<?php

require '../cfg/Configuration.php';
require Configuration::getAbsolutePath() . '/fw/fw.php';
require Configuration::getAbsolutePath() . '/models/EmpresaModel.php';
require Configuration::getAbsolutePath() . '/models/SucursalesModel.php';
require Configuration::getAbsolutePath() . '/models/TurnosModel.php';
require Configuration::getAbsolutePath() . '/models/ClienteModel.php';
require Configuration::getAbsolutePath() . '/views/cliente/FormAltaTurnoCliente.php';
require Configuration::getAbsolutePath() . '/controllers/Utils/FechaHoraUtils.php';

$e = new EmpresaModel();
$s = new SucursalesModel();
$v = new FormAltaTurnoCliente();
$t = new TurnosModel();
$c = new ClienteModel();

if (isset($_GET['empresa']) && !isset($_POST['puntoEntrada'])) {
	// Datos formulario alta turno
	$idEmpresa = $_GET['empresa'];
	$v->sucursales = $s->getSucursalesByEmpresa($idEmpresa);
	$v->empresa = $e->getDatosEmpresa($idEmpresa);
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
} else if (isset($_POST['puntoEntrada']) && $_POST['puntoEntrada'] == 'L') {
	if (!isset($_POST['idEmpresa']) || !isset($_POST['dni']))
		die("Faltan valores en la peticion con punto de entrada L");

	if ($c->existeCliente($_POST['idEmpresa'], $_POST['dni']))
		echo json_encode($c->getDatosCliente($_POST['idEmpresa'], $_POST['dni']));
	else
		echo json_encode("N");
} else if (isset($_POST['puntoEntrada']) && $_POST['puntoEntrada'] == 'K') {
	if (
		!isset($_POST['idEmpresa']) || !isset($_POST['idSucursal']) ||
		!isset($_POST['fecha']) || !isset($_POST['dni']) || !isset($_POST['nombre'])
	)
		die("Faltan valores en la peticion con punto de entrada J");

	$existeCliente = !empty($_POST['idCliente']);

	if (!$existeCliente)
		$c->insertarCliente($_POST['dni'], $_POST['nombre'], $_POST['telefono'], $_POST['idEmpresa']);

	$cliente = $c->getDatosCliente($_POST['idEmpresa'], $_POST['dni']);

	$turno = $t->insertarTurno($_POST['idEmpresa'], $_POST['idSucursal'], $_POST['hora'], $_POST['fecha'], $cliente);

	$respuesta = array("OK", $turno['idturnos'], Configuration::NOMBRE_PROYECTO);

	echo json_encode($respuesta);	
}
?>