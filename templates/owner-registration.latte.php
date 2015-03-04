<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateOwnerProfile">
            <h2 class="text-center text-uppercase"><i class="fa fa-user-plus"></i>&nbsp;&nbsp;Owner profile</h2>
            <span class="form-secondary-description" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;Basic informations about owner</span>
            <span>Informations marked with this sign <i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i> will not be accessible to the public or exploited for commercial use by third parties</span>
            <hr>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">Profile picture <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="file" class="form-control font_size_13px" id="txtOwnerProfilePicture" placeholder="Owner profile picture">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">Name <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtName" placeholder="Name">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">Surname <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtSurname" placeholder="Surname">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Email <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="email" class="form-control font_size_13px" id="txtEmail" placeholder="example@dogforshow.com">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Address <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtAdress" placeholder="Address">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">Town <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtTown" placeholder="Town">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;ZIP <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtZIP" placeholder="example 94485">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">Country <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_12px" id="ddlCountries">
                    <option>Select country</option>
                    <option>Czech Republic</option>
                    <option>Afghanistan</option>
                    <option>Kuwait</option>
                </select>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Phone number <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtPhone" placeholder="example +420 xxx xxx xxx">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;"><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i>&nbsp;&nbsp;Date of Birth <i class="fa fa-question-circle tooltip_brown"></i></span>
                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 10px;">
                        <select class="form-control font_size_13px" id="ddlDayBirth">
                            <option>Day</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 10px;">
                        <select class="form-control font_size_13px" id="ddlDayBirth">
                            <option>Month</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 10px;">
                        <select class="form-control font_size_13px" id="ddlDayBirth">
                            <option>Year</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <button type="submit" class="btn btn-danger btn-xl pull-right"><i class="fa fa-user-plus"></i></span>&nbsp;&nbsp;Create profile</button>
    </div>
</div>  