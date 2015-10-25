var removeVideoFunction = function(){
	$.ajax({
		url : "api/video_api/remove_video",
		type : "POST",
		data : {"videoName" : this.name},
		dataType : "JSON",
		success: function(data){
			if(data.status == true) {
				$parents.hide();
				close();
			} else {
				showAlert(data.error);
			}
		}
	});
}
$("#removeVideo").click(function(){
	$parents = $(this).parents().parents().eq(0);
	confirms({
		name : $parents.data("name"),
		title : "您确定要删除吗",
		icon : "icon-trash",
		content : "<p>您确定要删除掉吗？</p><p>删除后将无法复原，点击确定按钮确认删除该条记录</p>",
		success : removeVideoFunction
	});
});

$(".uploadFile").change(function(data){

	// 检测上传文件的合法性
	var fileName = $(this).val().split("\\").slice(-1)[0],
	fileType = "." + fileName.split(".").slice(-1)[0],
	uploadLimit = ['.flv' , '.wmv' , '.rmvb' , '.avi' , '.mp4'].join(",");
	if(uploadLimit.indexOf(fileType) <= 0){
		showAlert("上传的文件不合法，仅允许：" +uploadLimit+" 格式上传");
		return false;
	}
	var option = {
		type : "post",
		success:function (data) {
			try{
				data = JSON.parse(data);
			}catch(e){
				showAlert("意外的错误，接口通讯出现异常，请稍候再试！");
				$(".window,.load").hide();
			}
			if(data.status) {
				showAlert("视频上传成功","success");
			$(".window,.load").hide();
				setTimeout(function(){
					location.reload();
				},1400);
			} else {
				showAlert(data.error);
			}
		},
		error:function(){
			showAlert("意外的错误，接口通讯出现异常，请稍候再试！");
			$(".window,.load").hide();
		}
	};
	$(".window,.load").show();
	$("#uploadVideo").ajaxSubmit(option);
	return false;
})
