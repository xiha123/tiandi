// JavaScript Document

$siteBox = $(".site-box");
$siteBox.hide();
$siteBox.eq(0).show();
temp_index = 1;
$faterBox = $(".title");
$faterBox.on("click" , "a" , function(){
	var _this = $(this);
	var index = $faterBox.find("a").index(this);
	if(index == 0) return;
	
	_this.parent().addClass("active");
	$(".site-box").eq(index- 1).show();
	
	if(temp_index != index){
		$faterBox.find("li").eq(temp_index).removeClass("active");
		$(".site-box").eq(temp_index - 1).hide();
	}
	
	
	temp_index = index;
})

$("#save-link").click(function(){
	$.ajax({
		"url" : "admin_api/addClassListLink",
		type : "POST",
		data : {
			"id" : $(this).data("id"),
			"link" : $(".link").val(),
			"direction" : $(".direction").val(),
		},
		dataType : "JSON",
		success: function(data){
			  if(data.status == true) {
				showAlert("保存成功" , "success");
			} else {
				showAlert(data.error);
			}
		}
	});	
})


$(".edit-slider").click(function(){
	$parents = $(this).parents().parents().eq(0);
	input({
		"title" : "编辑特色课程",
		"content" : 
		'<table class=table-form>'+
		'<tr><td>课程名称：<input type="text" placeholder="请输入课程名称" value="' + $parents.find("td").eq(0).text() + '" class="className">'+
		'<tr><td>课程地址：<input type="text" placeholder="请输入视频地址" value="' + $parents.find("td").eq(1).find("a").attr("href") + '" class="classLink">'+
		'</table>',
		"success" : function(){
			if($("input[name='className']").val() == ""){
				showAlert("您必须写清课程的名称");
				return false
			}
			if($("input[name='classLink']").val() == ""){
				showAlert("您必须写清课程的连接");
				return false
			}
			$.ajax({
				"url" : "admin_api/editClassListTag",
				type : "POST",
				data : {
					"id" : $parents.data("id"),
					"className" : $(".className").val(),
					"classLink" : $(".classLink").val(),
				},
				dataType : "JSON",
				success: function(data){
					  if(data.status == true) {
						location.reload();
					} else {
						showAlert(data.error);
					}
				}
			});				
		}
	});
})

$("#add-classList").click(function(){
	input({
		"title" : "添加特色课程",
		"content" : 
		'<table class=table-form>'+
		'<tr><td>课程名称：<input type="text" placeholder="请输入课程名称" class="className">'+
		'<tr><td>课程地址：<input type="text" placeholder="请输入视频地址" class="classLink">'+
		'</table>',
		"success" : function(){
			if($("input[name='className']").val() == ""){
				showAlert("您必须写清课程的名称");
				return false
			}
			if($("input[name='classLink']").val() == ""){
				showAlert("您必须写清课程的连接");
				return false
			}
			$.ajax({
				"url" : "admin_api/addClassListTag",
				type : "POST",
				data : {
					"id" : id,
					"className" : $(".className").val(),
					"classLink" : $(".classLink").val(),
				},
				dataType : "JSON",
				success: function(data){
					  if(data.status == true) {
						location.reload();
					} else {
						showAlert(data.error);
					}
				}
			});				
		}
	});
})





$(".remove-tag").click(function(){
	$parents = $(this).parents().parents().eq(0);
	confirms({
		"title" : "您确定要删除吗",
		"icon" : "icon-trash",
		"content" : "<p>您确定要删除掉这个课程吗？</p><p>删除后将无法复原，点击确定按钮确认删除该课程</p>",
		"success" : function(){
			$.ajax({
				"url" : "admin_api/deleteClassListTag",
				type : "POST",
				data : {"id" : $parents.data("id")},
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
	});
})


$(".remove-classContent").click(function(){
	$parents = $(this).parents().parents().eq(0);
	confirms({
		"title" : "您确定要删除吗",
		"icon" : "icon-trash",
		"content" : "<p>您确定要删除掉这个课程吗？</p><p>删除后将无法复原，点击确定按钮确认删除该课程</p>",
		"success" : function(){
			$.ajax({
				"url" : "admin_api/deleteClassContent",
				type : "POST",
				data : {"id" : $parents.data("id")},
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
	});
});


$(".edit-classContent").click(function(){
	$parents = $(this).parents().parents().eq(0);
	input({
		"title" : "编辑课程",
		"content" : 
		'<table class=table-form>'+
		'<tr><td>课程名称：<input type="text" placeholder="请输入课程名称" value="' + $parents.find("td").eq(0).text() + '" class="edit-title">'+
		'<tr><td>详情介绍：<textarea class="edit-content" placeholder="请在此处填写课程详情描述">' + $parents.find("td").eq(1).text() + '</textarea>'+
		'</table>',
		"success" : function(){
			if($(".edit-title").val() == ""){
				showAlert("您必须写清课程的标题");
				return false
			}
			if($(".edit-content").val() == ""){
				showAlert("您必须写清课程的内容");
				return false
			}
			$.ajax({
				"url" : "admin_api/editClassContent",
				type : "POST",
				data : {
					"id" : $parents.data("id"),
					"title" : $(".edit-title").val(),
					"content" : $(".edit-content").val(),
				},
				dataType : "JSON",
				success: function(data){
					  if(data.status == true) {
						location.reload();
					} else {
						showAlert(data.error);
					}
				}
			});				
		}
	});
})

$("#add-classContent").click(function(){
	input({
		"title" : "添加课程详情",
		"content" : 
		'<table class=table-form>'+
		'<tr><td>详情标题：<input type="text" placeholder="请输入课程名称" class="Content-title">'+
		'<tr><td>详情介绍：<textarea class="Content-content" class="direction" placeholder="请在此处填写课程详情描述"></textarea>'+
		'</table>',
		"success" : function(){
			if($("input[name='className']").val() == ""){
				showAlert("您必须写清课程的名称");
				return false
			}
			if($("input[name='classLink']").val() == ""){
				showAlert("您必须写清课程的连接");
				return false
			}
			$.ajax({
				"url" : "admin_api/addClassContent",
				type : "POST",
				data : {
					"id" : id,
					"title" : $(".Content-title").val(),
					"content" : $(".Content-content").val(),
				},
				dataType : "JSON",
				success: function(data){
					  if(data.status == true) {
						location.reload();
					} else {
						showAlert(data.error);
					}
				}
			});				
		}
	});
	
});
