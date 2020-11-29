<?php

require '../cfg/Configuration.php';
require Configuration::getAbsolutePath() . '/fw/fw.php';
require Configuration::getAbsolutePath() . '/models/LogModel.php';
require Configuration::getAbsolutePath() . '/models/SucursalesModel.php';
require Configuration::getAbsolutePath() . '/views/AltaSucursalesView.php';

session_start();
if (!isset($_SESSION['logueado'])) {
	header("Location: LogController.php");
	exit;
}
$_SESSION['empresa']=$_POST['empresa'];
$_SESSION['usu']=$_POST['usuario'];
$_SESSION['pas']=$_POST['password'];

$v = new AltaSucursalesView();

if(isset($_POST['sucursal'])) {
$s = new SucursalesModel();
$s->agregarSucursal($_POST['sucursal'],$_POST['hora_apertura'],$_POST['hora_cierre'],$_SESSION['empresa']);
}

$v->render();