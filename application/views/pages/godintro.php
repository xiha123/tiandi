<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="static/css/godintro.css"/>
</head>
<body>
<?php $this->load->view('widgets/nav.php'); ?>

<div class="top">
    <img src="static/image/godintro/top.png" alt="intro" />
</div>
<div class="wrapper main">
    <h2>封神榜</h2>
    <p>编程让我们发光发亮</p>

    <h3>大神是什么？</h3>

    <p>不同于其他网站，在秒答上只有大神账号才可以回答问题。</p>
    <p>所以每个大神都是经过我们严格筛选、认证过的资深程序员。</p>
    <p>我们希望每一条未解答问题上的回答都是正确而且易于理解的。严谨和热心是我们理想中大神们的特质。</p>

    <h3>大神能获得什么？</h3>

    <p>时间就是金钱。大神们在帮助小白解答难题的同时，不仅能获得助人为乐之后的成就感，我们认为物质奖励也是不可或缺的。</p>
    <p>目前，回答过金币问题的大神可以在积累到一定数量以后兑换成现金；回答的银币问题也能让你获取银币奖励来兑换热门数码产品。</p>
    <p>除了以上直观的奖励方式，我们在不久之后会引入一大批企业资源和成长机会：</p>
    <p>众筹公开课，圆你桃李满天下的梦想。</p>
    <p>高水平的代码分析，让名企主程点名邀请你。</p>
    <p>出书成册，让你的经验为编程普及添砖加瓦。</p>
    <p>企业难题重金悬赏，在这里解决方案就是第一生产力。</p>

    <h3>大神需要干什么？</h3>

    <p>正如前面所说，大神的主要任务就是回答小白提出的编程问题。</p>
    <p>这些问题都不难，或许搜索引擎上也能找到差不多的答案。但是我们希望热心的大神们可以更加详尽更加细致的把答案解释给初学者，让他们也能容易地理解。</p>
    <p>罗马不是一天建成的，初学者在编程学习之路上的每一步每个脚印也离不开大神们的帮助与指点。</p>

    <a href="javascript:;" class="js-apply btn">申请成为大神</a>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script>
    $(".js-apply").click(function () {
        if (_td.info.id === -1) {
            $('.bomb-login').trigger('click');
        } else {
            location.href = 'god/apply';
        }
    });
</script>
</body>
</html>
