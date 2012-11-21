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


add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
	add_theme_page('Change Color', 'Colors', 'manage_options', 'plugin', 'color_options');
}

function color_options() {
?>
	<div>
	<h2>Change Colors</h2>
	Options relating to changing colors.
	</div>	
	<?php 
}

/*
// JEM TESTING STUFF
if (!class_exists("ChangeColors")) {
	class ChangeColors {
		var $adminOptionsName = "ChangeColorsAdminOptions";
		function ChangeColors() { //constructor
			
		}
		function init() {
			$this->getAdminOptions();
		}
		//Returns an array of admin options
		function getAdminOptions() {
			$changeColorsAdminOptions = array('show_header' => 'true',
				'add_content' => 'true', 
				'comment_author' => 'true', 
				'content' => '');
			$devOptions = get_option($this->adminOptionsName);
			if (!empty($devOptions)) {
				foreach ($devOptions as $key => $option)
					$changeColorsAdminOptions[$key] = $option;
			}				
			update_option($this->adminOptionsName, $changeColorsAdminOptions);
			return $changeColorsAdminOptions;
		}
		
		function addHeaderCode() {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['show_header'] == "false") { return; }
			?>
<!-- ChangeColors Was Here -->
			<?php
		
		}
		function addContent($content = '') {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['add_content'] == "true") {
				$content .= $devOptions['content'];
			}
			return $content;
		}
		function authorUpperCase($author = '') {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['comment_author'] == "true") {
				$author = strtoupper($author);
			}
			return $author;
		}
		//Prints out the admin page
		function printAdminPage() {
					$devOptions = $this->getAdminOptions();
										
					if (isset($_POST['update_ChangeColorsSettings'])) { 
						if (isset($_POST['devloungeHeader'])) {
							$devOptions['show_header'] = $_POST['devloungeHeader'];
						}	
						if (isset($_POST['devloungeAddContent'])) {
							$devOptions['add_content'] = $_POST['devloungeAddContent'];
						}	
						if (isset($_POST['devloungeAuthor'])) {
							$devOptions['comment_author'] = $_POST['devloungeAuthor'];
						}	
						if (isset($_POST['devloungeContent'])) {
							$devOptions['content'] = apply_filters('content_save_pre', $_POST['devloungeContent']);
						}
						update_option($this->adminOptionsName, $devOptions);
						
						?>
<div class="updated"><p><strong><?php _e("Settings Updated.", "ChangeColors");?></strong></p></div>
					<?php
					} ?>
<div class=wrap>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h2>Change Colors</h2>
<h3>Content to Add to the End of a Post</h3>
<textarea name="devloungeContent" style="width: 80%; height: 100px;"><?php _e(apply_filters('format_to_edit',$devOptions['content']), 'ChangeColors') ?></textarea>
<h3>Allow Comment Code in the Header?</h3>
<p>Selecting "No" will disable the comment code inserted in the header.</p>
<p><label for="devloungeHeader_yes"><input type="radio" id="devloungeHeader_yes" name="devloungeHeader" value="true" <?php if ($devOptions['show_header'] == "true") { _e('checked="checked"', "ChangeColors"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="devloungeHeader_no"><input type="radio" id="devloungeHeader_no" name="devloungeHeader" value="false" <?php if ($devOptions['show_header'] == "false") { _e('checked="checked"', "ChangeColors"); }?>/> No</label></p>

<h3>Allow Content Added to the End of a Post?</h3>
<p>Selecting "No" will disable the content from being added into the end of a post.</p>
<p><label for="devloungeAddContent_yes"><input type="radio" id="devloungeAddContent_yes" name="devloungeAddContent" value="true" <?php if ($devOptions['add_content'] == "true") { _e('checked="checked"', "ChangeColors"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="devloungeAddContent_no"><input type="radio" id="devloungeAddContent_no" name="devloungeAddContent" value="false" <?php if ($devOptions['add_content'] == "false") { _e('checked="checked"', "ChangeColors"); }?>/> No</label></p>

<h3>Allow Comment Authors to be Uppercase?</h3>
<p>Selecting "No" will leave the comment authors alone.</p>
<p><label for="devloungeAuthor_yes"><input type="radio" id="devloungeAuthor_yes" name="devloungeAuthor" value="true" <?php if ($devOptions['comment_author'] == "true") { _e('checked="checked"', "ChangeColors"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="devloungeAuthor_no"><input type="radio" id="devloungeAuthor_no" name="devloungeAuthor" value="false" <?php if ($devOptions['comment_author'] == "false") { _e('checked="checked"', "ChangeColors"); }?>/> No</label></p>

<div class="submit">
<input type="submit" name="update_ChangeColorsSettings" value="<?php _e('Update Settings', 'ChangeColors') ?>" /></div>
</form>
 </div>
					<?php
				}//End function printAdminPage()
	
	}

} //End Class ChangeColors

if (class_exists("ChangeColors")) {
	$dl_pluginSeries = new ChangeColors();
}

//Initialize the admin panel
if (!function_exists("ChangeColors_ap")) {
	function ChangeColors_ap() {
		global $dl_pluginSeries;
		if (!isset($dl_pluginSeries)) {
			return;
		}
		if (function_exists('add_theme_page')) {
	add_theme_page('Change Colors', 'Change Colors', 9, basename(__FILE__), array(&$dl_pluginSeries, 'printAdminPage'));
		}
	}	
}

//Actions and Filters	
if (isset($dl_pluginSeries)) {
	//Actions
	add_action('admin_menu', 'ChangeColors_ap');
	add_action('wp_head', array(&$dl_pluginSeries, 'addHeaderCode'), 1);
	add_action('activate_devlounge-plugin-series/devlounge-plugin-series.php',  array(&$dl_pluginSeries, 'init'));
	//Filters
	add_filter('the_content', array(&$dl_pluginSeries, 'addContent'),1); 
	add_filter('get_comment_author', array(&$dl_pluginSeries, 'authorUpperCase'));
}
*/

?>
