<?php
// source: templates/user-menu.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('3054257765', 'html')
;
//
// main template
//
?>
<div class="container-fluid user-menu" >
    <div class="collapse navbar-collapse" id="user-menu" role="navigation" style="padding: 0px;">
        <ul class="navbar-nav user-menu-list">
            <li>
                <div class="user-block">
                    <img class="user-block-thumb" src="img/referer1.jpg">
<!--                    <p class="user-block-type"><i class="fa fa-eye"></i>&nbsp;&nbsp;</i>Spectator</p>-->
                    <p class="user-block-type"><i class="fa fa-home"></i>&nbsp;&nbsp;</i>Kennel</p>
<!--                    <p class="user-block-type"><i class="fa fa-user"></i>&nbsp;&nbsp;</i>Owner of purebred dog</p>
                    <p class="user-block-type"><i class="fa fa-user"></i>&nbsp;&nbsp;</i>Handler</p>-->
                    <p class="text-uppercase user-block-name">Faalat rhodesian ridgeback kennel</p>
                </div>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-exchange"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Switch profile'), ENT_NOQUOTES) ?>

                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicons glyphicons-edit"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Edit profile'), ENT_NOQUOTES) ?>

                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-trash"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Delete profile'), ENT_NOQUOTES) ?>

                </a>
            </li>
            <li>
                <div class="user-block" style="color:white;">
                    <i class="fa fa-caret-down"></i>&nbsp;&nbsp;DOGFORSHOW
                </div>
            </li>
            <li>
                <div class="input-group custom-search-form search">
                    <input type="text" class="form-control search-bar-typing" placeholder="Search DOGFORSHOW ...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennels'), ENT_NOQUOTES) ?><span class="badge pull-right">620</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicons glyphicons-user"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Owners of purebred dogs'), ENT_NOQUOTES) ?><span class="badge pull-right">340</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicons glyphicons-shirt"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Handlers'), ENT_NOQUOTES) ?><span class="badge pull-right">67</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicons glyphicons-dog"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Purebred dogs'), ENT_NOQUOTES) ?><span class="badge pull-right">1.200</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-mars gender-dog"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Dogs for mating'), ENT_NOQUOTES) ?><span class="badge pull-right">430</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicons glyphicons-calendar"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Planned litters'), ENT_NOQUOTES) ?><span class="badge pull-right">215</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicons glyphicons-shirt"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Puppies for sale'), ENT_NOQUOTES) ?><span class="badge pull-right">57</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="glyphicons glyphicons-envelope"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Contact'), ENT_NOQUOTES) ?>

                </a>
            </li>
        </ul>
    </div>
</div>