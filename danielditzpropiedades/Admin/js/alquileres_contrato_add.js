/**
 * Created by Martin on 19/09/2016.
 */
var propiedad=undefined;
<!-- jQuery Smart Wizard -->
var doc = $(document);
doc.ready(function() {
    if (!expiredCookie(window.USER_TOKEN)){
        setUserProfile();
    }else{
        displayAlert("Atención","Sesión no válida o expirada",redirectLogin);
    }
    
    $('#wizard').smartWizard({
        hideButtonsOnDisabled: true,
        keyNavigation: false,
        onLeaveStep: leaveAStepCallback,
        onFinish:checkContratoInput
    });

    $('.buttonNext').addClass('btn btn-success');
    $('.buttonPrevious').addClass('btn btn-primary');
    $('.buttonFinish').addClass('btn btn-default');

});

$( window ).resize(function() {
    fixHeightJS();
});


function goToAlquileresContrato(){
    window.location.href="alquileres_contrato.php";
}

function fixHeightJS(){
    $('#wizard').smartWizard("fixHeight");
}

function getParam(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || undefined;
}

function leaveAStepCallback(obj, context){
    var dfd = new $.Deferred();

    switch (context.fromStep){
        case 1:
            currentInmuebleId=undefined;
            $.when(checkInmuebleData(currentInmuebleId)).done(function(status){
                dfd.resolve(status);
            });
            break;
        case 3:
            dfd.resolve(checkDatosPropietarios());
            break;
        default:
            dfd.resolve(true);
            break;
    }

    return dfd.promise();
}

function checkDatosPropietarios(){
    var message="";
    if (selectedPropietario == undefined){
        message= "Debe seleccionar/registrar el propietario";
        displayAlert("Atención",message,doNothing);
        return false;
    }
    return true;
}

function generateContract(){
    currentInmuebleId=undefined;
    $.when(checkInmuebleData(currentInmuebleId)).done(function(status){
        if (status && checkDatosPropietarios()){
            var userToken=getCookie(window.USER_TOKEN);
            var alquilerPeriodos=getPeriodosValueArray();
            var alquilerServicios=getServiciosArray();
            var url=window.base_url+window.ws_alquiler_contrato_add;
            $.ajax({
                url: url,
                type: 'post',
                headers: {'X-Auth':userToken},
                data: {
                    'calle': document.getElementById("calleInmueble").value,
                    'nro': parseInt(document.getElementById("nroInmueble").value),
                    'piso': document.getElementById("pisoInmueble").value,
                    'dpto': document.getElementById("dptoInmueble").value,
                    'entre_calles': document.getElementById("entreCalleInmueble").value,
                    'zona': document.getElementById("zonaInmueble").value,
                    'cod_postal': document.getElementById("codPostalInmueble").value,
                    'ciudad': document.getElementById("ciudadInmueble").value,
                    'provincia': document.getElementById("provinciaInmueble").value,
                    'comodidades': document.getElementById("comodidades").value,
                    'mts2': document.getElementById("mts2").value,
                    'valor': parseInt(document.getElementById("valor").value),
                    'propietario': selectedPropietario.id,
                    'deposito': $('#depositoValue').val(),
                    'alquilerPeriodos': alquilerPeriodos,
                    'alquilerServicios': alquilerServicios,
                    'honorarios': $('#honorariosValue').val(),
                    'id_inquilino': selectedInquilino.id,
                    'id_garante': selectedGarante!=undefined?selectedGarante.id:"",
                    'id_usuario': window.profileID
                },
                dataType: 'json',
                success: function (response){
                    if (response.data.status == 10001) {
                        displayAlert("Operación exitosa",response.data.message,goToAlquileresContrato);
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
                    var message= "No fue posible registrar la nueva propiedad en contrato. Verifique su conexión a internet y vuelva a intentarlo";
                    displayAlert("Error",message,doNothing);
                }
            });
        }
    });
}

/** Load Inmueble Images from local storage **/
/*function readURL(files) {
    function setupReader(file) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var img = new Image();
            img.src=reader.result;
            var chooser='<td style="vertical-align:middle; width: 15%"><input type="radio" name="selectPerfil" data-toggle="tooltip" data-placement="top" title="Foto de Perfil"></td>';
            var image='<td align="center"> <img style="width: 200px; height: 200px;" src='+reader.result+' alt="your image" /></td>';
            var remove='<td style="vertical-align:middle; width: 15%"><a class="remove fa fa-remove fa-2x" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Eliminar"></a></td>';
            var dataTable = '<tr role="row" class="odd" align="center">'+chooser+image+remove+'</tr>';
            $('#table_content_body').append(dataTable);
        };
        reader.readAsDataURL(file);
    }

    //$('#table_content_body').empty();
    var cantFotos=files.length + ($('#table_content_body tr').length)-1;
    if (cantFotos > 5){
        alert("Max 5 files are allowed");
    }
    else{
        for (var i = 0; i < files.length; i++) {
            setupReader(files[i]);
        }
        $( "#countFotos").empty();
        $( "#countFotos" ).append( "("+cantFotos+" de 5 Fotos Seleccionadas)" );
        fixHeightJS();
    }
}*/

/** Remove Inmueble image **/
/*$('table').on('click','tr a.remove',function(e){
    e.preventDefault();
    $(this).closest('tr').remove();
    var tableLenght=($('#table_content_body tr').length)-1;
    $( "#countFotos").empty();
    $( "#countFotos" ).append( "("+tableLenght+" de 5 Fotos Seleccionadas)" );
});*/

