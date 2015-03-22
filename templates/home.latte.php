<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DOGFORSHOW</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <!-- Glyphicons PRO -->
        <link rel="stylesheet" href="fonts/glyphicons/pro-awesome/css/glyphicons-pro.css">
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
                        <li><a href="#join" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Registration'}</a></li>
                        <li><a href="#about" class="page-scroll text-uppercase landing_navbar_typography">{_ 'About us'}</a></li>
                        <li><a href="#follow" class="page-scroll text-uppercase landing_navbar_typography">{_ 'How we grow'}</a></li>
                        <li><a href="#discover" class="page-scroll text-uppercase landing_navbar_typography">{_ ' Discover DOGFORSHOW'}</a></li>
                        <li><a href="#contact" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Contact us'}</a></li>
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
                            <p class="text-center text-uppercase landing_header_slogan"><strong>"{_ 'Breeding happy and healthy purebred dogs'}"</strong></p>
                            <ul id="myTabs" class="nav nav-tabs" style="border-bottom:0px !important;">
                                <li class="active"><a class="myTabslink" href="#login" data-toggle="tab"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;{_ 'Login'}</a></li>
                                <li><a class="myTabslink" href="#registration" data-toggle="tab"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;{_ 'Registration'}</a></li>
                            </ul>
                            {include 'registration.latte.php'}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About DOGFORSHOW section -->
        <section id="about">
            <div class="container animatedParent animateOnce">
                <div class="row animated fadeIn">
                    <h2 class="heading text-center text-uppercase"><strong><i class="fa fa-globe"></i>&nbsp;&nbsp;{_ 'Present internationally on the right place'}</strong></h2>
                    <p class="secondary_heading text-center">{_ 'DOGFORSHOW is new international social network dedicated to owners of purebred dogs, kennels and handlers, helping them to present themselves, communicate with each other and mutually inspire'}</p>
                </div>
            </div>
            <div class="container animatedParent animateOnce">
                <div class="row animated fadeIn">
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-user-plus"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">{_ 'Possibility to create kennel,owner and handler profile'}</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border glyphicons glyphicons-dog"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">{_ 'Create unique profiles of your dogs with possibility to offer your dog for mating'}</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-trophy drop"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">{_ 'Add dogshow successes, awards, titles, working exams, health informations, photos and videos'}</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-calendar"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">{_ 'Inform about planned litters and offer puppies for sale'}</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-users"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">{_ 'Create friendships and communicate with each other'}</h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-envelope"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase">{_ 'Take oportunity to contact by potential buyers from over the world'}</h5>
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
                        <h2 class="heading text-center text-uppercase"><span class="fa fa-line-chart" aria-hidden="true"></span>&nbsp;&nbsp;<strong>{_ 'Follow with us how we growing'}</strong></h2>
                        <p class="secondary_heading text-center">{_ 'Forget about the classic advertising portals and join the fast growing community'}</p>
                    </div>
                    <!-- Registered users counters -->
                    <div class="row animated fadeIn">
                            <div class="col-md-2">
                                <p class="text-center counter_number">1.140</p>
                                <p class="text-center counter_description">{_ 'Purebred dogs'}</p>
                            </div>
                            <div class="col-md-2">
                                <p class="text-center counter_number">417</p>
                                <p class="text-center counter_description">{_ 'Dogs for mating'}</p>
                            </div>
                            <div class="col-md-2">
                                <p class="text-center counter_number">206</p>
                                <p class="text-center counter_description">{_ 'Planned litters'}</p>
                            </div>
                            <div class="col-md-2">
                                <p class="text-center counter_number">660</p>
                                <p class="text-center counter_description">{_ 'Kennels'}</p>
                            </div>
                            <div class="col-md-2">
                                <p class="text-center counter_number">392</p>
                                <p class="text-center counter_description">{_ 'Owners of purebred dogs'}</p>
                            </div>
                            <div class="col-md-2">
                                <p class="text-center counter_number">50</p>
                                <p class="text-center counter_description">{_ 'Handlers'}</p>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Discover section -->
        <section id="discover">
            <div class="container animatedParent animateOnce">
                <div class="row animated fadeIn">
                    <h2 class="heading text-center text-uppercase"><i class="fa fa-search"></i>&nbsp;&nbsp;<strong>{_ 'Discover the DOGFORSHOW community closer'}</strong></h2>
                    <p class="secondary_heading text-center">{_ 'We are building an international community of breeders, owners and handlers of purebred dogs, helping them to present themselves, communicate with each other and mutually inspire'}</p>
                </div>
                <div class="row animated fadeIn">
                    <div class="col-md-6">
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">{_ 'Kennels'}</a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">{_ 'Owners of purebred dogs'}</a>
                        </div>
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">{_ 'Handlers'}</a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">{_ 'Best in show'}</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">{_ 'Purebred dogs'}</a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">{_ 'Dogs for mating'}</a>
                        </div>
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">{_ 'Planned litters'}</a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button">{_ 'Puppies for sale'}</a>
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
                            <h2 class="heading text-center text-uppercase"><i class="fa fa-envelope"></i>&nbsp;&nbsp;<strong>{_ 'Contact us'}</strong></h2>
                            <p class="secondary_heading text-center">{_ 'Please contact us via the contact form below if you have any questions or issues or if you are interested in advertising on the DOGFORSHOW portal'}</p>
                            <form id="Contact">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtName" placeholder="{_ 'Name'}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtSurname" placeholder="{_ 'Surname'}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="txtEmail" placeholder="{_ 'Email'}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea type="text" class="form-control contact_textarea" id="txtPassword" placeholder="{_ 'Message'}"></textarea>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-6">
                                <!--                                <div class="g-recaptcha landing_captcha" data-sitekey="6LdBSgITAAAAAPHEfML6Of8AKPJ1CTbIrI7BdEql"></div>-->
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;&nbsp;{_ 'Send'}</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="heading text-center text-uppercase"><strong>{_ 'Follow us'}</strong></h2>
                            <p class="secondary_heading text-center">
                                <a href="https://www.facebook.com/dogforshow" target="_blank" title="{_ 'DOGFORSHOW on facebook'}" style="margin-right:15px;">
                                    <span class="fa fa-facebook-official fa-2x follow_link"></span>
                                </a>
                                <a href="https://plus.google.com/+Dogforshow" target="_blank" title="{_ 'DOGFORSHOW on Google+'}">
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
        <script src="js/css3-animate-it.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <!-- Scrolling scripts -->
        <script src="js/scrolling-nav.js"></script>
        <!-- Counter scripts -->
        <!-- Google re-captcha -->
        <script src='https://www.google.com/recaptcha/api.js'></script>

    </body>
</html>
