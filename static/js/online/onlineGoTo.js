// 移动浏览

$imgLook = $(".imgLook");
$("tbody tr").hover(function(e){
	if (!$(this).data('img')) return;
	$imgLook.css({"display" : "block" , "left" : $(this).offset().left , "top" : $(this).offset().top + $(this).height() })
	$imgLook.find("img").attr("src", "static/uploads/" + $(this).data("img"));
},function(){
	$imgLook.hide();
});

$(".edit-guide").click(function(event) {
	$parents = $(this).parents().parents().eq(0);
	$parents_baby = $parents.find("td");
	input({
		"title" : "编辑新手指南",
		"content" :
		'<form method="post" action="api/guide_api/edit_guide" id="edit-form" enctype="multipart/form-data">'+
		'<table class=table-form>'+
		'<input type="hidden" value="' + $parents.data("id")+ '" name="id">'+
		'<tr><td>引导标题：<input type="text" value="' + $parents_baby.eq(0).text()+ '" name="title">'+
		'<tr><td>引导地址：<input type="text" value="' + $parents.data("link")+ '" name="link">'+
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
				var option = {
					type : "post",
					success:function (data) {
						data = JSON.parse(data);
						  if(data.status == true) {
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

// $(".remove-guide").click(function(){
// 	$parents = $(this).parents().parents().eq(0);
// 	confirms({
// 		"title" : "您确定要删除吗",
// 		"icon" : "icon-trash",
// 		"content" : "<p>您确定要删除掉这个课程吗？</p><p>删除后将无法复原，点击确定按钮确认删除该课程</p>",
// 		"success" : function(){
// 			$.ajax({
// 				"url" : "api/guide_api/delete_guide",
// 				type : "POST",
// 				data : {"id" : $parents.data("id")},
// 				dataType : "JSON",
// 				success: function(data){
// 					  if(data.status == true) {
// 						$parents.hide();
// 						close();
// 					} else {
// 						showAlert(data.error);
// 					}
// 				}
// 			});
// 		}
// 	});
// 	return false;
// })
