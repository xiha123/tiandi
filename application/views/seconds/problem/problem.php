<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/seconds/student.css">
<body>
<?php $this->load->view('widgets/seconds/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
	<div class="wrapper">
		<div class="leftBox">
			<!-- <div class="head">● 该问题赏金为<font>300银币</font>，共有<font>5位众筹者</font></div> -->
			<div class="leftHeader">
				<h1><?=$problem_data["title"];?></h1>
				<a href="#" class="tagBox">tag</a>
				<a href="#" class="tagBox">tag</a>
				<a href="#" class="tagBox">tag</a>
				<a href="#" class="tagBox">tag</a>
				<a href="#" class="tagBox">tag</a>
			</div>
			<div class="whyUser">
				<img src="<?=$problem_user['avatar']?>" alt="" width="35" height="35">
				<div class="data">
					<p class="name"><?=$problem_user['nickname']?></p>
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
				<button class="none-background">★ 收藏</button>
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