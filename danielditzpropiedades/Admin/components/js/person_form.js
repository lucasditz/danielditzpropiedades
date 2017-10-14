/**
 * Created by Martin on 23/06/2017.
 */

/**
 *
  * -> selectPerson(selectedPerson)
 *  The button "personaSelectBtn" call a function selectPerson(). This function call a listener called onSelectedPersonClick.
 *
 *  onSelectedPersonClick: function must be define in js parent. It recive as param the selected person
 *

 */

var searchPerson=true;
var nuevaPersonaClick=false;

var directionsInputs=undefined;
var directionValues=[];

var onSelectedPersonClick=undefined;

$(document).ready(function() {
    getDirections();
});

function closeAlertMessage(){
    setTimeout(function(){
        $('body').addClass('modal-open');
    },1000);

}

function setOnSelectedPersonCallback(callback){
    onSelectedPersonClick=callback;
}

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

var personas=[];
function loadPersonasRegistradas() {
    searchPerson=true;
    nuevaPersonaClick=false;

    var userToken = getCookie(window.USER_TOKEN);
    var url = window.base_url + window.ws_personas;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth': userToken},
        dataType: 'json',
        success: function (response) {
            personas=response.data.personas;
            $('#table_content_body_personas').empty();
            var i=0;
            $.each(response.data.personas, function () {
                var id = this.id;
                // Nombre competo
                var nombre = this.nombre + ' ' + this.apellido;
                var dataTable = '<tr role="row" class="odd" style="text-align:left;" data-id='+ id +' data-index=' + i + '><td>'+nombre+'</td>' +
                    '<td style="text-align: center;vertical-align: middle;"><i class="fa fa-eye fa-2x actionImage"  onclick="showperson($(this).parent().parent());"></i></td></tr>';
                $('#table_content_body_personas').append(dataTable);
                i++;
            });

            if ( !$.fn.dataTable.isDataTable( '#table_content_personas' ) ) {
                $('#table_content_personas').dataTable(
                    {   "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [1] }],
                        "order": [[ 0, "desc" ]],
                        "language": {"url": "dataTable_spanish.json"},
                        "initComplete": function(settings, json) {
                            var mainTableDiv=document.getElementById("table_content_personas_wrapper"),
                                childDiv = mainTableDiv.childNodes[2],
                                requiredDiv = childDiv.childNodes[1];
                            childDiv.insertBefore(requiredDiv,childDiv.firstChild);
                        }
                    }
                );
            }
            $('#wizard').smartWizard("fixHeight");
        },
        error: function (response) {
            //document.getElementById("image_load_categoria").style.display="none";
            //$('#table_content').empty();
        }
    });
}

function showperson(row){
    var id= row.attr('data-id');
    var index=row.attr('data-index');
    verPersona(id,index);
}

var selectedPerson=undefined;
function verPersona(_id,_index){
    var index= _index;
    selectedPerson=personas[index];
    nuevaPersonaClick=false;
    /** Datos Persona **/
    document.getElementById("nombrePersona_view").value=selectedPerson.nombre;
    document.getElementById("apellidoPersona_view").value=selectedPerson.apellido;
    document.getElementById("dniPersona_view").value=selectedPerson.dni;
    document.getElementById("fNacimientoPersona_view").value=selectedPerson.fecha_nac;
    selectedPerson.telefono.nro!=null?document.getElementById("telefonoPersona_view").value=selectedPerson.telefono.nro:"";
    selectedPerson.celular.nro!=null?document.getElementById("celularPersona_view").value=selectedPerson.celular.nro:"";

    document.getElementById("callePersona_view").value=selectedPerson.direccion.calle;
    document.getElementById("nroPersona_view").value=selectedPerson.direccion.nro;
    document.getElementById("pisoPersona_view").value=selectedPerson.direccion.piso;
    document.getElementById("dptoPersona_view").value=selectedPerson.direccion.dpto;
    document.getElementById("ciudadPersona_view").value=selectedPerson.direccion.ciudad;
    document.getElementById("provinciaPersona_view").value=selectedPerson.direccion.provincia;

    $('#personaSearchTitle').text('Ver Persona');
    $('#personaSearchBtn').text('Buscar Persona');

    $('#personaSearchContent').css("display","none");
    $('#personaViewContent').css("display","inline");

    searchPerson=false;
    nuevaPersonaClick=false;
    fixHeightJS();
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

/** get persona input form **/
function getPersonaInputForm(){
    //Add new person
    if (searchPerson) {
        clearNewPersonForm();
        $('#personaSearchTitle').text('Nueva Persona');
        $('#personaSearchBtn').text('Buscar Persona');

        $('#personaSearchContent').css("display","none");
        $('#personaNewContent').css("display","inline");

        $('#fNacimientoPersona').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_1",
            showDropdowns: true,

            format: 'DD/MM/YYYY'
        });

        searchPerson=false;
        nuevaPersonaClick=true;
        $('#wizard').smartWizard("fixHeight");
    }else{//Back to search person
        //selectedPerson=undefined;
        if ( $('#personaViewContent').css("display") !="none"){
            $('#personaSearchContent').css("display","inline");
            $('#personaViewContent').css("display","none");
        }

        searchPerson=true;
        nuevaPersonaClick=false;
        $('#personaSearchTitle').text('Seleccionar Persona');
        $('#personaSearchBtn').text('Nueva Persona');

        $('#personaSearchContent').css("display","inline");
        $('#personaNewContent').css("display","none");

        loadPersonasRegistradas();
    }
}


function checkPersonaData(){
    var message=checkPersonaEmptyInput();
    if (message == "") {
        checkPersonaNotRegister();
    }else{
        displayAlert("Atención",message,closeAlertMessage);
    }
}

function checkDirectionComplete(){
    if (document.getElementById("callePersona").value != "" && (document.getElementById("nroPersona").value == "" ||
        document.getElementById("ciudadPersona").value == "" || document.getElementById("provinciaPersona").value == ""))
        return false;

    if (document.getElementById("nroPersona").value != "" && (document.getElementById("callePersona").value == "" ||
        document.getElementById("ciudadPersona").value == "" || document.getElementById("provinciaPersona").value == ""))
        return false;

    if (document.getElementById("ciudadPersona").value != "" && (document.getElementById("callePersona").value == "" ||
        document.getElementById("nroPersona").value == "" || document.getElementById("provinciaPersona").value == ""))
        return false;

    if (document.getElementById("provinciaPersona").value != "" && (document.getElementById("callePersona").value == "" ||
        document.getElementById("nroPersona").value == "" || document.getElementById("ciudadPersona").value == ""))
        return false;

    return true;
}

function checkPersonaEmptyInput(){
    if ($('#nombrePersona').val() == "")
        return("Debe ingresar el nombre de la persona");
    if ($('#apellidoPersona').val() == "")
        return("Debe ingresar el apellido de la persona");
    if ($('#dniPersona').val() == "")
        return("Debe ingresar el D.N.I. de la persona");

    if (!checkDirectionComplete()){
        return "La dirección no es obligatoria, pero no se puede ingresar incompleta. "+
            "Los siguientes campos son obligatorios para ingresar correctamente una dirección: <br>"+
            "* Calle <br>"+
            "* Nro <br>"+
            "* Ciudad <br>"+
            "* Provincia";
    }

    return "";
}

function checkPersonaNotRegister(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_persona_isRegister;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: {'dni': $('#dniPersona').val()},
        dataType: 'json',
        success: function (response){
            if (response.data.status == 10001) {
                displayAlert("Atención",response.data.message,closeAlertMessage);
            }
            else{
                if (response.data.status == 10002){
                    displayAlert("Atención",response.data.message,closeAlertMessage);
                    window.location ="login.php";
                    createCookie(window.USER_TOKEN,"",-1);
                }else{
                    savePersona();
                }
            }
        },
        error: function(){
            var message= "No fue posible verificar la persona ingresada. Verifique su conexión a internet y vuelva a intentarlo";
            displayAlert("Atención",message,closeAlertMessage);
        }
    });
}

function clearNewPersonForm(){
    $('#nombrePersona').val("");
    $('#apellidoPersona').val("");
    $('#dniPersona').val("");
    $('#fNacimientoPersona').val("");
    $('#telefonoPersona').val("");
    $('#celularPersona').val("");
    $('#callePersona').val("");
    $('#nroPersona').val("");
    $('#pisoPersona').val("");
    $('#dptoPersona').val("");
    $('#ciudadPersona').val("");
    $('#provinciaPersona').val("");
}

function savePersona(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+ws_persona_add;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: { 'nombre': $('#nombrePersona').val(), 'apellido': $('#apellidoPersona').val(), 'dni': $('#dniPersona').val(),
            'fecha_nac': $('#fNacimientoPersona').val(), 'telefono': $('#telefonoPersona').val(), 'celular': $('#celularPersona').val(),
            'calle': $('#callePersona').val(), 'nro': $('#nroPersona').val(), 'piso': $('#pisoPersona').val(), 'dpto': $('#dptoPersona').val(),
            'ciudad': $('#ciudadPersona').val(), 'provincia': $('#provinciaPersona').val(), 'id_usuario': window.profileID},
        dataType: 'json',
        success: function (response){
            if (response.data.status == 10001) {

                displayAlert("Operación exitosa",response.data.message,closeAlertMessage);
                var persona= {
                    'id': response.data.persona,
                    'nombre':$('#nombrePersona').val(),
                    'apellido':$('#apellidoPersona').val(),
                    'dni':$('#dniPersona').val(),
                    'fecha_nac':$('#fNacimientoPersona').val(),
                    'telefono':{
                        nro:$('#telefonoPersona').val()
                    },
                    'celular':{
                        nro:$('#celularPersona').val()
                    },
                    'direccion':{
                        'calle':$('#callePersona').val(),
                        'nro':$('#nroPersona').val(),
                        'piso':$('#pisoPersona').val(),
                        'dpto':$('#dptoPersona').val(),
                        'ciudad':$('#ciudadPersona').val(),
                        'provincia':$('#provinciaPersona').val()
                    }
                };
                personas.push(persona);
                $('#personaNewContent').css("display","none");
                verPersona(response.data.persona,personas.length-1);
            }
            else{
                if (response.data.status == 10002){
                    displayAlert("Atención",response.data.message,null);
                    window.location ="login.php";
                    createCookie(window.USER_TOKEN,"",-1);
                }else{
                    displayAlert("Error",response.data.message,closeAlertMessage);
                }
            }
        },
        error: function(){
            var message= "No fue posible registrar la nueva propiedad. Verifique su conexión a internet y vuelva a intentarlo";
            displayAlert("Error",message,closeAlertMessage);
        }
    });
}

function checkValueAlredyInput(inputList,values,currentInput){
    inputList.empty();
    for (var i=0;i< values.length;i++) {
        if (values[i].toLowerCase().startsWith(currentInput.toLowerCase()))
            inputList.append('<option value="'+values[i]+'"></option>');
    }
}

function selectPerson(){
    if (onSelectedPersonClick != undefined)
        onSelectedPersonClick(selectedPerson);
}

$("#callePersona").on("keyup", function(event) {
    directionValues=[];
    if (directionsInputs != undefined) {
        for (var i = 0; i < directionsInputs.Calles.length; i++) {
            directionValues.push(directionsInputs.Calles[i].calle);
        }
        checkValueAlredyInput($('#calleListid'), directionValues, $("#callePersona").val());
    }
});

$("#nroPersona").on("keyup", function(event) {
    directionValues=[];
    if (directionsInputs != undefined) {
        for (var i = 0; i < directionsInputs.Nros.length; i++) {
            directionValues.push(directionsInputs.Nros[i].nro);
        }
        checkValueAlredyInput($('#nroListid'), directionValues, $("#nroPersona").val());
    }
});