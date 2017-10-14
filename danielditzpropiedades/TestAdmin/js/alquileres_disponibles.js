/**
 * Created by Martin on 13/09/2016.
 */

var alquileresDisponiblesTable=undefined;
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

function doNothing(){}

function verPropiedad(page,row){
    row.addClass('selected').siblings().removeClass("selected");
    var id = row.attr('data-id');

    window.location.href="alquiler_disponible_ver.php?id="+id;
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
                    var userToken=getCookie("userToken");
                   /* $.ajax({
                        url: window.base_url+window.ws_post_remove,
                        type: 'post',
                        dataType: 'json',
                        headers: {'X-Auth':userToken},
                        data: {'id': id},
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
                    alquileresDisponiblesTable.fnDeleteRow(row.closest("tr").get(0));
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
    window.location.href="alquiler_disponible_edit.php?id="+id;
}

function loadAlquileresDisponibles(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_alquileres_disponibles;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        dataType: 'json',
        success: function (response){
            if (response.data.status == 10001) {
                $('#table_content_body').empty();
                $.each(response.data.propiedades, function () {
                    var id=this.id;
                    // Direccion
                    var direccion=this.direccion.calle+' '+this.direccion.nro;
                    if (this.direccion.piso != "")
                        direccion+=' Piso: ' + this.direccion.piso;
                    if (this.direccion.dpto != "")
                        direccion+=' Dto: '+this.direccion.dpto;
                    //Propietario
                    var propietario=this.propietario.apellido + ", "+ this.propietario.nombre;
                    var dataTable= '<tr role="row" class="odd" data-id='+id+'><td><img id="img-alquileres" src="images/inbox.png"</img></td>' +
                        '<td><p id="dir-alquileres">'+direccion+'</p><p id="prop-alquileres"><u><b>Propietario:</b></u> '+propietario+'</p><p id="valor-alquileres"><u><b>Valor:</b></u> '+this.valor+'</p></td>' +
                        '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-eye fa-2x actionImage" onclick="verPropiedad($(this),$(this).parent().parent());"></i></td>' +
                        '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-edit fa-2x actionImage" onclick="editPropiedad($(this),$(this).parent().parent());"></i></td>' +
                        '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-times-circle fa-2x actionImage" onclick="deletePropiedad($(this).parent().parent());"></i></td></tr>';
                    $('#table_content_body').append(dataTable);

                });
                alquileresDisponiblesTable=$('#table_content').dataTable({
                    "language": {"url": "dataTable_spanish.json"},
                    "initComplete": function(settings, json) {
                        var mainTableDiv=document.getElementById("table_content_wrapper"),
                            childDiv = mainTableDiv.childNodes[2],
                            requiredDiv = childDiv.childNodes[1];
                        childDiv.insertBefore(requiredDiv,childDiv.firstChild);
                    }
                });
            }
            else{
                if (response.data.status == 10002){
                    displayAlert("Atención",response.data.message,doNothing);
                    window.location ="login.php";
                    createCookie(window.USER_TOKEN,"",-1);
                }else{
                    displayAlert("Error",response.data.message,doNothing);
                }
            }
        },
        error:function(response){
            displayTwoButtonDialog("Error","Ocurrió un error al obtener los alquileres disponibles.",["Reintentar","Cancelar"],["btn btn-primary","btn btn-default"],[loadAlquileresDisponibles,doNothing]);
        }
    });

}

/** Data Table dynamic fill **/
var doc = $(document);
doc.ready(function (){
    if (!expiredCookie("USER_TOKEN")){
        loadAlquileresDisponibles();
    }else{
        window.location.href="login.php";
    }

});

function addPropiedad(){
    window.location.href="nuevo_alquiler.php";
}