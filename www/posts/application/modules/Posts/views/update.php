<section class="content-header">
    <h1 class="head-title">
        <?=l('slug-manage-schedules')?>
    </h1>
</section>

<section class="content">
    <div class="box box-solid">
        <form class="formScheduleUpdate" role="form" data-redirect="users">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="callout callout-danger list-errors">
                        </div>
                    </div>
                </div>
                <?php if(!empty($result)){?>
                    <input type="hidden" class="form-control" name="id" value="<?=$result->id?>" />
                    <input type="hidden" class="form-control" name="type_post" value="<?=$result->type?>" />
                    <?php if($result->type == 'text'){?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-message')?></label>
                                <textarea class="form-control" rows="3" name="post_message"><?=$result->message?></textarea>
                            </div>
                        </div>
                    </div>
                    <?php }?>

                    <?php if($result->type == 'link'){?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-link-url')?></label>
                                <input type="text" class="form-control" name="link_url" value="<?=$result->url?>" />
                            </div>
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-message')?></label>
                                <textarea class="form-control" rows="3" name="link_message"><?=$result->message?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-link-title')?></label>
                                <input type="text" class="form-control" name="link_title" value="<?=$result->title?>"/>
                            </div>
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-link-description')?></label>
                                <textarea class="form-control" rows="3" name="link_description"><?=$result->description?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-picture-url')?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="link_picture" value="<?=$result->image?>">
                                    <span class="input-group-btn">
                                      <button class="btn btn-success btn-flat dialog-upload" type="button"><i class="fa fa-cloud-upload"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>

                    <?php if($result->type == 'image'){?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-image-description')?></label>
                                <textarea class="form-control" rows="3" name="image_description"><?=$result->description?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-image-url')?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="image_url" value="<?=$result->image?>">
                                    <span class="input-group-btn">
                                      <button class="btn btn-success btn-flat dialog-upload" type="button"><i class="fa fa-cloud-upload"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>

                    <?php if($result->type == 'video'){?>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-video-title')?></label>
                                <input type="text" class="form-control" name="video_title" value="<?=$result->title?>"/>
                            </div>
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-video-description')?></label>
                                <textarea class="form-control" rows="3" name="video_description"><?=$result->description?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="head-title"><?=l('slug-video-url')?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="video_url" value="<?=$result->url?>">
                                    <span class="input-group-btn">
                                      <button class="btn btn-success btn-flat dialog-upload" type="button"><i class="fa fa-cloud-upload"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>

                    <div class="row">
                        <div class="col-md-8">
                            <label class="head-title col-md-2 text-left p0 fix-height-label"><i class="fa fa-clock-o"></i> <?=l('slug-time-post')?></label>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control date_range" readonly="true" name="time_post" value="<?=$result->time_post?>"/>
                            </div>

                            <input type="checkbox" class="icheck" name="delete_complete" value="1" <?=($result->delete == 1)?"checked":""?> />
                            <label class="fix-height-label"> &nbsp; <?=l('slug-delete-after-finished')?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label class="head-title col-md-2 text-left p0 fix-height-label"><i class="fa fa-bullseye"></i> <?=l('slug-deplay')?></label>
                            <div class="form-group col-md-4">
                                <select class="form-control" name="deplay">
                                    <?php foreach (deplay_time() as $value) {?>
                                    <option value="<?=$value?>" <?=($result->deplay == 1)?"selected":""?> ><?=$value?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php }?>
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