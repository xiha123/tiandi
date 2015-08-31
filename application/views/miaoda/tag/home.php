<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/home.css">
<link rel="stylesheet" href="./static/css/miaoda/tag.css">
<body>
<script>
	var tag = <?=$tag_data['id']?>;
</script>
<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>

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
				<ul class="title">
					<li <?php if($hot_type == ""){echo 'class="active"';} ?>><a href="./tag/?name=<?=$tag_data['name']?>">最新</a></li>
					<li <?php if($hot_type == "hot"){echo 'class="active"';} ?>><a href="./tag/?name=<?=$tag_data['name']?>&hot=hot">热门</a></li>
					<li <?php if($hot_type == "love"){echo 'class="active"';} ?>><a href="./tag/?name=<?=$tag_data['name']?>&love=love">众筹</a></li>
				</ul>
				<ul class="list-data tab-sheet  js-tab-sheet">
					<ul class="list-data">
						<?php if(isset($tag_list[0]['id'])){ foreach ($tag_list as $key => $value) { ?>
							<li data-id="<?=$value['id']?>">
								<div class="link-num ajax_up"><p class="upCount"><?=$value['up_count']?></p><p>点赞</p></div>
								<div class="list-title">
									<a href="./problem/?p=<?=$value['id']?>" target="_blank"><?=$value['title']?></a>
								</div>
								<ul class="list-tag">
									<?php
										if(isset($value['tags'])){
											foreach ($value['tags'] as $key => $values) {
												echo '<li><a href="./tag/?name='.urlencode($values['name']).'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
											}
										}
									?>
								</ul>
								<div class="list-date"> 提问于：<?=$value['ctime']?></div>
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
				<?php
					foreach ($god as $key => $value) {
						if($value[0]["avatar"] == ""){
							$value[0]["avatar"] = "static/image/default.jpg";
						}
						echo '<li><img src="'.$value[0]['avatar'].'" alt="" class="pic"><img class="god" src="./static/image/god_right.png"><h4 class="name">'.$value[0]['nickname'].'</h4><div class="look"><img src="static/image/look.png" width="20px" alt="">'.$value[0]['follower_count'].'</div></li>';
					}
				?>
				<li>
					<a href="./god">更多 ></a>
				</li>
			</ul>

			<h2 class="box-title">标签活跃学员</h2>
			<ul class="tag-list">
				<?php
					foreach ($student as $key => $value) {
						if(@$value[0]["avatar"] == ""){
							$value[0]["avatar"] = "static/image/default.jpg";
						}
						if(isset($value[0]['nickname'])){
							echo '<li><img src="'.@$value[0]['avatar'].'" alt="" class="pic"><h4 class="name">'.@$value[0]['nickname'].'</h4><div class="look"><img src="static/image/look.png" width="20px" alt="">'.$value[0]['follower_count'].'</div></li>';
						}
					}
				?>
				<li>
				</li>
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
