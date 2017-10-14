/**
 * Created by Martin on 30/06/2017.
 */
var countofPeriods=1;
var loadedPeriodos=null;

$(document).ready(function() {
    $('#firstStartDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });

   $('#firstEndDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });

    $('#secondStartDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });

    $('#secondEndDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });

    $('#thirdStartDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });

    $('#thirdEndDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });

    $('#fourthStartDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });

    $('#fourthEndDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
});

function closefirstStartDateDatePicker(){
    $('#firstStartDate').daterangepicker('hide');
    $('#firstStartDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
}

function closefirstEndDateDatePicker(){
    $('#firstEndDate').daterangepicker('hide');
    $('#firstEndDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
}

function closesecondStartDateDatePicker(){
    $('#secondStartDate').daterangepicker('hide');
    $('#secondStartDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
}
function closesecondEndDateDatePicker(){
    $('#secondEndDate').daterangepicker('hide');
    $('#secondEndDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
}

function closethirdStartDateDatePicker(){
    $('#thirdStartDate').daterangepicker('hide');
    $('#thirdStartDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
}
function closethirdEndDateDatePicker(){
    $('#thirdEndDate').daterangepicker('hide');
    $('#thirdEndDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
}

function closefourthStartDateDatePicker(){
    $('#fourthStartDate').daterangepicker('hide');
    $('#fourthStartDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
}
function closefourthEndDateDatePicker(){
    $('#fourthEndDate').daterangepicker('hide');
    $('#fourthEndDate').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
}

function removeDateRangePickers(){
    $('#firstStartDate').data('daterangepicker').remove();
    $('#firstEndDate').data('daterangepicker').remove();

    $('#secondStartDate').data('daterangepicker').remove();
    $('#secondEndDate').data('daterangepicker').remove();

    $('#thirdStartDate').data('daterangepicker').remove();
    $('#thirdEndDate').data('daterangepicker').remove();

    $('#fourthStartDate').data('daterangepicker').remove();
    $('#fourthEndDate').data('daterangepicker').remove();
}

function loadContratoData(editable,periodos,servicios,honorarios,deposito,id_inquilino,id_garante){
    loadPeriodosData(editable,periodos);
    loadServiciosData(editable,servicios);
    document.getElementById("honorariosValue").value=honorarios;
    document.getElementById("depositoValue").value=deposito;
    if (!editable){
        document.getElementById('honorariosValue').readOnly = true;
        document.getElementById('depositoValue').readOnly = true;
    }
    loadInquilinoData(id_inquilino);
    if (id_garante != "")
        loadGaranteData(id_garante);

}

function loadPeriodosData(editable,periodos){
    loadedPeriodos=periodos;
    if (periodos.length > 0) {
        $('#firstStartDate').val(periodos[0].fechaInicio);
        $('#firstEndDate').val(periodos[0].fechaFin);
        $('#firstValue').val(periodos[0].valor);
        if (!editable){
            $('#firstStartDate').attr('readonly', true);
            $('#firstEndDate').attr('readonly', true);
            $('#firstValue').attr('readonly', true);
        }
    }

    if (periodos.length > 1){
        $('#secondStartDate').val(periodos[1].fechaInicio);
        $('#secondEndDate').val(periodos[1].fechaFin);
        $('#secondValue').val(periodos[1].valor);
        if (!editable){
            $('#secondStartDate').attr('readonly', true);
            $('#secondEndDate').attr('readonly', true);
            $('#secondValue').attr('readonly', true);
        }
    }

    if (periodos.length > 2) {
        $('#thirdStartDate').val(periodos[2].fechaInicio);
        $('#thirdEndDate').val(periodos[2].fechaFin);
        $('#thirdValue').val(periodos[2].valor);
        if (!editable){
            $('#thirdStartDate').attr('readonly', true);
            $('#thirdEndDate').attr('readonly', true);
            $('#thirdValue').attr('readonly', true);
        }
    }

    if (periodos.length > 3) {
        $('#fourthStartDate').val(periodos[3].fechaInicio);
        $('#fourthEndDate').val(periodos[3].fechaFin);
        $('#fourthValue').val(periodos[3].valor);
        if (!editable){
            $('#fourthStartDate').attr('readonly', true);
            $('#fourthEndDate').attr('readonly', true);
            $('#fourthValue').attr('readonly', true);
        }
    }

    var periodSelector = document.getElementById("periodSelector");
    periodSelector.value = periodos.length;
    selectedPeridoChange();
    periodSelector.disabled = true;
    if (!editable) {
        removeDateRangePickers();
    }
}

function loadServiciosData(editable,servicios){
    for (var i=0; i < servicios.length;i++){
        $(":checkbox[value="+servicios[i].idServicio+"]").attr("checked","true");
    }
    if (!editable){
        $("input[name='servicios[]']").each( function () {
            $(this).attr("disabled", true);
        });
    }

}

function selectedPeridoChange(){
    var periodSelector = document.getElementById("periodSelector");
    countofPeriods= parseInt(periodSelector.options[periodSelector.selectedIndex].value);

    switch (countofPeriods){
        case 1:
            $('#secondVariationRow').css("display","none");
            $('#thirdVariationRow').css("display","none");
            $('#fourthVariationRow').css("display","none");
            break;
        case 2:
            $('#secondVariationRow').css("display","inline-block");
            $('#thirdVariationRow').css("display","none");
            $('#fourthVariationRow').css("display","none");
            break;
        case 3:
            $('#secondVariationRow').css("display","inline-block");
            $('#thirdVariationRow').css("display","inline-block");
            $('#fourthVariationRow').css("display","none");
            break;
        case 4:
            $('#secondVariationRow').css("display","inline-block");
            $('#thirdVariationRow').css("display","inline-block");
            $('#fourthVariationRow').css("display","inline-block");
            break;
    }
    fixHeightJS();
}

function checkContratoInput(){
    var message = checkPeriodos();
    if (message != ""){
        displayAlert("Atención", message, doNothing);
    }else{
        checkInquilinoAndGarante();
    }
}

function checkPeriodos(){
    return checkPeriodosNotEmpty();
}

function checkPeriodosNotEmpty(){
    switch (countofPeriods){
        case 1:
            if ($('#firstStartDate').val() == "" || $('#firstEndDate').val() == "" || $('#firstValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            break;
        case 2:
            if ($('#firstStartDate').val() == "" || $('#firstEndDate').val() == "" || $('#firstValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            if ($('#secondStartDate').val() == "" || $('#secondEndDate').val() == "" || $('#secondValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            break;
        case 3:
            if ($('#firstStartDate').val() == "" || $('#firstEndDate').val() == "" || $('#firstValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            if ($('#secondStartDate').val() == "" || $('#secondEndDate').val() == "" || $('#secondValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            if ($('#thirdStartDate').val() == "" || $('#thirdEndDate').val() == "" || $('#thirdValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            break;
        case 4:
            if ($('#firstStartDate').val() == "" || $('#firstEndDate').val() == "" || $('#firstValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            if ($('#secondStartDate').val() == "" || $('#secondEndDate').val() == "" || $('#secondValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            if ($('#thirdStartDate').val() == "" || $('#thirdEndDate').val() == "" || $('#thirdValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            if ($('#fourthStartDate').val() == "" || $('#fourthEndDate').val() == "" || $('#fourthValue').val() == "")
                return ("Debe completar los campos obligatorios (*) del contrato");
            break;
    }
    return checkPeridosDate();

}

function checkPeridosDate(){
    switch (countofPeriods){
        case 1:
            return checkFirstPeriod();
            break;
        case 2:
            return checkSecondPeriod();
            break;
        case 3:
            return checkThirdPeriod();
            break;
        case 4:
            return checkFourthPeriod();
            break;
    }
    return "";

}

function checkFirstPeriod(){
    var fecha1,fecha2;
    // Diferencia (fin-inicio) primer periodo
    fecha1=moment($('#firstStartDate').val(),"DD/MM/YYYY");
    fecha2=moment($('#firstEndDate').val(),"DD/MM/YYYY");
    if (fecha2.diff(fecha1, 'days') <= 0)
        return ("Las fecha de finalización del primer período debe ser mayor a la de inicio");

    return "";
}

function checkSecondPeriod(){
    var fecha1,fecha2;
    fecha2=moment($('#firstEndDate').val(),"DD/MM/YYYY");
    //Diferencia (inicio segundo periodo - fin del primero)
    fecha1=moment($('#secondStartDate').val(),"DD/MM/YYYY");
    if (fecha1.diff(fecha2, 'days') <= 0)
        return ("Las fecha de inicio del segundo período debe ser mayor a la de fin del periodo anterior");
    //Diferencia (fin-inicio) segundo periodo
    fecha2=moment($('#secondEndDate').val(),"DD/MM/YYYY");
    if (fecha2.diff(fecha1, 'days') <= 0)
        return ("Las fecha de finalización del segundo período debe ser mayor a la de inicio");
    return checkFirstPeriod();
}

function checkThirdPeriod(){
    var fecha1,fecha2;
    fecha2=moment($('#secondEndDate').val(),"DD/MM/YYYY");
    //Diferencia (inicio tercer periodo - fin del segundo)
    fecha1=moment($('#thirdStartDate').val(),"DD/MM/YYYY");
    if (fecha1.diff(fecha2, 'days') <= 0)
        return ("Las fecha de inicio del tercer período debe ser mayor a la de fin del periodo anterior");
    //Diferencia (fin-inicio) tercer periodo
    fecha2=moment($('#thirdEndDate').val(),"DD/MM/YYYY");
    if (fecha2.diff(fecha1, 'days') <= 0)
        return ("Las fecha de finalización del tercer período debe ser mayor a la de inicio");

    return checkSecondPeriod();
}

function checkFourthPeriod(){
    var fecha1,fecha2;
    fecha2=moment($('#thirdEndDate').val(),"DD/MM/YYYY");
    //Diferencia (inicio cuarto periodo - fin del tercero)
    fecha1=moment($('#fourthStartDate').val(),"DD/MM/YYYY");
    if (fecha1.diff(fecha2, 'days') <= 0)
        return ("Las fecha de inicio del cuarto período debe ser mayor a la de fin del periodo anterior");
    //Diferencia (fin-inicio) cuarto periodo
    fecha2=moment($('#fourthEndDate').val(),"DD/MM/YYYY");
    if (fecha2.diff(fecha1, 'days') <= 0)
        return ("Las fecha de finalización del cuarto período debe ser mayor a la de inicio");

    return checkThirdPeriod();
}

function checkInquilinoAndGarante(){
    if (selectedInquilino == undefined)
        displayAlert("Atención", "Debe seleccionar el Inquilino", doNothing);
    else{
        generateContract();
    }
}

function getPeriodosValueArray(){
    var alquilerPeriods=new Array();
    alquilerPeriods[0]={};

    alquilerPeriods[0]['startDate']=$('#firstStartDate').val();
    alquilerPeriods[0]['endDate']=$('#firstEndDate').val();
    alquilerPeriods[0]['value']=$('#firstValue').val();
    if (loadedPeriodos != null){
        alquilerPeriods[0]['id']=loadedPeriodos[0].id;
    }

    if (countofPeriods > 1){
        alquilerPeriods[1]={};
        alquilerPeriods[1]['startDate']=$('#secondStartDate').val();
        alquilerPeriods[1]['endDate']=$('#secondEndDate').val();
        alquilerPeriods[1]['value']=$('#secondValue').val();
        if (loadedPeriodos != null){
            alquilerPeriods[1]['id']=loadedPeriodos[1].id;
        }
    }
    if (countofPeriods >2){
        alquilerPeriods[2]={};
        alquilerPeriods[2]['startDate']=$('#thirdStartDate').val();
        alquilerPeriods[2]['endDate']=$('#thirdEndDate').val();
        alquilerPeriods[2]['value']=$('#thirdValue').val();
        if (loadedPeriodos != null){
            alquilerPeriods[2]['id']=loadedPeriodos[2].id;
        }
    }
    if (countofPeriods > 3){
        alquilerPeriods[3]={};
        alquilerPeriods[3]['startDate']=$('#fourthStartDate').val();
        alquilerPeriods[3]['endDate']=$('#fourthEndDate').val();
        alquilerPeriods[3]['value']=$('#fourthValue').val();
        if (loadedPeriodos != null){
            alquilerPeriods[3]['id']=loadedPeriodos[3].id;
        }
    }
    return alquilerPeriods;
}

function getServiciosArray(){
    var alquilerServicios=[];
    $("input[name='servicios[]']").each( function () {
        if($(this).is(':checked')){
            alquilerServicios.push(parseInt($(this).val()));
        }
    });
    return alquilerServicios;
}