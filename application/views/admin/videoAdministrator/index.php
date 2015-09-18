	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/video.css">
</head>

<body>
<?php 
	$this->load->view('widgets/admin/window.php');
	$this->load->view('widgets/admin/left.php' , array("activeNav" => 8));
?>
<div class="load" style="">
	<img src="./static/image/5-121204193936.gif" alt="">
	<p>正在上传视频，请勿刷新页面或进行其他操作</p>
</div>

<div class="main">
	<div class="navbar navbar-default">
		<form id="uploadVideo" method="post" action="api/video_api/do_upload" enctype="multipart/form-data" onsubmit="editGuide()">
			<div class="upload">
				<input type="file" class="uploadFile" name="videoFile">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTag"><i class="fa fa-plus-circle"></i> 上传视频</button>
			</div>
		</form>
	</div>
        <div role="tabpanel" class="tab-pane active" id="guide">
		<table class="table table-bordered">
			<thead><tr>
				<th width="20%">视频名称</th>
				<th width="50%">视频地址</th>
				<th width="10%">操作</th>
			</tr></thead>
			<tbody>
			{video_list}
				<tr data-name="{name}">
					<td>{name}</td>
					<td><a href="./video/{name}">./video/{name}</a></td>
					<td>
						<i class="fa fa-trash" id="removeVideo"></i>
					</td>
				</tr>
			{/video_list}
			</tbody>
		</table>
		<?php
			$this->load->view("miaoda/page",array(
				"page" => $page,
				"page_max" => $video_count,
				"page_count" => 10,
				"page_url" => "./admin/videoAdministrator",
				"hot" => ""
			));
		?>
        </div>
   
   
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/video.js"></script>
</body>
</html>
