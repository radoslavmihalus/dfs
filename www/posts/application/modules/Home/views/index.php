<section class="content">
    <div class="row">
        <div class="col-md-12">
            <form class="formSchedule">
                <div class="box box-solid wrap-box-post">
                    <div class="box-header with-border">
                        <i class="fa fa-paper-plane text-blue"></i>
                        <h3 class="box-title"><?=l('slug-schedule-posts')?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="callout callout-danger list-errors">
                                </div>
                            </div>
                        </div>
                        <div class="tabbable wrap-stacked-post">
                            <ul class="nav nav-pills nav-stacked stacked-post col-md-2">
                                <li class="active first"><a href="#post-text" data-toggle="tab"><i class="fa fa-file-text"></i> <?=l('slug-text-post')?> <input type="radio" name="type_post" value="text" checked="true" /></a></li>
                                <li><a href="#post-link" data-toggle="tab"><i class="fa fa-link"></i> <?=l('slug-link')?>  <input type="radio" name="type_post" value="link" /></a></li>
                                <li><a href="#post-image" data-toggle="tab"><i class="fa fa-picture-o"></i> <?=l('slug-image')?>  <input type="radio" name="type_post" value="image" /></a></li>
                                <li><a href="#post-video" data-toggle="tab"><i class="fa fa-video-camera"></i> <?=l('slug-video')?>  <input type="radio" name="type_post" value="video" /></a></li>
                            </ul>
                            <div class="col-md-10 content-post">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="post-text">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-message')?></label>
                                                    <textarea class="form-control" rows="3" name="post_message"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="post-link">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-link-url')?></label>
                                                    <input type="text" class="form-control" name="link_url"/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-message')?></label>
                                                    <textarea class="form-control" rows="3" name="link_message"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-link-title')?></label>
                                                    <input type="text" class="form-control" name="link_title"/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-link-description')?></label>
                                                    <textarea class="form-control" rows="3" name="link_description"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-picture-url')?></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="link_picture">
                                                        <span class="input-group-btn">
                                                          <button class="btn btn-success btn-flat dialog-upload" type="button"><i class="fa fa-cloud-upload"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="post-image">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-image-description')?></label>
                                                    <textarea class="form-control" rows="3" name="image_description"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-image-url')?></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="image_url">
                                                        <span class="input-group-btn">
                                                          <button class="btn btn-success btn-flat dialog-upload" type="button"><i class="fa fa-cloud-upload"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="post-video">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-video-title')?></label>
                                                    <input type="text" class="form-control" name="video_title"/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-video-description')?></label>
                                                    <textarea class="form-control" rows="3" name="video_description"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-video-url')?></label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="video_url">
                                                        <span class="input-group-btn">
                                                          <button class="btn btn-success btn-flat dialog-upload" type="button"><i class="fa fa-cloud-upload"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="head-title col-md-2 text-left p0 fix-height-label"><i class="fa fa-clock-o"></i> <?=l('slug-time-post')?></label>
                                        <div class="form-group col-md-4">
                                            <input type="text" class="form-control date_range" readonly="true" name="time_post"/>
                                        </div>

                                        <input type="checkbox" class="icheck" name="delete_complete" value="1" />
                                        <label class="fix-height-label"> &nbsp; <?=l('slug-delete-after-finished')?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <label class="head-title col-md-2 text-left p0 fix-height-label"><i class="fa fa-bullseye"></i> <?=l('slug-deplay')?></label>
                                        <div class="form-group col-md-4">
                                            <select class="form-control" name="deplay">
                                                <?php foreach (deplay_time() as $value) {?>
                                                    <?php if(MINIMUM_DEPLAY <= $value){?>
                                                    <option value="<?=$value?>" <?=(DEFAULT_DEPLAY == $value)?"selected":""?>><?=$value?> <?=l('slug-seconds')?></option>
                                                    <?php }?>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h4 class="head-title mt20 text-blue"><i class="fa fa-tasks"></i> <?=l('slug-select-page-group-profile')?></h4>
                        <?php if(empty($profiles)){?>
                            <?php if(count($profiles) < USERS_LIMIT){?>
                            <div class="text-center">
                                <a href="<?=$authUrl?>" class="btn btn-app btn-facebook">
                                    <i class="fa fa-facebook"></i> <?=l('slug-login')?>
                                </a>
                                <br/>
                                <small>
                                    <?=l('slug-read-the-manual-here')?> <a class="open-image" href="<?=BASE?>assets/admin/img/guide-add-account.jpg" title="<?=l('slug-guide')?>"><?=l('slug-guide')?></a>
                                </small>
                            </div>
                            <?php }else{?>
                                <div class="callout callout-warning list-errors text-left" style="display: block;">
                                    <div><i class="fa fa-exclamation-circle"></i> <?=l('slug-desc-user-limit')?></div>
                                </div>
                            <?php }?>
                        <?php }?>

                        <div class="tabbable wrap-stacked-post mt20">
                            <ul class="nav nav-pills nav-stacked stacked-post col-md-2">
                                <?php if(!empty($profiles)){
                                foreach ($profiles as $key => $row) {
                                ?>
                                <li class="<?=$key==0?"active first":""?>"><a href="#post-<?=$row->fid?>" data-toggle="tab"><i class="fa fa-user text-blue"></i> <?=$row->name?></a></li>
                                <?php }}?>
                            </ul>
                            <div class="col-md-10 content-post list_pages">
                                <div class="tab-content">
                                    <?php if(!empty($profiles)){
                                    foreach ($profiles as $key => $row) {
                                    ?>
                                    <div class="tab-pane <?=$key==0?"active":""?>" id="post-<?=$row->fid?>">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="checkbox" class="icheck" name="pages[]" value="profile-<?=$row->name?>-<?=$row->fid?>-<?=$row->access_token?>" />
                                                    <label class="fix-height-label"> &nbsp; <?=l('slug-profile-timeline')?> <a class="btn btn-default btn-xs" target="_blank" href="https://www.facebook.com/<?=$row->fid?>"><i class="fa fa-search"></i></a></label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-groups')?></label><br/>

                                                    <?php if(!empty($row->groups['data'])){
                                                    $groups = $row->groups['data'];
                                                    foreach ($groups as $value) {
                                                    ?>
                                                    <input type="checkbox" class="icheck" name="pages[]" value="group-<?=$value['name']?>-<?=$value['id']?>-<?=$row->access_token?>" />
                                                    <label class="fix-height-label"> &nbsp; <?=$value['name']?>  <a class="btn btn-default btn-xs" target="_blank" href="https://www.facebook.com/<?=$value['id']?>"><i class="fa fa-search"></i></a></label><br/>
                                                    <?php }}else{?>
                                                        <div class="text-center" style="background: #eee; padding: 5px;"><?=l('slug-empty')?></div>
                                                    <?php }?>                                                
                                                </div>

                                                <div class="form-group">
                                                    <label class="head-title"><?=l('slug-pages')?></label><br/>

                                                    <?php if(!empty($row->pages['data'])){
                                                    $pages = $row->pages['data'];
                                                    foreach ($pages as $value) {
                                                    ?>
                                                    <input type="checkbox" class="icheck" name="pages[]" value="page-<?=$value['name']?>-<?=$value['id']?>-<?=$value['access_token']?>" />
                                                    <label class="fix-height-label"> &nbsp; <?=$value['name']?> <a class="btn btn-default btn-xs" target="_blank" href="https://www.facebook.com/<?=$value['id']?>"><i class="fa fa-search"></i></a></label><br/>
                                                    <?php }}else{?>
                                                        <div class="text-center" style="background: #eee; padding: 5px;"><?=l('slug-empty')?></div>
                                                    <?php }?>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }}?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-post"><?=l('slug-publish-post')?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
