/**
 * Created by Martin on 02/08/2017.
 */

var directionsInputs=undefined;
var directionValues=[];

$(document).ready(function() {
    if (!expiredCookie(window.USER_TOKEN)){
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

function closePersonDatePicker(){
    $('#fNacimientoPersona').daterangepicker('hide');
    $('#fNacimientoPersona').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,

        format: 'DD/MM/YYYY'
    });
}

function goToPersonasList(){
    window.location.href="personas.php";
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
            if (response.data.status == 10003) {
                saveNewPerson();
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
            var message= "No fue posible verificar si ya existe una persona registrada con el mismo D.N.I.. Verifique su conexión a internet y vuelva a intentarlo";
            displayAlert("Error",message,doNothing);
        }
    });
}

/** save new Person and all data **/
function saveNewPerson(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_persona_add;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: {
            'nombre':document.getElementById("nombrePersona_input").value,
            'apellido':document.getElementById("apellidoPersona_input").value,
            'dni':document.getElementById("dniPersona_input").value,
            'fecha_nac':document.getElementById("fNacimientoPersona").value,
            'telefono':document.getElementById("telefonoPersona_input").value,
            'celular':document.getElementById("celularPersona_input").value,
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