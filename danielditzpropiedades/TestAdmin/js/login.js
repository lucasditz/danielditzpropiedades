/**
 * Created by Martin on 28/11/2016.
 */

function doNothing(){}


function validateInput(user,pass){
    if (user == undefined || user == '')
        return ("Debe ingresar nombre de usuario o email");
    if (pass == undefined || pass == '')
        return ("Debe ingresar su contraseña");
    return '';
}

function checkUser(){
    var user=$('#userImput').val();
    var pass=$('#passImput').val();
    var inputValidation=validateInput(user,pass);
    if (inputValidation == '') {
        var authstr = Base64.encode(user + ':' + pass);
        var header = {'X-Auth': authstr};
        console.log(window.base_url+ window.ws_login);
        $.ajax({
            url: window.base_url+ window.ws_login,
            type: 'post',
            dataType: 'json',
            headers: header,
            success: function (response) {
                console.log(response.data.status);
                if (response.data.status == "10001") {
                    var token = response.data.token;
                    var d = new Date();
                    d.setTime(d.getTime() + (14 * 24 * 60 * 60 * 1000));
                    var expires = "expires=" + d.toUTCString();
                    document.cookie = window.USER_TOKEN + "=" + token + "; " + expires;
                    window.location = "home.php";
                }
                else {
                    displayAlert("Error",response.data.message,doNothing);
                }
            },
            error: function () {
                var message="No fue posible iniciar sesión. Verifique conexión a internet ";

                var buttonsLabels = [];
                buttonsLabels.push('Aceptar');
                buttonsLabels.push('Reintentar');

                var classButtons = [];
                classButtons.push('btn-success');
                classButtons.push('btn-cancel');

                var callbackList = [];
                callbackList.push(doNothing);
                callbackList.push(checkUser);

                displayTwoButtonDialog("Error",message,buttonsLabels,classButtons,callbackList);
            }
        });
    }else{
        displayAlert("Error",inputValidation,doNothing);
    }
}