<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/seconds/tacher.css">
<body>
<?php $this->load->view('widgets/seconds/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
	<div class="wrapper">
		<div class="tacher-data">
			<img src="<?=$user["avatar"] ?>" alt="" class="pic">
			<h3 class="name"><?=$user["nickname"] ?></h3>
			<p class="desk"><?php echo $user["description"] == "" ? "这货居然没写描述" : $user['description']; ?></p>
			<button>+ 关注</button>
		</div>
		<div class="tacher-tag">
			<h2>擅长标签：</h2>
			<p class="not">他还没有擅长的标签</p>
			<!-- <a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a><a href="#" class="tag-box">12312</a> -->
		</div>

		<div class="tacher-class">
			<h2>正在开的课程：</h2>
			<ul>
				<li></li>
				<li></li>
				<li class="last"></li>
			</ul>
		</div>

		<div class="tacher-why">
			<h2>回答的问题</h2>
			<ul class="list-data">
				<?php 
					echo $answer_count <= 0 ? "<p class='not'>这货居然还没有回答过任何问题！</p>" : "";
					foreach ($answer as $key => $value) {?>
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
			<?php
				$this->load->view("seconds/page",array(
					"page" => $page,
					"page_max" => $answer_count,
					"page_count" => 20,
					"page_url" => "./home",
					"hot" => "&uid=" . $user['id']
				));
			?>
			

			
		</div>

	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>