<!DOCTYPE html>  
<html lang="en">
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
    <title>
		<?php
			// The Page's Title
			if ( is_home() || is_front_page() ) {
				bloginfo('name');
			} else {
				bloginfo('name');
				single_post_title(' | ');
			}
		?>
	</title>
     
	<?php /* style sheets */ ?>
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

	<?php /* load JS */ ?>
	<?php wp_enqueue_script("jquery"); ?>
	<?php /* defer script loading until end because depend on jquery */ ?>
	
	<script type="text/javascript" defer='defer' 
		src="<?php bloginfo('template_directory');?>/js/nav.js">
	</script>
	
	<?php 
	if ( is_home() || is_front_page() ): ?> 
		<script type="text/javascript" defer='defer' 
			src="<?php bloginfo('template_directory');?>/js/slideshow.js">
		</script>
	<?php endif; ?>
	
	<?php /* more WP metadata, stylesheets  */ ?>
    <?php wp_head(); ?>
</head>

<body>
<div id="container">
	<header>
		<h1><a href="http://www.divecatalina.net"><?php bloginfo('name'); ?></a></h1>
		<h2><?php bloginfo('description');?></h2>
		<div class = "clear"></div>

		<a class="toggleMenu" href="#">Menu</a>
		<ul class="nav">
	    	<?php
	        	wp_nav_menu(array('items_wrap' => '%3$s', 'depth' => 3, 
	        	'theme_location' => 'mainnav-menu', 'container' => '',
				'fallback_cb' => 'build_navmenu2'));
	        
				// use menu from admin panel, or fallback if none defined
				/*
		        wp_nav_menu( array( 'theme_location' => 'mainnav-menu', 
		        'fallback_cb' => 'build_navmenu2', 'depth' => 2, 
		        'items_wrap' => '%3$s', 'walker' => new SimpleNavWalker(),
		        'container' => '',));
				 */
	        ?>
		</ul>
		<?php wp_head(); ?>
	</header>