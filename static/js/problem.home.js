var ue = UE.getEditor('editor');
	UE.getEditor('editor').setDisabled('fullscreen');

$("#ajax_problemSubmit").on("click",function() {
	var title = $("#problem-title").val(),
		content = ue.getContent(),
		code = $("#problem-code").val(),
		coinType = document.getElementById("js_coinType").checked;

	if(title.length < 5 || title.length > 60){
		showAlert(false, "您输入的标题太长或者太短！");
		return false;
	}
	if(ue.getContentTxt().length < 10 ){
		showAlert(false, "再多打几个字吧，您的描述实在是太短了！");
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


var is_one = true , is_ok = false , is = false;
ue.ready(function(){
	ue.execCommand('inserthtml', '<span></span>');
	if(ue.getContentTxt() == "" && is == false){
		ueSetColor("#aaa","在此处输入您对问题的描述");
		is = true;
	}
	ue.blur();
	setTimeout(function(){
		ue.addListener('selectionchange', function( editor ) {
			if(is_one == false){
				is_one = true;
				if(ue.getContentTxt() == "在此处输入您对问题的描述" && is == true){
					ueSetColor("#333" , "");
					setTimeout(function(){
						ue.focus();
					},100)
				}
			}
			if(!is_ok){
				is_one = false;
			}
			is_ok = true;
		});
	},500)
});

