<div class="seconds-nav header">
	<div class="wrapper">
        	<a href="./"><img class="logo" src="static/image/tiandijundaoLogo.png" height="29" width="120" style="left: -170px;top:0px;background: none;border-radius: 0;padding: 3px; " alt="天地培训logo"></a>
		<div class="seacher">
			<input type="text" class="fl" placeholder="搜索">
			<button><i class="fa fa-search"></i></button>
		</div>
		<ul class="fl">

		<?php
			$navList = array(
			    array(
			        'name' => '<img src="./static/image/miaodatr.png" alt="秒答"; width="118" height="27" class="miaodatr" />',
			        'link' => 'miaoda',
			        'active' => false
			    ),

				array(
					'name' => '大神',
					'link' => 'god',
					'active' => false
				),

				array(
					'name' => '学习印记',
					'link' => '#',
					'active' => false
				),

			    array(
			        'name' => '在线课堂',
			        'link' => 'olclass',
			        'active' => false
			    ),

			    array(
			        'name' => '精英汇',
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
 						<li><a href="./home?uid=<?=$id?>&home=index" target="_blank">个人中心</a></li>
		                        <?php
		                            echo  $type == 1 ? '<li><a href="./home?uid='.$id.'" target="_blank">大神主页</a></li>' : "";
		                        ?>
						<li><a href="./notice" target="_blank">通知<?= $news_nuw <= 0 ? "" : " ($news_nuw)" ?></a></li>
						<li><a href="./userset">设置</a></li>
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
