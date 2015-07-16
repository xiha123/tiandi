<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="./static/css/olClass.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php', array( "activeNav" => 0 )); ?>

<div class="main">
	<div class="wrapper">
		<div class="slider cf" data-widget="slider">
			<ul class="slider-trigger fl js-slider-trigger">
				<li><img src="./static/image/slide1.jpg" height="120" width="200"></li>
				<li><img src="./static/image/slide2.jpg" height="120" width="200"></li>
				<li><img src="./static/image/slide3.jpg" height="120" width="200"></li>
			</ul>
			<ul class="slider-sheet fl js-slider-sheet">
				<li>
					<img src="./static/image/slide1.jpg" height="370" width="615">
					<div class="slider-summary">课程1</div>
				</li>
				<li>
					<img src="./static/image/slide2.jpg" height="370" width="615">
					<div class="slider-summary">课程2</div>
				</li>
				<li>
					<img src="./static/image/slide3.jpg" height="370" width="615">
					<div class="slider-summary">课程3</div>
				</li>
			</ul>
		</div>
		<div class="tab" data-widget="tab">
			<ul class="tab-trigger cf js-tab-trigger">
				<li><a href="javascript:void(0)">Unity-3D</a></li>
				<li><a href="javascript:void(0)">Swift</a></li>
				<li><a href="javascript:void(0)">Web</a></li>
				<li><a href="javascript:void(0)">Cocos2d-x</a></li>
				<li><a href="javascript:void(0)">Android</a></li>
			</ul>
			<ul class="tab-sheet js-tab-sheet">
				<li>content1</li>
				<li>content2</li>
				<li>content3</li>
				<li>content4</li>
				<li>content5</li>
			</ul>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script src="./static/js/olClass.js"></script>

</body>
</html>