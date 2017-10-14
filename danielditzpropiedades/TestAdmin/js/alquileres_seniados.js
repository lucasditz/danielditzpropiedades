/**
 * Created by Martin on 17/01/2017.
 */
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

    window.location.href="ver_alquiler_disponible.php";
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
                    postTable.fnDeleteRow(row.closest("tr").get(0));
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

    window.location.href="edit_alquiler_disponible.php";
}

/** Data Table dynamic fill **/
var doc = $(document);
doc.ready(function (){
    function loadAlquileresDisponibles(){
        var userToken=getCookie(window.USER_TOKEN);
        var url=window.base_url+window.ws_alquileres_disponibles;
        $.ajax({
            url: url,
            type: 'post',
            headers: {'X-Auth':userToken},
            dataType: 'json',
            success: function (response){
                $('#table_content_body').empty();
                $.each(response.data.propiedades, function () {
                    var id=this.id;
                    // Direccion
                    var direccion=this.direccion.calle+' '+this.direccion.nro;
                    if (this.direccion.piso != null)
                        direccion+=' Piso: ' + this.direccion.piso;
                    if (this.direccion.dpto != null)
                        direccion+=' Dto: '+this.direccion.dpto;
                    //Propietario
                    var propietario=this.contacto.apellido + ", "+ this.contacto.nombre;
                    var dataTable= '<tr role="row" class="odd" data-id='+id+'><td><img id="img-alquileres" src="images/inbox.png"</img></td>' +
                        '<td><p id="dir-alquileres">'+direccion+'</p><p id="prop-alquileres">Contacto: '+propietario+'</p><p id="valor-alquileres">Valor: '+this.valor+'</p></td>' +
                        '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-eye fa-2x actionImage" data-page="ver_alquileres_disponibles.php" onclick="verPropiedad($(this),$(this).parent().parent());"></i></td>' +
                        '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-edit fa-2x actionImage" data-page="Alquileres/edit_alquileres_disponibles.php" onclick="editPropiedad($(this),$(this).parent().parent());"></i></td>' +
                        '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-times-circle fa-2x actionImage" onclick="deletePropiedad($(this).parent().parent());"></i></td></tr>';
                    $('#table_content_body').append(dataTable);

                });
                $('#table_content').dataTable({
                    "language": {"url": "dataTable_spanish.json"},
                    "initComplete": function(settings, json) {
                        var mainTableDiv=document.getElementById("table_content_wrapper"),
                            childDiv = mainTableDiv.childNodes[2],
                            requiredDiv = childDiv.childNodes[1];
                        childDiv.insertBefore(requiredDiv,childDiv.firstChild);
                    }
                });
            },
            error:function(response){
                //document.getElementById("image_load_categoria").style.display="none";
                //$('#table_content').empty();
            }
        });

    }
    loadAlquileresDisponibles();
});