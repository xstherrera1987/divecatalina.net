<?php 
/**
 *  Template Name:  Services Template
 *	Description: A Page Template for the different services pages
 *	  It is composed of several sections (subpages) that alternate format
 *	  left-image with right-text and right-image with left-text
 */
get_header(); ?>

<?php
  // service page content (title and maybe short description)
  echo '<div class="service">';
  echo '  <div class="service-description">';
    the_post();
    the_content();
  echo '</div>';
  echo '<br />';

  // get each service section
  $sections = get_pages( array( 'child_of' => $post->ID, 
    'parent' => $post->ID, hierarchical => '1', 'sort_column' => 'post_date', 
    'sort_order' => 'desc' ) );

  for ($i=0; $i<count($sections); $i++) {
    $pg = $sections[$i];
    echo '  <div class="service-section">';
    
    // alternate image and text positions
    if(i==0) {
      the_serviceimage($pg);
      the_servicecontent($pg);
    } else {
      the_servicecontent($pg);
      the_serviceimage($pg);
    }
    
    echo '  </div>';
    echo '  <div class="clear"></div>';
    
    if ($i != count($sections)-1) 
      echo '  <hr />';
  }

  // get the attached image and output onto page within div (class=portrait)
  function the_serviceimage($pg) {
    echo '  <div class="service-image">';
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
  }
  
  function the_servicecontent($pg) {
    echo '  <div class="service-content">';
    $servicecontent = $pg->post_content;
    echo apply_filters( 'the_content', $servicecontent );
    echo '  </div>';
  }
  echo '</div>';

?>
<?
get_sidebar();
get_footer();
