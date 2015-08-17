<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/search.css">
<body>
<?php
	$this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); 
	$this->load->view('widgets/windows.php' );
?>	
	<div class="wrapper">
		<li class="search-result">为您搜索到{count}个结果</li>
		{data}
		<ul class="list-data">
		<li data-id="{id}">
				<div class="link-num ajax_up"><p class="upCount">0</p><p>点赞</p></div>
				<div class="list-title">
				<a href="./problem/?p={id}" target="_blank">{title}</a>
				</div>
				<ul class="list-tag">
				<li><a href="./tag/?name=type"  target="_blank" class="tag-box">type</a></li><li><a href="./tag/?name=type"  target="_blank" class="tag-box">type</a></li><li><a href="./tag/?name=type"  target="_blank" class="tag-box">type</a></li>
			</ul>
		</ul>
		{/data}
							
			<?php
				$this->load->view("miaoda/page",array(
					"page" => $page,
					"page_max" => $count,
					"page_count" => 20,
					"page_url" => "./seacher",
					"hot" => "?key=" . $key
				));
			?>
	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>
