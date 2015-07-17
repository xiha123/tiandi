	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/users.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php', array("activeNav" => 3)); ?>

<div class="main">
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active"><a href="#self" aria-controls="self" role="tab" data-toggle="tab">个人设置</a></li>
        <li role="presentation"><a href="#admin" aria-controls="profile" role="tab" data-toggle="tab">管理员设置</a></li>
        <li role="presentation"><a href="#user" aria-controls="messages" role="tab" data-toggle="tab">用户设置</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="self">
            <form id="edit-profile-form">
                <div class="form-group">
                    <label for="edit-profile-nickname">昵称</label>
                    <input type="text" class="form-control" id="edit-profile-nickname" placeholder="<?= $me['nickname'] ?>">
                </div>
                <input type="submit" class="btn btn-success" value="修改">
            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="admin">2</div>
        <div role="tabpanel" class="tab-pane" id="user">3</div>
    </div>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script>
    var profileForm = $('#edit-profile-form');

    profileForm.on('submit', function (e) {
        var nickname = $.trim($('#edit-profile-nickname').val());
        e.preventDefault();
        $.ajax({
            url: 'admin_api/edit',
            method: 'post',
            data: {
                nickname: nickname,
                auid: <?= $me['id'] ?>
            },
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    $('.profile h2').text(nickname);
                } else {
                    showAlert(res.error);
                }
            }
        });
    });
</script>
</body>
</html>
