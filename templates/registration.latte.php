<div id="myTabsContent" class="tab-content">
    <div class="tab-pane fade" id="registration">
        <div class="panel panel-default registration_block transparent_white">
            <div class="panel-body">
                <!-- DOGFORSHOW Sign up form -->
                <form id="frmSignIn">
                    <div class="form-group">
                        <input type="text" class="form-control" id="txtName" placeholder="{_'Name'}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="txtSurname" placeholder="{_ 'Surname'}">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" placeholder="{_ 'Email'}">
                    </div>
                    <div class="form-group">
                        <select class="form-control font_size_13px" id="ddlCountries">
                            <option value="" selected disabled>{_ 'Country'}</option>
                            <option>Czech Republic</option>
                            <option>Afghanistan</option>
                            <option>Kuwait</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" placeholder="{_ 'Password'}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtConfirmPassword" placeholder="{_ 'Confirm password'}">
                    </div>
                </form>
                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;{_ 'Register'}</button>
            </div>
        </div>
    </div>
    <div class="tab-pane fade in active" id="login">
        <div class="panel panel-default registration_block transparent_white">
            <div class="panel-body">
                <!-- DOGFORSHOW Sign up form -->
                <form id="frmlogIn">
                    <div class="form-group">
                        <input type="email" class="form-control" id="txtEmail" placeholder="{_ 'Email'}">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="txtPassword" placeholder="{_ 'Password'}">
                    </div>
                </form>
                <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;{_'Login'}</button>
            </div>
        </div>
    </div>
</div>
