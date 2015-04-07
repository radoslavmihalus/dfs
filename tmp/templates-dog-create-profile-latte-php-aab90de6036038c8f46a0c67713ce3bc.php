<?php
// source: templates/dog-create-profile.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6565797517', 'html')
;
//
// main template
//
?>
<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateDogProfile">
            <h2 class="text-center text-uppercase"><i class="glyphicons glyphicons-dog"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add a dog'), ENT_NOQUOTES) ?></h2>
            <span class="form-secondary-description" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Basic informations about your dog'), ENT_NOQUOTES) ?></span>
            <hr>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Gender'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <label class="radio-inline">
                    <input type="radio" name="GenderDog"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Dog'), ENT_NOQUOTES) ?>

                </label>
                <label class="radio-inline">
                    <input type="radio" name="GenderBitch"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Bitch'), ENT_NOQUOTES) ?>

                </label>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Breed'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_13px" id="ddlBreedList">
                    <option value="" selected disabled><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Please select'), ENT_NOQUOTES) ?></option>
                    <option>Dogo argentino</option>
                    <option>Berger de Brie</option>
                    <option>Labrador</option>
                </select>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Offer your dog for mating'), ENT_NOQUOTES) ?>? <i class="fa fa-question-circle tooltip_brown"></i></span>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="radio" value="1">Yes
                    </label>
                    <label>
                        <input type="checkbox" class="radio" value="1">No
                    </label>
                </div>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Dogs name'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtDogName" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Dogs name as shown in the pedigree'), ENT_COMPAT) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Dogs profile picture'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="file" class="form-control font_size_13px" id="txtDogProfilePicture" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Dogs profile picture'), ENT_COMPAT) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Pedigree registration number'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtPedigreeRegistrationNumber" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Pedigree registration number'), ENT_COMPAT) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Date of birth'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 5px;">
                        <select class="form-control font_size_13px" id="ddlDay">
                            <option value="" selected disabled>Day</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 5px;">
                        <select class="form-control font_size_13px" id="ddlMonth">
                            <option value="" selected disabled>Month</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 5px;">
                        <select class="form-control font_size_13px" id="ddlYear">
                            <option value="" selected disabled>Year</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Height at the withers (cm)'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtDogHeight" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Height at the withers in centimeters'), ENT_COMPAT) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Weight (kg)'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtDogWeight" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Weight of dog in kilograms'), ENT_COMPAT) ?>">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Country'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_13px" id="ddlCountries">
                    <option value="" selected disabled><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Country'), ENT_NOQUOTES) ?></option>
                    <option>Czech Republic</option>
                    <option>Afghanistan</option>
                    <option>Kuwait</option>
                </select>
            </div>
        </form>
        <button type="submit" class="btn btn-danger btn-xl pull-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add a dog'), ENT_NOQUOTES) ?></button>
    </div>
</div>  