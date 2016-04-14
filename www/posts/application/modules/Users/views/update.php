<section class="content-header">
    <h1 class="head-title">
        <?=l('slug-user-manage')?>
    </h1>
</section>

<section class="content">
    <div class="box box-solid">
        <form class="formUpdate" role="form" data-redirect="users">
            <div class="box-body">
                <div class="form-group">
                    <label><?=l('slug-role')?></label>
                    <select class="form-control" name="admin" >
                        <option value="0" <?=(!empty($result) && $result->admin == 0)?"selected":""?>><?=l('slug-user')?></option>
                        <option value="1" <?=(!empty($result) && $result->admin == 1)?"selected":""?>><?=l('slug-admin')?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label><?=l('slug-username')?></label>
                    <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:""?>">
                    <input type="text" class="form-control" name="username" id="username" value="<?=!empty($result)?$result->username:""?>">
                </div>
                <div class="form-group">
                    <label><?=l('slug-password')?></label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <label><?=l('slug-re-password')?></label>
                    <input type="password" class="form-control" name="repassword">
                </div>
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
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="status" value="1" <?php if(empty($result) || (!empty($result) && $result->status == 1)){ echo "checked"; }?> > <?=l('slug-show-hide')?>
                    </label>
                </div>
                <div class="form-group">
                    <div class="msg"></div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-info"><?=l('slug-submit')?></button>
            </div>
        </form>
    </div>
</section>