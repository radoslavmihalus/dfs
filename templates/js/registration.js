function SaveData() {
    var arForm = $("#frmSignIn").serializeArray();
    //var currentRecordID = $("#recordID");
    //arForm.push({ name: 'ID', value: currentRecordID });
    var params = JSON.stringify({ formvars: arForm });

    //save data
    $.ajax({
        url: webServicePath + "/SaveData",
        type: "POST",
        contentType: "application/json",
        data: params,
        dataType: "json",
        success: function (result) {
            if (result.d.Result !== "true") {
                ShowMessage(enumNotificationType.error, result.d.ErrorMessage, true, 10);
            } else {
                ShowMessage(enumNotificationType.success, "Thank you for registration.", true, 10);
                $(':input','#frmSignIn')
                    .not(':button, :submit, :reset, :hidden')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');
            }
        },
        error: function (xhr, status) {
            ShowMessage(enumNotificationType.error, "An error occurred: " + status, true, 10);
        }
    });
}