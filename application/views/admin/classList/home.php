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
					<th  width="18%">视频地址</th>
					<th width="58%">描述</th>
					<th width="8%">操作</th>
				</tr>
				{data_list}
				<tr data-id="{id}" data-type="{id}"  >
					<td>{title}</td>
					<td>{video}</td>
					<td>{description}</td>
					<td><i class="fa fa-edit edit-slider"></i></td>
				</tr>
				{/data_list}

			</table>
			<?php
				$this->load->view("miaoda/page",array(
					"page" => $page,
					"page_max" => $course_max,
					"page_count" => 10,
					"page_url" => "./admin/classList",
					"hot" => ""
				));
			?>
		</div>
		
	</div>

</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="./static/js/admin/classList.js"></script>
</body>
</html>
