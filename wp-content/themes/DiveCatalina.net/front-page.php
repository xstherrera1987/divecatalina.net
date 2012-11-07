<?php 
/**
   Template Name:  HOME
 * this one is used on the HOME page
 */
get_header(); 
?>
<div id="container">
    <div id="content">
<?php
while ( have_posts() ) {
	the_post();
	the_content();
	echo "<hr />";
}
?>
    </div>
</div>
<?
get_sidebar();
get_footer();
