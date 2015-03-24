<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateKennelProfile">
            <h2 class="text-center text-uppercase"><i class="fa fa-home"></i>&nbsp;&nbsp;{_ 'Kennel profile'}</h2>
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
        </form>
        <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Create profile'}</button>
    </div>
</div>  
