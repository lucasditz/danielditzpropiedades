/**
 * Created by Martin on 16/06/2017.
 */

var searchGarante=false;
var selectedGarante=undefined;

function loadGaranteData(id){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_persona_get;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: {'id':id},
        dataType: 'json',
        success: function (response){
            selectedGarante={
                "id":response.data.persona.id,
                "nombre":response.data.persona.nombre,
                "apellido":response.data.persona.apellido,
                "dni":response.data.persona.dni,
                "fecha_nac":response.data.persona.fecha_nac,
                "telefonoId":response.data.persona.telefono.id!=null?response.data.persona.telefono.id:"",
                "telefono":response.data.persona.telefono.nro!=null?response.data.persona.telefono.nro:"",
                "celularId":response.data.persona.celular.id!=null?response.data.persona.celular.id:"",
                "celular":response.data.persona.celular.nro!=null?response.data.persona.celular.nro:"",
                "direccion":{
                    "id":response.data.persona.direccion.id,
                    "calle":response.data.persona.direccion.calle,
                    "nro":response.data.persona.direccion.nro,
                    "piso":response.data.persona.direccion.piso,
                    "dpto":response.data.persona.direccion.dpto,
                    "ciudad":response.data.persona.direccion.ciudad,
                    "provincia":response.data.persona.direccion.provincia
                }
            };

            document.getElementById("nombreGarante_view").value=selectedGarante.nombre;
            document.getElementById("apellidoGarante_view").value=selectedGarante.apellido;
            document.getElementById("dniGarante_view").value=selectedGarante.dni;
            document.getElementById("fNacimientoGarante_view").value=selectedGarante.fecha_nac;
            document.getElementById("telefonoGarante_view").value=selectedGarante.telefono;
            document.getElementById("celularGarante_view").value=selectedGarante.celular;

            document.getElementById("calleGarante_view").value=selectedGarante.direccion.calle;
            document.getElementById("nroGarante_view").value=selectedGarante.direccion.nro;
            document.getElementById("pisoGarante_view").value=selectedGarante.direccion.piso;
            document.getElementById("dptoGarante_view").value=selectedGarante.direccion.dpto;
            document.getElementById("ciudadGarante_view").value=selectedGarante.direccion.ciudad;
            document.getElementById("provinciaGarante_view").value=selectedGarante.direccion.provincia;

            $('#garanteViewContent').css("display","inline");
        },
        error:function(){
            bootbox.dialog({
                title: "Error",
                message: "Ocurrió un error al cargar los datos del garante.",
                buttons: {
                    success: {
                        label:"Reintentar",
                        className: "btn btn-primary",
                        callback: function() {
                            loadGaranteData(id);
                        }
                    },
                    cancel: {
                        label:"Cancelar",
                        className: "btn btn-default",
                        callback: function(){
                            doNothing();
                        }
                    }
                }
            });
        }
    });
}

function openCloseGaranteSearchPanel(){
    var $BOX_PANEL = $("#minimizeGarantePanel").closest('.x_panel'),
        $ICON = $("#minimizeGarantePanel").find('i'),
        $BOX_CONTENT = $BOX_PANEL.find('.x_content:first');

    if ($ICON.hasClass( "fa-chevron-down" ))
        $ICON.toggleClass('fa-chevron-down fa-chevron-up');

    $BOX_CONTENT.slideDown();
    $BOX_PANEL.css('height', 'auto');
    fixHeightJS();

    var myNode = document.getElementById("garanteSearchModalBody");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.firstChild);
    }

    $('#garanteSearchModalBody').load("components/person_form.php");
    setOnSelectedPersonCallback(onSelectedGaranteClick);

    loadPersonasRegistradas();
}

$("#garanteSearchModal").on("hidden.bs.modal", function () {
    var myNode = document.getElementById("garanteSearchModalBody");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.firstChild);
    }
});

 var onSelectedGaranteClick = function(selectedPerson){
    if (selectedPerson != undefined){
        /** Datos Garante **/
        document.getElementById("nombreGarante_view").value=selectedPerson.nombre;
        document.getElementById("apellidoGarante_view").value=selectedPerson.apellido;
        document.getElementById("dniGarante_view").value=selectedPerson.dni;
        document.getElementById("fNacimientoGarante_view").value=selectedPerson.fecha_nac;
        selectedPerson.telefono.nro!=null?document.getElementById("telefonoGarante_view").value=selectedPerson.telefono.nro:"";
        selectedPerson.celular.nro!=null?document.getElementById("celularGarante_view").value=selectedPerson.celular.nro:"";

        document.getElementById("calleGarante_view").value=selectedPerson.direccion.calle;
        document.getElementById("nroGarante_view").value=selectedPerson.direccion.nro;
        document.getElementById("pisoGarante_view").value=selectedPerson.direccion.piso;
        document.getElementById("dptoGarante_view").value=selectedPerson.direccion.dpto;
        document.getElementById("ciudadGarante_view").value=selectedPerson.direccion.ciudad;
        document.getElementById("provinciaGarante_view").value=selectedPerson.direccion.provincia;

        $('#garanteViewContent').css("display","inline");

        selectedGarante=selectedPerson;
    }

    searchGarante=false;

    $('#wizard').smartWizard("fixHeight");
    $('#garanteSearchModal').modal('toggle');
}