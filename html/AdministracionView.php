<?php

if (!isset($_SESSION['logueado'])) {
	header("Location: ../Administrador");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Lista de Turnos</title>
	<link href="css/cssadministracion.css" rel="stylesheet" type="text/css" />
</head>

<body>
	
	<div id="titulo">
	<h1>Bienvenido <?= $this->empresa['nombre_titular'] ?></h1>
	<h2>Administracion de  <?= $this->usuario['nombre_usuario'] ?></h2>
	</div>

	<div id="linkparaclientes">
	<p>Link para clientes: <a href="altaTurno-<?=$this->empresa['idempresas']?>">
		altaTurno-<?=$this->empresa['idempresas']?></a></p>
	</div>

	<div id="buscador">
	<form action="" method="POST">
		<input type="hidden" name="usuario" value ="<?=$_POST['usuario']?>">
		<input type="hidden" name="password" value ="<?=$_POST['password']?>">
		<label for="sucursal">Seleccione sucursal: </label>
		<select name="sucursal" id="sucursal">
			<option selected disabled>Buscar sucursal</option>
			<?php foreach ($this->sucursales as $s) { ?>
				<option value="<?= $s['idsucursales'] ?>"><?= $s['direccion'] ?></option>
			<?php } ?>
		</select>
		<input type="submit" value="Buscar"><br /><br />
	</form>
	</div>
	
	<?php if (isset($_POST['sucursal'])) { ?>
	<div id="tabla">
	<h1>Lista de Turnos</h1>

	<table>
		<tr>
			<th>DNI</th>
			<th>Nombre de cliente</th>
			<th>Telefono</th>
			<th>Fecha</th>
			<th>Horario</th>
		</tr>
		<?php foreach ($this->turnos as $t) { ?>
			<tr>
				<td><?= $t['DNI'] ?></td>
				<td><?= $t['nombre_cliente'] ?></td>
				<td><?= $t['telefono_cliente'] ?></td>
				<td><?= $t['fecha'] ?></td>
				<td><?= $t['horario'] ?></td>
			</tr>
		<?php } ?>
	</table>
	</div>
	<?php } ?>

	<div id="agregarsucursal">
	<h3>Desea agregar sucursales?</h3>
	<form action="Alta-de-Sucursales" method="POST">
		<input type="hidden" name="empresa" value ="<?=$this->empresa['idempresas']?>">
		<input type="hidden" name="usuario" value ="<?=$_POST['usuario']?>">
		<input type="hidden" name="password" value ="<?=$_POST['password']?>">
		<input class="boton" type="submit" value="Agregar sucursal">
	</form>
	</div>

	<a id="cerrar" href="Administrador">Cerrar sesion </a>

</body>

</html>