<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/seconds/godHome.css">
<body>
<?php $this->load->view('widgets/seconds/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
	<div class="wrapper">
	
		<div class="leftBox">
			<img src="<?=$user["avatar"] ?>" alt="" class="pic">
			<h3 class="name"><?=$user["nickname"] ?></h3>
			<p class="look"><img src="static/image/look.png" alt="" width="18px"><?=$user['collect_problem_count']?></p>
			<p class="look"><img src="static/image/good.png" width="16px" alt=""><?=$user['follow_problem_count']?></p>
			<p class="money">银币： <?=$user['gold_coin']?></p>
			<p class="money">金币： <?=$user['silver_coin']?></p>
			<p class="desc"><?php echo $user["description"] == "" ? "这货居然没写描述" : $user['description']; ?></p>
			<h2 class="box-title">擅长标签</h2>	
			<a href="#" class="tagBox">tag</a>
			<a href="#" class="tagBox">tag</a>
			<a href="#" class="tagBox">tag</a>
			<a href="#" class="tagBox">tag</a>
			<h2 class="box-title">正在开的课程</h2>
			<ul class="classList">
				<li></li>
				<li></li>
			</ul>
			<a href="#" class="help">帮助说明</a>
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
									if(isset($value['tags'])){
										foreach ($value['tags'] as $key => $values) {
											echo '<li><a href="./tag/?name='.$values['name'].'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
										}
									}
								?>
							</ul>
							<div class="list-date"> 提问于：<?=$value['ctime']?></div>
						</li>	
				<?php }	?>
			</ul>


			<div class="tab" data-widget="tab" >
				<ul class="title " >
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
									if(isset($value['tags'])){
										foreach ($value['tags'] as $key => $values) {
											echo '<li><a href="./tag/?name='.$values['name'].'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
										}
									}
								?>
							</ul>
							<div class="list-date"> 提问于：<?=$value['ctime']?></div>
						</li>	
					<?php }	

						$this->load->view("seconds/page",array(
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