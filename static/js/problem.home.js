$(function () {
	var ue = UM.getEditor('editor'),
		$lang = $('.Language');

	$lang.change(function () {
		var type = $lang.children('[value=' + $lang.val() + ']').text();

		if (type === '请选择问题方向') {
			$('.js-lang-tag').addClass('hidden');
		} else {
			$('.js-lang-tag').text(type).removeClass('hidden');
		}
	});

	$("#ajax_problemSubmit").on("click", function() {
		var title = $("#problem-title").val(),
			content = ue.getContent(),
			code = $("#problem-code").val(),
			coinType = document.getElementById("js_coinType").checked,
			jsonArr = [];

		if(title.length < 6 || title.length > 64){
			showAlert(false, "标题填写请大于6字符、小于64字符");
			return false;
		}
		if(ue.getContentTxt().length < 12 ){
			showAlert(false, "请详细描述你的问题，大于12字符");
			return false;
		}
		if ($lang.val() === '-1') {
			showAlert(false, "请选择问题方向");
			return false;
		}

		$.each($(".tag .tag-box font"), function(index, val) {
			jsonArr.push($(val).text());
		});
		jsonArr.push($('.js-lang-tag').text());
		jsonText = JSON.stringify(jsonArr);

		_td.api.createProblem({
			"title" : title,
			"content" : content,
			"code" : code,
			"tags" : jsonText,
			"coinType" : coinType,
			"language" : $lang.val(),
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
			jsonArr = [];

		$.each($(".tag .tag-box font"), function(index, val) {
			jsonArr.push($(val).text());
		});

		if(title !== "" && content != "") {
			_td.api.onlineSave({
				"type" : 'ask',
				"title" : title,
				"content" : content,
				"tags" : JSON.stringify(jsonArr),
				"code" : code,
				"language" : $lang.val(),
				"problem_id" : -1
			});
		}
	}, 10000);

	ue.ready(function() {
		ue.addListener('focus', function(editor) {
			if (ue.getContentTxt() === '请详细描述你的问题') {
				ue.setContent('');
				$('#editor').css('color', '#333');
			}
		});
		ue.addListener('blur', function(editor) {
			if (ue.getContentTxt() === '') {
				ue.setContent("请详细描述你的问题");
				$('#editor').css('color', '#aaa');
			}
		});
		ue.blur();
	});

});
