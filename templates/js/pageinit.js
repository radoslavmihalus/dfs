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

function showLoadingAnimation(){
    $("body").nimbleLoader("show", {
          position             : "fixed",
          loaderClass          : "loading_bar_body",
          debug                : true,
          speed                : 700,
          hasBackground        : true,
          zIndex               : 9999,
          backgroundColor      : "#34383e",
          backgroundOpacity    : 1
        });
}

function hideLoadingAnimation(){
    $("body").nimbleLoader("hide");
}
 
function ShowMessage(messageType, message, autoclose, duration) {
    if (typeof autoclose === "undefined" || autoclose === null) autoclose = true;
    if (typeof duration === "undefined" || duration === null) duration = 3;
 
//    if (inDebugMode){
//        autoclose = false;
//        duration = 10;
//    }
    
    if (messageType === enumNotificationType.error && inDebugMode)
        duration = 10;
 
    if (autoclose) {
        noty({ text: message, type: messageType, timeout: (duration * 1000), layout: 'bottomLeft', theme: 'defaultTheme' });
    } else {
        noty({ text: message, type: messageType, timeout: false, layout: 'bottomLeft', theme: 'defaultTheme' });
    }
}

$(document).ready(function () {
    ShowMessage(enumNotificationType.success, "Show success");
    ShowMessage(enumNotificationType.warning, "Show warning");
    ShowMessage(enumNotificationType.information, "Show information");
    ShowMessage(enumNotificationType.confirmation, "Show confirmation");
    ShowMessage(enumNotificationType.error, "Show error");
});