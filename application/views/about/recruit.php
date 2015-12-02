<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/miaoda/home.css">

<link rel="stylesheet" href="/static/recruit/css/recruit.css">
<link href="ueditor/themes/default/css/umeditor.min.css" rel="stylesheet">
<body>

<div
    id="page-info"
    class="hidden"
    data-title="秒答_国内首个针对零基础初学者学习编程的编程社区_编程问题，就上秒答"
    data-keywords="秒答,编程社区,零基础,编程问题,VR游戏,AR游戏,unity5,cocos2dx,android,ios,flash,java,html5"
    data-description="秒答是国内首个针对零基础初学者学习编程的编程社区。在这里你能提问Unity3D、Web、Cocos2D-X等热门编程领域的问题。每个问题都能被快速准确地解答，绝不留着难题过夜。让编程初学者不再走弯路，想提升编程学习效率，上秒答，就对了。"
    ></div>

<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 4)); ?>

<?php
$this->load->view('widgets/windows.php');
if (!isset($_SESSION['problem_temp'])) {
    $_SESSION['problem_temp'] = array('type'=>"", "title"=>"","content"=>"","tags"=>"[]","code"=>"" , "language" => -1 , "problem_id");
}
?>

<main>
    <section class="one-block">
        <img src="/static/recruit/images/bg.jpg" alt="">
        <div class="container">
            <h1>何谓精英汇</h1>
            <img src="/static/recruit/images/one_text.png" alt="">
        </div>
    </section>


    <section class="two-block">
        <div class="container">
            <img src="/static/recruit/images/two_text.png" alt="" class="pic-left dong">
            <img src="/static/recruit/images/bag.png" alt="" class="pic-right">
        </div>
    </section>

    <section class="three-block">
        <div class="container">
            <img src="/static/recruit/images/people.png" alt="" class="pic-left">
            <img src="/static/recruit/images/three_text.png" alt="" class="pic-right dong" id="second">
        </div>
    </section>

    <section class="four-block">
        <div class="container">
            <h1>合作企业</h1>
            <div class="desk">
                <ol>
                    <li class="left"><a href=""><img src="/static/recruit/images/logo/9_10.png" alt=""></a></li>
                    <li><a href=""><img src="/static/recruit/images/logo/9_03.png" alt=""></a></li>
                    <li><a href=""><img src="/static/recruit/images/logo/9_05.png" alt=""></a></li>
                    <li class="right"><a href=""><img src="/static/recruit/images/logo/9_07.png" alt=""></a></li>
                    </a>
                </ol>
                <ol>
                    <li class="left"><a href=""><img src="/static/recruit/images/logo/9_16_0.png" alt=""></a></li>
                    <li><a href=""><img src="/static/recruit/images/logo/9_18_0.png" alt=""></a></li>
                    <li><a href=""><img src="/static/recruit/images/logo/9_21.png" alt=""></a></li>
                    <li class="right"><a href=""><img src="/static/recruit/images/logo/9_24.png" alt=""></a></li>
                </ol>
                <ol>
                    <li class="left"><a href=""><img src="/static/recruit/images/logo/9_40.png" alt=""></a></li>
                    <li><a href=""><img src="/static/recruit/images/logo/9_31_0.png" alt=""></a></li>
                    <li><a href=""><img src="/static/recruit/images/logo/9_34.png" alt=""></a></li>
                    <li class="right"><a href=""><img src="/static/recruit/images/logo/9_37_0.png" alt=""></a></li>
                </ol>
            </div>
        </div>
    </section>
</main>
<footer>
    <div class="container">
        <div class="desk">
            <ol>
                <li class="left"><a href=""><img src="/static/recruit/images/pic_03.png" alt=""></a></li>
                <li><a href=""><img src="/static/recruit/images/pic_04.png" alt=""></a></li>
                <li><a href=""><img src="/static/recruit/images/pic_05.png" alt=""></a></li>
                <li class="right"><a href=""><img src="/static/recruit/images/pic_06.png" alt=""></a></li>
                </a>
            </ol>
        </div>
    </div>
    <section class="about">
        <div>
            <span><a href="">关于我们</a></span>
            <span><a href="">人才招聘</a></span>
            <span><a href="">讲师招聘</a></span>
            <span><a href="">联系我们</a></span>
        </div>
    </section>
    <hr>
    <section class="prey">
        <span><a href="">友情链接</a></span>
        <span><a href="">9RIA天地会</a></span>
        <span><a href="">腾讯课堂</a></span>
        <span><a href="">白鹭引擎</a></span>
        <span><a href="https://software.intel.com/zh-cn" target="_blank">因特尔</a></span>

    </section>
    <hr>
    <div class="prey">Copyright ©2015天地培训 All rights reserved｜浙ICP备09080888号</div>

</footer>

<?php $this->load->view('widgets/footer.php'); ?>
<script src="ueditor/umeditor.config.js"></script>
<script src="ueditor/umeditor.min.js"></script>
<script src="static/js/problem.home.js"></script>
<script src="/static/recruit/js/recruit.js"></script>

</body>
</html>
