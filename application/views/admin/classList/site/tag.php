<div class="site-box">
	<h2><i class="fa fa-tag"></i>课程特色介绍</h2><br>
	<table class="table table-bordered">
		<tr>
			<th width="40%">名称</th>
			<th width="8%">地址</th>
			<th width="8%">操作</th>
		</tr>
		{tags}
		<tr data-id="{id}">
			<td>{name}</td>
			<td><a href="{link}">点击浏览</a></td>
			<td><i class="fa fa-edit edit-slider"></i><i class="fa fa-trash remove-tag"></i></td>
		</tr>
		{/tags}
	</table>
	<?php
		$this->load->view("miaoda/page",array(
			"page" => $page,
			"page_max" => $tag_count,
			"page_count" => 10,
			"page_url" => "./admin/classListSite/{$type}",
			"hot" => "&type=tag"
		));
	?>
	<button class="btn btn-primary" style="float:right" id="add-classList"><i class="fa fa-tag"></i> &nbsp;&nbsp;&nbsp;添加课程特色标签</button>
</div>

