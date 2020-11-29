<?php

if (!isset($_SESSION['logueado'])) {
	header("Location: LogController.php");
	exit;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Alta de sucursales</title>
	<link href="css/cssadministracion.css" rel="stylesheet" type="text/css" />
</head>

<body>
	
	<h1>Formulario</h1>

	<form action="" method="POST">
		<input type="hidden" name="empresa" value ="<?=$_SESSION['empresa']?>">
		<input type="hidden" name="usuario" value ="<?=$_SESSION['usu']?>">
		<input type="hidden" name="password" value ="<?=$_SESSION['pas']?>">
		<label for="sucursal">Direccion: </label>
		<input type="text" name="sucursal" /> <br />
		<label for="hora_apertura">Hora de apertura: </label>
		<input type="text" name="hora_apertura" /> <br />
		<label for="hora_cierre">Hora de cierre: </label>
		<input type="text" name="hora_cierre" /> <br />
		<input type="submit" value="Agregar"><br /><br />
	</form>

	<form action="LogController.php" method="POST">
		<input type="hidden" name="empresa" value ="<?=$_SESSION['empresa']?>">
		<input type="hidden" name="usuario" value ="<?=$_SESSION['usu']?>">
		<input type="hidden" name="password" value ="<?=$_SESSION['pas']?>">
		<input type="submit" value="Volver a administrador">
	</form>
</body>

</html>