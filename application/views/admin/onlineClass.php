	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/olclass.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 2)); ?>

<div class="main">
    <ul class="nav nav-pills" role="tablist">

		<?php $this->load->view('widgets/online/nav.php' , array("activeNav" => 0)); ?>
    </ul>
	<div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="guide">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="">名字</th>
						<th width="">图片</th>
						<th width="">链接</th>
						<th width="">状态</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<div class="operation">
	            <a class="btn btn-success" data-toggle="modal" data-target="#add-guide">添加</a>
			</div>
        </div>
	</div>
	<div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="guide2">
			<table class="table table-hover">
				<thead>
					<tr>
						<th width="">名字</th>
						<th width="">图片</th>
						<th width="">链接</th>
						<th width="">状态</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			<div class="operation">
	            <a class="btn btn-success" data-toggle="modal" data-target="#add-guide">添加</a>
			</div>
        </div>
	</div>
	
	
	
	
	<div class="modal fade" id="add-guide" tabindex="-1" role="dialog" aria-labelledby="add-guide-title">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="add-guide-title">添加新手指引</h4>
				</div>
				<div class="modal-body">
		            <form onSubmit="addGuide();return false;">
		                <div class="form-group">
		                    <label for="add-guide-name">名称</label>
		                    <input type="text" class="form-control" id="add-guide-nickname" placeholder="名称">
		                </div>
		                <div class="form-group">
		                    <label for="add-guide-img">图片</label>
		                    <input type="file" class="form-control" id="add-guide-img" placeholder="图片">
		                </div>
		                <div class="form-group">
		                    <label for="add-guide-link">链接</label>
		                    <input type="link" class="form-control" id="add-guide-link" placeholder="链接">
		                </div>
		            </form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-success">添加</button>
				</div>
			</div>
		</div>
	</div>
	<!--
	<div class="main-content">
		<?php //$this->load->view('widgets/admin/window.php'); ?>
		<div class="main-title">
			<ul class="nav nav-pills">
				<li role="presentation"  class="active"><a href="onlineClass"><i class="icon-building"></i>在线课堂轮播设置</a></li>
				<li role="presentation"><a href="onlineClassSlider"><i class="icon-building"></i>课程表设置</a></li>
				<li role="presentation"><a href="onlineClassSlider"><i class="icon-building"></i>新手引导栏设置</a></li>
				<li role="presentation"><a href="onlineClassSlider"><i class="icon-building"></i>课程方向引导栏设置</a></li>
				<li role="presentation"><a href="onlineClassSlider"><i class="icon-building"></i>课程内容详情页设置</a></li>
			</ul>
		</div>

		<div class="main-data">
			<table class="table table-bordered">
				<tr>
					<th width="40%">标题</th>
					<th width="8%">地址</th>
					<th width="16%">添加时间</th>
					<th>描述</th>
					<th width="8%">状态</th>
					<th width="8%">操作</th>
				</tr>
				<tr  data-id="0" data-img=""  data-color=""><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider"></i></td></tr>
				<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
				<tr><td>css3 calc():CSS简单的数学运| HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
			</table>
		</div>
	</div>
	-->
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/olclass.js"></script>
</body>
</html>
