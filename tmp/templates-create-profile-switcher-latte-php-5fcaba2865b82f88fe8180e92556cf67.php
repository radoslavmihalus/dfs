<?php
// source: templates/create-profile-switcher.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('2692255092', 'html')
;
//
// main template
//
?>
<div class="col-md-4" style="font-size: 12px;">
    <div class="panel-body component" style="background-color: white;min-height:430px;margin-bottom: 10px;">
        <h2 class="text-center text-uppercase"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel'), ENT_NOQUOTES) ?></h2>
        <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create profile'), ENT_NOQUOTES) ?></button></p>
        <hr>
        <ul class="section_list">
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create a clear profile of your kennel'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create unique profiles of your dogs'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Offer your dogs at stud'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Inform about planned litters'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Offer puppies for sale from planned litters'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add awards and titles of your dogs'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add dogshow successes and keep show history of your dog in one place'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add working exams and health informations'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add pedigrees'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add photos of your dogs'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Share your succeses on social networks'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Communicate with other members of DOGFORSHOW'), ENT_NOQUOTES) ?></li>
        </ul>
    </div>
</div>
<div class="col-md-4" style="font-size: 12px;">
    <div class="panel-body component" style="background-color: white;min-height:430px;margin-bottom: 10px;">
        <h2 class="text-center text-uppercase"><i class="glyphicons glyphicons-user"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Owner of purebred dog'), ENT_NOQUOTES) ?></h2>
        <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create profile'), ENT_NOQUOTES) ?></button></p>
        <hr>
        <ul class="section_list">
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create a clear owner profile'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Possibility to migrate on kennel profile'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Offer your dogs at stud'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add awards and titles of your dogs'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add dogshow successes and keep show history of your dog in one place'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add working exams and health informations'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add pedigrees'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add photos of your dogs'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Share your succeses on social networks'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Communicate with other members of DOGFORSHOW'), ENT_NOQUOTES) ?></li>
        </ul>
    </div>
</div>
<div class="panel-default col-md-4" style="font-size: 12px;">
    <div class="panel-body component" style="background-color: white;min-height:430px;margin-bottom: 10px;">
        <h2 class="text-center text-uppercase"><i class="glyphicons glyphicons-shirt"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Handler'), ENT_NOQUOTES) ?></h2>
        <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create profile'), ENT_NOQUOTES) ?></button></p>
        <hr>
        <ul class="section_list">
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create a clear handler profile'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add awards and certificates'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add your dogshow successes and titles'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add breeds list for handling'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add photos'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Offer your handling services'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Share successes via social networks'), ENT_NOQUOTES) ?></li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Communicate with other members of DOGFORSHOW'), ENT_NOQUOTES) ?></li>
        </ul>
    </div>
</div>
