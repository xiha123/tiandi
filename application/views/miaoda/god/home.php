	<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="./static/css/miaoda/godHome.css">
<body>

<div
	id="page-info"
	class="hidden"
	data-title="秒答_<?= $user['nickname'] ?>的主页"
	data-keywords="秒答,问答社区,<?= $user['nickname'] ?>"
	data-description="<?= $user['description'] ?>"
></div>

<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
	<div class="wrapper">

		<div class="leftBox">
			<img src="<?=$user["avatar"] ?>" alt="" class="pic">
			<img class="god" src="./static/image/god_right.png">
			<h3 class="name"><?=$user["nickname"] ?></h3>
            <h4 class="name" style="font-size: 12px;font-weight:600;"><?=$user['level_name']?></h4>

            <p class="look"><img src="static/image/look.png" alt="" width="18px"><?=$user['follower_count']?></p>
			<p class="money">威望： <?=$user['prestige']?></p>
			<p class="money">银币： <?=$user['silver_coin']?></p>
			<p class="money">金币： <?=$user['gold_coin']?></p>
			<p class="desc"><?php echo $user["god_description"] == "" ? "这货居然没写描述" : $user['god_description']; ?></p>
			<h2 class="box-title">擅长标签</h2>
			<?php foreach (count(json_decode($user['god_skilled_tags'])) > 0 ? json_decode($user['god_skilled_tags']) : array() as $key => $value) {
                            echo '<a href="./tag/?name='. urldecode($value).'" class="tagBox">'.$value.'</a>';
                        }?>
            <h2 class="box-title">正在开的课</h2>
			<ul class="classList">
				{course}
					<li><a href="{link}" target="_blank">
						<img src="{img}" height="100%" width="100%" alt="{title}">
					</a></li>
				{/course}
			</ul>

            <div class="help" style=" clear: both; margin-top: 30px; color: #219ba1">

                <a href="./godHelp" style="color: #219ba1;" target="_blank">帮助说明</a>
            </div >
            <div class="help" style=" clear: both; margin-top: 30px; color: #219ba1">
                <a href="./share/invite" style="color: #219ba1;" target="_blank" >邀请</a>
            </div >
            <div class="help" style=" clear: both; margin-top: 30px; color: #219ba1">

                <a href="/godHelp/gift" style="color: #219ba1;" target="_blank">奖励政策</a>
            </div >


		</div>
		<div class="rightBox">
			<h2 class="box-title">推荐您来回答</h2>
			<ul class="list-data">
				<?php foreach ($recommend_list as $key => $value) {?>
					<li data-id="<?=$value['id']?>">
						<div class="link-num ajax_up"><p class="upCount"><?=$value['up_count']?></p><p>点赞</p></div>
						<div class="list-title">
							<a href="./problem/?p=<?=$value['id']?>" target="_blank"><?=$value['title']?></a>
						</div>
						<ul class="list-tag">
							<?php
								if(!empty($value['tags'])){
									foreach ($value['tags'] as $key => $values) {
                                        if (isset($values['name'])) {
                                            echo '<li><a href="./tag/?name='.urlencode($values['name']).'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
                                        }
									}
								}
							?>
						</ul>
						<div class="list-date"> 提问于：<?=$value['ctime']?></div>
					</li>
				<?php }	?>
			</ul>


			<div class="tab" data-widget="tab" >
				<ul class="title cf" >
					<li <?=!$hot_type?'class="active"':""?>><a href="./home/?uid=<?=$user['id']?>">最新未答</a></li>
					<li <?=$hot_type?'class="active"':""?>><a href="./home/?uid=<?=$user['id']?>&ok=hot">答过</a></li>
				</ul>
				<ul class="list-data">
					<?php foreach ($news_problem as $key => $value) {?>
						<li data-id="<?=$value['id']?>">
							<div class="link-num ajax_up"><p class="upCount"><?=$value['up_count']?></p><p>点赞</p></div>
							<div class="list-title">
								<a href="./problem/?p=<?=$value['id']?>" target="_blank"><?=$value['title']?></a>
							</div>
							<ul class="list-tag">
								<?php
									if(!empty($value['tags'])){
										foreach ($value['tags'] as $key => $values) {
	                                        if (isset($values['name'])) {
												echo '<li><a href="./tag/?name='.urlencode($values['name']).'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
											}
										}
									}
								?>
							</ul>
							<div class="list-date"> 提问于：<?=$value['ctime']?></div>
						</li>
					<?php }

						$this->load->view("miaoda/page",array(
							"page" => $page,
							"page_max" => $problem_list_count,
							"page_count" => 5,
							"page_url" => "./home",
							"hot" => $hot_type ? "&uid=" . $user['id'] . "&ok=hot" : "&uid=" . $user['id']
						));
					?>

				</ul>
			</div>

		</div>
	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>
