	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/home.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php', array("activeNav" => 4)); ?>

<div class="main">
	<?php $this->load->view('widgets/admin/window.php'); ?>
	<div class="main-content">
		<div class="main-title">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="javascript:;" onclick="signOut()"><i class="fa fa-sign-out"></i>注销</a></li>
			</ul>
		</div>

		<div class="main-data">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>昵称</th>
						<th>真实姓名</th>
						<th>邮箱</th>
						<th>手机号</th>
						<th>支付宝号</th>
						<th>银币</th>
						<th>金币</th>
						<th>身份证</th>
						<th>类型</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				{user}
					<tr data-id="{id}" data-img="{img}" data-color="{color}" data-link="{link}">
						<td>{nickname}</td>
						<td>{name}</td>
						<td>{email}</td>
						<td>{cellphone}</td>
						<td>{alipay}</td>
						<td>{gold_coin}</td>
						<td>{silver_coin}</td>
						<td>{idcar}</td>
						<td>{type}</td>
						<td><i class="fa fa-edit edit-slider"></i><i class="fa fa-trash remove-user"></i></td>
					</tr>
				{/user}
				</tbody>
			</table>
			
			<?php
				$this->load->view("miaoda/page",array(
					"page" => $page,
					"page_max" => $user_max,
					"page_count" => 10,
					"page_url" => "./admin/user",
					"hot" => ""
				));
			?>

		</div>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="./static/js/admin/user.js"></script>
</body>
</html>