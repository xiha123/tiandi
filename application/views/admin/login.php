<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="static/css/admin/login.css">
</head>

<body>
<div class="box">
    <img src="static/image/admin/logo-hd.png" class="logo" alt="天地君道" width="220" height="162"/>
    <form action="admin/login" method="post">
        <input type="text" placeholder="登录名" name="username" id="username">
        <input type="password" placeholder="密码" name="password" id="pwd">
        <ul class="msg">
            <li class="tishi"><i class="icon-exclamation-sign"></i>请输入登录密码</li>
            <li class="tishi">  <i class="icon-exclamation-sign"></i>请输入登录名</li>
            <li class="tishi"><i class="icon-exclamation-sign"></i>登录名或密码错误</li>
        </ul>
        <input type="submit" class="login-btn" value="登录">
    </form>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>

<script>
    $('form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: 'admin_api/login',
            method: 'post',
            data: {
                username: $.trim($('#username').val()),
                pwd: $.trim($('#pwd').val())
            },
            dataType: 'json',
            success: function (res) {
                if (res.status) {
                    location.reload();
                } else {
                    showAlert(res.error);
                }
            }
        });
    });
</script>
</body>
</html>
