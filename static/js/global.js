$("#ajax_login").on('click' , function(event) {
    var username = $("#login_username").val(),
    password = $("#login_password").val();
    var return_data = _td.api.loginUser({
        "name" : username,
        "pwd" : password
    }).then(function(){
        showAlter(true,"登录成功！");
         setTimeout(function(){
            location.reload();
        },1000)
    }, function(){
        showAlter(false,"您输入的账号或密码错误，请检查后再试");
    });
    return_data = JSON.parse(return_data);
});

$("#ajax_outlogin").on('click', function(event) {
    $.ajax({
        url: './api/user_api/logout',
        type: 'GET',
        success:function(){
             showAlter(true,"退出成功！");
             setTimeout(function(){
                location.reload();
            },1000)
        },
        error:function(){
            showAlter(false,"!");
        }
    });
    
 
});


$("#ajax_reg").on('click' , function() {
    var password = $("#reg_password").val(),
    email = $("#reg_email").val(),
    nick = $("#reg_nick").val();
    if(password == "" || email == "" || nick == "" ){
        showAlter(false , "您输入的账号或密码不能为空");
        return;
    }
    if(password != $("#reg_password_r").val()){
        showAlter(false , "两次输入的密码不一致");
        return;
    }
    _td.api.createUser({
        "name" : email,
        "nickname" : nick,
        "pwd" : password
    }).then(function(){
        showAlter(true , "注册账号成功！请重新登录");
        setTimeout(function(){
            location.reload();
        },1000)
    },function(msg){
        showAlter(msg);
    });
});



function showAlter(type , value){
    $showAlter = $(".showAlert");
    icon = type ? "<i class='icon-ok'></i> " : "<i class='icon-remove'></i> ";
    color = type ? "aletrContent success" : "aletrContent danger";
    $showAlter.find(".aletrContent").attr("class" , color);
    $showAlter.find(".aletrContent").html(icon + value);
    setTimeout(function(){
        $showAlter.show();
        $showAlter.css({"top": "13%"});
    },100)
    setTimeout(function(){
        $showAlter.css({"top": "0px"});
        $showAlter.fadeOut(500);
    },1900)
}

$(".bomb-login").click(function(event) {
    $("#reg").hide();
    bomb("login");
});
$(".bomb-reg").click(function(event) {
    $("#login").hide();
    bomb("reg");
});
$(".window .close").on('click', function(event) {
    $(this).parent().parent().hide();
    $(".window").hide();
});

function bomb(eName){
    $(".window,#" + eName).show();
    $login = $("#" + eName);
    setTimeout(function(){
        $login.show();
    },100)
}






$(document).ready(function() {

    $.each($('[data-widget]'), function(index, value) {
        var $widget = $(value);

        switch($widget.attr('data-widget')) {
            case 'slider': initSlider($widget); break;
            case 'tab': initTab($widget); break;
            case 'tag': initTag($widget); break;
        }
    });

    function initTag($tag){
        var tagIndex = 0, value ="";
        $tag.find('input[type="text"]').blur(function(){
            value = $(this).val();
            if(value == ""){return;}
            addTag($tag , value);
            $(this).val("");
        });
        $tag.on('click', '.close', function(event) {
            tagIndex = tagIndex - 1;
            console.log(tagIndex);
            $(this).parent().remove();
        });
        $tag.keyup(function(e) {
            value = $tag.find('input[type="text"]').val();
            if(e.keyCode == 13){
            if(value == "" || value.length >18){return;}
            $tag.find('input[type="text"]').val("");
            addTag($tag,value);
        }
    });

        function addTag($tag , tagName){
            tagIndex ++;
            if(tagIndex >5){return false;}
            $tag.append('<span class="tag-box">'+tagName+' <button class="close">X</button></span>');
        }

    }


    /**
     * @method initSlider
     * @description init slider
     * @param {Selector} selTrigger: use to select triggers
     * @param {Selector} selSheet: use to select sheets
     * @param {Number} interval: use to set interval
     * @param {String} activeClass: use to add on active sheet and trigger
     * @param {Number} curIndex: slider will start from this index
     */
    function initSlider($slider) {
        var config = $.extend({
                selTrigger: '.js-slider-trigger',
                selSheet: '.js-slider-sheet',
                interval: 5000,
                activeClass: 'active',
                curIndex: 0
            }, JSON.parse($slider.attr('data-config') || '{}')),
            $triggers = $slider.find(config.selTrigger).children('li'),
            $sheets = $slider.find(config.selSheet).children('li'),
            count = $sheets.length,
            timer;

        refresh(config.curIndex);
		setTimer();

		$slider.delegate(config.selTrigger + ' li', 'click', function (e) {
			var index = $triggers.index(e.currentTarget);
			index !== config.curIndex && refresh(index) || setTimer();
		});

		function setTimer() {
			timer && clearInterval(timer);
			timer = setInterval(refresh, config.interval);
		}

		function refresh(newIndex) {
			newIndex = newIndex === undefined ? (config.curIndex + 1) % count : newIndex;

			$triggers.eq(config.curIndex).removeClass(config.activeClass);
			$triggers.eq(newIndex).addClass(config.activeClass);
			$sheets.eq(config.curIndex).removeClass(config.activeClass);
			$sheets.eq(newIndex).addClass(config.activeClass);
			config.curIndex = newIndex;
		}
    }

    /**
     * @method initTab
     * @description init tab
     * @param {Selector} selTrigger: use to select triggers
     * @param {Selector} selSheet: use to select sheets
     * @param {String} activeClass: use to add on active sheet and trigger
     * @param {Number} curIndex: tab will start from this index
     */
    function initTab($tab) {
        var config = $.extend({
                selTrigger: '.js-tab-trigger',
                selSheet: '.js-tab-sheet',
                activeClass: 'active',
                curIndex: 0
            }, JSON.parse($tab.attr('data-config') || '{}')),
            $triggers = $tab.find(config.selTrigger).children('li'),
            $sheets = $tab.find(config.selSheet).children('li');

        refresh(config.curIndex);

		$tab.delegate(config.selTrigger + ' li', 'click', function (e) {
			var index = $triggers.index(e.currentTarget);
			index !== config.curIndex && refresh(index);
		});

		function refresh(newIndex) {
			$triggers.eq(config.curIndex).removeClass(config.activeClass);
			$triggers.eq(newIndex).addClass(config.activeClass);
			$sheets.eq(config.curIndex).removeClass(config.activeClass);
			$sheets.eq(newIndex).addClass(config.activeClass);
			config.curIndex = newIndex;
		}
    }
});
