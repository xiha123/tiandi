	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/olclass.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 2)); ?>
<div class="imgLook">
	<img src="">
</div>

<div class="main">
	<ul class="nav nav-pills" role="tablist">
		<?php $this->load->view('widgets/online/nav.php' , array("activeNav" => 0)); ?>
	</ul>

	<div class="main-content">
		<?php $this->load->view('widgets/admin/window.php'); ?>

		<div class="main-data">
			<table class="table table-bordered">
				<tr>
					<th width="40%">标题</th>
					<th width="8%">地址</th>
					<th width="16%">添加时间</th>
					<th>描述</th>
					<th width="8%">操作</th>
				</tr>
				{data_list}
				<tr data-id="{id}" data-img="{img}" data-color="{color}" data-link="{link}">
					<td>{title}</td>
					<td><a href="{link}">点击浏览</a></td>
					<td>{time}</td>
					<td>{text}</td>
					<td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider"></i></td>
				</tr>
				{/data_list}
			</table>
		</div>
	</div>

</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/online/onlineSlider.js"></script>
</body>
</html>
