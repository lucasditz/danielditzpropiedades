/**
 * Created by Martin on 28/11/2016.
 */


function displayAlert(title,message,_callback) {
    bootbox.alert({
        size: "medium",
        title: title,
        message: message,
        callback:_callback
    });
}

function displayTwoButtonDialog(title,message,btnLabels,btnClasses,btnCallbacks){
    bootbox.dialog({
        title: title,
        message: message,
        buttons: {
            success: {
                label:btnLabels[0],
                className: btnClasses[0],
                callback: function() {
                    btnCallbacks[0];
                }
            },
            cancel: {
                label:btnLabels[1],
                className: btnClasses[1],
                callback: btnCallbacks[1]
            }
        }
    });
}

function doNothing(){}

function redirectLogin(){
    window.location ="login.php";
    createCookie(window.USER_TOKEN,"",-1);
}

var userProfileCallback=undefined;
function callUserProfileCallBack(){
    if (userProfileCallback != undefined)
        userProfileCallback();
}

function setUserProfile(){
    var userToken=getCookie(window.USER_TOKEN);
    var url=window.base_url+window.ws_user_profile;
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        headers: {'X-Auth':userToken},
        success: function (response) {
            if (response.data.status == "10001"){
                if (response.data.profile.id_foto != null)
                    window.profileImage=response.data.profile.id_foto;
                else
                    window.profileImage="images/default-profile.png";
                window.profileName=response.data.profile.nombre;
                window.profileLastName=response.data.profile.apellido;
                window.profileEmail=response.data.profile.email;
                window.profileID=response.data.profile.id;

                $('#template_profile_image').attr("src",window.profileImage);
                $('#home_profile_image').attr("src",window.profileImage);

                $('#template_profile_name').text(window.profileName+" "+window.profileLastName);
                $('#home_profile_name').text(window.profileName+" "+window.profileLastName+ " ");
                callUserProfileCallBack();
            } else{
                if (response.data.status == 10002){
                    displayAlert("Atención",response.data.message,redirectLogin);
                }else{
                    displayTwoButtonDialog("Error",response.data.message,["Reintentar","Cancelar"],["btn btn-primary","btn btn-default"],[setUserProfile,callUserProfileCallBack]);
                }
            }
        },
        error:function(){
            displayTwoButtonDialog("Error","Ocurrió un error al obtener los datos del perfil.",["Reintentar","Cancelar"],["btn btn-primary","btn btn-default"],[setUserProfile,callUserProfileCallBack]);
        }
    });
}
