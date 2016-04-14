<section class="content-header">
    <h1 class="head-title">
        <?=l('slug-manage-schedules')?>
    </h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-3">
			<a href="<?=PATH?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> <?=l('slug-add-new')?></a>
		</div>
		<div class="col-xs-9">
			<div class="btn-group btn-group-sm pull-right">
				<button type="button" class="btnStatusAll item-show btn btn-default"><i class="fa fa-refresh"></i> <?=l('slug-re-post')?></button>
				<button type="button" class="btnStatusAll item-hide btn btn-default"><i class="fa fa-times"></i> <?=l('slug-cancel')?></button>
				<button type="button" class="btnDeleteAll btn btn-default"><i class="fa fa-trash-o"></i> <?=l('slug-delete')?></button>
            </div>
		</div>
		<br/>
		<br/>
	</div>
    <div class="row">
    	<div class="col-md-12">
    		<form class="formList">
			    <div class="box box-solid">
			        <div class="box-header with-border">
			            <h3 class="box-title"><i class="fa fa-bars text-blue"></i> <?=l('slug-list-schedules')?></h3>
			        </div>
			        <div class="box-body">
			            <table class="table table-bordered">
			                <tbody><tr>
			                    <th style="width: 10px">
		                        	<input type="checkbox" class="icheck CheckAll">
	                    		</th>
			                    <th><?=l('slug-page')?></th>
			                    <th><?=l('slug-type')?></th>
			                    <th><?=l('slug-name')?></th>
			                    <th><?=l('slug-time-post')?></th>
			                    <th class="text-center"><?=l('slug-status')?></th>
			                    <th class="text-center"><?=l('slug-option')?></th>
			                </tr>
			                <?php 
			                if(!empty($result)){
			                foreach ($result as $key => $row) {
			                	$post = json_decode($row->result);
						        $post_id = "";
						        if(isset($post->id)){
						            $post_id = $post->id;
						        }
			                ?>
			                <tr data-id="<?=$row->id?>">
			                	<td style="vertical-align: middle;">
		                        	<input type="checkbox" name="id[]" class="icheck checkItem" value="<?=$row->id?>">
			                	</td>
			                    <td style="vertical-align: middle;"><?=ucfirst($row->cid)?></td>
			                    <td style="vertical-align: middle;"><?=ucfirst($row->type)?></td>
			                    <td style="vertical-align: middle;"><?=$row->name?></td>
			                    <td style="vertical-align: middle;"><?=$row->time_post?></td>
			                    <td class="text-center">
			                    	<?php 
			                    	switch ($row->status) {
			                    		case 0:
			                    			$status = '<span class="label label-warning">'.l('slug-cancel').'</span>';
			                    			break;
			                    		case 2:
			                    			if($post_id != ""){
			                    				$status = '<span class="label label-success">'.l('slug-complete').'</span>';
			                    			}else{
			                    				$status = '<span class="label label-danger">'.l('slug-failure').'</span>';
			                    			}
			                    			break;
			                    		default:
			                    			$status = '<span class="label label-primary">'.l('slug-processing').'</span>';
			                    			break;
			                    	}
			                    	?>
			                    	<?=$status?>
			                    </td>
			                    <td class="text-center">
			                    	<div class="btn-group btn-group-sm">
			                    		<?php if($post_id != ""){?>
			                          	<a href="https://www.facebook.com/<?=$post_id?>" target="_blank" class="btn btn-default"><i class="fa fa-search"></i></a>
			                          	<a href="javascript:void(0);" data-toggle="tooltip" data-placement="bottom" title="..." class="btn btn-default show-analytics none"><i class="fa fa-line-chart"></i></a>
			                          	<?php }?>
			                          	<a href="<?=PATH.segment(1)."/edit?id=".$row->id?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
		                          		<a href="javascript:void(0);" class="btn btn-default btnDelete"><i class="fa fa-trash-o"></i></a>
			                        </div>
			                    </td>
			                </tr>
			                <?php }}else{?>
			                <tr>
			                	<td class="text-center" colspan="6">
			                		<?=l('slug-empty')?>
			                	</td>
			                </tr>
			                <?php }?>
			            </tbody></table>
			        </div><!-- /.box-body -->
			        <div class="box-footer clearfix">
			        	<?=$this->pagination->create_links();?>
			        </div>
			    </div>
		    </form>
		</div>
    </div>
</section>