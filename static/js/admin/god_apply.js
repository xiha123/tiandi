$(".apply-ok").click(function(event) {
	/* Act on the event */
	var parent = $(this).parent().parent(),
	userId = parent.data('id');
	api.api.applyOk({
		"userid":userId,
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
	api.api.applyNo({
		"userid":userId,
	}).then(function(){
		showAlert("成功！","success");
		setTimeout(function(){
			location.reload();
		},1000)
	},function(msg){
		showAlert(msg);
	})
});