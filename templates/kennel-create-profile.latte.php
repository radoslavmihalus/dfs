<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateKennelProfile" enctype="multipart/form-data">
            <h2 class="text-center text-uppercase"><i class="fa fa-home"></i>&nbsp;&nbsp;{_ 'Kennel profile'}</h2>
            <span class="form-secondary-description text-uppercase"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;{_ 'Basic informations about your kennel'}</span>
            <hr>
            <input type="hidden" name="formName" value="kennel-create-profile" />
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel name'} <i class="fa fa-question-circle tooltip_brown" ></i></span>
                <input type="text" class="form-control font_size_13px" name="txtKennelName" id="txtKennelName" placeholder="{_ 'Kennel name'}" required>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel FCI number'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" name="txtKennelFciNumber" id="txtKennelFciNumber" placeholder="987/2011" required>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel profile picture'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <span class="btn btn-default fileinput-button btn-sm">
                    <i class="fa fa-picture-o"></i>&nbsp;&nbsp;
                    <span>{_'Select picture'}</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input type="file" name="files[]" multiple required>
                </span>
                <span class="fileupload-process"></span>
<!--                <input type="file" class="form-control font_size_13px" name="" id="txtKennelProfilePicture" placeholder="{_ 'Kennel profile picture'}">-->
            </div>
            <div class="col-lg-5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <!-- The extended global progress state -->
                <div class="progress-extended">&nbsp;</div>
            </div>
            <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel website'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" name="txtKennelWebsite" id="txtKennelWebsite" placeholder="{_ 'www.yourwebsite.com'}"></textarea>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel description'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <textarea type="text" style="height:50px;" class="form-control contact_textarea font_size_13px" name="txtKennelDescription" id="txtKennelDescription" placeholder="{_ 'Kennel description'}" required></textarea>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Select the breed bred by your kennel'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_13px" name="ddlBreedList" id="ddlBreedList" required>
                    <option value="" selected disabled>{_ 'Please select'}</option>
                    <option>Dogo argentino</option>
                    <option>Berger de Brie</option>
                    <option>Labrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Create profile'}</button>
        </form>
    </div>
</div>
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
