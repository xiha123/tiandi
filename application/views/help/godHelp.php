<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/formOne.css" />

</head>

<body>
<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
<div class="wrapper">
    <ul class="help">
        <li>
            <h1>一、怎么开始回答问题？</h1>
            <p>点开一个未解答的问题，点击“认领问题”按钮即可在弹出的编辑框内输入解答。</p>
        </li>
        <li>
            <h1>二、解答问题有什么要求吗？</h1>
            <p>• 答案需要尽可能的详细明了</p>
            <p>• 如果需要，请贴上代码段</p>
            <p>• 请在20分钟之内提交答案</p>
        </li>
        <li>
            <h1>三、回答时答案编辑框右上角的数字有什么意义？</h1>
            <p>表示当前正在围观你解答的人数。</p>
        </li>
        <li>
            <h1>四、20分钟之内不提交答案会怎么样？</h1>
            <p>页面刷新，问题重新成为未解答的问题。</p>
        </li>

        <li>
            <h1>五、回答问题所得赏金怎么计算？</h1>
            <p>100银币+50银币*（众筹数-1）或者1金币+50银币*（众筹数-1）。</p>
        </li>


        <li>
            <h1>六、大神主页和个人中心相比有什么不同？</h1>
            <p>在大神主页里面你可以查看推荐你来回答的问题和回答过的问题。</p>
        </li>


        <li>
            <h1>七、在哪里更新我的项目经历？</h1>
            <p>设置-项目经历。</p>
        </li>


    </ul>
</body>
</html>
