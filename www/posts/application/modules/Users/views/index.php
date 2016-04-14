<section class="content-header">
    <h1 class="head-title">
        <?=l('slug-user-manage')?>
    </h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-xs-3">
			<a href="<?=PATH."users/add"?>" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> <?=l('slug-add-new')?></a>
		</div>
		<div class="col-xs-9">
			<div class="btn-group btn-group-sm pull-right">
				<button type="button" title="<?=l('slug-show')?>" class="btnStatusAll item-show btn btn-danger"><i class="fa fa-toggle-on"></i> <?=l('slug-show')?></button>
				<button type="button" title="<?=l('slug-hide')?>" class="btnStatusAll item-hide btn btn-danger"><i class="fa fa-toggle-off"></i> <?=l('slug-hide')?></button>
				<button type="button" title="<?=l('slug-delete')?>" class="btnDeleteAll btn btn-danger"><i class="fa fa-trash-o"></i> <?=l('slug-delete')?></button>
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
			            <h3 class="box-title"><i class="fa fa-bars text-blue"></i> <?=l('slug-list-user')?></h3>
			        </div>
			        <div class="box-body">
			            <table class="table table-bordered">
			                <tbody><tr>
			                    <th style="width: 10px">
		                        	<input type="checkbox" class="icheck CheckAll">
	                    		</th>
			                    <th style="width: 10px"><?=l('slug-order')?></th>
			                    <th><?=l('slug-avatar')?></th>
			                    <th><?=l('slug-username')?></th>
			                    <th><?=l('slug-is-admin')?></th>
			                    <th class="text-center"><?=l('slug-status')?></th>
			                    <th class="text-center"><?=l('slug-option')?></th>
			                </tr>
			                <?php 
			                if(!empty($result)){
			                foreach ($result as $key => $row) {
			                ?>
			                <tr data-id="<?=$row->id?>">
			                	<td>
		                        	<input type="checkbox" name="id[]" class="icheck checkItem" value="<?=$row->id?>">
			                	</td>
			                    <td><?=((int)get('p')*10) + ($key+1)?></td>
			                    <td><img src="http://graph.facebook.com/<?=$row->fid?>/picture?type=square" width="30" /></td>
			                    <td><?=$row->username?></td>
			                    <td><?=($row->admin == 0)?l('slug-no'):l('slug-yes')?></td>
			                    <td class="text-center">
			                    	<?php if($row->status != 0){?>
			                        	<span class="text-green" style="font-size: 25px;"><i class="fa fa-toggle-on"></i></span>
			                        <?php }else{?>
			                        	<span class="text-danger" style="font-size: 25px;"><i class="fa fa-toggle-off"></i></span>
			                        <?php }?>
			                    </td>
			                    <td class="text-center">
			                    	<div class="btn-group btn-group-sm">
			                          	<?php if($row->id != 1){?>
				                          	<a href="<?=PATH."users/edit?id=".$row->id?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
			                          		<a href="javascript:void(0);" class="btn btn-default btnDelete"><i class="fa fa-trash-o"></i></a>
			                        	<?php }?>
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