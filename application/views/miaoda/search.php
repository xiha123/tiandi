<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/search.css">
<body>
<?php
	$this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); 
	$this->load->view('widgets/windows.php' );
?>	
	<div class="wrapper">
		<li class="search-result">为您搜索到999个结果</li>
		<ul class="list-data">
		<li data-id="18">
				<div class="link-num ajax_up"><p class="upCount">0</p><p>点赞</p></div>
				<div class="list-title">
				<a href="./problem/?p=18" target="_blank">typetypetypetypetypetype</a>
				</div>
				<ul class="list-tag">
				<li><a href="./tag/?name=type"  target="_blank" class="tag-box">type</a></li><li><a href="./tag/?name=type"  target="_blank" class="tag-box">type</a></li><li><a href="./tag/?name=type"  target="_blank" class="tag-box">type</a></li>
			</ul>
		</ul>

		
		<div class="page">
			<ul>
				<li><a href="javascript:">< 上一页</a></li>
				<li class="active"><a href="javascript:">1</a></li>
				<li><a href="javascript:">2</a></li>
				<li><a href="javascript:">3</a></li>
				<li><a href="javascript:">下一页 ></a></li>
			</ul>
		</div>
	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>
