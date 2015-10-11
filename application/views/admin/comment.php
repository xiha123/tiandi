	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/comment.css">
</head>

<body>
<?php
	$this->load->view('widgets/admin/window.php');
	$this->load->view('widgets/admin/left.php', array("activeNav" => 9));
?>

<div class="main">
	<ul class="nav nav-pills fl">
		<li role="presentation" class="active"><a href="javascript:;"><i class="fa fa-comments"></i>评论列表</a></li>
		<li class="fr">
			<form class="form-inline fr" action="javascript:;" onsubmit="search('./admin/comment')">
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
				<th width="50%">内容</th>
				<th width="10%">作者昵称</th>
				<th width="10%">创建时间</th>
				<th width="20%">所属问题</th>
				<th width="10%"></th>
			</tr>
		</thead>
		<tbody>
			{comments}
			<tr data-id="{id}">
				<td>{content}</td>
				<td><a href="home?uid={owner_id}" target="_blank">{author}</a></td>
				<td>{ctime}</td>
				<td><a href="problem/?p={problem_id}" target="_blank">{problem_title}</a></td>
                <td><i class="fa fa-trash remove-comment"></i></td>
			</tr>
			{/comments}
		</tbody>
	</table>

	<?php $this->load->view("miaoda/page",array(
		"page" => $page,
		"page_max" => $comments_count,
		"page_count" => 20,
		"page_url" => "./admin/comment",
		"hot" => "",
	)); ?>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="./static/js/admin/comment.js"></script>
</body>
</html>
