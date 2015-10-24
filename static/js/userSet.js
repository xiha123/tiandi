$("#active-email").click(function(event) {
	_td.api.activeEmail().then(function () {
		showAlert(true, "激活邮件已经发送到了您的邮箱中了，请注意查收！");
	}, function (res) {
		showAlert(false, res.error);
	});
});
$("#ajax_userSet").click(function(){
	var namenick = $("#ajax_nickname").val(),
		signature = $("#signature").val(),
		phone = $("#ajax_phone").val(),
		pwd_lost = $("#ajax_lost").val(),
		pwd_new = $("#ajax_new").val(),
		pwd_re = $("#ajax_re").val();
	if(pwd_lost != ""){
		if(pwd_new != pwd_re || pwd_new == "" || pwd_re == ""){
			showAlert(false , "两次输入的密码不一致，请更改后再次提交");return false;
		}
	}

	if(phone.length !== 11){
		showAlert(false , "电话号码好像不正确哟");return false;
	}
	if(signature.length > 100){
		showAlert(false , "您的签名档请小于100字符");return false;
	}
	if(namenick.length< 2 || namenick.length > 14){
		showAlert(false , "您的昵称请大于2字符，小于14字符");return false;
	}
	_td.api.editUser({
		"nickname" : namenick,
		"desk" : signature,
		"email" : "",
		"phone" : phone,
		"id" : uid,
		"pwd_lost" : pwd_lost,
		"pwd_new" : pwd_new,
	}).then(function(){
		showAlert(true,"编辑个人资料成功！")
		setTimeout(function() {
			location.reload();
		}, 1000);
	}, function(msg){
		showAlert(false, msg.error)
	})
})

$("#ajax_userPic").change(function(e){
	var reader = new FileReader();
	reader.onload = function (e) {
		$('.Photo img').attr('src', e.target.result);
	}
	var file = e.target.files[0];
	reader.readAsDataURL(file);
	var option = {
		type : "post",
		url: "api/user_api/upload_pic",
		success:function (data) {
			data = JSON.parse(data);
			  if(data.status ==true) {
				showAlert(true,"上传成功！");
				setTimeout(function(){
					location.reload();
				},1000);
			} else {
				showAlert(false,data.error);
			}
		},
		error: function() {
			showAlert(false,"网络异常，无法上传照片！");
		}
	};
	$("#ajax_upload").ajaxSubmit(option);
})


$("#ajax_godset").click(function(){
	var alipay = $("#alipay").val(),
		goddesc = $("#experience").val();

	if(goddesc.length < 20 || goddesc.length > 300){
		showAlert(false , "您的项目经历请大于20字符，小于300字符");
		return false;
	}
	if(alipay.length < 4){
		showAlert(false , "您的支付宝输入的不太正常");
		return false;
	}
	jsonArray = new Array();
	$.each($(".tag .tag-box"), function(index, val) {
		jsonArray.push($(val).find("font").text());
	});



	$.ajax({
		url : "api/user_api/edit_god",
		type:"post",
		data:{
			"alipay" : alipay,
			"goddesc" : goddesc,
			"tags" : JSON.stringify(jsonArray),
			"id" : uid,
		},
		success:function(data){
			console.log(data);
			data = JSON.parse(data);
			  if(data.status ==true) {
				showAlert(true,"保存成功！");
				setTimeout(function(){
					location.reload();
				},1000);
			}else{
				showAlert(false,data.error);
			}
		},
		error : function() {
			showAlert(false,"请求失败！");
		}
	})
})
