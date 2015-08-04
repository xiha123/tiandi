<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/seconds/tacher.css">
<body>
<?php 
	$this->load->view('widgets/seconds/nav.php' , array("activeNav" => 0)); 
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
			<p class="not">还没有收藏标签</p>
			<!-- <a href="#" class="tag-box"></a> -->
		</div>



		<div class="tacher-why">
			<div class="tab" data-widget="tab" >
				<ul class="title  cf js-tab-trigger" data-widget="tab" >
					<li class="active"><a href="javascript:">收藏</a></li>
					<li><a href="javascript:">关注</a></li>
					<li><a href="javascript:">问过</a></li>
				</ul>
				<ul class="list-data tab-sheet  js-tab-sheet">
					<li>
						<ul class="list-data">
							<li>
								<div class="link-num"><p>999</p><p>点赞</p></div>
								<div class="list-title">哈哈哈哈哈哈哈哈哈哈哈哈哈哈哈</div>
								<ul class="list-tag">
									<li><a href="#" class="tag-box">html5</a></li>
									<li><a href="#" class="tag-box">javascript</a></li>
									<li><a href="#" class="tag-box">jquery</a></li>
								</ul>
								<div class="list-date">大神 <font>Tocurd</font> 回答于：20:30</div>
							</li>
						</ul>
						<div class="page">
							<ul>
								<li><a href="javascript:">< 上一页</a></li>
								<li class="active"><a href="javascript:">1</a></li>
								<li><a href="javascript:">2</a></li>
								<li><a href="javascript:">3</a></li>
								<li><a href="javascript:">下一页 ></a></li>
							</ul>
						</div>
					</li>




				</ul>
			</div>




			
		</div>

	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>