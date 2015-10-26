<?php $this->load->view('widgets/header.php'); ?>

<link rel="stylesheet" href="static/css/global.css">

<style>
    html{
        background:url() #ffffff;
    }
</style>
</head>

<body class="index">
<?php $this->load->view('widgets/miaoda/nav.php' , []); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
<link rel="stylesheet" href="static/css/week.css" />

<div class="ban-box" style="margin-top: -30px;">
    <div class="baninfo">
        <P class="djs"><span class="txt1 days"></span><span class="txt2"><span class="m-r50">天</span></span><span class="txt1 hours"></span><span class="txt2 m-r50">小时</span><span class="txt1 minutes"></span><span class="txt2 m-r50">分钟</span><span class="txt1 seconds"></span><span class="txt2">秒</span></P>
        <P class="detail">秒答上线第一周</P>
        <P  class="detail">银币&课程视频疯狂大派送</P>
        <P class="poa l"><img src="/static/image/week/icon4.png" width="242" height="59" /></P>
    </div>
</div>
<div class="w1200 content">
    <p class="tit1"><img src="/static/image/week/t1.png" width="360" height="74" /></p>
    <P class="des1">错过这一回 自学捷径不再有</P>
    <div class="c" style="margin-bottom:100px;">
        <div class="l1">
            <div class="detail-box" style="border-bottom:2px dashed #445e5d; padding-bottom:30px;">
                <P class="des m-b40">免费领取编程大神一对一指导机会。<br/>
                    就在这一周，有什么编程疑问都放马过来吧！</P>
                <P class=" m-b40"><a href="javascript:;" id="silver_btn" class="btn1 <?php if($silver_get != 1) print 'on'; ?>">限时领取银币</a></P>
            </div>
            <div class="detail-box" style="padding-top:50px;">
                <P class="des m-b40">一键领取我们海量公开课视频，这里有你想不到的有趣课程。<br/>
                    课程视频虽好，可不要贪杯喔。</P>
                <P><a href="javascript:;" id="video_btn" class="btn1 on">领取公开课视频</a></P>
                <P class="other">每位用户每天限领一次</P>
            </div>
        </div>
        <div class="r1">
            <P class="des">他们抢先一步啦！</P>

            <div class="md-box">
                <ul class="md-list">
                    <?php
                    foreach($price_list as $price){
                        if($price['type'] == '1'){
                            echo "<li><span>{$price['name']}</span> 获得了 <span>{$price['price']}</span>银币</li>";
                        }else{
                            echo "<li><span>{$price['name']}</span> 获得了 <span>{$price['price']}</span></li>";
                        }

                    }?>



                </ul>
            </div>

        </div>
    </div>

    <div class="c" style="margin-bottom:100px;">
        <p class="tit1"><img src="/static/image/week/t1.png" width="360" height="74" /></p>
        <P class="des2">邀请10名好友注册<br/>即刻赢取价值2000元程序员入门基础课</P>
        <ul class="c yq-box">
            <li class="first">您的邀请链接</li>
            <li><input type="text" value="<?php echo $invate_url;?>" /></li>
            <li><a href="javascript:;"  id="copybotton" data-clipboard-text="<?php echo $invate_url;?>" class="btn2 copybotton">一键复制</a></li>
        </ul>
        <div class="link-box">
            <ul>
                <li><a class="link-txt link-txt1" href="<?= $qqshare;?>">QQ群/好友(强烈推荐)</a></li>
                <li><a class="link-txt link-txt2"  href="<?= $qqzshare;?>">QQ空间(推荐)</a></li>
                <li><a class="link-txt link-txt3"  href="<?= $sinashare;?>">发布微博</a></li>
            </ul>
        </div>

    </div>

</div>

<div class="rw-div">
    <div class="rw-box">
        <div class="rw-tit c">
            <P class="txt1">任务进度</P><P class="txt2">（<span id="finish_count">0</span>/10）</P>
        </div>
        <div class="c">
            <div class="rw-head">
                <ul>

                </ul>
            </div>
            <div class="rw-rig">
                <a  id="open-btn" class="btn3">领取奖励</a>
            </div>
            <!--open start-->
            <div class="open-box" style="display:none;">
                <div class="open-tit"><a class="close-icon"></a>提示</div>
                <div class="open-con">
                    <div class="open_detail" style="margin: 0;margin-top: -20px;">
                        <P>真棒！</P>

                        <P>你抢到XXX个银币</P>
                    </div>
                    <P style="margin-top:60px;"><a  class="confirm-btn">确定</a></P>
                </div>
            </div>

            <!--open end-->

        </div>
    </div>
</div>
<script src="static/js/api.js"></script>
<script>
    window._td = {};
    _td.api = require('api');
    _td.info = {
        id: -1
    };
</script>
<script src="/static/lib/jquery-1.11.1.js" type="text/javascript"></script>
<script src="/static/lib/ZeroClipboard/ZeroClipboard.min.js"></script>
<script type="text/javascript" src="/static/lib/jquery.downCount.js"></script>
<script type="text/javascript" src="/static/lib/kxbdSuperMarquee.js"></script>

<script src="static/js/global.js"></script>

<script type="text/javascript">
    $(function(){
        function inviteTask(tim){
            $.getJSON('/godHelp/get_invite',function(data){
                if (data) {
                    window.data = data;
                    console.log(data['list'].length);
                    $('.rw-head ul').html('');
                    $('#finish_count').html(data['list'].length);
                    for (i=0;i<10;i++) {
                        if (data['list'][i]) {
                            $('.rw-head ul').append('<li><a href="'+data['list'][i]['id']+'"><img src="'+data['list'][i]['avatar']+'" /></a></li> ');
                        }else{
                            $('.rw-head ul').append('<li><a href="#"></a></li>');
                        }
                    }
                    if (data['list'].length == 10) {
                        $('.rw-rig #open-btn').addClass('btn3_ok');
                        clearInterval(tim);
                    }
                }
            });
        }
        inviteTask(0);
        var tim = setInterval(function(){
            inviteTask(tim);
        },5000)
        $('#open-btn').on('click',function(){
            if ($('#open-btn').hasClass('btn3_ok')) {
                $(".open_detail").html(
                    '<p>太好了</p>'+
                    '<p>你获得<span style="color:red">程序员入门基础基础</span>资格</p>'+
                    '<p>请联系秒小答领取吧!</p>'

                );
                $(".open-box").show();
                $('.confirm-btn').attr('href', 'http://wpa.qq.com/msgrd?v=3&uin=2194846949&site=qq&menu=yes');
                $('.confirm-btn').attr('target', '_blank');
                $(document.body).css("overflow-y","hidden");

            }
        });
        $('#video_btn').on('click',function(){
            var vbtn = this;
            if ($(this).hasClass('on')) {
                $.getJSON('/godHelp/get_video',function(data){
                    if (data.result) {
                        $(".open_detail").html(
                            '<p>厉害</p>'+
                            '<p>你抽到了<span style="color:red">'+data.video.name+'</span>视频</p>'+
                            '<p>你可以点击直接下载!</p>'

                        );
                        $('.open-box').css('height','440px');
                        $(".open-box").show();
                        $('.confirm-btn').text('下载');
                        $('.confirm-btn').attr('href', data.video.url);
                        $('.confirm-btn').attr('target', '_blank');
                        $(document.body).css("overflow-y","hidden");
                    }else{
                        if(data.error == 'did'){
                            $(".open_detail").html(
                                '<p>视频今天已领取!</p>'
                            );
                            $('.open-box').css('height','350px');
                            $(".open-box").show();
                            $(document.body).css("overflow-y","hidden");
                        }else{
                            $("#reg").hide();
                            bomb("login");
                        }

                    }
                });


            }
        })

        $(".close-icon,.confirm-btn").click(function(){
            $(".open-box").hide();
            $(document.body).css("overflow-y","");
        })
        $("#silver_btn").click(function(){
            $.getJSON('/godHelp/get_silver',function(data){
                if (data.result) {
                    $(".open_detail").html(
                        '<P>真棒！</P>'+
                        ' <P>你抢到'+data.number+'个银币</P>'
                    );
                    $('#silver_btn').removeClass('on');

                    $(".open-box").show();
                    $(document.body).css("overflow-y","hidden");

                }else{
                    if(data.error == 'nologin'){
                        $("#reg").hide();
                        bomb("login");
                    }
                }
            })
        })
        //滚动速度
        $('.md-box').kxbdSuperMarquee({
            isMarquee:true,
            isEqual:false,
            scrollDelay:20,
            direction:'up'
        });

        ZeroClipboard.setDefaults({
            moviePath: '/static/lib/ZeroClipboard/ZeroClipboard.swf'
        });
        var client = new ZeroClipboard(document.getElementById("copybotton"));


        client.on( 'mouseup', function(client) {
            var copyText = $('#share_text').val();
            client.setText(copyText);
            alert("拷贝成功!");
        } );


    })

    $('.djs').downCount({
        date: '12/24/2015 15:00:00', //初始化日期
        offset: +8  //时区
    }, function () {
        alert('倒计时结束!');
    });
</script>


</body>
</html>
