<?php
// source: templates/kennel-profile.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9259140231', 'html')
;
//
// main template
//
?>
<div id="profile_div" class="panel-default col-lg-12 profile_wrapper" style="font-size: 12px;">
    <div class="panel-body component">
        <div class="profile-header-image">
            <div class="header-spacer">
            </div>
            <img src="img/referer1.jpg" class="pull-left image-profile-thumb">
        </div>
        <div class="row">
            <div class="col-md-6">
                <h1 class="profile_type_heading text-uppercase">Faalat rhodesian ridgeback kennel</h1>
                <span class="profile-type-description"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel'), ENT_NOQUOTES) ?></span>
                <span class="profile-type-description" style="margin-left: 20px"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Slovakia</span>
            </div>
            <div class="col-md-6" style="padding-top: 15px;">
                <div class="btn-group btn-group-sm btn-group-justified" role="group" aria-label="...">
                    <a type="button" class="btn btn-default"><i class="fa fa-users"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add friend'), ENT_NOQUOTES) ?></a>
                    <a type="button" class="btn btn-default"><i class="fa fa-rss"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Follow'), ENT_NOQUOTES) ?></a>
                    <a type="button" class="btn btn-default"><i class="fa fa-envelope"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Message'), ENT_NOQUOTES) ?></a>
                    <a type="button" class="btn btn-default navbar-toggle collapsed toogle-margin-zero" data-toggle="collapse" data-target="#profile-menu">
                    <i class="fa fa-ellipsis-v"></i>
                    </a>
                </div>
            </div>
        </div>
        <hr style="margin-bottom: 0px;margin-top: 10px;">
        <!-- Profile menu-->
        <div class="row">
            <div class="container-fluid profile-menu">
                <div class="collapse navbar-collapse" id="profile-menu" role="navigation" style="padding: 0px;">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Home'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Awards'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Our dogs'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Planned litters'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Puppies for sale'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Photos'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Videos'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Friends'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Followers'), ENT_NOQUOTES) ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="col-md-4">
            <!-- Description panel-->
            <div class="panel-body component col-lg-12">
                <!-- FCI number panel-->
                <div class="panel-description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennel FCI number'), ENT_NOQUOTES) ?>

                </div>
                <div class="text-justify" style="font-size:12px;padding-top: 10px;">
                    1478/2014
                </div>
                <hr>
                <!-- Kennel breed panel-->
                <div class="panel-description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Breeds bred by our kennel'), ENT_NOQUOTES) ?></div>
                <div class="text-justify" style="font-size:12px;padding-top: 10px;">
                    Cane Corso Italiano
                </div>
                <hr>
                <!-- Kennel description panel-->
                <div class="panel-description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('About us'), ENT_NOQUOTES) ?>

                </div>
                <div class="text-justify" style="font-size:12px;padding-top: 10px;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id tellus eros. Ut ultricies pharetra nisi, vel sodales enim. Fusce rutrum urna justo. Nulla commodo iaculis convallis. Duis ac sodales nulla, vel condimentum justo. Mauris at nisi id metus pellentesque facilisis quis eget dolor. Suspendisse interdum magna enim, vel pellentesque dolor tempus consectetur. Suspendisse sed metus leo. Nunc vitae dictum risus, convallis varius metus. Donec neque velit, volutpat vel tincidunt a, dignissim at nibh.
                </div>
                <hr>
                <!-- Kennel website-->
                <div class="panel-description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Website'), ENT_NOQUOTES) ?>

                </div>
                <div class="text-justify" style="font-size:12px;padding-top: 10px;">
                    www.something.com
                </div>
            </div>
            <!-- Dogs panel-->
<!--            <div class="panel-body component col-lg-12">
                <div class="row" style="padding-left:15px;padding-right:15px;padding-bottom: 15px;">
                    <div class="panel-description"><i class="fa fa-paw"></i>&nbsp;&nbsp;Dogs 
                        <a href="#" class="panel-edit-button btn btn-default btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add dog</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p style="font-size:12px;color:gray">
                            <i class="fa fa-mars gender-dog" style="color:#0c9eea"></i>&nbsp;Males
                        </p>
                        <ul class="dog-list">
                            <li>
                                <a>
                                    <div class="dog-thumb pull-left"></div>
                                    <p class="dog-name">AMIR faalat rhodesian ridgeback</p>
                                    <p class="dog-datebirth"><i class="fa fa-calendar-o"></i>&nbsp;15.2.2014</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p style="font-size:12px;color:gray">
                            <i class="fa fa-venus gender-bitch"></i>&nbsp;Females
                        </p>
                        <ul class="dog-list">
                            <li>
                                <a>
                                    <div class="dog-thumb pull-left"></div>
                                    <p class="dog-name">Jasmine faalat rhodesian ridgeback</p>
                                    <p class="dog-datebirth"><i class="fa fa-calendar-o"></i>&nbsp;15.2.2014</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>-->
        </div>
        <div class="col-md-8">
<!--            <div class="panel-body component col-md-6">
                <div class="row" style="padding-left:15px;padding-right:15px;padding-bottom: 15px;">
                    <div class="panel-description"><i class="fa fa-users"></i>&nbsp;&nbsp;Friends
                    </div>
                </div>
            </div>
             Timeline events
            <div class="panel-body component col-lg-12">
                <div class="row" style="padding-left:15px;padding-right:15px;padding-bottom: 15px;">
                    <div class="panel-description"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Timeline events 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        //<?php
//                        include "templates/timeline.latte.php";
// ?>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>

