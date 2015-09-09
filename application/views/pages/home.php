<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="static/css/home.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php'); ?>

<div class="main">
<!-- 	<div class="stage">
		<ul class="wrapper">
			<li><a href="miaoda"><img src="./static/image/miaodaLogoBlueColor.png" height="33" width="130" class="MiaoDa"></a></li>
			<li><a href="god"><img src="./static/image/god.png" height="90" width="90"></a></li>
			<li><a href="#"><img src="./static/image/study.png" height="90" width="90"></a></li>
			<li><a href="olclass"><img src="./static/image/online.png" height="90" width="90"></a></li>
			<li><a href="#"><img src="./static/image/jingyinghui.png" height="96" width="78"></a></li>
		</ul>
	</div> -->
	<div class="slider" data-widget="slider" data-config='{"interval": 2000}'>
		<ul class="slider-trigger js-slider-trigger">
			{data_list}
			<li></li>
			{/data_list}
		</ul>
		<ul class="slider-sheet js-slider-sheet">
			{data_list}
			<li style="background:{color}"><a href="{link}" target="_blank"><img src="static/uploads/{img}"></a></li>
			{/data_list}
		</ul>
	</div>
		<table class="main">
			<tr><td><img src="./static/image/home/nav.jpg" alt=""></td></tr>
			<tr class="hr"><td><img src="./static/image/home/god.jpg" alt=""></td></tr>
			<tr><td><img src="./static/image/home/problem.jpg" alt=""></td></tr>
			<tr class="hr"><td><img src="./static/image/home/student.jpg" alt=""></td></tr>
			<tr><td><img src="./static/image/home/zhan.jpg" alt=""></td></tr>
			<tr class="hr"><td><img src="./static/image/home/elite.jpg" alt=""></td></tr>
		</table>

		<!-- <h2>在线课堂</h2>
		<ul class="class-list cf">
			<li><a href="./olclass?type=3d"><img src="./static/image/3d.png" height="120" width="120"><p>Unity-3D</p></li>
			<li><a href="./olclass?type=Swift"><img src="./static/image/swit.png" height="120" width="120"><p>Swift</p></li>
			<li><a href="./olclass?type=Web"><img src="./static/image/web.png" height="120" width="120"><p>Web</p></li>
			<li><a href="./olclass?type=Coco"><img src="./static/image/coco.png" height="120" width="120"><p>Cocos2d-x</p></li>
			<li><a href="./olclass?type=Android"><img src="./static/image/Android.png" height="120" width="120"><p>Android</p></li>
		</ul> -->
</div>

<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>
