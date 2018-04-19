/**
 * Popup share icons
 * by Hugo Wantuil (@hugw)
 */
jQuery(document).ready(function($) {
	$('.popup').click(function() {
		var width  = 575,
			height = 450,
			left   = ($(window).width()  - width)  / 2,
			top    = ($(window).height() - height) / 2,
			url    = this.href,
			opts   = 'status=1' +
			',width='  + width  +
			',height=' + height +
			',top='    + top    +
			',left='   + left;

		window.open(url, '_blank', opts);

		return false;
	});
});