/**
 * Created by Martin on 13/09/2016.
 */
var wizard;
var personasTable=undefined;
var searchPerson=true;
var contratoGenerado=false;
var idInmuebleAlquiler=undefined;
<!-- jQuery Smart Wizard -->
var doc = $(document);
doc.ready(function() {
    if (!expiredCookie(window.USER_TOKEN)){
        userProfileCallback=loadAlquilerData;
        setUserProfile();
    }else{
        displayAlert("Atención","Sesión no válida o expirada",redirectLogin);
    }

    $('#wizard').smartWizard({
        hideButtonsOnDisabled: true,
        keyNavigation: false,
        onLeaveStep:leaveAStepCallback,
        onFinish: checkContratoInput
    });

    $('#wizard').smartWizard("enableStep",1);
    $('#wizard').smartWizard("enableStep",2);
    $('#wizard').smartWizard("enableStep",3);
    $('#wizard').smartWizard("disableStep",4);

    $('.buttonNext').addClass('btn btn-success');

    $('.buttonPrevious').addClass('btn btn-primary');
    $('.buttonFinish').addClass('btn btn-default');
});

$( window ).resize(function() {
    fixHeightJS();
});

function fixHeightJS(){
    $('#wizard').smartWizard("fixHeight");
}

function getParam(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || undefined;
}

function loadAlquilerData(){
    var id=getParam("id");
    idInmuebleAlquiler=id;
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_alquiler_disponible_get;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: {'id':id},
        dataType: 'json',
        success: function (response){
            var propiedad=response.data.propiedades[0];
            /** Datos Inmueble **/
            document.getElementById("calleInmueble").value=propiedad.direccion.calle;
            document.getElementById("nroInmueble").value=propiedad.direccion.nro;
            propiedad.direccion.piso!=undefined?document.getElementById("pisoInmueble").value=propiedad.direccion.piso:"";
            propiedad.direccion.dpto!=undefined?document.getElementById("dptoInmueble").value=propiedad.direccion.dpto:"";
            propiedad.direccion.entre_calles!=undefined?document.getElementById("entreCalleInmueble").value=propiedad.direccion.entre_calles:"";
            propiedad.direccion.zona!=undefined?document.getElementById("zonaInmueble").value=propiedad.direccion.zona:"";
            document.getElementById("ciudadInmueble").value=propiedad.direccion.ciudad;
            document.getElementById("provinciaInmueble").value=propiedad.direccion.provincia;
            propiedad.direccion.cod_postal!=undefined?document.getElementById("codPostalInmueble").value=propiedad.direccion.cod_postal:"";
            propiedad.comodidades!=undefined?document.getElementById("comodidades").value=propiedad.comodidades:"";
            propiedad.mts2!=undefined?document.getElementById("mts2").value=propiedad.mts2:"";
            document.getElementById("valor").value=propiedad.valor;

            /** Datos Propietario **/
            loadPropietarioData(propiedad.propietario.id);
            $('#propietarioSearchBtn').css("display","none");

            searchPerson=false;
            nuevaPersonaClick=true;
            $('#wizard').smartWizard("fixHeight");
        },
        error:function(){
            displayTwoButtonDialog("Error","Ocurrió un error al cargar los datos del inmueble.",["Reintentar","Cancelar"],["btn btn-primary","btn btn-default"],[loadAlquilerData,doNothing]);
        }
    });
}

function habilitarContrato(){
    if (!contratoGenerado) {
        contratoGenerado = true;
        $('#wizard').smartWizard("enableStep", 4);
    }
}

function leaveAStepCallback(obj, context){
    if (context.toStep == 4){
        if (!contratoGenerado) {
            displayAlert("Atención",'Para continuar debe generar el contrato haciendo click en el botón "Generar Contrato"',doNothing);
            return false;
        }
    }
    return true;
}

function generateContract(){
    var userToken=getCookie(window.USER_TOKEN);
    var alquilerPeriodos=getPeriodosValueArray();
    var alquilerServicios=getServiciosArray();
    var url=window.base_url+window.ws_alquiler_disponible_contrato;
    $.ajax({
        url: url,
        type: 'post',
        headers: {'X-Auth':userToken},
        data: { 'id_inmuebleAlquiler': idInmuebleAlquiler,
            'deposito': $('#depositoValue').val(),
            'honorarios': $('#honorariosValue').val(),
            'alquilerPeriodos': alquilerPeriodos,
            'alquilerServicios': alquilerServicios,
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
            var message= "No fue posible generar el contrato. Verifique su conexión a internet y vuelva a intentarlo";
            displayAlert("Error",message,doNothing);
            return false;
        }
    });
}

function goToAlquileresContrato(){
    window.location.href="alquileres_contrato.php";
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
        //$('#wizard').smartWizard("fixHeight");
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