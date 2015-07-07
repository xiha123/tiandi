$(document).ready(function() {
	var $sliderTriggers = $('.js-slider-trigger').children('li'),
		$sliderContents = $('.js-slider-content').children('li'),
		sliderCurIndex = 0;

	$('.js-slider-trigger').delegate('li', 'click', function (e) {
		var index = $sliderTriggers.index(e.currentTarget);

		index !== sliderCurIndex && refreshSlider(index);
	});

	setInterval(refreshSlider, 5000);

	function refreshSlider(newIndex) {
		newIndex = newIndex || (sliderCurIndex + 1) % 3;

		$sliderTriggers.eq(sliderCurIndex).removeClass('active');
		$sliderTriggers.eq(newIndex).addClass('active');
		$sliderContents.eq(sliderCurIndex).removeClass('active');
		$sliderContents.eq(newIndex).addClass('active');
		sliderCurIndex = newIndex;
	}
});
