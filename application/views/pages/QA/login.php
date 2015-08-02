<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/qaDialogBox.css" />

</head>

<div class="box">
    <div class="header">
        <p>登 录</p>
        <a href="#"><i class="fa fa-times-circle-o"></i></a>
    </div>
        <form action="#" method="get">
            <input type="text"  placeholder="邮 箱"/>
            <input type="password" placeholder="密 码"/>
            <div class="passWord">
                <label>
                    <input type="checkbox" name="remberPassword"/> 记住密码
                </label>
                <a href="#" class="fr">忘记密码</a>
            </div>
            <div class="loginbutton">
                <button type="submit" value="loginbutton">
                  登 录  <i class="fa fa-arrow-circle-right"></i>
                </button>
            </div>

            <ul class="sociality">
                <li class="fl">社交账号</li>
                <li><i class="fa fa-qq fl"></i></i></li>
                <li><i class="fa fa-weibo fl"></i></li>
                <li><a href="#" class="fr">注册账号</a></li>
            </ul>
        </form>
</div>