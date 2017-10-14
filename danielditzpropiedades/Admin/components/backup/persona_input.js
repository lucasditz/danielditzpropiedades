/**
 * Created by Martin on 19/12/2016.
 */


$(document).ready(function() {
    $('#fNacimiento').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_1",
        showDropdowns: true,
        format: 'DD/MM/YYYY'
    });
});
<!-- /bootstrap-daterangepicker -->

function checkPersonaEmptyInput(){
    if ($('#nombre').val() == "")
        return("Debe ingresar el nombre de la persona");
    if ($('#apellido').val() == "")
        return("Debe ingresar el apellido de la persona");
    if ($('#dni').val() == "")
        return("Debe ingresar el D.N.I. de la persona");
    /*if ($('#callePersona').val() == "")
        return("Debe ingresar el nombre de la calle");
    if ($('#nroPersona').val() == "")
        return("Debe ingresar el nº de la calle");
    if ($('#ciudadPersona').val() == "")
        return("Debe ingresar el nombre de la ciudad");*/
    return "";
}