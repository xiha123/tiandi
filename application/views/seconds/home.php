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

			<div class="tab">
				<ul class="title" >
					<li <?php if(!$hot_type){ echo 'class="active"'; } ?>><a href="./seconds">最新</a></li>
					<li <?php if($hot_type){ echo 'class="active"'; } ?>><a href="./seconds?hot=hot">热门</a></li>
					<li><a href="javascript:">众筹</a></li>
				</ul>
				<ul class="list-data">
					<li>
						<ul class="list-data">
						<?php foreach($problem_list as $key => $value){ ?>			
							<li data-id="<?=$value['id']?>">
								<div class="link-num ajax_up"><p class="upCount"><?=$value['up_count']?></p><p>点赞</p></div>
								<div class="list-title">
									<a href="./problem/?p=<?=$value['id']?>" target="_blank"><?=$value['title']?></a>
								</div>
								<ul class="list-tag">
									<?php
										if(isset($value['tags'])){
											foreach ($value['tags'] as $key => $values) {
												echo '<li><a href="./tag/?name='.$values['name'].'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
											}
										}
									?>
								</ul>
								
								<div class="list-date"> 提问于：<?=$value['ctime']?></div>
							</li>	
						<?php }?>
						</ul>
						
						<?php
							$this->load->view("seconds/page",array(
								"page" => $page,
								"page_max" => $problem_list_count,
								"page_count" => 20,
								"page_url" => "./seconds",
								"hot" => $hot_type ? "&hot=hot":""
							));
						?>
					</li>
				</ul>
			</div>


			
		</div>





		<div class="right-content">
			<h2 class="box-title">热门标签</h2>

			<ul class="list-tag">
				<?php
					$tag_list = $this->tag_model->get_tag(0 , 20 , "all");
					foreach ($tag_list as $key => $value) {
						echo '<li><a href="./tag/?name=' . $value['name'] . '" class="tag-box">'.$value['name'].'</a></li>';
					}
				?>
				<!-- <li><a href="#" > 更多</a></li> -->
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