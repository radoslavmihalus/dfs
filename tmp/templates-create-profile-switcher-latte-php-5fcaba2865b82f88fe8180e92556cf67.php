<?php
// source: templates/create-profile-switcher.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3067082776', 'html')
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
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Create a clear profile of your kennel</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Create unique profiles of your dogs</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Offer your dogs at stud</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Inform about planned litters</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Offer puppies for sale from planned litters</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add awards and titles of your dogs</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add dogshow successes and keep show history of your dog in one place</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add working exams and health informations</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add pedigrees</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add photos of your dogs</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Share your succeses on social networks </li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Communicate with other members of DOGFORSHOW</li>
        </ul>
    </div>
</div>
<div class="col-md-4" style="font-size: 12px;">
    <div class="panel-body component" style="background-color: white;min-height:430px;margin-bottom: 10px;">
        <h2 class="text-center text-uppercase"><i class="glyphicons glyphicons-user"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Owner of purebred dog'), ENT_NOQUOTES) ?></h2>
        <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create profile'), ENT_NOQUOTES) ?></button></p>
        <hr>
        <ul class="section_list">
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Create a clear owner profile</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Possibility to migrate on kennel profile</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Offer your dogs at stud</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add awards and titles of your dogs</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add dogshow successes and keep show history of your dog in one place</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add working exams and health informations</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add pedigrees</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add photos of your dogs</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Share your succeses on social networks </li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Communicate with other members of DOGFORSHOW</li>
        </ul>
    </div>
</div>
<div class="panel-default col-md-4" style="font-size: 12px;">
    <div class="panel-body component" style="background-color: white;min-height:430px;margin-bottom: 10px;">
        <h2 class="text-center text-uppercase"><i class="glyphicons glyphicons-shirt"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Handler'), ENT_NOQUOTES) ?></h2>
        <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create profile'), ENT_NOQUOTES) ?></button></p>
        <hr>
        <ul class="section_list">
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Create a clear handler profile</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add awards and certificates</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add your dogshow successes and titles</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add breeds list for handling</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Add photos</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Offer your handling services</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Share successes via social networks</li>
            <li><span class="glyphicon glyphicon-ok section_list_icon" aria-hidden="true"></span>Communicate with other members of DOGFORSHOW</li>
        </ul>
    </div>
</div>
