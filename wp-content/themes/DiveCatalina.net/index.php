<?php 
/**
   Template Name:  default
 * default if no other template is applicable (eg. for posts)
 * when using static front page, index.php is only template for posts page
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
