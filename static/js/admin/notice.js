$("#checkAll").click(function () {  
	$("td input:checkbox").each(function () {  
		this.checked = true;  
	})  	
});  
$("#notAll").click(function () {  
	$("td input:checkbox").each(function () {  
		this.checked = !this.checked;  
	})  
}); 
$("#delete").click(function() {
	var deleteArray = new Array();
	$("td input:checkbox").each(function () {  
		if(this.checked){
			deleteArray.push({"id" : $(this).data("id")});
		}
	});
	$.ajax({
		url : "api/news_api/remove",
		data : {"removeData" : JSON.stringify(deleteArray)},
		type : "post",
		success:function(data){
			json = JSON.parse(data);
			if(json.status == true){
				showAlert(true,"删除成功！");
				setTimeout(function(){
					location.reload();
				},700)
			}else{
				showAlert(false,json.error);
			}
		},
		error:function(){
			showAlert(false,"无法请求!");
		}
	})
});