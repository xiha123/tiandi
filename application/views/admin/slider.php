<?php $this->load->view('widgets/admin_header.php'); ?>
<link rel="stylesheet" href="../static/css/admin_home.css" type="text/css" />
</head>

<body>
<?php $this->load->view('widgets/admin_left.php'); ?>
	<div class="main">
		<div class="main-content">
			<div class="window">
			
				<div class="confirm" id="confirm" style="display:none">
					<div class="confirm-title">
						<h2>您确定删除吗</h2>
						<a href="javascript:void(0)" class="close">X</a>
					</div>
					<div class="confirm-content">
						<i class="icon-remove"></i>
						<p>您确定要删除掉这篇文章吗？</p>
						<p>删除后将无法复原，点击确定按钮确认删除该条记录</p>
					</div>
					<div class="confirm-bottom">
						<button class="btn btn-danger">确定</button>
						<button class="btn btn-default">取消</button>
					</div>
				</div>
				
				<div class="confirm" style="display:none">
					<div class="confirm-title">
						<h2>您确定删除吗</h2>
						<a href="javascript:void(0)" class="close">X</a>
					</div>
					<div class="confirm-content">
						<i class="icon-remove"></i>
						<p>您确定要删除掉这篇文章吗？</p>
						<p>删除后将无法复原，点击确定按钮确认删除该条记录</p>
					</div>
					<div class="confirm-bottom">
						<button class="btn btn-primary" id="close">确定</button>
					</div>
				</div>
				
				
				
				
			</div>
		
			<div class="main-title">
				<ul class="nav nav-pills">
					<li role="presentation" class="active"><a href="#"><i class="icon-building"></i>首页轮播设置</a></li>
					<li role="presentation"><a href="#">添加轮播图片</a></li>
					<li role="presentation"><a href="#">添加活动标签页</a></li>
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
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove remove-slider" data-id="0"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					<tr><td>css3 calc():css简单的数学运算-加减乘除 | HTML老虎</td><td>点击浏览</td><td>2015年7月14日15:19:22</td><td>测试性质的添加测试</td><td>正常</td><td><i class="icon-remove"></i></td></tr>
					
				</table>
			</div>


		</div>
	</div>
	<?php $this->load->view('widgets/admin_footer.php'); ?>
	<script src="../static/js/admin/slider.js"></script>

</body>
</html>