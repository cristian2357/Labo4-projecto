<?php

if (!isset($_SESSION['logueado'])) {
	header("Location: ../controllers/LogController.php");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Lista de Turnos</title>
	<link href="../css/cssadministracion.css" rel="stylesheet" type="text/css" />
</head>

<body>
	
	<div id="titulo">
	<h1>Bienvenido <?= $this->empresa['nombre_titular'] ?></h1>
	</div>

	<div id="linkparaclientes">
	<p>Link para clientes: <a href="turnos/?empresa=<?=$this->empresa['idempresas']?>">
		turnos/?empresa=<?=$this->empresa['idempresas']?></a></p>
	</div>

	<div id="buscador">
	<form action="" method="POST">
		<input type="hidden" name="usuario" value ="<?=$_POST['usuario']?>">
		<input type="hidden" name="password" value ="<?=$_POST['password']?>">
		<label for="sucursal">Seleccione sucursal: </label>
		<select name="sucursal" id="sucursal">
			<?php foreach ($this->sucursales as $s) { ?>
				<option value="<?= $s['idsucursales'] ?>"><?= $s['direccion'] ?></option>
			<?php } ?>
		</select>
		<input type="submit" value="Buscar"><br /><br />
	</form>
	</div>
	
	<div id="tabla">
	<h1>Lista de Turnos para <?= $this->usuario['nombre_usuario'] ?></h1>

	<table>
		<tr>
			<th>Fecha</th>
			<th>Horario</th>
		</tr>
		<?php foreach ($this->turnos as $t) { ?>
			<tr>
				<td><?= $t['fecha'] ?></td>
				<td><?= $t['horario'] ?></td>
			</tr>
		<?php } ?>
	</table>
	</div>

	<div id="agregarsucursal">
	<h3>Desea agregar sucursales?</h3>
	<form action="AltaSucursalesController.php" method="POST">
		<input type="hidden" name="empresa" value ="<?=$this->empresa['idempresas']?>">
		<input type="hidden" name="usuario" value ="<?=$_POST['usuario']?>">
		<input type="hidden" name="password" value ="<?=$_POST['password']?>">
		<input class="boton" type="submit" value="Agregar sucursal">
	</form>
	</div>

	<a id="cerrar" href="logout.php">Cerrar sesion</a>

</body>

</html>