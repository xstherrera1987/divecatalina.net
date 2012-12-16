<?php 
/**
 * The template for displaying all pages.
 * This is the template that displays all pages by default.
 */
get_header(); ?>

	<div id="content">
		<div id="main-content">
			<?php
				the_post();
				the_content();
			?>
		</div>
	</div>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>
