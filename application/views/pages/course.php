<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="static/css/course.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php'); ?>

<div class="main">
	<div class="wrapper cf">
		<div class="fr sidebar">
			<h2>推荐课程</h2>
			<ul>
				<li><a href="#">课程1</a></li>
				<li><a href="#">课程1</a></li>
				<li><a href="#">课程1</a></li>
				<li><a href="#">课程1</a></li>
				<li><a href="#">课程1</a></li>
			</ul>
		</div>
		<div class="intro fl">
			<div class="intro-title">
				<a class="fr" href="javascript:;">分享</a>
				<h1>{name}</h1>
			</div>
			<div class="intro-video">
				<iframe height="100%" width="100%" src="{video}" frameborder=0 allowfullscreen></iframe>
			</div>
		</div>
		<div class="content fl">
			<div class="content-tag">
				<div class="reg">
					<a class="fr" href="{link}">报名</a>
				</div>
				<ul class="cf">
					{tag}
					<li><a href="{url}" target="_blank">{tag}</a></li>
					{/tag}
				</ul>
			</div>
			<p class="content-description">{description}</p>
			<div class="content-outline cf">
				<h2>课程大纲</h2>
				<div class="line"></div>
				
				{data_list}
				<div class="{float}">
					<h3>{title}</h3>
					<i></i>
					<p>{content}</p>
				</div>
				{/data_list}

			</div>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<!--<script src="./static/js/course.js"></script>-->

</body>
</html>
