<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="./static/css/home.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php'); ?>

<div class="main">
	<div class="header-image">
		<div class="wrapper">
			<ul>
				<li><i></i><img src="./static/image/online.png"></li>
				<li><i></i><img src="./static/image/problem.png"></li>
				<li><i></i><img src="./static/image/study.png"></li>
				<li><i></i><img src="./static/image/god.png"></li>
				<li><i></i><img src="./static/image/Tree.png"></li>
			</ul>
		</div>
	</div>
	<div class="Carousel" data-widget="slider" data-config='{"interval": 2000}'>
		<ul class="Carousel-nav js-slider-trigger">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
		<ul class="Carousel-image js-slider-sheet">
			<!-- li内的颜色为模拟图片展现-->
			<li style="background:#cc0000"></li>
			<li style="background:#FCC0FD"></li>
			<li style="background:#000"></li>
			<li style="background:#0036ff"></li>
			<li style="background:#F0F"></li>
		</ul>
	</div>
	<div class="wrapper main">
		<h2>在线课堂</h2>
		<ul class="classList">
			<li><img src="./static/image/3d.png"><p>Unity-3D</p></li>
			<li><img src="./static/image/swit.png"><p>Swift</p></li>
			<li><img src="./static/image/web.png"><p>Web</p></li>
			<li><img src="./static/image/coco.png"><p>Cocos2d-x</p></li>
			<li><img src="./static/image/Android.png"><p>Android</p></li>
		</ul>
	</div>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script src="./static/js/home.js"></script>

</body>
</html>
