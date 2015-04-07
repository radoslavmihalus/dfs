<?php
// source: templates/handler-create-profile.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4868342766', 'html')
;
//
// main template
//
?>
<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateOwnerProfile">
            <h2 class="section_heading text-center text-uppercase"><i class="glyphicons glyphicons-shirt"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Handler profile'), ENT_NOQUOTES) ?></h2>
            <span class="form-secondary-description" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Basic informations about you'), ENT_NOQUOTES) ?></span>
            <hr>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Your profile picture'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="file" class="form-control font_size_13px" id="txtHandlerProfilePicture" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Your profile picture'), ENT_COMPAT) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Select the breed that you can handle'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_13px" id="ddlBreedList">
                    <option value="" selected disabled><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Please select'), ENT_NOQUOTES) ?></option>
                    <option>Dogo argentino</option>
                    <option>Berger de Brie</option>
                    <option>Labrador</option>
                </select>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Country'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_13px" id="ddlCountries">
                    <option value="" selected disabled><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Please select'), ENT_NOQUOTES) ?></option>
                    <option>Czech Republic</option>
                    <option>Afghanistan</option>
                    <option>Kuwait</option>
                </select>
            </div>
        </form>
        <button type="submit" class="btn btn-danger btn-xl pull-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create profile'), ENT_NOQUOTES) ?></button>
    </div>
</div>