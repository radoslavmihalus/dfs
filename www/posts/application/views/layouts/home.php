<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?=$template['title']?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?=BASE?>assets/plugins/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?=BASE?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=BASE?>assets/css/fonts.css">
        <link rel="stylesheet" href="<?=BASE?>assets/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?=BASE?>assets/plugins/iCheck/square/red.css">
        <link rel="stylesheet" href="<?=BASE?>assets/plugins/fancybox/jquery.fancybox.css">
        <link rel="stylesheet" href="<?=BASE?>assets/css/style.css">
        <link rel="shortcut icon" href="<?=BASE?>assets/img/favicon.ico" type="image/x-icon"/>
        <script type="text/javascript">
            var PATH       = '<?=PATH?>';
            var BASE       = '<?=BASE?>';
            var token      = '<?=$this->security->get_csrf_hash();?>';
            var module     = '<?=ucfirst($this->router->fetch_class());?>';
            var list_chart = [];
        </script>
    </head>
    <body>        
        <?=$template['body']?>
        <script src="<?=BASE?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?=BASE?>assets/plugins/bootstrap/js/bootstrap.js"></script>
        <script src="<?=BASE?>assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
        <script src="<?=BASE?>assets/js/moment.min.js"></script>
        <script src="<?=BASE?>assets/plugins/iCheck/icheck.min.js"></script>
        <script src="<?=BASE?>assets/js/main.js"></script>
    </body>
</html>
