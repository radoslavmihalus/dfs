<div class="container-fluid user-menu" >
    <div class="collapse navbar-collapse" id="user-menu" role="navigation" style="padding: 0px;">
        <div class="user-block">
            <img class="user-block-thumb" src="img/referer1.jpg" />
<!--                    <p class="user-block-type"><i class="fa fa-eye"></i>&nbsp;&nbsp;</i>Spectator</p>-->
            <p class="user-block-type"><i class="fa fa-home"></i>&nbsp;&nbsp;</i>{_'Spectator'}</p>
<!--                    <p class="user-block-type"><i class="fa fa-user"></i>&nbsp;&nbsp;</i>Owner of purebred dog</p>
            <p class="user-block-type"><i class="fa fa-user"></i>&nbsp;&nbsp;</i>Handler</p>-->
            <p class="text-uppercase user-block-name" id="userName"></p>
        </div>
        <ul class="nav nav-stacked user-menu-links" id="accordion1">
            <li class="panel"> 
                <a data-toggle="collapse" data-parent="#accordion1" href="#firstLink"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Profile settings</a>
                <ul id="firstLink" class="collapse panel-collapse">
                    <li>
                        <a href="#"><i class="fa fa-exchange"></i>&nbsp;&nbsp;Switch profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;Edit profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;Delete profile</a>
                    </li>
                </ul>
            </li>
            <li class="panel"> 
                <a data-toggle="collapse" data-parent="#accordion1" href="#secondLink"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;My profile</a>
                <ul id="secondLink" class="collapse panel-collapse">
                    <li>
                        <a href="#"><i class="fa fa-desktop"></i>&nbsp;&nbsp;Home</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-trophy"></i>&nbsp;&nbsp;Awards</a>
                    </li>
                    <li>
                        <a href="#"><i class="glyphicons glyphicons-dog"></i>&nbsp;&nbsp;Dogs</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Planned litters</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-trash-o"></i>&nbsp;&nbsp;Puppies for sale</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-camera"></i>&nbsp;&nbsp;Photos</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-video-camera"></i>&nbsp;&nbsp;Videos</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users"></i>&nbsp;&nbsp;Friends</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-rss"></i>&nbsp;&nbsp;Followers</a>
                    </li>
                </ul>
            </li>
            <li class="panel">
                <div>DOGFORSHOW</div>
            </li>
            <li>
                <div class="input-group custom-search-form search">
                    <input type="text" class="form-control search-bar-typing" placeholder="Search DOGFORSHOW ...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            <li class="panel"> 
                <a data-toggle="collapse" data-parent="#accordion1" href="#thirdLink"><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Lists</a>
                <ul id="thirdLink" class="collapse panel-collapse">
                    <li>
                        <a href="#"><i class="fa fa-home"></i>&nbsp;&nbsp;Kennels<span class="badge" style="float:right">0</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="glyphicons glyphicons-user"></i>&nbsp;&nbsp;Owners of purebred dogs<span class="badge" style="float:right">0</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="glyphicons glyphicons-shirt"></i>&nbsp;&nbsp;Handlers<span class="badge" style="float:right">0</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="glyphicons glyphicons-dog"></i>&nbsp;&nbsp;Dogs<span class="badge" style="float:right">0</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-venus-mars"></i>&nbsp;&nbsp;Dogs for mating<span class="badge" style="float:right">0</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Planned litters<span class="badge" style="float:right">0</span></a>
                    </li>
                    <li>
                        <a href="#">Puppies for sale<span class="badge" style="float:right">0</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="glyphicons glyphicons-certificate"></i>&nbsp;&nbsp;Best in show<span class="badge" style="float:right">0</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        showLoadingAnimation();
        $.ajax("templates/scripts/get.php?login")
                .done(function (result) {
                    $("#userName").html(result);
                })
                .fail(function () {
                    //alert("error");
                })
                .always(function () {
                    hideLoadingAnimation();
                });
    });
</script>