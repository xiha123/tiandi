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
	
	

	
			


})