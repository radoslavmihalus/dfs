<?php
// source: templates/top-menu.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7237087634', 'html')
;
//
// main template
//
?>
<nav class="navbar-default navbar-fixed-top">
    <div class="container-fluid top-menu">
        <button type="button" class="navbar-toggle collapsed toogle-margin-zero" style="margin-top: 5px;margin-bottom: 0px;" data-toggle="collapse" data-target="#user-menu">
            <i class="fa fa-bars"></i>
        </button>
        <i class="refresh-icon fa fa-list-alt fa-1x"></i>
        <div class="notification-bar">
            <a href="#">
                <i class="notification-icon fa fa-users fa-1x"></i>
                <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
            </a>
            <a href="#">
                <i class="notification-icon fa fa-envelope fa-1x"></i>
                <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
            </a>
            <a href="#">
                <i class="notification-icon fa fa-bell fa-1x"></i>
                <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
            </a>
            <div class="dropdown" style="float:left;">
                <a href="#" class="dropdown-toggle" style="margin-right: 5px;" type="button" id="UserAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="notification-icon fa fa-cog fa-1x"></i>
                    <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu user-account" role="menu" aria-labelledby="UserAccount">
                    <li role="presentation" class="dropdown-header text-uppercase" style="border-bottom: whitesmoke 1px solid;padding:10px;"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('User account'), ENT_NOQUOTES) ?></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-cog "></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Account settings'), ENT_NOQUOTES) ?></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-trash "></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Delete account'), ENT_NOQUOTES) ?></a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Logout'), ENT_NOQUOTES) ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>