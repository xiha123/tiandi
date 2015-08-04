<div class="left-nav">
	<div class="profile">
		<img src="static/image/user_pic.jpg" />
		<h2><?= $me['nickname'] ?></h2>
	</div>
	<ul>
	
		<?php
			$navList = array(
				array(
					"title" => "后台首页",
					"link" => "admin",
					"icon" => "fa fa-home",
					"active" => false
				),
				array(
					"title" => "轮播管理",
					"link" => "admin/slider",
					"icon" => "fa fa-th-large",
					"active" => false
				),
				array(
					"title" => "在线课堂设置",
					"link" => "admin/onlineSlider",
					"icon" => "fa fa-shopping-cart",
					"active" => false
				),
				array(
					"title" => "课程管理",
					"link" => "admin/classList",
					"icon" => " fa fa-list-ol",
					"active" => false
				),
				array(
					"title" => "用户管理",
					"link" => "admin/users",
					"icon" => "fa fa-user",
					"active" => false
				),
			);
			if (isset($activeNav)) $navList[$activeNav]['active'] = true;
			for($index = 0;$index < count($navList);$index ++){
				$active = $navList[$index]["active"] == true ? ' class="hover"' : "";
				echo '<li' . $active . '><a href="' . $navList[$index]["link"] . '"><div class="content"><i class="' . $navList[$index]["icon"] . '"></i><font>' . $navList[$index]["title"] . '</font></div></a></li>';
			}
		?>
	</ul>
	<img src="static/image/admin_logo.png"  class="logo"/>
</div>
