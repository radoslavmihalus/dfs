<div id="myTabsContent" class="tab-content">
    <div class="tab-pane fade" id="registration">
        <div class="panel panel-default registration_block transparent_white">
            <div class="panel-body">
                <!-- DOGFORSHOW Sign up form -->
                <form id="frmSignIn" action="templates/scripts/insert.php" method="post">
                    <input type="hidden" name="formName" value="frmSignIn" />
                    <div class="form-group">
                        <input type="text" class="form-control" id="txtName" name="txtName" placeholder="{_'Name'}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="txtSurname" name="txtSurname" placeholder="{_ 'Surname'}">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="{_ 'Email'}">
                    </div>
                    <div class="form-group">
                        <select class="form-control font_size_13px" id="ddlCountries" name="ddlCountries">
                            <option value="" selected disabled>{_ 'Country'}</option>
                            <option>Czech Republic</option>
                            <option>Afghanistan</option>
                            <option>Kuwait</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="{_ 'Password'}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtConfirmPassword" placeholder="{_ 'Confirm password'}">
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
                <form id="frmlogIn">
                    <input type="hidden" name="formName" value="frmlogIn" />
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="{_ 'Email'}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="{_ 'Password'}">
                    </div>
                    <button type="submit" id="btnLogin" class="btn btn-danger btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;{_'Login'}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showResponse(responseText, statusText, xhr, $form) {
        alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
                '\n\nThe output div should have already been updated with the responseText.');
    }

    var options = {
        //target:        '#output1',   // target element(s) to be updated with server response 
        //beforeSubmit:  showRequest,  // pre-submit callback 
        success: showResponse  // post-submit callback 

                // other available options: 
                //url:       url         // override for form's 'action' attribute 
                //type:      type        // 'get' or 'post', override for form's 'method' attribute 
                //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
                //clearForm: true        // clear all form fields after successful submit 
                //resetForm: true        // reset the form after successful submit 

                // $.ajax options can be used here too, for example: 
                //timeout:   3000 
    };

    $("#frmSignIn").ajaxForm(options);
</script>