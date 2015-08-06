 var ue = UE.getEditor('editor');

$("#answer").on('click' , function(event) {
	_td.api.requestProblem({
		"problem_id" : problem_id
	}).then(function(){
		showAlert(true,"认领成功！请您尽快为他解决问题哟！");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	},function(msg){
		showAlert(false,msg);
	})
});