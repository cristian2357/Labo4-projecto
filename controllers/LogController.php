<?php

require '../cfg/Configuration.php';
require Configuration::getAbsolutePath() . '/fw/fw.php';
require Configuration::getAbsolutePath() . '/models/LogModel.php';
require Configuration::getAbsolutePath() . '/models/EmpresaModel.php';
require Configuration::getAbsolutePath() . '/models/SucursalesModel.php';
require Configuration::getAbsolutePath() . '/models/TurnosModel.php';
require Configuration::getAbsolutePath() . '/views/LogView.php';
require Configuration::getAbsolutePath() . '/views/AdministracionView.php';

session_start();

$v = new LogView();

if(isset($_POST['usuario'])) {
	
	if(!isset($_POST['usuario'])) die ("campo de usuario vacio");
	if(!isset($_POST['password'])) die ("campo de contraseña vacio");

	$ml = new LogModel();
	$hash=$ml->hash($_POST['password']);
	$contra=$hash['hash'];
	if($ml->existeUsuario($_POST['usuario'], $contra)) {
		$s = new SucursalesModel();
		$e = new EmpresaModel();
		$t = new TurnosModel();
		$v = new AdministracionView();
		$v->usuario = $ml->getUsuario($_POST['usuario'], $contra);
		
		$ide=$v->usuario['idempresas'];
		$suc=$v->usuario['idsucursales'];
		
		if(isset($_POST['sucursal'])) {
		$suc=$_POST['sucursal'];
		}
		$v->sucursales = $s->getSucursalesByEmpresa($ide);
		$v->turnos = $t->getTurnoByEmpresaSucursal($ide,$suc);
		$v->empresa = $e->getDatosEmpresa($ide);
		$_SESSION['logueado'] = true;
		$_SESSION['usu']=$_POST['usuario'];
		$_SESSION['pas']=$_POST['password'];
	}
}

$v->render();