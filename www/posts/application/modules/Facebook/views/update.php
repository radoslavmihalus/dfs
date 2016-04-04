<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-facebook-official"></i>
                    <h3 class="box-title">
                        <?=l('slug-login-facebook')?>
                    </h3>
                    <a class="open-image fancybox.iframe" href="https://www.youtube.com/embed/bTCdD6oNTPA" title="<?=l('slug-guide')?>">
                        <button class="btn btn-default btn-xs pull-right"><i class="fa fa-info-circle"></i> <?=l('slug-guide')?></button>
                    </a>
                </div><!-- /.box-header -->
                <div class="box-body text-center">
                    <?php if(count($profiles) < USERS_LIMIT){?>
                    <a href="<?=$authUrl?>" class="btn btn-app btn-facebook">
                        <i class="fa fa-facebook"></i> <?=l('slug-login')?>
                    </a>
                    <br/>
                    <small>
                        <?=l('slug-read-the-manual-here')?> <a class="open-image fancybox.iframe" href="https://www.youtube.com/embed/bTCdD6oNTPA" title="<?=l('slug-guide')?>"><?=l('slug-guide')?></a>
                    </small>
                    <?php }else{?>
                        <div class="callout callout-warning list-errors text-left" style="display: block;">
                            <div><i class="fa fa-exclamation-circle"></i> <?=l('slug-desc-user-limit')?></div>
                        </div>
                    <?php }?>
                </div>
                <?php if(count($profiles) >= USERS_LIMIT){?>
                <div class="box-body">
                    <a class="btn btn-default" href="<?=PATH?>facebook"><i class="fa fa-times"></i> <?=l('slug-cancel')?></a>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</section>