	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/slider.css">
</head>

<body>
<div class="imgLook">
	<img src="#">
</div>

<?php $this->load->view('widgets/admin/left.php', array("activeNav" => 1)); ?>
<div class="main">
	<div class="main-content">
		<?php $this->load->view('widgets/admin/window.php'); ?>
		<div class="main-title">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="javascript:void(0)" class="add-pic"><i class="fa fa-plus icon-dashboard"></i>添加轮播图片</a></li>
			</ul>
		</div>

		<div class="main-data">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="35%">标题</th>
						<th width="20%">地址</th>
						<th width="20%">描述</th>
						<th width="10%">操作</th>
					</tr>
				</thead>
				<tbody>
					{data_list}
					<tr data-id="{id}" data-img="{img}" data-color="{color}" data-link="{link}">
						<td>{name}</td>
						<td><a href="{link}">点击浏览</a></td>
						<td>{text}</td>
						<td><i class="fa fa-edit edit-slider"></i><i class="fa fa-trash remove-slider"></i></td>
					</tr>
					{/data_list}
				</tbody>
			</table>
			
			<?php
				$this->load->view("miaoda/page",array(
					"page" => 1,
					"page_max" => 200,
					"page_count" => 10,
					"page_url" => "./admin/slider",
					"hot" => ""
				));
			?>

		</div>
	</div>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/slider.js"></script>

</body>
</html>
