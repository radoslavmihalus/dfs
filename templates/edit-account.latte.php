<div class="col-lg-8">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <div class="panel-description" style="margin-bottom: 10px;"><i class="notification-icon fa fa-cog"></i>&nbsp;&nbsp;Account settings</div>
        <ul id="AccountSettings" class="nav nav-tabs" style="border-bottom:0px !important;font-size:13px;">
            <li class="active"><a class="EditProfilelink" href="#informations" data-toggle="tab"><i class="fa fa-align-justify"></i>&nbsp;&nbsp;{_ 'Informations'}</a></li>
            <li><a class="EditProfilelink" href="#pictures" data-toggle="tab"><i class="fa fa-lock"></i>&nbsp;&nbsp;{_ 'Password change'}</a></li>
        </ul>
        <div id="AccountSettingsContent" class="tab-content">
            <div class="tab-pane fade in active" id="informations">
                <div class="panel panel-default registration_block transparent_white">
                    <div class="panel-body">
                        <span class="form-secondary-description text-uppercase"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;{_ 'Account informations'}</span>
                        <span style="font-size: 13px;display:block;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i> {_ 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties'}</span>
                        <hr>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Name'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtName" placeholder="{_ 'Name'}">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Surname'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtSurname" placeholder="{_ 'Surname'}">
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;{_ 'Email'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="email" class="form-control font_size_13px" id="txtEmail" placeholder="{_ 'email@email.com'}">
                        </div>
                        <span class="form-secondary-description text-uppercase" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;{_ 'Additional account informations'}</span>
                        <span style="font-size: 13px;display:block;"><i style="color:#c12e2a;font-size:18px;" class="fa fa-eye-slash"></i> {_ 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties'}</span>
                        <hr>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> {_ 'Address'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtAdress" placeholder="{_ 'Address'}"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> {_ 'Town'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtTown" placeholder="{_ 'Town'}"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> {_ 'ZIP'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtZip" placeholder="{_ 'ZIP'}"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> {_ 'Phone number'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <input type="text" class="form-control font_size_13px" id="txtPhoneNumber" placeholder="{_ 'Phone number'}"></textarea>
                        </div>
                        <div class="form-group">
                            <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> {_ 'Year of birth'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                            <select class="form-control font_size_13px" id="ddlYear">
                                <option value="" selected disabled>Year</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
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
                            <div class="form-group">
                                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> {_ 'Old password'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                                <input type="password" class="form-control font_size_13px" id="txtOldPassword" placeholder="{_ 'Old password'}">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> {_ 'New password'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                                <input type="password" class="form-control font_size_13px" id="txtNewPassword" placeholder="{_ 'New password'}">
                            </div>
                            <div class="form-group">
                                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;" class="fa fa-eye-slash"></i> {_ 'Confirm new password'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                                <input type="password" class="form-control font_size_13px" id="txtConfirmPassword" placeholder="{_ 'Confirm new password'}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Save'}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





