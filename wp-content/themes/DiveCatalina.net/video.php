<?php 
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */
get_header(); ?>

	<div id="content">
		<div id="main-content">
			<?php
				while ( have_posts() ) {
					the_post();
					the_content();
					echo "<hr />";
				}
			?>
		</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>