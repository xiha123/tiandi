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

$("#ajax_comment").click(function(){
	var content = ue.getContent();
	if(content.length<15){
		showAlert(false,"再多写几个字吧，这样才能帮助他解决问题哟！（不能少于15个字）");
		return false;
	}
	_td.api.createComment({
		"problem_id" : problem_id,
		"content" : content	
	}).then(function(){
		showAlert(true,"吐槽成功！");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	}, function(msg){
		showAlert(false,msg);
	})

});

$("#reply").click(function(){
	content = ue.getContent();
	if(content.length<15){
		showAlert(false,"再多写几个字吧，这样才能帮助他解决问题哟！（不能少于15个字）");
		return false;
	}
	_td.api.createDetail({
		"problem_id" : problem_id,
		"content" :content ,
		"code" : $("#problem-code").val(),
		"type" : "1",
	}).then(function(){
		showAlert(true,"回答成功！");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	},function(msg){
		showAlert(false,msg);
	})
});

$(".ajax_close_not").click(function(event) {
	_td.api.closeProblem({
		"problem_id" : problem_id,
		"type" : "false"
	}).then(function(){
		showAlert(true,"操作成功，请继续等待大神来认领问题");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	},function(msg){
		showAlert(false,msg);
	});
});
$(".ajax_close").click(function(event) {
	_td.api.closeProblem({
		"problem_id" : problem_id,
		"type" : "true"
	}).then(function(){
		showAlert(true,"操作成功，该问题已关闭！");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	},function(msg){
		showAlert(false,msg);
	});
});

timeOut_fun();

var timeOut = setInterval(function(){
	timeOut_fun();
},1000);

function timeOut_fun(){
	var time = new Date();
	time = Math.floor(time.getTime() / 1000 , 0) ;
	time = problem_lost_time - time;
	if(time <= 0){
		clearInterval(timeOut);
	}
	min = Math.floor(time / 60 , 0) % 60;
	s = time - (min * 60);
	$(".doubt-time").text(min + ":" + s);
}