<?php
	if(!isset($nickname)){
?>
<!-- 登录窗口通用弹窗  -->
<div class="window">
	<div class="login" id="login">
		<div class="login-title">
			<h2>登录</h2>
			<a href="javascript:;" class="close"><i class="fa fa fa-times-circle-o"></i></a>
		</div>
		<div class="login-content">
			<form action="#" method="get" id="login-form">
				<ul>
					<li><input type="text" id="login_username" placeholder="请输入您的邮箱"></li>
					<li><input type="password" id="login_password" placeholder="请输入您的登陆密码"></li>
					<li class="login-click"> <label><input type="checkBox"><span>记住密码</span></label>  <a href="javascript:;" class="fr forget" onclick="document.getElementById('image_id').src='./Verification'">忘记密码</a> </li>
					<li><input type="submit" value="登录" id="ajax_login"></li>
					<li class="sociality">
						社交账号
						<img src="static/image/QQcolor.png" alt="" width="20">
						<img src="static/image/weibocolor.png" alt=""width="25">
						<a href="javascript:;" class="bomb-reg">注册账号</a>
					</li>
				</ul>
			</form>
		</div>
	</div>

	<div class="login" id="forget">
		<div class="login-title">
			<h2>找回密码</h2>
			<a href="javascript:;" class="close"><i class="fa fa fa-times-circle-o"></i></a>
		</div>
		<div class="login-content">
			<ul>
				<li><input type="text" id="userEmail" placeholder="请输入您的邮箱"></li>
				<li><input type="text" id="verification" placeholder="请输入验证码"></li>
				<li class="login-click"><img src="" onclick="document.getElementById('image_id').src='./Verification'" id="image_id" alt="" width="120" height="40"></li>
				<li><input type="button" value="找回密码" id="ajax_forget"></li>
			</ul>
		</div>
	</div>

	<div class="login" id="reg">
		<div class="login-title">
			<h2>注册</h2>
			<a href="javascript:;" class="close"><i class="fa fa fa-times-circle-o"></i></a>
		</div>
		<div class="login-content">
			<form action="" id="register">
				<ul>
					<li><input type="text" placeholder="昵称" id="reg_nick"></li>
					<li><input type="text" placeholder="邮箱" id="reg_email"></li>
					<li><input type="password" placeholder="密码" id="reg_password_r"></li>
					<li><input type="password" placeholder="确认密码" id="reg_password"></li>
					<li class="login-click"> <label><input type="checkBox" id="reg_ok"><span>同意并接受服务条款</span></label></li>
					<li><input type="submit" value="注册" id="ajax_reg"></li>
					<li class="sociality">
						社交账号
						<img src="static/image/QQcolor.png" alt="" width="20">
						<img src="static/image/weibocolor.png" alt=""width="25">
						<a href="javascript:;" class="bomb-login">直接登录</a>
					</li>
					<li class="login-click regGod"><label class="fr" style="margin-right:40px;"><input type="checkBox" id="reg_god"><span>注册成为大神</span></label></li>
				</ul>
			</form>
		</div>
	</div>
</div>

<?php
	}
?>

<div class="showAlert">
	<p class="aletrContent">

	</p>
</div>
