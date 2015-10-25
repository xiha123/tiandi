<?php $this->load->view('widgets/header.php'); ?>
<link rel="stylesheet" href="./static/css/miaoda/notice.css">
<body>
<?php $this->load->view('widgets/miaoda/nav.php' , array("activeNav" => 0)); ?>
<?php $this->load->view('widgets/windows.php' ); ?>
	<!-- 用户通知中心 -->
	<div class="wrapper">
		<h2 class="box-title none-border title">通知</h2>
		<div class="button">
			<button class="none-background" id="checkAll">全选</button>
			<button class="none-background" id="notAll">反选</button>
			<button id="delete">删除</button>
		</div>
		<div class="notice">
			<table>
				{news_list}
				<tr>
					<th></th>
					<th></th>
					<th width="170"></th>
				</tr>
				<tr>
					<td><input type="checkBox" name="delete" data-id="{id}" class="delete"></td>
					<td><p class="notice-title">{content}</p></td>
					<!--<td><p class="notice-time">date("Y-m-d H:i:s",$value['time'])</p></td>-->
					<td><p class="notice-time">{ctime}</p></td>
				</tr>
				{/news_list}
			</table>
			<?php
				$this->load->view("miaoda/page",array(
					"page" => $page,
					"page_max" => $news_count,
					"page_count" => 20,
					"page_url" => "./notice/",
					"hot" => ""
				));
			?>
		</div>
	</div>
<?php $this->load->view('widgets/footer.php'); ?>
<script src="static/js/admin/notice.js"></script>
</body>
</html>
