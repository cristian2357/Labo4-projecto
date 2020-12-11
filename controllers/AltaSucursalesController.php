<?php
//FORMULARIO DE SUCURSALES
require '../cfg/Configuration.php';
require Configuration::getAbsolutePath() . '/fw/fw.php';
require Configuration::getAbsolutePath() . '/models/LogModel.php';
require Configuration::getAbsolutePath() . '/models/SucursalesModel.php';
require Configuration::getAbsolutePath() . '/models/TurnosModel.php';
require Configuration::getAbsolutePath() . '/views/AltaSucursalesView.php';
require Configuration::getAbsolutePath() . '/controllers/Utils/FechaHoraUtils.php';



session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: LogController.php");
	exit;
}

$v = new AltaSucursalesView();

if(isset($_POST['agregarsucursal'])) {

$horaentrada=FechaHoraUtils::parseStringFechaHoraToDatetime(FechaHoraUtils::getFechaHoy(),$_POST['hora_apertura']);
$horasalida=FechaHoraUtils::parseStringFechaHoraToDatetime(FechaHoraUtils::getFechaHoy(),$_POST['hora_cierre']);

if($horaentrada>=$horasalida) throw new DefaultException ("El horario de apertura es mayor o igual al horario de cierre");

if(!isset($_POST['lunes']) && !isset($_POST['martes']) && !isset($_POST['miercoles'])
	&& !isset($_POST['jueves']) && !isset($_POST['viernes'])
	&& !isset($_POST['sabado']) && !isset($_POST['domingo'])) throw new DefaultException ("NO selecciono dias disponibles");

if(!isset($_POST['lunes']))$_POST['lunes']='N';
if(!isset($_POST['martes']))$_POST['martes']='N';
if(!isset($_POST['miercoles']))$_POST['miercoles']='N';
if(!isset($_POST['jueves']))$_POST['jueves']='N';
if(!isset($_POST['viernes']))$_POST['viernes']='N';
if(!isset($_POST['sabado']))$_POST['sabado']='N';
if(!isset($_POST['domingo']))$_POST['domingo']='N';

$s = new SucursalesModel();
$s->agregarSucursal($_POST['agregarsucursal'],$_POST['hora_apertura'],$_POST['hora_cierre'],$_POST['empresa']);
$fila = $s->getSucursalByDireccion($_POST['empresa'],$_POST['agregarsucursal']);
$s->agregarDiasDisponibles($fila['idsucursales'], $_POST['empresa'],
	$_POST['lunes'],$_POST['martes'],$_POST['miercoles'],$_POST['jueves'],$_POST['viernes'],
	$_POST['sabado'],$_POST['domingo']);
}

$v->render();