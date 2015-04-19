    <div class="col-lg-12">
        <div class="col-md-4">
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
                    <div class="panel-description"><i class="fa fa-paw"></i>&nbsp;&nbsp;Dogs<button class="btn btn-danger btn-sm add-list-item" type="button"><i class="fa fa-plus"></i>&nbsp;{_ 'Add'}</button>                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p style="font-size:12px;color:gray">
                            <i class="fa fa-mars gender-dog" style="color:#0c9eea"></i>&nbsp;Males
                        </p>
                        <ul class="dog-list">
                            <li>
                                <a>
                                    <div class="dog-thumb pull-left"></div>
                                    <p class="dog-name">AMIR faalat rhodesian ridgeback</p>
                                    <p class="dog-datebirth"><i class="fa fa-calendar-o"></i>&nbsp;15.2.2014</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p style="font-size:12px;color:gray">
                            <i class="fa fa-venus gender-bitch"></i>&nbsp;Females
                        </p>
                        <ul class="dog-list">
                            <li>
                                <a>
                                    <div class="dog-thumb pull-left"></div>
                                    <p class="dog-name">Jasmine faalat rhodesian ridgeback</p>
                                    <p class="dog-datebirth"><i class="fa fa-calendar-o"></i>&nbsp;15.2.2014</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
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
    </div>
