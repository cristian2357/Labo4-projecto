$(document).ready(function () {
    $("select[name='sucursal']").change(getFechasAjax);

});

function getFechasAjax() {
    var idSucursal = $("select[name='sucursal']").val();
    var idEmpresa = $("input[name='idEmpresa']").val();
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
                parseFechasDisponibles(JSON.parse(response));
        }
    });
}

function parseFechasDisponibles(fechas) {
    var selectFechas = $("select[name='fecha']");

    var html = "";
    for (var f of fechas)
        html += '<option value=' + f + '>' + f + '</option>';

    selectFechas.html(html);
}