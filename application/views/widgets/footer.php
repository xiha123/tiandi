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

<?php
switch($this->agent->browser()) {
    case 'Opera':
    case 'Chrome':
    case 'Firefox':
    case 'Safari':
        echo '<script src="static/lib/jquery/jquery-2.1.4.min.js"></script>';
        break;
    default:
        echo '<script src="static/lib/jquery/jquery-1.11.3.min.js"></script>';
        break;
}
?>
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
<script src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101242237" data-redirecturi="http://www.tiandipeixun.com/qq_cb" charset="utf-8"></script>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=3729754985" type="text/javascript" charset="utf-8"></script>
<script>
// 微博登录
WB2.anyWhere(function (W) {
    W.widget.connectButton({
        id: "wb_connect_btn",
        type: '3,2',
        callback: {
            login: function (res) {
                var avatar = res.avatar_large,
                    nickname = res.name;

                _td.api.checkOauth({
                    key: avatar
                }).then(function () {
                    location.reload();
                }, function () {
                    $('#reg').find('h2').text('通过新浪微博账号注册');
                    $('#reg_nick').val(nickname);
                    $('#reg_avatar').val(avatar);
                    $('.bomb-reg').trigger('click');
                });
            }
        }
    });
});
// QQ登录
QC.Login({
    btnId:"qq-login-btn"    //插入按钮的节点id
}, function (reqData, opts) {
    var avatar = reqData.figureurl_qq_2,
        nickname = QC.String.escHTML(reqData.nickname);

    _td.api.checkOauth({
        key: avatar
    }).then(function () {
        location.reload();
    }, function () {
        $('#reg').find('h2').text('通过 QQ 账号注册');
        $('#reg_nick').val(nickname);
        $('#reg_avatar').val(avatar);
        $('.bomb-reg').trigger('click');
    });
    /*
    //根据返回数据，更换按钮显示状态方法
    var dom = document.getElementById(opts['btnId']),
    _logoutTemplate=[
        //头像
        '<span><img src="{figureurl}" class="{size_key}"/></span>',
        //昵称
        '<span>{nickname}</span>',
        //退出
        '<span><a href="javascript:QC.Login.signOut();">退出</a></span>'
    ].join("");
    dom && (dom.innerHTML = QC.String.format(_logoutTemplate, {
        nickname : QC.String.escHTML(reqData.nickname), //做xss过滤
        figureurl : reqData.figureurl
    }));
    */
});
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