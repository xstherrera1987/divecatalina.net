<?php 
/**
   Template Name:  HOME
 * this one is used on the HOME page
 */
get_header(); 
?>
    <div id="content">
<?php
	the_post();
	the_content();
?>
	</div>
<?
get_sidebar();
get_footer();
