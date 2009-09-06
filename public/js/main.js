$(document).ready(function(){

	/**
	 * Add Curvey corners to page
	 */
	$('#content').corner();
	$('.sideimage').corner();
	$('.flickrImage').corner();
	$('.top-menu').corner({
		tl: { radius: 6},
		tr: { radius: 6},
		bl: false,
		br: false
	});

	/**
	 * Add click handlers to ie and no script notices
	 */
	$('.cornerx').click(function() {
			$(this).parent().slideUp();
	});

	/**
	 * Hide no script
	 */
	$('#noscript').hide();

});
