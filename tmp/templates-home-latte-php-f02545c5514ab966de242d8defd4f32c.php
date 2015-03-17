<?php
// source: templates/home.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('7035526238', 'html')
;
//
// main template
//
?>
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
        <!-- Landing page style -->
        <link href="css/home.css" rel="stylesheet">
        <!-- Glyphicons -->
        <link rel="stylesheet" href="fonts/glyphicons/font-awesome/css/font-awesome.min.css">
        <style>
            body {
                padding-top: 70px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>
    </head>

    <body role="document">
        <!-- Navigation DOGFORSHOW  -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand logotyp" href="#">
                        <img alt="Brand" style="width:150px;" src="img/logo.png">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#join" class="page-scroll text-uppercase landing_navbar_typography">Registration</a></li>
                        <li><a href="#about" class="page-scroll text-uppercase landing_navbar_typography">About</a></li>
                        <li><a href="#follow" class="page-scroll text-uppercase landing_navbar_typography">How we grow</a></li>
                        <li><a href="#discover" class="page-scroll text-uppercase landing_navbar_typography">Discover dogforshow</a></li>
                        <li><a href="#contact" class="page-scroll text-uppercase landing_navbar_typography">Contact us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- DOGFORSHOW landing jumbotron -->
        <section id="join">
            <div class="jumbotron landing_header">
                <div class="container animatedParent animateOnce">
                    <div class="row animated fadeIn">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6 container">
                            <p class="text-center text-uppercase landing_header_slogan">"Breeding happy and healthy <strong>purebred dogs</strong>"</p>
                            <ul id="myTabs" class="nav nav-tabs" style="border-bottom:0px !important;">
                                <li class="active"><a class="myTabslink" href="#login" data-toggle="tab"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Login</a></li>
                                <li><a class="myTabslink" href="#registration" data-toggle="tab"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Registration</a></li>
                            </ul>
                            <div id="myTabsContent" class="tab-content">
                                <div class="tab-pane fade" id="registration">
                                    <div class="panel panel-default registration_block transparent_white">
                                        <div class="panel-body">
                                            <!-- DOGFORSHOW Sign up form -->
                                            <form id="frmSignIn">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="txtName" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="txtSurname" placeholder="Surname">
                                                </div>
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="txtEmail" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="txtPassword" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="txtConfirmPassword" placeholder="Confirm password">
                                                </div>
                                            </form>
                                            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Register</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in active" id="login">
                                    <div class="panel panel-default registration_block transparent_white">
                                        <div class="panel-body">
                                            <!-- DOGFORSHOW Sign up form -->
                                            <form id="frmlogIn">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" id="txtEmail" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" id="txtPassword" placeholder="Password">
                                                </div>
                                            </form>
                                            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Login</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About DOGFORSHOW section -->
        <section id="about">
            <div class="container animatedParent animateOnce">
                <div class="row animated fadeIn">
                    <h2 class="heading text-center text-uppercase"><strong><i class="fa fa-globe"></i>&nbsp;&nbsp;Present internationally on the right place</strong></h2>
                    <p class="secondary_heading text-center">DOGFORSHOW is new international social network dedicated to owners of purebred dogs, kennels and handlers, helping them to present themselves, communicate with each other and mutually inspire</p>
                </div>
            </div>
            <div class="container animatedParent animateOnce">
                <div class="row animated fadeIn">
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-user-plus"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">Possibility to create kennel,owner and handler profile</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-user-plus"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">Create unique profiles of your dogs with possibility to offer your dog for mating</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-trophy"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">Add dogshow successes, awards, titles, working exams, health informations, photos and videos</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-calendar"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">Inform about planned litters and offer puppies for sale</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-users"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">Create friendships and communicate with each other</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-envelope"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">Take oportunity to contact by potential buyers from over the world</h5>
                    </div>
                </div>
            </div>
            <div class="section_divider"></div>
        </section>
        <!-- Follow section -->
        <section id="follow">
            <div class="jumbotron brown animatedParent animateOnce background1">
                <div class="container">
                    <div class="row animated fadeIn">
                        <h2 class="heading text-center text-uppercase"><span class="fa fa-line-chart" aria-hidden="true"></span>&nbsp;&nbsp;<strong>Follow with us how we growing</strong></h2>
                        <p class="secondary_heading text-center">Forget about the classic advertising portals and join the fast growing community</p>
                    </div>
                    <!-- Registered users counters -->
                    <div class="row animated fadeIn">
                        <div class="col-md-4">
                            <div class="col-md-6">
                                <p class="text-center counter_number">1.140</p>
                                <p class="text-center counter_description">Purebred dogs</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-center counter_number">417</p>
                                <p class="text-center counter_description">Stud dogs</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-6">
                                <p class="text-center counter_number">206</p>
                                <p class="text-center counter_description">Planned litters</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-center counter_number">660</p>
                                <p class="text-center counter_description">Kennels</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-6">
                                <p class="text-center counter_number">392</p>
                                <p class="text-center counter_description">Owners</p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-center counter_number">50</p>
                                <p class="text-center counter_description">Handlers</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Discover section -->
        <section id="discover">
            <div class="container animatedParent animateOnce">
                <div class="row animated fadeIn">
                    <h2 class="heading text-center text-uppercase"><i class="fa fa-search"></i>&nbsp;&nbsp;<strong>Discover the DOGFORSHOW community closer</strong></h2>
                    <p class="secondary_heading text-center">We are building an international community of breeders, owners and handlers of purebred dogs, helping them to present themselves, communicate with each other and mutually inspire</p>
                </div>
                <div class="row animated fadeIn">
                    <div class="col-md-6">
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">Kennels</a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">Owners of purebred dogs</a>
                        </div>
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">Handlers</a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">Best in show</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">Purebred dogs</a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">Stud dogs</a>
                        </div>
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">Planned litters</a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">Puppies for sale</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reference Carousel -->
            <div class="section_divider"></div>
        </section>
        <section id="contact">
            <div class="jumbotron brown animatedParent animateOnce">
                <div class="container animatedParent animateOnce">
                    <div class="row animated fadeIn">
                        <div class="col-md-6 brown">
                            <h2 class="heading text-center text-uppercase"><i class="fa fa-envelope"></i>&nbsp;&nbsp;<strong>Contact us</strong></h2>
                            <p class="secondary_heading text-center">Please contact us via the contact form below if you have any questions or issues or if you are interested in advertising on the DOGFORSHOW portal.</p>
                            <form id="Contact">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtSurname" placeholder="Surname">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="txtEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea type="text" class="form-control contact_textarea" id="txtPassword" placeholder="Message text"></textarea>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-6">
                                <!--                                <div class="g-recaptcha landing_captcha" data-sitekey="6LdBSgITAAAAAPHEfML6Of8AKPJ1CTbIrI7BdEql"></div>-->
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;&nbsp;Send</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="heading text-center text-uppercase"><strong>Follow us</strong></h2>
                            <p class="secondary_heading text-center">
                                <a href="https://www.facebook.com/dogforshow" target="_blank" title="DOGFORSHOW on facebook" style="margin-right:15px;">
                                    <span class="fa fa-facebook-official fa-2x follow_link"></span>
                                </a>
                                <a href="https://plus.google.com/+Dogforshow" target="_blank" title="DOGFORSHOW on Google+">
                                    <span class="fa fa-google-plus-square fa-2x white follow_link"></span>
                                </a>
                                <!--                                <a href="https://twitter.com/DOGFORSHOW" target="_blank" title="DOGFORSHOW on Twitter">
                                                                    <span class="fa fa-twitter-square fa-2x white follow_link"></span>
                                                                </a>
                                                                <a href="https://www.pinterest.com/DOGFORSHOW" target="_blank" title="DOGFORSHOW on Pinterest">
                                                                    <span class="fa fa-pinterest-square fa-2x white follow_link"></span>
                                                                </a>-->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
