<?php 
/**
 *  Template Name:  Photo Gallery Template
 *  Description: A Page Template that displays the photo gallery
 */
get_header();?>

<script type="text/javascript">

</script>

<div id="content">
  <?php
							the_post();
				      the_content();
			?>
</div>

<?php get_footer(); ?>
