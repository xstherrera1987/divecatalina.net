<?php
/*
 *  this file contains functions that initialize our theme components
 *  as well as utility functions that we can use
 */

// register 3 widget areas
function theme_widgets_init() {
    // Area 1 = Primary
    register_sidebar( array (
	    'name' => 'Primary Widget Area',
	    'id' => 'primary_widget_area',
	    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</li>",
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
  	) );
 
    // Area 2 = Secondary
    register_sidebar( array (
	    'name' => 'Secondary Widget Area',
	    'id' => 'secondary_widget_area', 
	    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</li>",
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
  	));
	
	// Area 3 = Ternary
	register_sidebar( array (
	    'name' => 'Ternary Widget Area',
	    'id' => 'ternary_widget_area', 
	    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</li>",
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
  	));
}
add_action( 'init', 'theme_widgets_init' );

// register Main Navigation menu
function register_mainnav_menu () {
	register_nav_menus( array('mainnav-menu' => __('Main Navigation Menu') ) );
}
add_action('init', 'register_mainnav_menu');

// returns true if sidebar named $name is active
// eg. primary_widget_area, secondary_widget_area, etc..
function is_sidebar_active( $name ) {
  $widgetcolums = wp_get_sidebars_widgets();
  if ($widgetcolums[$name]) return true; 
  return false;
}

// build navigation menu
function build_navmenu() {
	$args = array( 'sort_column' => 'post_date', 'post_type' => 'page', 'parent' => 0);
	$pages = get_pages($args);

	foreach ($pages as $page) {
		echo '<a href="'.get_permalink($page->ID).'" title="'.$page->post_title.'">'.$page->post_title.'</a></li>';
	}
}

// post walker for nav menu (non-default)
class SimpleNavWalker extends Walker_Nav_Menu {
	function start_el(&$output, $item) {
    	// attributes set in admin panel (Menus section)
		$attributes .= ! empty( $item->target ) ? ' target="' . $item->target . '"' : '';
		$attributes .= ! empty( $item->xfn )    ? ' rel="'    . $item->xfn . '"' : '';
		$attributes .= ! empty( $item->url )    ? ' href="'   . $item->url . '"' : '';
		
		$item_output .= '<a'. $attributes .'>' . $item->title . '</a>';
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item);
	}
}
