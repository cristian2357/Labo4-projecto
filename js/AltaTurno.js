$(document).ready(function () {
    $("select[name='sucursal']").change(getFechasAjax);
    $("select[name='fecha']").change(getHorariosAjax);
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