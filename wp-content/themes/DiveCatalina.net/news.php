<?php 
/**
   Template Name:  NEWS
 * this one is used on the NEWS page
 */
get_header(); 
?>
    <div id="content">
<?php
while ( have_posts() ) {
	the_post();
	the_content();
	echo "<hr />";
}
?>
	</div>
<?
get_sidebar();
get_footer();
