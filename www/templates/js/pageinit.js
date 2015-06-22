var inDebugMode = false;
var webServicePath = "http://localhost";
if (location.href.indexOf('localhost') > 0) {
    webServicePath = "http://localhost:31663/";
    inDebugMode = true;
}

enumNotificationType = {
    alert: 'alert',
    success: 'success',
    error: 'error',
    warning: 'warning',
    information: 'information',
    confirmation: 'confirmation'
}

function showLoadingAnimation() {
//    $("body").nimbleLoader("show", {
//          position             : "fixed",
//          loaderClass          : "loading_bar_body",
//          debug                : true,
//          speed                : 700,
//          hasBackground        : true,
//          zIndex               : 9999,
//          backgroundColor      : "#a5987f",
//          backgroundOpacity    : 1
//        });
}

function hideLoadingAnimation() {
//    $("body").nimbleLoader("hide");
}

function ShowMessage(messageType, message, autoclose, duration) {
    if (typeof autoclose === "undefined" || autoclose === null)
        autoclose = true;
    if (typeof duration === "undefined" || duration === null)
        duration = 3;

    if (messageType === enumNotificationType.error && inDebugMode)
        duration = 10;

    if (autoclose) {
        noty({text: message, type: messageType, timeout: (duration * 8000), layout: 'top', theme: 'bootstrapTheme'});
    } else {
        noty({text: message, type: messageType, timeout: false, layout: 'top', theme: 'bootstrapTheme'});
    }
}

function ShowMessageModal(messageType, message)
{
    var title = "";

    if (messageType === enumNotificationType.alert)
        title = "Alert";
    if (messageType === enumNotificationType.confirmation)
        title = "Confirmation";
    if (messageType === enumNotificationType.error)
        title = "Error";
    if (messageType === enumNotificationType.information)
        title = '<i class="fa fa-info-circle"></i>Information';
    if (messageType === enumNotificationType.success)
        title = "Success";
    if (messageType === enumNotificationType.warning)
        title = "Warning";


    $("#modalTitle").html(title);
    $("#modalText").html(message);
    
    $("#modalFlash").modal('show');
}


$(document).ready(function () {
//   ShowMessage(enumNotificationType.warning, '<i class="fa fa-exclamation-circle" style="font-size:30px;"></i>&nbsp;&nbsp;Warning message');
//    ShowMessage(enumNotificationType.information, "Show information");
//    ShowMessage(enumNotificationType.confirmation, "Show confirmation");
//    ShowMessage(enumNotificationType.error, '<i class="fa fa-times-circle" style="font-size:30px;"></i>&nbsp;&nbsp;Error message');
//    ShowMessage(enumNotificationType.success, '<i class="fa fa-check-square" style="font-size:30px;"></i>&nbsp;&nbsp;Succes message');
});