<?php $this->load->view('widgets/admin/header.php'); ?>
<link rel="stylesheet" href="static/css/admin/login.css">
</head>

<body>
<div class="box">
    <img src="static/image/admin/logo-hd.png" class="logo" alt="天地君道" width="220" height="162"/>
    <form>
        <input type="text" placeholder="登录名" name="username" id="username">
        <input type="password" placeholder="密码" name="password" id="pwd">
        <input type="submit" class="login-btn" value="登录">
    </form>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>

<script>
    $('form').on('submit', function (e) {
        e.preventDefault();

        _td.api.loginAdmin({
            name: $.trim($('#username').val()),
            pwd: $.trim($('#pwd').val())
        }).then(function () {
            location.href = 'admin';
        }, function (msg) {
            showAlert(msg);
        });
    });
</script>
</body>
</html>
