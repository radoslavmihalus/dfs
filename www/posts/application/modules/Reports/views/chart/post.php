<div class="col-md-12 mt20">
    <div class="reports-title">
        <div class="name"><?=l('slug-posts-by-day')?></div>
    </div>
    <div class="ajax-post-by-day"></div>
</div>
<div class="col-md-6">
    <div class="reports-title">
        <div class="name"><?=l('slug-posts-by-status')?></div>
    </div>
    <div class="ajax-post-by-status"></div>
</div>
<div class="col-md-6">
    <div class="reports-title">
        <div class="name"><?=l('slug-posts-complete')?></div>
    </div>
    <div class="ajax-post-by-complete"></div>
</div>

<script type="text/javascript">
	$(function(){
    	Main.Highcharts({
    		element : '.ajax-post-by-day',
    		titlex  : 'datetime',
    		colorx  : '#00a65a',
    		colory  : '#00a65a',
    		name    : '<?=l('Posts')?>',
    		data    : [<?=!empty($post_by_day)?$post_by_day:""?>]
    	});

    	Main.Highcharts({
            element : '.ajax-post-by-status',
            height  : 350,
            titlex  : 'datetime',
            type    : 'pie',
            name    : '<?=l('Posts')?>',
            data    : [<?=!empty($post_by_status)?$post_by_status:""?>],
            dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Main.round(this.percentage,2) +'%'  : null;
                }
            }
        });

        Main.Highcharts({
            element : '.ajax-post-by-complete',
            height  : 350,
            titlex  : 'datetime',
            type    : 'pie',
            name    : 'Percent',
            data    : [<?=!empty($post_by_complete)?$post_by_complete:""?>],
            dataLabels : {
                formatter: function() {
                    return this.y > 1 ? '<b>'+ this.point.name +':</b> '+ Main.round(this.percentage,2) +'%'  : null;
                }
            }
        });
	});
</script>