<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateDogProfile">
            <h2 class="text-center text-uppercase"><i class="glyphicons glyphicons-dog"></i>&nbsp;&nbsp;{_ 'Add a dog'}</h2>
            <span class="form-secondary-description" style="display:block;margin-top:30px;"><i class="fa fa-long-arrow-down"></i>&nbsp;&nbsp;{_ 'Basic informations about your dog'}</span>
            <hr>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Gender'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <label class="radio-inline" style="font-size: 13px;">
                    <input type="radio" name="GenderDog">{_ 'Dog'}
                </label>
                <label class="radio-inline" style="font-size: 13px;">
                    <input type="radio" name="GenderBitch">{_ 'Bitch'}
                </label>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Breed'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_13px" id="ddlBreedList">
                    <option value="" selected disabled>{_ 'Please select'}</option>
                    <option>Dogo argentino</option>
                    <option>Berger de Brie</option>
                    <option>Labrador</option>
                </select>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Offer your dog for mating'}? <i class="fa fa-question-circle tooltip_brown"></i></span>
                <div class="checkbox">
                    <label style="font-size: 13px;">
                        <input type="checkbox" class="radio" value="1">Yes
                    </label>
                    <label style="font-size: 13px;">
                        <input type="checkbox" class="radio" value="1" >No
                    </label>
                </div>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Dogs name'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtDogName" placeholder="{_ 'Dogs name as shown in the pedigree'}">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Dogs profile picture'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="file" class="form-control font_size_13px" id="txtDogProfilePicture" placeholder="{_ 'Dogs profile picture'}">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Pedigree registration number'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtPedigreeRegistrationNumber" placeholder="{_ 'Pedigree registration number'}">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Date of birth'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <div class="row">
                    <div class="col-md-4" style="margin-bottom: 5px;">
                        <select class="form-control font_size_13px" id="ddlDay">
                            <option value="" selected disabled>Day</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 5px;">
                        <select class="form-control font_size_13px" id="ddlMonth">
                            <option value="" selected disabled>Month</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 5px;">
                        <select class="form-control font_size_13px" id="ddlYear">
                            <option value="" selected disabled>Year</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Height at the withers (cm)'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtDogHeight" placeholder="{_ 'Height at the withers in centimeters'}">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Weight (kg)'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtDogWeight" placeholder="{_ 'Weight of dog in kilograms'}">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Country'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <select class="form-control font_size_13px" id="ddlCountries">
                    <option value="" selected disabled>{_ 'Country'}</option>
                    <option>Czech Republic</option>
                    <option>Afghanistan</option>
                    <option>Kuwait</option>
                </select>
            </div>
        </form>
        <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Add a dog'}</button>
    </div>
</div>  