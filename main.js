$(function () {
	var _window = $(window),
		_div = $('.ranking-main'),
		topBottom;

	_window.on('scroll', function () {
		topBottom = $('.functionpoint').height();
		if (_window.scrollTop() > topBottom) {
			_div.addClass('fixed');
		}
		else {
			_div.removeClass('fixed');
		}
	});

	_window.trigger('scroll');
});