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

			<?php
				if(isset($name)){
			?>
					<img src="<?=$salt?>" height="25" width="25" alt="avatar"><?=$name?>
					<ul class="user-menu seconds">
						<li><a href="">个人主页</a></li>
						<li><a href="">大神主页</a></li>
						<li><a href="">通知</a></li>
						<li><a href="">设置</a></li>
						<li><a href="">充值</a></li>
						<li><a href="">退出</a></li>
					</ul>
			<?php
				}else{
					echo '<div class="notLogin"><a href="javascript:"><i class="icon-user"></i>登录</a><a href="javascript:">注册</a></div>';
				}

			?>

			<!--  -->
		</div>
	</div>

</div>