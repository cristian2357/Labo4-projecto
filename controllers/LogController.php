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

if(count($_POST)>0) {
	
	if(!isset($_POST['usuario'])) die ("campo de usuario vacio");
	if(!isset($_POST['password'])) die ("campo de contraseña vacio");
	//select sha1("$_POST['password']");
	$ml = new LogModel();
	if($ml->existeUsuario($_POST['usuario'], $_POST['password'])) {
		$s = new SucursalesModel();
		$t = new TurnosModel();
		$v = new AdministracionView();
		$v->usuario = $ml->getUsuario($_POST['usuario'], $_POST['password']);
		
		$ide=$v->usuario['idempresas'];
		$v->sucursales = $s->getSucursalesByEmpresa($ide);
		$v->turnos = $t->getTurnoByEmpresa($ide);
		$_SESSION['logueado'] = true;
	}
}


$v->render();