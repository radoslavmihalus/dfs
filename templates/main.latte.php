<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DOGFORSHOW</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Google font definition -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300|500' rel='stylesheet' type='text/css'>
        <!-- Bootstrap definition -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
        <!-- Typographyp definition -->
        <link href="css/typography.css" rel="stylesheet">
        <!-- Top Menu section definition -->
        <link href="css/top-menu.css" rel="stylesheet">
        <!-- User Menu section definition -->
        <link href="css/user-menu.css" rel="stylesheet">
        <!-- Profile Menu section definition -->
        <link href="css/profile-menu.css" rel="stylesheet">
        <!-- Edit Profile Menu section definition -->
        <link href="css/edit-profile-menu.css" rel="stylesheet">
        <!-- Main template definition -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Components definition -->
        <link href="css/components.css" rel="stylesheet">
        <!-- Profile template -->
        <link href="css/profile.css" rel="stylesheet">
        <!-- Timeline template -->
        <link href="css/timeline.css" rel="stylesheet">
        <!-- Glyphicons -->
        <link rel="stylesheet" href="fonts/glyphicons/font-awesome/css/font-awesome.min.css">
        <!-- Glyphicons PRO -->
        <link rel="stylesheet" href="fonts/glyphicons/pro-awesome/css/glyphicons-pro.css">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <style>
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
        <script type="text/javascript">
            $(document).ready(function ()
            {
                var wheight = $(window).height() - 51;
                $(".user-menu").css("max-height", wheight);
            });
            $(window).resize(function () {
                var wheight = $(window).height() - 51;
                $(".user-menu").css("max-height", wheight);
            });
        </script>
    </head>
    <body>
        <!-- top-menu -->
        {include 'top-menu.latte.php'}
        <!-- /top-menu -->
        <!-- user-menu -->
        {include 'user-menu.latte.php'}
        <!--/user-menu -->

        <!-- Main content -->
        <div class="container-fluid content-wrapper">
            <div class="row" style="margin-left: 0px;margin-right: 0px;">
                <div class="col-md-12" style="padding-left: 5px;padding-right: 5px;">
                    {include 'create-profile-switcher.latte.php'}
                </div>
            </div>
        </div>
        <!-- /Main content -->
        <!-- Scripts -->
    </body>
</html>

