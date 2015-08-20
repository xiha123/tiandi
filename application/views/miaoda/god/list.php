<?php 
	$this->load->view('widgets/header.php'); 
	$active = 'class="active"';
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
<link rel="stylesheet" href="./static/css/miaoda/god.css">
<body>
<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
<div class="wrapper">
	<div class="tab">
		<ul class="tab-trigger cf js-tab-trigger">
			<li data-id="3d" <?=$types == 0 ? $active :"" ?>><a href="./god?type=u3d">Unity-3D</a></li>
			<li data-id="swift" <?=$types == 1 ? $active :"" ?>><a href="./god?type=Swift">Swift</a></li>
			<li data-id="Web" <?=$types == 2 ? $active :"" ?>><a href="./god?type=Web">Web</a></li>
			<li data-id="Cocos2d-x" <?=$types == 3 ? $active :"" ?>><a href="./god?type=Cocos2d-x">Cocos2d-x</a></li>
			<li data-id="Android" <?=$types == 4 ? $active :"" ?>><a href="./god?type=Android">Android</a></li>
		</ul>
		<ul>
			<li style="overflow: hidden;">
				<?php
					foreach ($data as $key => $value) {
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
									<p class="class">正在开的课：2门</p>
									<a href="javascript:" class="tagBox">tag</a>
									<a href="javascript:" class="tagBox">tag</a>
									<a href="javascript:" class="tagBox">tag</a>
							</div>
						</div>';
					}
				?>
			</li>
							
			<?php
				$this->load->view("miaoda/page",array(
					"page" => $page,
					"page_max" => $page_max,
					"page_count" => 10,
					"page_url" => "./god",
					"hot" => "?type=" . $type_name
				));
			?>
		</ul>
	</div>



</div>
<?php $this->load->view('widgets/footer.php'); ?>

</body>
</html>
