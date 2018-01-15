/**
 * Created by Martin on 02/08/2017.
 */

var personasTable=undefined;

$(document).ready(function() {
    if (!expiredCookie(window.USER_TOKEN)){
        userProfileCallback=loadPersonasRegistradas;
        setUserProfile();
    }else{
        displayAlert("Atención","Sesión no válida o expirada",redirectLogin);
    }
});


var personas=[];
function loadPersonasRegistradas() {
    searchPerson=true;
    nuevaPersonaClick=false;

    var userToken = getCookie(window.USER_TOKEN);
    var url = window.base_url + window.ws_personas;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth': userToken},
        dataType: 'json',
        success: function (response) {
            if (response.data.status == 10001) {
                personas=response.data.personas;
                $('#table_content_body_personas').empty();
                var i=0;
                console.log(response.data.personas);
                $.each(response.data.personas, function () {
                    var id = this.id;
                    // Nombre competo
                    var nombre = this.nombre + ' ' + this.apellido;
                    var dataTable = '<tr role="row" class="odd" style="text-align:left;" data-id='+ id +' data-index=' + i + '><td>'+nombre+'</td><td>'+this.dni+'</td><td>'+this.fecha_nac+'</td>' +
                    '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-eye fa-2x actionImage" onclick="showperson($(this),$(this).parent().parent());" data-toggle="tooltip" title="Ver"></i></td>' +
                    '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-edit fa-2x actionImage"  onclick="editPerson($(this),$(this).parent().parent());" data-toggle="tooltip" title="Editar"></i></td>' +
                    '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-times-circle fa-2x actionImage" onclick="deletePerson($(this).parent().parent());" data-toggle="tooltip" title="Eliminar"></i></td></tr>';
                    $('#table_content_body_personas').append(dataTable);
                    i++;
                });

                if ( !$.fn.dataTable.isDataTable( '#table_content_personas' ) ) {
                    personasTable=$('#table_content_personas').dataTable(
                        {   "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [1] }],
                            "language": {"url": "dataTable_spanish.json"},
                            "initComplete": function(settings, json) {
                                var mainTableDiv=document.getElementById("table_content_personas_wrapper"),
                                    childDiv = mainTableDiv.childNodes[2],
                                    requiredDiv = childDiv.childNodes[1];
                                childDiv.insertBefore(requiredDiv,childDiv.firstChild);
                            }
                        }
                    );
                }
            }else{
                if (response.data.status == 10002){
                    displayAlert("Atención",response.data.message,redirectLogin);
                }else{
                    displayAlert("Atención",response.data.message,doNothing);
                    $('#table_content_body_personas').empty();
                    var dataTable= '<tr role="row" class="odd"></tr>';
                    $('#table_content_body_personas').append(dataTable);
                }
            }
        },
        error: function () {
            displayTwoButtonDialog("Error","Ocurrió un error al obtener los personas.",["Reintentar","Cancelar"],["btn btn-primary","btn btn-default"],[loadPersonasRegistradas,doNothing]);
        }
    });
}

function addPersona(){
    window.location.href="nueva_persona.php";
}

function showperson(page,row){
    row.addClass('selected').siblings().removeClass("selected");
    var id = row.attr('data-id');
    window.location.href="personas_ver.php?id="+id;
}

function editPerson(page,row){
    row.addClass('selected').siblings().removeClass("selected");
    var id = row.attr('data-id');
    window.location.href="personas_edit.php?id="+id;
}

/** Borrar Propiedad**/
function deletePerson(row){
    row.addClass('selected').siblings().removeClass("selected");
    var id = row.attr('data-id');
    bootbox.dialog({
        title: "Eliminar Persona",
        message: "¿Está seguro que desea eliminar la persona?",
        buttons: {
            success: {
                label: "Aceptar",
                className: "btn-success",
                callback: function () {
                    alert("borrar persona lógicamente");
                    var userToken=getCookie(window.USER_TOKEN);
                    /* $.ajax({
                     url: window.base_url+window.ws_persona_remove,
                     type: 'post',
                     dataType: 'json',
                     headers: {'X-Auth':userToken},
                     data: {'id_persona': id},
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
                    personasTable.fnDeleteRow(row.closest("tr").get(0));
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