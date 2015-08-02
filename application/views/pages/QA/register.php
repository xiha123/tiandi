<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/qaDialogBox.css" />

</head>
<div class="box">
    <div class="header">
        <p>注 册</p>
        <a href="#"><i class="fa fa-times-circle-o"></i></a>
    </div>
        <form action="#" method="get">
            <input type="text"  placeholder="昵 称"/>
            <input type="text"  placeholder="邮 箱"/>
            <input type="password" placeholder="密 码"/>
            <input type="password" placeholder="确认密码"/>
            <label>
                <input type="checkbox" name="agree" class="agree"/>同意并接受《服务条款》
            </label>
            <div class="registerbutton">
                <button type="submit" value="registerbutton">
                    注册
                    <i class="fa fa-arrow-circle-right"></i>
                </button>

            </div>
            <ul class="sociality">
                <li class="fl">社交账号</li>
                <li><i class="fa fa-qq fl"></i></i></li>
                <li><i class="fa fa-weibo fl"></i></li>
                <li><a href="#" class="fr">点击登录</a></li>
            </ul>
        </form>
</div>