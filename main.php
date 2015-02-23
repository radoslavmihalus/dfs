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
        <!-- Smart tooltips -->
        <link rel="stylesheet" href="css/tooltips/jquery-smallipop.css" type="text/css" media="all" title="Screen"/>
        <style>
            body
            {
                padding-top: 50px;
            }
        </style>
    </head>

    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
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
                <!-- Profile switcher -->
                <div class="row animatedParent animateOnce" style="padding-top: 10px;">
                    <div class="panel-default col-md-4 animated fadeIn" style="font-size: 12px;min-width: 244px">
                        <div class="panel-body" style="background-color: white;min-height:430px;margin-bottom: 10px;">
                            <div class="">
                                <h3 class="section_heading text-center text-uppercase">Kennel</h3>
                                <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;</span> Create profile</button></p>
                                <hr>
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
                        <div class="panel-body" style="background-color: white;min-height:430px;margin-bottom: 10px;">
                            <div class="">
                                <h3 class="section_heading text-center text-uppercase">Owner of purebred dog</h3>
                                <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;</span> Create profile</button></p>
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
                    </div>
                    <div class="panel-default col-md-4 animated fadeIn" style="font-size: 12px;min-width: 244px">
                        <div class="panel-body" style="background-color: white;min-height:430px;margin-bottom: 10px;">
                            <div class="">
                                <h3 class="section_heading text-center text-uppercase">Handler</h3>
                                <p class="text-center"><button type="submit" class="btn btn-danger btn-xl" style="margin-bottom:10px;"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;</span> Create profile</button></p>
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
                    </div>
                </div>
                <!-- /Profile switcher -->
                <!-- Kennel registration form -->
                <div class="row animatedParent animateOnce" style="padding-top: 10px;">
                    <div class="panel-default col-md-8 animated fadeIn" style="font-size: 12px;min-width: 244px">
                        <div class="panel-body" style="background-color: white;margin-bottom: 10px;">
                            <form id="frmCreateKennelProfile">
                                <h3 class="section_heading text-center text-uppercase"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Kennel profile</h3>
                                <span class="form_heading"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;Basic informations about kennel</span>
                                <hr>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Kennel name <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtKennelName" placeholder="Kennel name">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Kennel FCI number <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtKennelFciNumber" placeholder="example 987/2011">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Kennel profile picture <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="file" class="form-control font_size_12px" id="txtKennelProfilePicture" placeholder="Kennel profile picture">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Kennel website <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtKennelWebsite" placeholder="example www.dogforshow.com"></textarea>
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Kennel description <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <textarea type="text" style="height:50px;" class="form-control contact_textarea font_size_12px" id="txtKennelDescription" placeholder="Kennel description"></textarea>
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Select the breed bred by your kennel <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <select class="form-control font_size_12px" id="ddlBreedList">
                                        <option>Select breed</option>
                                        <option>Dogo argentino</option>
                                        <option>Berger de Brie</option>
                                        <option>Labrador</option>
                                    </select>
                                </div>
                                <span class="form_heading" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;Basic informations about kennel owner</span>
                                <span>Informations marked with this sign <i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i> will not be accessible to the public or exploited for commercial use by third parties</span>
                                <hr>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Name <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtName" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Surname <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtSurname" placeholder="Surname">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Email <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="email" class="form-control font_size_12px" id="txtEmail" placeholder="example@dogforshow.com">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Address <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtAdress" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Town <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtTown" placeholder="Town">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;ZIP <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtZIP" placeholder="example 94485">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Country <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <select class="form-control font_size_12px" id="ddlCountries">
                                        <option>Select country</option>
                                        <option>Czech Republic</option>
                                        <option>Afghanistan</option>
                                        <option>Kuwait</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Phone number <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtPhone" placeholder="example +420 xxx xxx xxx">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Date of Birth <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control font_size_12px" id="ddlDayBirth">
                                                <option>Day</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control font_size_12px" id="ddlDayBirth">
                                                <option>Month</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control font_size_12px" id="ddlDayBirth">
                                                <option>Year</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button type="submit" class="btn btn-danger btn-xl pull-right"><i class="fa fa-user-plus"></i></span>&nbsp;&nbsp;Create profile</button>
                        </div>
                    </div>  
                </div>
                <!-- /Kennel registration form -->
                <!-- Owner registration form -->
                <div class="row animatedParent animateOnce" style="padding-top: 10px;">
                    <div class="panel-default col-md-8 animated fadeIn" style="font-size: 12px;min-width: 244px">
                        <div class="panel-body" style="background-color: white;margin-bottom: 10px;">
                            <form id="frmCreateOwnerProfile">
                                <h3 class="section_heading text-center text-uppercase"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Owner profile</h3>
                                <span class="form_heading" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;Basic informations about owner</span>
                                <span>Informations marked with this sign <i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i> will not be accessible to the public or exploited for commercial use by third parties</span>
                                <hr>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Profile picture <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="file" class="form-control font_size_12px" id="txtOwnerProfilePicture" placeholder="Owner profile picture">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Name <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtName" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Surname <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtSurname" placeholder="Surname">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Email <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="email" class="form-control font_size_12px" id="txtEmail" placeholder="example@dogforshow.com">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Address <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtAdress" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Town <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtTown" placeholder="Town">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;ZIP <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtZIP" placeholder="example 94485">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Country <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <select class="form-control font_size_12px" id="ddlCountries">
                                        <option>Select country</option>
                                        <option>Czech Republic</option>
                                        <option>Afghanistan</option>
                                        <option>Kuwait</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Phone number <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtPhone" placeholder="example +420 xxx xxx xxx">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Date of Birth <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control font_size_12px" id="ddlDayBirth">
                                                <option>Day</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control font_size_12px" id="ddlDayBirth">
                                                <option>Month</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control font_size_12px" id="ddlDayBirth">
                                                <option>Year</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button type="submit" class="btn btn-danger btn-xl pull-right"><i class="fa fa-user-plus"></i></span>&nbsp;&nbsp;Create profile</button>
                        </div>
                    </div>  
                </div>
                <!-- /Owner registration form -->
                <!-- Handler registration form -->
                <div class="row animatedParent animateOnce" style="padding-top: 10px;">
                    <div class="panel-default col-md-8 animated fadeIn" style="font-size: 12px;min-width: 244px">
                        <div class="panel-body" style="background-color: white;margin-bottom: 10px;">
                            <form id="frmCreateOwnerProfile">
                                <h3 class="section_heading text-center text-uppercase"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Handler profile</h3>
                                <span class="form_heading" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;Basic informations about handler</span>
                                <span>Informations marked with this sign <i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i> will not be accessible to the public or exploited for commercial use by third parties</span>
                                <hr>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Profile picture <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="file" class="form-control font_size_12px" id="txtOwnerProfilePicture" placeholder="Owner profile picture">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Select the breed that you can handle <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <select class="form-control font_size_12px" id="ddlBreedList">
                                        <option>Select breed</option>
                                        <option>Dogo argentino</option>
                                        <option>Berger de Brie</option>
                                        <option>Labrador</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Name <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtName" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Surname <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtSurname" placeholder="Surname">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Email <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="email" class="form-control font_size_12px" id="txtEmail" placeholder="example@dogforshow.com">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Address <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtAdress" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Town <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtTown" placeholder="Town">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;ZIP <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtZIP" placeholder="example 94485">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;">Country <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <select class="form-control font_size_12px" id="ddlCountries">
                                        <option>Select country</option>
                                        <option>Czech Republic</option>
                                        <option>Afghanistan</option>
                                        <option>Kuwait</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Phone number <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <input type="text" class="form-control font_size_12px" id="txtPhone" placeholder="example +420 xxx xxx xxx">
                                </div>
                                <div class="form-group">
                                    <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Date of Birth <i class="fa fa-question-circle tooltip_brown"></i></span>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control font_size_12px" id="ddlDayBirth">
                                                <option>Day</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control font_size_12px" id="ddlDayBirth">
                                                <option>Month</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-control font_size_12px" id="ddlDayBirth">
                                                <option>Year</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <button type="submit" class="btn btn-danger btn-xl pull-right"><i class="fa fa-user-plus"></i></span>&nbsp;&nbsp;Create profile</button>
                        </div>
                    </div>  
                </div>
                <!-- /Handler registration form -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
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
