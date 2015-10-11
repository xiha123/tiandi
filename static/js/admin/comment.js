$(".remove-comment").click(function(){
	$parents = $(this).parents().parents().eq(0);
	confirms({
		"title" : "您确定要删除吗",
		"icon" : "icon-trash",
		"content" : "<p>您确定要删除掉吗？</p><p>删除后将无法复原，点击确定按钮确认删除该条记录</p>",
		"success" : function() {
            _td.api.removeComment({
                comment_id: $parents.data("id")
            }).then(function () {
				$parents.hide();
				close();
            }, function (res) {
                showAlert(res.error);
            });
		}
	});
});
