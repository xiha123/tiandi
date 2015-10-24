$(document).ready(function() {
    var $curTag = $('.tab [data-id="' + (window.location.hash.slice(1) || '') + '"]');
    $curTag.length && $curTag.trigger('click');
});

$box = $("#box");
$(document).on('click', '.list li', function(event) {
	$box.find("img").attr("src" , "static/uploads/" + $(this).data("img"));
	$box.find(".content").text($(this).attr("data-description"));
	$box.find(".level i").remove();
	$box.find("#titleName").text($(this).data('title'));
    $box.find('.js-detail-link').attr('href', 'course?id=' + $(this).attr('data-id'));
    $box.find('.js-course-link').attr('href', $(this).attr('data-link'));
	for (var index = 0;index < $(this).data('level');index ++) {
		$box.find(".level").append('<i class="fa fa-star"></i>');
	}
	for (var index = 0;index < 5 - $(this).data('level');index ++) {
		$box.find(".level").append('<i class="fa fa-star-o"></i>');
	}
	$(".windows").show();
	$box.show();
});
$box.find(".close").click(function(){
	$(".windows").hide();
	$box.hide();
})


$(document).on('click', function(event) {
	if($(event.target).attr("class") == "windows"){
		$(".windows").hide();
		$box.hide();
	}
});
