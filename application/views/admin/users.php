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
            <form onsubmit="editProfile();return false;">
                <div class="form-group">
                    <label for="edit-profile-nickname">昵称</label>
                    <input type="text" class="form-control" id="edit-profile-nickname" placeholder="<?= $me['nickname'] ?>">
                </div>
                <input type="submit" class="btn btn-success" value="修改">
            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="admin">
            <form onsubmit="createAdmin();return false;">
                <div class="form-group">
                    <label for="create-admin-nickname">昵称</label>
                    <input type="text" class="form-control" id="create-admin-nickname" placeholder="昵称">
                </div>
                <div class="form-group">
                    <label for="create-admin-username">用户名</label>
                    <input type="text" class="form-control" id="create-admin-username" placeholder="用户名">
                </div>
                <div class="form-group">
                    <label for="create-admin-pwd">密码</label>
                    <input type="password" class="form-control" id="create-admin-pwd" placeholder="密码">
                </div>
                <input type="submit" class="btn btn-success" value="创建">
            </form>
            <form onsubmit="removeAdmin();return false;">
                <div class="form-group">
                    <label for="remove-admin-nickname">用户名</label>
                    <input type="text" class="form-control" id="create-admin-nickname" placeholder="昵称">
                </div>
                <input type="submit" class="btn btn-danger" value="删除">
            </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="user">3</div>
    </div>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script>
    function editProfile() {
        var nickname = $.trim($('#edit-profile-nickname').val());

        $.ajax({
            url: 'admin_api/edit',
            method: 'post',
            data: {
                nickname: nickname
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
    }

    function createAdmin() {
        $.ajax({
            url: 'admin_api/create',
            method: 'post',
            data: {
                name: $('#create-admin-username').val(),
                pwd: $('#create-admin-pwd').val(),
                nickname: $('#create-admin-nickname').val()
            },
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    alert('创建成功');
                } else {
                    showAlert(res.error);
                }
            }
        });
    }

    function removeAdmin() {
        $.ajax({
            url: 'admin_api/remove',
            method: 'post',
            data: {
                name: $('#create-admin-username').val()
            },
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    alert('删除成功');
                } else {
                    showAlert(res.error);
                }
            }
        });
    }
</script>
</body>
</html>
