<?php 
/**
 * This template overrides the Home page to always show a slideshow
 */
get_header(); ?>
    <div id="content">
    	<div id="slideshow">
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
					echo '<img src="'.$url.'" height="256" width="755" />';
				}
			?>
		</div>
		
		<div id="main-content">
			<?php
				the_post();
				the_content();
			?>
		</div>
	</div>

<?php get_sidebar(); ?>
	<?php /* load JS as late as possible */?>
	<?php /* slideshow image fadein/fadeout code */?>
	<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/slideshow.js"></script>
<?php get_footer(); ?>