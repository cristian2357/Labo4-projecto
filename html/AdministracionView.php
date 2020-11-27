<?php

if (!isset($_SESSION['logueado'])) {
	header("Location: LogController.php");
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
	
	<h1>Bienvenido <?= $this->usuario['nombre_usuario'] ?></h1>

	<form action="" method="POST">
		<label for="sucursal">Seleccione sucursal: </label>
		<select name="sucursal" id="sucursal">
			<option selected disabled>No selecciono sucursal</option>
			<?php foreach ($this->sucursales as $s) { ?>
				<option value="<?= $s['idsucursales'] ?>"><?= $s['direccion'] ?></option>
			<?php } ?>
		</select><br /><br />
	</form>

	<h1>Lista de Turnos</h1>

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
	<br />
	<a href="logout.php">Cerrar sesion</a>
</body>

</html>