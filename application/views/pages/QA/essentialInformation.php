<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/personalInformation.css" />

</head>

<div class="box">
    <form action="#" method="get" class="submitbutton">
        <h3 class="information">基 础 资 料</h3>
        <div class="Photo"style="background-color:#209ba2;width:150px;height: 150px;margin: 25px auto;">
        </div>
        <input type="text" placeholder="昵 称"/>
        <textarea name="" id="signature" cols="30" rows="10" placeholder="签名档" ></textarea>
        <h3 class="information">账户设置</h3>
        <input type="text" placeholder="邮箱"/>
        <input type="text" placeholder="手机号码"/>
        <h3 class="information">账户设置</h3>

        <input type="password" placeholder="旧密码"/>
        <input type="password" placeholder="新密码"/>
        <input type="password" placeholder="确认新密码"/>

        <h3 class="information">绑定第三方账户</h3>
        <ul class="sociality">
            <li><i class="fa fa-qq"></i></li>
            <li><i class="fa fa-weibo"></i></li>
        </ul>
        <button type="submit">
            提 交<i class="fa fa-arrow-circle-right"></i>
        </button>
        <div class="line"></div>
        <h3 class="information">大神资料设置</h3>
        <div class="personmessage">
            <p>真 实 姓 名：某某某</p>
            <p>支付宝账号：某某某</p>
        </div>

        <input type="password" placeholder="支付宝账号"/>
        <textarea name="" id="experience" cols="30" rows="10" placeholder="项目经历"></textarea>
        <button type="submit">
            提 交<i class="fa fa-arrow-circle-right"></i>
        </button>
    </form>

</div>