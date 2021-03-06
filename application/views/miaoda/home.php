	<?php $this->load->view('widgets/header.php'); ?>
	<link rel="stylesheet" href="static/css/miaoda/home.css">
    <link href="ueditor/themes/default/css/umeditor.min.css" rel="stylesheet">
<body>

<div
	id="page-info"
	class="hidden"
	data-title="秒答_国内首个针对零基础初学者学习编程的编程社区_编程问题，就上秒答"
	data-keywords="秒答,编程社区,零基础,编程问题,VR游戏,AR游戏,unity5,cocos2dx,android,ios,flash,java,html5"
	data-description="秒答是国内首个针对零基础初学者学习编程的编程社区。在这里你能提问Unity3D、Web、Cocos2D-X等热门编程领域的问题。每个问题都能被快速准确地解答，绝不留着难题过夜。让编程初学者不再走弯路，想提升编程学习效率，上秒答，就对了。"
></div>

<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>

<?php
	$this->load->view('widgets/windows.php');
	if (!isset($_SESSION['problem_temp'])) {
		$_SESSION['problem_temp'] = array('type'=>"", "title"=>"","content"=>"","tags"=>"[]","code"=>"" , "language" => -1 , "problem_id");
	}
?>
<div class="windows">
	<div class="confirm" id="confirm">
		<div class="confirm-title">
			<h2>您确定参与众筹吗？</h2>
			<a href="javascript:void(0)" class="close" id="close_window"><i class="fa fa-close"></i></a>
		</div>
		<div class="confirm-content">
			<div class="con">
				<p>您确定参与众筹吗？</p>
				<p>参与众筹后将会扣除您50银币，该操作无法反悔！您确定那么做吗</p>
			</div>
		</div>
		<div class="confirm-bottom">
			<button class="btn btn-danger button_ok">确定</button>
			<button class="btn btn-default" id="close_window">取消</button>
		</div>
	</div>
</div>

<div class="wrapper">
	<div class="doubt">
		<table class="table">
			<tr><td><input type="text" class="title" id="problem-title" value="<?=$_SESSION['problem_temp']['title']?>" placeholder="一句话写下你遇到的问题"></td></tr>
			<tr><td>
				<div class="desc">
					<script id="editor" type="text/plain" style="width:980px;height:200px;"><?= $_SESSION['problem_temp']['content']?></script>
					<div class="code-box">
						<select class="Language">
							<option value="-1" <?=$_SESSION['problem_temp']['language'] == -1 ? 'selected=""' : ""?>>请选择问题方向</option>
							<option value="0" <?=$_SESSION['problem_temp']['language'] == 0 ? 'selected=""' : ""?>>html</option>
							<option value="1" <?=$_SESSION['problem_temp']['language'] == 1 ? 'selected=""' : ""?>>php</option>
							<option value="2" <?=$_SESSION['problem_temp']['language'] == 2 ? 'selected=""' : ""?>>c++</option>
							<option value="3" <?=$_SESSION['problem_temp']['language'] == 3 ? 'selected=""' : ""?>>javascript</option>
							<option value="4" <?=$_SESSION['problem_temp']['language'] == 4 ? 'selected=""' : ""?>>java</option>
							<option value="5" <?=$_SESSION['problem_temp']['language'] == 5 ? 'selected=""' : ""?>>c#</option>
							<option value="6" <?=$_SESSION['problem_temp']['language'] == 6 ? 'selected=""' : ""?>>unity-3d</option>
							<option value="7" <?=$_SESSION['problem_temp']['language'] == 7 ? 'selected=""' : ""?>>swift</option>
							<option value="8" <?=$_SESSION['problem_temp']['language'] == 8 ? 'selected=""' : ""?>>web</option>
							<option value="9" <?=$_SESSION['problem_temp']['language'] == 9 ? 'selected=""' : ""?>>cocos2d-x</option>
							<option value="10" <?=$_SESSION['problem_temp']['language'] == 10 ? 'selected=""' : ""?>>android</option>
							<option value="11" <?=$_SESSION['problem_temp']['language'] == 11 ? 'selected=""' : ""?>>lua</option>
							<option value="12" <?=$_SESSION['problem_temp']['language'] == 12 ? 'selected=""' : ""?>>css</option>
							<option value="13" <?=$_SESSION['problem_temp']['language'] == 13 ? 'selected=""' : ""?>>objective-c</option>
							<option value="14" <?=$_SESSION['problem_temp']['language'] == 14 ? 'selected=""' : ""?>>其他</option>
						</select>
						<textarea  id="problem-code" class="code" placeholder="选择编程语言以后，写下你的问题涉及到的代码"><?=$_SESSION['problem_temp']['code']?></textarea>
					</div>
				</div>
			</td></tr>
			<tr><td><div class="tag js-tag-box" data-widget="tag">
				<input type="hidden" class="form-tag" value="">
					<?php
						$langArr = array(
							'0' => 'html',
							'1' => 'php',
							'2' => 'c++',
							'3' => 'javascript',
							'4' => 'java',
							'5' => 'c#',
							'6' => 'unity-3d',
							'7' => 'swift',
							'8' => 'web',
							'9' => 'cocos2d-x',
							'10' => 'android',
							'11' => 'lua',
							'12' => 'css',
							'13' => 'objective-c',
							'14' => '其他',
						);
						$lang = $_SESSION['problem_temp']['language'];
						if (isset($lang) && isset($langArr[$lang])) {
							echo '<span class="tag-box js-lang-tag">';
							echo $langArr[$_SESSION['problem_temp']['language']];
						} else {
							echo '<span class="tag-box js-lang-tag hidden">';
						}
					?>
				</span>
				<div class="tag-list">
					<?php
						$problemTagList = json_decode($_SESSION['problem_temp']['tags']);
						foreach ($problemTagList as $key => $value) {
							echo '<span class="tag-box"><font>'.$value.'</font> <button class="close"><i class="fa fa-close"></i></button></span>';
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
				<ul class="title cf" >
					<li <?php if($hot_type == "1"){ echo 'class="active"'; } ?>><a href="./miaoda">已答</a></li>
					<li <?php if($hot_type == "0"){ echo 'class="active"'; } ?>><a href="./miaoda?hot=hot">热门</a></li>
					<li <?php if($hot_type == "2"){ echo 'class="active"'; } ?>> <a href="./miaoda?hot=chou">未答</a></li>
				</ul>
				<ul class="outer-list">
					<li>
						<ul class="list-data">
						<?php foreach($problem_list as $key => $value){ ?>
							<li data-id="<?=$value['id']?>">
                                    <?php if ($value['type'] != 3) { ?>
								<div class="link-num js_chou" data-id="<?= $value['id'] ?>">
                                        <p class="upCount"><?= count(json_decode($value['who'])) + 1 ?></p><p>众筹</p></div>
                                    <?php } else { ?>
								<div class="link-num ajax_up">
                                        <p class="upCount"><?= $value['up_count'] ?></p><p>点赞</p></div>
                                    <?php } ?>
								<div class="list-title">
									<a href="./problem/?p=<?=$value['id']?>" target="_blank"><?=$value['title']?></a>
								</div>
								<ul class="list-tag">
								<?php
									if(!empty($value['tags'])){
										foreach ($value['tags'] as $key => $values) {
                                            if (isset($values['name'])) {
                                                echo '<li><a href="./tag/?name='.urlencode($values['name']).'"  target="_blank" class="tag-box">'.$values['name'].'</a></li>';
                                            }
										}
									}
								?>
								</ul>

								<?php if ($value['type'] >= 2) { ?>
								<div class="list-date"><?=$value['answer_id']['nickname']?>回答于：<?=date("H:i:s",$value['answer_time'])?></div>
								<?php } else {
									$owner = $this->user_model->get(array(
										'id' => $value['owner_id']
									)); ?>
								<div class="list-date"><?= $owner['nickname'] ?>创建于：<?= $value['ctime'] ?></div>
								<?php } ?>
							</li>
						<?php }?>
						</ul>

						<?php
							if($hot_type == "1") $hot = "";
							if($hot_type == "0") $hot = "&hot=hot";
							if($hot_type == "2") $hot = "&hot=chou";
							$this->load->view("miaoda/page",array(
								"page" => $page,
								"page_max" => $problem_list_count,
								"page_count" => 20,
								"page_url" => "./miaoda",
								"hot" => $hot
							));
						?>

					</li>
				</ul>
			</div>

		</div>


		<div class="right-content">
			<h2 class="box-title">热门标签</h2>
			<ul class="list-tag">
				{hot_tags}
				<li><a href="./tag?name={encode_name}" class="tag-box">{name}</a></li>
				{/hot_tags}
			</ul>
		</div>
	</div>
</div>


<script type="text/javascript">
	var tagIndex = <?=count($problemTagList)?>;
</script>
<?php $this->load->view('widgets/footer.php'); ?>
<script src="ueditor/umeditor.config.js"></script>
<script src="ueditor/umeditor.min.js"></script>
<script src="static/js/problem.home.js"></script>
</body>
</html>
