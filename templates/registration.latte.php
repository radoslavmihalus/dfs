<div id="myTabsContent" class="tab-content">
    <div class="tab-pane fade" id="registration">
        <div class="panel panel-default registration_block transparent_white">
            <div class="panel-body">
                <!-- DOGFORSHOW Sign up form -->
                <form id="frmSignIn" action="templates/scripts/insert.php" method="post" role="form" data-toggle="validator">
                    <input type="hidden" name="formName" value="frmSignIn" />
                    <div class="form-group">
                        <input type="text" class="form-control required" id="txtName" name="txtName" placeholder="{_'Name'}" data-error="Vyplne meno" required>
                        <div class="help-block with-errors error-message"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control required" id="txtSurname" name="txtSurname" placeholder="{_ 'Surname'}" required>
                        <div class="help-block with-errors error-message"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control required" id="txtEmail" name="txtEmail" placeholder="{_ 'Email'}" required>
                        <div class="help-block with-errors error-message"></div>
                    </div>
                    <div class="form-group">
                        <select class="form-control font_size_13px required" id="ddlCountries" name="ddlCountries" required>
                            <option>Slovensko</option>
                        </select>
                        <div class="help-block with-errors error-message"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control required" id="txtPassword" name="txtPassword" placeholder="{_ 'Password'}" required>
                        <div class="help-block with-errors error-message"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control required" id="txtConfirmPassword" data-match="#txtPassword" data-match-error="Whoops, these don't match" placeholder="{_ 'Confirm password'}" required>
                        <div class="help-block with-errors error-message"></div>
                    </div>
                    <button type="submit" id="btnSignIn" class="btn btn-danger btn-block"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;{_ 'Register'}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane fade in active" id="login">
        <div class="panel panel-default registration_block transparent_white">
            <div class="panel-body">
                <!-- DOGFORSHOW Sign up form -->
                <form id="frmlogIn" action="templates/scripts/login.php" method="post" role="form" data-toggle="validator">
                    <input type="hidden" name="formName" value="frmlogIn" />
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="{_ 'Email'}" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="{_ 'Password'}" required>
                    </div>
                    <button type="submit" id="btnLogin" class="btn btn-danger btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;{_'Login'}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showResponseReg(responseText, statusText, xhr, $form) {
        hideLoadingAnimation();
        ShowMessage(enumNotificationType.success, responseText);
        $("#frmSignIn").find("input[type=text], input[type=email], input[type=password], select, textarea").val("");
    }

    function validateFormReg()
    {
        showLoadingAnimation();
    }

    function showResponseLog(responseText, statusText, xhr, $form) {
        hideLoadingAnimation();
        if (responseText == 'ok') {
            window.location.href = 'index.php';
//        ShowMessage(enumNotificationType.success, responseText);
//        $("#frmSignIn").find("input[type=text], input[type=email], input[type=password], select, textarea").val("");
        }
        else
        {
            ShowMessage(enumNotificationType.error, responseText);
        }
    }

    function validateFormLog()
    {
        showLoadingAnimation();
    }

    var optionsreg = {
        beforeSubmit: validateFormReg, // pre-submit callback 
        error: hideLoadingAnimation,
        success: showResponseReg  // post-submit callback 

                // other available options: 
                //url:       url         // override for form's 'action' attribute 
                //type:      type        // 'get' or 'post', override for form's 'method' attribute 
                //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
                //clearForm: true        // clear all form fields after successful submit 
                //resetForm: true        // reset the form after successful submit 

                // $.ajax options can be used here too, for example: 
                //timeout:   3000 
    };

    var optionslog = {
        beforeSubmit: validateFormLog, // pre-submit callback 
        error: hideLoadingAnimation,
        success: showResponseLog  // post-submit callback 

                // other available options: 
                //url:       url         // override for form's 'action' attribute 
                //type:      type        // 'get' or 'post', override for form's 'method' attribute 
                //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
                //clearForm: true        // clear all form fields after successful submit 
                //resetForm: true        // reset the form after successful submit 

                // $.ajax options can be used here too, for example: 
                //timeout:   3000 
    };

    $("#frmSignIn").ajaxForm(optionsreg);
    $("#frmlogIn").ajaxForm(optionslog);
</script>