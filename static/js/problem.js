if(window.problem_type == 1){
	/*
	UM.registerUI('引用提问者问题', function(editor, uiName) {
	    editor.registerCommand(uiName, {
	        execCommand: function() {
	            alert('execCommand:' + uiName)
	        }
	    });
	    var btn = new UM.ui.Button({
	        name: uiName,
	        title: uiName,
	        cssRules: 'background-position: -220px 0;',
	        onclick: function() {
	            //这里可以不用执行命令,做你自己的操作也可
	            ue.setContent(problem_content);
	            $("#problem-code").val(problem_code);
	            showAlert(true , "引用成功，提问者的问题已被引入到编辑框中！");
	        }
	    });
	    editor.addListener('selectionchange', function() {
	        var state = editor.queryCommandState(uiName);
	        if (state == -1) {
	            btn.setDisabled(true);
	            btn.setChecked(false);
	        } else {
	            btn.setDisabled(false);
	            btn.setChecked(state);
	        }
	    });
	    return btn;
	});
	*/
}



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
		showAlert(false,msg.error);
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
		showAlert(false,msg.error);
	})
});


$(".ajax_close").click(function(event) {
	_td.api.closeProblem({
		"problem_id" : problem_id,
		"type" : "true"
	}).then(function(){
		showAlert(true,"感谢您的支持，您已经满意了这个问题！");
		 setTimeout(function(){
	            location.reload();
	        },1000)
	},function(msg){
		showAlert(false,msg.error);
	});
});

if(window.first){
	var max = 1;
	var god = setInterval(function(){
		 rand = Math.ceil(Math.random() * 2);
		 max += rand;
		 if(max >= max_god){
		 	max = max_god;
		 	clearInterval(god);
		 	$(".user_list_data h3 span").text(max);
		 }else{
		 	$(".user_list_data h3 span").text(max + "位");
		 }
	},800);
}

if(window.problem_type == 1){
	timeOut_fun();
	var timeOut = setInterval(function(){
		timeOut_fun();
	},1000);
	if(online_save_type){
		setInterval(function(){
			var content = ue.getContent();
				code = $("#problem-code").val(),
				jsonArray = new Array();
			$.each($(".tag .tag-box"), function(index, val) {
				jsonArray.push($(val).find("font").text());
			});
			if(content !="" && code!=""){
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
		},11000);
	}else{

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
 var ue = UM.getEditor('editor');


 SyntaxHighlighter.all();
if(window.problem_type == 3){
	value = '在此处输入评论';
}else{
	value = '详细描述你的解答';
}
var is_one = true , is_ok = false , is = false;
ue.ready(function(){
	ue.execCommand('inserthtml', '<span></span>');
	if(ue.getContentTxt() == "" && is == false){
		ueSetColor("#aaa",value);
		is = true;
	}
	ue.blur();
	setTimeout(function(){
		ue.addListener('selectionchange', function( editor ) {
			if(is_one == false){
				is_one = true;
				if(ue.getContentTxt() == value && is == true){
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
