function setCookie(key, value, expire) {
    var DAY = 24 * 60 * 60 * 1000,
        now = new Date(),
        exp = expire ? expire : 30;

    now.setTime(now.getTime() + exp * DAY);
    document.cookie = key + "=" + encodeURIComponent(value) + "; path=/" + "; expires=" + now.toGMTString();
}

function getCookie (key) {
    var keys = document.cookie.split("; "),
        len = keys.length, tmp;

    while (len--) {
        tmp = keys[len].split('=');
        if (tmp[0] === key) {
            return decodeURIComponent(tmp[1]);
        }
    }
}

$(function () {
    var eleInfo = document.getElementById('page-info'),
        defaultInfo = {
            title: '天地君道培训官网-国内最专业的游戏开发在线教育平台',
            keywords: '天地君道培训,在线教育,游戏开发培训,VR游戏开发,AR游戏开发,手机游戏开发培训,游戏编程培训,unity5,cocos2dx,android,ios,flash,java,html5',
            description: '天地君道培训是国内最专业的游戏开发在线教育平台。天地君道培训提供了丰富的适用于零基础学习游戏开发及IT职业技能的在线直播课程。课程内容涵盖多个热门技术方向，例如Unity3D、Cocos2dx、Android、iOS、HTML5等。天地君道培训同时推出的秒答、在线课堂、学习印记和精英汇让编程学习更轻松，学完就业有保障。用编程实现梦想！'
        };

    document.title = (eleInfo && eleInfo.getAttribute('data-title')) || defaultInfo['title'];
    document.getElementsByName('keywords')[0].setAttribute('content', (eleInfo && eleInfo.getAttribute('data-keywords')) || defaultInfo['keywords']);
    document.getElementsByName('description')[0].setAttribute('content', (eleInfo && eleInfo.getAttribute('data-description')) || defaultInfo['description']);
});

$(function () {
    if (_td.info.id === -1 && !getCookie('popup_once')) {
        $('.js-popup').removeClass('hidden');
    }
    $('.js-close-popup').click(function () {
        $('.js-popup').addClass('hidden')
        setCookie('popup_once', true, 1);
    });
});

// 定时获取新消息
if (_td.info.id !== -1) {
    setInterval(function () {
        _td.api.getNews().then(function (res) {
            var msg = [];

            $.each(res.data, function (index, item) {
                switch (item.type) {
                case '200':
                    msg.push('您有问题被认领啦');
                    break;
                case '201':
                case '301':
                    msg.push('您有问题被回答啦');
                    break;
                case '202':
                    msg.push('您有问题被评论啦');
                    break
                }
            });

            if (msg.length !==0) {
                notifyMe(msg.join('\n'));
            }
        });
    }, 30000);
}
function notifyMe(msg) {
    if (!("Notification" in window)) return;

    var options = {
        icon: 'favicon.ico'
    };
    if (Notification.permission === "granted") {
        new Notification(msg, options);
    } else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
            if (permission === "granted") {
                new Notification(msg, options);
            }
        });
    }
}

$(".ajax_up").on("click" , function(){
    var _this= $(this);
    var problem_id = $(this).parents().data('id');
    _td.api.upProblem({
        problem_id : problem_id,
    }).then(function(msg){
        if(msg.data == "0"){
            showAlert(true , "点赞成功！");
            _this.find('.upCount').text(parseInt(_this.find('.upCount').text()) + 1);
        }else{
            showAlert(true , "取消点赞成功！");
            _this.find('.upCount').text(parseInt(_this.find('.upCount').text()) - 1);
        }
    },function(msg){
       showAlert(false , msg.error);
    });
});

$("#confirm .button_ok").click(function(){
    var id = $(this).attr('data-id');
	_td.api.chou({
		"problem_id" : id
	}).then(function(){
		showAlert(true,"众筹成功！银币 -50");
		 setTimeout(function() {
             location.href = 'problem/?p=' + id;
		 }, 1000)
	}, function() {
		showAlert(false, '您已参加过该众筹！');
		setTimeout(function(){
			close();
		}, 700)
	})
});

$(".js_chou").click(function(event) {
	$(".windows").show();
	$(".confirm").show().find('.button_ok').attr('data-id', $(this).attr('data-id'));
	setTimeout(function(){
		$(".confirm").css({"top" : "20%"});
	}, 100);
});

$(".forget").click(function(event) {
    $("#reg").hide();
    $("#login").hide();
    bomb("forget");
});

$("#ajax_forget").click(function(){
    var _this = $(this),
    email = $("#userEmail").val(),
    verification = $("#verification").val();
    if(email == ""){ showAlert(false, "请输入正确的邮箱");}
    if(verification == "" || verification.length < 6){ showAlert(false, "请输入正确的验证码");}
    _td.api.forget({
        email : email,
        verification : verification
    }).then(function(msg){
        $("#forget").hide();
        $(".window").hide();
        showAlert(true,"新的密码已经发送到您的邮箱，请注意查收！");
    },function(msg){
        $("#image_id").attr("src" , "./Verification");
        showAlert(false, msg.error);
    });
})

var searchHoverType = true;
$(".js-search-submit").hover(function() {
    searchHoverType = false;
}, function() {
    searchHoverType = true;
});

$('.js-search-input').bind('focus', function () {
    $(this).stop(true, true).animate({
        width: '+=300px'
    }, 400);
    $('.js-nav').hide();
}).bind('blur', function () {
    if(searchHoverType){
        $(this).stop(true, true).animate({
            width: '-=300px'
        }, 400, function () {
            $('.js-nav').show();
        });
    }
});

$('.js-search-form').bind('submit', function (e) {
    e.preventDefault();
    window.location.href ="./seacher?key=" +$(".js-search-input").val();
    return false;
});

$(".button").on("click" , ".collect" , function(){
    var _this = $(this);
    _td.api.collectProblem({
        problem_id : problem_id,
    }).then(function() {
        location.reload();
    },function(res) {
        showAlert(false, res.error);
    });
})
$(".button").on("click" , ".uncollect" , function(){
    _td.api.uncollectProblem({
        problem_id : problem_id,
    }).then(function() {
            location.reload();
    },function(res) {
        showAlert(false, res.error);
    });
})

$(document).on("click" , "#close_window" ,function(event) {
	close();
});
function close(){
	$(".confirm").css({"top" : "0px"});
	setTimeout(function(){
		$(".windows").fadeOut(200);
		$(".confirm").fadeOut(200);
	},250)
}


/*关注用户*/
var ajaxEyeLock = true;
$("#ajax_eye, #ajax_uneye").click(function(event) {
    if (!ajaxEyeLock) return;

    var type = event.target.id == "ajax_uneye" ? false : true;
    ajaxEyeLock = false;
    _td.api.eye({
        "user_id" : $(this).data('id'),
        "type" : type
    }).then(function(msg){
        showAlert(true,type ? "恭喜您！关注成功" : "取消关注成功！");
        setTimeout(function(){
            location.reload();
        }, 600);
    },function(msg){
        showAlert(false,msg.error);
    })
});


$("#login-form").on('submit' , function(event) {
    event.preventDefault();
    var username = $("#login_username").val(),
    password = $("#login_password").val();
    _td.api.loginUser({
        "name" : username,
        "pwd" : password
    }).then(function(res) {
        showAlert(true, "登录成功！");
        setTimeout(function() {
            if (res.data.type === '1') {
                location.href = 'home?uid=' + res.data.id;
            } else {
                location.reload();
            }
        }, 1000)
    }, function(){
        showAlert(false, "您输入的账号或密码错误，请检查后再试");
    });
});

$("#ajax_outlogin").on('click', function(event) {
    $.ajax({
        url: './api/user_api/logout',
        type: 'GET',
        success:function(){
             showAlert(true,"退出成功！");
             setTimeout(function(){
                location.href = '';
            },1000)
        },
        error:function(){
            showAlert(false, "!");
        }
    });


});


$("#register").on('submit' , function(event) {
    event.preventDefault();
    var password = $("#reg_password").val(),
        email = $("#reg_email").val(),
        nick = $("#reg_nick").val(),
        avatar = $('#reg_avatar').val() || 'none';

    if(password == "" || email == "" || nick == "" ){
        showAlert(false , "您输入的账号或密码不能为空");
        return;
    }
    if(password != $("#reg_password_r").val()){
        showAlert(false , "两次输入的密码不一致");
        return;
    }
    if(!document.getElementById("reg_ok").checked){
       showAlert(false , "您需要先同意并接受服务条款");
        return;
    }


    _td.api.createUser({
        email : email,
        nickname : nick,
        pwd : password,
        avatar: avatar
    }).then(function() {
        if(document.getElementById("reg_god").checked){
                showAlert(true , "注册账号成功！请继续填写详细信息，首次注册赠送200银币已到帐！激活邮箱再送300银币！");
        }else{
                showAlert(true , "注册账号成功！首次注册赠送200银币已到帐！激活邮箱再送300银币！");
        }
        setTimeout(function(){
            if(document.getElementById("reg_god").checked){
               window.location.href="./god/apply";
            }else{
                location.reload();
            }
        }, 1000);
    }, function(res) {
        showAlert(false, res.error);
    });
});


var isShow = false;
function showAlert(type , value){
    if(isShow == false){
        isShow = true;
        $showAlert = $(".showAlert");
        icon = type ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i> ";
        color = type ? "aletrContent success" : "aletrContent danger";
        $showAlert.find(".aletrContent").attr("class" , color);
        $showAlert.find(".aletrContent").html(icon + value);
        setTimeout(function(){
            $showAlert.show();
            $showAlert.css({"top": "13%"});
        },100)
        setTimeout(function(){
            isShow = false;
            $showAlert.css({"top": "0px"});
            $showAlert.fadeOut(500);
        },1500)
    }
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
    $('#sign_btn').click(function(){
        $.ajax({
            url: './api/sign_api/sign',
            type: 'GET',
            dataType:'json',
            success:function(data){
                showAlert(data.status,data.error);
                if(data.status){
                    setTimeout(function(){
                        location.reload();
                    },1000)
                }
            },
            error:function(){
                showAlert(false, "!");
            }
        });
    });

    $.each($('[data-widget]'), function(index, value) {
        var $widget = $(value);

        switch($widget.attr('data-widget')) {
            case 'slider': initSlider($widget); break;
            case 'tab': initTab($widget); break;
            case 'tag': initTag($widget); break;
        }
    });

    function initTag($tag) {
        var value = "",
            timeOut = true,
            index = 0,
            temp_index = 0,
            tagIndex = 0,
            tagList = {};

        /*处理用户鼠标移入IDE*/
        $tag.on('mouseover', 'li', function(event) {
            $tag.find('li').css({
                background: '#fff',
                color: '#aaa'
            });
            $(this).css({
                background: '#219ba1',
                color: '#fff'
            });
            index = $tag.index(event.target)
            $tag.find('input[type="text"]').val($(this).text());
        });

        $tag.find('input[type="text"]').blur(function(){
            $(".tag-ide").hide();
            value = $(this).val();
            if(value == ""){return;}
            if(addTag($tag , value)!=false){
                $(this).val("");
            }
        });
        $tag.find('input[type="text"]').keyup(function(e) {
            value = $(this).val();
            $ideList = $(".tag-ide ul li");
            if(e.keyCode == 13){
                if(addTag($tag , value) != false) {
                    $tag.find('input[type="text"]').val("");
               }
               return false;
            }
            if(e.keyCode == 40){
                if(index >= $ideList.length){index = $ideList.length;return false};
                index ++;
                $ideList.eq(temp_index - 1).css({"background" : "#fff", "color":"#aaa"})
                $ideList.eq(index - 1).css({"background" : "#219ba1" , "color" : "#fff"})
                $tag.find('input[type="text"]').val($ideList.eq(index - 1).text());
                temp_index = index;
               return false;
            }
            if(e.keyCode == 38){
                index --;
                if(index <= 0){index = 0;return false};
                $ideList.eq(temp_index - 1).css({"background" : "#fff", "color":"#aaa"})
                $ideList.eq(index - 1).css({"background" : "#219ba1" , "color" : "#fff"})
                $tag.find('input[type="text"]').val($ideList.eq(index - 1).text());
                temp_index = index;
               return false;
            }


            if(timeOut == false) return false;
            timeOut = false;
            value = $(this).val();

            $.ajax({
                url: 'api/user_api/get_key',
                dataType: 'json',
                type: 'post',
                data: {key: value},
                success:function(msg){
                    $(".tag-ide").show();
                    data = JSON.parse(msg.data);
                    $list = $(".tag-ide ul");
                    $list.html("");
                    for(var index = 0;index < data.length;index++){
                        $list.append('<li>' + data[index].name + '</li>')
                    }
                }
            });
            setTimeout(function(){timeOut = true},200);
            if(value !=""){
                index = 0;
                $(".tag-ide").show();
            }else{
                $(".tag-ide").hide();
                index = 0;
                return false;
            }
        });

        $tag.on('click', '.close', function(event) {
            delete tagList[$(this).prev().text().toLowerCase()];
            tagIndex = tagIndex - 1;
            if(tagIndex < 0) {
                tagIndex = 0;
            }
            $(this).parent().remove();
        });

        function addTag($tag , tagName) {
            if (tagIndex >=  5) {
                tagIndex = 5;
                showAlert(false, "您最多只能添加五个标签");
                return false;
            }
            if (tagList[tagName.toLowerCase()]) {
                showAlert(false, "不能添加相同的标签");
                return false;
            }

            tagList[tagName.toLowerCase()] = true;
            tagIndex++;
            $(".tag-ide").hide();
            if(tagName.length < 1){showAlert(false,"您输入的标签太短了");return false;}
            if(tagName.length > 20){showAlert(false,"您输入的标签太长了");return false;}
            $tag.find(".tag-list").append('<span class="tag-box"><font>'+tagName+'</font> <button class="close"><i class="fa fa-close"></i></button></span>');
            return true;
        }

        $tag.bind('add', function () {
            addTag($tag, arguments[1]);
        });
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

function ueSetColor(color,content) {
    var dom ="<!DOCTYPE html><html xmlns=\'http://www.w3.org/1999/xhtml\' class=\'view\' ><head><style type=\'text/css\'>.view{padding:0;word-wrap:break-word;cursor:text;height:90%;}body{background:url(./static/image/index.jpg);color:" + color + ";margin:8px;font-family:sans-serif;font-size:16px;}p{margin:5px 0;}body{font-family: '微软雅黑';font-size:14px;}*{max-width: 900px;}</style></head><body class=\'view\' >" + content + "</body><script type=\'text/javascript\'  id=\'_initialScript\'>setTimeout(function(){editor = window.parent.UE.instants[\'ueditorInstant0\'];editor._setup(document);},0);var _tmpScript = document.getElementById(\'_initialScript\');_tmpScript.parentNode.removeChild(_tmpScript);<\/script></html>";
    dom = 'javascript:void(function(){document.open();document.write("' + dom + '");document.close();}())'
    $("#ueditor_0").attr("src",dom);
}

function disable(color,content) {
    var dom ="<!DOCTYPE html><html xmlns=\'http://www.w3.org/1999/xhtml\' class='view\' ><head><style type=\'text/css\'>.view{padding:0;word-wrap:break-word;cursor:text;height:90%;}body{background:url(./static/image/index.jpg);color:" + color + ";margin:8px;font-family:sans-serif;font-size:16px;}p{margin:5px 0;}body{font-family: '微软雅黑';font-size:14px;}*{max-width: 900px;}</style></head><body class=\'view\' >" + content + "</body><script type=\'text/javascript\'  id=\'_initialScript\'>setTimeout(function(){editor = window.parent.UE.instants[\'ueditorInstant0\'];editor._setup(document);},0);var _tmpScript = document.getElementById(\'_initialScript\');_tmpScript.parentNode.removeChild(_tmpScript);<\/script></html>";
    dom = 'javascript:void(function(){document.open();document.write("' + dom + '");document.close();}())'
    $("#ueditor_0").attr("src",dom);
}

$(function () {
    var h = $(document).height();

    if (h >= 2500) {
        $('.js-back-to-top').show();
    }
});

function gotoTop() {
    $('html, body').animate({ scrollTop: 0 }, 'fast');
}


// ga
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-45771923-3', 'auto');
ga('send', 'pageview');
