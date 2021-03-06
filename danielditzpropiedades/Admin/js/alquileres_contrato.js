/**
 * Created by Martin on 17/01/2017.
 */
var alquileresContratoTable=undefined;

/** Close panel **/
$(".close-link").click(function(){
    var e=$(this).closest(".x_panel");
    e.remove()
});

/** Collapse panel **/
$(".collapse-link").on("click",function(){
    var e=$(this).closest(".x_panel"),t=$(this).find("i"),n=e.find(".x_content");
    e.attr("style")?n.slideToggle(200,function(){
        e.removeAttr("style")
    }):(n.slideToggle(200),e.css("height","auto")),t.toggleClass("fa-chevron-up fa-chevron-down")
});


function goToAlquilerCobranzas(page,row){
    row.addClass('selected').siblings().removeClass("selected");
    var id = row.attr('data-id');

    window.location.href="alquiler_contrato_cobranza.php?id="+id;
}

function verPropiedad(page,row){
    row.addClass('selected').siblings().removeClass("selected");
    var id = row.attr('data-id');

    window.location.href="alquiler_contrato_ver.php?id="+id;
}

/** Borrar Propiedad**/
function deletePropiedad(row){
    row.addClass('selected').siblings().removeClass("selected");
    var id = row.attr('data-id');
    bootbox.dialog({
        title: "Eliminar Propiedad",
        message: "¿Está seguro que desea eliminar la propiedad?",
        buttons: {
            success: {
                label: "Aceptar",
                className: "btn-success",
                callback: function () {
                    alert("borrar propidad lógicamente");
                    var userToken=getCookie(window.USER_TOKEN);
                    /* $.ajax({
                     url: window.base_url+window.ws_alquiler_contrato_remove,
                     type: 'post',
                     dataType: 'json',
                     headers: {'X-Auth':userToken},
                     data: {'id_inmuebleAlquilerContrato': id},
                     success: function (response) {
                     if (response.data.status == "10001"){
                     var d = new Date();
                     d.setTime(d.getTime() + (14*24*60*60*1000));
                     var expires = "expires=" + d.toUTCString();
                     document.cookie = "userToken=" + userToken +"; " + expires;

                     postTable.fnDeleteRow(row.closest("tr").get(0));
                     }
                     else if (response.data.status == "10002"){
                     window.location ="login.php";
                     createCookie(window.sesion_toke,"",-1);
                     }
                     }
                     });*/
                    alquileresContratoTable.fnDeleteRow(row.closest("tr").get(0));
                }
            },
            cancel: {
                label: "Cancelar",
                className: "btn-cancel",
                callback: function () {
                }
            }
        }
    });
}

function editPropiedad(page,row){
    row.addClass('selected').siblings().removeClass("selected");
    var id = row.attr('data-id');
    window.location.href="alquiler_contrato_edit.php?id="+id;
}

function loadAlquileresContraro(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_alquileres_contrato;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        dataType: 'json',
        success: function (response){
            if (response.data.status == 10001) {
                $('#table_content_body').empty();
                $.each(response.data.propiedades, function () {

                    var id = this.idInmAlquilerContrato;
                    // Direccion
                    var direccion = this.direccion.calle + ' ' + this.direccion.nro;
                    if (this.direccion.piso != "")
                        direccion += ' Piso: ' + this.direccion.piso;
                    if (this.direccion.dpto != "")
                        direccion += ' Dto: ' + this.direccion.dpto;
                    //Propietario
                    var propietario = this.propietario.apellido + ", " + this.propietario.nombre;
                    var inquilino = this.inquilino.apellido + ", " + this.inquilino.nombre;
                    var dataTable = '<tr role="row" class="odd" data-id=' + id + '><td><img id="img-alquileres" src="images/inbox.png"</img></td>' +
                        '<td><p id="dir-alquileres">' + direccion + '</p><p id="prop-alquileres"><u><b>Propietario:</b></u> ' + propietario + '</p><p style="font-size:14px"><u><b>Inquilino:</b></u> ' + inquilino + '</p><p id="valor-alquileres"><u><b>Valor:</b></u> ' + this.valor + '</p></td>' +
                        //'<td style="text-align: center;vertical-align: middle;"><i class="fa fa-dollar fa-2x actionImage" onclick="goToAlquilerCobranzas($(this),$(this).parent().parent());" data-toggle="tooltip" title="Cobrar"></i></td>' +
                        '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-eye fa-2x actionImage" data-page="ver_alquileres_disponibles.php" onclick="verPropiedad($(this),$(this).parent().parent());" data-toggle="tooltip" title="Ver"></i></td>' +
                        '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-edit fa-2x actionImage" data-page="Alquileres/edit_alquileres_disponibles.php" onclick="editPropiedad($(this),$(this).parent().parent());" data-toggle="tooltip" title="Editar"> </i></td>' +
                        '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-times-circle fa-2x actionImage" onclick="deletePropiedad($(this).parent().parent());" data-toggle="tooltip" title="Eliminar"></i></td></tr>';
                    $('#table_content_body').append(dataTable);

                });
                alquileresContratoTable = $('#table_content').dataTable({
                    "language": {"url": "dataTable_spanish.json"},
                    "initComplete": function (settings, json) {
                        var mainTableDiv = document.getElementById("table_content_wrapper"),
                            childDiv = mainTableDiv.childNodes[2],
                            requiredDiv = childDiv.childNodes[1];
                        childDiv.insertBefore(requiredDiv, childDiv.firstChild);
                    }
                });
            }else{
                if (response.data.status == 10002){
                    displayAlert("Atención",response.data.message,redirectLogin);
                }else{
                    displayAlert("Atención",response.data.message,doNothing);
                    $('#table_content_body').empty();
                    alquileresContratoTable = $('#table_content').dataTable({
                        "language": {"url": "dataTable_spanish.json"},
                        "initComplete": function (settings, json) {
                            var mainTableDiv = document.getElementById("table_content_wrapper"),
                                childDiv = mainTableDiv.childNodes[2],
                                requiredDiv = childDiv.childNodes[1];
                            childDiv.insertBefore(requiredDiv, childDiv.firstChild);
                        }
                    });
                }
            }
        },
        error:function(response){
            displayTwoButtonDialog("Error","Ocurrió un error al obtener los alquileres en contrato.",["Reintentar","Cancelar"],["btn btn-primary","btn btn-default"],[loadAlquileresContraro,doNothing]);
        }
    });

}

/** Data Table dynamic fill **/
var doc = $(document);
doc.ready(function (){
    if (!expiredCookie(window.USER_TOKEN)){
        userProfileCallback=loadAlquileresContraro;
        setUserProfile();
    }else{
        displayAlert("Atención","Sesión no válida o expirada",redirectLogin);
    }
});

function addPropiedad(){
    window.location.href="nuevo_alquiler_contrato.php";
}