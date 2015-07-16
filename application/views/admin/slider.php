<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="../static/css/admin/home.css" type="text/css" />
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 1)); ?>
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
						<th width="40%">标题</th>
						<th width="8%">地址</th>
						<th width="16%">添加时间</th>
						<th>描述</th>
						<th width="8%">状态</th>
						<th width="8%">操作</th>
					</tr>
					<tr  data-id="0" data-img="2"  data-color="3" data-link="4" ><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-edit edit-slider"></i><i class="icon-trash remove-slider" data-id="0"></i></td></tr>
				</table>
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
			</div>
			

		</div>
	</div>
	<?php $this->load->view('widgets/admin/footer.php'); ?>
	<script src="../static/js/admin/slider.js"></script>

</body>
</html>