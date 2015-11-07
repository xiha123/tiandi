<div class="left-nav">
	<div class="profile">
		<img src="./static/image/admin_logo.png" />
		<h2><?= $me['nickname'] ?></h2>
	</div>
	<ul>
		<?php
			$navList = array(
				array(
					"title" => "后台首页",
					"link" => "admin",
					"icon" => "fa fa-home",
					"active" => false,
					"name" => "index"
				),
				array(
					"title" => "首页轮播管理",
					"link" => "admin/slider",
					"icon" => "fa fa-th-large",
					"active" => false,
					"name" => "slider"
				),
				array(
					"title" => "在线课堂设置",
					"link" => "admin/onlineGoTo",
					"icon" => "fa fa-shopping-cart",
					"active" => false,
					"name" => "online"
				),
				array(
					"title" => "课程管理",
					"link" => "admin/classList",
					"icon" => " fa fa-list-ol",
					"active" => false,
					"name" => "course"
				),
				array(
					"title" => "问题管理",
					"link" => "admin/problems",
					"icon" => " fa fa-comments",
					"active" => false,
					"name" => "problem"
				),
				array(
					"title" => "标签管理",
					"link" => "admin/tags",
					"icon" => " fa fa-tags",
					"active" => false,
					"name" => "tag"
				),
				array(
					"title" => "用户管理",
					"link" => "admin/user",
					"icon" => "fa fa-users",
					"active" => false,
					"name" => "user"
				),
				array(
					"title" => "管理员设置",
					"link" => "admin/users",
					"icon" => "fa fa-user",
					"active" => false,
					"name" => "admin_user"
				),
				array(
					"title" => "视频管理",
					"link" => "admin/videoAdministrator",
					"icon" => "fa fa-film",
					"active" => false,
					"name" => "video"
				),
				array(
					"title" => "评论管理",
					"link" => "admin/comment",
					"icon" => "fa fa-comment",
					"active" => false,
					"name" => "comment"
				),
				array(
					"title" => "邀请监控",
					"link" => "admin/stats",
					"icon" => "fa fa-bar-chart",
					"active" => false,
					"name" => "stats"
				),
			);
			if($me['type'] == 1){
				$json_limit =  json_decode($me['limit']);
				$json_limit_temp = array();
				foreach ($json_limit as $key => $value) {
					$json_limit_temp[$value] = true;
				}
			}else{
				$json_limit_temp = array();
			}

			if (isset($activeNav)) $navList[$activeNav]['active'] = true;
			for($index = 0;$index < count($navList);$index ++){
				$active = $navList[$index]["active"] == true ? ' class="hover"' : "";
				if($index == 7){
					if($me['type'] == 0){
						echo '<li' . $active . '><a href="' . $navList[$index]["link"] . '"><div class="content"><i class="' . $navList[$index]["icon"] . '"></i><font>' . $navList[$index]["title"] . '</font></div></a></li>';
					}
				}else{
					if(!isset($json_limit_temp[$navList[$index]['name']])){
						echo '<li' . $active . '><a href="' . $navList[$index]["link"] . '"><div class="content"><i class="' . $navList[$index]["icon"] . '"></i><font>' . $navList[$index]["title"] . '</font></div></a></li>';
					}
				}

			}
		?>
	</ul>
	<img src="static/image/admin_logo.png"  class="logo"/>
</div>
