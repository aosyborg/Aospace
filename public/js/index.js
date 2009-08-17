
$(document).ready(function() {

	/**
	 * Load flickr photos via ajax to speed up page load times
	 */
	$.ajax({
	   url: '/index/getFlickrPhotos',
	   success: function(html) {
	       $('#flickrPhotos').hide().html(html).fadeIn('fast');
	   }
	});

});
