	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/video.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php' , array("activeNav" => 8)); ?>

<div class="main">
	<div class="navbar navbar-default">
		<form id="uploadVideo" method="post" action="api/guide_api/edit_guide" enctype="multipart/form-data" onsubmit="editGuide()">
			<div class="upload">
				<input type="file" class="uploadFile" name="videoFile">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTag"><i class="fa fa-plus-circle"></i> 上传视频</button>
			</div>
		</form>
	</div>
        <div role="tabpanel" class="tab-pane active" id="guide">
		<table class="table table-bordered">
			<thead><tr>
				<th width="40%">视频名称</th>
				<th width="30%">视频地址</th>
				<th width="10%">操作</th>
			</tr></thead>
			<tbody>
			{guide_list}
				<tr data-id="{id}" data-img="{img}">
					<td>{name}</td>
					<td><a href="static/uploads/{img}">{img}</a></td>
					<td>
						<i class="fa fa-remove" data-toggle="modal" data-target="#editGuide" data-type="edit"></i>
					</td>
				</tr>
			{/guide_list}
			</tbody>
		</table>
        </div>
   
   
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script src="static/js/admin/video.js"></script>
</body>
</html>
