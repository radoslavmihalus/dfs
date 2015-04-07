<?php
// source: templates/registration.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('0532443579', 'html')
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
                        <input type="text" class="form-control" id="txtSurname" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Surname'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Email'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <select class="form-control font_size_13px" id="ddlCountries">
                            <option value="" selected disabled><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Country'), ENT_NOQUOTES) ?></option>
                            <option>Czech Republic</option>
                            <option>Afghanistan</option>
                            <option>Kuwait</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Password'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtConfirmPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Confirm password'), ENT_COMPAT) ?>">
                    </div>
                </form>
                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Register'), ENT_NOQUOTES) ?></button>
            </div>
        </div>
    </div>
    <div class="tab-pane fade in active" id="login">
        <div class="panel panel-default registration_block transparent_white">
            <div class="panel-body">
                <!-- DOGFORSHOW Sign up form -->
                <form id="frmlogIn">
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Email'), ENT_COMPAT) ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Password'), ENT_COMPAT) ?>">
                    </div>
                </form>
                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Login'), ENT_NOQUOTES) ?></button>
            </div>
        </div>
    </div>
</div>
