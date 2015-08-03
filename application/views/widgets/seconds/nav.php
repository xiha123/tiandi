<div class="seconds-nav">
	<div class="wrapper">
		<div class="seacher">
			<input type="text" class="fl" placeholder="在此搜索你的问题">
			<button><i class="fa fa-search"></i></button>
		</div>
		<ul class="fr">

		<?php
			$navList = array(
			    array(
			        'name' => '秒答解惑',
			        'link' => './seconds',
			        'active' => false
			    ),
			    array(
			        'name' => '在线课堂',
			        'link' => './olclass',
			        'active' => false
			    ),
			    array(
			        'name' => '大神来了',
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
					<img src="<?=$avatar?>" height="25" width="25" alt="avatar"><?=$nickname	?>
					<ul class="user-menu seconds">
						<li><a href="./home" target="_blank">个人主页</a></li>
						<li><a href="./seconds/godhome" target="_blank">大神主页</a></li>
						<li><a href="./notice" target="_blank">通知</a></li>
						<li><a href="">设置</a></li>
						<li><a href="">充值</a></li>
						<li><a href="javascript:" id="ajax_outlogin">退出</a></li>
					</ul>
			<?php
				}else{
					echo '
						<div class="notLogin">
							<a href="javascript:" class="bomb-login"><i class="fa fa-user"></i>登录</a>
							<a href="javascript:" class="bomb-reg">注册</a>
						</div>';
				}

			?>

			<!--  -->
		</div>
	</div>

</div>