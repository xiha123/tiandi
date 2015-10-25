<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/personalInformation.css" />

</head>
<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
<div class="box" >
<form action="javascript:" class="submitbutton">
        <h3 class="information">个人信息</h3>
        <input type="text" placeholder="真实姓名" id="name"/>
        <input type="text" placeholder="手机号码" id="phone"/>
        <h3 class="information">擅长的标签</h3>
        <select id="tag">
            <option value="0">Unity-3D</option>
            <option value="1">Flash</option>
            <option value="2">Web</option>
            <option value="3">Cocos2d-x</option>
            <option value="4">Android</option>
        </select>

        <h3 class="information">写下您的项目经历</h3>
        <textarea name="" id="desk" cols="30" rows="10"></textarea>
        <label>
            <input type="checkbox" name="agree" class="agree"/><a target="_blank" href="agreement/user">同意并接受《服务条款》</a>
        </label>
        <button type="button" id="ajax_apply">
            提 交<i class="fa fa-arrow-circle-right"></i>
        </button></form>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script>
    var uid = <?= $id ?>;
</script>
<script src="static/js/apply.js"></script>
