<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="../static/css/admin/home.css" type="text/css" />
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 2)); ?>
<div class="imgLook">
	<img src="">
</div>
	<div class="main">
		<div class="main-content">
			<?php $this->load->view('widgets/admin/window.php'); ?>
			<div class="main-title">
				<ul class="nav nav-pills">
					<?php $this->load->view('widgets/online/nav.php' , array("activeNav" => 1)); ?>
				</ul>
			</div>

			<div class="main-data">
				<table class="table table-bordered">
					<tr>
						<th width="40%">标题</th>
						<th width="8%">地址</th>
						<th width="8%">操作</th>
					</tr>
					<tbody>
					{data_list}
					<tr data-id="{id}" data-img="{img}" data-color="{color}" data-link="{link}">
						<td>{name}</td>
						<td><a href="{link}">点击浏览</a></td>
						<td><i class="fa fa-edit edit-guide"></i></td>
					</tr>
					{/data_list}
					</tbody>
				</table>
			</div>


		</div>
	</div>
	<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/online/onlineGoTo.js"></script>

</body>
</html>
