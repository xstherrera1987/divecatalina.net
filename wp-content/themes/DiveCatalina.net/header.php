<!DOCTYPE html>  
<html lang="en">
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
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
     
	<!-- style sheets -->
	<link rel="stylesheet" 
		href="<?php bloginfo('template_directory');?>/css/reset.css" 
		type="text/css" />
    <link rel="stylesheet" type="text/css" 
		href="<?php bloginfo('stylesheet_url'); ?>" />
    <link rel="stylesheet" 
		href="<?php bloginfo('template_directory');?>/css/media-queries.css"
		type="text/css" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
		</script>
	<![endif]-->

	<?php wp_enqueue_script("jquery"); ?>
	
	<!-- load JS  -->
		<script src="<?php bloginfo('template_directory');?>/js/script.js"></script>
	<?php 
	if ( is_home() || is_front_page() ): ?> 
		<script src="<?php bloginfo('template_directory');?>/js/slideshow.js">
		</script>
	<? endif; ?>
	
	<!-- more WP metadata, stylesheets -->
    <?php wp_head(); ?>

</head>
<body>
<div id="container">
	<header>
		<h1><a href="index.html"><?php bloginfo('name'); ?></a></h1>
		<h2><?php bloginfo('description');?></h2>
		<div class = "clear"></div>

	        <?php
				// use menu from admin panel, or fallback if none defined
		        wp_nav_menu( array( 'theme_location' => 'mainnav-menu', 
		        'fallback_cb' => 'build_navmenu2', 'depth' => 1, 
		        'items_wrap' => '%3$s', 'walker' => new SimpleNavWalker(),
		        'container' => '', 'before' => '', 'after' => '' ));
	        ?>
	</header>

