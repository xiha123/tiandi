<?php
	$this->load->view('widgets/header.php');
	$active = 'class="active"';
?>
	<link rel="stylesheet" href="static/css/tanchuang_main.css"/>
	<link rel="stylesheet" href="static/css/olClass.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php', array( "activeNav" => 3 )); ?>
<div class="windows" >
<div class="box" id="box">
	<div>
		<img src="" width="480" height="275">
		<div class="title">
			<div class="close fr"></div>
			<h2 id="titleName">重点一</h2>
			<div class="level">
				<h3>难度</h3>
				 <!--<i class="fa fa-star"></i> -->
			</div>
		</div>
		<p class="content"></p>
	</div>
	<div class="button">
		<a href="<?=!isset($site['link']) ? "javascript:;" : $site['link'];?>"><button>报 名 <i class="fa fa-arrow-circle-right"></i></button></a>
	</div>
</div>
</div>

<div class="main">
	<div class="wrapper">
		<div class="slider cf" data-widget="slider">
			<ul class="slider-trigger fl">
			{guide_list}
				<li><a href="{link}" target=""><img src="./static/uploads/{img}" height="120" width="200"></a></li>
			{/guide_list}
			</ul>

			<ul class="slider-sheet fl js-slider-sheet">
			{slide_list}
				<li><a href="{link}"><img src="./static/uploads/{img}" height="370" width="615"></a></li>
			{/slide_list}
			</ul>

			<ul class="js-slider-trigger">
			{slide_list}
				<li><a href="javascript:void(0)"></a></li>
			{/slide_list}
			</ul>
			<div class="slider-summary"><p>课程</p><p>{schedule_course}</p></div>
			<div class="slider-summary"><p>课表</p><p>{schedule_date}</p></div>
		</div>
		<div class="tab">
			<ul class="tab-trigger cf js-tab-trigger">
				<li data-id="3d" <?=$types == 0 ? $active :"" ?>><a href="./olclass?type=u3d">Unity-3D</a></li>
				<li data-id="swift" <?=$types == 1 ? $active :"" ?>><a href="./olclass?type=Swift">Swift</a></li>
				<li data-id="Web" <?=$types == 2 ? $active :"" ?>><a href="./olclass?type=Web">Web</a></li>
				<li data-id="Cocos2d-x" <?=$types == 3 ? $active :"" ?>><a href="./olclass?type=Cocos2d-x">Cocos2d-x</a></li>
				<li data-id="Android" <?=$types == 4 ? $active :"" ?>><a href="./olclass?type=Android">Android</a></li>
			</ul>
			<ul class="tab-sheet">
				{course_list}
				<div class="course">
					<div class="description cf">
						<h2><a href="course?id={id}">{title}<i class="fa fa-arrow-circle-right"></i></a></h2>
						<span>{description}</span>
					</div>
					<ul class="list">
						{class}
							<li class="{li_class} {float}" data-description="{description}" data-title="{title}" data-index='{class}' data-img='{img}' data-level='{level}'>
								<h3>Step {step}</h3>
								<p>{title}</p>
								{type}
							</li>
						{/class}
					</ul>
				</div>
				{/course_list}
			</ul>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script src="static/js/olClass.js"></script>

</body>
</html>
