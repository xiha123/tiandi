	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/problems.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php', array("activeNav" => 4)); ?>

<div class="main">
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active"><a href="#tags" aria-controls="tags" role="tab" data-toggle="tab">问题管理</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tags">
			<table class="table table-bordered">
				<thead><tr>
					<th>标题</th>
					<th width="6%">状态</th>
					<th width="9%">提问者</th>
					<th width="9%">回答者</th>
					<th width="13%">创建时间</th>
					<th width="5%">操作</th>
				</tr></thead>
				<tbody>
				{list}
					<tr data-id="{id}">
						<td>{title}</td>
						<td>{type}</td>
						<td><a href="home?uid={owner_id}">{owner}</a></td>
						<td><a href="home?uid={answer_id}">{answer}</a></td>
						<td>{ctime}</td>
						<td>
							<!--<i class="fa fa-edit" data-toggle="modal" data-target="#editProblem" data-type="edit"></i>-->
							<i class="fa fa-trash" data-type="remove"></i>
						</td>
					</tr>
				{/list}
				</tbody>
			</table><br>
			<?php
				$this->load->view("miaoda/page",array(
					"page" => $page,
					"page_max" => $problem_count,
					"page_count" => 10,
					"page_url" => "./admin/problems",
					"hot" => "",
					"search" => true,
					"search_function_name" => "search('./admin/problems')",
				));
			?>
        </div>
    </div>

	<div class="modal fade" id="editProblem" tabindex="-1" role="dialog" aria-labelledby="editProblemLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="editProblemLabel">编辑问题信息</h4>
				</div>
				<div class="modal-body">
					<form id="problem-edit-form">
						<div class="form-group">
							<label for="problem-edit-form-name">问题名称</label>
							<input type="text" class="form-control" id="problem-edit-form-name" placeholder="问题名称">
						</div>
						<div class="form-group">
							<label for="problem-edit-form-content">问题描述</label>
							<input type="text" class="form-control" id="problem-edit-form-content" placeholder="问题描述">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" data-dismiss="modal" class="btn btn-primary submit-problem-edit">保存</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/problems.js"></script>
</body>
</html>
