<div class="col-lg-8">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <div class="panel-description" style="margin-bottom: 10px;"><i class="glyphicons glyphicons-edit"></i>&nbsp;&nbsp;Edit profile</div>
        <ul id="EditProfile" class="nav nav-tabs" style="border-bottom:0px !important;font-size:13px;">
            <li class="active"><a class="EditProfilelink" href="#informations" data-toggle="tab"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;{_ 'Informations'}</a></li>
            <li><a class="EditProfilelink" href="#pictures" data-toggle="tab"><i class="fa fa-picture-o"></i>&nbsp;&nbsp;{_ 'Cover photo'}</a></li>
        </ul>
        <div id="EditProfileContent" class="tab-content">
            <div class="tab-pane fade in active" id="informations">
                <div class="panel panel-default registration_block transparent_white">
                    <div class="panel-body">
                        <span class="form-secondary-description text-uppercase"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;{_ 'Basic informations about your kennel'}</span>
                         <hr>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel name'} <i class="fa fa-question-circle tooltip_brown" ></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtKennelName" placeholder="{_ 'Kennel name'}">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel FCI number'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtKennelFciNumber" placeholder="987/2011">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel profile picture'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="file" class="form-control font_size_13px" id="txtKennelProfilePicture" placeholder="{_ 'Kennel profile picture'}">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel website'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtKennelWebsite" placeholder="{_ 'www.yourwebsite.com'}"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel description'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <textarea type="text" style="height:50px;" class="form-control contact_textarea font_size_13px" id="txtKennelDescription" placeholder="{_ 'Kennel description'}"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Select the breed bred by your kennel'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <select class="form-control font_size_13px" id="ddlBreedList">
                                <option value="" selected disabled>{_ 'Please select'}</option>
                                <option>Dogo argentino</option>
                                <option>Berger de Brie</option>
                                <option>Labrador</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Save'}</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pictures">
                <div class="panel panel-default registration_block transparent_white">
                    <div class="panel-body">
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Kennel cover photo'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="file" class="form-control font_size_13px" id="txtKennelCoverPhoto" placeholder="{_ 'Kennel cover photo'}">
                        </div>
                        <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Save'}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

