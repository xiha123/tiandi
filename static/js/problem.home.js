var ue = UE.getEditor('editor');

$("#ajax_problemSubmit").on("click",function(){
	var title = $("#problem-title").val(),
		content = ue.getContent();
		code = $("#problem-code").val(),
		coinType = document.getElementById("js_coinType").checked;
	if(title.length < 5 || title.length > 60){
		showAlert(false,"您输入的标题太长或者太短！");
		return false;
	}
	if(ue.getContentTxt().length < 10 ){
		showAlert(false,"再多打几个字吧，您的描述实在是太短了！");
		return false;
	}
	jsonArray = new Array();
	$.each($(".tag .tag-box"), function(index, val) {
		jsonArray.push($(val).find("font").text());
	});
	jsonText = JSON.stringify(jsonArray);
	_td.api.onlineSave({
		"type" : true,
		"title" : title,
		"content" : content,
		"tags" : jsonText,
		"code" : code,
		"language" : $(".Language").val(),
		"problem_id" : -1
	});
	_td.api.createProblem({
		"title" : title,
		"detail" : content,
		"code" : code,
		"tags" : jsonText,
		"coinType" : coinType,
		"language" : $(".Language").val(),
	}).then(function(res) {
		showAlert(true, "恭喜您，提问成功！ 银币 -100 个");
		$("#problem-title").val("");
		ue.setContent("");
		$("#problem-code").val("")
		setTimeout(function() {
			window.location.href="./problem/?p=" + res.data;
		}, 1000);
	}, function (res) {
		showAlert(false, res.error);
	});
});

setInterval(function(){
	console.log("sda");
	var title = $("#problem-title").val(),
		content = ue.getContent();
		code = $("#problem-code").val(),
		jsonArray = new Array();
	$.each($(".tag .tag-box"), function(index, val) {
		jsonArray.push($(val).find("font").text());
	});
	if(title!="" && content !="" && code!=""){
		_td.api.onlineSave({
			"type" : true,
			"title" : title,
			"content" : content,
			"tags" : JSON.stringify(jsonArray),
			"code" : code,
			"language" : $(".Language").val(),
			"problem_id" : -1
		});
	}
},12000)
