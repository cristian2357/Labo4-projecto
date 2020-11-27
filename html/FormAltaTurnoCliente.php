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
				<li><a href="controllers/LogController.php">Log In</a></li>
				<li><a href="">recomendar</a></li>
				<li><a href="">contactenos</a></li>
				<li><a href="">conozcanos</a>
					<ul>
						<li><a href="">Que es iTurnos?</a></li>
						<li><a href="">Preguntas frecuentes</a></li>
						<li><a href="">Requisitos</a></li>
					</ul>
				</li>
				<li><a href="">Inicio</a></li>
			</ul>
		</nav>
		<form action="" method="post">
			
			<?php if(count($_POST)>0) { ?>

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
			</select><br/><br/>
			
			<label for="horario">Horario de turno:</label>
			<select name="horario" id="horario">
				<option selected disabled>Seleccione un horario</option>
				<option value="1">08:00</option>
				<option value="2">10:00</option>
				<option value="3">12:00</option>
				<option value="4">14:00</option>
				<option value="5">16:00</option>
				<option value="6">18:00</option>
			</select><br/><br/>

			<input type="submit" value="Agendar Turno">

			<?php } else { ?>
				<label for="empresa"><br/><br/>Seleccione empresa:</label>
			<select name="empresa" id="empresa">
				<?php foreach($this->empresas as $e) { ?>
					<option value="<?= $e['idempresas']?>"><?= $e['nombre_empresa']?></option>
				<?php } ?>
			</select><br/><br/>
			<input type="submit" value="Ver Sucursales disponibles">
			<?php } ?>

		</form>
	</body>
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/AltaTurno.js"></script>
</html>
