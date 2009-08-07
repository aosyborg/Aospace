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

});
