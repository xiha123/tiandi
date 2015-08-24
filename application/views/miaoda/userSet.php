<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/personalInformation.css" />

</head>
<?php
    $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); 
    $this->load->view('widgets/windows.php' );
?>


<div class="box">
        <h3 class="information">基 础 资 料</h3>
        <div class="Photo"style="background-color:#209ba2;width:150px;height: 150px;margin: 25px auto;">
            <img src="<?=$avatar?>" width="150" height="150"/>
        </div>
    <form action="javascript:;" id="ajax_upload" enctype="multipart/form-data">
        <button class="file">
            更换头像
            <input type="file" id="ajax_userPic" name="userfile">
        </button>
    </form>

    <div class="submitbutton">
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
        <button type="submit" id="ajax_userSet"> <!---->
            提 交<i class="fa fa-arrow-circle-right"></i>
        </button>

        <?php if($type == 1){?>
            <div class="line"></div>
            <h3 class="information">大神资料设置</h3>
            <div class="personmessage">
                <p>真 实 姓 名：<?= $name ?></p>
                <p>支付宝账号：<?= $alipay ?></p>
            </div>

            <input type="text" placeholder="支付宝账号" value="<?=$alipay?>" id="alipay" />
            <textarea name="" id="experience" cols="30" rows="10" placeholder="项目经历" id="goddesc"><?=$god_description?></textarea>
            <h3 class="information">擅长标签设置</h3>

            <div class="tag" data-widget="tag">
                <input type="hidden" class="form-tag" value="">
                <div class="tag-list">
                    <?php
                        foreach (count($god_skilled_tags) > 0 ? $god_skilled_tags : array() as $key => $value) {
                            echo '<span class="tag-box"><font>'.$value.'</font> <button class="close">X</button></span>';
                        }
                    ?>
                </div>
                <div class="input-tag">
                    <input type="text" class="input-tag" placeholder="请输入标签">
                    <div class="tag-ide" style="display: none;">
                        <ul></ul>
                    </div>
                </div>
            </div>
            <input type="text" placeholder="擅长标签">
            <button type="submit"  id="ajax_godset">
                提 交<i class="fa fa-arrow-circle-right"></i>
            </button>


        <?php } ?>
    </div>

<?php $this->load->view('widgets/footer.php'); ?>
<script src="static/lib/jquery.form/jquery.form.min.js"></script>
<script src="static/js/userSet.js"></script>
</div>