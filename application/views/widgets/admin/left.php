<div class="left-nav">
	<div class="user-data">
		<img src="static/image/user_pic.jpg" />
		<div class="user-nick">
			<h2>administrator</h2>
			<a href="javascript:void(0)"><i class="icon-edit"></i></a>
		</div>
	</div>
	<ul>
		<?php
			$navList = array(
				array(
					"title" => "后台首页 / home",
					"link" => "./home",
					"icon" => "icon-home",
					"active" => false
				),
				array(
					"title" => "首页轮播设置",
					"link" => "./slider",
					"icon" => "icon-building",
					"active" => false
				),
				array(
					"title" => "在线课堂设置",
					"link" => "./onlineClass",
					"icon" => "icon-shopping-cart",
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
