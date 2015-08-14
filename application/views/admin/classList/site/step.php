<div class="site-box">
	<h2>课程步骤设置</h2><br>
	<table class="table table-bordered">
		<tr>
			<th width="30%">标题</th>
			<th width="50%">描述</th>
			<th>难度</th>
			<th width="8%">操作</th>
		</tr>
		{steps}
		<tr data-id="{id}" data-img="{img}">
			<td>{title}</td>
			<td>{description}</td>
			<td>{level}</td>
			<td><i class="fa fa-edit edit-steup" data-type="0"></i><i class="fa fa-trash remove-steup"></i></td>
		</tr>
		{/steps}
	</table>
	<?php
		$this->load->view("miaoda/page",array(
			"page" => $page,
			"page_max" => $steps_count,
			"page_count" => 10,
			"page_url" => "./admin/classListSite/{$type}",
			"hot" => "&type=step"
		));
	?>
	<button class="btn btn-primary add-steup" style="float:right" data-type="0"><i class="fa fa-list"></i> &nbsp;添加课程</button>
</div>
<script src="./static/js/admin/site_steup.js"></script>
