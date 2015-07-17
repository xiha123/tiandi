<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="../static/css/admin/home.css" type="text/css" />
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 2)); ?>
	<div class="main">
		<div class="main-content">
			<?php $this->load->view('widgets/admin/window.php'); ?>
			<div class="main-title">
				<ul class="nav nav-pills">
					<?php $this->load->view('widgets/admin/onlineClass/nav.php' , array("activeNav" => 2)); ?>
				</ul>
			</div>
			
			<div class="main-data">
				13				
			</div>
			

		</div>
	</div>
	<?php $this->load->view('widgets/admin/footer.php'); ?>
	<script src="../static/js/admin/slider.js"></script>

</body>
</html>