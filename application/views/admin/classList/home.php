	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/olclass.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 3)); ?>
<div class="imgLook">
	<img src="">
</div>

<div class="main">
	<ul class="nav nav-pills" role="tablist">
		<?php $this->load->view('widgets/classList/nav.php' , array("activeNav" => 0)); ?><p style="margin-left:122px;color:#aaa;line-height:34px;">点击课程行可进入相关设置</p>
	</ul>

	<div class="main-content">
		<?php $this->load->view('widgets/admin/window.php'); ?>
		
		<div class="main-data">
	
			<table class="table table-bordered">
				<tr>
					<th >课程名</th>
					<th >视频地址</th>
					<th>添加时间</th>
					<th>描述</th>
					<th width="8%">操作</th>
				</tr>
				{data_list}
				<tr data-id="{id}" >
					<td>{name}</td>
					<td>{video}</td>
					<td>{time}</td>
					<td>{text}</td>
					<td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider"></i></td>
				</tr>
				{/data_list}
			</table>
			<button class="btn btn-primary" style="float:right" id="add-classList"><i class="icon-list"></i> &nbsp;添加课程</button>
		</div>
		
	</div>

</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="./static/js/admin/classList.js"></script>
</body>
</html>
