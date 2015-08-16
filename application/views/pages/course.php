<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="static/css/course.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php'); ?>
<?php $this->load->view('widgets/windows.php' ); ?>

<div class="main">
	<div class="wrapper cf">
		<div class="fr sidebar">
			<h2>推荐课程</h2>
			<ul>
				<li><a href="./course?id=0">Unity-3D</a></li>
				<li><a href="./course?id=1">Swift</a></li>
				<li><a href="./course?id=2">Web</a></li>
				<li><a href="./course?id=3">Cocos2d-x</a></li>
				<li><a href="./course?id=4">Android</a></li>
			</ul>
		</div>
		<div class="intro fl">
			<div class="intro-title">
				<a class="fr" href="javascript:;">分享</a>
				<h1><?=$courseData['title']?></h1>
			</div>
			<div class="intro-video">
				<iframe height="100%" width="100%" src="<?=$courseData['video']?>" frameborder=0 allowfullscreen></iframe>
			</div>
		</div>
		<div class="content fl">
			<div class="content-tag">
				<div class="reg">
					<a class="fr" href="<?=@$courseData['site']['link']?>">报名<img src="./static/image/sign-up.png"></a>
				</div>
				<ul class="cf">
				<?php
					foreach ($courseData['tags'] as $key => $value) {
						echo '<li><a href="'.$value['link'].'" target="_blank">'.$value['name'].'</a></li>';
					}
				?>
				</ul>
			</div>
			<p class="content-description"><?=$courseData['description']?></p>
			<div class="content-outline cf">
				<h2>课程大纲</h2>
				<div class="line"></div>
				<?php
					$index = 0;
					foreach ($chapters as $key => $value) {
						$float = $index % 2 == 0 ? "fl" : "fr";
						echo '<div class="'.$float.'"><h3>'.$value['title'].'</h3><i></i><p>'.$value['content'].'</p></div>';
						$index ++;
					}
				?>

			</div>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<!--<script src="./static/js/course.js"></script>-->

</body>
</html>
