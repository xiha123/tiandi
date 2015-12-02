<div class="js-back-to-top back-to-top" onclick="javascript:gotoTop()">
    <i class="fa fa-chevron-up"></i>
</div>

<div class="left-ad" style="display: none;">
    <a href="javascript:$('.left-ad').hide();"><i class="fa fa-close"></i></a>
    <a href="http://ke.qq.com/course/95792" target=“_blank”><img src="/static/image/miaoda_left2.jpg" alt="apply god" width="170" height="320"></a>
</div>

<div class="js-popup popup-wrapper hidden">
    <div class="popup">
        <a href="javascript:;" onclick="javascript:$('.bomb-login').trigger('click');return false;" class="js-close-popup"><img src="static/image/popup1.jpg"></a>
        <a class="js-close-popup" href="godintro"><img src="static/image/popup2.jpg"></a>
        <a href="javascript:;" class="popup-close js-close-popup"><i class="fa fa-close"></i></a>
    </div>
</div>

<script src="static/js/api.js"></script>
<script>
    window._td = {};
    _td.api = require('api');
    _td.info = {
        id: <?= isset($id) ? $id : -1 ?>
    };
</script>
<script src="static/js/global.js"></script>



<?php if (!isset($id)) { ?>
<script>
// 微博登录
WB2.anyWhere(function (W) {
    W.widget.connectButton({
        id: "wb_connect_btn-hidden",
        type: '3,2',
        callback: {
            login: function (res) {
                console.log(res);
                var avatar = res.avatar_large,
                    nickname = res.name;

                $.post('/api/user_api/check_oauth',{
                    key: avatar,
                    source:'sina',
                    source_id:avatar,
                    avatar:avatar,
                    nickname:nickname
                },function(resp){
                    obj = eval('('+resp+')');
                    if (obj.status) {
                        if (obj.data.first == 'yes') {
                            var checked = false;
                            href = window.location.href.split('#')[0];
                            href = href.replace('&editprofile=1','');
                            if(checked){
                                href.href="/god/apply";
                            }else{
                                if ( href.indexOf('?') >= 0 ) {
                                    href = href + '&editprofile=1'
                                }else{
                                    href = href + '?editprofile=1';
                                }
                                location.replace(href);
                            }
                        }else{
                            location.reload();
                        }
                    }
                }).error(function() { alert("网络异常!"); });
            }
        }
    });
});
// QQ登录

QC.Login({
    btnId:"qq-login-btn-hidden"    //插入按钮的节点id
}, function (reqData, opts) {
    var avatar = reqData.figureurl_qq_1,
        nickname = QC.String.escHTML(reqData.nickname);
    console.log(reqData);

    $.post('/api/user_api/check_oauth',{
        key: avatar,
        source:'qq',
        source_id:avatar,
        avatar:avatar,
        nickname:nickname
    },function(resp){
        obj = eval('('+resp+')');
        if (obj.status) {
            if (obj.data.first == 'yes') {
                    var checked = false;
                    href = window.location.href.split('#')[0];
                    href = href.replace('&editprofile=1','');
                    if(checked){
                        href.href="/god/apply";
                    }else{
                        if ( href.indexOf('?') >= 0 ) {
                            href = href + '&editprofile=1'
                        }else{
                            href = href + '?editprofile=1';
                        }
                        location.replace(href);
                    }
            }else{
                location.reload();
            }
        }
    }).error(function() { alert("网络异常!"); });

});

function openwindow(url,name,iWidth,iHeight)
{
    var url;                                 //转向网页的地址;
    var name;                           //网页名称，可为空;
    var iWidth;                          //弹出窗口的宽度;
    var iHeight;                        //弹出窗口的高度;
    var iTop = (window.screen.availHeight-30-iHeight)/2;       //获得窗口的垂直位置;
    var iLeft = (window.screen.availWidth-10-iWidth)/2;           //获得窗口的水平位置;
    window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
}
$(function(){
    $('.wx-login-btn').on('click',function(){
        openwindow('/weixin/login','weixinlogin',600,600);
    })
    $('.qq-login-btn').on('click',function(){
        var url = 'https://graph.qq.com/oauth2.0/authorize?client_id=101242237&response_type=token&scope=all&redirect_uri=http%3A%2F%2Fwww.91miaoda.com%2Fqq_cb';
        openwindow(url,'qqlogin',600,600);

    })
    $('.wb_connect_btn').on('click',function(){
        $('.WB_loginButton').click();
    })

})

</script>
<?php } ?>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-45771923-3', 'auto');
    ga('send', 'pageview');

</script>