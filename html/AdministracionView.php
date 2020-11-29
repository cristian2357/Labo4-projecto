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
	
	<h1>Bienvenido <?= $this->empresa['nombre_titular'] ?></h1>

	<form action="" method="POST">
		<input type="hidden" name="usuario" value ="<?=$_POST['usuario']?>">
		<input type="hidden" name="password" value ="<?=$_POST['password']?>">
		<label for="sucursal">Seleccione sucursal: </label>
		<select name="sucursal" id="sucursal">
			<option selected disabled>No selecciono sucursal</option>
			<?php foreach ($this->sucursales as $s) { ?>
				<option value="<?= $s['idsucursales'] ?>"><?= $s['direccion'] ?></option>
			<?php } ?>
		</select>
		<input type="submit" value="Buscar"><br /><br />
	</form>

	<h4>Link para clientes: <a href="turnos/?empresa=<?=$this->sucursales[0]['idempresas']?>">turnos/?empresa=<?=$this->sucursales[0]['idempresas']?></a></h4>

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
	<br />
	<form action="AltaSucursalesController.php" method="POST">
		<input type="hidden" name="empresa" value ="<?=$this->sucursales[0]['idempresas']?>">
		<input type="hidden" name="usuario" value ="<?=$_SESSION['usu']?>">
		<input type="hidden" name="password" value ="<?=$_SESSION['pas']?>">
		<h2>Desea agregar sucursales?</h2>
		<input type="submit" value="Agregar sucursal"><br /><br />
	</form>
	<a href="logout.php">Cerrar sesion</a>
</body>

</html>