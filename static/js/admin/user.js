$(".remove-user").click(function(){
	$parents = $(this).parents().parents().eq(0);
	confirms({
		"title" : "您确定要删除吗",
		"icon" : "icon-trash",
		"content" : "<p>您确定要删除掉吗？</p><p>删除后将无法复原，点击确定按钮确认删除该条记录</p>",
		"success" : function(){
			$.ajax({
				url : "api/user_api/remove_user",
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
});