<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>天地君道后台登陆系统</title>
 <link rel="stylesheet" href="./static/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="./static/css/admin/reset.css"/>
    <link rel="stylesheet" href="./static/css/admin/land_main.css"/>
</head>

<body>

	<div class="box">
        <img src="./static/image/admin/logo-hd.png" class="logo fl" alt="天地君道" width="220" height="162"/>
                <form action="admin" method="post">
                    <input type="text"  placeholder="登录名" name="username"/>
                    <input type="password"  placeholder="密码" name="password"/>

                    <ul class="msg">
                       <li class="tishi"><i class="icon-exclamation-sign" target="_blank"></i>请输入登陆密码</li>
                        <li class="tishi">  <i class="icon-exclamation-sign" target="_blank"></i>请输入登陆名</li>
                        <li class="tishi"><i class="icon-exclamation-sign" target="_blank"></i>登录名或密码错误</li>
                        <li><input type="submit" class="landing" value="登录" /></li>

                    </ul>
                </form>
    </div>
</body>
</html>