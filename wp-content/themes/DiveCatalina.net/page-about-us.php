<?php 
/**
 * Template Name:  About Us Template
 * Description: A Page Template that displays the about and staff page
 */ 

get_header(); ?>

	<div id="content">
    	<div id="main-content">
			<?php
				// About us Content
				the_post();
				the_content();
				
				// get Meet the Staff from DB
				$subpages = get_pages( array( 'child_of' => $post->ID, 'parent' => $post->ID, hierarchical => '1', 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
				
				$content = $subpages[0]->post_content;
				$content = apply_filters( 'the_content', $content );
				
				// Meet the Staff content
				echo '<br/><hr/><br/>';
				echo '<div class="subpage">'.$content.'</div>';
			?>
    	</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
