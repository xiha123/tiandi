	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/tags.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 8)); ?>

<div class="main">
	<div class="navbar navbar-default">
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTag"><i class="fa fa-add"></i>上传视频</button>
		<form class="form-inline fr" action="javascript:;" onsubmit="search('./admin/tags')">
			<div class="input-group">
				<input type="text" class="form-control" id="searchName" placeholder="搜索">
				<div class="input-group-addon"><button class="search"><i class="fa fa-search"></i></button></div>
			</div>
		</form>
	</div>
   
   
   
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/olclass.js"></script>
</body>
</html>
