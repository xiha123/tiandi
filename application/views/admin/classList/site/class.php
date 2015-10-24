<div class="site-box">
	<h2>公开课课程发布时间设置</h2><br>
	<table class="table table-bordered">
		<tr>
			<th width="40%">名称</th>
			<th>发布时间</th>
			<th>发布内容</th>
			<th width="8%">操作</th>
		</tr>
		{class}
		<tr data-id="{id}">
			<td>{title}</td>
			<td>{time}</td>
			<td>{content}</td>
			<td><i class="fa fa-edit edit-public" data-type="0"></i><i class="fa fa-trash remove-public"></i></td>
		</tr>
		{/class}
	</table>
	<?php
		$this->load->view("miaoda/page",array(
			"page" => $page,
			"page_max" => $class_count,
			"page_count" => 10,
			"page_url" => "./admin/classListSite/{$type}",
			"hot" => "&type=class"
		));
	?>
	<button class="btn btn-primary public-class" style="float:right" data-type="0"><i class="fa fa-list"></i> &nbsp;添加课程</button>
</div>