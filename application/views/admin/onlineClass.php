<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="../static/css/admin/home.css" type="text/css" />
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 2)); ?>
	<div class="main">
		<div class="main-content">
			<?php $this->load->view('widgets/admin/window.php'); ?>
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
	</div>
	<?php $this->load->view('widgets/admin/footer.php'); ?>
	<script src="../static/js/admin/slider.js"></script>

</body>
</html>