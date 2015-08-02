<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/qaDialogBox.css" />

</head>

<div class="box">
    <div class="header">
        <p>忘 记 密 码</p>
        <a href="#"><i class="fa fa-times-circle-o"></i></a>
    </div>
    <form action="#" method="get">
        <input type="text"  placeholder="注册邮箱"/>
        <input type="password" placeholder="输入下方验证码"/>
        <div class="proving">
            验证码输入框位置
        </div>
        <div class="loginbuttom">
            <button type="submit" value="loginbutton">
                提 交  <i class="fa fa-arrow-circle-right"></i>
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