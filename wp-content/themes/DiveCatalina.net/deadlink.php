<?php 
/**
 * Template Name: DeadLink
 * this will not redirect anywhere
 */
// get parent page (about us)
$url = get_permalink($post->id)."#";
// go there
header( 'Location: '.$url ) ;
