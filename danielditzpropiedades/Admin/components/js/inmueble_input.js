/**
 * Created by Martin on 15/06/2017.
 */

var directionsInputs=undefined;
var directionValues=[];

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

getDirections();

function checkValueAlredyInput(inputList,values,currentInput){
    inputList.empty();
    for (var i=0;i< values.length;i++) {
        if (values[i].toLowerCase().startsWith(currentInput.toLowerCase()))
            inputList.append('<option value="'+values[i]+'"></option>');
    }
}

$("#calleInmueble").on("keyup", function(event) {
    directionValues=[];
    if (directionsInputs != undefined) {
        for (var i = 0; i < directionsInputs.Calles.length; i++) {
            directionValues.push(directionsInputs.Calles[i].calle);
        }
        checkValueAlredyInput($('#calleListid'), directionValues, $("#calleInmueble").val());
    }
});


$("#nroInmueble").on("keyup", function(event) {
    directionValues=[];
    if (directionsInputs != undefined) {
        for (var i = 0; i < directionsInputs.Nros.length; i++) {
            directionValues.push(directionsInputs.Nros[i].nro);
        }
        checkValueAlredyInput($('#nroListid'), directionValues, $("#nroInmueble").val());
    }
});

//Check inmueble not empty and not register
function checkInmuebleData(currentInmuebleId){
    var dfd = new $.Deferred();

    var message=checkInmuebleEmptyInput();
    if (message == "") {
        $.when(checkInmuebleNotRegister(currentInmuebleId)).done(function(response){
            if (response.data.status == 10001) {
                if (currentInmuebleId == undefined || (currentInmuebleId != undefined && currentInmuebleId != response.data.idInmueble.id)){
                    displayAlert("Atención", response.data.message, doNothing);
                    dfd.resolve(false);
                }else{
                    dfd.resolve(true);
                }
            }
            else{
                if (response.data.status == 10002){
                    displayAlert("Atención",response.data.message,doNothing);
                    window.location ="login.php";
                    createCookie(window.USER_TOKEN,"",-1);
                }else{
                    dfd.resolve(true);
                }
            }
        }).fail(function(){
            var message= "No fue posible verificar la propiedad ingresada. Verifique su conexión a internet y vuelva a intentarlo";
            displayAlert("Error",message,doNothing);
            dfd.resolve(false);
        });
    }else{
        displayAlert("Atención",message,doNothing);
        dfd.resolve(false);
    }

    return dfd.promise();
}

function checkInmuebleEmptyInput(){
    var directionResult=checkInmuebleDirectionEmptyInput();
    if (directionResult != "" || $('#valor').val() == "")
        return "Debe completar los campos obligatorios (*)";
    return "";
}

function checkInmuebleDirectionEmptyInput(){
    if ($('#calleInmueble').val() == "")
        return("Debe ingresar el nombre de la calle");
    if ($('#nroInmueble').val() == "")
        return("Debe ingresar el nº de la calle");
    if ($('#ciudadInmueble').val() == "")
        return("Debe ingresar el nombre de la ciudad");
    if ($('#provinciaInmueble').val() == "")
        return("Debe ingresar el nombre de la provincia");
    return "";
}

function checkInmuebleNotRegister(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_inmueble_isRegister;
    return $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth': userToken},
        data: {
            'calle': $('#calleInmueble').val(),
            'nro': $('#nroInmueble').val(),
            'piso': $('#pisoInmueble').val(),
            'dpto': $('#dptoInmueble').val(),
            'ciudad': $('#ciudadInmueble').val(),
            'provincia': $('#provinciaInmueble').val()
        },
        dataType: 'json'
    });
}