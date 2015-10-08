	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/home.css">
</head>

<body>
<?php
	$this->load->view('widgets/admin/window.php');
	$this->load->view('widgets/admin/left.php', array("activeNav" => 6));
?>

<div class="main">
	<ul class="nav nav-pills fl">
		<li role="presentation" class="active"><a href="javascript:;"><i class="fa fa-users"></i>用户管理</a></li>
		<li role="presentation"><a href="./admin/god_apply"><i class="fa fa-check-square"></i>大神审核</a></li>
		<li role="presentation"><a href="./admin/god_class"><i class="fa fa-puzzle-piece"></i>大神课程</a></li>
		<li class="fr">
			<form class="form-inline fr" action="javascript:;" onsubmit="search('./admin/user')">
				<div class="input-group">
					<input type="text" class="form-control" id="searchName" placeholder="搜索">
					<div class="input-group-addon"><button class="search"><i class="fa fa-search"></i></button></div>
				</div>
			</form>
		</li>
	</ul>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>昵称</th>
				<th>真实姓名</th>
				<th>邮箱</th>
				<th>手机号</th>
				<th>支付宝号</th>
				<th>金币</th>
				<th>银币</th>
				<th>积分</th>

                <th>威望</th>
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
				<td>{Integral}</td>
                <td>{prestige}</td>
                <td>{type}</td>

                <td><i class="fa fa-edit edit-user"></i><i class="fa fa-trash remove-user"></i></td>
			</tr>
			{/user}
		</tbody>
	</table>

	<?php $this->load->view("miaoda/page",array(
		"page" => $page,
		"page_max" => $user_max,
		"page_count" => 20,
		"page_url" => "./admin/user",
		"hot" => "",
	)); ?>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="./static/js/admin/user.js"></script>
</body>
</html>
