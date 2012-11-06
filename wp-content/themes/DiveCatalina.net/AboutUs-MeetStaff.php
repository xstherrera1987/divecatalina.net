<?php 
/**
   Template Name:  AboutUs + Meet the Staf
 * shows this page and subpages
 */
get_header(); 
?>
<div id="container">
    <div id="content">

<?
	// About Us Content
	the_post();
	the_content();
	
	// get Meet the Staff from DB
	$subpages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
	$title = $subpages[0]->post_title;
	$content = $subpages[0]->post_content;
	$content = apply_filters( 'the_content', $content );
	
	// Meet the Staff content
	echo '<hr />';
	echo '<h2>'.$title.'</h2>';
	echo '<div class="subpage">'.$content.'</div>';
?>
    </div>
</div>
<?
get_sidebar();
get_footer();
