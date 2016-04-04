<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="header" style="text-transform: uppercase;"><?=l('slug-main-navigation')?></li>
            <li class="treeview">
                <a href="<?=PATH?>">
                    <i class="fa fa-dashboard"></i> <span><?=l('slug-dashboard')?></span></i>
                </a>
            </li>
            <li class="treeview">
                <a href="<?=PATH?>schedules">
                    <i class="fa fa-tasks"></i> <span><?=l('slug-manage-schedules')?></span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?=PATH?>facebook">
                    <i class="fa fa-facebook-square"></i> <span><?=l('slug-accounts-facebook')?></span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?=PATH?>reports">
                    <i class="fa fa-pie-chart"></i> <span><?=l('slug-reports')?></span>
                </a>
            </li>
            <?php if(session("admin") == 1){?>
            <li class="treeview">
                <a href="<?=PATH?>users">
                    <i class="fa fa-user"></i> <span><?=l('slug-manage-user')?></span></i>
                </a>
            </li>
            <li class="treeview">
                <a href="<?=PATH?>settings">
                    <i class="fa fa-cogs"></i> <span><?=l('slug-settings')?></span></i>
                </a>
            </li>
            <?php }?>
        </ul>
    </section>
</aside>