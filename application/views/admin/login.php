<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="./static/css/admin/login.css">
</head>

<body>
    <div class="box">
        <img src="./static/image/admin/logo-hd.png" class="logo" alt="天地君道" width="220" height="162"/>
        <form action="admin" method="post">
            <input type="text"  placeholder="登录名" name="username"/>
            <input type="password"  placeholder="密码" name="password"/>
            <ul class="msg">
                <li class="tishi"><i class="icon-exclamation-sign" target="_blank"></i>请输入登录密码</li>
                <li class="tishi">  <i class="icon-exclamation-sign" target="_blank"></i>请输入登录名</li>
                <li class="tishi"><i class="icon-exclamation-sign" target="_blank"></i>登录名或密码错误</li>
            </ul>
            <input type="submit" class="login-btn" value="登录" />
        </form>
    </div>
</body>
</html>
