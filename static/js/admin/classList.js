// JavaScript Document



$(".remove-slider").click(function(){
	$parents = $(this).parents().parents().eq(0);
	confirms({
		"title" : "您确定要删除吗",
		"icon" : "icon-trash",
		"content" : "<p>您确定要删除掉这个课程吗？</p><p>删除后将无法复原，点击确定按钮确认删除该课程</p>",
		"success" : function(){
			$.ajax({
				"url" : "api/admin_api/deleteClassList",
				type : "POST",
				data : {"id" : $parents.data("id")},
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
	return false;
})





$(".edit-slider").click(function(){
	
	$parents = $(this).parents().parents().eq(0);
	input({
		"title" : "编辑该课程",
		"content" : 
		'<form method="post" action="api/admin_api/editClassList" id="editClassList" enctype="multipart/form-data">'+
		'<table class=table-form>'+
		'<input type="hidden" name="id" value="'+$parents.data("id")+'" >'+
		'<tr><td>课程名称：<input type="text" placeholder="请输入课程名称" value="' + $parents.find("td").eq(0).text()+ '" name="className">'+
		'<tr><td>视频地址：<input type="text" placeholder="请输入视频地址" value="' + $parents.find("td").eq(1).text()+ '" name="classVideo">'+
		'<tr><td>课程描述：<input type="text" placeholder="请输入课程描述" value="' + $parents.find("td").eq(2).text()+ '" name="text">'+
		'</table></form>',
		"success" : function(){
			if($("input[name='className']").val() == ""){
				showAlert("您必须写清课程的名称");
				return false
			}
			$.ajax({
				url: 'api/admin_api/editClassList',
				method: 'post',
				data: {
					id: $("input[name='id']").val(),
					className: $("input[name='className']").val(),
					text: $("input[name='text']").val(),
					classVideo: $("input[name='classVideo']").val()
				},
				dataType: 'json',
				success: function (res) {
					if (res.status) {
						location.reload();
					} else {
						showAlert(res.error, 'danger');
					}
				}
			});
		}	
	});
	return false;
});


$("tr").click(function(){
	var id = $(this).data("type");
	location.href = "admin/classListSite/" + id;
})