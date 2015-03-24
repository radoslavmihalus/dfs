<?php
// source: templates/edit-account.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('1218616371', 'html')
;
//
// main template
//
?>
<div class="col-lg-8">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <div class="panel-description" style="margin-bottom: 10px;"><i class="notification-icon fa fa-cog"></i>&nbsp;&nbsp;Account settings</div>
        <ul id="AccountSettings" class="nav nav-tabs" style="border-bottom:0px !important;font-size:13px;">
            <li class="active"><a class="EditProfilelink" href="#informations" data-toggle="tab"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Informations'), ENT_NOQUOTES) ?></a></li>
            <li><a class="EditProfilelink" href="#pictures" data-toggle="tab"><i class="fa fa-lock"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Password change'), ENT_NOQUOTES) ?></a></li>
        </ul>
        <div id="AccountSettingsContent" class="tab-content">
            <div class="tab-pane fade in active" id="informations">
                <div class="panel panel-default registration_block transparent_white">
                    <div class="panel-body">
                        <span class="form-secondary-description text-uppercase"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Account informations'), ENT_NOQUOTES) ?></span>
                        <span style="font-size: 13px;display:block;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties'), ENT_NOQUOTES) ?></span>
                        <hr>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Name'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtName" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Name'), ENT_COMPAT) ?>">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Surname'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtSurname" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Surname'), ENT_COMPAT) ?>">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Email'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="email" class="form-control font_size_13px" id="txtEmail" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('email@email.com'), ENT_COMPAT) ?>">
                        </div>
                        <span class="form-secondary-description text-uppercase" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Additional account informations'), ENT_NOQUOTES) ?></span>
                        <span style="font-size: 13px;display:block;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties'), ENT_NOQUOTES) ?></span>
                        <hr>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Address'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtAdress" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Address'), ENT_COMPAT) ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Town'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtTown" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Town'), ENT_COMPAT) ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('ZIP'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtZip" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('ZIP'), ENT_COMPAT) ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Phone number'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtPhoneNumber" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Phone number'), ENT_COMPAT) ?>"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Year of birth'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <select class="form-control font_size_13px" id="ddlYear">
                                <option value="" selected disabled>Year</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger btn-xl pull-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Save'), ENT_NOQUOTES) ?></button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pictures">
                <div class="panel panel-default registration_block transparent_white">
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="form-group">
                                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Old password'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                                <input type="password" class="form-control font_size_13px" id="txtOldPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Old password'), ENT_COMPAT) ?>">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('New password'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                                <input type="password" class="form-control font_size_13px" id="txtNewPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('New password'), ENT_COMPAT) ?>">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Confirm new password'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                                <input type="password" class="form-control font_size_13px" id="txtConfirmPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Confirm new password'), ENT_COMPAT) ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger btn-xl pull-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Save'), ENT_NOQUOTES) ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





