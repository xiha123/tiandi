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
	$("#input .confirm-bottom").find(".button_ok").on("click",function(){
		config.success();
		$("#input .confirm").find(".close").click();	
	})
}




function close(){
	$(".confirm").css({"top" : "0px" });
	setTimeout(function(){
		$(".window").fadeOut(200);
		$(this).parent().parent().hide();
		$(".confirm").css({"display" : "none"});

	},200);
}