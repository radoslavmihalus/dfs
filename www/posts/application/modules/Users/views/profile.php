<section class="content-header">
    <h1 class="head-title">
        <?=l('slug-your-profile')?>
    </h1>
</section>

<section class="content">
    <div class="box box-solid">
        <form class="formProfile" role="form" data-redirect="">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-lock text-warning"></i> <?=l('slug-change-password')?></h3>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label><?=l('slug-password')?></label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label><?=l('slug-re-password')?></label>
                    <input type="password" class="form-control" name="repassword">
                </div>
            </div>
            <div class="box-header with-border" style="border-top: 15px solid #ecf0f5;">
                <h3 class="box-title"><i class="fa fa-pencil-square-o text-red"></i> <?=l('slug-facebook-app')?></h3>
            </div>
            <div class="box-body">
                
                <?php if(!empty($result) && $result->app_id != ""){?>
                    <div class="callout callout-default">
                        <p><?=l('slug-desc-change-app-api')?></p>
                    </div>
                <?php }else{?>
                    <div class="callout callout-warning">
                        <p>Please update Facebook User ID, App ID, App secret</p>
                    </div>
                <?php }?>
                    
                
                <div class="form-group">
                    <div class="btn-group btn-group-xs pull-right">
                        <a href="http://findmyfbid.com/" target="_blank" class="btn btn-default"><i class="fa fa-info"></i> <?=l('slug-get-facebook-user-id')?></a>
                        <a href="https://www.youtube.com/embed/qklrn9R-nJ0" title="<?=l('slug-guide')?>" class="open-image fancybox.iframe btn btn-default"><i class="fa fa-info"></i> <?=l('slug-guide-create-app')?></a>
                    </div>
                </div>
                <div class="form-group">
                    <label><a href="http://findmyfbid.com/" target="_blank"><?=l('slug-facebook-user-id')?></a></label>
                    <input type="text" class="form-control" name="fid" value="<?=!empty($result)?$result->fid:""?>">
                </div>
                <div class="form-group">
                    <label><?=l('slug-app-id')?></label>
                    <input type="text" class="form-control" name="app_id" value="<?=!empty($result)?$result->app_id:""?>">
                </div>
                <div class="form-group">
                    <label><?=l('slug-app-secret')?></label>
                    <input type="text" class="form-control" name="app_secret" value="<?=!empty($result)?$result->app_secret:""?>">
                </div>
                <div class="form-group">
                    <div class="msg"></div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-info"><?=l('slug-update')?></button>
            </div>
        </form>
    </div>
</section>