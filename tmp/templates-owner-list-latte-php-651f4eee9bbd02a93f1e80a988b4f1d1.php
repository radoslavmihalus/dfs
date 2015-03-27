<?php
// source: templates/owner-list.latte.php

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('9762398862', 'html')
;
//
// main template
//
?>
<div class="panel-default col-lg-12 col-md-12 col-xs-12" style="font-size: 13px;min-width: 244px">
    <h1><i class="glyphicons glyphicons-user"></i>&nbsp;&nbsp;<?php echo Latte\Runtime\Filters::escapeHtml($template->translate('Owners of purebred dogs'), ENT_NOQUOTES) ?></h1>
    <nav>
        <ul class="pagination">
            <li ><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <li ><a href="#">1</a></li>
            <li ><a href="#">2</a></li>
            <li ><a href="#">3</a></li>
            <li ><a href="#">4</a></li>
            <li ><a href="#">5</a></li>
            <li ><a href="#">6</a></li>
            <li ><a href="#">7</a></li>
            <li ><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
        </ul>
    </nav>
    <div class="row">
        <!-- List profile component -->
        <div class="col-lg-4 col-md-6 col-xs-12 padding">
            <a href="#">
                <div class="list-item">
                    <div class="list-item-image">
                        <img src="img/referer1.jpg"  class="pull-left image-list-thumb">
                    </div>    
                    <h3 class="text-uppercase">Michal Slepánek</h3>
                    <hr style="margin-bottom: 10px;">
                    <span class="list-item-location"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Slovakia</span>
                    <span class="list-item-regdate"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;25.6.2015</span>
                </div>
            </a>
        </div>
        <!-- / List profile component -->
    </div>
</div>  
