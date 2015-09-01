<div class="site-box updata">
	<h2>设置课程照片</h2><br>
	<div class="updataBox">
		<img src="<?=!isset($site['img']) ? "static/image/slide1.jpg" : './static/uploads/' . $site['img'] ?>" class="preview">
		<form enctype="multipart/form-data" action="api/upload/pic" id="classpic" method="post">
			<input type="hidden" name="id" value="{id}" class="updata-class">
			<input type="file" name="userfile" class="updata-class">
		</form>
	</div>
	<button class="btn btn-success" style="float:right" id="updataPic"><i class="fa fa-list"></i> &nbsp;保存</button>
</div> 