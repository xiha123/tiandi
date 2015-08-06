<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/seconds/student.css">
<body>

<script>
	var problem_id = <?=$problem_data["id"]?>,
	problem_lost_time = <?=$problem_data["answer_time"] + 1200?>;
</script>
	<?php
		if($problem_data["answer_time"] + 1200 < time()){
			$this->problem_model->def($problem_data["id"]);
		}
	?>



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
				<div class="desc"><?=$problem_detaill[0]['content']?></div>
			</div>
			<?php
				if($problem_detaill[0]["code"] != NULL){
					echo '<div class="code"><h2>code (html)</h2><textarea>'.$problem_detaill[0]["code"].'</textarea></div>';
				}
				for ($index=1; $index < count($problem_detaill); $index++) { 
			?>
					<div class="whyUser">
						<a href="./home?uid=<?=$problem_detaill[$index]['user']['id']?>" target="_blank"><img src="<?=$problem_detaill[$index]['user']['avatar']?>" alt="" width="35" height="35"></a>
						<div class="data">
							<p class="name">大神：<a href="./home?uid=<?=$problem_detaill[$index]['user']['id']?>" target="_blank"><?=$problem_detaill[$index]['user']['nickname']?></a></p>
							<p class="date">回答于：<?=$problem_data['ctime']?></p>
						</div>
						<div class="desc"><?=$problem_detaill[$index]['content']?></div>
					</div>
			<?php
					if($problem_detaill[$index]["code"] != NULL){
						echo '<div class="code"><h2>code (html)</h2><textarea>'.$problem_detaill[$index]["code"].'</textarea></div>';
					}
				}
			?>





			<?php
				if(@$type == 1){
					echo $problem_data['type'] == 1 ? '<div class="doubt-time">20:00</div>' :'';
				}
			?>
			
			<?php if($problem_data['answer_id'] == @$id && $problem_data['type'] == 1){ ?>
				<div class="doubt">
					<table class="table">
						<tr><td>
							<div class="desc">
								<script id="editor" type="text/plain" style="width:743px;height:180px;"></script>
								<a href="javascript:" class="Language">选择语言</a>
								<textarea  id="problem-code" class="code" style="margin-top: 0px;" placeholder="选择编程语言以后，写下你的问题涉及到的代码"></textarea>
							</div>
						</td></tr>
					</table>
				</div>
			<?php } ?>
			<div class="button close">
			<?php
				if($problem_data['type'] == 2){
					echo '<a href="#"><i class="fa fa-star"></i>收藏</a>
						<a href="#"><i class="fa fa-star"></i>点赞</a>
						<a href="#"><i class="fa fa-circle"></i>分享</a>';
				}
				if($problem_data['owner_id'] == @$id && $problem_data['type'] == 2){
					echo '<button>满意</button> <button class="none-background">不满意</button>';
				}
			?>
			</div>
			
			<div class="button">
				<?php
					if($problem_data['type'] != 2){
						echo $problem_follow == true?
						'<button id="follow" class="none-background"><i class="fa fa-heart-o"></i> 关注</button>':
						'<button id="unfollow"><i class="fa fa-heart-o"></i> 取消关注</button>';
						echo $problem_collect == true ?
						'<button id="uncollect">★ 取消收藏</button>':
						'<button id="collect" class="none-background">★ 收藏</button>';
						echo '<button>众筹</button>';
					}else if(@$type == 1){
						echo $problem_data['type'] == 1 ? 
						'<button id="reply">回答</button>' :
						$problem_data['type'] == 0 ? 
						'<button id="answer">认领问题</button>' : 
						"";
					}
				?>
			</div>
			<ul class="comment-list">
				<!-- <i class="fa fa-thumbs-up"></i> 9</div> --> 
				<li><img src="static/image/default.jpg" alt=""><p class="name">tocurd</p><p class="content">niu</p></li>
				<li><img src="static/image/default.jpg" alt=""><p class="name">tocurd</p><p class="content">niu</p></li>
				<li><img src="static/image/default.jpg" alt=""><p class="name">tocurd</p><p class="content">niu</p></li>
				<li><img src="static/image/default.jpg" alt=""><p class="name">tocurd</p><p class="content">niu</p></li>
				<li><img src="static/image/default.jpg" alt=""><p class="name">tocurd</p><p class="content">niu</p><div></li>
			</ul>
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
<script src="ueditor/ueditor.config.js"></script>
<script src="ueditor/ueditor.all.min.js"></script>
<script src="static/js/problem.js"></script>
</body>
</html>