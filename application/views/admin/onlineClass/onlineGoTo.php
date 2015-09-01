	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/onlineGuide.css" type="text/css" />
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 2)); ?>

<div class="main">
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active"><a href="#guide" aria-controls="guide" role="tab" data-toggle="tab">新手指南</a></li>
        <li role="presentation"><a href="#slide" aria-controls="slide" role="tab" data-toggle="tab">在线课堂轮播</a></li>
        <li role="presentation"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab">课表信息</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="guide">
			<table class="table table-bordered">
				<thead><tr>
					<th width="40%">标题</th>
					<th width="30%">图片</th>
					<th width="20%">链接</th>
					<th width="10%">操作</th>
				</tr></thead>
				<tbody>
				{guide_list}
					<tr data-id="{id}" data-img="{img}">
						<td>{name}</td>
						<td><a href="static/uploads/{img}">{img}</a></td>
						<td><a href="{link}">{link}</a></td>
						<td>
							<i class="fa fa-edit" data-toggle="modal" data-target="#editGuide" data-type="edit"></i>
						</td>
					</tr>
				{/guide_list}
				</tbody>
			</table>
        </div>
        <div role="tabpanel" class="tab-pane" id="slide">
			在线课堂轮播
        </div>
        <div role="tabpanel" class="tab-pane" id="schedule">
			<form id="schedule-form" onsubmit="editSchedule()">
				<div class="form-group">
					<label for="schedule-form-course">课程</label>
					<textarea class="form-control" id="schedule-form-course" placeholder="课程内容">{schedule_course}</textarea>
				</div>
				<div class="form-group">
					<label for="schedule-form-date">课表</label>
					<textarea class="form-control" id="schedule-form-date" placeholder="课表内容">{schedule_date}</textarea>
				</div>
				<button type="submit" class="btn btn-success">修改</button>
			</form>
        </div>
    </div>

	<div class="modal fade" id="editGuide" tabindex="-1" role="dialog" aria-labelledby="editGuideLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="editGuideLabel">编辑新手指南</h4>
				</div>
				<div class="modal-body">
					<form id="guide-edit-form" method="post" action="api/guide_api/edit_guide" enctype="multipart/form-data" onsubmit="editGuide()">
						<input class="hidden" name="id">
						<div class="form-group">
							<label for="guide-edit-form-name">名称</label>
							<input type="text" class="form-control" id="guide-edit-form-name" placeholder="名称" name="title">
						</div>
						<div class="form-group">
							<label for="guide-edit-form-link">链接</label>
							<input type="text" class="form-control" id="guide-edit-form-link" placeholder="链接" name="link">
						</div>
						<div class="form-group">
							<label for="guide-edit-form-img">图片</label>
							<label><img src="" width="100%"><input class="hidden" type="file" name="userfile"></label>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" data-dismiss="modal" class="btn btn-primary submit-guide-edit">保存</button>
				</div>
			</div>
		</div>
	</div>

</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/online/onlineGoTo.js"></script>

</body>
</html>
