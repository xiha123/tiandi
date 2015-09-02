<div class="page">
	<?php
		if(isset($search) && $search){
			echo '<div class="search fl"><form action="javascript:;" onsubmit="' . $search_function_name . '"><input type="text" placeholder="请输入问题编号" value="' . $this->input->get('search') . '" id="searchName"><input type="submit" value="搜索"></form></div>';
		}
	?>


	<ul class="fr">
		<?php
			$count = ceil($page_max / $page_count);
			if($count > 1){
				echo $page > 1 ? '<li><a href="'.$page_url.'/?page='.(1).$hot.'"><<</a></li><li><a href="'.$page_url.'/?page='.($page - 1).$hot.'">< 上一页</a></li>' : "<li></li>";
				if($count > 10){
					for($index = $page - 3; $index < $page + 5;$index ++){
						if($index > 0 && $index  < $count){
							$active = $page == $index  ? " class='active'" : "";
							echo '<li'.$active.'><a href="'.$page_url.'/?page='.$index.$hot.'">'.$index.'</a></li>';
							$temp = $index;
						}
					}
					if($temp != $count - 1){
						echo '<li><a href="javascript:">······</a></li>';
					}

					echo '<li><a href="'.$page_url.'/?page='.$count.$hot.'">'.$count.'</a></li>';
				}else{
					for($index = 1; $index < $count + 1;$index ++){
						$active = $page == $index ? " class='active'" : "";
						echo '<li'.$active.'><a href="'.$page_url.'/?page='.$index.$hot.'">'.$index.'</a></li>';
					}
				}
				echo $page < $count ? '<li><a href="'.$page_url.'/?page='.($page + 1).$hot.'">下一页 ></a></li><li><a href="'.$page_url.'/?page='.($count).$hot.'">>></a></li>' : "";
			}
		?>
	</ul>
</div>