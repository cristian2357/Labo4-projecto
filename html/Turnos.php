<!DOCTYPE html>
<html>
	<head>
		<title>iTurnos</title>
		<link rel="icon" type="img/png" href="img/ilogot.png">
	</head>
	<style type="text/css">
		h1{background:#87ad07;padding:10px;width:30%;margin-top:0px;margin-bottom:100px;float:left;}
		ul{list-style-type:none;}
		li{background:#87ad07;padding:20px;width:130px;float:right;display:block;}
		li:hover{box-shadow: 0px 3px 2px #a8a8a8;}
		ul ul{display: none;}
		ul li:hover ul{display: block;}
		a{text-decoration: none;}
		form{clear: both;}
	</style>

	<body>
		<h1>iTurnos</h1>
		<nav>
			<ul>
				<li><a href="">Log In</a></li>
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

			<label for="sucursal">Sucursal mas cercana:</label>
			<select name="sucursal" id="sucursal">
				<?php foreach($this->sucursales as $s) { ?>
					<option value="<?= $s['idsucursales']?>"><?= $s['direccion']?></option>
				<?php } ?>
			</select><br/><br/>

			<label for="fecha">Seleccione fecha disponible:</label>
			<select name="fecha" id="fecha">
			<?php foreach($this->fechasPosibles as $f) { ?>
				<option value="<?=$f?>"><?=$f?></option>
			<?php } ?>
			</select><br/><br/>
			
			<label for="horario">Horario de turno:</label>
			<select name="horario" id="horario">
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
</html>
