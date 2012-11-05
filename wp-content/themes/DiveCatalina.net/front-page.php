<?php 
/**
   Template Name:  FRONT-PAGE.PHP
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

if (is_sidebar_active("primary_widget_area") ) {
	echo "PRIMARY sidebar detected";
} else {
	echo "NO sidebar detected";
}

get_footer();
