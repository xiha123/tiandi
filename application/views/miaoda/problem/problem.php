<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/student.css">
<link rel="stylesheet" href="./static/lib/syntax/shCore.css">
<link rel="stylesheet" href="./static/lib/syntax/shThemeDefault.css">
<body>

<script>
	var problem_id = <?=$problem_data["id"]?>,
	problem_lost_time = <?=$problem_data["answer_time"] + 1200?>,
	problem_type = <?=$problem_data["type"]?>,
	max_god = <?=$god_count?>,
	online_save_type = <?=$problem_data["answer_id"] == @$id ? "true" : "false";?>;
	first = <?php $frist = !isset($_SESSION['first']) ? "false" : $_SESSION['first'] ? "true" : "false"; echo $frist;?>,
	problem_content = "<?=$problem_detail[0]['content']?>",
	problem_code = "<?=$problem_detail[0]['code']?>";
	<?php
		// 改变第首次提问状态
		$_SESSION['first'] = false;
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
			<?=$problem_data['type'] != 3 ? '<div class="head">● 该问题赏金为<font> '.
				$problem_data["silver_coin"] . '银币</font>，共有<font>'.  //，<font>'.$problem_data["gold_coin"] . '金币</font>
				(count(json_decode($problem_data['who'])) + 1).'位众筹者</font></div>' : "";
			?>
			<div class="leftHeader">
				<h1><?=$problem_data["title"];?></h1>
				<?php
					if(!empty($problem_data['tags'])){
						foreach ($problem_data['tags'] as $key => $values) {
							echo '<a href="./tag/?name='.urlencode($values['name']).'"  target="_blank" class="tag-box">'.$values['name'].'</a>';
						}
					}
				?>
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
				if($problem_detail[0]["code"] != NULL){
					echo '<div class="code-tool">
								<div class="tool">
									<!--<a href="javascript:;" id="code_copy"><i class="fa fa-code"></i> 复制代码</a>--><h2>('.($problem_detail[0]["language"]).')</h2>
								</div>
							</div>
							<div class="code"><pre class="brush: '.($problem_detail[0]["language"]).'">'.($problem_detail[0]["code"]).'</pre></div>';
				}
				for ($index=1; $index < count($problem_detail); $index++) {
			?>
					<div class="whyUser">
						<a href="./home?uid=<?=$problem_detail[$index]['user']['id']?>" target="_blank"><img src="<?=$problem_detail[$index]['user']['avatar']?>" alt="" width="35" height="35"></a>
						<div class="data">
							<p class="name">大神：<a href="./home?uid=<?=$problem_detail[$index]['user']['id']?>" target="_blank"><?=$problem_detail[$index]['user']['nickname']?></a></p>
							<p class="date">回答于：<?=$problem_detail[$index]['ctime']?></p>
						</div>
						<div class="desc"><?=$problem_detail[$index]['content']?></div>
					</div>
			<?php
					if($problem_detail[$index]["code"] != NULL){
						echo '<div class="code-tool">
							<div class="tool">
								<!--<a href="javascript:;" id="code_copy"><i class="fa fa-code"></i> 复制代码</a>--><h2>('.($problem_detail[$index]["language"]).')</h2>
							</div>
						</div>
						<div class="code"><pre class="brush: '.($problem_detail[$index]["language"]).'">'.($problem_detail[$index]["code"]).'</pre></div>';
					}
				}
			?>



			<?php
				if($problem_data['type'] == "1" && @$id != $problem_data['answer_id']  && @$id != $problem_data['owner_id']){
					echo '<h3 class="center tishi">『问题正被解答中』</h3>';
				}
			?>


			<?php
				if($problem_data['type'] == "1" && @$id == $problem_data['answer_id']  || @$id == $problem_data['owner_id']){
					echo $problem_data['type'] == 1 ? '<div class="doubt-time">20:00</div>' :'';
				}
				if($problem_data['type'] == "0" && @$id == $problem_data['owner_id']){
					echo '<div class="user_list_data"><div class="doubt-time disable">20:00</div>
					<h3 class="center tishi">您的问题已经推送给了<span>'.($frist ? "全部" : "1").'</span>大神，请耐心等待······</h3>
					<h2 class="title">这些问题可能对您有用</h2>
					<ul>
						{useful_list}
							<li><a href="./problem/?p={id}" target="_blank">{title}</a></li>
						{/useful_list}
					</ul></div>';

				}
			?>

			<?php if($problem_data['type'] == "1" ){ if($problem_data['answer_id'] == @$id || $problem_data['owner_id'] == @$id ){
				$problem_online_count = count(json_decode($problem_data['online'])) - 1;
			?>
				<div class="doubt">
					<table class="table">
						<tr><td>
							<span class="online fr"><font class="fr"><?=$problem_data['owner_id'] == @$id ? "问题正在被大神解答中" : ($problem_online_count < 0 ? 0 : $problem_online_count) .'<i class="fa fa-user fr"></i>';?></font></span>
						</td></tr>
						<tr><td>
							<div class="desc">
								<script id="editor" type="text/plain" style="width:743px;height:180px;"><?=$temp_data['content']?></script>
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
			<?php }}
				if($problem_data['type'] == 2 || $problem_data['type'] == 3){
					echo '<div class="button close" data-id="' . $problem_data["id"] . '">';
					echo $problem_collect == true ? '<a href="javascript:;" class="uncollect"><i class="fa fa-star"></i> 取消收藏</a>':'<a  href="javascript:;" class="collect"><i class="fa fa-star"></i> 收藏</a>';
					echo '<a href="javascript:" class="ajax_up"><i class="fa fa-thumbs-o-up"></i>点赞
						(<p class="upCount" style="display:inline;margin-left:4px;">'.$problem_data['up_count'].'</p> )</a>
						<a href="#"><i class="fa fa-circle"></i>分享</a>';

					echo $problem_data['owner_id'] == @$id && $problem_data['agree'] == 0 ? '<button class="ajax_close">满意</button> ' :"";
					echo "</div>";
				}
			?>


			<div class="button">
				<?php
					if($problem_data['type'] != 3){
						echo $problem_collect == true ?
						'<button class="uncollect">★ 取消收藏</button>':
						'<button class="none-background collect">★ 收藏</button>';
						echo '<button class="js_chou">众筹</button>';
					}
					if(@$type == 1 ){
						echo $problem_data['type'] == 0  ? '<button id="answer">认领问题</button>' : "";
						echo $problem_data['type'] == 1 && $problem_data["answer_id"] == @$id ? '<button id="reply">回答</button>' :"";
					}
				?>
			</div>
			<?php
				if($problem_data['type'] == 3){
			?>
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
			<?php }?>


			<ul class="comment-list">
			<?php
				if($problem_data['type'] == 3){
					foreach ($problem_commenct as $key => $value) {
						echo '<li><img src="'.$value['user']['avatar'].'" alt=""><p class="name">'.$value['user']['nickname'].' <span style="color:#aaa;margin-left:10px;font-size:12px;">'.$value['ctime'].'</span><!--<a href="javascript:;" class="data fr">有用 / (1)</a>--></p><p class="content">'.str_replace(array("&lt;/p&gt;","&lt;p&gt;","&lt;/br&gt;","&lt;br/&gt;" , "&amp;#40;" , "&amp;#41;" ,"&lt;/li&gt;" , "&lt;/ul&gt;") , array("</p>" ,"<p>","<br/>","<br>","(",")","</li>","</ul>") , $value['content']).'</p></li>';
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
				{recommend_list}
					<li><a href="./problem/?p={id}" target="_blank">{title}</a></li>
				{/recommend_list}
			</ul>
		</div>

	</div>
<?php $this->load->view('widgets/footer.php'); ?>
<script src="./static/lib/syntax/brush.js"></script>
<script src="ueditor/ueditor.config.js"></script>
<script src="ueditor/ueditor.all.min.js"></script>
<script src="static/js/problem.js"></script>
</body>
</html>
