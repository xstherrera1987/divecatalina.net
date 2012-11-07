<!DOCTYPE html>  
<html lang="en">
<head>
    <title>
	<?php
		// The Page's Title
		if ( is_home() || is_front_page() ) {
			bloginfo('name');
			echo " ".
	 		bloginfo('description'); 
		} else {
			 bloginfo('name'); 
			 print ' | Not Found'; 
		}
	?>
	</title>
     
    <meta http-equiv="content-type" 
		content="<?php bloginfo('html_type'); ?> charset=<?php bloginfo('charset'); ?>" />
	<!-- main style sheet --> 
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />

	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/reset.css" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/style.css" type="text/css" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/media-queries.css" type="text/css" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php wp_enqueue_script("jquery"); ?>
	<!-- more WP metadata, stylesheets -->
    <?php wp_head(); ?>

</head>

<body>
<div id="wrapper">
	<div id="header">
	<header>	
		
		<h1><a href="index.html">Dive Catalina</a></h1>
		<h2>Work less... Dive Moore!</h2>
		<div class = "clear"></div>
		
		<div id="dc-logo">
			
		</div>
		<div id="tagline">
			
		</div>
        <div id="mainnav">
        	<nav>
	        <!-- pull in custom NAV menu, admin can change what appears here -->
	        <!-- calls wp_page_menu if no menu is set in admin panel -->
	        <?php
	        // default menu if none is defined
	        function default_menu_cb() {
	        	$args = array('sort_column' => 'menu_order', 'show_home' => true, 'depth' => 1);
				wp_page_menu($args);
	        }
			
			// depth is the number of levels of child pages to show
	        wp_nav_menu( array( 'theme_location' => 'mainnav-menu', 'fallback_cb' => 'default_menu_cb' , 'depth' => 1) );
	        ?>
	        </nav>
        </div>
	</div>
	</header>