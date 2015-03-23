<?php
// source: templates/edit-account.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9585719858', 'html')
;
//
// main template
//
?>
<div class="col-lg-8">
    <div class="panel-body component" style="background-color: white;margin-bottom: 10px;">
        <ul id="EditAccount" class="nav nav-tabs" style="border-bottom:0px !important;">
            <li class="active"><a class="" href="#informations" data-toggle="tab"><i class="fa fa-home"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Account informations'), ENT_NOQUOTES) ?></a></li>
        </ul>
    </div>
</div>

