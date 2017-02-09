<?php echo $this->render_table_name($mode); ?>
<div class="blueticket_forms-top-actions btn-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php
    echo $this->render_button('save_return', 'save', 'list', 'btn btn-primary col-md-3 col-lg-3 col-sm-3 col-xs-3', '', 'create,edit');
    echo $this->render_button('save_new', 'save', 'create', 'btn btn-default col-md-3 col-lg-3 col-sm-3 col-xs-3', '', 'create,edit');
    echo $this->render_button('save_edit', 'save', 'edit', 'btn btn-default col-md-3 col-lg-3 col-sm-3 col-xs-3', '', 'create,edit');
    echo $this->render_button('return', 'list', '', 'btn btn-warning col-md-3 col-lg-3 col-sm-3 col-xs-3');
    ?>
</div>
<div class="blueticket_forms-view">
        <?php echo $mode == 'view' ? $this->render_fields_list($mode, array('tag' => 'table', 'class' => 'table')) : $this->render_fields_list($mode, 'div', 'div', 'label', 'div'); //array('tag'=>'table','class'=>'table')) ?>
</div>
<div class="blueticket_forms-nav">
<?php echo $this->render_benchmark(); ?>
</div>
