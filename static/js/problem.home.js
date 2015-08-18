 var ue = UE.getEditor('editor');

$("#ajax_problemSubmit").on("click",function(){
	var title = $("#problem-title").val(),
		content = ue.getContent();
		code = $("#problem-code").val(),
		coinType = document.getElementById("js_coinType").checked;
		console.log(coinType);
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
	_td.api.createProblem({
		"title" : title,
		"detail" : content,
		"code" : code,
		"tags" : jsonText,
		"coinType" : coinType,
	}).then(function(msg){
		showAlert(true,"恭喜您，提问成功！ 银币 -100个");
		 setTimeout(function(){
		 	window.location.href="./problem/?p=" + msg;
	        },1000)
	},function(msg){
		showAlert(false,msg);
	})
})