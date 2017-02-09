<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" style="text-align: center; padding-bottom: 10px">
    <?php echo $this->render_table_name(); ?>
</div>
<div class="blueticket_forms-nav col-lg-12 col-sm-12 col-md-12 col-xs-12">
    <?php if ($this->is_limitlist) { ?>
        <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
        <?php echo $this->render_pagination(); ?>
        <!--    </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">-->
        <?php echo $this->render_limitlist(true); ?>
        <!--    </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="text-align: right">-->
        <?php echo $this->render_search(); ?>
        <!--</div>-->
    <?php } else { ?>
        <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
        <?php echo $this->render_pagination(); ?>
        <!--    </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="text-align: right">-->
        <?php echo $this->render_search(); ?>
        <!--</div>-->
    <?php } ?>
</div>
<div style="clear: both"></div>
<div class="blueticket_forms-list-container">
    <?php if ($this->is_create or $this->is_csv or $this->is_print) { ?>
        <div class="blueticket_forms-top-actions">
            <div class="btn-group pull-right">
                <?php
                echo $this->print_button('btn btn-default', 'glyphicon glyphicon-print');
                echo $this->csv_button('btn btn-default', 'glyphicon glyphicon-file');
                echo $this->xls_button('btn btn-default', 'glyphicon glyphicon-file');
                ?>
            </div>
            <?php echo $this->add_button('btn btn-success', 'glyphicon glyphicon-plus-sign'); ?>
            <div class="clearfix"></div>
        </div>
    <?php } ?>
    <table class="blueticket_forms-list table table-striped table-hover table-bordered">
        <thead>
            <?php echo $this->render_grid_head('tr', 'th'); ?>
        </thead>
        <tbody>
            <?php echo $this->render_grid_body('tr', 'td'); ?>
        </tbody>
        <tfoot>
            <?php echo $this->render_grid_footer('tr', 'td'); ?>
        </tfoot>
    </table>
</div>
<div class="blueticket_forms-nav">
    <?php //echo $this->render_limitlist(true); ?>
    <?php echo $this->render_pagination(); ?>
    <?php //echo $this->render_search(); ?>
    <?php //echo $this->render_benchmark(); ?>
</div>
<div class="blueticket_forms-nav">
</div>
