<!DOCTYPE html>
<html>
	<head>
		<title>iTurnos</title>
		<link rel="icon" type="img/png" href="img/ilogot.png">
		<link href="css/turnoscss.css" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<h1>iTurnos</h1>
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
		<form action="" method="post">

			<input type="hidden" name="idEmpresa" value =<?=$this->empresa['idempresas']?>>
			<label for="sucursal">Sucursal:</label>
			<select name="sucursal" id="sucursal">
				<option selected disabled>Seleccione una sucursal</option>
				<?php foreach($this->sucursales as $s) { ?>
					<option value="<?= $s['idsucursales']?>"><?= $s['direccion']?></option>
				<?php } ?>
			</select><br/><br/>

			<label for="fecha">Seleccione fecha disponible:</label>
			<select name="fecha" id="fecha">			
				<option selected disabled>Seleccione una fecha</option>
			</select><br/><br/>
			
			<label for="horario">Horario de turno:</label>
			<select name="horario" id="horario">
				<option selected disabled>Seleccione un horario</option>				
			</select><br/><br/>

			<label for="dni">DNI cliente:</label>					
			<input type="number" name="dni" id="dni" maxlength="8">
			
			<div class="datos-cliente" style="display:none">
				<label for="nombre-cliente">Nombre y apellido:</label>
				<input type="text" name="nombre-cliente" id="nombre-cliente" minlength="5" maxlength="70">
				<label for="telefono-cliente">Telefono de contacto:</label>
				<input type="text" name="telefono-cliente" id="telefono-cliente" minlength="7" maxlength="15">
				
				<input type="hidden" name="id-cliente">;
			</div>	
			

			<br>
			<button type="button" class="btn-insertar-turno">Agendar Turno</button>


			<div class="error-validacion"></div>

		</form>
	</body>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/AltaTurno.js"></script>
	<script src="js/Utils.js"></script>
</html>
