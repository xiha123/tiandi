$(document).ready(function() {
    $.each($('[data-widget]'), function(index, value) {
        var $widget = $(value);

        switch($widget.attr('data-widget')) {
            case 'slider': initSlider($widget); break;
            case 'tab': initTab($widget); break;
        }
    });

    /**
     * @method initSlider
     * @description init slider
     * @param {Selector} selTrigger: use to select triggers
     * @param {Selector} selSheet: use to select sheets
     * @param {Number} interval: use to set interval
     * @param {String} activeClass: use to add on active sheet and trigger
     * @param {Number} curIndex: slider will start from this index
     */
    function initSlider($slider) {
        var config = $.extend({
                selTrigger: '.js-slider-trigger',
                selSheet: '.js-slider-sheet',
                interval: 5000,
                activeClass: 'active',
                curIndex: 0
            }, JSON.parse($slider.attr('data-config') || '{}')),
            $triggers = $slider.find(config.selTrigger).children('li'),
            $sheets = $slider.find(config.selSheet).children('li'),
            count = $sheets.length,
            timer;

        refresh(config.curIndex);
		setTimer();

		$slider.delegate(config.selTrigger + ' li', 'click', function (e) {
			var index = $triggers.index(e.currentTarget);
			index !== config.curIndex && refresh(index) || setTimer();
		});

		function setTimer() {
			timer && clearInterval(timer);
			timer = setInterval(refresh, config.interval);
		}

		function refresh(newIndex) {
			newIndex = newIndex === undefined ? (config.curIndex + 1) % count : newIndex;

			$triggers.eq(config.curIndex).removeClass(config.activeClass);
			$triggers.eq(newIndex).addClass(config.activeClass);
			$sheets.eq(config.curIndex).removeClass(config.activeClass);
			$sheets.eq(newIndex).addClass(config.activeClass);
			config.curIndex = newIndex;
		}
    }

    /**
     * @method initTab
     * @description init tab
     * @param {Selector} selTrigger: use to select triggers
     * @param {Selector} selSheet: use to select sheets
     * @param {String} activeClass: use to add on active sheet and trigger
     * @param {Number} curIndex: tab will start from this index
     */
    function initTab($tab) {
        var config = $.extend({
                selTrigger: '.js-tab-trigger',
                selSheet: '.js-tab-sheet',
                activeClass: 'active',
                curIndex: 0
            }, JSON.parse($tab.attr('data-config') || '{}')),
            $triggers = $tab.find(config.selTrigger).children('li'),
            $sheets = $tab.find(config.selSheet).children('li');

        refresh(config.curIndex);

		$tab.delegate(config.selTrigger + ' li', 'click', function (e) {
			var index = $triggers.index(e.currentTarget);
			index !== config.curIndex && refresh(index);
		});

		function refresh(newIndex) {
			$triggers.eq(config.curIndex).removeClass(config.activeClass);
			$triggers.eq(newIndex).addClass(config.activeClass);
			$sheets.eq(config.curIndex).removeClass(config.activeClass);
			$sheets.eq(newIndex).addClass(config.activeClass);
			config.curIndex = newIndex;
		}
    }
});
