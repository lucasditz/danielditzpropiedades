var doc = $(document);

doc.on('click', '.bootbox', function (event) {
    var classname = event.target.className;
    classname = classname.replace(/ /g, '.');

    if(classname && !$('.' + classname).parents('.modal-dialog').length)
        bootbox.hideAll();
});

function loadProfile(){
        var html=
        '<div class="row">'+
            '<div class="form-group">'+
                '<div id="header_group">'+
                    '<div class="row" style="margin: 0 auto;width:80%;">'+
                        '<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">'+
                            '<div class="short-div" style="text-align: left;">'+
                                '<label class="control-label" for="current-name">Nombre</label>'+
                            '</div>'+
                            '<div class="short-div">'+
                                '<input id="current-name" class="form-control" value="'+ window.profileName +'" type="text" style="width: 100%" value="">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row" style="margin: 0 auto;width:80%;">'+
                        '<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">'+
                            '<div class="short-div" style="text-align: left;">'+
                                '<label class="control-label" for="current-lastname">Apellido</label>'+
                            '</div>'+
                            '<div class="short-div">'+
                                '<input id="current-lastname" class="form-control" value="'+ window.profileLastName +'" type="text" style="width: 100%" value="">'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="row" style="margin: 0 auto;width:80%;">'+
                        '<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12">'+
                            '<div class="short-div" style="text-align: left;">'+
                                '<label class="control-label" for="current-email">Email</label>'+
                            '</div>'+
                            '<div class="short-div">'+
                                '<input id="current-email" class="form-control" value="'+ window.profileEmail +'" type="text" style="width: 100%" value="">'+
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
			title: "Editar perfil",
			message: html,
			backdrop: true,
			buttons: {
				success: {
					label: "Guardar",
					className: "btn-success",
					callback: function () {
						return setProfile();
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

function setProfile(){
	$('#error-info').text("");
	$("#error-div").hide();
	var message = checkValidProfileData();
	if ( message != "" ){
		$('#error-info').text(message);
		$("#error-div").show();
		return false;
	}else{
		 var userToken=getCookie(window.USER_TOKEN);
		 var name = $('#current-name').val();
		 var lastname = $('#current-lastname').val();
		 var email = $('#current-email').val();
		
		$.ajax({
			url: window.base_url+window.ws_user_profile_edit,
			type: 'post',
			dataType: 'json',
			headers: {'X-Auth':userToken},
			data: {'nombre':name, 'apellido':lastname,'email':email},
			success: function (response) {
				if (response.data.status == "10001"){
                    window.profileName=name;
                    window.profileLastName=lastname;
                    window.profileEmail=email;
                    $('#template_profile_image').attr("src",window.profileImage);
                    $('#home_profile_image').attr("src",window.profileImage);

                    $('#template_profile_name').text(window.profileName+" "+window.profileLastName);
                    $('#home_profile_name').text(window.profileName+" "+window.profileLastName+ " ");
				}else{
                    if (response.data.status == 10002){
                        displayAlert("Atención",response.data.message,redirectLogin);
                    }else{
                        displayAlert("Error",response.data.message,doNothing);
                    }
                }
			},
            error: function(){
                var message= "No fue posible editar el perfil de usuario. Verifique su conexión a internet y vuelva a intentarlo";
                displayAlert("Error",message,doNothing);
            }
		});
	}
		
	
}

function checkValidProfileData(){
	if ($('#current-name').val() == ""){
		return "Debe ingresar un nombre";
	}
	if ($('#current-lastname').val() == ""){
		return "Debe ingresar un apelido";
	}
	
	if ($('#current-email').val() == ""){
		return "Debe ingresar un email";
	}
	
	//chequear formato de email
		
	return "";
}