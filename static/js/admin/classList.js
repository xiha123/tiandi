

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
} , addCourseGod = function(){
	var _this = this;
	$.ajax({
		url : "api/admin_api/add_god_from_course",
		data : {"id":_this.id, "godName" : $("#js-godName").val()},
		method: 'POST',
		dataType : "JSON",
	}).then(function(msg){
		console.log(msg);
		if (msg.status) {
			showAlert("添加上课大神成功！","success");
			setTimeout(function(){
				location.reload();
			},1000);
		} else {
			showAlert(msg.error, 'danger');
		}
	});
}


$(".confirm").on('click', '.closeTag', function(event) {
	var _this = this;
	$.ajax({
		url : "api/admin_api/remove_godList",
		dataType:"json",
		method:"post",
		data:{"course_id":window.id , "id":$(_this).parents().data('id')}
	}).then(function(msg){
		if(msg.status){ 
			$(_this).parent().remove();
			if($(".js-godList .tag").length <= 0){
				$(".js-godList").html("<p style='color:#aaa'>这个课程还没有来上课的大神</p>")
			}
			showAlert("删除大神成功，点击添加上课大神按钮可以继续添加大神！", "success");
		}else{
			showAlert(msg.error , "danger");
		}
	});
});

$(".confirm").on('click', '.js-editCourseGod', function(event) {
	var formData = new Array();
	formData.push({
		"chinaName" : "大神名称",
		"id" : "js-godName",
		"placeholder" : "请输入大神的用户名"
	});
	input({
		"title" : "为课程添加大神",
		"id" : $parents.data('id'),
		"content" : commit(formData , {"submitFunctionName" : "addCourseGod()" , "header" : "<tr><td>" , "footer" : "</tr></td>"}),
		"success" : addCourseGod
	});
});


$(".edit-slider").click(function(){
	$parents = $(this).parents().parents().eq(0);
	window.id = $parents.data("id");

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
	formData.push({
		"chinaName" : "上课大神" , 
		"type" : "custom", 
		"value" : "<button type='button' class='js-editCourseGod'><i class='fa fa-plus-circle'></i>添加上课大神</button>"
	});
	var tagList = "";
	var getCourse = $.ajax({
		url : "api/admin_api/get_god_from_course",
		method: 'POST',
		data : {id : $parents.data('id')},
		dataType : "JSON",
	}).then(function(msg){
		var jsonCourseGodList = JSON.parse(msg.data);
		for (var index = 0; index < jsonCourseGodList.length; index ++) {
			tagList += "<a href='javascript:;' class='tag' data-id='"+jsonCourseGodList[index].id+"'>"+jsonCourseGodList[index].nickname+"<span class='closeTag'>X</span></a>";
		};
		if(tagList.length<=0){
			tagList = "<p style='color:#aaa'>这个课程还没有来上课的大神！</p>";
		}
		formData.push({
			"type" : "custom", 
			"value" : "<div class='js-godList'>"+tagList+"</div>"
		})
		var dataIndex = 0;
		switch($parents.data('listtype')){
			case "Android" : dataIndex = 0;break;
			case "Cocos2d-x" : dataIndex = 1;break;
			case "Web" : dataIndex = 2;break;
			case "Swift" : dataIndex = 3;break;
			case "u3d" : dataIndex = 4;break;
		}
		formData[2].data[dataIndex] .selected = "selected";
		input({
			"title" : "编辑该课程",
			"id" : $parents.data('id'),
			"content" : commit(formData , {"submitFunctionName" : "addClass()" , "header" : "<tr><td>" , "footer" : "</tr></td>"}),
			"success" : editCourse
		});
	});
		return false;

});





$("tr").click(function(){
	var id = $(this).data("type");
	location.href = "admin/classListSite/" + id;
})