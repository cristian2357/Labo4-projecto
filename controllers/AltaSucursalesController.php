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

if(!isset($_POST['lunes']))$_POST['lunes']='N';
if(!isset($_POST['martes']))$_POST['martes']='N';
if(!isset($_POST['miercoles']))$_POST['miercoles']='N';
if(!isset($_POST['jueves']))$_POST['jueves']='N';
if(!isset($_POST['viernes']))$_POST['viernes']='N';
if(!isset($_POST['sabado']))$_POST['sabado']='N';
if(!isset($_POST['domingo']))$_POST['domingo']='N';

$s = new SucursalesModel();
$s->agregarSucursal($_POST['sucursal'],$_POST['hora_apertura'],$_POST['hora_cierre'],$_SESSION['empresa']);
$filaparadia = $s->getSucursalByDireccion($_SESSION['empresa'],$_POST['sucursal']);
$sucursalparadia = $filaparadia['idsucursales'];
$s->agregarDiasDisponibles($sucursalparadia,$_SESSION['empresa'],$_POST['lunes'],$_POST['martes'],$_POST['miercoles'],$_POST['jueves'],$_POST['viernes'],$_POST['sabado'],$_POST['domingo']);
}

$v->render();