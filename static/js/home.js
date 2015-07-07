$(document).ready(function() {
	var $sliderTriggers = $('.js-slider-trigger').children('li'),
		$sliderContents = $('.js-slider-content').children('li'),
		sliderCurIndex = 0,
		sliderCount = $sliderContents.length,
		sliderInterval = 5000,
		sliderTimer;

	setSliderTimer();

	$('.js-slider-trigger').delegate('li', 'click', function (e) {
		var index = $sliderTriggers.index(e.currentTarget);

		index !== sliderCurIndex && refreshSlider(index) || setSliderTimer();
	});

	function setSliderTimer() {
		if (sliderTimer) clearInterval(sliderTimer);
		sliderTimer = setInterval(refreshSlider, sliderInterval);
	}

	function refreshSlider(newIndex) {
		newIndex = newIndex === undefined ? (sliderCurIndex + 1) % sliderCount : newIndex;

		$sliderTriggers.eq(sliderCurIndex).removeClass('active');
		$sliderTriggers.eq(newIndex).addClass('active');
		$sliderContents.eq(sliderCurIndex).removeClass('active');
		$sliderContents.eq(newIndex).addClass('active');
		sliderCurIndex = newIndex;
	}
});
