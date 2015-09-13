<title>不好意思，页面找不到啦，先去首页看看吧~</title>
<?php $this->load->view('widgets/header.php'); ?>
    <style>
        html,body{
            height: 100%;
            min-width: 1000px;
        }
        .box{
            background: #ddf3f1;
            position: relative;
            height: 100%;
        }
        .box .content{
            text-align: center;
            background: #fff;
            overflow: hidden;
            height: 182px;
        }
       .box .content p,
       .box .content a{
           position: absolute;
           color: #209ba2;
           font-size: large;
           font-weight: bold;
           left: 18%;
           top: 10%;
           z-index: 99;
        }
        .box .content a{
            border: 1px solid #209ba2;
            border-radius: 21px;
            width: 133px;
            height: 26px;
            color: #fff;
            background-color: #209ba2;
            text-align: center;
            line-height: 26px;
            margin-top: 0px;
            margin-left: 500px;
        }
        .box img{
            min-width: 1000px;
        }

    </style>
</head>
<body>
<?php $this->load->view('widgets/nav.php'); ?>

<?php $this->load->view('widgets/windows.php' ); ?>
    <div class="box">
        <div class="content">
            <p>不好意思，页面找不到啦，先去首页看看吧~</p>
            <a href="./index.php">返回首页</a>
        </div>
        <img src="./static/image/404.jpg" alt="404" width="100%"/>
    </div>
</body>
</html>