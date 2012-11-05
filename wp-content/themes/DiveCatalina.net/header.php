<!DOCTYPE html>  
<!-- HTML5 doctype -->
<!-- NOTE: add HTML5 shim includes in here -->
<html lang="en">
<head>
    <title>
	<?php
			// The Page's Title
			if ( is_home() || is_front_page() ) {
				bloginfo('name'); 
		 		print ' | '; 
		 		bloginfo('description'); 
			} elseif ( is_single() ) {
				 single_post_title(); 
			} elseif (is_page() ) {
				 single_post_title(''); 
			} else {
				 bloginfo('name'); 
				 print ' | Not Found'; 
			}
	?>
	</title>
     
    <meta http-equiv="content-type" 
		content="<?php bloginfo('html_type'); ?>; 
		charset=<?php bloginfo('charset'); ?>" /> 
    <link rel="stylesheet" type="text/css" 
		href="<?php bloginfo('stylesheet_url'); ?>" />
     
	<?php wp_enqueue_script("jquery"); ?>
	<!-- more WP metadata, stylesheets -->
    <?php wp_head(); ?>
</head>

<body>
<div id="wrapper">
	<div id="header">
		<div id="dc-logo">
			
		</div>
		<div id="tagline">
			
		</div>
        <div id="mainnav">
	        <!-- pull in custom NAV menu, admin can change what appears here -->
	        <!-- defaults to page menu if none is defined -->
	        <?php wp_nav_menu( array( 'theme_location' => 'native-menu' ) ); ?>
        </div>
	</div>
	