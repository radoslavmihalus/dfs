<?php
// source: templates/owner-registration.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2281087121', 'html')
;
//
// main template
//
?>
<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateOwnerProfile">
            <h2 class="text-center text-uppercase"><i class="glyphicons glyphicons-user"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Owner of purebred dog profile'), ENT_NOQUOTES) ?></h2>
            <span class="form-secondary-description" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Basic informations about you'), ENT_NOQUOTES) ?></span>
            <span><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i> <?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties'), ENT_NOQUOTES) ?></span>
            <hr>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Profile picture'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="file" class="form-control font_size_13px" id="txtOwnerProfilePicture" placeholder="Your profile picture">
            </div>
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
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Short description about you'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <textarea type="text" style="height:50px;" class="form-control contact_textarea font_size_13px" id="txtOwnerDescription" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Short description'), ENT_COMPAT) ?>"></textarea>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Country'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_13px" id="ddlCountries">
                    <option>Select country</option>
                    <option>Czech Republic</option>
                    <option>Afghanistan</option>
                    <option>Kuwait</option>
                </select>
            </div>
        </form>
        <button type="submit" class="btn btn-danger btn-xl pull-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create profile'), ENT_NOQUOTES) ?></button>
    </div>
</div>  