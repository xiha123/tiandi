<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/student.css">
<link rel="stylesheet" href="./static/lib/syntax/shCore.css">
<link rel="stylesheet" href="./static/lib/syntax/shThemeDefault.css">
<body>

<script>
	var problem_id = <?=$problem_data["id"]?>,
	problem_lost_time = <?=$problem_data["answer_time"] + 1200?>,
	problem_type = <?=$problem_data["type"]?>;
</script>
	<?php
		if($problem_data["answer_time"] + 1200 < time()){
			$this->problem_model->def($problem_data["id"]);
		}
	?>
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
			<?php
				echo '<div class="head">● 该问题赏金为<font> '.
				$problem_data["silver_coin"] . '银币</font>，<font>'.
				$problem_data["gold_coin"] . '金币</font>，共有<font>'.
				count(json_decode($problem_data['who'])).'位众筹者</font></div>';
			?>
			<div class="leftHeader">
				<h1><?=$problem_data["title"];?></h1>
				<?php
					if(isset($problem_data['tags'])){
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
					<p class="date">提问于：<?=$problem_data['ctime']?></p>
				</div>
				<div class="desc"><?=str_replace(array("&lt;/p&gt;","&lt;p&gt;","&lt;/br&gt;","&lt;br/&gt;" , "&amp;#40;" , "&amp;#41;" ,"&lt;/li&gt;" , "&lt;/ul&gt;" ,"&lt;ul&gt;" ,"&lt;li&gt;") , array("</p>" ,"<p>","<br/>","<br>","(",")","</li>","</ul>","<ul>","<li>") , $problem_detail[0]['content'])?></div>
			</div>
			<?php
				if($problem_detail[0]["code"] != NULL){
					echo '<div class="code-tool">
								<div class="tool">
									<a href="javascript:;" id="code_copy"><i class="fa fa-code"></i> 复制代码</a><h2>code ('.($problem_detail[0]["language"]).')</h2>
								</div>
							</div>
							<div class="code"><pre class="brush: php">'.($problem_detail[0]["code"]).'</pre></div>';
				}
				for ($index=1; $index < count($problem_detail); $index++) {
			?>
					<div class="whyUser">
						<a href="./home?uid=<?=$problem_detail[$index]['user']['id']?>" target="_blank"><img src="<?=$problem_detail[$index]['user']['avatar']?>" alt="" width="35" height="35"></a>
						<div class="data">
							<p class="name">大神：<a href="./home?uid=<?=$problem_detail[$index]['user']['id']?>" target="_blank"><?=$problem_detail[$index]['user']['nickname']?></a></p>
							<p class="date">回答于：<?=$problem_data['ctime']?></p>
						</div>
						<div class="desc"><?=str_replace(array("&lt;/p&gt;","&lt;p&gt;","&lt;/br&gt;","&lt;br/&gt;" , "&amp;#40;" , "&amp;#41;" ,"&lt;/li&gt;" , "&lt;/ul&gt;") , array("</p>" ,"<p>","<br/>","<br>","(",")","</li>","</ul>") , $problem_detail[$index]['content'])?></div>
					</div>
			<?php
					if($problem_detail[$index]["code"] != NULL){
						echo '<div class="code-tool">
							<div class="tool">
								<a href="javascript:;" id="code_copy"><i class="fa fa-code"></i> 复制代码</a><h2>code ('.($problem_detail[$index]["language"]).')</h2>
							</div>
						</div>
						<div class="code"><pre class="brush: php">'.($problem_detail[$index]["code"]).'</pre></div>';
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
							<span class="online fr"><i class="fa fa-user fr"></i><font class="fr"><?=count(json_decode($problem_data['online'])) - 1;//不记录自己的在线?></font></span>
						</td></tr>
						<tr><td>
							<div class="desc">
								<script id="editor" type="text/plain" style="width:743px;height:180px;"></script>
								<div class="code-box">
									<select class="Language">
										<option value="0">html</option>						
										<option value="1">php</option>						
										<option value="2">C++</option>						
										<option value="3">javascript</option>
										<option value="4">java</option>
										<option value="5">其他</option>
									</select>
									<textarea  id="problem-code" class="code" placeholder="选择编程语言以后，写下你的问题涉及到的代码"></textarea>
								</div>
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
						echo $problem_collect == true ?
						'<button class="uncollect">★ 取消收藏</button>':
						'<button class="none-background collect">★ 收藏</button>';
						echo '<button class="js_chou">众筹</button>';
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
						echo '<li><img src="'.$value['user']['avatar'].'" alt=""><p class="name">'.$value['user']['nickname'].' <span style="color:#aaa;margin-left:10px;font-size:12px;">'.$value['ctime'].'</span></p><p class="content">'.str_replace(array("&lt;/p&gt;","&lt;p&gt;","&lt;/br&gt;","&lt;br/&gt;" , "&amp;#40;" , "&amp;#41;" ,"&lt;/li&gt;" , "&lt;/ul&gt;") , array("</p>" ,"<p>","<br/>","<br>","(",")","</li>","</ul>") , $value['content']).'</p></li>';
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
<script src="./static/lib/syntax/brush.js"></script>
<script src="ueditor/ueditor.config.js"></script>
<script src="ueditor/ueditor.all.min.js"></script>
<script src="static/js/problem.js"></script>
</body>
</html>
