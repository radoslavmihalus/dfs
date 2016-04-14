function Main(){
	var self= this;
	var show_timeout = 0;
	this.init= function(){
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
        
		$('input.icheck').iCheck({
            checkboxClass: 'icheckbox_square-red',
            radioClass: 'iradio_square-red',
            increaseArea: '20%'
        });

        $('.formLogin').submit(function(){
            _that = $(this);
            _data = _that.serialize();
            _data = _data + '&' + $.param({token:token});

            if(!_that.hasClass('disable')){
                _that.addClass('disable');
                self.show_notice('System processing...', 'error', '.msg');
                $.post(PATH+"Users/postLogin", _data, function(data){
                    if(data.st == 'success'){
                        self.show_notice(data.txt, data.st, '.msg');
                        setTimeout(function(){
                            window.location.reload();
                        },1000);
                    }else{
                        self.show_notice(data.txt, data.st, '.msg');
                    }
                    _that.removeClass('disable');
                },'json');
            }

            return false;
        });

        $('.formRegister').submit(function(){
            _that = $(this);
            _data = _that.serialize();
            _redirect = _that.data("redirect");
            _data = _data + '&' + $.param({token:token});

            if(!_that.hasClass('disable')){
                _that.addClass('disable');
                self.show_notice('System processing...', 'error', '.msg-register');
                $.post(PATH + "Users/postRegister", _data, function(data){
                    if(data.st == 'success'){
                        self.show_notice(data.txt, data.st, '.msg-register');
                        setTimeout(function(){
                            window.location.reload();
                        },1000);
                    }else{
                        self.show_notice(data.txt, data.st, '.msg-register');
                    }
                    _that.removeClass('disable');
                },'json');
            }

            return false;
        });
	};

	this.show_notice= function(txt, class_name, element){
        $(element).removeClass('error success').addClass(class_name).html(txt);

        clearTimeout(show_timeout);
        show_timeout = setTimeout(function(){
            $(element).html('');
        }, 8000);
    };

    this.startPageLoading = function(element,overplay) {
        if (element) {
            $(element).append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
        } else {
            $('body').append('<div class="page-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
        }
    };

    this.stopPageLoading = function(element) {
        $(element + ' .page-loading, '+element + '.page-spinner-bar').remove();
    };
}
Main= new Main();
$(function(){
	Main.init();
});