<?php
// source: templates/registration.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6772778679', 'html')
;
//
// main template
//
?>
<div id="myTabsContent" class="tab-content">
    <div class="tab-pane fade" id="registration">
        <div class="panel panel-default registration_block transparent_white">
            <div class="panel-body">
                <!-- DOGFORSHOW Sign up form -->
                <form id="frmSignIn" action="templates/scripts/insert.php" method="post">
                    <input type="hidden" name="formName" value="frmSignIn">
                    <div class="form-group">
                        <input type="text" class="form-control" id="txtName" name="txtName" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Name'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="txtSurname" name="txtSurname" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Surname'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Email'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <select class="form-control font_size_13px" id="ddlCountries" name="ddlCountries">
                            <option value="" selected disabled><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Country'), ENT_NOQUOTES) ?></option>
                            <option>Czech Republic</option>
                            <option>Afghanistan</option>
                            <option>Kuwait</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Password'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtConfirmPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Confirm password'), ENT_COMPAT) ?>">
                    </div>
                    <button type="submit" id="btnSignIn" class="btn btn-danger btn-block"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Register'), ENT_NOQUOTES) ?></button>
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane fade in active" id="login">
        <div class="panel panel-default registration_block transparent_white">
            <div class="panel-body">
                <!-- DOGFORSHOW Sign up form -->
                <form id="frmlogIn">
                    <input type="hidden" name="formName" value="frmlogIn">
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Email'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Password'), ENT_COMPAT) ?>">
                    </div>
                    <button type="submit" id="btnLogin" class="btn btn-danger btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Login'), ENT_NOQUOTES) ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function showResponse(responseText, statusText, xhr, $form) {
        showLoading(false);
        alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
                '\n\nThe output div should have already been updated with the responseText.');
    }
    
    function showLoadingAnimation(){
        showLoading(true);
    }
    
    var options = {
        //target:        '#output1',   // target element(s) to be updated with server response 
        beforeSubmit: showLoadingAnimation,  // pre-submit callback 
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