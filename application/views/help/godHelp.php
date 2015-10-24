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

        <li>
            <h1 id="what-8">八、威望点来源有哪些？</h1>
            <p>1. 通过回答问题。</p>
            <p>2. 通过达成一定的条件。</p>
            <table>
                <tr>
                    <td rowspan="2">要求</td>
                    <td colspan="2">增加</td>
                </tr>
                <tr><td>大神等级</td><td>威望增加</td></tr>
                <tr>
                    <td rowspan="3">每个回答问题点赞数量>20</td>
                    <td>L1-L2</td><td>5威望</td>
                </tr>
                <tr><td>L3-L7</td><td>8威望</td></tr>
                <tr><td>L8-L10</td><td>15威望</td></tr>
                <tr>
                    <td rowspan="3">银币每新增5000</td>
                    <td>L1-L2</td><td>5威望</td>
                </tr>
                <tr><td>L3-L7</td><td>8威望</td></tr>
                <tr><td>L8-L10</td><td>15威望</td></tr>
                <tr>
                    <td rowspan="3">全勤奖（条件：自然月，每天威望有增加）</td>
                    <td>L2-L3</td><td>5威望</td>
                </tr>
                <tr><td>L4-L7</td><td>8威望</td></tr>
                <tr><td>L8-L10</td><td>15威望</td></tr>
                <tr>
                    <td rowspan="2">原有大神邀请新大神加入秒答</td>
                    <td colspan="2">邀请注册即送20威望</td>
                </tr>
                <tr><td colspan="2">当被邀请大神威望等级到L3时，原大神额外再获20威望</td></tr>
            </table>
        </li>

        <li>
            <h1>九、大神的威望点和等级是怎样对应的？</h1>
            <p>大神等级和威望点对应表：</p>
            <table>
                <thead>
                    <tr><th>威望点</th><th>头衔</th><th></th></tr>
                </thead>
                <tbody>
                    <tr><td>1-50</td><td>初执教鞭</td><td>L1</td></tr>
                    <tr><td>51-150</td><td>教导有方</td><td>L2</td></tr>
                    <tr><td>151-300</td><td>孜孜不倦</td><td>L3</td></tr>
                    <tr><td>301-500</td><td>良工心苦</td><td>L4</td></tr>
                    <tr><td>501-900</td><td>耳提面命</td><td>L5</td></tr>
                    <tr><td>901-1700</td><td>良师益友</td><td>L6</td></tr>
                    <tr><td>1701-3300</td><td>循循善诱</td><td>L7</td></tr>
                    <tr><td>3301-5500</td><td>春风化雨</td><td>L8</td></tr>
                    <tr><td>5501-?</td><td>桃李天下</td><td>L9</td></tr>
                </tbody>
            </table>
        </li>


    </ul>

<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>
