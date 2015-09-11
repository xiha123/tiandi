<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="static/css/admin/classListSite.css" type="text/css" />
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 3)); ?>
	<script>
		id = "{type}";
	</script>
	<div class="main">
		<div class="main-content">
			<?php $this->load->view('widgets/admin/window.php'); ?>
			<div class="main-title">
				<ul class="nav nav-pills title">
					<?php
						switch ($class_type) {
							case 'tag':$activeNav = 1;break;
							case 'description':$activeNav = 2;break;
							case 'chapter':$activeNav = 4;break;
							case 'pic':$activeNav = 5;break;
							case 'step':$activeNav = 6;break;
							default:$activeNav = 1;$class_type = "tag";break;
						}
					 $this->load->view('widgets/classList/min.nav.php' , array("activeNav" =>$activeNav)); ?>
					<li style="float:right;font-weight:700"><p>当前操作的课程详情页：{title}</p></li>
				</ul>
			</div>

			<div class="main-data">
				<?php $this->load->view('widgets/admin/footer.php'); ?>
				<?php $this->load->view('admin/classList/site/'.$class_type.'.php' , array("activeNav" =>$activeNav)); ?>
			</div>


		</div>
	</div>
	<link rel="stylesheet" href="./static/css/datepicker.css">
	  <script src="./static/lib/bootstrap-datepicker.js"></script>
	<script src="./static/js/admin/classListSite.js"></script>

</body>
</html>
