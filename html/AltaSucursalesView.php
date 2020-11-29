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
		<p>Selecciones dias disponibles</p>
		<label for="lunes">Lunes</label>
		<input type="checkbox" name="lunes" name="lunes" value="S" /><br/>
		<label for="martes">Martes</label>
		<input type="checkbox" name="martes" name="martes" value="S" /><br/>
		<label for="miercoles">Miercoles</label>
		<input type="checkbox" name="miercoles" name="miercoles" value="S" /><br/>
		<label for="jueves">Jueves</label>
		<input type="checkbox" name="jueves" name="jueves" value="S" /><br/>
		<label for="viernes">Viernes</label>
		<input type="checkbox" name="viernes" name="viernes" value="S" /><br/>
		<label for="sabado">Sabado</label>
		<input type="checkbox" name="sabado" name="sabado" value="S" /><br/>
		<label for="domingo">Domingo</label>
		<input type="checkbox" name="domingo" name="domingo" value="S" /><br/><br/>
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