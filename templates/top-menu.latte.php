<nav class="navbar-default navbar-fixed-top">
    <div class="container-fluid top-menu">
        <button type="button" class="navbar-toggle collapsed toogle-margin-zero" style="margin-top: 5px;margin-bottom: 0px;" data-toggle="collapse" data-target="#user-menu">
            <i class="fa fa-bars"></i>
        </button>
        <i class="refresh-icon fa fa-list-alt fa-1x"></i>
        <div class="notification-bar">
            <!-- Top menu friend requests -->
            <div class="dropdown" style="float:left;">
                <a href="#" class="dropdown-toggle" style="margin-right: 2px;" type="button" id="Friend-requests" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="notification-icon fa fa-users fa-1x"></i>
                    <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu friend-requests" role="menu" aria-labelledby="Friend-requests">
                    <li role="presentation" class="dropdown-header text-uppercase" style="border-bottom: whitesmoke 1px solid;padding:10px;">{_ 'Friend requests'}</li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#">
                            <img class="user-block-thumb" src="img/dog.jpg"/>
                            <span class="notification-item-header text-uppercase">Top dog dogforshow kennel</span>
                            <span class="notification-item-event"><i class="fa fa-users"></i>&nbsp;&nbsp;{_ 'send you a friend request'}</span>
                            <span class="notification-item-event-action">
                                <button type="button" class="btn btn-default btn-xs">Accept</button>
                                <button type="button" class="btn btn-default btn-xs">Delete</button>
                            </span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#">
                            <img class="user-block-thumb" src="img/dog3.jpg"/>
                            <span class="notification-item-header text-uppercase">James lee blunt</span>
                            <span class="notification-item-event"><i class="fa fa-users"></i>&nbsp;&nbsp;{_ 'send you a friend request'}</span>
                            <span class="notification-item-event-action">
                                <button type="button" class="btn btn-default btn-xs">Accept</button>
                                <button type="button" class="btn btn-default btn-xs">Delete</button>
                            </span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#">
                            <img class="user-block-thumb" src="img/dog1.jpg"/>
                            <span class="notification-item-header text-uppercase">Viktorij Dogshow</span>
                            <span class="notification-item-event"><i class="fa fa-users"></i>&nbsp;&nbsp;{_ 'send you a friend request'}</span>
                            <span class="notification-item-event-action">
                                <button type="button" class="btn btn-default btn-xs">Accept</button>
                                <button type="button" class="btn btn-default btn-xs">Delete</button>
                            </span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="dropdown-footer" href="#">
                            {_ 'View all'}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /Top menu friend requests -->
            <!-- Top menu messages -->
            <div class="dropdown" style="float:left;">
                <a href="#" class="dropdown-toggle" style="margin-right: 2px;" type="button" id="Messages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="notification-icon fa fa-envelope fa-1x"></i>
                    <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu messages" role="menu" aria-labelledby="Messages">
                    <li role="presentation" class="dropdown-header text-uppercase" style="border-bottom: whitesmoke 1px solid;padding:10px;">{_ 'Messages'}</li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#">
                            <img class="user-block-thumb" src="img/dog1.jpg"/>
                            <span class="notification-item-header text-uppercase">Viktorij Dogshow</span>
                            <span class="notification-item-event-time">25.6.2014&nbsp;&nbsp;22:30</span>
                            <span class="notification-item-event">Hi my friend, i just want to show you my profile ...</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="dropdown-footer" href="#">
                            {_ 'View all'}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /Top menu messages -->
            <!-- Top menu notifications -->
            <div class="dropdown" style="float:left;">
                <a href="#" class="dropdown-toggle" style="margin-right: 2px;" type="button" id="Notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="notification-icon fa fa-bell fa-1x"></i>
                    <i class="notification-icon notification-icon-caret fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu notifications" role="menu" aria-labelledby="Notifications">
                    <li role="presentation" class="dropdown-header text-uppercase" style="border-bottom: whitesmoke 1px solid;padding:10px;">{_ 'Notifications'}</li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#">
                            <img class="user-block-thumb" src="img/referer1.jpg"/>
                            <span class="notification-item-header text-uppercase">Faalat rhodesian ridgeback kennel</span>
                            <span class="notification-item-event"><i class="fa fa-comment"></i>&nbsp;&nbsp;{_ 'comment your post'}</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a role="menuitem" tabindex="-1" href="#">
                            <img class="user-block-thumb" src="img/referer2.jpg"/>
                            <span class="notification-item-header text-uppercase">Stephen Charles King</span>
                            <span class="notification-item-event"><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;{_ 'like your post'}</span>
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="dropdown-footer" href="#">
                            {_ 'View all'}&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /Top menu notifications -->
            <!-- Top menu user account -->
            <div class="dropdown" style="float:left;">
                <a href="#" class="dropdown-toggle" style="margin-right: 2px;" type="button" id="UserAccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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