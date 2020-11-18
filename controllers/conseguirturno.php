<?php

require 'fw/fw.php';
require 'models/EmpresaModel.php';
require 'models/SucursalesModel.php';
require 'views/Turnos.php';

$e = new EmpresaModel();
$s = new SucursalesModel();
$v = new Turnos();

$v->empresas = $e->getTodos();

if(isset($_POST['empresa'])) {
	$v->sucursales = $s->getSucursalesByEmpresa($_POST['empresa']);
}

$v->render();