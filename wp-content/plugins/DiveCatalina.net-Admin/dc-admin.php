<?php

/*
Plugin Name: DiveCatalina.net-Admin
Description: DiveCatalina.net custom administration interface plugin
Author: Team GREP
Version: 1.0
*/

// load our stylesheet to customize the interface
function add_stylesheet() {
  echo '<link rel="stylesheet" type="text/css" href="' . 
    plugins_url('dc-admin.css', __FILE__) . '">';
}
// load our javascript to customize the interface
function add_javascript() {
  echo '<script type="text/javascript" src=' .
    plugins_url('dc-admin.js', __FILE__) . '></script>';
}

// remove widgets from the dashboard (still need to remove Welcome!!)
function remove_dashboard_widgets(){
  global$wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}

// welcome panel is not attractive, remove it
function hide_welcome_panel() {
    $user_id = get_current_user_id();

    if ( 1 == get_user_meta( $user_id, 'show_welcome_panel', true ) )
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
}
// set the number of panels on the dashboard 
function set_dashboard_columns() {
	// how many panels in dashboard
	$num = 2;
	$user_id = get_current_user_id();
	update_user_meta( $user_id, 'screen_layout_dashboard', $num );
}
	
// set footer
function remove_footer_admin () {
    echo '&copy; 2012 - Team GREP for DiveCatalina.net';
}

add_action('admin_head', 'add_stylesheet');
add_action('admin_head', 'add_javascript');
add_filter('admin_footer_text', 'remove_footer_admin');
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
add_action('wp_dashboard_setup', 'set_dashboard_columns');

// add column for reattaching images
add_filter("manage_upload_columns", 'upload_columns');
add_action("manage_media_custom_column", 'media_custom_columns', 0, 2);
// remove old column, use our new one
function upload_columns($columns) {
	unset($columns['parent']);
	$columns['better_parent'] = "Parent";
	return $columns;
}

function media_custom_columns($column_name, $id) {
	$post = get_post($id);

	if($column_name != 'better_parent')
		return;

	if ( $post->post_parent > 0 ) {
		if ( get_post($post->post_parent) ) {
			$title =_draft_or_post_title($post->post_parent);
		}
		?>
		<strong><a href="<?php echo get_edit_post_link( $post->post_parent ); ?>"><?php echo $title ?></a></strong><br />
		<a onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list">Re-Attach</a></td>

		<?php
	} else {
		?>Unattached<br />
		<a onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list">Attach</a>
		<?php
	}
}

?>
