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
the_post();
the_content();

// may need to use: 
//   sort_column => menu_order
// currently later subpages are on top
$mypages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );

foreach( $mypages as $page ) {		
	$content = $page->post_content;
	$content = apply_filters( 'the_content', $content );
		echo '<hr />';
		echo '<h2>'.$page->post_title.'</h2>';
		echo '<div class="subpage">'.$content.'</div>';
	}
?>
    </div>
</div>
<?
get_sidebar();
get_footer();
