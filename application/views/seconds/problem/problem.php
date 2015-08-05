<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/seconds/student.css">
<body>

<script>
	var problem_id = <?=$problem_data["id"]?>;
</script>

<?php $this->load->view('widgets/seconds/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
	<div class="wrapper">
		<div class="leftBox">
			<!-- <div class="head">● 该问题赏金为<font>300银币</font>，共有<font>5位众筹者</font></div> -->
			<div class="leftHeader">
				<h1><?=$problem_data["title"];?></h1>
				<?php
					if(isset($problem_data['tags'])){
						foreach ($problem_data['tags'] as $key => $values) {
							echo '<a href="./tag/?name='.$values['name'].'"  target="_blank" class="tag-box">'.$values['name'].'</a>';
						}
					}
				?>
			</div>
			<div class="whyUser">
				<a href="./home?uid=<?=$problem_user['id']?>" target="_blank"><img src="<?=$problem_user['avatar']?>" alt="" width="35" height="35"></a>
				<div class="data">
					<p class="name"><a href="./home?uid=<?=$problem_user['id']?>" target="_blank"><?=$problem_user['nickname']?></a></p>
					<p class="date">提问于：<?=$problem_data['ctime']?></p>
				</div>
				<div class="desc"><?=$problem_detaill['content']?></div>
			</div>
			<?php
				if($problem_detaill["code"] != NULL){
					echo '<div class="code"><h2>code (html)</h2><textarea>'.$problem_detaill["code"].'</textarea></div>';
				}
			?>

			<div class="button">
				<button class="none-background"><i class="fa fa-heart-o"></i> 关注</button>
				<?php
					echo $problem_collect == true ?
					'<button id="uncollect">★ 取消收藏</button>':
					'<button id="collect" class="none-background">★ 收藏</button>';
				?>
				<button>众筹</button>
			</div>

		</div>

		<div class="rightBox">
			<h2 class="box-title">相关问题</h2>
			<ul>
				<li><a href="javascript:">相关问题相关问题相关问题相关问题相关问题</a></li>
				<li><a href="javascript:">相关问题相关问题相关问题相关问题相关问题</a></li>
				<li><a href="javascript:">相关问题相关问题相关问题相关问题相关问题</a></li>
				<li><a href="javascript:">相关问题相关问题相关问题相关问题相关问题</a></li>
			</ul>
		</div>

	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>