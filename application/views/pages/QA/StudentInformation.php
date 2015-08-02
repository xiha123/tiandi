<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/personalInformation.css" />
<!---->

</head>

<div class="box">
    <form action="#" method="get">
        <h3 class="information">个 人 信 息</h3>
        <input type="text" placeholder="真实姓名"/>
        <input type="text" placeholder="身份证号"/>
        <input type="text" placeholder="支付宝账号"/>
        <input type="text" placeholder="手机号码"/>
        <h3 class="information">写下您的项目经历</h3>
        <textarea name="" id="experience" cols="30" rows="10"></textarea>
        <label>
            <input type="checkbox" name="agree" class="agree"/>同意并接受《服务条款》
        </label>
        <div class="submitbutton">
            <button type="submit" value="submitbutton">
                提 交<i class="fa fa-arrow-circle-right"></i>
            </button>
        </div>
    </form>
</div>