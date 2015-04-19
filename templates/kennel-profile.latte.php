<div id="profile_div" class="panel-default col-lg-12 profile_wrapper" style="font-size: 12px;">
    <div class="panel-body component">
        <div class="profile-header-image">
            <div class="header-spacer">
            </div>
            <img src="img/referer1.jpg" class="pull-left image-profile-thumb">
        </div>
        <div class="row">
            <div class="col-md-6">
                <h1 class="profile_type_heading text-uppercase">Faalat rhodesian ridgeback kennel</h1>
                <span class="profile-type-description"><i class="fa fa-home"></i>&nbsp;&nbsp;{_ 'Kennel'}</span>
                <span class="profile-type-description" style="margin-left: 20px"><i class="fa fa-map-marker"></i>&nbsp;&nbsp;Slovakia</span>
            </div>
            <div class="col-md-6" style="padding-top: 15px;">
                <div class="btn-group btn-group-sm btn-group-justified" role="group" aria-label="...">
                    <a type="button" class="btn btn-default"><i class="fa fa-users"></i>&nbsp;&nbsp;{_ 'Add friend'}</a>
                    <a type="button" class="btn btn-default"><i class="fa fa-rss"></i>&nbsp;&nbsp;{_ 'Follow'}</a>
                    <a type="button" class="btn btn-default"><i class="fa fa-envelope"></i>&nbsp;&nbsp;{_ 'Message'}</a>
                    <a type="button" class="btn btn-default navbar-toggle collapsed toogle-margin-zero" data-toggle="collapse" data-target="#profile-menu">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                </div>
            </div>
        </div>
        <hr style="margin-bottom: 0px;margin-top: 10px;">
        <!-- Profile menu-->
        <div class="row">
            <div class="container-fluid profile-menu">
                <div class="collapse navbar-collapse" id="profile-menu" role="navigation" style="padding: 0px;">
                    <ul class="nav navbar-nav" style="margin:0px;">
                        <li class="active"><a href="#" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Home'}</a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Awards'}</a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Dogs'}</a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Planned litters'}</a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Puppies for sale'}</a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Photos'}</a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Videos'}</a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Friends'}</a></li>
                        <li><a href="#" class="page-scroll text-uppercase landing_navbar_typography">{_ 'Followers'}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    {include 'kennel-profile-home.latte.php'}
</div>

