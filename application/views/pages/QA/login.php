<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/login.css" />

</head>

<div class="box">
    <div class="header">
        <p>登 录</p>
        <a href="#"><i class="fa fa-times-circle-o"></i></a>
    </div>
    <div class="content">
        <form action="#" method="get">
            <input type="text"  placeholder="邮 箱"/>
            <input type="password" placeholder="密 码"/>
            <div class="passWord">
                <label>
                    <input type="checkbox" name="remberPassword"/>记住密码
                </label>
                <a href="#">忘记密码</a>
            </div>
            <div class="loginbuttom">
                <input type="submit" value="登 录" />
                <i class="fa fa-arrow-circle-right"></i>
            </div>

            <ul class="sociality fl">
                <li>社交账号</li>
                <li><i class="fa fa-qq"></i></i></li>
                <li><i class="fa fa-weibo"></i></li>
                <li><a href="#">注册账号</a></li>
            </ul>
        </form>
    </div>
</div>