	<?php $this->load->view('widgets/admin/header.php'); ?>
	<link rel="stylesheet" href="static/css/admin/tags.css">
</head>

<body>
<?php $this->load->view('widgets/admin/left.php', array("activeNav" => 11)); ?>

<div class="main">
	<div class="navbar navbar-default">
		<form class="form-inline fr" action="javascript:;" onsubmit="searchOn('./admin/stats')">
			<div class="input-group">
				<input type="pid" class="form-control" id="searchName" placeholder="用户昵称">
				<div class="input-group-addon"><button class="search"><i class="fa fa-search"></i></button></div>
			</div>
		</form>
	</div>
	<table class="table table-bordered">
		<thead><tr>
			<th width="15%">id</th>
			<th width="10%">用户</th>
			<th width="10%">邀请人</th>
			<th width="10%">注册ip</th>
			<th width="50%">创建时间</th>
		</tr></thead>
		<tbody>
		 <?php foreach($list as $user_info){?>
			<tr data-id="{id}">
                <td><?php echo $user_info['id'];?></td>

                <td><?php echo $user_info['user_info']['nickname'].'|'.$user_info['user_info']['id'];?></td>
				<td><?php echo $user_info['pt_info']['nickname'].'|'.$user_info['pt_info']['id'];?></td>
                <td><?php echo $user_info['user_info']['register_ip'];?></td>

                <td><?php echo date('Y-m-d H:i:s',$user_info['created_at'])?></td>

			</tr>
         <?php };?>

		</tbody>
	</table><br>



	<?php
		$this->load->view("miaoda/page",array(
			"page" => $page,
			"page_max" => $count,
			"page_count" => 10,
			"page_url" => $page_url,
			"hot" => "",
		));
	?>
</div>

<?php $this->load->view('widgets/admin/footer.php'); ?>
<script>

    function searchOn(){
        var pid = $('#searchName').val();
        var url = '/admin/stats?pid='+pid;
        location.href = url;
    }
</script>
</body>
</html>
