<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="static/css/olClass.css">
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
					<div class="slider-summary">
						<p>课程</p>
						<p>内容啊内容内容啊内内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容容</p>
					</div>
					<div class="slider-summary">
						<p>课表</p>
						<p>内容啊内容内容啊内内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容内容啊内容容</p>
					</div>
				</li>
				<li>
					<img src="./static/image/slide2.jpg" height="370" width="615">
					<div class="slider-summary">
						<p>课程</p>
						<p>222222222222222222222222222222222222</p>
					</div>
					<div class="slider-summary">
						<p>课表</p>
						<p>222222222222222222222222222222222222222222222222</p>
					</div>
				</li>
				<li>
					<img src="./static/image/slide3.jpg" height="370" width="615">
					<div class="slider-summary">
						<p>课程</p>
						<p>33333333333333333333333333333</p>
					</div>
					<div class="slider-summary">
						<p>课表</p>
						<p>3333333333333333333333333333333333333333333333333333</p>
					</div>
				</li>
			</ul>
		</div>
		<div class="tab" data-widget="tab">
			<ul class="tab-trigger cf js-tab-trigger">
				<li data-id="3d"><a href="javascript:void(0)">Unity-3D</a></li>
				<li data-id="swift"><a href="javascript:void(0)">Swift</a></li>
				<li data-id="web"><a href="javascript:void(0)">Web</a></li>
				<li data-id="coco"><a href="javascript:void(0)">Cocos2d-x</a></li>
				<li data-id="android"><a href="javascript:void(0)">Android</a></li>
			</ul>
			<ul class="tab-sheet js-tab-sheet">
				<li>
					<div class="course">
						<h2>U3D快速入门</h2>
						<p>内内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容容内容</p>
					</div>
				</li>
				<li>content2</li>
				<li>content3</li>
				<li>content4</li>
				<li>content5</li>
			</ul>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script src="static/js/olClass.js"></script>

</body>
</html>