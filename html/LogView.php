<!--NAV:INICIO DE SESION-->
<!DOCTYPE html>
<html>

<head>
	<title>Inicio de sesion</title>
	<link href="css/turnoscss.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<nav>
		<ul>
			<li><a href="Administrador">Log In</a></li>
			<li><a href="Recomendar">recomendar</a></li>
			<li><a href="Contactenos">contactenos</a></li>
			<li><a href="Conozcanos">conozcanos</a></li>
			<li><a href="Inicio">Inicio</a></li>
		</ul>
	<p id="relleno"></p>
	</nav>
	
	<form action="" method="post" class="formulario" id="formulog">
	<div class="renglon">
		<label>Usuario:</label>
		<input type="text" name="usuario" id="usuario" maxlength="20" />
	</div>
	<div class="renglon">
		<label>Contraseña:</label>
		<input type="password" name="password" id="password" maxlength="20" />
	</div>
	<div class="renglon">
		<input type="submit" value="Iniciar sesion" />
		<?php if(count($_POST)>0) echo ("Usuario o Contraseña incorrectas"); ?>
	</div>
	</form>
	<div id="caja"></div>

	<script>
		"use strict"
		document.getElementById("formulog").onsubmit=function() {
			var usu = document.getElementById("usuario").value;
			var pass = document.getElementById("password").value;

			if (usu.length < 2){
				document.getElementById("caja").innerHTML = "Coloque mas de 2 letras en usuario"
				return false;
			}
			if (pass.length < 2){
				document.getElementById("caja").innerHTML = "Coloque mas de 2 letras en contraseña"
				return false;
			}
		}
	</script>

</body>

</html>