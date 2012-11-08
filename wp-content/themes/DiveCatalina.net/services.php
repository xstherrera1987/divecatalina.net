<?php 
/**
   Template Name:  Services
 */
get_header(); 
?>

<?php
	// no content from this page, only from children

	// pull in direct descendants
	$main_subpages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date',
		 'sort_order' => 'desc' ));
	$div_serv_page = $main_subpages[0];
	$div_cls_page = $main_subpages[1];
	$rentals_page = $main_subpages[2];
	
	// pull dive services main content
	$div_serv_title = $div_serv_page->post_title;
	$div_serv_content = $div_serv_page->post_content;
	$div_serv_content = apply_filters( 'the_content', $div_serv_content );
	
	// pull in subpages of dive services
	$div_srv_subpages = get_pages( array( 'child_of' => $div_serv_page->ID, 
		'sort_column' => 'post_date' ));
	$div_cls_subpages = get_pages( array( 'child_of' => $div_cls_page->ID, 
		'sort_column' => 'post_date' ));
	
	// remove granchildren, by re-executing search excluding the grandchildren
	$div_srv_ids = array();
	$div_cls_ids = array();
	foreach($div_srv_subpages as $pg) {
		array_push($div_srv_ids, $pg->ID);
	}
	foreach($div_cls_subpages as $pg) {
		array_push($div_cls_ids, $pg->ID);
	}
	var_dump($div_srv_ids);
	
	$ids = array_merge($div_srv_ids, $div_cls_ids);
	
	$main_subpages = get_pages( array( 'child_of' => $post->ID, 'sort_column' => 'post_date', 
		'sort_order' => 'desc', 'exclude' => $ids ));
		
	var_dump();
?>
<div id="container">
    <div id="content">
    	<section id="dive-services">
    		
			<div class="main-content"> 
				<h1> <? echo $div_serv_title; ?> </h1>	
				<div class = "clear"></div>
				<? echo $div_serv_content; ?>
				
			</div>
			<div class="center">
		<?
			foreach($div_srv_subpages as $pg): 
				// pull this subpages content (this dive class)
				$pg_title = $pg->post_title;
				// remove the -Widget page suffix
				$pg_title = str_replace("-Widget", "", $pg_title);
				$pg_content = $pg->post_content;
				$pg_content = apply_filters( 'the_content', $pg_content );
			?>
				<div class="services-offered">
					<h1> <? echo $pg_title; ?> </h1>
					<? echo $pg_content; ?>
				</div>
			<? endforeach; ?>
			</div>		
		</section>
		<hr />

<?
	// pull dive classes main content
	$div_cls_title = $div_cls_page->post_title;
	$div_cls_content = $div_cls_page->post_content;
	$div_cls_content = apply_filters( 'the_content', $div_cls_content );
?>
		<section id="dive-classes">
			<div class="main-content"> 
				<h1> <? echo $div_cls_title; ?> </h1>	
				<div class = "clear"></div>
				<? echo $div_cls_content; ?>
			</div>
			<div class="center">
		<?
			foreach($div_cls_subpages as $pg): 
				// pull this subpages content (this dive class)
				$pg_title = $pg->post_title;
				$pg_content = $pg->post_content;
				$pg_content = apply_filters( 'the_content', $pg_content );
			?>
				<!-- inside foreach loop -->
				<div class="classes-offered">
					<h1> <? echo $pg_title; ?> </h1>
					<? echo $pg_content; ?>
				</div>
			<? endforeach; ?>
			</div>
		</section>
		<hr />
		
<?
	// pull rentals main content
	$rentals_title = $rentals_page->post_title;
	$rentals_content = $rentals_page->post_content;
	$rentals_content = apply_filters( 'the_content', $div_cls_content );
?>
		<section id="rental">
			<div class="main-content">
				<h1> <? echo $rentals_title; ?> </h1>	
				<div class = "clear"></div>
				<? echo $rentals_content; ?>
			</div>
		</section>
    </div>
</div>
<?
get_sidebar();
get_footer();
