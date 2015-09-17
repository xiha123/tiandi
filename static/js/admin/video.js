$(".uploadFile").change(function(data){

	// 检测上传文件的合法性
	var fileName = $(this).val().split("\\").slice(-1)[0];
	fileType = "." + fileName.split(".").slice(-1)[0];
	uploadLimit = ['.flv' , '.wmv' , '.rmvb' , '.avi' , '.mp4'].join(",");
	if(uploadLimit.indexOf(fileType) <= 0){
		showAlert("上传的文件不合法，仅允许：" +uploadLimit+" 格式上传");
		return false;
	}
	
	
	var option = {
		type : "post",
		success:function (data) {
			data = JSON.parse(data);
			  if(data.status == "true") {
				location.reload();
			} else {
				showAlert(data.error);
			}
		}
	};
	$("#uploadVideo").ajaxSubmit(option);
	return false;


})