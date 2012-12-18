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
	register_nav_menus(array('mainnav-menu'=>__('Main Navigation Menu')));
}
add_action('init', 'register_mainnav_menu');

// returns true if sidebar named $name is active
// eg. primary_widget_area, secondary_widget_area, etc..
function is_sidebar_active( $name ) {
  $widgetcolums = wp_get_sidebars_widgets();
  if ($widgetcolums[$name]) return true; 
  return false;
}

// build nav as <li>
function main_navmenu_fallback() {
	$args = array(
	'depth'        => 2,
	'sort_column'  => 'menu_order, post_title',
	'link_before'  => '',
	'link_after'   => '',
	'title_li'     => '',
	'post_type'    => 'page',
    'post_status'  => 'publish'
	);
	
	wp_list_pages( $args );
}

// build nav for footer (each <li> in a <ul>)
function foot_navmenu_fallback() {
	$args = array(
	'depth'        => 2,
	'sort_column'  => 'menu_order, post_title',
	'link_before'  => '<p class="bottomnav">',
	'link_after'   => '</p>',
	'title_li'     => '',
	'post_type'    => 'page',
    'post_status'  => 'publish'
	);
	
	wp_list_pages( $args );
}
function remove_gallery_style() {
  return "<div class='gallery'>";
}
add_filter('gallery_style', 'remove_gallery_style');
