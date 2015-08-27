<div class="seconds-nav header">
	<div class="wrapper">
        	<a href="./"><img class="logo" src="static/image/miaoda_logo.gif" height="29" width="120" style="left: -140px;z-index: 999;background: none;border-radius: 0;padding: 3px; " alt="天地培训logo"></a>
		<div class="seacher">
			<input type="text" class="fl" placeholder="搜索问题">
			<button><i class="fa fa-search"></i></button>
		</div>
		<ul class="fr">

		<?php
			$navList = array(
			    array(
			        'name' => '秒答',
			        'link' => 'miaoda',
			        'active' => false
			    ),
			    array(
			        'name' => '在线课堂',
			        'link' => 'olclass',
			        'active' => false
			    ),
			    array(
			        'name' => '大神',
			        'link' => 'god',
			        'active' => false
			    ),
			    array(
			        'name' => '帮助',
			        'link' => 'help',
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
				if(isset($nickname)){
			?>
					<img src="<?=$avatar?>" height="25" width="25" alt="avatar"><?=$nickname?>
					<font class="news-number"><?=$news_nuw <= 0 ? "" : "($news_nuw)"?></font>
					<ul class="user-menu seconds">
 						<li><a href="./home?uid=<?=$id?>&page=home" target="_blank">个人中心</a></li>
		                        <?php
		                            echo  $type == 1 ? '<li><a href="./home?uid='.$id.'" target="_blank">大神主页</a></li>' : "";
		                        ?>
						<li><a href="./notice" target="_blank">通知<?= $news_nuw <= 0 ? "" : " ($news_nuw)" ?></a></li>
						<li><a href="./userSet">设置</a></li>
						<li><a href="javascript:;">充值</a></li>
						<li><a href="javascript:" id="ajax_outlogin">退出</a></li>
					</ul>
			<?php
				}else{
					echo '
						<div class="notLogin">
							<a href="javascript:;" class="bomb-login"><i class="fa fa-user"></i>登录</a>
                            <a href="javascript:;" class="bomb-reg"><i class="fa fa-user-plus"></i>注册</a>
						</div>';
				}
			?>

			<!--  -->
		</div>
	</div>

</div>
