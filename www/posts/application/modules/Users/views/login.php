<div class="header">
    <div class="container text-center">
        <div class="wrap-logo">
            <a href="<?=PATH?>" class="logo">
                <img src="<?=BASE.LOGO?>" style="max-height: 50px; position: relative; top: -1px;">
            </a>
        </div>

        <ul class="nav navbar-nav pull-right">
            <li>
                <div class="form-group form-group-sm" style="margin: 15px 10px 0 0;">
                    <select class="form-control language">
                        <?php if(!empty($lang))
                        foreach ($lang as $row) {
                        ?>
                        <option value="<?=$row?>" <?=(LANGUAGE == $row)?"selected":""?>><?=strtoupper($row)?></option>
                        <?php }?>
                    </select>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="banner">
    <div class="box-shadow"></div>
    <div class="container">
        <div class="col-md-12">
            <div class="wrap-form">
                <ul class="nav nav-tabs">
                    <li class="active" style="<?=(!REGISTER)?"width: 100%; border-bottom: 1px solid #eee;":""?>"><a data-toggle="tab" href="#loginFrom"><?=l('slug-login')?></a></li>
                    <?php if(REGISTER){?>
                    <li><a data-toggle="tab" href="#registerForm"><?=l('slug-register')?></a></li>
                    <?php }?>
                </ul>

                <div class="tab-content">
                    <div id="loginFrom" class="tab-pane fade in active">
                        <div class="col-md-12">
                            <form class="form-horizontal formLogin" role="form">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" name="username" placeholder="<?=l('slug-username')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder="<?=l('slug-password')?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="msg error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">                
                                            <div class="checkbox">
                                                <input type="checkbox" class="icheck"> <?=l('slug-remember-me')?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group pull-right">                
                                            <button type="submit" class="btn btn-success"><i class="fa fa-unlock-alt"></i> <?=l('slug-login')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if(REGISTER){?>
                    <div id="registerForm" class="tab-pane fade">
                        <div class="col-md-12">
                            <form class="form-horizontal formRegister" role="form">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" placeholder="<?=l('slug-username')?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="<?=l('slug-password')?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="repassword" placeholder="<?=l('slug-re-password')?>">
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" class="form-control" name="fid" placeholder="<?=l('slug-facebook-user-id')?>">
                                </div>
                                <div class="form-group">
                                    <input type="api_key" class="form-control" name="app_id" placeholder="<?=l('slug-app-id')?>">
                                </div>
                                <div class="form-group">
                                    <input type="api_serect" class="form-control" name="app_secret" placeholder="<?=l('slug-app-secret')?>">
                                </div>
                                <div class="form-group">
                                    <div class="btn-group btn-group-xs pull-right">
                                        <a href="http://findmyfbid.com/" target="_blank" class="btn btn-default"><i class="fa fa-info"></i> <?=l('slug-get-facebook-user-id')?></a>
                                        <a href="https://www.youtube.com/embed/qklrn9R-nJ0" title="<?=l('slug-guide')?>" class="open-image fancybox.iframe btn btn-default"><i class="fa fa-info"></i> <?=l('slug-guide-create-app')?></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="msg-register error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group pull-right">                
                                            <button type="submit" class="btn btn-primary"><?=l('slug-register')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>