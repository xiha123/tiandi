	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/tags.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php', array("activeNav" => 4)); ?>

<div class="main">
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active"><a href="#tags" aria-controls="tags" role="tab" data-toggle="tab">标签管理</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tags">
			<table class="table table-bordered">
				<thead><tr>
					<th width="10%">名字</th>
					<th width="10%">类型</th>
					<th width="10%">数量</th>
					<th width="60%">描述</th>
					<th width="10%">操作</th>
				</tr></thead>
				<tbody>
				{tags}
					<tr data-id="{id}">
						<td>{name}</td>
						<td>{type}</td>
						<td>{count}</td>
						<td>{content}</td>
						<td>
							<i class="fa fa-edit" data-toggle="modal" data-target="#editTag" data-type="edit"></i>
							<i class="fa fa-trash" data-type="remove"></i>
						</td>
					</tr>
				{/tags}
				</tbody>
			</table>
        </div>
    </div>

	<div class="modal fade" id="editTag" tabindex="-1" role="dialog" aria-labelledby="editTagLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="editTagLabel">编辑标签信息</h4>
				</div>
				<div class="modal-body">
					<form id="tag-edit-form">
						<div class="form-group">
							<label for="tag-edit-form-name">标签名称</label>
							<input type="text" class="form-control" id="tag-edit-form-name" placeholder="标签名称">
						</div>
						<div class="form-group">
							<label for="tag-edit-form-content">标签描述</label>
							<input type="text" class="form-control" id="tag-edit-form-content" placeholder="标签描述">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" data-dismiss="modal" class="btn btn-primary submit-tag-edit">保存</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/tags.js"></script>
</body>
</html>
