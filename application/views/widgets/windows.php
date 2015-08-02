<!-- 登录窗口通用弹窗  -->
<div class="window">
	<div class="login" id="login">
		<div class="login-title">
			<h2>登录</h2>
			<a href="javascript:" class="close">X</a>
		</div>
		<div class="login-content">
			<ul>
				<li><input type="text" id="login_username" placeholder="请输入您的邮箱"></li>
				<li><input type="password" id="login_password" placeholder="请输入您的登陆密码"></li>
				<li class="login-click"> <label><input type="checkBox"><span>记住密码</span></label>  <a href="" class="fr">忘记密码</a> </li>
				<li><input type="button" value="登录" id="ajax_login"></li>
				<li class="sociality">
					社交账号
					<img src="static/image/qq.png" alt="" width="20">
					<img src="static/image/weibo.png" alt=""width="25">
					<a href="javascript:" class="bomb-reg" >注册账号</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="login" id="reg">
		<div class="login-title">
			<h2>注册</h2>
			<a href="javascript:" class="close">X</a>
		</div>
		<div class="login-content">
			<ul>
				<li><input type="text" placeholder="昵称" id="reg_nick"></li>
				<li><input type="text" placeholder="邮箱" id="reg_email"></li>
				<li><input type="password" placeholder="密码" id="reg_password_r"></li>
				<li><input type="password" placeholder="确认密码" id="reg_password"></li>
				<li class="login-click"> <label><input type="checkBox"><span>同意并接受服务条款</span></label></li>
				<li><input type="button" value="注册" id="ajax_reg"></li>
				<li class="sociality">
					社交账号
					<img src="static/image/qq.png" alt="" width="20">
					<img src="static/image/weibo.png" alt=""width="25">
					<a href="javascript:" class="bomb-login">点击登录</a>
				</li>
			</ul>
		</div>
	</div>



</div>

<div class="showAlert">
	<p class="aletrContent">

	</p>
</div>
