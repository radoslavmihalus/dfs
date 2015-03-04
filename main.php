<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DOGFORSHOW</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Google font definition -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300|500' rel='stylesheet' type='text/css'>
        <!-- /Google font definition -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/typography.css" rel="stylesheet">
        <!-- Top Menu section definition -->
        <link href="css/top-menu.css" rel="stylesheet">
        <!-- User Menu section definition -->
        <link href="css/user-menu.css" rel="stylesheet">
        <!-- Main template definition -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Glyphicons -->
        <link rel="stylesheet" href="fonts/glyphicons/font-awesome/css/font-awesome.min.css">
    </head>
    <body>
        <!-- top-menu -->
        <?php
            include "templates/top-menu.latte.php";
        ?>
        <!-- /top-menu -->
        <!-- user-menu -->
        <?php
            include "templates/user-menu.latte.php";
        ?>
        <!--/user-menu -->
        
        <!-- Main content -->
        <div class="container-fluid content-wrapper">
            <div class="row" style="margin-left: 0px;margin-right: 0px;">
                <div class="col-md-12" style="padding-left: 5px;padding-right: 5px;">
                    <?php
                    include "templates/create-profile-switcher.latte.php";
                    ?>
                </div>
            </div>
        </div>
        <!-- /Main content -->
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>

