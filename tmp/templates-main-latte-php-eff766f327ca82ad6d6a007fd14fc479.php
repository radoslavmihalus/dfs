<?php
// source: templates/main.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('6818001721', 'html')
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
    </head>
    <body>
        <!-- top-menu -->
<?php $_b->templates['6818001721']->renderChildTemplate('top-menu.latte.php', $template->getParameters()) ?>
        <!-- /top-menu -->
        <!-- user-menu -->
<?php $_b->templates['6818001721']->renderChildTemplate('user-menu.latte.php', $template->getParameters()) ?>
        <!--/user-menu -->

        <!-- Main content -->
        <div class="container-fluid content-wrapper">
            <div class="row" style="margin-left: 0px;margin-right: 0px;">
                <div class="col-md-12" style="padding-left: 5px;padding-right: 5px;">
<?php $_b->templates['6818001721']->renderChildTemplate('kennel-profile.latte.php', $template->getParameters()) ?>
                </div>
            </div>
        </div>
        <!-- /Main content -->
        <!-- Scripts -->
    </body>
</html>

