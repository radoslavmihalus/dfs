<?php
// source: templates/dog-profile.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('4843327572', 'html')
;
//
// main template
//
?>
<div id="profile_div" class="panel-default col-lg-12 profile_wrapper" style="font-size: 12px;">
    <div class="panel-body component">
        <div class="row">
            <div class="col-md-12">
                <h1 class="profile_type_heading text-uppercase" style="margin-top: 0px;">Bronca La Rosa de Inca</h1>
                <a href="#">
                    <span class="profile-type-description pull-left text-uppercase" style="margin-bottom: 10px;text-decoration: underline;"><i class="fa fa-home" style="margin-right: 10px;"></i>La Rosa de inca</span>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="dog-image-profile-thumb">

                </div>
            </div>
            <div class="col-md-6">
                <ul class="dog-information-list">
                    <li><i class="fa fa-tag" style="margin-right: 10px;"></i><strong>Dogo Argentino</strong></li>
                    <li><i class="fa fa-venus gender-bitch" style="margin-right: 10px;"></i>Bitch<!--<i class="fa fa-mars gender-dog" style="color:#0c9eea;margin-right: 10px;"></i>Dog--></li>
                    <li><i class="fa fa-star" style="margin-right: 10px;color:#777;"></i>21.10.2012</li>
                    <li class="text-uppercase"><i class="fa fa-calendar" style="margin-right: 10px;color:#777;"></i>spkp 1304</li>
                    <li><i class="fa fa-arrows-v" style="margin-right: 10px;color:#777;"></i>46&nbsp;cm</li>
                    <li><i class="fa fa-tachometer" style="margin-right: 10px;color:#777;"></i>22&nbsp;kg</li>
                    <li><i class="fa fa-map-marker" style="margin-right: 10px;color:#777;"></i>Slovakia</li>
                </ul>
            </div>
        </div>
        <hr style="margin-bottom: 0px;margin-top: 10px;">
        <!-- Profile menu-->
        <div class="row">
            <div class="container-fluid profile-menu">
                <div class="collapse navbar-collapse" id="profile-menu" role="navigation" style="padding: 0px;">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Home'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Titles'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Shows'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Working exams'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Health'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Pedigree'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Photos'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Videos'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Matings'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Coowners'), ENT_NOQUOTES) ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">

        </div>
    </div>
</div>
