<?php
// source: templates/registration.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6640251855', 'html')
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
                <form id="frmSignIn">
                    <div class="form-group">
                        <input type="text" class="form-control" id="txtName" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Name'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="txtSurname" placeholder="Surname">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtConfirmPassword" placeholder="Confirm password">
                    </div>
                </form>
                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Register</button>
            </div>
        </div>
    </div>
    <div class="tab-pane fade in active" id="login">
        <div class="panel panel-default registration_block transparent_white">
            <div class="panel-body">
                <!-- DOGFORSHOW Sign up form -->
                <form id="frmlogIn">
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" placeholder="Password">
                    </div>
                </form>
                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Login'), ENT_NOQUOTES) ?></button>
            </div>
        </div>
    </div>
</div>
