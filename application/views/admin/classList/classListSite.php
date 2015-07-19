<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="static/css/admin/classListSite.css" type="text/css" />
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 3)); ?>
	<script>
		id = "{id}";
	</script>
	<div class="main">
		<div class="main-content">
			<?php $this->load->view('widgets/admin/window.php'); ?>
			<div class="main-title">
				<ul class="nav nav-pills title">
					<li class="active"><a href="admin/classList"><i class="icon-arrow-left"></i><font>返回</font></a></li>
					<li><p>当前操作的课程详情页：{data_list}{name}{/data_list}</p></li>
				</ul>
			</div>
			
			<div class="main-data">
					<div class="site-box">
						<h2>课程特色介绍</h2><br>
						<table class="table table-bordered">
							<tr>
								<th width="40%">名称</th>
								<th width="8%">地址</th>
								<th width="8%">操作</th>
							</tr>
							{data_tag}
							<tr data-id="{id}">
								<td>{name}</td>
								<td><a href="{url}">点击浏览</a></td>
								<td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-tag"></i></td>
							</tr>
							{/data_tag}
						</table>
						<button class="btn btn-primary" style="float:right" id="add-classList"><i class="icon-list"></i> &nbsp;添加课程特色</button>
					</div>
					<div class="site-box">
						<h2>报名按钮</h2><br>
						<table>

							<tr>
								<td>报名按钮地址：</td>
								<td><input type="text" class="link" value="{data_list}{link}{/data_list}" placeholder="请在此处填写报名地址"></td>
							</tr>
							<tr>
								<td>课程详情描述：</td>
								<td><textarea  name="direction" class="direction" placeholder="请在此处填写课程详情描述">{data_list}{direction}{/data_list}</textarea></td>
								<td><button class="btn btn-primary" style="float:right" id="save-link" data-id="{id}"><i class="icon-save"></i> &nbsp;保存</button></td>
							</tr>
						</table>
					</div>
					<div class="site-box">
						<h2>课程内容章节设置</h2><br>
						<table class="table table-bordered">
							<tr>
								<th width="40%">名称</th>
								<th>内容</th>
								<th width="8%">操作</th>
							</tr>
							{data_chapter}
							<tr data-id="{id}">
								<td>{title}</td>
								<td>{content}</td>
							</tr>
							{/data_chapter}
						</table>
						<button class="btn btn-primary" style="float:right" id="add-classContent"><i class="icon-list"></i> &nbsp;添加课程</button>

					</div>
					
					
					
			</div>
			

		</div>
	</div>
	<?php $this->load->view('widgets/admin/footer.php'); ?>
	<script src="static/js/admin/classListSite.js"></script>

</body>
</html>
