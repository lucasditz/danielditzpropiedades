var doc = $(document);

doc.on('click', '.bootbox', function (event) {
    var classname = event.target.className;
    classname = classname.replace(/ /g, '.');

    if(classname && !$('.' + classname).parents('.modal-dialog').length)
        bootbox.hideAll();
});

function changePass(){
        var html=
        '<div class="row">'+
            '<div class="form-group">'+
                '<div id="header_group">'+
                    '<div class="row" style="margin: 0 auto;width:80%;">'+
                        '<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">'+
                            '<div class="short-div" style="text-align: left;">'+
                                '<label class="control-label" for="current-pass">Constraseña actual</label>'+
                            '</div>'+
                            '<div class="short-div">'+
                                '<input id="current-pass" class="form-control" type="password" style="width: 100%" value="">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row" style="margin: 0 auto;width:80%;">'+
                        '<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">'+
                            '<div class="short-div" style="text-align: left;">'+
                                '<label class="control-label" for="new-pass">Nueva contraseña</label>'+
                            '</div>'+
                            '<div class="short-div">'+
                                '<input id="new-pass" class="form-control" type="password" style="width: 100%" value="">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row" style="margin: 0 auto;width:80%;">'+
                        '<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">'+
                            '<div class="short-div" style="text-align: left;">'+
                                '<label class="control-label" for="repeat-new-pass">Repita nueva contraseña</label>'+
                            '</div>'+
                            '<div class="short-div">'+
                                '<input id="repeat-new-pass" class="form-control" type="password" style="width: 100%" value="">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row" style="margin: 0 auto;width:80%;">'+
                        '<div id="error-div" class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom:10px;display:none">'+
                            '<p id="error-info" style="color:red" ></p>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';
		
		bootbox.dialog({
			title: "Cambiar contraseña",
			message: html,
			backdrop: true,
			buttons: {
				success: {
					label: "Guardar",
					className: "btn-success",
					callback: function () {
						return setPass();
					}
				},
				 cancel: {
					label: "Cancelar",
					className: "btn-cancel",
					callback: function () {
					}
				}
			}
		});
}

function setPass(){
	$('#error-info').text("");
	$("#error-div").hide();
	var message = checkValidPasswordData();
	if ( message != "" ){
		$('#error-info').text(message);
		$("#error-div").show();
		return false;
	}else{
		 var userToken=getCookie(window.USER_TOKEN);
		 var pass = $('#current-pass').val();
		 var newpass = $('#new-pass').val();
		 var authstr = Base64.encode(userToken + ':' + pass + ':' + newpass);

		$.ajax({
			url: window.base_url+window.ws_user_changepass,
			type: 'post',
			dataType: 'json',
            headers: {'X-Auth':authstr},
			data: {},
			success: function (response) {
				if (response.data.status == "10001"){
                    displayAlert("Operación exitosa",response.data.message,doNothing);
				}else{
                    if (response.data.status == 10002){
                        displayAlert("Atención",response.data.message,redirectLogin);
                    }else{
                        displayAlert("Error",response.data.message,doNothing);
                    }
                }
			},
            error: function(){
                var message= "No fue posible cambiar la contraseña. Verifique su conexión a internet y vuelva a intentarlo";
                displayAlert("Error",message,doNothing);
            }
		});
	}
		
	
}

function checkValidPasswordData(){
	if ($('#current-pass').val() == ""){
		return "Debe ingresar su contraseña actual";
	}
	if ($('#new-pass').val() == ""){
		return "Debe ingresar su nueva contraseña";
	}
	if ($('#repeat-new-pass').val() == ""){
		return "Debe repetir su  nueva contraseña";
	}
	if ($('#new-pass').val() != $('#repeat-new-pass').val()){
        return "Las contraseñas no coinciden";
	}

	return "";
}