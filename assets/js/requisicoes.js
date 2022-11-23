var urlserv = document.getElementById('url').value;
function valor(param) {
    var valores = [];
    $.each(param, function (key, val) {
        valores.push(val);
    })
    return valores;
}
function ajaxSendFormPopUp(url, placeholder, form, append) {
    var data = $("#" + form).serialize();
    append = (append === undefined) ? false : true;

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        beforeSend: function () {
            $("#loading").html("<div id='preloader'><div class='loader'><svg class='circular' viewBox='25 25 50 50'><circle class='path' cx='50' cy='50' r='20' fill='none' stroke-width='3' stroke-miterlimit='10' /></svg></div></div>");
            $("#exampleModal").modal("show");

        },
        success: function (data) {
            if (append) {
                $("#" + placeholder).append(data);
            } else {
                $("#" + placeholder).html(data);
            }
            $('body').remove('loading');
//            $("#loading").html("");
            $("#exampleModal").modal("show");
//                $("#exampleModal").removeClass('modal');

        },
        error: function (xhr) {
            $("#" + placeholder).html(xhr.statusText + xhr.responseText);
            $("#loading").html("<h1>envi</h1>");
        }
    });
}

function ajaxSendForm(url, placeholder, form, append) {
    var data = $("#" + form).serialize();
    append = (append === undefined) ? false : true;

    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        beforeSend: function () {
            $("#loading").html("<div id='preloader'><div class='loader'><svg class='circular' viewBox='25 25 50 50'><circle class='path' cx='50' cy='50' r='20' fill='none' stroke-width='3' stroke-miterlimit='10' /></svg></div></div>");
            //$("#MyModal").modal("toggle");
        },
        success: function (data) {
            if (append) {
                $("#" + placeholder).append(data);
            } else {
                $("#" + placeholder).html(data);
            }
            $("#loading").html("");
            $("#myModal").modal("show");
        },
        error: function (xhr) {
            $("#" + placeholder).html(xhr.statusText + xhr.responseText);
            $("#loading").html("");
        }
    });
}
function enviaDados(url, data, place) {
    $.ajax({
        type: 'POST',
        url: url,
        data: data,
        beforeSend: function () {
            $("#" + place).html(" <div class='inner' ><div class='row'><div class='col-lg-5'></div><div class='col-lg-6'><br><br><br><br><br><br><br><br><br><img src='"+urlserv+"assets/img/loader.gif'/></div></div></div>");
            //$("#MyModal").modal("toggle");
        },
        success: function (data) {
            //alert(data);
            $("#" + place).html(data);
        },
        error: function (xhr) {
            $("#" + place).html(" <div class='inner' ><div class='row'><div class='col-lg-5'></div><div class='col-lg-6'><br><br><br><br><br><br><br><br><br><h1 style='text-transform: capitalize'>"+ xhr.statusText +" "+ xhr.responseText+"</h1></div></div></div>");
            $("#loading").html("");
        }
    });
}
function ajaxSendFormUpload(url, placeholder, append) {
    append = (append === undefined) ? false : true;
    $.ajax({
        type: 'POST',
        url: url,
        data: new FormData($('.form-horizontal').get(0)),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $("#loading").html("<div id='preloader'><div class='loader'><svg class='circular' viewBox='25 25 50 50'><circle class='path' cx='50' cy='50' r='20' fill='none' stroke-width='3' stroke-miterlimit='10' /></svg></div></div>");
            $("#exampleModal").modal("show");

        },
        success: function (data) {
            // alert(data);
            if (append) {
                $("#" + placeholder).append(data);
            } else {
                $("#" + placeholder).html(data);
            }
            $('body').remove('loading');
//            $("#loading").html("");
            $("#exampleModal").modal("show");
//                $("#exampleModal").removeClass('modal');
        },
        error: function (xhr) {
            alert('erro');
            $("#" + placeholder).html(xhr.statusText + xhr.responseText);
            $("#loading").html("<h1>envi</h1>");
        }
    });
}

//-------------------------------------------CHAMAR FUNCOES------------------------------------

$(document).ready(function () {

});

function chamarTela(url) {
    ajaxSendFormPopUp(url, "respostaModal");
}

function enviarDados(url, form) {
    ajaxSendFormPopUp(url, "respostaModal", form);
}
function enviarDadosFile(url) {
    ajaxSendFormUpload(url, "respostaModal");
}

function imprimir(caminho) {
    window.open(caminho, 'Impressao', 'width=1024,height=850,scrollbars=yes');
}