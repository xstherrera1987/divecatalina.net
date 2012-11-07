<?php 
/**
   Template Name:  Single Page
 * this is the default for pages that don't specify a template
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
