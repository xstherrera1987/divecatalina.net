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
			 single_post_title();
		}
	?>
	</title>
     
    <meta http-equiv="content-type" 
		content="<?php bloginfo('html_type'); ?> charset=<?php bloginfo('charset'); ?>" />

	<!-- style sheets -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory');?>/css/reset.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
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
<div id="container">
	<header>
		<h1><a href="index.html">Dive Catalina</a></h1>
		<h2>Work less... Dive Moore!</h2>
		<div class = "clear"></div>

        	<nav>
	        <?php
				// use menu from admin panel, or build_navmenu if none is defined
		        wp_nav_menu( array( 'theme_location' => 'mainnav-menu', 'fallback_cb' => 'build_navmenu', 
		        'depth' => 1, 'items_wrap' => '%3$s', 'walker' => new SimpleNavWalker(), 'container' => '',
		        	'before' => '', 'after' => '' ));
	        ?>
	        </nav>
	</header>

