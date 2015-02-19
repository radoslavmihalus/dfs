<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DOGFORSHOW</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300|500' rel='stylesheet' type='text/css'>
        <!--jQuery Animations -->
        <link rel="stylesheet" href="css/animations.css">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <!-- Main page style -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Glyphicons -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="fonts/glyphicons/font-awesome/css/font-awesome.min.css">
    </head>
    <body role="document">
        <!-- Navigation DOGFORSHOW  -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle navbar-right" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
<!--                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>-->
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- Friends request -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                       <span class="badge badge-important">3</span> <i class="fa fa-users color-gray"></i>  <i class="fa fa-caret-down color-gray"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <p class="text-center popup_boxstyle_headings">
                                <strong>Friends requests</strong>
                            </p>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div >
                                    <div class="no_image_thumb pull-left text-center img-rounded"><i class="fa fa-user fa-2x "></i></div>  
                                    <p class="friend_request_name"><strong>Radoslav Mihalus</strong></p>
                                </div>
                                <div><button type="button" class="btn btn-default btn-xs"><i class="fa fa-user-plus"></i> Accept</button> <button type="button" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i> Decline</button></div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div >
                                    <img src="img/referer2.jpg" class="pull-left image_thumb img-rounded"/>  
                                    <p class="friend_request_name"><strong>Shitzu kennel Slovakia</strong></p>
                                </div>
                                <div><button type="button" class="btn btn-default btn-xs"><i class="fa fa-user-plus"></i> Accept</button> <button type="button" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i> Decline</button></div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div >
                                    <img src="img/referer1.jpg" class="pull-left image_thumb img-rounded"/>  
                                    <p class="friend_request_name"><strong>Martina Brunina</strong></p>
                                </div>
                                <div><button type="button" class="btn btn-default btn-xs"><i class="fa fa-user-plus"></i> Accept</button> <button type="button" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i> Decline</button></div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center popup_boxstyle_headings" href="#">
                                <strong>See all friend requests</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- User-messages -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                       <span class="badge">0</span>  <i class="fa fa-envelope fa-fw color-gray"></i>  <i class="fa fa-caret-down color-gray"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <p class="text-center popup_boxstyle_headings">
                                <strong>Messages</strong>
                            </p>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div >
                                    <img src="img/referer1.jpg" class="pull-left image_thumb img-rounded"/>  
                                    <p class="friend_request_name"><strong>Martina Brunina</strong></p>
                                </div>
                                <div>
                                    <p class="message_text">Ahoj, tak tento portal je naozaj na urovni...</p>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center popup_boxstyle_headings" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- User Notifications -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="badge">0</span> <i class="fa fa-bell fa-fw color-gray"></i>  <i class="fa fa-caret-down color-gray"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <p class="text-center popup_boxstyle_headings">
                                <strong>Notifications</strong>
                            </p>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-thumbs-up fa-fw"></i> New like
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center popup_boxstyle_headings" href="#">
                                <strong>See All notifications</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- User account -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw color-gray"></i>  <i class="fa fa-caret-down color-gray"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- User sidebar navigation -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav in" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="search ...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
<!--                        <li>
                            <a href="index.html" class="active"><i class="fa fa-dashboard fa-fw"></i> My DOGFORSHOW profile</a>
                        </li>-->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Animation scripts -->
        <script src='js/css3-animate-it.js'></script>
        <script src="js/jquery.easing.min.js"></script>
        <!-- Scrolling scripts -->
        <script src="js/scrolling-nav.js"></script>
        <!-- Counter scripts -->
        <!-- Google re-captcha -->
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </body>
</html>
