<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/home.css">
<body>
<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
       
<?php 
	$this->load->view('widgets/windows.php' ); 
	if(!isset($_SESSION['problem_temp'])){
		$_SESSION['problem_temp'] = array('type'=>"", "title"=>"","content"=>"","tags"=>"[]","code"=>"" , "language" => 0 , "problem_id");
	}
?>

<div class="wrapper">

	<div class="doubt">
		<table class="table">
			<tr><td><input type="text" class="title" id="problem-title" value="<?=$_SESSION['problem_temp']['title']?>" placeholder="一句话写下你遇到的问题"></td></tr>
			<tr><td>
				<div class="desc">
					<script id="editor" type="text/plain" style="width:980px;height:180px;"><?=$_SESSION['problem_temp']['content']?></script>
					<div class="code-box">
						<select class="Language">
							<option value="0" <?=$_SESSION['problem_temp']['language'] == 0 ? 'selected=""' : ""?>>html</option>						
							<option value="1" <?=$_SESSION['problem_temp']['language'] == 1 ? 'selected=""' : ""?>>php</option>						
							<option value="2" <?=$_SESSION['problem_temp']['language'] == 2 ? 'selected=""' : ""?>>C++</option>						
							<option value="3" <?=$_SESSION['problem_temp']['language'] == 3 ? 'selected=""' : ""?>>javascript</option>
							<option value="4" <?=$_SESSION['problem_temp']['language'] == 4 ? 'selected=""' : ""?>>java</option>
							<option value="5" <?=$_SESSION['problem_temp']['language'] == 5 ? 'selected=""' : ""?>>其他</option>
						</select>
						<textarea  id="problem-code" class="code" placeholder="选择编程语言以后，写下你的问题涉及到的代码"><?=$_SESSION['problem_temp']['code']?></textarea>
					</div>
				</div>
			</td></tr>
			<tr><td><div class="tag" data-widget="tag">
				<input type="hidden" class="form-tag" value="">
				<div class="tag-list">
					<?php
						$problemTagList = json_decode($_SESSION['problem_temp']['tags']);
						foreach ($problemTagList as $key => $value) {
							echo '<span class="tag-box"><font>'.$value.'</font> <button class="close">X</button></span>';
						}
					?>
					
				</div>
				<div class="input-tag">
					<input type="text" class="input-tag" placeholder="请输入标签">
					<div class="tag-ide">
						<ul>
						</ul>
					</div>
				</div>
				
			</div></td></tr>
			<tr><td><label><input type="checkbox" id="js_coinType"><span>使用金币提问</span></label></td></tr>
		</table>
		<div class="button submit">
			<button id="ajax_problemSubmit">提交 <img src="static/image/sign-up.png"></button>
		</div>
	</div>

	<div class="content">
		<div class="left-content">

			<div class="tab">
				<ul class="title" >
					<li <?php if($hot_type == "1"){ echo 'class="active"'; } ?>><a href="./miaoda">最新</a></li>
					<li <?php if($hot_type == "0"){ echo 'class="active"'; } ?>><a href="./miaoda?hot=hot">热门</a></li>
					<li <?php if($hot_type == "2"){ echo 'class="active"'; } ?>> <a href="./miaoda?hot=chou">众筹</a></li>
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
												echo '<li><a href="./tag/?name='.urlencode($values['name']).'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
											}
										}
									?>
								</ul>

								<div class="list-date"> 提问于：<?=$value['ctime']?></div>
							</li>
						<?php }?>
						</ul>

						<?php
							$this->load->view("miaoda/page",array(
								"page" => $page,
								"page_max" => $problem_list_count,
								"page_count" => 20,
								"page_url" => "./miaoda",
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
					if($tag_list){
						foreach ($tag_list as $key => $value) {
							echo '<li><a href="./tag/?name=' . urlencode($value['name']) . '" class="tag-box">'.$value['name'].'</a></li>';
						}
					}
				?>
				<!-- <li><a href="#" > 更多</a></li> -->
			</ul>
		</div>

	</div>


</div>
<script type="text/javascript">
	var tagIndex = <?=count($problemTagList)?>;
</script>
<?php $this->load->view('widgets/footer.php'); ?>
<script src="ueditor/ueditor.config.js"></script>
<script src="ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
	var ue = UE.getEditor('editor');
</script>
<script src="./static/js/problem.home.js"></script>
</body>
</html>
