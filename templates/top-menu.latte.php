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
            <!-- Top menu messages -->
            <div class="dropdown" style="float:left;">
                <a href="#" class="dropdown-toggle" style="margin-right: 5px;" type="button" id="Messages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="notification-icon fa fa-bell fa-1x"></i>
                    <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu messages" role="menu" aria-labelledby="Messages">
                    <li role="presentation" class="dropdown-header text-uppercase" style="border-bottom: whitesmoke 1px solid;padding:10px;">{_ 'Messages'}</li>
                </ul>
            </div>
            <!-- /Top menu messages -->
            <!-- Top menu user account -->
            <div class="dropdown" style="float:left;">
                <a href="#" class="dropdown-toggle" style="margin-right: 5px;" type="button" id="UserAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="notification-icon fa fa-cog fa-1x"></i>
                    <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu user-account" role="menu" aria-labelledby="UserAccount">
                    <li role="presentation" class="dropdown-header text-uppercase" style="border-bottom: whitesmoke 1px solid;padding:10px;">{_ 'User account'}</li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-cog "></i>&nbsp;&nbsp;{_ 'Account settings'}</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-trash "></i>&nbsp;&nbsp;{_ 'Delete account'}</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;{_ 'Logout'}</a></li>
                </ul>
            </div>
            <!-- /Top menu user account -->
        </div>
    </div>
</nav>