<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateOwnerProfile">
            <h2 class="text-center text-uppercase"><i class="glyphicons glyphicons-user"></i>&nbsp;&nbsp;{_ 'Owner of purebred dog profile'}</h2>
            <span class="form-secondary-description" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;{_ 'Basic informations about you'}</span>
            <hr>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Your profile picture'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="file" class="form-control font_size_13px" id="txtOwnerProfilePicture" placeholder="Your profile picture">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Short description about you'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <textarea type="text" style="height:50px;" class="form-control contact_textarea font_size_13px" id="txtOwnerDescription" placeholder="{_ 'Short description'}"></textarea>
            </div>
        </form>
        <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Create profile'}</button>
    </div>
</div>  