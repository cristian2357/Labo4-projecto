$(document).ready(function () {
    $("select[name='sucursal']").change(getFechasAjax);
    $("select[name='fecha']").change(getHorariosAjax);
    $("input[name='dni']").change(verificarExisteClienteAjax);
    $(".btn-insertar-turno").click(insertarTurnoAjax);
});

function getFechasAjax() {
    var idSucursal = $("select[name='sucursal']").val();
    var idEmpresa = $("input[name='idEmpresa']").val();
    $("select[name='fecha'] option").not('[disabled]').remove();
    $.ajax({
        type: "post",
        url: "controllers/AltaTurnoController.php",
        data: {
            idSucursal: idSucursal,
            idEmpresa: idEmpresa,
            puntoEntrada: 'H'
        },
        success: function (response) {
            if (response.includes('<')) // En errores llega codigo HTML
                $('html').html(response);
            else
                parseOptionsInSelect('fecha', JSON.parse(response));
        }
    });
}

function getHorariosAjax() {
    var idSucursal = $("select[name='sucursal']").val();
    var idEmpresa = $("input[name='idEmpresa']").val();
    var fecha = $("select[name='fecha']").val();
    $("select[name='horario'] option").not('[disabled]').remove();
    $.ajax({
        type: "post",
        url: "controllers/AltaTurnoController.php",
        data: {
            puntoEntrada: 'J',
            idSucursal: idSucursal,
            idEmpresa: idEmpresa,
            fecha: fecha
        },
        success: function (response) {
            if (response.includes('<')) // En errores llega codigo HTML
                $('html').html(response);
            else
                parseOptionsInSelect(('horario'), JSON.parse(response));
        }
    });
}

function verificarExisteClienteAjax() {
    var dniCliente = $("input[name='dni']").val();
    var idEmpresa = $("input[name='idEmpresa']").val();
    $.ajax({
        type: "post",
        url: "controllers/AltaTurnoController.php",
        data: {
            puntoEntrada: 'L',
            idEmpresa: idEmpresa,
            dni: dniCliente
        },
        success: function (response) {
            if (response.includes('<')) // En errores llega codigo HTML
                $('html').html(response);
            else
                parseExisteCliente(JSON.parse(response));
        }
    });
}

function parseExisteCliente(response) {
    var existeCliente = response != 'N';

    if (existeCliente) {
        var cliente = response;
        inputNombre = $("input[name='nombre-cliente']");
        inputTelefono = $("input[name='telefono-cliente']");
        $("input[name='nombre-cliente']").empty();
        $("input[name='telefono-cliente']").empty();
        inputNombre.val(cliente.nombre_cliente);
        inputNombre.attr('disabled', 'true');
        inputTelefono.val(cliente.telefono_cliente);
        inputTelefono.attr('disabled', 'true');
        $("input[name='id-cliente']").val(cliente.idclientes);
        //$(".btn-insertar-turno").removeAttr("disabled"); // repetir en otro lado
    } else {
        $("input[name='nombre-cliente']").val('');
        $("input[name='telefono-cliente']").val('');
        $("input[name='nombre-cliente']").removeAttr("disabled");
        $("input[name='telefono-cliente']").removeAttr("disabled");
    }
    $(".datos-cliente").show();
}

function insertarTurnoAjax() {
    var idSucursal = $("select[name='sucursal']").val();
    var idEmpresa = $("input[name='idEmpresa']").val();
    var fecha = $("select[name='fecha']").val();
    var horario = $("select[name='horario']").val();
    var dniCliente = $("input[name='dni']").val();
    var nombreCliente = $("input[name='nombre-cliente']").val();
    var telefono = $("input[name='telefono-cliente']").val();
    var idCliente = $("input[name='id-cliente']").val();
    if (!validarDatosFormularioAltaTurno(dniCliente, nombreCliente, telefono, true))
        return;

    $.ajax({
        type: "post",
        url: "controllers/AltaTurnoController.php",
        data: {
            puntoEntrada: 'K',
            idSucursal: idSucursal,
            idEmpresa: idEmpresa,
            fecha: fecha,
            hora: horario,
            dni: dniCliente,
            nombre: nombreCliente,
            idCliente: idCliente,
            telefono: telefono
        },
        success: function (response) {            
            json = JSON.parse(response);
            if (response.includes('<')) // En errores llega codigo HTML
                $('html').html(response);

            else if (json[0] === 'OK')
                location.replace(window.location.origin + "/" + json[2] + "/detalleTurno-" + json[1]);
        }
    });

}

function validarDatosFormularioAltaTurno(dniCliente, nombreCliente, telefono, pasoDos) {

    if (!dniCliente)
        showErrorValidation("Por favor ingrese un número de documento");
    else if (dniCliente.lenght < 7)
        showErrorValidation("El documento debe tener minimamente 7 numeros");
    else if (dniCliente.lenght > 8)
        showErrorValidation("El documento no puede tener mas de 8 numeros");
    if (!pasoDos)
        return true;


    if (!nombreCliente)
        showErrorValidation("Por favor ingrese un nombre");
    else if (isNaN(!nombreCliente))
        showErrorValidation("El nombre no puede tener numeros");

    if (!telefono)
        showErrorValidation("Por favor ingrese un telefono");

    if ($(".error-validacion").is(":visible"))
        return false;

    return true;
}