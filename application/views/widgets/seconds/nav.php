<div class="seconds-nav">
	<div class="wrapper">
		<div class="seacher">
			<input type="text" class="fl" placeholder="在此搜索你的问题">
			<button><i class="icon-search"></i></button>
		</div>
		<ul class="fr">

		<?php
			$navList = array(
			    array(
			        'name' => '秒答',
			        'link' => './seconds',
			        'active' => false
			    ),
			    array(
			        'name' => '在线课堂',
			        'link' => './olclass',
			        'active' => false
			    ),
			    array(
			        'name' => '大神',
			        'link' => '#',
			        'active' => false
			    ),
			    array(
			        'name' => '帮助',
			        'link' => '#',
			        'active' => false
			    ),
			);

			if (isset($activeNav)) $navList[$activeNav]['active'] = true;
			for ($i = 0; $i < count($navList); $i++) {
			    $cls = $navList[$i]['active'] === true ? ' class="active"' : '';
			    echo '<li><a href="', $navList[$i]['link'], '"', $cls, '>', $navList[$i]['name'], '</a></li>';
			}
		?>

		</ul>
		<div class="user">
			<img src="./static/image/test.jpg" height="25" width="25" alt="avatar">用户昵称
			<ul class="user-menu seconds">
				<li><a href="">个人主页</a></li>
				<li><a href="">大神主页</a></li>
				<li><a href="">通知</a></li>
				<li><a href="">设置</a></li>
				<li><a href="">充值</a></li>
				<li><a href="">退出</a></li>
			</ul>
		</div>
	</div>

</div>