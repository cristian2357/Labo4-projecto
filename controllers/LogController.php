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

	$ml = new LogModel();
	if($ml->existeUsuario($_POST['usuario'], $_POST['password'])) {
		$e = new EmpresaModel();
		$s = new SucursalesModel();
		$t = new TurnosModel();
		$v = new AdministracionView();
		
		$v->usuario = $ml->getDatosByUsuario($_POST['usuario'], $_POST['password']);
		$idemp=$v->usuario['idempresas'];
		$idsuc=$v->usuario['idsucursales'];
		
		if(isset($_POST['sucursal'])) {
		$idsuc=$_POST['sucursal'];
		}

		$v->empresa = $e->getDatosEmpresa($idemp);
		$v->sucursales = $s->getSucursalesByEmpresa($idemp);
		$v->turnos = $t->getTurnoByEmpresaSucursal($idemp,$idsuc);
		$_SESSION['logueado'] = true;
	}
}


$v->render();