	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/god_class.css" type="text/css" />
</head>

<body>
<?php
    $this->load->view('widgets/admin/window.php' );
    $this->load->view('widgets/admin/left.php' , array("activeNav" => 6));
?>

<div class="main">
	<ul class="nav nav-pills fl">
		<li role="presentation"><a href="./admin/user"><i class="fa fa-users"></i>用户管理</a></li>
		<li role="presentation"><a href="./admin/god_apply"><i class="fa fa-check-square"></i>大神审核</a></li>
		<li role="presentation" class="active"><a href="javascript:;"><i class="fa fa-puzzle-piece"></i>大神课程</a></li>
		<li class="fr">
			<form class="form-inline fr" action="javascript:;" onsubmit="search('./admin/god_class')">
				<div class="input-group">
					<input type="text" class="form-control" id="searchName" placeholder="搜索">
					<div class="input-group-addon"><button class="search"><i class="fa fa-search"></i></button></div>
				</div>
			</form>
		</li>
        <li class="fr">
            <a href="#" data-target="#add" data-toggle="modal"><i class="fa fa-plus"></i></a>
        </li>
	</ul>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="40%">标题</th>
                <th width="20%">图片</th>
                <th width="20%">链接</th>
                <th width="10%">所属大神</th>
                <th width="10%">操作</th>
            </tr>
        </thead>
        <tbody>
            {course}
            <tr data-id="{id}" data-img="{img}" data-color="{color}" data-link="{link}">
                <td>{title}</td>
                <td>{img}</td>
                <td>{link}</td>
                <td>{god}</td>
                <td><i class="fa fa-edit edit-user"></i><i class="fa fa-trash remove-user"></i></td>
            </tr>
            {/course}
        </tbody>
    </table>

	<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="addLabel">添加课程</h4>
				</div>
				<div class="modal-body">
					<form id="add-form">
						<div class="form-group">
							<label for="add-form-title">标题</label>
							<input type="text" class="form-control" name="title" id="add-form-title" placeholder="标题">
						</div>
						<div class="form-group">
							<label for="add-form-img">图片URL</label>
							<input type="text" class="form-control" name="img" id="add-form-img" placeholder="图片URL">
						</div>
						<div class="form-group">
							<label for="add-form-link">链接</label>
							<input type="text" class="form-control" name="link" id="add-form-link" placeholder="链接">
						</div>
						<div class="form-group">
							<label for="add-form-god">所属大神</label>
							<input type="text" class="form-control" name="god" id="add-form-god" placeholder="所属大神昵称">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" data-dismiss="modal" class="btn btn-success submit-course-add">添加</button>
				</div>
			</div>
		</div>
	</div>

    <?php $this->load->view("miaoda/page",array(
        "page" => $page,
        "page_max" => $course_count,
        "page_count" => $page_count,
        "page_url" => "./admin/god_class",
        "hot" => "",
    )); ?>

</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/god_class.js"></script>

</body>
</html>
