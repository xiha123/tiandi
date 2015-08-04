<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/##" />

</head>

<div class="box">
    <h3>基 础 资 料</h3>
    <div class="Photo">
        <!--相片位置后期需修改-->
    </div>
    <input type="text" placeholder="昵 称"/>
    <textarea name="" id="Signature" cols="30" rows="10" placeholder="签名档"></textarea>
    <h3>账户设置</h3>
    <input type="text" placeholder="邮箱"/>
    <input type="text" placeholder="手机号码"/>
    <h3>账户设置</h3>
    <input type="password" placeholder="旧密码"/>
    <input type="password" placeholder="新密码"/>
    <input type="password" placeholder="确认新密码"/>
    <h3>绑定第三方账户</h3>
    <ul class="sociality">
        <li><i class="fa fa-qq fl"></i></li>
        <li><i class="fa fa-weibo fl"></i></li>
    </ul>
    <button type="submit">
        提 交<i class="fa fa-arrow-circle-right"></i>
    </button>
    <h3>大神资料设置</h3>
        <p>真 实 姓 名：某某某</p>
        <p>支付宝账号：某某某</p>
    <input type="password" placeholder="支付宝账号"/>
    <textarea name="" id="experience" cols="30" rows="10" placeholder="项目经历"></textarea>
    <button type="submit">
        提 交<i class="fa fa-arrow-circle-right"></i>
    </button>
</div>