<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/tacher.css">
<body>
<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 1)); ?>
<?php
	$this->load->view('widgets/windows.php' );
	function check_follow($follow_users, $user_id) {
		return in_array($user_id, $follow_users);
	}
?>
	<div class="wrapper">
		<div class="tacher-data">
			<img src="<?=$user["avatar"] ?>" alt="" class="pic"><h3 class="name"><?=$user["nickname"] ?></h3>
			<p class="desk"><?php echo $user["description"] == "" ? "这货居然没写描述" : $user['description']; ?></p>
			<?= !check_follow(json_decode((isset($follow_users) ? $follow_users : "[]")), $user['id']) ? '<button id="ajax_eye" data-id="'.$user["id"].'">+ 关注</button>' : '<button id="ajax_uneye" data-id="'.$user["id"].'">取消关注</button>';?>
		</div>
		<div class="tacher-tag">
			<h2>擅长标签：</h2>
			<?php
				$god_skilled_tags = json_decode($user['god_skilled_tags']);
				echo count($god_skilled_tags) <= 0 ? '<p class="not">他还没有擅长的标签</p>' : '';
				foreach (count($god_skilled_tags) > 0 ? $god_skilled_tags : array() as $key => $value) {
					echo '<a href="./tag/?name='. urldecode($value).'" class="tagBox">'.$value.'</a>';
				}
			?>
		</div>

		<div class="tacher-class">
			<h2>正在开的课程：</h2>
			<ul>
				{course}
					<li><a href="{link}" target="_blank">
						<img src="{img}" height="100%" width="100%" alt="{title}">
					</a></li>
				{/course}
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
			<?php
				$this->load->view("miaoda/page",array(
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
