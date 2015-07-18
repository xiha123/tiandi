$(document).ready(function(){
	$(".remove-slider").click(function(){
		confirms({
			"title" : "您确定要删除吗",
			"icon" : "icon-trash",
			"content" : "<p>您确定要删除掉这篇文章吗？</p><p>删除后将无法复原，点击确定按钮确认删除该条记录</p>",
			"success" : function(){
				alert("");
			}
		});
	});

	$(".edit-slider").click(function(){
		$parents = $(this).parents().parents().eq(0);
		$parents_baby = $parents.find("td");

		input({
			"title" : "编辑轮播焦点图",
			"icon" : "icon-trash",
			"content" :
			'<table class=table-form>'+
			'<form action="" method="post">'+
			'<input type="hidden" value="' + $parents.data("id")+ '" name="id">'+
			'<tr><td>轮播标题：<input type="text" value="' + $parents_baby.eq(0).text()+ '">'+
			'<tr><td>轮播地址：<input type="text" value="' + $parents.data("link")+ '">'+
			'<tr><td>轮播描述：<input type="text" value="' + $parents_baby.eq(3).text()+ '">'+
			'<tr><td>轮播背景：<input type="text" value="' + $parents.data("color")+ '" maxlength=7 class=slider-color><div class=color></div>'+
			'<tr><td class=updata><font>点击更换图片</font><input type=file name="userfile"><img src="' + $parents.data("img")+ '" width="100%" id=preview>'+
			'<tr><td><span style="color:#ccc">建议图片尺寸：1200 * 400 ， 该图片尺寸：200 * 200</span ></table>',
			"success" : function(){
				alert("");
			}
		});
	});

	$(".add-pic").click(function(){
		showAlert("2")
		input({
			"title" : "添加轮播焦点图",
			"icon" : "icon-trash",
			"content" :
			'<form method="post" action="admin/addIndexSlider" id="add" enctype="multipart/form-data">'+
			'<table class=table-form>'+
			'<input type="hidden" name="id">'+
			'<tr><td>轮播标题：<input type="text" placeholder="请输入轮播标题" name="title">'+
			'<tr><td>轮播地址：<input type="text" placeholder="请输入轮播地址" name="link">'+
			'<tr><td>轮播描述：<input type="text" placeholder="请输入轮播描述" name="description">'+
			'<tr><td>轮播背景：<input type="text" placeholder="在此填写轮播的背景颜色" name="color" maxlength=7 class=slider-color><div class=color></div>'+
			'<tr><td class=updata><font>点击更换图片</font><input type="file" name="userfile"><img src="./static/image/slide4.jpg" width="100%" id=preview>'+
			'<tr><td><span style="color:#ccc">建议图片尺寸：1200 * 400 ， 该图片尺寸：200 * 200</span ></table></form>',
			"success" : function(){
				$("#add").on("submit",function(){
					var option = {
						type : "post",
						success:function (data) {
							console.log(data);
						}
					};
					$("#add").ajaxSubmit(option);
					return false;   //阻止表单默认提交
				});
				$("#add").submit();
			}
		});
	});
})
