<?php
	$this->load->view('widgets/header.php');
	$active = 'class="active"';
	$follow_users = json_decode($follow_users);

	function check_follow($follow_users, $user_id) {
		return in_array($user_id, $follow_users);
	}
?>
<link rel="stylesheet" href="./static/css/miaoda/god.css">
<body>
<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 1)); ?>
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
				<?php foreach ($data as $key => $value) {
					$value['avatar'] = $value['avatar'] == "" ? "static/image/default.jpg" : $value['avatar'];
					if ($value['id'] == @$id) {
						$button = '<button disabled="disabled" style="background:#ccc">自己</button>';
					} else {
						$button = check_follow($follow_users, $value['id']) ? '<button id="ajax_uneye" data-id="' . $value['id'] . '"> 取消关注 </button>' : '<button id="ajax_eye" data-id="' . $value['id'] . '"> <font>+</font> 关注</button>';
					} ?>

					<div class="data fl">
						<div class="left_box">
							<a href="./home?uid=<?= $value['id'] ?>" target="_blank"><img src="<?= $value['avatar'] ?>" alt="" class="pic"><img class="god" src="./static/image/god_right.png"></a>
							<?= $button ?>
						</div>
						<div class="right_box">
							<p class="name">
								<a href="./home?uid=<?= $value['id'] ?>" target="_blank"><?= $value['nickname'] ?></a>

								<em style="font-weight: 400;font-size: 16px;" href="javascript:;" target="_blank"><?= $value['level_name'] ?></em>

								<font><img src="static/image/look.png" class="eyes";width="24px" alt=""><?= $value['follower_count'] ?></font>
							</p>
							<p class="desk"><?= $value['god_description'] ?></p>
							<p class="class">正在开的课：<?= $value['god_course_count'] ?>门</p>

					<?php
					$skilled_tags = json_decode($value['god_skilled_tags']);
					foreach (count($skilled_tags) > 0 ? $skilled_tags : array() as $key => $value) {
						echo '<a href="./tag?name='.$value.'" class="tagBox">'.$value.'</a>';
					}
					echo '</div></div>';
				} ?>
			</li>

			<?php
				$this->load->view("miaoda/page",array(
					"page" => $page,
					"page_max" => $page_max,
					"page_count" => 10,
					"page_url" => "./god",
					"hot" => "&type=" . $type_name
				));
			?>
		</ul>
	</div>



</div>
<?php $this->load->view('widgets/footer.php'); ?>

</body>
</html>
