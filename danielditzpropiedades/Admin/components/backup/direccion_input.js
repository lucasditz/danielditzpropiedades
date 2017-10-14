/**
 * Created by Martin on 08/12/2016.
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

$("#calle").on("keyup", function(event) {
    directionValues=[];
    if (directionsInputs != undefined) {
        for (var i = 0; i < directionsInputs.Calles.length; i++) {
            directionValues.push(directionsInputs.Calles[i].calle);
        }
        checkValueAlredyInput($('#calleListid'), directionValues, $("#calle").val());
    }
});


$("#nro").on("keyup", function(event) {
    directionValues=[];
    if (directionsInputs != undefined) {
        for (var i = 0; i < directionsInputs.Nros.length; i++) {
            directionValues.push(directionsInputs.Nros[i].nro);
        }
        checkValueAlredyInput($('#nroListid'), directionValues, $("#nro").val());
    }
});

function checkDirectionEmptyInput(){
    if ($('#calle').val() == "")
        return("Debe ingresar el nombre de la calle");
    if ($('#nro').val() == "")
        return("Debe ingresar el nº de la calle");
    if ($('#ciudad').val() == "")
        return("Debe ingresar el nombre de la ciudad");
    return "";
}