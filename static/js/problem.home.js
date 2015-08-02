 var ue = UE.getEditor('editor');

$("#ajax_problemSubmit").on("click",function(){
	var title = $("#problem-title").val(),
		content = ue.getContent();
		code = $("#problem-code").val();
	if(title.length < 10 || title.length > 60){
		showAlert(false,"您输入的标题太长或者太短！");
		return false;
	}	
	if(ue.getContentTxt().length < 14 ){
		showAlert(false,"再多打几个字吧，您的描述实在是太短了！");
		return false;
	}

	jsonText = '{"list":[';
	$.each($(".tag .tag-box"), function(index, val) {
		 jsonText = jsonText + '{"value":"' +$(val).find("font").text()+ '"},';
		 //{"s":1},{"s":1}]}
	});
	jsonText = jsonText + "]}";

	_td.api.createProblem({
		"title" : title,
		"detail" : content,
		"code" : code,
		"tags" : jsonText,
	}).then(function(){
		showAlert(true,"恭喜您，提问成功！");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	},function(msg){
		showAlert(false,msg);
	})
})