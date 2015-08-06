<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/seconds/notice.css">
<body>
<?php $this->load->view('widgets/seconds/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
	<!-- 用户通知中心 -->
	<div class="wrapper">
		<h2 class="box-title none-border title">通知</h2>
		<div class="button">
			<button class="none-background">全选</button>
			<button class="none-background">反选</button>
			<button>删除</button>
		</div>
		<div class="notice">
			<table>
				<?php
					foreach ($news_list as $key => $value) {
						echo '<tr><td><label><input type="checkBox" name="delete[]"></td><td><p class="notice-title">'.$value['content'].'</p></td><td><p class="notice-time">'.date("Y-m-d H:i:s",$value['time']).'</p></label></td></tr>';
					}
				?>	
				
			</table>
			<div class="page">
				<ul>
					<?php
						if($page > 1){echo '<li><a href="./notice/?page='.($page - 1).'">< 上一页</a></li>';}else{echo"<li></li>";}
						$active = "";
						$count = ceil($news_count / 20);
						for($index = 1; $index < $count + 1;$index ++){
							if($index == $page)$active = " class='active' ";
							echo '<li'.$active.'><a href="./notice/?page='.($index).'">'.($index).'</a></li>';
							$active = "";
						}
						if($page < $count){echo '<li><a href="./notice/?page='.($page + 1).'">下一页 ></a></li>';}
					?>
				</ul>
			</div>	
		</div>

	</div>
<?php $this->load->view('widgets/footer.php'); ?>
</body>
</html>