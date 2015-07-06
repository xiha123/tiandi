<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="/static/css/home.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php'); ?>

<div class="main">
	<div class="wrapper">


		<div class="slider">
			<div class="left-slider">
				<ul>
					<li><i style="display:none"></i><img src="http://file05.16sucai.com/2015/0619/6557051ab76ea70cbbf2960c04c5559b.jpg" /></li>
					<li><i></i><img src="http://file05.16sucai.com/2015/0619/c345c9b05a75ce12c34ffd873a563de5.jpg" /></li>
					<li><i></i><img src="http://file05.16sucai.com/2015/0619/14d07995bcf1ec7a5d5c0e2d935e40c1.jpg" /></li>
				</ul>
			</div>
			<div class="center-slider">
				<img src="http://file05.16sucai.com/2015/0619/6557051ab76ea70cbbf2960c04c5559b.jpg" class="one"/>
				<img src="" class="lost"/>
			</div>
			<div class="right-slider">
				<div class="right-data" style="display:block">
					<div class="slider-content">
						课程1
					</div>
					<div class="slider-content">
						课表1
					</div>
				</div>

				<div class="right-data">
					<div class="slider-content">
						课程2
					</div>
					<div class="slider-content">
						课表2
					</div>
				</div>

				<div class="right-data">
					<div class="slider-content">
						课程3
					</div>
					<div class="slider-content">
						课表3
					</div>
				</div>


			</div>
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
