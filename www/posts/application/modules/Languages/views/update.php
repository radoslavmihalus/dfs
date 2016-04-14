<section class="content-header">
    <h1>
        Settings
    </h1>
</section>

<section class="content">
    <div class="box box-warning">
        <form role="form" method="POST" data-redirect="settings" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="name"><?=l('slug-website-name')?></label>
                    <input type="hidden" class="form-control" name="token" id="token" value="<?=$this->security->get_csrf_hash();?>">
                    <input type="text" class="form-control" name="name" id="name" value="<?=!empty($result)?$result->name:""?>">
                </div>
                <div class="form-group">
                    <label for="file">Logo</label>
                    <div class="row">
                      <div class="col-xs-6 col-md-3">
                        <a href="#" class="thumbnail" style="background: #eee;">
                          <img src="<?=(!empty($result) && $result->logo != "")?PATH.$result->logo:PATH."assets/img/logo_analytics.png"?>" alt="" style="max-width: 200px;">
                        </a>
                      </div>
                    </div>
                    <input type="file" class="form-control" name="file" id="file">
                </div>
                <div class="form-group">
                    <label for="password">Theme</label>
                    <select class="form-control" name="theme">
                        <option value="blue" <?=(!empty($result) && $result->theme == "blue")?"selected":""?> >Blue - Dark</option>
                        <option value="blue-light" <?=(!empty($result) && $result->theme == "blue-light")?"selected":""?> >Blue - Light</option>
                        <option value="green" <?=(!empty($result) && $result->theme == "green")?"selected":""?> >Green - Dark</option>
                        <option value="green-light" <?=(!empty($result) && $result->theme == "green-light")?"selected":""?> >Green - Light</option>
                        <option value="red" <?=(!empty($result) && $result->theme == "red")?"selected":""?> >Red - Dark</option>
                        <option value="red-light" <?=(!empty($result) && $result->theme == "red-light")?"selected":""?> >Red - Light</option>
                        <option value="yellow" <?=(!empty($result) && $result->theme == "yellow")?"selected":""?> >Yellow - Dark</option>
                        <option value="yellow-light" <?=(!empty($result) && $result->theme == "yellow-light")?"selected":""?> >Yellow - Light</option>
                        <option value="purple" <?=(!empty($result) && $result->theme == "purple")?"selected":""?> >Purple - Dark</option>
                        <option value="purple-light" <?=(!empty($result) && $result->theme == "purple-light")?"selected":""?> >Purple - Light</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="register" style="padding-right: 10px;">Register</label>
                    <input type="radio" name="register" value="1" <?=(!empty($result) && $result->register == 1)?"checked":""?>> Yes
                    <input type="radio" name="register" value="0" <?=(!empty($result) && $result->register == 0)?"checked":""?> style="margin-left: 10px;"> No
                </div>
                <div class="form-group">
                    <div class="msg"></div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
</section>