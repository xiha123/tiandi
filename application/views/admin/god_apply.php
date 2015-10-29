	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/home.css">
</head>

<body>
<?php
	$this->load->view('widgets/admin/window.php');
	$this->load->view('widgets/admin/left.php', array("activeNav" => 4));
?>

<div class="main">
	<ul class="nav nav-pills">
		<li role="presentation"><a href="./admin/user"><i class="fa fa-users"></i>用户管理</a></li>
		<li role="presentation" class="active"><a href="javascript:;"><i class="fa fa-check-square"></i>大神审核</a></li>
		<li role="presentation"><a href="./admin/god_class"><i class="fa fa-puzzle-piece"></i>大神课程</a></li>
	</ul>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="10%">昵称</th>
				<th width="10%">真实姓名</th>
				<th width="10%">邮箱</th>
				<th width="10%">手机号</th>
				<th width="35%">项目经验</th>
				<th width="5">金币</th>
				<th width="5%">银币</th>
				<th width="5%">积分</th>
				<th width="5%">类型</th>
				<th width="5%">操作</th>
			</tr>
		</thead>
		<tbody>
			{user}
			<tr data-id="{id}" data-img="{img}" data-color="{color}" data-link="{link}">
				<td>{nickname}</td>
				<td>{name}</td>
				<td>{email}</td>
				<td>{cellphone}</td>
				<td>{god_description}</td>
				<td>{gold_coin}</td>
				<td>{silver_coin}</td>
				<td>{Integral}</td>
				<td>{type}</td>
				<td><i class="fa fa-check apply-ok"></i><i class="fa fa-remove apply-no"></i></td>
			</tr>
			{/user}
		</tbody>
	</table>

	<?php $this->load->view("miaoda/page",array(
		"page" => $page,
		"page_max" => $user_max,
		"page_count" => 10,
		"page_url" => "./admin/user",
		"hot" => ""
	)); ?>

</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="./static/js/admin/god_apply.js"></script>
</body>
</html>
