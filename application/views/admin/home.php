<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="../static/css/admin/home.css" type="text/css" />
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 0)); ?>
	<div class="main">
		<div class="main-content">
			<div class="main-title">
				<ul class="nav nav-pills">
					<li role="presentation" class="active"><a href="#"><i class="icon-home"></i>首页</a></li>
					<li role="presentation"><a href="#">首页轮播设置</a></li>
					<li role="presentation"><a href="#">课程表设置</a></li>
				</ul>
			</div>
			
			<div class="main-data">
				<h1>欢迎来到后台管理系统，这个页面将会在日后完善</h1>
			</div>


		</div>
	</div>
	
</body>
</html>