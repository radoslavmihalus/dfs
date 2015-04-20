<div class="col-md-4" style="padding-left: 0px;">
    <!-- Description panel-->
    <div class="panel-body component col-lg-12">
        <!-- FCI number panel-->
        <div class="panel-description">{_ 'Kennel FCI number'} 
        </div>
        <div class="text-justify" style="font-size:12px;padding-top: 10px;">
            1478/2014
        </div>
        <hr>
        <!-- Kennel breed panel-->
        <div class="panel-description">{_ 'Breeds bred by our kennel'}</div>
        <div class="text-justify" style="font-size:12px;padding-top: 10px;">
            Cane Corso Italiano
        </div>
        <hr>
        <!-- Kennel description panel-->
        <div class="panel-description">{_ 'About us'} 
        </div>
        <div class="text-justify" style="font-size:12px;padding-top: 10px;">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent id tellus eros. Ut ultricies pharetra nisi, vel sodales enim. Fusce rutrum urna justo. Nulla commodo iaculis convallis. Duis ac sodales nulla, vel condimentum justo. Mauris at nisi id metus pellentesque facilisis quis eget dolor. Suspendisse interdum magna enim, vel pellentesque dolor tempus consectetur. Suspendisse sed metus leo. Nunc vitae dictum risus, convallis varius metus. Donec neque velit, volutpat vel tincidunt a, dignissim at nibh.
        </div>
        <hr>
        <!-- Kennel website-->
        <div class="panel-description">{_ 'Website'} 
        </div>
        <div class="text-justify" style="font-size:12px;padding-top: 10px;">
            www.something.com
        </div>
    </div>
    <!-- Dogs panel-->
    <div class="panel-body component col-lg-12">
        <div class="row" style="padding-left:15px;padding-right:15px;padding-bottom: 15px;">
            <div class="panel-description"><i class="glyphicons glyphicons-dog"></i>&nbsp;&nbsp;Dogs<button class="btn btn-danger btn-sm add-list-item" type="button"><i class="fa fa-plus"></i>&nbsp;{_ 'Add'}</button>                        
            </div>
        </div>
        <div class="row">
           <div class="col-md-12 text-center text-uppercase" style="padding:15px;color:#777">
                <i class="fa fa-mars gender-dog" style="color:#0c9eea;margin-right: 10px;"></i>{_ 'Dogs'}
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 padding">
                <a href="#">
                    <div class="list-item">
                        <div class="dog-image-profile-thumb">
                            <span class="list-mating-info" style="font-size:15px;"><i class="fa fa-venus-mars"></i>&nbsp;{_ 'Available for mating'}</span>
                        </div>    
                        <h3 class="text-uppercase">Bronca la rosa de inca</h3>
                        <hr style="margin-bottom: 10px;">
                        <span class="list-item-breed" style="font-size:13px;"><i class="fa fa-tag"></i>&nbsp;&nbsp;Dogo argentino</span>
                    </div>
                </a>
            </div>
            <div class="col-md-12 text-center text-uppercase" style="padding:15px;color:#777">
                <i class="fa fa-venus gender-bitch" style="margin-right: 10px;"></i>{_ 'Bitches'}
            </div>
            <!-- Message -->
                <div class="col-md-12">
                    <div class="message-brown font_size_13px" role="alert">
                        <i class="fa fa-info-circle"></i>&nbsp;&nbsp;{_ 'There are currently no added records'}
                    </div>
                </div>
            <!-- / Message -->
        </div>
    </div>
</div>
<div class="col-md-8" style="padding-left: 0px;">
    <!-- Timeline events -->
    <div class="panel-body component col-lg-12">
        <div class="row" style="padding-left:15px;padding-right:15px;padding-bottom: 15px;">
            <div class="panel-description"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;Timeline events 
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                include "templates/timeline.latte.php";
                ?>
            </div>
        </div>
    </div>
</div>

