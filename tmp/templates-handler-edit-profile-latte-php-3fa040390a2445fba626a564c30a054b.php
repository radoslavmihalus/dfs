<?php
// source: templates/handler-edit-profile.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7645212145', 'html')
;
//
// main template
//
?>
<div class="col-lg-8">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <div class="panel-description" style="margin-bottom: 10px;"><i class="glyphicons glyphicons-edit"></i>&nbsp;&nbsp;Edit profile</div>
        <ul id="EditProfile" class="nav nav-tabs" style="border-bottom:0px !important;font-size:13px;">
            <li class="active"><a class="EditProfilelink" href="#informations" data-toggle="tab"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Informations'), ENT_NOQUOTES) ?></a></li>
            <li><a class="EditProfilelink" href="#pictures" data-toggle="tab"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Cover photo'), ENT_NOQUOTES) ?></a></li>
        </ul>
        <div id="EditProfileContent" class="tab-content">
            <div class="tab-pane fade in active" id="informations">
                <div class="panel panel-default registration_block transparent_white">
                    <div class="panel-body">
                        <span class="form-secondary-description" style="display:block;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Basic informations about you'), ENT_NOQUOTES) ?></span>
                        <hr>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Your profile picture'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="file" class="form-control font_size_13px" id="txtHandlerProfilePicture" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Your profile picture'), ENT_COMPAT) ?>">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Select the breed that you can handle'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <select class="form-control font_size_13px" id="ddlBreedList">
                                <option>Select breed</option>
                                <option>Dogo argentino</option>
                                <option>Berger de Brie</option>
                                <option>Labrador</option>
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
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Your cover photo'), ENT_NOQUOTES) ?> <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="file" class="form-control font_size_13px" id="txtHandlerCoverPhoto" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Handler cover photo'), ENT_COMPAT) ?>">
                        </div>
                        <button type="submit" class="btn btn-danger btn-xl pull-right"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Save'), ENT_NOQUOTES) ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

