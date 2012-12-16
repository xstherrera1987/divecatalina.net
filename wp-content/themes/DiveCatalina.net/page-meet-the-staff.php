<?php 
/**
 * Template Name:  Redirect -> Meet the Staff
 * Description: redirects to About Us, Staff section
 */ 
// get parent page (about us)
$aboutus_url = get_permalink($post->post_parent);
// anchor into the staff section
$aboutus_url .= "#meetthestaff";
// go there
header( 'Location: '.$aboutus_url ) ;
