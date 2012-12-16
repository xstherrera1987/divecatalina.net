jQuery(document).ready( function() {
	jQuery("#slideshow img:gt(0)").hide();
	window.setInterval(
		function() {
			jQuery('#slideshow img').eq(0).fadeOut(1200);
			jQuery('#slideshow img').eq(1).fadeIn(900);
			jQuery('#slideshow img').eq(0).appendTo('#slideshow');
		}, 3500);
});