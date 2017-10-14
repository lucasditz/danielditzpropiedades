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
                            '<div class="col-lg-12" style="margin-bottom:10px; height: 30px;">'+
                                '<input id="current-pass" type="password" style="width: 100%" value="" placeholder="Ingrese constraseña actual" >'+
                            '</div>'+
                            '<div class="col-lg-12" style="margin-bottom:10px; height: 30px;">'+
                               '<input id="new-pass" type="password" style="width: 100%" value="" placeholder="Ingrese nueva contraseña">'+
                            '</div>'+
                            '<div class="col-lg-12" style="margin-bottom:10px; height: 30px;">'+
                               '<input id="repeat-new-pass"  type="password" style="width: 100%" value="" placeholder="Repita nueva contraseña">'+
                            '</div>'+
                            '<div class="col-lg-12" id="error-div" style="margin-bottom:10px;display:none">'+
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
	var message = checkValidData();
	//console.log("message " + message);
	if ( message != "" ){
		$('#error-info').text(message);
		$("#error-div").show();
		return false;
	}else{
		 var userToken=getCookie("userToken");
		 var pass = $('#current-pass').val();
		 var newpass = $('#new-pass').val();
		 var authstr = Base64.encode(userToken + ':' + pass + ':' + newpass);
		//console.log(authstr);
		$.ajax({
			url: window.base_url+window.ws_user_changepass,
			type: 'post',
			dataType: 'json',
			headers: {'X-Auth':authstr},
			data: {},
			success: function (response) {
			//	console.log(response);
				if (response.data.status == "10001"){
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
		
	}
	return "";
}