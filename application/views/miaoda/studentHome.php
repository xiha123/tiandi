<?php $this->load->view('widgets/header.php'); 
	$follow_users = json_decode($follow_users);
	function check_follow($follow_users , $user_id){
		foreach ($follow_users as $key => $value) {
			if($value[0] == $user_id){
				return true;
			}
		}
		return false;
	}
?>
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
			<p class="money">银币：<?=$user['silver_coin']?>  金币：<?=$user['gold_coin']?></p>
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
						echo '<a href="./tag/?name='.urlencode($value->t).'"  target="_blank" class="tag-box">'.$value->t.'</a>';
					}
				}
			?>
		</div>



		<div class="tacher-why">
			<div class="tab"  >
				<ul class="title  cf js-tab-trigger" data-widget="tab" >
					<li <?=!$owner&&!$love?'class="active"':''?>><a href="home/?uid=<?=$user['id']?>">收藏</a></li>
					<li <?=$owner?'class="active"':''?>><a href="home/?uid=<?=$user['id']?>&owner=owner">问过</a></li>
					<li <?=$love?'class="active"':''?>><a href="home/?uid=<?=$user['id']?>&love=love">关注</a></li>
				</ul>
				<ul class="list-data">
					<ul class="list-data">
						<?php if($follow_type == false){ foreach ($problem_list as $key => $value) {?>
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
						<?php }	}else{
							foreach ($problem_list as $key => $value) {
								$value['avatar'] = $value['avatar'] == "" ? "static/image/default.jpg" : $value['avatar'];
								$button =  check_follow($follow_users,$value['id']) ? '<button id="ajax_uneye" data-id="' . $value['id'] . '"> 取消关注 </button>' : '<button id="ajax_eye" data-id="' . $value['id'] . '"> <font>+</font> 关注</button>';
								echo '<div class="data fl">
									<div class="left_box">
										<img src="' . $value['avatar'] . '" alt="" class="pic">
										'.$button.'
									</div>
									<div class="right_box">
											<p class="name">' . $value['nickname'] . '<font><img src="static/image/good.png" alt="" width="13px">0</font><font><img src="static/image/look.png" width="26px" alt="">'.count(json_decode($value['follow_users'])).'</font> </p>
											<p class="desk">' . $value['god_description'] . '</p>
											'.($value['type']=="1" ? '<p class="class">正在开的课：2门</p>':"").'
											<a href="javascript:" class="tagBox">tag</a>
											<a href="javascript:" class="tagBox">tag</a>
											<a href="javascript:" class="tagBox">tag</a>
									</div>
								</div>';
							}
						}?>
					</ul>


					<?php
						$this->load->view("miaoda/page",array(
							"page" => $page,
							"page_max" => $owner_list_count,
							"page_count" => 5,
							"page_url" => "./home",
							"hot" => @$hot_type ? "&uid=".$user['id']."&hot=hot":"&uid=".$user['id']
						));
					?>
				</ul>
			</div>





		</div>

	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>
