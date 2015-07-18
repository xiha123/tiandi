// JavaScript Document
$(document).ready(function(){
	$(".close , #close").click(close);
});

function confirms(config){
	$(".window,#confirm").fadeIn(200);
	setTimeout(function(){
		$("#confirm").css({"top" : "20%"});
	},50);
	$("#confirm .confirm-title h2").text(config.title);
	$("#confirm .confirm-content .con").html(config.content);
	$("#confirm .confirm-content i").addClass(config.icon);
	$("#confirm .confirm-bottom").find(".button_ok").unbind("click");
	window_init();
	$("#confirm .confirm-bottom").find(".button_ok").on("click",function(){
		config.success();
		$(".confirm").find(".close").click();
	})
}

function input(config){
	$(".window,#input").fadeIn(200);
	setTimeout(function(){
		$("#input").css({"top" : "20%"});
	},50);
	$("#input .confirm-title h2").text(config.title);
	$("#input .confirm-content .con").html(config.content);
	$("#input .confirm-content i").addClass(config.icon);
	$("#input .confirm-bottom").find(".button_ok").unbind("click");
	window_init();
	$("#input .confirm-bottom").find(".button_ok").on("click",function(){
		config.success();
		$("#input .confirm").find(".close").click();
	})
}


function window_init(){
var sourceInfo;
var reader = new FileReader();
$previewImg = $('#preview'),
reader.onload = function (e) {
	$previewImg.attr('src', e.target.result);
	$temp.attr('src', e.target.result);
}

$(".slider-color").keypress(function(){
	setTimeout(function(){
		$(".color").css({"background-color" : $(".slider-color").val()});
	},200);
})

 $(".window").on("change" , 'input[type="file"]' , function (e) {
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
}
function hideAlert() {
    $alertBox.hide();
	alertTimer && clearTimeout(alertTimer);
	alertTimer = null;
}
