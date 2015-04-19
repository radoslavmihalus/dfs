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
        <script type="text/javascript" src="js/validate/jquery.validate.min.js"></script>

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
                background-color:#8C8067;
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
        <script src="js/jquery-noty/themes/bootstrap.js" type="text/javascript"></script>
        <!-- Loading animation -->
        <script src="js/jquery.nimble.loader.js" type="text/javascript"></script>
        <script src="templates/js/pageinit.js" type="text/javascript"></script>
    </head>

    <body role="document">
        <!-- Navigation DOGFORSHOW  -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand logotyp" href="#">
                        <img alt="Brand" style="width:150px;" src="img/logo.png">
                    </a>
                </div>
            </div>
        </nav>
        <!-- DOGFORSHOW landing jumbotron -->
        <section id="join">
            <div class="jumbotron landing_header_reset_password">
                <div class="container animatedParent animateOnce">
                    <div class="row animated fadeIn">
                        <div class="col-md-8 container" style="float:none;">
                            <p class="text-center text-uppercase landing_header_slogan"><strong>{_ 'Type your new password'}</strong></p>
                            <div class="form-group">
                                <span style="display:block;margin-bottom: 5px; color:white;">{_ 'New password'}</span>
                                <input type="password" class="form-control font_size_13px" id="txtNewPassword" placeholder="{_ 'New password'}">
                            </div>
                            <div class="form-group">
                                <span style="display:block;margin-bottom: 5px; color:white;">{_ 'Repeat new password'}</span>
                                <input type="password" class="form-control font_size_13px" id="txtConfirmPassword" placeholder="{_ 'Repeat new password'}">
                            </div>
                            <button type="submit" id="btnResetPassword" class="btn btn-danger btn-block">&nbsp;&nbsp;{_ 'Submit'}</button>
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
