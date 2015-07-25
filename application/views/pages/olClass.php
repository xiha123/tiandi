<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="static/css/olClass.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php', array( "activeNav" => 0 )); ?>

<div class="main">
	<div class="wrapper">
		<div class="slider cf" data-widget="slider">
			<ul class="slider-trigger fl">
			{data_left}
				<li><a href="{link}" target=""><img src="./static/uploads/{img}" height="120" width="200"></a></li>
			{/data_left}

			</ul>
			<ul class="slider-sheet fl js-slider-sheet">
			{data_list}
				<li>
					<img src="./static/uploads/{url}" height="370" width="615">
					<div class="slider-summary">
						<p>公开课</p>
						<p>{public} {title} {/public}</p>
					</div>
					<div class="slider-summary">
						<p>付费课</p>
						<p>{class} {title} {/class}</p>
					</div>
				</li>
			{/data_list}
			</ul>
			<ul class="js-slider-trigger">
				{data_list}
				<li><a href="javascript:void(0)"></a></li>
				{/data_list}
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
