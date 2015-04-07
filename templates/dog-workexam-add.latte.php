<div class="panel-default col-md-8" style="font-size: 12px;min-width: 244px">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <form id="frmCreateDogProfile">
            <h2 class="text-center text-uppercase"><i class="fa fa-flag"></i>&nbsp;&nbsp;{_ 'Add working exam'}</h2>
            <hr>
            <div>
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Date exam passed'} <i class="fa fa-question-circle tooltip_brown"></i></span>
            </div>
            <div class="row">
                <div class="col-md-4 form-group"> 
                    <select class="form-control font_size_13px" id="ddlDay">
                        <option value="" selected disabled>Day</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <div class="col-md-4 form-group"> 
                    <select class="form-control font_size_13px" id="ddlMonth">
                        <option value="" selected disabled>Month</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <select class="form-control font_size_13px" id="ddlYear">
                        <option value="" selected disabled>Year</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Type of exam'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="text" class="form-control font_size_13px" id="txtDogExam" placeholder="{_ 'SVV1'}">
            </div>
            <div class="form-group">
                <span style="font-size: 13px;display:block;margin-bottom: 5px;">{_ 'Picture'} <i class="fa fa-question-circle tooltip_brown"></i></span>
                <input type="file" class="form-control font_size_13px" id="txtExamPicture" placeholder="{_ 'Picture'}">
            </div>
            <button type="submit" class="btn btn-danger btn-xl pull-right">{_ 'Add'}</button>
            <button type="submit" class="btn btn-default btn-xl pull-right" style="margin-right: 10px;">{_ 'Cancel'}</button>
    </div>
</div>  