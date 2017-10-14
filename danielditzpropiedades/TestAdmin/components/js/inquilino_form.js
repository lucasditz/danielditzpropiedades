/**
 * Created by Martin on 16/06/2017.
 */

var searchInquilino=false;
var selectedInquilino=undefined;

$(document).ready(function() {
});

function doNothing(){}

function loadInquilinoData(id){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_persona_get;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: {'id':id},
        dataType: 'json',
        success: function (response){
            selectedInquilino={
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

            document.getElementById("nombreInquilino_view").value=selectedInquilino.nombre;
            document.getElementById("apellidoInquilino_view").value=selectedInquilino.apellido;
            document.getElementById("dniInquilino_view").value=selectedInquilino.dni;
            document.getElementById("fNacimientoInquilino_view").value=selectedInquilino.fecha_nac;
            document.getElementById("telefonoInquilino_view").value=selectedInquilino.telefono;
            document.getElementById("celularInquilino_view").value=selectedInquilino.celular;

            document.getElementById("calleInquilino_view").value=selectedInquilino.direccion.calle;
            document.getElementById("nroInquilino_view").value=selectedInquilino.direccion.nro;
            document.getElementById("pisoInquilino_view").value=selectedInquilino.direccion.piso;
            document.getElementById("dptoInquilino_view").value=selectedInquilino.direccion.dpto;
            document.getElementById("ciudadInquilino_view").value=selectedInquilino.direccion.ciudad;
            document.getElementById("provinciaInquilino_view").value=selectedInquilino.direccion.provincia;

            $('#inquilinoViewContent').css("display","inline");
        },
        error:function(){
            bootbox.dialog({
                title: "Error",
                message: "Ocurrió un error al cargar los datos del inquilino.",
                buttons: {
                    success: {
                        label:"Reintentar",
                        className: "btn btn-primary",
                        callback: function() {
                            loadInquilinoData(id);
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

function openCloseInquilinoSearchPanel(){
    var $BOX_PANEL = $("#minimizeInquilinoPanel").closest('.x_panel'),
        $ICON = $("#minimizeInquilinoPanel").find('i'),
        $BOX_CONTENT = $BOX_PANEL.find('.x_content:first');

    if ($ICON.hasClass( "fa-chevron-down" ))
        $ICON.toggleClass('fa-chevron-down fa-chevron-up');

    $BOX_CONTENT.slideDown();
    $BOX_PANEL.css('height', 'auto');
    fixHeightJS();

    var myNode = document.getElementById("inquilinoSearchModalBody");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.firstChild);
    }

    $('#inquilinoSearchModalBody').load("components/person_form.php");
    setOnSelectedPersonCallback(onSelectedInquilinoClick);

    loadPersonasRegistradas();
}

$("#inquilinoSearchModal").on("hidden.bs.modal", function () {
    var myNode = document.getElementById("inquilinoSearchModalBody");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.firstChild);
    }
});

var onSelectedInquilinoClick = function(selectedPerson){
    if (selectedPerson != undefined){
        /** Datos Inquilino **/
        document.getElementById("nombreInquilino_view").value=selectedPerson.nombre;
        document.getElementById("apellidoInquilino_view").value=selectedPerson.apellido;
        document.getElementById("dniInquilino_view").value=selectedPerson.dni;
        document.getElementById("fNacimientoInquilino_view").value=selectedPerson.fecha_nac;
        selectedPerson.telefono.nro!=null?document.getElementById("telefonoPropietario_view").value=selectedPerson.telefono.nro:"";
        selectedPerson.celular.nro!=null?document.getElementById("celularPropietario_view").value=selectedPerson.celular.nro:"";

        document.getElementById("calleInquilino_view").value=selectedPerson.direccion.calle;
        document.getElementById("nroInquilino_view").value=selectedPerson.direccion.nro;
        document.getElementById("pisoInquilino_view").value=selectedPerson.direccion.piso;
        document.getElementById("dptoInquilino_view").value=selectedPerson.direccion.dpto;
        document.getElementById("ciudadInquilino_view").value=selectedPerson.direccion.ciudad;
        document.getElementById("provinciaInquilino_view").value=selectedPerson.direccion.provincia;

        $('#inquilinoViewContent').css("display","inline");

        selectedInquilino=selectedPerson;
    }

    searchInquilino=false;

    $('#inquilinoSearchModal').modal('toggle');
    $('#wizard').smartWizard("fixHeight");
}