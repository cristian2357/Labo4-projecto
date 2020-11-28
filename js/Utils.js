function parseOptionsInSelect(selectName, values) {
    if (!selectName || !values)
        return;
    var element = $("select[name=" + selectName + "]");
    var html = "";
    for (var v of values)
        html += '<option value=' + v + '>' + v + '</option>';

    element.append(html);
}