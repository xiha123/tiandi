

var addClass = function(){
	var ajaxClassName = $("#ajaxClassName").val(),
		ajxaFather = $("#ajxaFather").val();
	if(ajaxClassName.length > 20){showAlert("您输入的课程名字太长了");return;}
	if(ajaxClassName.length < 4){showAlert("您输入的课程名字太短了");return;}
	$.ajax({
		url : "api/Course_api/add_class",
		data : {title : ajaxClassName , type : ajxaFather },
		type : "POST"
	}).then(function(msg){
		try{data = JSON.parse(msg);}catch(e){showAlert("请求失败，请稍候重试重新提交");return;}
		if(data.status){
			showAlert("新的课程添加成功！" , "success");
			setTimeout(function(){
				location.reload();
			},700);
		}else{
			showAlert(data.error);
		}
	});
}

// 添加新的课程
$("#addClass").click(function(){
	var formData = new Array();
	formData.push({
		"chinaName" : "课程名称" , 
		"name" : "className" ,
		"id" : "ajaxClassName"  , 
	})
	formData.push({
		"chinaName" : "所属父类" , 
		"name" : "class" , 
		"id" : "ajxaFather" , 
		"type" : "select", 
		"data" :  [
			{"value":"0" , "name" : "3d"} , 
			{"value":"1" , "name" : "swift"},
			{"value":"2" , "name" : "web"},
			{"value":"3" , "name" : "coco"},
			{"value":"4" , "name" : "android"}
		]
	})
	confirms({
		"title" : "添加一个新的课程",
		"content" : commit(formData , {"submitFunctionName" : "addClass()" , "header" : "<tr><td>" , "footer" : "</tr></td>"}),
		"success" : addClass
	});
});





$(".remove-course").click(function(){
	$parents = $(this).parents().parents().eq(0);
	confirms({
		"title" : "您确定要删除吗",
		"icon" : "icon-trash",
		"content" : "<p>您确定要删除掉这个课程吗？</p><p>点击确认后系统会删除课程下的所有的内容</p><p>例如，标签、课程、章节、步骤、图片将会全部删除</p>",
		"success" : function(){
			$.ajax({
				"url" : "api/admin_api/remove_course",
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
	return false;
})




var editCourse = function(){
	var _this = this;
	if($("input[name='className']").val() == ""){
		showAlert("您必须写清课程的名称");
		return false
	}
	$.ajax({
		url: 'api/admin_api/editClassList',
		method: 'POST',
		dataType: 'JSON',
		data: {
			id: _this.id,
			name : $("#ajaxClassName").val(),
			link : $("#ajaxViodeLink").val(),
			type : $("#ajxaFather").val(),
		},
	}).then(function (res) {
		if (res.status) {
			location.reload();
		} else {
			showAlert(res.error, 'danger');
		}
	});
}
$(".edit-slider").click(function(){
	$parents = $(this).parents().parents().eq(0);
	var formData = new Array();
	formData.push({
		"chinaName" : "课程名称" , 
		"name" : "className" ,
		"id" : "ajaxClassName"  , 
		"value" : $parents.find("td").eq(0).text(),
		"placeholder" : "请在此输入课程的名称"
	});
	formData.push({
		"chinaName" : "视频地址" , 
		"name" : "viodeLink" ,
		"id" : "ajaxViodeLink"  , 
		"value" : $parents.find("td").eq(1).text(),
		"placeholder" : "请在此输入课程的视频地址"
	});
	formData.push({
		"chinaName" : "所属父类" , 
		"name" : "class" , 
		"id" : "ajxaFather" , 
		"type" : "select", 
		"data" :  [
			{"value":"0" , "name" : "3d"} , 
			{"value":"1" , "name" : "swift"},
			{"value":"2" , "name" : "web"},
			{"value":"3" , "name" : "coco"},
			{"value":"4" , "name" : "android"}
		]
	});
	formData[2].data[$parents.data('listtype')].selected = "selected";
	input({
		"title" : "编辑该课程",
		"id" : $parents.data('id'),
		"content" : commit(formData , {"submitFunctionName" : "addClass()" , "header" : "<tr><td>" , "footer" : "</tr></td>"}),
		"success" : editCourse
	});
	return false;
});





$("tr").click(function(){
	var id = $(this).data("type");
	location.href = "admin/classListSite/" + id;
})