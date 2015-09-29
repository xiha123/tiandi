$(".apply-ok").click(function(event) {
	var parent = $(this).parent().parent(),
		userId = parent.data('id');

	$.ajax({
		"url":"api/admin_api/apply_ok",
		"type":"post",
		"data": {"userid" : userId},
	}).then(function(){
		showAlert("审核通过！","success");
		setTimeout(function(){
			location.reload();
		},1000)
	},function(msg){
		showAlert(msg);
	})
});

$(".apply-no").click(function(event) {
	var parent = $(this).parent().parent(),
		userId = parent.data('id');
		
	$.ajax({
		"url":"api/admin_api/apply_no",
		"type":"post",
		"data": {"userid" : userId},
	}).then(function(){
		showAlert("成功！","success");
		setTimeout(function(){
			location.reload();
		},1000)
	},function(msg){
		showAlert(msg);
	})
});
