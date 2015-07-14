// JavaScript Document
$(document).ready(function(){
	$(".close").click(close);	
	$("#close").click(close);	
});

function confirms(config){
	$(".window,#confirm").fadeIn(200);
	setTimeout(function(){
		$(".confirm").css({"top" : "20%"});		
	},50);
	$(".confirm-title h2").text(config.title);
	$(".confirm-content .con").html(config.content);
	$(".confirm-content i").addClass(config.icon);
	$(".confirm-bottom").find(".button_ok").unbind("click");
	$(".confirm-bottom").find(".button_ok").on("click",function(){
		config.success();
		$(".confirm").find(".close").click();	
	})
}


function close(){
	$(".confirm").css({"top" : "0px"});
	setTimeout(function(){
		$(".window").fadeOut(200);
		$(this).parent().parent().hide();
	},100);
}