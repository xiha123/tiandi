<div class="site-box">
	<h2>课程内容章节设置</h2><br>
	<table class="table table-bordered">
		<tr>
			<th width="40%">名称</th>
			<th>内容</th>
			<th width="8%">操作</th>
		</tr>
		{chapter}
		<tr data-id="{id}">
			<td>{title}</td>
			<td>{content}</td>
			<td><i class="fa fa-edit edit-classContent"></i><i class="fa fa-trash remove-classContent"></i></td>
		</tr>
		{/chapter}
	</table>
	<?php
		$this->load->view("miaoda/page",array(
			"page" => $page,
			"page_max" => $chapter_count,
			"page_count" => 10,
			"page_url" => "./admin/classListSite/{$type}",
			"hot" => "&type=chapter"
		));
	?>
	<button class="btn btn-primary" style="float:right" id="add-classContent"><i class="fa fa-list"></i> &nbsp;添加课程</button>
</div> 	