function parseOptionsInSelect(selectName, values) {
    if (!selectName || !values)
        return;
    var element = $("select[name=" + selectName + "]");
    var html = "";
    for (var v of values)
        html += '<option value=' + v + '>' + v + '</option>';

    element.append(html);
}

function showErrorValidation(msg) {
    $(".div-error").empty();
    $(".div-error").html("<p>-" + msg + "</p>");
    $(".div-error").show();
}

function hideErrorValidacion() {
    $(".div-error").hide();
}

function existInvalidAttribute() {
    return ($(".div-error").is(":visible"));
}