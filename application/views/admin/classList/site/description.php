<div class="site-box">
	<h2><i class="fa fa-external-link"></i>报名地址及描述</h2><br>
	<table>

		<tr>
			<td>报名按钮地址：</td>
			<td><input type="text" class="link" value="<?=!isset($steps['link']) ? "" :$steps['link']?>" placeholder="请在此处填写报名地址"></td>
		</tr>
		<tr>
			<td>课程详情描述：</td>
			<td><textarea  name="direction" class="direction" placeholder="请在此处填写课程详情描述">{description}</textarea></td>
			<td><button class="btn btn-primary" style="float:right" id="save-link" data-id="{id}"><i class="fa fa-save"></i> &nbsp;保存</button></td>
		</tr>
	</table>
</div>