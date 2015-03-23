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
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Your profile picture'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="file" class="form-control font_size_13px" id="txtHandlerProfilePicture" placeholder="{_ 'Your profile picture'}">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Select the breed that you can handle'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <select class="form-control font_size_13px" id="ddlBreedList">
                                <option>Select breed</option>
                                <option>Dogo argentino</option>
                                <option>Berger de Brie</option>
                                <option>Labrador</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Country'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <select class="form-control font_size_13px" id="ddlCountries">
                                <option>Select country</option>
                                <option>Czech Republic</option>
                                <option>Afghanistan</option>
                                <option>Kuwait</option>
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
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Your cover photo'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="file" class="form-control font_size_13px" id="txtHandlerCoverPhoto" placeholder="{_ 'Handler cover photo'}">
                        </div>
                        <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Save'}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

