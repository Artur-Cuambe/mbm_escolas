function getSelectDados(url, place,local) {
    $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            $("#" + place).html("<option>Carregando "+local+"...</option>");
        },
        success: function (data) {
            $('#' + place).html('');
            var output = '<option value="">Seleccione a '+local+'</option>';

            for (var i = 0; i < data.data.length; i++) {
                output += "<option value =" + data.data[i].id + "> " + data.data[i].nome + "</option>";
            }
            $('#'+place).html(output);
        },
        error: function (xhr) {
            $("#" + place).html(xhr.statusText + xhr.responseText);
        }
    });
}

$("#regiao_id").change(function () {

    var id = $(this).val();
    getSelectDados("/Endereco/" + 0 + '&' + id,'provincia_id','Província');
});

$("#provincia_id").change(function () {

    var id = $(this).val();
    getSelectDados("/Endereco/" + 1 + '&' + id,'distrito_id','Distrito');

});
$("#distrito_id").change(function () {

    var id = $(this).val();
     getSelectDados("/Endereco/" + 2 + '&' + id,'posto_id','Posto');

});

$("#posto_id").change(function () {

    var id = $(this).val();
    getSelectDados("/Endereco/" + 3 + '&' + id,'localidade_id','Localidade');

});
$("#localidade_id").change(function () {

    var id = $(this).val();
    getSelectDados("/Endereco/" + 4 + '&' + id,'bairro_id','Bairro');

});

$("#bairro_id").change(function () {

    var id = $(this).val();
    getSelectDados("/Endereco/" + 5 + '&' + id,'quarteirao_id','Quarteirão');

});