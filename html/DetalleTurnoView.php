
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/detalle-turno.css">
    <title>Detalle turno - <?= $this->empresa['nombre_empresa'] ?></title>
</head>

<body>
    <div class="content">
        <form class="form-detalle-turno" method="post">
            <h1>Detalle turno - <?= $this->empresa['nombre_empresa'] ?></h1>
            <h2>Cliente: <?= $this->cliente['nombre_cliente'] . ' - ' . $this->cliente['DNI'] ?> </h2>
            <h2>Fecha: <?= $this->turno['fecha'] . ' ' . $this->turno['horario'] ?></h2>

            <input type="hidden" name="id-empresas" value=<?= $this->turno['idempresas'] ?>>
            <input type="hidden" name="id-turno" value=<?= $this->turno['idturnos'] ?>>
            <input type="hidden" name="punto-entrada">
            <button type="button" class="btn-eliminar-turno">Eliminar turno</button>
            <button type="button" class="btn-editar-turno">Editar turno</button>
        </form>
    </div>
    <div class="modal-detalle-turno">
        <p>Esto eliminara el turno y creara uno nuevo, desea proceder?</p>
        <button class="btn-si" style="margin-left: 45%;">Si</button>
        <button class="btn-no">No</button>
    </div>
</body>
<script src="js/DetalleTurno.js"></script>
<script>
    bindearBotones();
</script>

</html>