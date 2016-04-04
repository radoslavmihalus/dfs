function Main(){
	var self= this;
	var show_timeout = 0;
	this.init= function(){
		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();

		$(".open-image").fancybox({
          	helpers: {
              	title : {
                  	type : 'float'
              	}
          	}
      	});

      	$('.language').change(function(){
      		_that = $(this);
      		_lang = _that.val();
      		$.post(PATH+"Home/setLang", {token: token, lang: _lang}, function(data){
      			window.location.reload();
      		});
      	});

		$('.icheck').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });

        var checkAll = $('input.CheckAll');
	    var checkboxes = $('input.checkItem');

	    $('icheck').iCheck();

	    checkAll.on('ifChecked ifUnchecked', function(event) {        
	        if (event.type == 'ifChecked') {
	            checkboxes.iCheck('check');
	        } else {
	            checkboxes.iCheck('uncheck');
	        }
	    });

	    checkboxes.on('ifChanged', function(event){
	        if(checkboxes.filter(':checked').length == checkboxes.length) {
	            checkAll.prop('checked', 'checked');
	        } else {
	            checkAll.removeProp('checked');
	        }
	        checkAll.iCheck('update');
	    });

	    $('.CheckAll').click(function(){
			_that = $(this);
			if(_that.is(':checked')){
				$('.checkItem').prop('checked', true);
			}else{
				$('.checkItem').prop('checked', false);
			}
		});

		$('.btnDeleteAll').click(function(){
			_that = $(this);
			_data = $('.formList').serialize();
			_data = _data + '&' + $.param({token:token});
			var popup = confirm(slug_confirm_delete);
			if (popup == true) {
				if(!_that.hasClass('disable')){
					_that.addClass('disable');
					self.show_notice(slug_system_processing, 'error');
					$.post(PATH + module + "/postDeleteAll", _data, function(data){
						window.location.reload();
						_that.removeClass('disable');
					},'json');
				}
			}

			return false;
		});

		$('.btnStatusAll').click(function(){
			_that   = $(this);
			_data   = $('.formList').serialize();
			_status = (_that.hasClass('item-show'))?1:0;
			_data   = _data + '&' + $.param({token:token,status:_status});

			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				self.show_notice(slug_system_processing, 'error');
				$.post(PATH + module + "/postStatusAll", _data, function(data){
					window.location.reload();
					_that.removeClass('disable');
				},'json');
			}

			return false;
		});
		
		$('.btnDelete').click(function(){
			_that = $(this);
			_id   = _that.parents('tr').data('id');
			_data = $.param({token:token, id:_id});
			var popup = confirm(slug_confirm_delete);
			if (popup == true) {
			   	$.post(PATH + module + "/postDelete", _data, function(data){
			   		if(data.st == 'success'){
						window.location.reload();
					}else{
						alert(data.txt);
					}
			   	},'json');
			}
		});

		$('.formProfile').submit(function(){
			_that = $(this);
			_data = _that.serialize();
			_redirect = _that.data("redirect");
			_data = _data + '&' + $.param({token:token});

			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				self.show_notice(slug_system_processing, 'error');
				$.post(PATH + module + "/postProfile", _data, function(data){
					if(data.st == 'success'){
						self.show_notice(data.txt, data.st);
						setTimeout(function(){
							window.location.assign(PATH + _redirect);
						},1000);
					}else{
						self.show_notice(data.txt, data.st);
					}
					_that.removeClass('disable');
				},'json');
			}

			return false;
		});

		$('.formUpdate').submit(function(){
			_that = $(this);
			_data = _that.serialize();
			_redirect = _that.data("redirect");
			_data = _data + '&' + $.param({token:token});

			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				self.show_notice(slug_system_processing, 'error');
				$.post(PATH + module + "/postUpdate", _data, function(data){
					if(data.st == 'success'){
						self.show_notice(data.txt, data.st);
						setTimeout(function(){
							window.location.assign(PATH + _redirect);
						},1000);
					}else{
						self.show_notice(data.txt, data.st);
					}
					_that.removeClass('disable');
				},'json');
			}

			return false;
		});

		$('.show-analytics').hover(function(){
			_that = $(this);
			_id   = _that.parents('tr').data('id');
			_text = _that.data('original-title');
			clearTimeout(show_timeout);
			show_timeout = setTimeout(function(){
				_that.parents(".btn-group").find(".tooltip-inner").html("<span class='sploading'></span>");
				$.post(PATH + module + "/getInfo", { token : token, id: _id }, function(data){
					_that.parents(".btn-group").find(".tooltip-inner").html(data);
					_that.attr("data-original-title", data);
					_that.removeClass("none")
					$('.show-analytics').removeClass("disable");
				});
			},200);
		});

		$('.stacked-post a').click(function(){
			_that = $(this);
			_that.find('input').prop('checked', true);
		});

		//.add(30, 'minutes')
		$('.date_range').appendDtpicker({
			"current": moment().format('YYYY-MM-DD HH:mm'),
			"minDate": moment().format('YYYY-MM-DD HH:mm'),
			"maxDate": moment().add(60, 'days').format('YYYY-MM-DD HH:mm'),
			"autodateOnStart": true
		});

		$('.dialog-upload').click(function() {
			var _that = $(this);
			var fm = $('<div/>').dialogelfinder({
				url : BASE+'assets/admin/plugins/elFinder/php/connector.php',
				lang : 'en',
				width : 840,
				destroyOnClose : true,
				getFileCallback : function(files, fm) {
					_that.parents(".form-group").find(".form-control").val(files.url);
					console.log(files);
				},
				commandsOptions : {
					getfile : {
						oncomplete : 'close',
						folders : true
					}
				}
			}).dialogelfinder('instance');
		});

		$('.formSchedule').submit(function(){
			_that = $(this);
			_data = _that.serialize();
			_redirect = _that.data("redirect");
			_data = _data + '&' + $.param({token:token});
			self.startPageLoading('.wrap-box-post');
			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				$.post(PATH + "Posts/ajax_post", _data, function(data){
					if(data.st == "error"){
						$('.input-error').removeClass('input-error');
						$('.list-errors').html('');
						$.each( data, function( key, value ) {
							if(key != "st"){
								$('.list-errors').slideDown();
								$('.list-errors').append('<div><i class="fa fa-exclamation-circle"></i> '+value["text"]+'</div>');
					  			$('[name='+value["type"]+']').addClass("input-error");
					  			$('.'+value["type"]).addClass("input-error");
							}
						});
						_that.removeClass('disable');
					}else{
						$('.input-error').removeClass('input-error');
						$('.list-errors').html('').addClass('callout-success');
						$.each( data, function( key, value ) {
							if(key != "st"){
								$('.list-errors').slideDown();
								$('.list-errors').append('<div><i class="fa fa-exclamation-circle"></i> '+value["text"]+'</div>');
							}
						});
						setTimeout(function(){
							window.location.reload();
						},1000);
					}

					self.stopPageLoading('.wrap-box-post');
				},'json');
			}

			return false;
		});

		$('.formScheduleUpdate').submit(function(){
			_that = $(this);
			_data = _that.serialize();
			_redirect = _that.data("redirect");
			_data = _data + '&' + $.param({token:token});
			self.startPageLoading('.wrap-box-post');
			if(!_that.hasClass('disable')){
				_that.addClass('disable');
				$.post(PATH + "Posts/postUpdate", _data, function(data){
					if(data.st == "error"){
						$('.input-error').removeClass('input-error');
						$('.list-errors').html('');
						$.each( data, function( key, value ) {
							if(key != "st"){
								$('.list-errors').slideDown();
								$('.list-errors').append('<div><i class="fa fa-exclamation-circle"></i> '+value["text"]+'</div>');
					  			$('[name='+value["type"]+']').addClass("input-error");
					  			$('.'+value["type"]).addClass("input-error");
							}
						});
						_that.removeClass('disable');
					}else{
						$('.input-error').removeClass('input-error');
						$('.list-errors').html('').addClass('callout-success');
						$.each( data, function( key, value ) {
							if(key != "st" && key != "url"){
								$('.list-errors').slideDown();
								$('.list-errors').append('<div><i class="fa fa-exclamation-circle"></i> '+value["text"]+'</div>');
							}
						});
						setTimeout(function(){
							window.location.assign(data.url);
						},1000);
					}

					self.stopPageLoading('.wrap-box-post');
				},'json');
			}

			return false;
		});
	};

	this.chart = function(){
		_timeout = 0;
		setTimeout(function(){ self.ajax_chart('report_posts'); },_timeout);
	};

	this.ajax_chart = function(element){
		$('.' + element).html('');
		self.startPageLoading('.' + element);
		_daterange = $('.daterange').val();
		_data = $.param({token:token, daterange: _daterange});
		$.post(PATH + 'Reports/ajax_' + element, _data, function(data){
			$('.' + element).html(data);
			self.stopPageLoading('.' + element);
		});
	};

	this.Highcharts = function(options){
		$(options.element).highcharts({
	        chart: {
	            zoomType: 'x',
	            height  : (options.height)?options.height:300
	        },
	        title: {
	            text: (options.title)?options.title:''
	        },
	        subtitle: {
	            text: (options.subtitle)?options.subtitle:''
	        },
	        xAxis: {
	            type: (options.titlex)?options.titlex:'',
	            dateTimeLabelFormats: {
                    day: (options.format)?options.format:'%b %e',
                }
	        },
	        yAxis: {
	            title: {
	                text: (options.titley)?options.titley:''
	            }
	        },
	        legend: {
	            enabled: true
	        },
	        tooltip: {
	            crosshairs: (options.crosshairs)?true:false,
	            shared: true
	        },
	        plotOptions: {
	        	spline: {
	                marker: {
	                    radius: 4,
	                    lineColor: '#666666',
	                    lineWidth: 1
	                }
	            },
	            line: {
	                marker: {
	                    radius: 4,
	                    lineColor: '#666666',
	                    lineWidth: 1
	                },
	                tooltip: {
		        	    valueSuffix: (options.suffix)?options.suffix:''
		            },
	                color: (options.colory)?options.colory:Highcharts.getOptions().colors[5]
	            },
	            area: {
	                fillColor: {
	                    linearGradient: {
	                        x1: 0,
	                        y1: 0,
	                        x2: 0,
	                        y2: 1
	                    },
	                    stops: [
	                        [0, (options.colorx)?options.colorx:Highcharts.getOptions().colors[5]],
	                        [1, Highcharts.Color((options.colory)?options.colory:Highcharts.getOptions().colors[5]).setOpacity(1).get('rgba')]
	                    ]
	                },
	                marker: {
	                    radius: 0
	                },
	                color: (options.colory)?options.colory:Highcharts.getOptions().colors[5],
	                lineWidth: 1,
	                states: {
	                    hover: {
	                        lineWidth: 0
	                    }
	                },
	                threshold: null
	            },
	            pie: {
	            	tooltip: {
		        	    valueSuffix: '%',
		        	    pointFormatter: function() {
		        	    	return '<span style="color: '+this.series.tooltipOptions.backgroundColor+'">\u25CF</span> '+this.series.name+': <b>'+self.round(this.percentage,2)+'%</b><br/>.'
		            	}
		            },
	            }
	        },

	        series: (options.multi)?options.data:[{ type: (options.type)?options.type:'line',name: (options.name)?options.name:'', data: (options.data)?options.data:'', dataLabels: (options.dataLabels)?options.dataLabels:'{point.y}' }]
	    });
		list_chart.push(options.element);
	};

	this.round = function(value, decimals) {
	    return Number(Math.round(value + 'e' + decimals) + 'e-' + decimals);
	};

	this.resize = function(){
		$(window).resize(function(){
			$('.listCore').height($(window).height());
			$('.listCore').width($('.box-listCore').width());
		});
	};

	this.formatNumber = function(number)
	{
	    var number = number.toFixed(0) + '';
	    var x = number.split('.');
	    var x1 = x[0];
	    var x2 = x.length > 1 ? '.' + x[1] : '';
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
	        x1 = x1.replace(rgx, '$1' + ',' + '$2');
	    }
	    return x1 + x2;
	};

	this.show_notice= function(txt, class_name){
        $('.msg').removeClass('error success').addClass(class_name).html(txt);

        clearTimeout(show_timeout);
        show_timeout = setTimeout(function(){
            $('.msg').html('');
        }, 8000);
    };

    this.startPageLoading = function(element) {
        if (element) {
            $(element).append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
        } else {
            $('body').append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
        }
    };

    this.stopPageLoading = function(element) {
        $(element + ' .page-loading, '+element + ' .page-spinner-bar').remove();
    };
}
Main= new Main();
$(function(){
	Main.init();
});