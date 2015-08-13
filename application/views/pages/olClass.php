<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="static/css/olClass.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php', array( "activeNav" => 0 )); ?>

<div class="main">
	<div class="wrapper">
		<div class="slider cf" data-widget="slider">
			<ul class="slider-trigger fl">
			{guide_list}
				<li><a href="{link}" target=""><img src="./static/uploads/{img}" height="120" width="200"></a></li>
			{/guide_list}

			</ul>
			<ul class="slider-sheet fl js-slider-sheet">

			<?php
				foreach ($slide_list as $key => $value) {
					echo '<li><img src="./static/uploads/'.@$value['site']['img'] . '" height="370" width="615"><div class="slider-summary"><p>公开课</p><p>{public} {title} {/public}</p></div><div class="slider-summary"><p>付费课</p><p>{class} {title} {/class}</p></div></li>';
				}
			?>

			</ul>
			<ul class="js-slider-trigger">
				{slide_list}
				<li><a href="javascript:void(0)"></a></li>
				{/slide_list}
			</ul>
		</div>
		<div class="tab" data-widget="tab" style="height:530px;">
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
						<div class="description">
							<h2>U3D快速入门 <i class="fa fa-arrow-circle-right"></i></h2>
							<p>内内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容容内容内内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容内容容内容内内容内容内容内容内容内容内容内容内容内容内容</p>
						</div>
						<ul class="list">
							<li><h3>Step 1</h3><p>内容内内容内容内容内容内容内容内容内容内容内容内</p><i class="fa fa-arrow-right"></i></li>
							<li><h3>Step 2</h3><p>内容内内容内容内容内容内容内容内容内容内容内容内</p><i class="fa fa-arrow-right"></i></li>
							<li><h3>Step 3</h3><p>内容内内容内容内容内容内容内容内容内容内容内容内</p><i class="fa fa-arrow-right"></i></li>
							<li class="last"><h3>Step 4</h3><p>内容内内容内容内容内容内容内容内容内容内容内容内</p><i class="fa fa-arrow-down bottom"></i></li>

							<li><h3>Step 8</h3><p>内容内内容内容内容内容内容内容内容内容内容内容内</p><i class="fa fa-arrow-left"></i></li>
							<li><h3>Step 7</h3><p>内容内内容内容内容内容内容内容内容内容内容内容内</p><i class="fa fa-arrow-left"></i></li>
							<li><h3>Step 6</h3><p>内容内内容内容内容内容内容内容内容内容内容内容内</p><i class="fa fa-arrow-left"></i></li>
							<li class="last"><h3>Step 5</h3><p>内容内内容内容内容内容内容内容内容内容内容内容内</p></li>
						</ul>
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
