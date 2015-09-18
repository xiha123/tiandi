<?php $this->load->view('widgets/header.php');
	function check_follow($follow_users, $user_id) {
		return in_array($user_id, $follow_users);
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
			<p class="desk"><?= $user['description'] == "" ? '这家伙还没有描述.....' : $user['description'];?></p>
		</div>


		<div class="tacher-tag ">
			<h2>收藏标签：</h2>
			<?php if(count($user['skilled_tags']) == 0){
					echo '<p class="not">还没有收藏标签</p>';
			} else {
				foreach ($user['skilled_tags'] as $key => $value) {
					echo '<a href="./tag/?name='.urlencode($value['name']).'"  target="_blank" class="tag-box">'.$value['name'].'</a>';
				}
			} ?>
		</div>

		<div class="tacher-why">
			<div class="tab"  >
				<ul class="title  cf js-tab-trigger" data-widget="tab" >
					<li <?=!$owner&&!$love?'class="active"':''?>><a href="home/?uid=<?=$user['id']?>&home=index">收藏</a></li>
					<li <?=$owner?'class="active"':''?>><a href="home/?uid=<?=$user['id']?>&owner=owner&home=index">问过</a></li>
					<li <?=$love?'class="active"':''?>><a href="home/?uid=<?=$user['id']?>&love=love&home=index">关注</a></li>
				</ul>
				<ul class="list-data">
					<ul class="list-data">
						<?php if($follow_type == false){ foreach ($problem_list as $key => $value) {
							if (empty($value['id'])) continue; ?>
							<li data-id="<?=$value['id']?>">
								<div class="link-num ajax_up"><p class="upCount"><?=$value['up_count']?></p><p>点赞</p></div>
								<div class="list-title">
									<a href="./problem/?p=<?=$value['id']?>" target="_blank"><?=$value['title']?></a>
								</div>
								<ul class="list-tag">
									<?php
										if(!empty($value['tags'])) {
											foreach ($value['tags'] as $key => $values) {
												echo '<li><a href="./tag/?name='.urlencode($values['name']).'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
											}
										}
									?>
								</ul>
								<div class="list-date"> <?=$value['type'] == 3 ? "大神".$value['answer_id']['nickname']."回答于：".date("Y-m-d H:i:s",$value['answer_time']) : "提问于：".$value['ctime'] ?></div>
							</li>
						<?php }	}else{
							foreach ($problem_list as $key => $value) {
								$value['avatar'] = $value['avatar'] == "" ? "static/image/default.jpg" : $value['avatar'];
								$button =  check_follow(json_decode($user['follow_users']), $value['id']) ? '<button id="ajax_uneye" data-id="' . $value['id'] . '"> 取消关注 </button>' : '<button id="ajax_eye" data-id="' . $value['id'] . '"> <font>+</font> 关注</button>';
								echo '<div class="data fl">
									<div class="left_box">
										<a href="./home?uid=' . $value['id'] . '" target="_blank"><img src="' . $value['avatar'] . '" alt="" class="pic"></a>
										'.$button.'
									</div>
									<div class="right_box">
										<p class="name"><a href="./home?uid=' . $value['id'] . '" target="_blank">' . $value['nickname'] . '</a><font class="fr"><img src="static/image/look.png" width="26px" alt="">'.$value['follower_count'].'</font></p>
										<p class="desk">' . $value['god_description'] . '</p>';
								$skilled_tags = json_decode($value['god_skilled_tags']);
								foreach (count($skilled_tags) > 0 ? $skilled_tags : array() as $key => $value) {
									echo '<a href="javascript:" class="tagBox">'.$value.'</a>';
								}
								echo '</div></div>';
							}
						}?>
					</ul>


					<?php
						$page_count = $follow_type == false ? 20 : 6;
						$this->load->view("miaoda/page",array(
							"page" => $page,
							"page_max" => $owner_list_count,
							"page_count" => $page_count,
							"page_url" => "./home",
							"hot" => $hot . "&uid=".$user['id']."&home=index"
						));
					?>
				</ul>
			</div>





		</div>

	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>
