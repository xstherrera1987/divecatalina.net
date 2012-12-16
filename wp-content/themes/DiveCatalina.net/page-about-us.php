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
				echo '<br/><hr/><br/>';
				
				// get Meet the Staff from DB
				$subpages = get_pages( array( 'child_of' => $post->ID, 'parent' => $post->ID, hierarchical => '1', 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
				
				$meetstaff = $subpages[0];
				$meetstaff_content = apply_filters( 'the_content', $meetstaff->post_content );
				
				// Meet the Staff content (title and maybe short description)
				echo '<div class="subpage">';
				echo $meetstaff_content;
				echo '<br />';
				
				// get each staff page
				$staffpages = get_pages( array( 'child_of' => $meetstaff->ID, 'parent' => $meetstaff->ID, hierarchical => '1', 'sort_column' => 'post_date', 'sort_order' => 'desc' ) );
				
				echo '	<div id="staffpages">';
				foreach($staffpages as $pg) {
				  
				  echo '<div class="staff">';
				  // picture first (so its on left)
				  echo '  <div class="portrait">';
				  
				  $args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $pg->ID);
				  $images = get_posts( $args );
				  // only use first image
				  $img = $images[0];
				  $img_meta = wp_get_attachment_metadata($img->ID);
				  $width = $img_meta['width'];
				  $height = $img_meta['height'];
				  $img_data = wp_get_attachment_image_src($img->ID, array($width,$height));
				  $url = $img_data[0];
				  echo '<img src="'.$url.'" height="'.$height.'" width="'.$width.'" />';
				  
				  echo '  </div>';
				  
				  // get content
				  echo '  <div class="staffbio">';
				  $staff = $pg->post_content;
				  echo apply_filters( 'the_content', $staff );
				  echo '  </div>';
				  
				  echo '</div>';
				}
				echo '	</div>';
				
				echo '</div>';
			?>
    	</div>
	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
