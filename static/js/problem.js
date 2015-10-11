var ue = UM.getEditor('editor');

$(function () {
	if (problem_type === 0 && problem_owner === _td.info.id) {
		setInterval(function () {
			_td.api.getProblemInfo({
				problem_id: problem_id
			}).then(function (res) {
				if (res.data.type === '1') {
					location.reload();
				}
			});
		}, 3000);
	}
	if (problem_type === 1 && problem_owner === _td.info.id) {
		setInterval(function () {
			_td.api.getProblemInfo({
				problem_id: problem_id
			}).then(function (res) {
				if (res.data.type === '3' || res.data.type === '2') {
					location.reload();
				}
			});
		}, 3000);
	}
});

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
		showAlert(false,msg.error);
	})
});

$("#ajax_comment").click(function(){
	var content = ue.getContent();
	if(content.length < 12) {
		showAlert(false,"您的评论太短啦，请大于12字符");
		return false;
	}
	_td.api.createComment({
		"problem_id" : problem_id,
		"content" : content
	}).then(function(){
		showAlert(true,"评论成功！银币 +20");
		setTimeout(function() {
			location.reload();
		}, 1000);
	}, function(msg) {
		showAlert(false, msg.error);
	})

});

$("#reply").click(function(){
	var content = ue.getContent();
	if(content.length < 12){
		showAlert(false,"请详细描述你的解答，大于12字符");
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
		setTimeout(function() {
			location.reload();
		}, 1000)
	},function(msg){
		showAlert(false,msg.error);
	})
});


$(".ajax_close").click(function(event) {
	_td.api.closeProblem({
		"problem_id" : problem_id,
		"type" : "true"
	}).then(function(){
		showAlert(true,"感谢您的支持，您已经满意了这个问题！");
		setTimeout(function() {
			location.reload();
		}, 1000)
	},function(msg){
		showAlert(false,msg.error);
	});
});

if(window.first) {
	var max = 1;
	var god = setInterval(function() {
		rand = Math.ceil(Math.random() * 2);
		max += rand;
		if(max >= max_god) {
			max = max_god;
			clearInterval(god);
		}
		$(".user_list_data h3 span").text(max);
	}, 800);
}

if(window.problem_type == 1){
	timeOut_fun();
	var timeOut = setInterval(function(){
		timeOut_fun();
	}, 1000);
	if(online_save_type) {
		setInterval(function() {
			var content = ue.getContent();
				code = $("#problem-code").val(),
				jsonArray = new Array();
			$.each($(".tag .tag-box"), function(index, val) {
				jsonArray.push($(val).find("font").text());
			});
			if(content != ""){
				_td.api.onlineSave({
					"type" : false,
					"title" : "none",
					"content" : content,
					"tags" : "[]",
					"code" : code,
					"language" : $(".Language").val(),
					"problem_id" : problem_id
				});
			}
		}, 10000);
	} else if (problem_owner === _td.info.id || problem_collect) {
		setInterval(function () {
			_td.api.syncGodAnswer({
				problem_id: problem_id
			}).then(function (res) {
				res.data && ue.setContent(res.data.content);
				res.data && $('#problem-code').text(res.data.code);
			});
		}, 10000);
	}
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
	if(min == 20 && s > 0){
		s = "00";
	}
	if(min < 0 && s <= 0){
		showAlert(false,"已过期，无法回答！");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	}
}
