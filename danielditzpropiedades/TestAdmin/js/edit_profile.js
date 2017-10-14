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
					'<div class="col-lg-12" style="margin-bottom:10px;    height: 30px;">'+
						'<input id="current-name" type="text" style="width: 100%" value="'+ window.profileName +'" placeholder="Ingrese nombre" >'+
					'</div>'+
					'<div class="col-lg-12" style="margin-bottom:10px;    height: 30px;">'+
					   '<input id="current-lastname" type="text" style="width: 100%" value="'+ window.profileLastName +'" placeholder="Ingrese apellido">'+
					'</div>'+
					'<div class="col-lg-12" style="margin-bottom:10px;    height: 30px;">'+
					   '<input id="current-email" type="text" style="width: 100%" value="'+ window.profileEmail +'" placeholder="Ingrese email">'+
					'</div>'+
					'<div class="col-lg-12" id="error-div" style="margin-bottom:10px; display:none">'+
					   '<p id="error-info" style="color:red" ></p>'+
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
	var message = checkValidData();
	//console.log("message " + message);
	if ( message != "" ){
		$('#error-info').text(message);
		$("#error-div").show();
		return false;
	}else{
		 var userToken=getCookie("userToken");
		 var name = $('#current-name').val();
		 var lastname = $('#current-lastname').val();
		 var email = $('#current-email').val();
		
		$.ajax({
			url: window.base_url+window.ws_admin_profile_edit,
			type: 'post',
			dataType: 'json',
			headers: {'X-Auth':userToken},
			data: {'name':name, 'lastname':lastname,'email':email},
			success: function (response) {
				//console.log(response);
				if (response.data.status == "10001"){
					window.location ="index.php";
				}
				else if (response.data.status == "10002"){
					window.location ="login.php";
					createCookie(window.sesion_toke,"",-1);
				}
			}
		});
	}
		
	
}

function checkValidData(){
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