<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/seconds/home.css">

<body>
<?php $this->load->view('widgets/seconds/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>

<div class="wrapper">

	<div class="doubt">
		<table class="table">
			<tr><td><input type="text" class="title" id="problem-title" placeholder="一句话写下你遇到的问题"></td></tr>
			<tr><td>
				<div class="desc">
					<script id="editor" type="text/plain" style="width:980px;height:180px;"></script>
					<a href="javascript:" class="Language">选择语言</a>
					<textarea  id="problem-code" class="code" placeholder="选择编程语言以后，写下你的问题涉及到的代码"></textarea>
				</div>
			</td></tr>
			<tr><td><div class="tag" data-widget="tag">
				<input type="hidden" class="form-tag" value="">
				<input type="text" class="input-tag" placeholder="请输入标签">
			</div></td></tr>
		</table>
		<div class="button submit">
			<button id="ajax_problemSubmit">提交 <img src="static/image/sign-up.png"></button>
		</div>
	</div>
	
	<div class="content">
		<div class="left-content">

			<div class="tab" data-widget="tab" >
				<ul class="title  cf js-tab-trigger" data-widget="tab" >
					<li class="active"><a href="javascript:">最新</a></li>
					<li><a href="javascript:">热门</a></li>
					<li><a href="javascript:">众筹</a></li>
				</ul>
				<ul class="list-data tab-sheet  js-tab-sheet">
					<li>
						<ul class="list-data">
						<?php foreach($problem_list as $key => $value){ ?>			
							<li data-id="<?=$value['id']?>">
								<div class="link-num ajax_up"><p class="upCount"><?=$value['up_count']?></p><p>点赞</p></div>
								<div class="list-title">
									<a href="./seconds/p/<?=$value['id']?>.html" target="_blank"><?=$value['title']?></a>
								</div>
								<ul class="list-tag">
									<li><a href="#" class="tag-box">html5</a></li>
									<li><a href="#" class="tag-box">javascript</a></li>
									<li><a href="#" class="tag-box">jquery</a></li>
								</ul>
								<div class="list-date"> 提问于：<?=$value['ctime']?></div>
							</li>	
						<?php }?>
						</ul>
						<div class="page">
							<ul>
								<?php
									if($page > 1){echo '<li><a href="./seconds/?page='.($page - 1).'">< 上一页</a></li>';}
									$active = "";
									$count = ceil($problem_list_count / 20);
									for($index = 1; $index < $count + 1;$index ++){
										if($index == $page)$active = " class='active' ";
										echo '<li'.$active.'><a href="./seconds/?page='.($index).'">'.($index).'</a></li>';
										$active = "";
									}
									if($page < $count){echo '<li><a href="./seconds/?page='.($page + 1).'">下一页 ></a></li>';}
								?>
							</ul>
						</div>
					</li>
					<li>2</li>
					<li>3</li>
				</ul>
			</div>


			
		</div>





		<div class="right-content">
			<h2 class="box-title">热门标签</h2>

			<ul class="list-tag">
				<li><a href="#" class="tag-box">html5</a></li>
				<li><a href="#" class="tag-box">javascript</a></li>
				<li><a href="#" class="tag-box">jquery</a></li>
				<li><a href="#" > 更多</a></li>
			</ul>
		</div>

	</div>


</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script src="ueditor/ueditor.config.js"></script>
<script src="ueditor/ueditor.all.min.js"></script>
<script src="./static/js/problem.home.js"></script>
</body>
</html>