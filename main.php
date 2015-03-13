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
        <!-- Main template definition -->
        <link href="css/main.css" rel="stylesheet">
        <!-- Components definition -->
        <link href="css/components.css" rel="stylesheet">
        <!-- Profile template -->
        <link href="css/profile.css" rel="stylesheet">
        <!-- Glyphicons -->
        <link rel="stylesheet" href="fonts/glyphicons/font-awesome/css/font-awesome.min.css">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <!-- timeline style -->

        <style>
            .timeline {
                list-style: none;
                padding: 20px 0 20px;
                position: relative;
            }

            .timeline:before {
                top: 0;
                bottom: 0;
                position: absolute;
                content: " ";
                width: 3px;
                background-color: #eeeeee;
                left: 50%;
                margin-left: -1.5px;
            }

            .timeline > li {
                margin-bottom: 20px;
                position: relative;
            }

            .timeline > li:before,
            .timeline > li:after {
                content: " ";
                display: table;
            }

            .timeline > li:after {
                clear: both;
            }

            .timeline > li:before,
            .timeline > li:after {
                content: " ";
                display: table;
            }

            .timeline > li:after {
                clear: both;
            }

            .timeline > li > .timeline-panel {
                width: 46%;
                float: left;
                border: 1px solid #d4d4d4;
                border-radius: 2px;
                padding: 20px;
                position: relative;
                -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
                box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
            }

            .timeline > li > .timeline-panel:before {
                position: absolute;
                top: 26px;
                right: -15px;
                display: inline-block;
                border-top: 15px solid transparent;
                border-left: 15px solid #ccc;
                border-right: 0 solid #ccc;
                border-bottom: 15px solid transparent;
                content: " ";
            }

            .timeline > li > .timeline-panel:after {
                position: absolute;
                top: 27px;
                right: -14px;
                display: inline-block;
                border-top: 14px solid transparent;
                border-left: 14px solid #fff;
                border-right: 0 solid #fff;
                border-bottom: 14px solid transparent;
                content: " ";
            }

            .timeline > li > .timeline-badge {
                color: #fff;
                width: 50px;
                height: 50px;
                line-height: 50px;
                font-size: 1.4em;
                text-align: center;
                position: absolute;
                top: 16px;
                left: 50%;
                margin-left: -25px;
                background-color: #999999;
                z-index: 100;
                border-top-right-radius: 50%;
                border-top-left-radius: 50%;
                border-bottom-right-radius: 50%;
                border-bottom-left-radius: 50%;
            }

            .timeline > li.timeline-inverted > .timeline-panel {
                float: right;
            }

            .timeline > li.timeline-inverted > .timeline-panel:before {
                border-left-width: 0;
                border-right-width: 15px;
                left: -15px;
                right: auto;
            }

            .timeline > li.timeline-inverted > .timeline-panel:after {
                border-left-width: 0;
                border-right-width: 14px;
                left: -14px;
                right: auto;
            }

            .timeline-badge.primary {
                background-color: #2e6da4 !important;
            }

            .timeline-badge.success {
                background-color: #3f903f !important;
            }

            .timeline-badge.warning {
                background-color: #f0ad4e !important;
            }

            .timeline-badge.danger {
                background-color: #d9534f !important;
            }

            .timeline-badge.info {
                background-color: #5bc0de !important;
            }

            .timeline-title {
                margin-top: 0;
                color: inherit;
            }

            .timeline-body > p,
            .timeline-body > ul {
                margin-bottom: 0;
            }

            .timeline-body > p + p {
                margin-top: 5px;
            }

            @media (max-width: 767px) {
                ul.timeline:before {
                    left: 40px;
                }

                ul.timeline > li > .timeline-panel {
                    width: calc(100% - 90px);
                    width: -moz-calc(100% - 90px);
                    width: -webkit-calc(100% - 90px);
                }

                ul.timeline > li > .timeline-badge {
                    left: 15px;
                    margin-left: 0;
                    top: 16px;
                }

                ul.timeline > li > .timeline-panel {
                    float: right;
                }

                ul.timeline > li > .timeline-panel:before {
                    border-left-width: 0;
                    border-right-width: 15px;
                    left: -15px;
                    right: auto;
                }

                ul.timeline > li > .timeline-panel:after {
                    border-left-width: 0;
                    border-right-width: 14px;
                    left: -14px;
                    right: auto;
                }
            }
        </style>

        <!-- timeline -->


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
                    include "templates/kennel-profile.latte.php";
                    include "templates/timeline.latte.php";
                    ?>
                </div>
            </div>
        </div>
        <!-- /Main content -->
        <!-- Scripts -->
    </body>
</html>

