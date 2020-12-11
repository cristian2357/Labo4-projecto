<?php
//DOS VISTAS = USUARIO Y CONTRASEÑA - ADMINISTRACION DE TURNOS
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

	if($_POST['usuario']=="") throw new Exception ("campo de usuario vacio");
	if($_POST['password']=="") throw new Exception ("campo de contraseña vacio");
	if(!isset($_POST['usuario'])) throw new Exception ("usuario no seteado");
	if(!isset($_POST['password'])) throw new Exception ("contraseña no seteada");

	$ml = new LogModel();
	if($ml->existeUsuario($_POST['usuario'], $_POST['password'])) {
		$e = new EmpresaModel();
		$s = new SucursalesModel();
		$t = new TurnosModel();
		$v = new AdministracionView();
		
		$v->usuario = $ml->getDatosByUsuario($_POST['usuario'], $_POST['password']);
		$idemp=$v->usuario['idempresas'];
		
		$v->empresa = $e->getDatosEmpresa($idemp);
		$v->sucursales = $s->getSucursalesByEmpresa($idemp);

		if(isset($_POST['sucursal'])) {
		$idsuc=$_POST['sucursal'];
		$v->turnos = $t->getTurnoCompleto($idemp,$idsuc);
		}

		$_SESSION['logueado'] = true;
	}
}


$v->render();