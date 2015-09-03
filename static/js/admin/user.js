$(".edit-user").click(function(event) {
	$parents = $(this).parents().parents().eq(0);
	$parents_baby = $parents.find("td");


	input({
		"title" : "编辑用户资料信息",
		"icon" : "icon-trash",
		"content" :
		'<form method="post" action="api/admin_api/editData" id="edit-user">'+
		'<table class=table-form>'+
		'<input type="hidden" value="0" name="type">'+
		'<input type="hidden" value="' + $parents.data("id")+ '" name="id">'+
		'<tr><td>用户昵称：<input type="text" value="' + $parents_baby.eq(0).text()+ '" name="nickname">'+
		'<tr><td>用户密码：<input type="text" value="" placeholder="如若为空则不修改用户密码" name="password">'+
		'<tr><td>真实姓名：<input type="text" value="' + $parents_baby.eq(1).text()+ '" name="name">'+
		'<tr><td>用户邮箱：<input type="text" value="' + $parents_baby.eq(2).text()+ '" name="email">'+
		'<tr><td>手 机 号&nbsp;：<input type="text" value="' + $parents_baby.eq(3).text()+ '" name="cellphone">'+
		'<tr><td>支 付 宝&nbsp;：<input type="text" value="' + $parents_baby.eq(4).text()+ '" name="alipay">'+
		'<tr><td>银币数量：<input type="text" value="' + $parents_baby.eq(5).text()+ '" name="gold_coin">'+
		'<tr><td>金币数量：<input type="text" value="' + $parents_baby.eq(6).text()+ '" name="silver_coin">'+
		'<tr><td>用户积分：<input type="text" value="' + $parents_baby.eq(7).text()+ '" name="Integral">'+
		'<tr><td>身份证号：<input type="text" value="' + $parents_baby.eq(8).text()+ '" name="idcar">'+
		'<tr><td>用户类型：<select name="type"><option value="0">学员</option><option value="1">大神</option></select>'+
		'<tr><td>置顶讲师：<input type="checkbox" style="position:relative;top:2px;" name="teacher">'+
		'</table></form>',
		"success" : function(){
			$("#edit-user").unbind("submit");
			$("#edit-user").on("submit",function(){
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
				$("#edit-user").ajaxSubmit(option);
				return false;
			});
			$("#edit-user").submit();
		}
		});

});


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