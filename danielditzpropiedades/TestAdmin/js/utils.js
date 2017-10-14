/**
 * Created by Martin on 28/11/2016.
 */


function displayAlert(title,message,_callback) {
    bootbox.alert({
        size: "small",
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