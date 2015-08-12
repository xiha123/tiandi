<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/student.css">
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



<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
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
				<div class="desc"><?= $problem_detail[0]['content'] ?></div>
			</div>
			<?php
				if($problem_detail[0]["code"] != NULL){
					echo '<div class="code"><h2>code (html)</h2><textarea>'.$problem_detail[0]["code"].'</textarea></div>';
				}
				for ($index=1; $index < count($problem_detail); $index++) {
			?>
					<div class="whyUser">
						<a href="./home?uid=<?=$problem_detail[$index]['user']['id']?>" target="_blank"><img src="<?=$problem_detail[$index]['user']['avatar']?>" alt="" width="35" height="35"></a>
						<div class="data">
							<p class="name">大神：<a href="./home?uid=<?=$problem_detail[$index]['user']['id']?>" target="_blank"><?=$problem_detail[$index]['user']['nickname']?></a></p>
							<p class="date">回答于：<?=$problem_data['ctime']?></p>
						</div>
						<div class="desc"><?=$problem_detail[$index]['content']?></div>
					</div>
			<?php
					if($problem_detail[$index]["code"] != NULL){
						echo '<div class="code"><h2>code (html)</h2><textarea>'.$problem_detail[$index]["code"].'</textarea></div>';
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
			<?php }

				if($problem_data['type'] == 2 || $problem_data['type'] == 3){
					echo '<div class="button close" data-id="' . $problem_data["id"] . '">
						<a href="javascript:" class="ajax_up"><i class="fa fa-star"></i>点赞
						(<p class="upCount" style="display:inline;margin-left:4px;">'.$problem_data['up_count'].'</p> )</a>
						<a href="#"><i class="fa fa-circle"></i>分享</a>';
					echo $problem_data['owner_id'] == @$id && $problem_data['type'] == 2 ? '<button class="ajax_close">满意</button> <button class="none-background ajax_close_not">不满意</button>' :"";
					echo "</div>";
				}
			?>


			<div class="button">
				<?php
					if($problem_data['type'] != 2 || $problem_data['type'] != 3){
						echo $problem_follow == true?
						'<button class="none-background follow"><i class="fa fa-heart-o"></i> 关注</button>':
						'<button class="unfollow"><i class="fa fa-heart-o"></i> 取消关注</button>';
						echo $problem_collect == true ?
						'<button class="uncollect">★ 取消收藏</button>':
						'<button class="none-background collect">★ 收藏</button>';
						echo '<button>众筹</button>';
					} if(@$type == 1 ){
						echo $problem_data['type'] == 0 ? '<button id="answer">认领问题</button>' : "";
						echo $problem_data['type'] == 1 && $problem_data["answer_id"] == @$id ? '<button id="reply">回答</button>' :"";
					}
				?>
			</div>

			<?php
				if($problem_data['type'] == 3){
			?>
			<div class="doubt">
				<table class="table">
					<tr><td>
						<div class="desc">
							<script id="editor" type="text/plain" style="width:743px;height:140px;"></script>
						</div>
					</td></tr>
				</table>
			</div>
			<div class="button">
				<button id="ajax_comment">提交</button>
			</div>
			<?php }?>


			<ul class="comment-list">
			<?php
				if($problem_data['type'] == 3){
					foreach ($problem_commenct as $key => $value) {
						echo '<li><img src="'.$value['user']['avatar'].'" alt=""><p class="name">'.$value['user']['nickname'].' <span style="color:#aaa;margin-left:10px;font-size:12px;">'.$value['ctime'].'</span></p><p class="content">'.$value['content'].'</p></li>';
					}
				}
				echo '</ul>';
				if($problem_data['type'] == 3){
					$this->load->view("miaoda/page",array(
						"page" => $page,
						"page_max" => $page_max,
						"page_count" => 5,
						"page_url" => "./problem",
						"hot" => "&p=" . $problem_data['id']
					));
				}
			?>
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