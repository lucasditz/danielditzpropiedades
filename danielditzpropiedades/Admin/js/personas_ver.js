/**
 * Created by Martin on 02/08/2017.
 */

var persona=undefined;

$(document).ready(function() {
    if (!expiredCookie(window.USER_TOKEN)){
        userProfileCallback=loadPersonData;
        setUserProfile();
    }else{
        displayAlert("Atención","Sesión no válida o expirada",redirectLogin);
    }
});


function getParam(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || undefined;
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


