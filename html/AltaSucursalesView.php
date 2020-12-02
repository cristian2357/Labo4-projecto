<!DOCTYPE html>
<html>

<head>
	<title>Alta de sucursales</title>
	<link href="css/cssadministracion.css" rel="stylesheet" type="text/css" />
</head>

<body>
	
	<div id="altaformulariosucursal">
	<h1>Formulario</h1>

	<form action="" method="POST">
		<input type="hidden" name="empresa" value ="<?=$_POST['empresa']?>">
		<input type="hidden" name="usuario" value ="<?=$_POST['usuario']?>">
		<input type="hidden" name="password" value ="<?=$_POST['password']?>">
		<div class="renglon">
			<label for="agregarsucursal">Direccion: </label>
			<input type="text" name="agregarsucursal" />
		</div>
		<div class="renglon">
			<label for="hora_apertura">Hora de apertura: </label>
			<input type="text" name="hora_apertura" />
		</div>
		<div class="renglon">
			<label for="hora_cierre">Hora de cierre: </label>
			<input type="text" name="hora_cierre" />
		</div>
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
		<input class="boton" type="submit" value="Agregar"><br /><br />
	</form>

	<form action="Administrador" method="POST">
		<input type="hidden" name="empresa" value ="<?=$_POST['empresa']?>">
		<input type="hidden" name="usuario" value ="<?=$_POST['usuario']?>">
		<input type="hidden" name="password" value ="<?=$_POST['password']?>">
		<input class="boton" type="submit" value="Volver a administrador">
	</form>
	</div>

</body>

</html>