<div class="window">
	<img src="" class="temp-image">
	
	
	<!-- 确认是否弹窗 -->
	<div class="confirm" id="confirm" style="display:none">
		<div class="confirm-title">
			<h2>您确定删除吗</h2>
			<a href="javascript:void(0)" class="close">X</a>
		</div>
		<div class="confirm-content">
			<i class=""></i>
			<div class="con">
				<p>您确定要删除掉这篇文章吗？</p>
				<p>删除后将无法复原，点击确定按钮确认删除该条记录</p>
			</div>
		</div>
		<div class="confirm-bottom">
			<button class="btn btn-danger button_ok">确定</button>
			<button class="btn btn-default" id="close">取消</button>
		</div>
	</div>
	
	
	<!-- 编辑或添加轮播图 -->
	<div class="confirm" id="input" style="display:none">
		<div class="confirm-title">
			<h2>您确定删除吗</h2>
			<a href="javascript:void(0)" class="close">X</a>
		</div>
		<div class="confirm-content">
			<div class="con" style="padding:0px 20px;">
				<table class="table-form">
					<tr><td>轮播标题：<input type="text" placeholder="请输入轮播标题"/></td></tr>
					<tr><td>轮播地址：<input type="text" placeholder="请输入轮播地址" /></td></tr>
					<tr><td>轮播描述：<input type="text" placeholder="请输入轮播描述" /></td></tr>
					<tr><td>轮播背景：<input type="text" placeholder="在此填写轮播的背景颜色" maxlength="7" class="slider-color"/><div class="color"></div></td></tr>
					<tr><td class="updata"><font>点击更换图片</font><input type="file"><img src="../static/image/slide4.jpg" width="100%" id="preview"></td></tr>
					<tr><td><span style="color:#ccc">建议图片尺寸：1200 * 400 ， 该图片尺寸：200 * 200</span ></td></tr>
				</table>
			</div>
		</div>
		<div class="confirm-bottom">
			<button class="btn btn-danger button_ok">确定</button>
			<button class="btn btn-default" id="close">取消</button>
		</div>
	</div>
	
	
	<!-- 单温馨提示弹窗 -->
	<div class="confirm" style="display:none">
		<div class="confirm-title">
			<h2>您确定删除吗</h2>
			<a href="javascript:void(0)" class="close">X</a>
		</div>
		<div class="confirm-content">
			<i class="icon-trash"></i>
			<p>您确定要删除掉这篇文章吗？</p>
			<p>删除后将无法复原，点击确定按钮确认删除该条记录</p>
		</div>
		<div class="confirm-bottom">
			<button class="btn btn-primary" id="close">确定</button>
		</div>
	</div>
	
</div>
