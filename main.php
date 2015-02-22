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
        <link href="css/home.css" rel="stylesheet">
        <!-- Glyphicons -->
        <link rel="stylesheet" href="fonts/glyphicons/font-awesome/css/font-awesome.min.css">
    </head>

    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"></a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <!-- Friends request -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="badge badge-important">3</span> <i class="fa fa-users color-gray"></i>  <i class="fa fa-caret-down color-gray"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks">
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
                        <ul class="dropdown-menu dropdown-messages">
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
                            <li><a href="#"><i class="fa fa-exchange"></i></i> Switch Accounts</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" style="font-size:12px;" placeholder="Search DOGFORSHOW ...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li >
                                <a id="profile_stack" href="#">
                                    <img src="img/referer1.jpg" class="pull-left image_thumb img-rounded"/>  
                                    <p class="profile_type"><i class="fa fa-eye">&nbsp;&nbsp;</i>Spectator</p>
                                    <p class="profile_name">Steffanie Jones Smith</p>
                                </a>
                            </li>
                            <li class="user_sidebar_link">
                                <a href="#"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Kennels <span class="badge pull-right">670</span></a>
                            </li>
                            <li class="user_sidebar_link">
                                <a href="#"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Owners <span class="badge pull-right">420</span></a>
                            </li>
                            <li class="user_sidebar_link">
                                <a href="#"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Handlers <span class="badge pull-right">50</span></a>
                            </li>
                            <li class="user_sidebar_link">
                                <a href="#"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Dogs <span class="badge pull-right">1.160</span></a>
                            </li>
                            <li class="user_sidebar_link">
                                <a href="#"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Stud dogs <span class="badge pull-right">480</span></a>
                            </li>
                            <li class="user_sidebar_link">
                                <a href="#"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Planed litters <span class="badge pull-right">210</span></a>
                            </li>
                            <li class="user_sidebar_link">
                                <a href="#"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;Puppies for sale <span class="badge pull-right">60</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <div id="page-wrapper">
                <div class="row animatedParent animateOnce" style="padding-top: 10px;">
                    <div class="panel-default col-md-4 animated fadeIn" style="font-size: 12px;min-width: 244px">
                        <div id="main_heading" class="panel-heading"><i class="fa fa-user-plus fa-lg"></i>&nbsp;&nbsp;Create profile</div>
                        <div class="panel-body" style="background-color: white;min-height:380px;margin-bottom: 10px;">
                            <div class="">
<!--                                <p class="text-center block"><span class="glyphicon glyphicon-home section_heading_icon_border " aria-hidden="true"></span></p>-->
                                <h3 class="section_heading text-center text-uppercase">Kennel</h3>
                                <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;</span> Create profile</button></p>
                                <ul class="section_list" style="pading-left:0px;">
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
                    </div>
                    <div class="panel-default col-md-4 animated fadeIn" style="font-size: 12px;min-width: 244px">
                        <div id="main_heading" class="panel-heading"><i class="fa fa-user-plus fa-lg"></i>&nbsp;&nbsp;Create profile</div>
                        <div class="panel-body" style="background-color: white;min-height:380px;margin-bottom: 10px;">
                            <div class="">
<!--                                <p class="text-center block"><span class="glyphicon glyphicon-home section_heading_icon_border " aria-hidden="true"></span></p>-->
                                <h3 class="section_heading text-center text-uppercase">Owner of purebred dog</h3>
                                <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;</span> Create profile</button></p>
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
                    </div>
                    <div class="panel-default col-md-4 animated fadeIn" style="font-size: 12px;min-width: 244px">
                        <div id="main_heading" class="panel-heading"><i class="fa fa-user-plus fa-lg"></i>&nbsp;&nbsp;Create profile</div>
                        <div class="panel-body" style="background-color: white;min-height:380px;margin-bottom: 10px;">
                            <div class="">
<!--                                <p class="text-center block"><span class="glyphicon glyphicon-home section_heading_icon_border " aria-hidden="true"></span></p>-->
                                <h3 class="section_heading text-center text-uppercase">Handler</h3>
                                <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;</span> Create profile</button></p>
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
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Animation scripts -->
    <script src='js/css3-animate-it.js'></script>
    <script src="js/jquery.easing.min.js"></script>
    <!-- Scrolling scripts -->
    <script src="js/scrolling-nav.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/menu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/menu/sb-admin-2.js"></script>

</body>

</html>
