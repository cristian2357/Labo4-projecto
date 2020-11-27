<!DOCTYPE html>
<html>

<head>
	<title>Inicio de sesion</title>
	<link href="../css/turnoscss.css" rel="stylesheet" type="text/css" />
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
				<li><a href="../altaTurno">Inicio</a></li>
			</ul>
		</nav>
	<form id="ingreso" action="" method="post">
		<input type="text" name="usuario" /> <br />
		<input type="password" name="password" /> <br />
		<input type="submit" value="Iniciar sesion" />
	</form>
</body>

</html>