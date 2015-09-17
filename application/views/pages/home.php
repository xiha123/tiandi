<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/home.css"/>
	 </head>
<body>

<?php $this->load->view('widgets/nav.php'); ?>
<body class="index">
<div class="box">
	<div class="head-slides">
		<img src="./static/image/hopepage.jpg" alt="编程实现梦想"class="head1" />
	</div>
	<div class="content">
		<div class="wrap icon">
			<ul>
				<li><img src="./static/image/icon1.png" alt=""></li>
				<li class="center"><img src="./static/image/icon2.png" alt=""></li>
				<li><img src="./static/image/icon3.png" alt=""></li>
			</ul>
		</div>
	</div>
	<div class="content hr">
		<div class="wrap a">
			<div class="content1 fl contentLogo"></div>
			<div class="content1-text fr text"></div>
		</div>
	</div>

	<div class="content">
		<div class="wrap b" >
			<div class="content2 fr contentLogo"></div>
			<div class="content2-text fl text"></div>
		</div>
	</div>

	<div class="content hr">
		<div class="wrap c">
			<div class="content3 fl contentLogo"></div>
			<div class="content3-text fr text"></div>
		</div>
	</div>

	<div class="content">
		<div class="wrap d">
			<div class="content4 fr contentLogo"></div>
			<div class="content4-text fl text"></div>
		</div>
	</div>

	<div class="content hr">
		<div class="wrap e">
			<div class="content5 fl contentLogo"></div>
			<div class="content5-text fr text"></div>
		</div>
	</div>


	<!-- footer -->
	<div class="content footer">
		<div class="wrap">
			<div class="footer-logo">
				<a  href="https://tdpx.taobao.com/index.htm" target="_blank"><img src="./static/image/tao.png" alt=""></a>
				<a  href="http://weibo.com/tiandipeixun/" target="_blank"><img src="./static/image/sina.png" alt=""></a>
				<a  href="javascript:;" class="wechat"><img src="./static/image/TD.jpg" alt="" class="weChatCode"><img src="./static/image/wechat.png" alt=""></a>
				<a  href="http://sighttp.qq.com/authd?IDKEY=eb5646f63901b8a68ccaea689999acaa5bceaab20544f22b" target="_blank"><img src="./static/image/bottom_qq.png" alt=""></a>
			</div>
			<div class="footer-nav">
				<a href="javascript:;">关于我们</a>
				<a href="javascript:;">人才招聘</a>
				<a href="javascript:;">讲师招聘</a>
				<a href="javascript:;">联系我们</a>
			</div>
		</div>
		<div class="friend">
			<span>友情链接：</span>
			<a href="http://www.9ria.com/" target="_blank">9RIA天地会</a>
			<a href="http://ke.qq.com/" target="_blank">腾讯课堂</a>
			<a href="http://www.egret.com/" target="_blank">白鹭引擎</a>

		</div>
		<p class="bottom">Copyright © 2015 天地培训. All Rights Reserved 浙ICP备09080888号</p>

	</div>

</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script>
	$wrap = $(".a , .b , .c , .d , .e");
	$wrap.css({"opacity" : "0"});
	var infoIndex = 0 ,
		$initLogo = $(".contentLogo").eq(infoIndex).parents() ,
		windowHeight = $(window).height()
		tempArray = [],
		contentCount = $(".contentLogo").length,
		scrollType = true;

	(function(){
		$.each($wrap , function(key,value){
			tops = ($(value).offset().top - $(window).scrollTop()) - windowHeight;
			if(tops <= -30){
				$(value).css({"opacity" : "1"}).find(".text").animate({"margin-top" : "70px"});
				$(value).find(".contentLogo").animate({"margin-top" : "0px"} , 700);
			}
		})
	})($);

	$(".wechat").hover(function(){
		$(".weChatCode").show();	
	},function(){
		$(".weChatCode").hide();
	})

	$(document).scroll(function(){
		scroll();
	});

	function scroll(){
		scrollTop = $initLogo.offset().top - $(window).scrollTop();
		if(scrollTop < windowHeight - 100 && scrollType){
			$initLogo.eq(0).css({"opacity" : "1"}).find(".text").animate({"margin-top" : infoIndex === 2 ? "30px" : "70px"});
			$initLogo.eq(0).find(".contentLogo").animate({"margin-top" : "0px"} , 700);
			infoIndex++;
			scrollType = infoIndex >= 5 ? false : true;
			if(infoIndex < 5){
				tempArray[infoIndex] = true;
				$initLogo = $(".contentLogo").eq(infoIndex).parents();
			}
			console.log(infoIndex);
		}
	}
</script>


</body>
</html>
