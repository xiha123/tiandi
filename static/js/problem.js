 var ue = UE.getEditor('editor');
	SyntaxHighlighter.all();

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
		showAlert(true,"评论成功！银币 +20");
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
		"language" : $(".Language").val(),
	}).then(function(){
		showAlert(true,"回答成功！");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	},function(msg){
		showAlert(false,msg);
	})
});

$(".button_ok").click(function(){
	_td.api.chou({
		"problem_id" : problem_id
	}).then(function(){
		showAlert(true,"众筹成功！银币 -50");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	},function(msg){
		showAlert(false,msg);
		 setTimeout(function(){
	            close();
	        },700)
	})
})


$(".js_chou").click(function(event) {
	$(".windows").show();
	$(".confirm").show()
	setTimeout(function(){
		$(".confirm").css({"top" : "20%"});
	},100)
});
$(document).on("click" , "#close_window" ,function(event) {
	close();
});
function close(){
	$(".confirm").css({"top" : "0px"});
	setTimeout(function(){
		$(".windows").fadeOut(200);
		$(".confirm").fadeOut(200);
	},250)
}

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

if(problem_type == 1){
	timeOut_fun();
	var timeOut = setInterval(function(){
		timeOut_fun();
	},1000);
}
function timeOut_fun(){
	var time = new Date();
	time = Math.floor(time.getTime() / 1000 , 0) ;
	time = problem_lost_time - time;
	if(time <= 0){
		clearInterval(timeOut);
	}
	min = Math.floor(time / 60 , 0) % 60;
	s = time - (min * 60);
	if(s < 10){s = "0" + s}
	$(".doubt-time").text(min + ":" + s);
	if(min < 0){
		showAlert(false,"已过期，无法回答！");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	}
}