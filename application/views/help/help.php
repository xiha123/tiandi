<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/QA/formOne.css" />

</head>

<body>
<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
<div class="wrapper">
    <ul class="help">
        <li>
            <h1>一、如何提问才能被快速解答？</h1>
            <p>• 标题-简洁扼要，突出主旨。</p>
            <p>• 描述-尽可能详细，描述主体问题。</p>
            <p>• 代码-如果问题涉及源代码，在代码段输入区贴上源代码。</p>
            <p>• 标签-给你的问题添加准确、尽可能全面的标签。</p>
        </li>
        <li>
            <h1>二、问题赏金是怎么计算的？</h1>
            <p>提问默认消耗100银币作为给大神的赏金，如果勾选“使用金币提问”，则消耗1金币。</p>
        </li>
        <li>
            <h1>三、如何获得银币和金币？</h1>
            <p>银币可以通过分享、点赞、评论等人行为获得，金币通过付费充值获得。</p>
        </li>
        <li>
            <h1>四、问题提交之后还可以进行编辑吗？</h1>
            <p>不可以。为了大神能更好更多的回答问题，提高问答效率，问题发出之后不可以再次编辑，所以请在问题提交之前仔细检查编辑的内容。</p>
        </li>

        <li>
            <h1>五、什么时候可以进行评论？</h1>
            <p>在问题被提出之后，评论区开放，所有用户即可进行评论。</p>
        </li>


        <li>
            <h1>六、众筹是什么意思？怎么众筹？</h1>
            <p>如果你看到一个未被解答的问题同时也是你自己想提问的，众筹该问题。点击“众筹”按钮参与众筹。众筹只消耗50银币。</p>
        </li>


        <li>
            <h1>七、我可以回答问题吗？</h1>
            <p>普通用户不可以回答问题，普通用户在申请成为大神之后，才可以回答问题。</p>
        </li>


        <li>
            <h1>八、怎么申请成为大神？</h1>
            <p>在个人中心里面点击“想成为大神？”，填写个人资料和项目经历等信息之后提交，审核通过即可成为大神。</p>
        </li>


        <li>
            <h1>九、什么样的问题会被删除？</h1>
            <p>• 和学习无关的问题</p>
            <p>• 含有广告、招聘信息以及触犯国家法律的问题</p>
        </li>

        <li>
            <h1>十、已答、热门、未答里面都是什么样的问题？</h1>
            <p>“已答”是指刚刚被解答的问题，“热门”是指已回答的认可度高的问题，“未答”是指所有未被解答的问题。</p>
        </li>

        <li>
            <h1>十、已答、热门、未答里面都是什么样的问题？</h1>
            <p>“已答”是指刚刚被解答的问题，“热门”是指已回答的认可度高的问题，“未答”是指所有未被解答的问题。</p>
        </li>

        <li>
            <h1>十一、用户积分与等级具体数值是怎样的？积分和等级是怎样对应的？	</h1>
            <p>积分明细表：</p>
            <table>
                <thead>
                    <tr><th>操作</th><th>积分</th></tr>
                </thead>
                <tbody>
                    <tr><td>注册首次登录</td><td>0</td></tr>
                    <tr><td>签到</td><td>20</td></tr>
                    <tr><td>分享</td><td>100</td></tr>
                    <tr><td>提问</td><td>100</td></tr>
                    <tr><td>众筹</td><td>50</td></tr>
                    <tr><td>点赞</td><td>10</td></tr>
                    <tr><td>收藏标签</td><td>10</td></tr>
                    <tr><td>收藏问题</td><td>10</td></tr>
                    <tr><td>关注</td><td>10</td></tr>
                    <tr><td>评论</td><td>30</td></tr>
                </tbody>
            </table>
            <p>用户等级与积分值对应表：</p>
            <table>
                <thead>
                    <tr><th>积分区间</th><th>头衔</th><th>等级</th></tr>
                </thead>
                <tbody>
                    <tr><td>0-199</td><td>编程入门</td><td>L1</td></tr>
                    <tr><td>200-499</td><td>初尝甜头</td><td>L2</td></tr>
                    <tr><td>500-999</td><td>渐入佳境</td><td>L3</td></tr>
                    <tr><td>1000-1999</td><td>茅塞顿开</td><td>L4</td></tr>
                    <tr><td>2000-3199</td><td>醍醐灌顶</td><td>L5</td></tr>
                    <tr><td>3200-4999</td><td>得心应手</td><td>L6</td></tr>
                    <tr><td>5000-7499</td><td>炉火纯青</td><td>L7</td></tr>
                    <tr><td>7500-9999</td><td>所向披靡</td><td>L8</td></tr>
                    <tr><td>10000-12999</td><td>攻城大湿</td><td>L9</td></tr>
                    <tr><td>13000-?</td><td>独孤求败</td><td>L10</td></tr>
                </tbody>
            </table>
        </li>

        <li>
            <h1>十二、哪些行为可以增加或消耗银币？</h1>
            <p>银币的获得和消耗与交互行为对应关系表: </p>
            <table>
                <thead>
                    <tr><th>操作</th><th>银币</th></tr>
                </thead>
                <tbody>
                    <tr><td>注册首次登录</td><td>200</td></tr>
                    <tr><td>激活邮箱</td><td>300</td></tr>
                    <tr><td>签到</td><td>+10~50，连续登陆每次加5，中断重新计算</td></tr>
                    <tr><td>分享</td><td>80</td></tr>
                    <tr><td>提问</td><td>-100</td></tr>
                    <tr><td>众筹</td><td>-50</td></tr>
                    <tr><td>点赞</td><td>20</td></tr>
                    <tr><td>收藏标签</td><td>5</td></tr>
                    <tr><td>收藏问题</td><td>5</td></tr>
                    <tr><td>关注</td><td>5</td></tr>
                    <tr><td>评论</td><td>20</td></tr>
                </tbody>
            </table>
            <p>周增积分排行送银币: </p>
            <table>
                <thead>
                    <tr><th>排名</th><th>赠送银币量</th></tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>200</td></tr>
                    <tr><td>2-5</td><td>100</td></tr>
                    <tr><td>6-20</td><td>50</td></tr>
                </tbody>
            </table>
        </li>

    </ul>

<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>
