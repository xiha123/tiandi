$(document).ready(function(){
	
	$imgLook = $(".imgLook");
	$(".table-bordered tr").hover(function(e){
		$imgLook.css({"display" : "block" , "left" : $(this).offset().left , "top" : $(this).offset().top + $(this).height() })
		$imgLook.find("img").attr("src", "static/uploads/" + $(this).data("img"));
	},function(){
		$imgLook.hide();
	});
	
	$(".remove-slider").click(function(){
		$parents = $(this).parents().parents().eq(0);
		confirms({
			"title" : "您确定要删除吗",
			"icon" : "icon-trash",
			"content" : "<p>您确定要删除掉这篇文章吗？</p><p>删除后将无法复原，点击确定按钮确认删除该条记录</p>",
			"success" : function(){
				$.ajax({
					"url" : "api/admin_api/deleteSlider",
					type : "POST",
					data : {"id" : $parents.data("id")},
					dataType : "JSON",
					success: function(data){
						console.log();
						  if(data.status == true) {
							$parents.hide();
							close();
						} else {
							showAlert(data.error);
						}
					}
				});
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
			'<form method="post" action="admin/eidtIndexSlider" id="edit-form" enctype="multipart/form-data">'+
			'<table class=table-form>'+
			'<input type="hidden" value="0" name="type">'+
			'<input type="hidden" value="' + $parents.data("id")+ '" name="id">'+
			'<tr><td>轮播标题：<input type="text" value="' + $parents_baby.eq(0).text()+ '" name="title">'+
			'<tr><td>轮播地址：<input type="text" value="' + $parents.data("link")+ '" name="link">'+
			'<tr><td>轮播描述：<input type="text" value="' + $parents_baby.eq(2).text()+ '" name="description">'+
			'<tr><td>轮播背景：<input type="text" value="' + $parents.data("color")+ '" name="color" maxlength=7 class=slider-color><div class=color></div>'+
			'<tr><td class=updata><font>点击更换图片</font><input type="file" name="userfile" id="add_updata"><img src="./static/uploads/' + $parents.data("img")+ '" width="100%" id=preview>'+
			'<tr><td><span style="color:#ccc">建议图片尺寸：1200 * 400 ， 该图片尺寸：200 * 200</span ></table></form>',
			"success" : function(){
				$("#edit-form").unbind("submit");
				$("#edit-form").on("submit",function(){
					if($("input[name='title']").val() == ""){
						showAlert("您必须填写一个标题");
						return false
					}
					if($("input[name='link']").val() == ""){
						showAlert("您必须填写一个连接");
						return false
					}
					if($("input[name='description']").val() == ""){
						showAlert("您必须填写一个描述");
						return false
					}
					if($("input[name='color']").val() == ""){
						showAlert("您必须填写一个颜色");
						return false
					}
					var option = {
						type : "post",
						success:function (data) {
							data = JSON.parse(data);
							  if(data.status == "true") {
								location.reload();
							} else {
								showAlert(data.error);
							}
						}
					};
					$("#edit-form").ajaxSubmit(option);
					return false;
				});
				$("#edit-form").submit();
			}
		});
	});

	$(".add-pic").click(function(){
		input({
			"title" : "添加轮播焦点图",
			"icon" : "icon-trash",
			"content" :
			'<form method="post" action="admin/addIndexSlider" id="add" enctype="multipart/form-data">'+
			'<table class=table-form>'+
			'<input type="hidden" name="id">'+
			'<input type="hidden" value="0" name="type">'+
			'<tr><td>轮播标题：<input type="text" placeholder="请输入轮播标题" name="title">'+
			'<tr><td>轮播地址：<input type="text" placeholder="请输入轮播地址" name="link">'+
			'<tr><td>轮播描述：<input type="text" placeholder="请输入轮播描述" name="description">'+
			'<tr><td>轮播背景：<input type="text" placeholder="在此填写轮播的背景颜色" name="color" maxlength=7 class=slider-color><div class=color></div>'+
			'<tr><td class=updata><font>点击更换图片</font><input type="file" name="userfile" id="add_updata"><img src="./static/image/slide4.jpg" width="100%" id=preview>'+
			'<tr><td><span style="color:#ccc">建议图片尺寸：1200 * 400 ， 该图片尺寸：200 * 200</span ></table></form>',
			"success" : function(){
				$("#add").unbind("submit");
				$("#add").on("submit",function(){
					if($("input[name='title']").val() == ""){
						showAlert("您必须填写一个标题");
						return false
					}
					if($("input[name='link']").val() == ""){
						showAlert("您必须填写一个连接");
						return false
					}
					if($("input[name='description']").val() == ""){
						showAlert("您必须填写一个描述");
						return false
					}
					if($("input[name='color']").val() == ""){
						showAlert("您必须填写一个颜色");
						return false
					}
					if($("#add_updata").val() == ""){
						showAlert("必须添加一张轮播图片才能保存！");
						return false
					}
					var option = {
						type : "post",
						success:function (data) {
							data = JSON.parse(data);
							  if(data.status == "true") {
								location.reload();
							} else {
								showAlert(data.error);
							}
						}
					};
					$("#add").ajaxSubmit(option);
					return false;
				});
				$("#add").submit();
			}
		});
	});
})
