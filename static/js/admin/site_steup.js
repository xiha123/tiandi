$(".add-steup").click(function(event) {
		input({
			"title" : "添加课程步骤",
			"icon" : "icon-trash",
			"content" :
			'<form method="post" action="api/admin_api/add_steup" id="add" enctype="multipart/form-data">'+
			'<table class=table-form>'+
			'<input type="hidden" value="'+id+'" name="type">'+
			'<tr><td>轮播标题：<input type="text" placeholder="请输入课程标题" name="title">'+
			'<tr><td>课程难度：<select name="difficulty"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>'+
			'<tr><td>轮播描述：<textarea name="description" placeholder="请输入课程描述"></textarea>'+
			'<tr><td class=updata><font>点击更换图片</font><input type="file" name="userfile" id="add_updata"><img src="./static/image/slide4.jpg" width="100%" id=preview>'+
			'<tr><td><span style="color:#ccc">建议图片尺寸：1200 * 400</span ></table></form>',
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
					if($("#add_updata").val() == ""){
						showAlert("必须添加一张轮播图片才能保存！");
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
					$("#add").ajaxSubmit(option);
					return false;
				});
				$("#add").submit();
			}
		});

});

$("body").on("click" , ".edit-steup" , function(){
	$father = $(this).parents().find("tbody");
	$parents = $(this).parents().parents().eq(0);
	console.log();
		input({
			"title" : "编辑课程步骤",
			"icon" : "fa fa-edit",
			"content" :
			'<form method="post" action="api/admin_api/edit_steup" id="add" enctype="multipart/form-data">'+
			'<table class=table-form>'+
			'<input type="hidden" value="'+id+'" name="type">'+
			'<input type="hidden" value="'+$parents.data('id')+'" name="id">'+
			'<tr><td>课程标题：<input type="text" placeholder="请输入课程标题" name="title" value="' + $parents.find("td").eq(0).text() + '">'+
			'<tr><td>课程难度：<select name="difficulty"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>'+
			'<tr><td>课程描述：<textarea name="description" placeholder="请输入课程描述" >' + $parents.find("td").eq(1).text() + '</textarea>'+
			'<tr><td class=updata><font>点击更换图片</font><input type="file" name="userfile" id="add_updata"><img src="./static/uploads/' + $parents.data('img')+ '" width="100%" id=preview>'+
			'<tr><td><span style="color:#ccc">建议图片尺寸：1200 * 400</span ></table></form>',
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
					$("#add").ajaxSubmit(option);
					return false;
				});
				$("#add").submit();
			}
		});
	
});


$("body").on("click" , ".remove-steup" , function(){
	$parents = $(this).parents().parents().eq(0);
	confirms({
		"title" : "您确定要删除吗",
		"icon" : "icon-trash",
		"content" : "<p>您确定要删除掉这个课程吗？</p><p>删除后将无法复原，点击确定按钮确认删除该课程</p>",
		"success" : function(){
			$.ajax({
				"url" : "api/admin_api/delect_steup",
				type : "POST",
				data : {"id" : $parents.data("id"),"type":id},
				dataType : "JSON",
				success: function(data){
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
})


