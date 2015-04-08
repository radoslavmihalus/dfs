<?php
// source: templates/home.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8670803647', 'html')
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
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <script src="js/jquery.js"></script>
        <script src="js/jquery.form.js"></script>
        <!-- Scrolling scripts -->
        <!-- Counter scripts -->

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
            .loading_bar_body {
                height: 100%;
                width: 100%;
                top:0;
                left:0;
                background: url(img/ajax-loader.gif) no-repeat 50% 50%;
            }
        </style>
        <!-- noty - popup alerts -->
        <script src="js/jquery-noty/packaged/jquery.noty.packaged.min.js" type="text/javascript"></script>
        <!-- Loading animation -->
        <script src="js/jquery.nimble.loader.js" type="text/javascript"></script>
        <script src="templates/js/pageinit.js" type="text/javascript"></script>
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
                        <li><a href="#join" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Registration'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#about" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('About us'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#follow" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('How we grow'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#discover" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate(' Discover DOGFORSHOW'), ENT_NOQUOTES) ?></a></li>
                        <li><a href="#contact" class="page-scroll text-uppercase landing_navbar_typography"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Contact us'), ENT_NOQUOTES) ?></a></li>
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
                            <p class="text-center text-uppercase landing_header_slogan"><strong>"<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Breeding happy and healthy purebred dogs'), ENT_NOQUOTES) ?>"</strong></p>
                            <ul id="myTabs" class="nav nav-tabs" style="border-bottom:0px !important;">
                                <li class="active"><a class="myTabslink" href="#login" data-toggle="tab"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Login'), ENT_NOQUOTES) ?></a></li>
                                <li><a class="myTabslink" href="#registration" data-toggle="tab"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Registration'), ENT_NOQUOTES) ?></a></li>
                            </ul>
<?php $_b->templates['8670803647']->renderChildTemplate('registration.latte.php', $template->getParameters()) ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About DOGFORSHOW section -->
        <section id="about">
            <div class="container animatedParent animateOnce">
                <div class="row animated fadeIn">
                    <h2 class="heading text-center text-uppercase"><strong><i class="fa fa-globe"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Present internationally on the right place'), ENT_NOQUOTES) ?></strong></h2>
                    <p class="secondary_heading text-center"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('DOGFORSHOW is new international social network dedicated to owners of purebred dogs, kennels and handlers, helping them to present themselves, communicate with each other and mutually inspire'), ENT_NOQUOTES) ?></p>
                </div>
            </div>
            <div class="container animatedParent animateOnce">
                <div class="row animated fadeIn">
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-user-plus"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Possibility to create kennel,owner and handler profile'), ENT_NOQUOTES) ?></h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border glyphicons glyphicons-dog"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create unique profiles of your dogs with possibility to offer your dog for mating'), ENT_NOQUOTES) ?></h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-trophy drop"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Add dogshow successes, awards, titles, working exams, health informations, photos and videos'), ENT_NOQUOTES) ?></h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-calendar"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Inform about planned litters and offer puppies for sale'), ENT_NOQUOTES) ?></h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-users"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Create friendships and communicate with each other'), ENT_NOQUOTES) ?></h5>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center block "><i class="section_heading_icon_border fa fa-envelope"></i></p>
                        <h5 class="section_heading_h5 text-center text-uppercase"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Take oportunity to contact by potential buyers from over the world'), ENT_NOQUOTES) ?></h5>
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
                        <h2 class="heading text-center text-uppercase"><span class="fa fa-line-chart" aria-hidden="true"></span>&nbsp;&nbsp;<strong><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Follow with us how we growing'), ENT_NOQUOTES) ?></strong></h2>
                        <p class="secondary_heading text-center"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Forget about the classic advertising portals and join the fast growing community'), ENT_NOQUOTES) ?></p>
                    </div>
                    <!-- Registered users counters -->
                    <div class="row animated fadeIn">
                        <div class="col-md-2">
                            <p class="text-center counter_number">1.140</p>
                            <p class="text-center counter_description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Purebred dogs'), ENT_NOQUOTES) ?></p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-center counter_number">417</p>
                            <p class="text-center counter_description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Dogs for mating'), ENT_NOQUOTES) ?></p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-center counter_number">206</p>
                            <p class="text-center counter_description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Planned litters'), ENT_NOQUOTES) ?></p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-center counter_number">660</p>
                            <p class="text-center counter_description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennels'), ENT_NOQUOTES) ?></p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-center counter_number">392</p>
                            <p class="text-center counter_description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Owners of purebred dogs'), ENT_NOQUOTES) ?></p>
                        </div>
                        <div class="col-md-2">
                            <p class="text-center counter_number">50</p>
                            <p class="text-center counter_description"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Handlers'), ENT_NOQUOTES) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Discover section -->
        <section id="discover">
            <div class="container animatedParent animateOnce">
                <div class="row animated fadeIn">
                    <h2 class="heading text-center text-uppercase"><i class="fa fa-search"></i>&nbsp;&nbsp;<strong><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Discover the DOGFORSHOW community closer'), ENT_NOQUOTES) ?></strong></h2>
                    <p class="secondary_heading text-center"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('We are building an international community of breeders, owners and handlers of purebred dogs, helping them to present themselves, communicate with each other and mutually inspire'), ENT_NOQUOTES) ?></p>
                </div>
                <div class="row animated fadeIn">
                    <div class="col-md-6">
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Kennels'), ENT_NOQUOTES) ?></a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Owners of purebred dogs'), ENT_NOQUOTES) ?></a>
                        </div>
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Handlers'), ENT_NOQUOTES) ?></a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Best in show'), ENT_NOQUOTES) ?></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Purebred dogs'), ENT_NOQUOTES) ?></a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Dogs for mating'), ENT_NOQUOTES) ?></a>
                        </div>
                        <div class="col-md-6 community_link form-group">
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Planned litters'), ENT_NOQUOTES) ?></a>
                            <a class="btn text-uppercase btn-lg btn-block" href="#" role="button"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Puppies for sale'), ENT_NOQUOTES) ?></a>
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
                            <h2 class="heading text-center text-uppercase"><i class="fa fa-envelope"></i>&nbsp;&nbsp;<strong><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Contact us'), ENT_NOQUOTES) ?></strong></h2>
                            <p class="secondary_heading text-center"><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Please contact us via the contact form below if you have any questions or issues or if you are interested in advertising on the DOGFORSHOW portal'), ENT_NOQUOTES) ?></p>
                            <form id="Contact">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtName" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Name'), ENT_COMPAT) ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="txtSurname" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Surname'), ENT_COMPAT) ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="txtEmail" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Email'), ENT_COMPAT) ?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea type="text" class="form-control contact_textarea" id="txtPassword" placeholder="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Message'), ENT_COMPAT) ?>"></textarea>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-6">
                                <!--                                <div class="g-recaptcha landing_captcha" data-sitekey="6LdBSgITAAAAAPHEfML6Of8AKPJ1CTbIrI7BdEql"></div>-->
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Send'), ENT_NOQUOTES) ?></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="heading text-center text-uppercase"><strong><?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Follow us'), ENT_NOQUOTES) ?></strong></h2>
                            <p class="secondary_heading text-center">
                                <a href="https://www.facebook.com/dogforshow" target="_blank" title="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('DOGFORSHOW on facebook'), ENT_COMPAT) ?>" style="margin-right:15px;">
                                    <span class="fa fa-facebook-official fa-2x follow_link"></span>
                                </a>
                                <a href="https://plus.google.com/+Dogforshow" target="_blank" title="<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('DOGFORSHOW on Google+'), ENT_COMPAT) ?>">
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
        <script src="js/bootstrap.min.js"></script>
        <!-- Animation scripts -->
        <script src="js/css3-animate-it.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/scrolling-nav.js"></script>
    </body>
</html>
