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
					"icon" => "icon-home",
					"active" => false
				),
				array(
					"title" => "轮播设置",
					"link" => "admin/slider",
					"icon" => "icon-th-large",
					"active" => false
				),
				array(
					"title" => "在线课堂设置",
					"link" => "admin/onlineClass",
					"icon" => "icon-shopping-cart",
					"active" => false
				),
				array(
					"title" => "用户管理",
					"link" => "admin/users",
					"icon" => "icon-user",
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
