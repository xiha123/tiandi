	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/users.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php', array("activeNav" => 7)); ?>

<div class="main">
    <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active"><a href="#self" aria-controls="self" role="tab" data-toggle="tab">个人设置</a></li>
        <li role="presentation"><a href="#admin" aria-controls="profile" role="tab" data-toggle="tab">管理员设置</a></li>
        <li role="presentation"><a href="#limit" aria-controls="profile" role="tab" data-toggle="tab">管理员功能限制</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="self">
            <form onsubmit="editAdmin();return false;">
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
                    <label for="remove-admin-username">用户名</label>
                    <input type="text" class="form-control" id="remove-admin-username" placeholder="用户名">
                </div>
                <input type="submit" class="btn btn-danger" value="删除">
            </form>
        </div>

        <div role="tabpanel" class="tab-pane" id="limit">
            <form onsubmit="checkAdmin();return false;">
                <div class="form-group">
                    <label for="edit-profile-nickname">输入要操作的管理员名称</label>
                    <input type="text" class="form-control" id="check-profile-nickname" placeholder="管理员名称">
                </div>
                <input type="submit" class="btn btn-success" style="width:100%;" value="查询">
            </form>
             <form onsubmit="limitAdmin();return false;">
                 <label id="admin_nickname">当前选中的管理员：tocurd</label>
                <div class="form-group check" style="margin-top:10px;">
                    <label><input type="checkbox">首页轮播管理</label>
                    <label><input type="checkbox">在线课堂设置</label>
                    <label><input type="checkbox">课程管理</label>
                    <label><input type="checkbox">问题管理</label>
                    <label><input type="checkbox">标签管理</label>
                    <label><input type="checkbox">用户管理</label>
                </div>
                <input type="submit" class="btn btn-success" value="修改限制">
            </form>


        </div>


    </div>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/users.js"></script>
</body>
</html>
