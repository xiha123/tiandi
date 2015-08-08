<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/tacher.css">
<body>
<?php
	$this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); 
	$this->load->view('widgets/windows.php' );
?>
	<div class="wrapper">
		<div class="tacher-data home">
			<img src="<?=$user['avatar']?>" alt="" class="pic">
			<h3 class="name"><?=$user['nickname']?> <a href="./god/apply" target="_blank">想成为大神？</a></h3>
			<p class="money">银币：<?=$user['gold_coin']?>  金币：<?=$user['silver_coin']?></p>
			<p class="desk"><?php
				if($user['description'] == ""){
					echo '这家伙还没有描述.....';
				}else{
					echo $description;
				}
			?></p>
		</div>
		<div class="tacher-tag ">
			<h2>收藏标签：</h2>
			<?php
				if($skilled_tags== array()){
					echo '<p class="not">还没有收藏标签</p>';
				}else{
					foreach ($skilled_tags as $key => $value) {
						echo '<a href="./tag/?name='.$value->t.'"  target="_blank" class="tag-box">'.$value->t.'</a>';
					}
				}
			?>
			<!-- <a href="#" class="tag-box"></a> -->
		</div>



		<div class="tacher-why">
			<div class="tab"  >
				<ul class="title  cf js-tab-trigger" data-widget="tab" >
					<li <?=!$owner&&!$love?'class="active"':''?>><a href="home/?uid=<?=$user['id']?>">收藏</a></li>
					<li <?=$love?'class="active"':''?>><a href="home/?uid=<?=$user['id']?>&love=love">关注</a></li>
					<li <?=$owner?'class="active"':''?>><a href="home/?uid=<?=$user['id']?>&owner=owner">问过</a></li>
				</ul>
				<ul class="list-data">
					<ul class="list-data">
						<?php foreach ($problem_list as $key => $value) {?>
							<li data-id="<?=$value['id']?>">
								<div class="link-num ajax_up"><p class="upCount"><?=$value['up_count']?></p><p>点赞</p></div>
								<div class="list-title">
									<a href="./problem/?p=<?=$value['id']?>" target="_blank"><?=$value['title']?></a>
								</div>
								<ul class="list-tag">
									<?php
										if(isset($value['tags'])){
											foreach ($value['tags'] as $key => $values) {
												echo '<li><a href="./tag/?name='.$values['name'].'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
											}
										}
									?>
								</ul>
								<div class="list-date"> 提问于：<?=$value['ctime']?></div>
							</li>
						<?php }	?>
					</ul>

					<div class="page">
						<ul>
							<?php
								@$hot = $hot_type ? "&uid=".$user['id']."&hot=hot":"&uid=".$user['id'];
								if($page > 1){echo '<li><a href="./home/?page='.($page - 1).$hot.'">< 上一页</a></li>';}else{echo"<li></li>";}
								$active = "";
								$count = ceil($owner_list_count / 5);
								for($index = 1; $index < $count + 1;$index ++){
									if($index == $page)$active = " class='active' ";
									echo '<li'.$active.'><a href="./home/?page='.($index).$hot.'">'.($index).'</a></li>';
									$active = "";
								}
								if($page < $count){echo '<li><a href="./home/?page='.($page + 1).$hot.'">下一页 ></a></li>';}
							?>
						</ul>
					</div>
				</ul>
			</div>





		</div>

	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>
