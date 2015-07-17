<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="static/css/home.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php'); ?>

<div class="main">
	<div class="stage">
		<ul class="wrapper">
			<li><a href="./olclass"><img src="./static/image/online.png" height="90" width="90"></a></li>
			<li><a href="#"><img src="./static/image/problem.png" height="90" width="90"></a></li>
			<li><a href="#"><img src="./static/image/study.png" height="90" width="90"></a></li>
			<li><a href="#"><img src="./static/image/god.png" height="90" width="90"></a></li>
			<li><a href="#"><img src="./static/image/Tree.png" height="90" width="90"></a></li>
		</ul>
	</div>
	<div class="slider" data-widget="slider" data-config='{"interval": 2000}'>
		<ul class="slider-trigger js-slider-trigger">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li class="last"></li>
		</ul>
		<ul class="slider-sheet js-slider-sheet">
			<li style="background:#cc0000"></li>
			<li style="background:#FCC0FD"></li>
			<li style="background:#000"></li>
			<li style="background:#0036ff"></li>
			<li style="background:#F0F"></li>
		</ul>
	</div>
	<div class="wrapper">
		<h2>在线课堂</h2>
		<ul class="class-list cf">
			<li><a href="./olclass#3d"><img src="./static/image/3d.png" height="120" width="120"><p>Unity-3D</p></li>
			<li><a href="./olclass#swift"><img src="./static/image/swit.png" height="120" width="120"><p>Swift</p></li>
			<li><a href="./olclass#web"><img src="./static/image/web.png" height="120" width="120"><p>Web</p></li>
			<li><a href="./olclass#coco"><img src="./static/image/coco.png" height="120" width="120"><p>Cocos2d-x</p></li>
			<li><a href="./olclass#android"><img src="./static/image/Android.png" height="120" width="120"><p>Android</p></li>
		</ul>
	</div>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<!--<script src="./static/js/home.js"></script>-->

</body>
</html>
