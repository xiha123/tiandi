$("#ajax_apply").click(function(event) {
	var name = $("#name").val();
	var alipay = $("#alipay").val();
	var phone = $("#phone").val();
	var tag = $("#tag").val();
	var desk = $("#desk").val();
	var agree = $('.agree').prop('checked');

	if(name.length > 4 || name.length < 2){showAlert(false,"姓名格式输入错误！");return;}
	if(alipay.length < 5){showAlert(false,"请输入正确的支付宝账号");return;}
	if(!isphone(phone)){showAlert(false,"请输入正确的手机号");return;}
	if(desk < 5){showAlert(false,"请输入正确的描述");return;}
	if (agree === false) {
		showAlert(false, '请同意并接受服务条款');
		return;
	}

	$.ajax({
		url : "api/god_api/addGodApply",
		type : "post",
		data : {
			"name" : name,
			"cellphone" : phone,
			"description" : desk,
			"alipay" : alipay,
			"tag" : tag
		},
		success : function(data){
			json = JSON.parse(data);
			if(json.status == true){
				showAlert(true,"恭喜您，添加成功！请等待审核通过！");
				setTimeout(function () {
					location.href = 'home?uid=' + uid;
				}, 1000);
			}else{
				showAlert(false,json.error);
			}

		},
		error : function(msg){
			showAlert(false,msg);
		}
	});

});


function isphone(inputString) {
	var partten = /^1[3,5,7,8]\d{9}$/;
	var fl=false;
	if(partten.test(inputString))
	{
		return true;
	}
	else
	{
		return false;
	}
}
