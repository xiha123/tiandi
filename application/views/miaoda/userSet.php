<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/personalInformation.css" />

</head>
<?php
    $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); 
    $this->load->view('widgets/windows.php' );
?>



<div class="box">
    <form action="javascript:;" method="get" class="submitbutton">
        <h3 class="information">基 础 资 料</h3>
        <div class="Photo"style="background-color:#209ba2;width:150px;height: 150px;margin: 25px auto;">
            <img src="<?=$avatar?>"/>
        </div>
            <button class="file">
                更换头像
                <input type="file" id="ajax_userPic">
            </button>
        <input type="text" placeholder="昵 称" id="ajax_nickname"  value="<?=$nickname?>"/>
        <textarea name="" id="signature" cols="30" rows="10" id="ajax_description" placeholder="签名档"><?=$description?></textarea>
        <h3 class="information">账户设置</h3>
        <input type="text" placeholder="邮箱" value="<?=$email?>" id="ajax_email"/>
        <input type="text" placeholder="手机号码" value="<?=$cellphone?>" id="ajax_phone"/>
        <h3 class="information">账户设置</h3>

        <input type="password" placeholder="旧密码" id="ajax_lost"/>
        <input type="password" placeholder="新密码" id="ajax_new"/>
        <input type="password" placeholder="确认新密码" id="ajax_re"/>

        <h3 class="information">绑定第三方账户</h3>
        <ul class="sociality">
            <li>
                <i class="fa fa-qq"></i>
                <i class="fa fa-weibo"></i>
            </li>
        </ul>
        <button type="submit" id="ajax_userSet">
            提 交<i class="fa fa-arrow-circle-right"></i>
        </button>

        <?php if($type == 1){?>
            <div class="line"></div>
            <h3 class="information">大神资料设置</h3>
            <div class="personmessage">
                <p>真 实 姓 名：某某某</p>
                <p>支付宝账号：某某某</p>
            </div>

            <input type="password" placeholder="支付宝账号"/>
            <textarea name="" id="experience" cols="30" rows="10" placeholder="项目经历"></textarea>
            <button type="submit"  id="ajax_userSet">
                提 交<i class="fa fa-arrow-circle-right"></i>
            </button>
        <?php } ?>
    </form>
<?php $this->load->view('widgets/footer.php'); ?>
    <script src="static/js/userSet.js"></script>
</div>