$imgLook = $(".imgLook");
$(".table-bordered tr").hover(function(e){
	$imgLook.css({"display" : "block" , "left" : $(this).offset().left , "top" : $(this).offset().top + $(this).height() })
	$imgLook.find("img").attr("src", "static/uploads/" + $(this).data("img"));
},function(){
	$imgLook.hide();
});


$(".edit-slider").click(function(){
	$parents = $(this).parents().parents().eq(0);
	$parents_baby = $parents.find("td");

	input({
		"title" : "编辑轮播焦点图",	
		"content" : 
		'<form method="post" action="admin/eidtIndexSlider" id="edit-form" enctype="multipart/form-data">'+
		'<table class=table-form>'+
		'<input type="hidden" value="1" name="type">'+
		'<input type="hidden" value="' + $parents.data("id")+ '" name="id">'+
		'<tr><td>轮播标题：<input type="text" value="' + $parents_baby.eq(0).text()+ '" name="title">'+
		'<tr><td>轮播地址：<input type="text" value="' + $parents.data("link")+ '" name="link">'+
		'<tr><td>轮播描述：<input type="text" value="' + $parents_baby.eq(3).text()+ '" name="description">'+
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