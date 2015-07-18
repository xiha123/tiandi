	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/home.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php', array("activeNav" => 1)); ?>
<div class="main">
	<div class="main-content">
		<?php $this->load->view('widgets/admin/window.php'); ?>
		<div class="main-title">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="javascript:void(0)" class="add-pic"><i class="icon-dashboard"></i>添加轮播图片</a></li>
			</ul>
		</div>

		<div class="main-data">
			<table class="table table-bordered">
				<tr>
					<th width="45%">标题</th>
					<th width="10%">地址</th>
					<th width="16%">添加时间</th>
					<th>描述</th>
					<th width="8%">操作</th>
				</tr>
				{data_list}
				<tr  data-id="{id}" data-img="{img}"  data-color="{color}" data-link="{link}" ><td>{title}</td><td><a href="{link}">点击浏览</a></td><td>{time}</td><td>{text}</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider"></i></td></tr>
				{/data_list}
			</table>
			<!--
			<div class="page">
				<font>共 0 页，当前正在第 0 页，共有数据 0 条</font>
				<div class="right">
					<input type="submit" value="上一页">
					<form action="#" method="get">
						<input type="text" placeholder="页数">
						<input type="submit" value="跳转" style="margin-left:-5px;">
					</form>
					<input type="submit" value="下一页">
				</div>
			</div>
			
			-->
		</div>
	</div>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/slider.js"></script>

</body>
</html>
