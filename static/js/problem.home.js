$(function () {
	var ue = UM.getEditor('editor');

	$('.Language').bind('change', function () {
		var tag = $('.Language').children('option[value="' + this.value + '"]').text();
        if (tag === '请选择问题方向') return;
		$('.js-tag-box').trigger('add', tag);
	});

	$("#ajax_problemSubmit").on("click", function() {
		var title = $("#problem-title").val(),
			content = ue.getContent(),
			code = $("#problem-code").val(),
			coinType = document.getElementById("js_coinType").checked,
			jsonArr = [];

		if(title.length < 5 || title.length > 60){
			showAlert(false, "您输入的标题太长或者太短！");
			return false;
		}
		if(ue.getContentTxt().length < 10 ){
			showAlert(false, "再多打几个字吧，您的描述实在是太短了！");
			return false;
		}
		if ($('.Language').val() === '-1') {
			showAlert(false, "请选择问题方向");
			return false;
		}

		$.each($(".tag .tag-box"), function(index, val) {
			jsonArr.push($(val).find("font").text());
		});
		jsonText = JSON.stringify(jsonArr);

		_td.api.createProblem({
			"title" : title,
			"content" : content,
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
			jsonArr = new Array();
		$.each($(".tag .tag-box"), function(index, val) {
			jsonArr.push($(val).find("font").text());
		});
		if(title !== "" && content != "") {
			_td.api.onlineSave({
				"type" : true,
				"title" : title,
				"content" : content,
				"tags" : JSON.stringify(jsonArr),
				"code" : code,
				"language" : $(".Language").val(),
				"problem_id" : -1
			});
		}
	}, 10000);

	var is_one = true , is_ok = false , is = false;
	ue.ready(function() {
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

});
