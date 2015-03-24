<?php
// source: templates/kennel-create-profile.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9440655178', 'html')
;
//
// main template
//
?>
<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateKennelProfile">
            <h2 class="text-center text-uppercase"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel profile'), ENT_NOQUOTES) ?></h2>
            <span class="form-secondary-description text-uppercase"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Basic informations about your kennel'), ENT_NOQUOTES) ?></span>
            <hr>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel name'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown" ></i></span>
                <input type="text" class="form-control font_size_13px" id="txtKennelName" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel name'), ENT_COMPAT) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel FCI number'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtKennelFciNumber" placeholder="987/2011">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel profile picture'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="file" class="form-control font_size_13px" id="txtKennelProfilePicture" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel profile picture'), ENT_COMPAT) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel website'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtKennelWebsite" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('www.yourwebsite.com'), ENT_COMPAT) ?>"></textarea>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel description'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <textarea type="text" style="height:50px;" class="form-control contact_textarea font_size_13px" id="txtKennelDescription" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel description'), ENT_COMPAT) ?>"></textarea>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Select the breed bred by your kennel'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_13px" id="ddlBreedList">
                    <option value="" selected disabled><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Please select'), ENT_NOQUOTES) ?></option>
                    <option>Dogo argentino</option>
                    <option>Berger de Brie</option>
                    <option>Labrador</option>
                </select>
            </div>
<!--            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtmlComment($template->translate('Name')) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtName" placeholder="<?php echo Latte\Runtime\Filters::escapeHtmlComment($template->translate('Name')) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtmlComment($template->translate('Surname')) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtSurname" placeholder="<?php echo Latte\Runtime\Filters::escapeHtmlComment($template->translate('Surname')) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtmlComment($template->translate('Email')) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="email" class="form-control font_size_13px" id="txtEmail" placeholder="<?php echo Latte\Runtime\Filters::escapeHtmlComment($template->translate('email@email.com')) ?>">
            </div>-->
        </form>
        <button type="submit" class="btn btn-danger btn-xl pull-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create profile'), ENT_NOQUOTES) ?></button>
    </div>
</div>  
