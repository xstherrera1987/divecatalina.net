<?php 
/**
   Template Name:  gallery-test
   testing code for pulling in gallery images
 */
get_header();
?>
<script type="text/javascript">
	// slideshow JS function
	home_slideshow();
</script>
<div id="content">
	<div id="gallery">
<?php
	// pull in all images attached to this post
	$args = array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $post->ID);
	$images = get_posts( $args );
	foreach($images as $img) {
		$img_meta = wp_get_attachment_metadata($img->ID);
		$width = $img_meta['width'];
		$height = $img_meta['height'];
		$img_data = wp_get_attachment_image_src($img->ID, array($width,$height));
		$url = $img_data[0];
		echo '<img src="'.$url.'" height="'.$height.'" width="'.$width.'" />';
	}
?>
	</div>
</div>
<?
// NOTE: no sidebar
get_footer();
