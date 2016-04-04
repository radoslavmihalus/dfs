<header class="main-header">
<a href="<?=PATH?>" class="logo">
    <span class="logo-lg">
        <img src="<?=BASE.LOGO?>" style="max-height: 50px; position: relative; top: -1px;">
    </span>
</a>
<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"></span>
    </a>
    <div class="navbar-custom-menu">
    
        <ul class="nav navbar-nav">
            <li>
                <div class="form-group form-group-sm" style="margin: 10px 10px 0 0;">
                    <select class="form-control language">
                        <?php if(!empty($lang))
                        foreach ($lang as $row) {
                        ?>
                        <option value="<?=$row?>" <?=(LANGUAGE == $row)?"selected":""?>><?=strtoupper($row)?></option>
                        <?php }?>
                    </select>
                </div>
            </li>
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img class="user-image" src="http://graph.facebook.com/<?=session("fid")?>/picture?type=square" width="30" />
                    <span class="hidden-xs"><?=l('slug-hi')?>, <?=session('username')?></span>
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img class="img-circle" src="http://graph.facebook.com/<?=session("fid")?>/picture?type=square" />
                        <p>
                            <?=l('slug-hi')?>, <?=session('username')?>
                            <small><?=date('M d, Y', strtotime(session("user_created")))?></small>
                        </p>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?=PATH?>profile" class="btn btn-default btn-flat"><?=l('slug-profile')?></a>
                        </div>
                        <div class="pull-right">
                            <a href="<?=PATH?>logout" class="btn btn-default btn-flat"><?=l('slug-sign-out')?></a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
</header>