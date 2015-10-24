<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/home.css">
	<script>
		function signOut() {
			_td.api.logoutAdmin().done(function () {
				location = 'admin';
			}).fail(function () {
				showAlert('注销失败', 'danger');
			});
		}
	</script>
</head>

<body>
<?php $this->load->view('widgets/admin/left.php', array("activeNav" => 0)); ?>

<div class="main">
	<div class="main-content">
		<div class="main-title">
			<ul class="nav nav-pills">
				<li role="presentation"><a href="javascript:;" onclick="signOut()"><i class="fa fa-sign-out"></i>注销</a></li>
			</ul>
		</div>

		<div class="main-data">
			<p>欢迎来到后台管理系统，这个页面将会在日后完善，比如添加一些适用于整站的配置。</p>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
</body>
</html>
