<?php
// source: templates/top-menu.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('5184070232', 'html')
;
//
// main template
//
?>
<nav class="navbar-default navbar-fixed-top">
    <div class="container-fluid top-menu">
        <button type="button" class="navbar-toggle collapsed toogle-margin-zero" data-toggle="collapse" data-target="#user-menu">
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
            <a href="#">
                <i class="notification-icon fa fa-cog fa-1x"></i>
                <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
            </a>
        </div>
    </div>
</nav>