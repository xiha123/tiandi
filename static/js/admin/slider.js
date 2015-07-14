$(document).ready(function(){
	
	$(".close").click(close);	
	$("#close").click(close);	
	
	$(".remove-slider").click(function(){
		confirms();
	});
	
	
	function close(){
		$(".window").hide();
		$(this).parent().parent().hide();
	}
	


})