// JavaScript Document
$(document).ready(function(){
	$(".close_window , #close_window").click(close);
});

function search(link){
	window.location = link + "?search=" + $("#searchName").val();
}

/**
 * form 表单处理
 * @param  {[type]} formData   [description]
 * @param  {[type]} formConfig [description]
 * @return {[type]}            [description]
 *
 * type string
 * name string
 * data [value , name]
 * placeholder
 *
 * formConfig
 * submitFunctionName
 * header
 * footer
 */
function commit(formData , formConfig){
	var formInput = '<form action="javascript:;" onsubmit = "' + formConfig.submitFunctionName + '"><table class="table-form">',
		type , name , value , value_data = "" , inputValue , id , placeholder;
	for (var i = 0; i < formData.length; i++) {
		type = formData[i].type == undefined ? "text" : formData[i].type;
		name = formData[i].name == undefined ? "" : 'name="' + formData[i].name + '"' ;
		inputValue = formData[i].value == undefined ? "" : 'value="' +formData[i].value + '"' ;
		id = formData[i].id == undefined ? "" : 'id="' +formData[i].id + '"';
		value = formData[i].data == undefined ? "" : formData[i].data;
		placeholder = formData[i].placeholder == undefined ? "" : formData[i].placeholder;
		if(formData[i].type == "select"){
			for (var index = 0;index < value.length;index ++) {
				selected = value[index].selected == undefined ? "" : "selected='"+value[index].selected+"'";
				value_data += "<option value='" + value[index].value + "' "+selected+">" + value[index].name + "</option>";
			};
			formInput += formConfig.header +formData[i].chinaName+ "：<select " + name + ' ' + id + ">" + value_data + "</select>"+ formConfig.footer;
		}else{
			if(formData[i].type == "custom"){
				formInput += formConfig.header + (formData[i].chinaName == undefined ? "" : formData[i].chinaName+'：')+ formData[i].value + formConfig.footer ;
			}else{
				formInput += formConfig.header + formData[i].chinaName+'：<input type="' + type + '" ' + name + ' ' + id +' ' +inputValue+ ' ' + (value != undefined ? value : "") + ' placeholder="' + placeholder+ '" />' + formConfig.footer ;
			}
		}
	};
	formInput =  formInput + "</table>" + "</form>";
	return formInput;
}




function alertBox(config) {
	$(".window,#alert").fadeIn(200);
	setTimeout(function(){
		$("#alert").css({"top" : "10%"});
	},50);
	$("#alert .confirm-title h2").text(config.title);
	$("#alert .confirm-content .con").html(config.content);
	$("#alert .confirm-content i").addClass(config.icon);
	$("#alert .confirm-bottom").find(".button_ok").on("click",function(){

	})
}

function confirms(config){
	$(".window,#confirm").fadeIn(200);
	setTimeout(function(){
		$("#confirm").css({"top" : "10%"});
	},50);
	$("#confirm .confirm-title h2").text(config.title);
	$("#confirm .confirm-content .con").html(config.content);
	$("#confirm .confirm-content i").addClass(config.icon);
	window_init();
	$("#confirm .confirm-bottom").find(".button_ok").unbind("click");
	$("#confirm .confirm-bottom").find(".button_ok").on("click",function(){
		config.success();
	})
}

function input(config){
	$(".window,#input").fadeIn(200);
	setTimeout(function(){
		$("#input").css({"top" : "10%"});
	},50);
	$("#input .confirm-title h2").text(config.title);
	$("#input .confirm-content .con").html(config.content);
	$("#input .confirm-content i").addClass(config.icon);
	window_init();
	$("#input .confirm-bottom").find(".button_ok").unbind("click");
	$("#input .confirm-bottom").find(".button_ok").on("click",function(){
		config.success();
		return false;
	})
}

window_init();
function window_init(){
	var sourceInfo;
	var reader = new FileReader();
	$previewImg = $('#preview'),
	reader.onload = function (e) {
		$previewImg.attr('src', e.target.result);
		$('.preview').attr('src', e.target.result);
		$temp.attr('src', e.target.result);
	}
	$(".color").css({"background-color" : $(".slider-color").val()});
	$(".slider-color").keypress(function(){
		setTimeout(function(){
			$(".color").css({"background-color" : $(".slider-color").val()});
		},200);
	})

	 $("body").on("change" , 'input[type="file"]' , function (e) {
		var file = e.target.files[0];
		reader.readAsDataURL(file);
		$temp = $('.temp-image'),
		sourceInfo = {
			height: $temp.height(),
			width: $temp.width()
		};
		$(".table-form span").text("建议图片尺寸：1200 * 400 ， 该图片尺寸：" + sourceInfo.width + " * " + sourceInfo.height);
	});
}


function close(){
	$(".confirm").css({"top" : "0px" });
	setTimeout(function(){
		$(".window").fadeOut(200);
		$(this).parent().parent().hide();
		$(".confirm").css({"display" : "none"});

	},200);
}

var $alertBox = $('.alert'),
	alertTimer;
function showAlert(text, type) {
	type && $alertBox[0].setAttribute('class', 'alert alert-dismissible alert-' + type);
    $alertBox.children('p').text(text);
    $alertBox.show();
	alertTimer && clearTimeout(alertTimer);
	alertTimer = setTimeout(hideAlert, 2000);
	return false;
}
function hideAlert() {
    $alertBox.hide();
	alertTimer && clearTimeout(alertTimer);
	alertTimer = null;
}
