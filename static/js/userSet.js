$("#ajax_userSet").click(function(){
	var namenick = $("#ajax_nickname").val(),
		signature = $("#signature").val(),
		email = $("#ajax_email").val(),
		phone = $("#ajax_phone").val(),
		pwd_lost = $("#ajax_lost").val(),
		pwd_new = $("#ajax_new").val(),
		pwd_re = $("#ajax_re").val();
	if(pwd_lost != ""){
		if(pwd_new != pwd_re || pwd_new == "" || pwd_re == ""){
			showAlert(false , "两次输入的密码不一致，请更改后再次提交");return false;
		}
	}
	if(email.length<6){
		showAlert(false , "邮箱好像不正确哟");return false;
	}
	if(phone.length!=11){
		showAlert(false , "电话号码好像不正确哟");return false;
	}
	if(signature.length< 15 || signature.length>200){
		showAlert(false , "您输入的描述不太正确哟！");return false;
	}
	if(namenick.length<4 || namenick.length>16){
		showAlert(false , "您的昵称太长或者太短了！");return false;
	}
	_td.api.editUser({
		"nickname" : namenick,
		"desk" : signature,
		"email" : email,
		"phone" : phone,
		"pwd_lost" : pwd_lost,
		"pwd_new" : pwd_new,
	}).then(function(){
		showAlert(true,"编辑个人资料成功！")
		 setTimeout(function(){
	            location.reload();
	        },1000)
	}, function(msg){
		showAlert(false,msg)
	})

})