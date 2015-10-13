<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/home.css">
<link rel="stylesheet" href="./static/css/miaoda/tag.css">
<body>
<script>
	var tag = <?=$tag_data['id']?>;
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
		<div class="left-content">

			<div class="tag-desk">
				<h1><?=$tag_data['name']?></h1>
				<?=!$collect_type ?
					'<button id="collect_tag"><i class="fa fa-star-o"></i> 收藏</button>' :
					'<button class="none-background" id="uncollect_tag"><i class="fa fa-star"></i> 取消收藏</button>'
				?>

				<p class="desk">
					<?=$tag_data['content'] == "" ? "" : $tag_data['content'];?>
				</p>
			</div>


			<div class="tab">
				<ul class="title   cf js-tab-trigger">
					<li <?php if($hot_type == ""){echo 'class="active"';} ?>><a href="./tag/?name=<?=$tag_data['name']?>">已答</a></li>
					<li <?php if($hot_type == "hot"){echo 'class="active"';} ?>><a href="./tag/?name=<?=$tag_data['name']?>&hot=hot">热门</a></li>
					<li <?php if($hot_type == "love"){echo 'class="active"';} ?>><a href="./tag/?name=<?=$tag_data['name']?>&love=love">未答</a></li>
				</ul>
				<ul class="list-data tab-sheet js-tab-sheet">
					<ul class="list-data">
						<?php if(isset($tag_list[0]['id'])) {
						foreach ($tag_list as $key => $value) {
							if ($hot_type != 'love' && empty($value['answer_id'])) continue; ?>
							<li data-id="<?=$value['id']?>">
								<?php if ($hot_type != 'love') { ?>
								<div class="link-num ajax_up"><p class="upCount"><?=$value['up_count']?></p><p>点赞</p></div>
								<?php } else {
									$fund_count = count(json_decode($value['who']));
								?>
								<div class="link-num js_chou" data-id="<?= $value['id'] ?>"><p class="upCount"><?= $fund_count ?></p><p>众筹</p></div>
								<?php } ?>
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
								<?php if ($hot_type == 'love') {
									$man = $this->db->where('id', $value['owner_id'])->get('user')->row_array();
								?>
								<div class="list-date"><?php echo $man['nickname'] ?>提问于：<?=$value['ctime']?></div>
								<?php } else {
									$man = $value['answer_id'];
								?>
								<div class="list-date"><?= $man['nickname'] ?>回答于：<?=$value['ctime']?></div>
								<?php } ?>
							</li>
						<?php }} ?>
					</ul>
					<?php
						$this->load->view("miaoda/page",array(
							"page" => $page,
							"page_max" => $problem_list_count,
							"page_count" => 20,
							"page_url" => "./tag",
							"hot" => $hot_type ? "&hot=hot&name=" . $tag_data['name'] : "&name=".$tag_data['name']
						));
					?>
				</ul>
			</div>


		</div>
		<div class="right-content">
			<h2 class="box-title">标签活跃大神</h2>
			<ul class="tag-list">
				{active_god}
				<li>
					<a href="home?uid={id}">
						<img src="{avatar}" class="pic">
						<img class="god" src="./static/image/god_right.png">
						<h4 class="name">{nickname}</h4>
						<div class="look"><img src="static/image/look.png" width="20px" alt="">{follower_count}</div>
					</a>
				</li>
				{/active_god}
				<li><a href="./god">更多 ></a></li>
			</ul>

			<h2 class="box-title">标签活跃学员</h2>
			<ul class="tag-list">
				{active_stu}
				<li>
					<a href="home?uid={id}">
						<img src="{avatar}" class="pic">
						<h4 class="name">{nickname}</h4>
						<div class="look"><img src="static/image/look.png" width="20px" alt="">{follower_count}</div>
					</a>
				</li>
				{/active_stu}
			</ul>

		</div>
	</div>
<?php $this->load->view('widgets/footer.php'); ?>
<script type="text/javascript">
	$("#collect_tag").click(function(event) {
		/* Act on the event */
		ajax("api/user_api/collect_tag",{"id" : tag});
	});
	$("#uncollect_tag").click(function(event) {
		/* Act on the event */
		ajax("api/user_api/uncollect_tag",{"id" : tag});
	});
	function ajax(url,data){
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: data,
			success:function(){
				showAlert(true,"操作成功！");
				 setTimeout(function(){
			            location.reload();
			        },1000)
			},
			error:function(){
				showAlert(false,"网络异常！");
			}
		});


	}
</script>
</body>
</html>
