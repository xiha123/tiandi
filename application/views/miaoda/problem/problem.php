	<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="static/css/miaoda/student.css">
	<link rel="stylesheet" href="static/lib/syntax/shCore.css">
	<link rel="stylesheet" href="static/lib/syntax/shThemeDefault.css">
	<link href="ueditor/themes/default/css/umeditor.min.css" rel="stylesheet">
<body>

<script>
	window.problem_type = <?=$problem_data["type"]?>;
	window.first = <?php $frist = !isset($_SESSION['first']) ? "false" : $_SESSION['first'] ? "true" : "false"; echo $frist;?>;

	var problem_id = <?=$problem_data["id"]?>,
		problem_lost_time = <?=$problem_data["answer_time"] + 1200?>,
		problem_type = <?=$problem_data["type"]?>,
		max_god = <?=$god_count?>,
		online_save_type = <?=$problem_data["answer_id"] == @$id ? "true" : "false";?>,
		problem_owner = <?= $problem_data['owner_id'] ?>;
	<?php
		// 改变第首次提问状态
		$_SESSION['first'] = false;
		$online = false;
	?>
</script>

<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
	<div class="windows">
		<div class="confirm" id="confirm">
			<div class="confirm-title">
				<h2>您确定参与众筹吗？</h2>
				<a href="javascript:void(0)" class="close" id="close_window"><i class="fa fa-close"></i></a>
			</div>
			<div class="confirm-content">
				<div class="con">
					<p>您确定参与众筹吗？</p>
					<p>参与众筹后将会扣除您50银币，该操作无法反悔！您确定那么做吗</p>
				</div>
			</div>
			<div class="confirm-bottom">
				<button class="btn btn-danger button_ok">确定</button>
				<button class="btn btn-default" id="close_window">取消</button>
			</div>
		</div>
	</div>
	<div class="wrapper">

		<div class="leftBox">
			<?= $problem_data['type'] != 3 ? '<div class="head">● 该问题赏金为<font> '.
				$problem_data["silver_coin"] . '银币</font>，共有<font>'.  //，<font>'.$problem_data["gold_coin"] . '金币</font>
				(count(json_decode($problem_data['who'])) + 1).'位众筹者</font></div>' : "";
			?>
			<div class="leftHeader">
				<h1><?= htmlspecialchars($problem_data["title"]) ?></h1>
				<?php if(!empty($problem_data['tags'])) {
					foreach ($problem_data['tags'] as $key => $values) {
                        if (isset($values['name'])) {
                            echo '<a href="./tag/?name='.urlencode($values['name']).'"  target="_blank" class="tag-box">'.$values['name'].'</a>';
                        }
					}
				} ?>
			</div>
			<div class="whyUser">
				<a href="./home?uid=<?=$problem_user['id']?>" target="_blank"><img src="<?=$problem_user['avatar']?>" alt="" width="35" height="35"></a>
				<div class="data">
					<p class="name"><a href="./home?uid=<?=$problem_user['id']?>" target="_blank"><?=$problem_user['nickname']?></a></p>
					<p class="date">提问于：<?=$problem_detail[0]['ctime']?></p>
				</div>
				<div class="desc"><?=$problem_detail[0]['content']?></div>
			</div>
			<?php
				if ($problem_detail[0]["code"] != NULL) {
					echo '<div class="code"><pre class="brush: '.($problem_detail[0]["language"]).'">'.str_replace(array("&amp;lt;","&amp;gt;"),array("&lt;","&gt;"),$problem_detail[0]["code"]).'</pre></div>';
				}

				for ($index = 1; $index < count($problem_detail); $index++) {
			?>
					<div class="split"></div>
					<div class="whyUser">
                        <a href="./home?uid=<?=$problem_detail[$index]['user']['id']?>" target="_blank">
                            <img src="<?=$problem_detail[$index]['user']['avatar']?>" alt="" width="35" height="35">
                            <img class="god" src="./static/image/god_right.png">
                        </a>
						<div class="data">
							<p class="name"><a href="./home?uid=<?=$problem_detail[$index]['user']['id']?>" target="_blank"><?=$problem_detail[$index]['user']['nickname']?></a></p>
							<p class="date">回答于：<?=$problem_detail[$index]['ctime']?></p>
						</div>
						<div class="desc"><?=$problem_detail[$index]['content']?></div>
					</div>
			<?php
					if ($problem_detail[$index]["code"] != NULL) {
						echo '<div class="code"><pre class="brush: '.($problem_detail[$index]["language"]).'">'.str_replace(array("&amp;lt;","&amp;gt;"),array("&lt;","&gt;"),$problem_detail[$index]["code"]).'</pre></div>';
					}
				}
			?>


			<?php
				if($problem_data['type'] == "1" && @$id != $problem_data['answer_id']  && @$id != $problem_data['owner_id']){
					echo '<h3 class="center tishi">『问题正被解答中』</h3>';
				}

				if($problem_data['type'] == "1" && (@$id == $problem_data['answer_id'] || @$id == $problem_data['owner_id'])){
					echo $problem_data['type'] == 1 ? '<div class="doubt-time">20:00</div>' :'';
				}
				if($problem_data['type'] == "0" && @$id == $problem_data['owner_id'] || $is_fund) {
					echo '<div class="user_list_data"><!--<div class="doubt-time disable">20:00</div>-->
					<h3 class="center tishi">您的问题已经推送给了<span>'.($frist ? $god_count . "位" : "1").'</span>大神，请耐心等待······</h3>
					<h2 class="title">这些问题可能对您有用</h2>
					<ul>
						{useful_list}
							<li><a href="./problem/?p={id}" target="_blank">{title}</a></li>
						{/useful_list}
					</ul></div>';
				}
				if($problem_data['type'] == "1" ){ if($problem_data['answer_id'] == @$id || $problem_data['owner_id'] == @$id ){
				$problem_online_count = count(json_decode($problem_data['online']));

			?>
				<div class="doubt">
					<table class="table">
						<tr><td>
							<?php
								if($problem_data['owner_id'] == @$id){
									$online = true;
								}
							?>
							<span class="online fr"><font><?=$problem_data['owner_id'] == @$id ? "问题正在被大神" .  "解答中" : ($problem_online_count < 0 ? 0 : $problem_online_count) .'<i class="fa fa-user "></i>';?></font></span>
						</td></tr>
						<tr><td>
							<div class="desc">
								<script id="editor" type="text/plain" style="width:743px;height:180px;"><?= $temp_data['content'] ?></script>
								<div class="code-box">
									<select class="Language">
										<option value="0" <?=$temp_data['language'] == 0 ? 'selected=""' : ""?>>html</option>
										<option value="1" <?=$temp_data['language'] == 1 ? 'selected=""' : ""?>>php</option>
										<option value="2" <?=$temp_data['language'] == 2 ? 'selected=""' : ""?>>C++</option>
										<option value="3" <?=$temp_data['language'] == 3 ? 'selected=""' : ""?>>javascript</option>
										<option value="4" <?=$temp_data['language'] == 4 ? 'selected=""' : ""?>>java</option>
										<option value="5" <?=$temp_data['language'] == 5 ? 'selected=""' : ""?>>其他</option>
									</select>
									<textarea  id="problem-code" class="code" placeholder="选择编程语言以后，写下你的问题涉及到的代码"><?=$temp_data['code']?></textarea>
								</div>
							</div>
						</td></tr>
					</table>
				</div>

			<?php }} ?>
			<?php if($problem_data['type'] == 2 || $problem_data['type'] == 3) { // 已回答的问题，显示收藏、点赞
				$cls = $problem_collect == true ? 'uncollect' : 'collect';
				$cls2 = $problem_collect == true ? 'fa-star' : 'fa-star-o';
				$name = $problem_collect == true ? '取消收藏' : '收藏';
				$btn = $problem_data['owner_id'] == @$id && $problem_data['agree'] == 0 ? '<button class="ajax_close">满意</button> ' : ""; ?>

				<div class="button close" data-id="<?= $problem_data["id"] ?>">
					<a href="javascript:;" class="<?= $cls ?>"><i class="fa <?= $cls2 ?>"></i> <?= $name ?></a>
					<a href="javascript:" class="ajax_up"><i class="fa fa-thumbs-o-up"></i>点赞 ( <span class="upCount"><?= $problem_data['up_count'] ?></span> ) </a>
					<a href="#"><i class="fa fa-circle"></i>分享</a>
					<?= $btn ?>
				</div>
			<?php } else { ?>
				<div class="button">
					<?php
						if ($problem_data['owner_id'] != @$id && $problem_data['answer_id'] != @$id && !$is_fund) {
							echo $problem_collect == true ?
							'<button class="uncollect">★ 取消收藏</button>':
							'<button class="none-background collect">★ 收藏</button>';
							echo '<button data-id="' . $problem_data['id'] . '" class="js_chou">众筹</button>';
						}
						if (!empty($type) && $type == 1) { // 是大神
							if ($problem_data['answer_id'] === $id) { // 已认领
								echo $problem_data['type'] == 1 ? '<button id="reply">提交</button>' :"";
							} else if (!$is_fund) { // 未认领且自己没众筹
								echo $problem_data['type'] == 0 && $problem_data['owner_id'] != @$id ? '<button id="answer">认领问题</button>' : "";
							}
						}
					?>
				</div>
			<?php } ?>

			<?php if ($problem_data['type'] != 1 || ($problem_data['answer_id'] != $id && $problem_data['owner_id'] != $id)) { ?>
				<h2 class="tishi fl">发表评论</h2>
				<div class="doubt" style="margin-top:0px;">
					<table class="table">
						<tr><td>
							<div class="desc">
								<script id="editor" type="text/plain" style="width:743px;height:140px;"></script>
							</div>
						</td></tr>
					</table>
				</div>
				<div class="button">
					<button id="ajax_comment">评论</BUTTON>
				</div>
			<?php } ?>

			<ul class="comment-list">
			<?php foreach ($problem_commenct as $key => $value) {
				echo '<li><img src="'.$value['user']['avatar'].'" alt=""><p class="name">'.$value['user']['nickname'].' <span style="color:#aaa;margin-left:10px;font-size:12px;">'.$value['ctime'].'</span><!--<a href="javascript:;" class="data fr">有用 / (1)</a>--></p><p class="content">'.str_replace(array("&lt;/p&gt;","&lt;p&gt;","&lt;/br&gt;","&lt;br/&gt;" , "&amp;#40;" , "&amp;#41;" ,"&lt;/li&gt;" , "&lt;/ul&gt;") , array("</p>" ,"<p>","<br/>","<br>","(",")","</li>","</ul>") , $value['content']).'</p></li>';
			} ?>
			</ul>
			<?php
				$this->load->view("miaoda/page",array(
					"page" => $page,
					"page_max" => $page_max,
					"page_count" => 5,
					"page_url" => "./problem",
					"hot" => "&p=" . $problem_data['id']
				));
			?>
		</div>

		<div class="rightBox">
			<h2 class="box-title">相关问题</h2>
			<ul>
				{recommend_list}
					<li><a href="./problem/?p={id}" target="_blank">{title}</a></li>
				{/recommend_list}
			</ul>
		</div>

	</div>
<?php $this->load->view('widgets/footer.php'); ?>

<script src="./static/lib/syntax/brush.js"></script>
<script src="ueditor/umeditor.config.js"></script>
<script src="ueditor/umeditor.min.js"></script>
<script src="static/js/problem.js"></script>

<?php if ($online) { ?>
<script>
$(function () {
	ue.addListener('ready', function() {
		UM.getEditor('editor').setDisabled('fullscreen');
	});
	$('#problem-code').attr('readOnly' , true).css('color','#aaa');
});
</script>
<?php } ?>

</body>
</html>
