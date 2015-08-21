<?php
	$this->load->view('widgets/header.php'); 
	$active = 'class="active"';
?>
	<link rel="stylesheet" href="static/css/tanchuang_main.css"/>
	<link rel="stylesheet" href="static/css/olClass.css">
</head>
<body>

<?php $this->load->view('widgets/nav.php', array( "activeNav" => 0 )); ?>
<div class="windows" >
<div class="box" id="box">
	<p>
		<img src="" width="480" height="275">
		<div class="title">
			<div class="close fr"></div>
			<h2>重点一</h2>
			<div class="level">
				<h3>难度</h3>
				 <!--<i class="fa fa-star"></i> -->
			</div>
		</div><p class="content">
			
		</p></p>
		<div class="button">
			<a href="<?=!isset($site['link']) ? "javascript:;" : $site['link'];?>">
			<button>报 名 <i class="fa fa-arrow-circle-right"></i></button></a>
		</div>


</div>
</div>

<div class="main">
	<div class="wrapper">
		<div class="slider cf" data-widget="slider">
			<ul class="slider-trigger fl">
			{guide_list}
				<li><a href="{link}" target=""><img src="./static/uploads/{img}" height="120" width="200"></a></li>
			{/guide_list}

			</ul>
			<ul class="slider-sheet fl js-slider-sheet">

			<?php
				foreach ($slide_list as $key => $value) {
					echo '<li><img src="./static/uploads/'.@$value['site']['img'] . '" height="370" width="615"><div class="slider-summary"><p>课程</p><p> 
					' .$value['class']['title'] . '</p></div><div class="slider-summary"><p>课表</p><p>
					' .$value['class']['content'] . '</p></div></li>';
				}
			?>

			</ul>
			<ul class="js-slider-trigger">
				{slide_list}
				<li><a href="javascript:void(0)"></a></li>
				{/slide_list}
			</ul>
		</div>
		<div class="tab" style="height:530px;">
			<ul class="tab-trigger cf js-tab-trigger">
				<li data-id="3d" <?=$types == 0 ? $active :"" ?>><a href="./olclass?type=u3d">Unity-3D</a></li>
				<li data-id="swift" <?=$types == 1 ? $active :"" ?>><a href="./olclass?type=Swift">Swift</a></li>
				<li data-id="Web" <?=$types == 2 ? $active :"" ?>><a href="./olclass?type=Web">Web</a></li>
				<li data-id="Cocos2d-x" <?=$types == 3 ? $active :"" ?>><a href="./olclass?type=Cocos2d-x">Cocos2d-x</a></li>
				<li data-id="Android" <?=$types == 4 ? $active :"" ?>><a href="./olclass?type=Android">Android</a></li>
			</ul>
			<ul class="tab-sheet">
				<div class="course">
					<div class="description">
						<h2><?=$type_name?> 快速入门 <i class="fa fa-arrow-circle-right"></i></h2>
						<p><?=$description?></p>
					</div>
					<ul class="list">
						<?php
							for ($index = 0; $index < 4 ; $index++) { 
								if($index < 3){
									echo '<li data-index="'.($index + 1).'" data-img="'.@$class[$index]['img'].'" data-level="'.@$class[$index]['level'].'"><h3>Step '.($index + 1).'</h3><p>'. @$class[$index]['description'] . '</p><i class="fa fa-arrow-right"></i></li>';
								}else{
									echo '<li data-index="'.($index + 1).'" data-img="'.@$class[$index]['img'].'" data-level="'.@$class[$index]['level'].'" class="last"><h3>Step 4</h3><p>'. @$class[$index]['description'] . '</p><i class="fa fa-arrow-down bottom"></i></li>';
								}
							}
							$index = 8;
							while ($index --) {
								if($index < 4)break;
								if($index < 5){
									echo '<li data-index="'.($index + 1).'" data-img="'.@$class[$index]['img'].'" data-level="'.@$class[$index]['level'].'" class="last"><h3>Step '.($index + 1).'</h3><p>'. @$class[$index]['description'] . '</p></li>';
								}else{
									echo '<li data-index="'.($index + 1).'" data-img="'.@$class[$index]['img'].'" data-level="'.@$class[$index]['level'].'"><h3>Step '.($index + 1).'</h3><p>'. @$class[$index]['description'] . '</p><i class="fa fa-arrow-left"></i></li>';
								}
							}
						?>
					</ul>
				</div>
				
			</ul>
		</div>
	</div>
</div>

<?php $this->load->view('widgets/footer.php'); ?>
<script src="static/js/olClass.js"></script>

</body>
</html>
