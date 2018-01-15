/**
 * Created by Martin on 02/08/2017.
 */

var directionsInputs=undefined;
var directionValues=[];
var persona=undefined;

$(document).ready(function() {
    if (!expiredCookie(window.USER_TOKEN)){
        userProfileCallback=loadPersonData;
        setUserProfile();
    }else{
        displayAlert("Atención","Sesión no válida o expirada",redirectLogin);
    }

    getDirections();

    $('#fNacimientoPersona').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });


});

function getDirections(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_address_input_getAll;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        dataType: 'json',
        success: function (response){

            if (response.data.status == 10001) {
                directionsInputs = response.data.inputs;
            }
        }
    });
}

function goToPersonasList(){
    window.location.href="personas.php";
}

function getParam(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || undefined;
}

function openPersonDatePicker(){
    $('#fNacimientoPersona').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
}

function loadPersonData(){
    var id=getParam("id");
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_persona_get;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: {id:id},
        dataType: 'json',
        success: function (response){
            persona=response.data.persona;
            /** Datos Inmueble **/
            document.getElementById("nombrePersona_input").value=persona.nombre;
            document.getElementById("apellidoPersona_input").value=persona.apellido;
            document.getElementById("dniPersona_input").value=persona.dni;
            document.getElementById("fNacimientoPersona").value=persona.fecha_nac;
            persona.telefono.nro!=null?document.getElementById("telefonoPersona_input").value=persona.telefono.nro:"";
            persona.celular.nro!=null?document.getElementById("celularPersona_input").value=persona.celular.nro:"";

            document.getElementById("callePersona_input").value=persona.direccion.calle;
            document.getElementById("nroPersona_input").value=persona.direccion.nro!=0?persona.direccion.nro:"";
            document.getElementById("pisoPersona_input").value=persona.direccion.piso;
            document.getElementById("dptoPersona_input").value=persona.direccion.dpto;
            document.getElementById("ciudadPersona_input").value=persona.direccion.ciudad;
            document.getElementById("provinciaPersona_input").value=persona.direccion.provincia;
        },
        error:function(){
            displayTwoButtonDialog("Error","Ocurrió un error al cargar los datos de la persona.",["Reintentar","Cancelar"],["btn btn-primary","btn btn-default"],[loadPersonData,doNothing]);
        }
    });
}

function checkDatosPersona(){
    var message=checkDataNotEmpty();
    if (message == "")
        checkPersonNotRegister();
    else{
        displayAlert("Atención",message,doNothing);
    }
}

function checkDirectionComplete(){
    if (document.getElementById("callePersona_input").value != "" && (document.getElementById("nroPersona_input").value == "" ||
        document.getElementById("ciudadPersona_input").value == "" || document.getElementById("provinciaPersona_input").value == ""))
        return false;

    if (document.getElementById("nroPersona_input").value != "" && (document.getElementById("callePersona_input").value == "" ||
        document.getElementById("ciudadPersona_input").value == "" || document.getElementById("provinciaPersona_input").value == ""))
        return false;

    if (document.getElementById("ciudadPersona_input").value != "" && (document.getElementById("callePersona_input").value == "" ||
        document.getElementById("nroPersona_input").value == "" || document.getElementById("provinciaPersona_input").value == ""))
        return false;

    if (document.getElementById("provinciaPersona_input").value != "" && (document.getElementById("callePersona_input").value == "" ||
        document.getElementById("nroPersona_input").value == "" || document.getElementById("ciudadPersona_input").value == ""))
        return false;

    return true;
}

function checkDataNotEmpty(){
    if (document.getElementById("nombrePersona_input").value == "" || document.getElementById("apellidoPersona_input").value == "" ||
        document.getElementById("dniPersona_input").value == "" ){
        return "Debe completar los campos obligatorios (*)";
    }else{
        if (!checkDirectionComplete()){
            return "La dirección no es obligatoria, pero no se puede ingresar incompleta. "+
                "Los siguientes campos son obligatorios para ingresar correctamente una dirección: <br>"+
                "* Calle <br>"+
                "* Nro <br>"+
                "* Ciudad <br>"+
                "* Provincia";
        }

    }
    return "";
}

function checkPersonNotRegister(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_persona_isRegister;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: { 'dni': document.getElementById("dniPersona_input").value},
        dataType: 'json',
        success: function (response){
            if (response.data.status == 10001) {
                if (persona.dni != document.getElementById("dniPersona_input").value) {
                    displayAlert("Error", response.data.message, doNothing);
                }else {
                    saveEditedPerson();
                }
            }
            else{
                if (response.data.status == 10002){
                    displayAlert("Atención",response.data.message,doNothing);
                    window.location ="login.php";
                    createCookie(window.USER_TOKEN,"",-1);
                }else{
                    savePerson();
                }
            }
        },
        error: function(){
            var message= "No fue posible verificar si ya existe una persona registrada con el mismo D.N.I.. Verifique su conexión a internet y vuelva a intentarlo";
            displayAlert("Error",message,doNothing);
        }
    });
}

/** save new Person and all data **/
function saveEditedPerson(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_persona_edit;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: {
            'id_persona': persona.id,
            'nombre':document.getElementById("nombrePersona_input").value,
            'apellido':document.getElementById("apellidoPersona_input").value,
            'dni':document.getElementById("dniPersona_input").value,
            'fecha_nac':document.getElementById("fNacimientoPersona").value,
            'telefonoId': persona.telefono.id!=null?persona.telefono.id:"",
            'telefono':document.getElementById("telefonoPersona_input").value,
            'celularId': persona.celular.id!=null?persona.celular.id:"",
            'celular':document.getElementById("celularPersona_input").value,
            'id_direccion': persona.direccion.id,
            'calle': document.getElementById("callePersona_input").value,
            'nro': parseInt(document.getElementById("nroPersona_input").value),
            'piso': document.getElementById("pisoPersona_input").value,
            'dpto': document.getElementById("dptoPersona_input").value,
            'ciudad': document.getElementById("ciudadPersona_input").value,
            'provincia': document.getElementById("provinciaPersona_input").value,
            'id_usuario':window.profileID
        },
        dataType: 'json',
        success: function (response){
            if (response.data.status == 10001) {
                displayAlert("Operación exitosa",response.data.message,goToPersonasList);
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
        error: function(){
            var message= "No fue posible registrar la nueva propiedad. Verifique su conexión a internet y vuelva a intentarlo";
            displayAlert("Error",message,doNothing);
        }
    });
}