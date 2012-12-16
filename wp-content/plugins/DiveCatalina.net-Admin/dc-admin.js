jQuery(document).ready( function() {
	jQuery("#wp-admin-bar-about > a").attr("href", "http://codex.wordpress.org/");	
	jQuery("#wp-admin-bar-documentation > a").html("DiveCatalina.net Documentation");
	jQuery("#wp-admin-bar-documentation > a").attr("href", "http://divecatalina.net/documentation");
	jQuery("#wp-admin-bar-support-forums").hide();
	jQuery("#wp-admin-bar-feedback").hide();
});
