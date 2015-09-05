<div class="js-back-to-top back-to-top" onclick="javascript:gotoTop()">
    <i class="fa fa-chevron-up"></i>
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
</script>
<script src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101242237" data-redirecturi="http://test.tiandipeixun.com/qq_cb" charset="utf-8"></script>
<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=2108328168" type="text/javascript" charset="utf-8"></script>
<script src="static/js/global.js"></script>
<script>
WB2.anyWhere(function (W) {
    W.widget.connectButton({
        id: "wb_connect_btn",
        type: '3,2',
        callback: {
            login: function (o) { //登录后的回调函数
                console.log("wb login: " + o.screen_name)
            },
            logout: function () { //退出后的回调函数
                console.log('wb logout');
            }
        }
    });
});
QC.Login({
    btnId:"qq-login-btn"    //插入按钮的节点id
});
</script>
