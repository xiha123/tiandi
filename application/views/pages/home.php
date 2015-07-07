<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="/static/css/home.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php'); ?>

<div class="main">
	<div class="wrapper">
		<div class="slider cf">
			<ul class="slider-trigger fl js-slider-trigger">
				<li class="active"><img src="/static/image/slide1.jpg" height="100" width="200"></li>
				<li><img src="/static/image/slide2.jpg" height="100" width="200"></li>
				<li><img src="/static/image/slide3.jpg" height="100" width="200"></li>
			</ul>
			<ul class="slider-content fl js-slider-content">
				<li class="active">
					<img class="fl" src="/static/image/slide1.jpg" height="310" width="620">
					<div class="fl slider-summary">课程1</div>
				</li>
				<li>
					<img class="fl" src="/static/image/slide2.jpg" height="310" width="620">
					<div class="fl slider-summary">课程2</div>
				</li>
				<li>
					<img class="fl" src="/static/image/slide3.jpg" height="310" width="620">
					<div class="fl slider-summary">课程3</div>
				</li>
			</ul>
		</div>
		<div class="tab">
			<ul>
				<li class="hover"><a href="javascript:void(0)">Unity-3D</a></li>
				<li><a href="javascript:void(0)">Swift</a></li>
				<li><a href="javascript:void(0)">Web</a></li>
				<li><a href="javascript:void(0)">Cocos2d-x</a></li>
				<li><a href="javascript:void(0)">Android</a></li>
			</ul>
			<div class="content">
				content for tab
			</div>
			<div>content for tab</div>
			<div>content for tab</div>
			<div>content for tab</div>
			<div>content for tab</div>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script src="/static/js/home.js"></script>

</body>
</html>
