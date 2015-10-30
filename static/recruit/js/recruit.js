$(document).ready(function () {
	var $doc = $(this);
	$doc.bind('scroll.bcd', function() {
		if($doc.scrollTop()>200) {
			$('#second').css('display', 'block');

			$doc.unbind('scroll.bcd');
		}
	});
})
