<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateOwnerProfile">
            <h2 class="text-center text-uppercase"><i class="glyphicons glyphicons-user"></i>&nbsp;&nbsp;{_ 'Owner of purebred dog profile'}</h2>
            <span class="form-secondary-description" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;{_ 'Basic informations about you'}</span>
            <span><i style="color:#c12e2a;font-size:15px;" class="fa fa-eye-slash"></i> {_ 'Informations marked with this sign will not be accessible to the public or exploited for commercial use by third parties'}</span>
            <hr>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Profile picture'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="file" class="form-control font_size_13px" id="txtOwnerProfilePicture" placeholder="Your profile picture">
            </div>
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
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Short description about you'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <textarea type="text" style="height:50px;" class="form-control contact_textarea font_size_13px" id="txtOwnerDescription" placeholder="{_ 'Short description'}"></textarea>
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
        </form>
        <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Create profile'}</button>
    </div>
</div>  