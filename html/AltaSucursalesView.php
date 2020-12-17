<!--FORMULARIO DE SUCURSAL PARA INSERTARLO-->
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
			<input type="text" name="agregarsucursal" id="direccion" />
		</div>
		<div class="renglon">
			<label for="hora_apertura">Hora de apertura: </label>
			<select name="hora_apertura" id="hora_apertura">
			<option selected disabled>00:00</option>
			<?php for ($i = 1; $i <= 24; $i++) { ?>
				<?php if($i<10) { ?>
				<option value="0<?=$i?>:00">0<?=$i?>:00</option>
				<?php } else { ?>
					<option value="<?=$i?>:00"><?=$i?>:00</option>
				<?php } ?>
			<?php } ?>
			</select>
		</div>
		<div class="renglon">
			<label for="hora_cierre">Hora de cierre: </label>
			<select name="hora_cierre" id="hora_cierre">
			<option selected disabled>00:00</option>
			<?php for ($i = 1; $i <= 24; $i++) { ?>
				<?php if($i<10) { ?>
				<option value="0<?=$i?>:00">0<?=$i?>:00</option>
				<?php } else { ?>
					<option value="<?=$i?>:00"><?=$i?>:00</option>
				<?php } ?>
			<?php } ?>
			</select>
		</div>
		<p>Selecciones dias disponibles</p>
		<div class="renglon">
		<label for="lunes">Lunes</label>
		<input type="checkbox" name="lunes" name="lunes" value="S" />
		</div>
		<div class="renglon">
		<label for="martes">Martes</label>
		<input type="checkbox" name="martes" name="martes" value="S" />
		</div>
		<div class="renglon">
		<label for="miercoles">Miercoles</label>
		<input type="checkbox" name="miercoles" name="miercoles" value="S" />
		</div>
		<div class="renglon">
		<label for="jueves">Jueves</label>
		<input type="checkbox" name="jueves" name="jueves" value="S" />
		</div>
		<div class="renglon">
		<label for="viernes">Viernes</label>
		<input type="checkbox" name="viernes" name="viernes" value="S" />
		</div>
		<div class="renglon">
		<label for="sabado">Sabado</label>
		<input type="checkbox" name="sabado" name="sabado" value="S" />
		</div>
		<div class="renglon">
		<label for="domingo">Domingo</label>
		<input type="checkbox" name="domingo" name="domingo" value="S" />
		</div>
		<div class="renglon">
		<input class="boton" type="submit" value="Agregar">
		</div>
	</form>
	<div id="caja"></div>

	<script>
		"use strict"
		document.getElementById("formulog").onsubmit=function() {
			var dir = document.getElementById("direccion").value;

			if (dir.length < 2){
				document.getElementById("caja").innerHTML = "Coloque mas de 2 letras en direccion"
				return false;
			}
		}
	</script>

	<form action="Administrador" method="POST">
		<input type="hidden" name="empresa" value ="<?=$_POST['empresa']?>">
		<input type="hidden" name="usuario" value ="<?=$_POST['usuario']?>">
		<input type="hidden" name="password" value ="<?=$_POST['password']?>">
		<input class="boton" type="submit" value="Volver a administrador">
	</form>
	</div>

</body>

</html>