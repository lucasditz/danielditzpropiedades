/**
 * Created by Martin on 16/06/2017.
 */

var searchPropietario=false;
var selectedPropietario=undefined;

$(document).ready(function() {
});

function doNothing(){}

function loadPropietarioData(id){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_persona_get;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: {'id':id},
        dataType: 'json',
        success: function (response){
            console.log(JSON.stringify(response.data.persona));
            selectedPropietario={
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
                    "id_direccion": response.data.persona.direccion.id,
                    "calle":response.data.persona.direccion.calle,
                    "nro":response.data.persona.direccion.nro,
                    "piso":response.data.persona.direccion.piso,
                    "dpto":response.data.persona.direccion.dpto,
                    "ciudad":response.data.persona.direccion.ciudad,
                    "provincia":response.data.persona.direccion.provincia
                }
            };

            document.getElementById("nombrePropietario_view").value=selectedPropietario.nombre;
            document.getElementById("apellidoPropietario_view").value=selectedPropietario.apellido;
            document.getElementById("dniPropietario_view").value=selectedPropietario.dni;
            document.getElementById("fNacimientoPropietario_view").value=selectedPropietario.fecha_nac;
            document.getElementById("telefonoPropietario_view").value=selectedPropietario.telefono;
            document.getElementById("celularPropietario_view").value=selectedPropietario.celular;

            document.getElementById("callePropietario_view").value=selectedPropietario.direccion.calle;
            document.getElementById("nroPropietario_view").value=selectedPropietario.direccion.nro;
            document.getElementById("pisoPropietario_view").value=selectedPropietario.direccion.piso;
            document.getElementById("dptoPropietario_view").value=selectedPropietario.direccion.dpto;
            document.getElementById("ciudadPropietario_view").value=selectedPropietario.direccion.ciudad;
            document.getElementById("provinciaPropietario_view").value=selectedPropietario.direccion.provincia;

            $('#propietarioViewContent').css("display","inline");
        },
        error:function(){
            bootbox.dialog({
                title: "Error",
                message: "Ocurrió un error al cargar los datos del propietario.",
                buttons: {
                    success: {
                        label:"Reintentar",
                        className: "btn btn-primary",
                        callback: function() {
                            loadPropietarioData(id);
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


function openClosePropietarioSearchPanel(){
    var myNode = document.getElementById("propietarioSearchModalBody");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.firstChild);
    }

    $('#propietarioSearchModalBody').load("components/person_form.php");
    setOnSelectedPersonCallback(onSelectedPropietarioClick);

    loadPersonasRegistradas();
}

$("#propietarioSearchModal").on("hidden.bs.modal", function () {
    var myNode = document.getElementById("propietarioSearchModalBody");
    while (myNode.firstChild) {
        myNode.removeChild(myNode.firstChild);
    }
});

function onSelectedPropietarioClick(selectedPerson){
    if (selectedPerson != undefined){
        /** Datos Propietario **/
        document.getElementById("nombrePropietario_view").value=selectedPerson.nombre;
        document.getElementById("apellidoPropietario_view").value=selectedPerson.apellido;
        document.getElementById("dniPropietario_view").value=selectedPerson.dni;
        document.getElementById("fNacimientoPropietario_view").value=selectedPerson.fecha_nac;
        selectedPerson.telefono.nro!=null?document.getElementById("telefonoPropietario_view").value=selectedPerson.telefono.nro:"";
        selectedPerson.celular.nro!=null?document.getElementById("celularPropietario_view").value=selectedPerson.celular.nro:"";

        document.getElementById("callePropietario_view").value=selectedPerson.direccion.calle;
        document.getElementById("nroPropietario_view").value=selectedPerson.direccion.nro;
        document.getElementById("pisoPropietario_view").value=selectedPerson.direccion.piso;
        document.getElementById("dptoPropietario_view").value=selectedPerson.direccion.dpto;
        document.getElementById("ciudadPropietario_view").value=selectedPerson.direccion.ciudad;
        document.getElementById("provinciaPropietario_view").value=selectedPerson.direccion.provincia;

        $('#fNacimientoPropietario_view').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_1",
            showDropdowns: true,
            format: 'DD/MM/YYYY'
        });

        $('#propietarioViewContent').css("display","inline");

        selectedPropietario=selectedPerson;
    }

    searchPropietario=false;

    $('#propietarioSearchModal').modal('toggle');
    $('#wizard').smartWizard("fixHeight");
}