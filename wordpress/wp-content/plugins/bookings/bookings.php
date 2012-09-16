<?php
/*
 Plugin Name: Bookings
 Plugin URI: http://www.zingiri.com/bookings
 Description: Bookings is a powerful reservations scheduler.
 Author: Zingiri
 Version: 1.7.8
 Author URI: http://www.zingiri.com/
 */

define("BOOKINGS_VERSION","1.7.8");

// Pre-2.6 compatibility for wp-content folder location
if (!defined("WP_CONTENT_URL")) {
	define("WP_CONTENT_URL", get_option("siteurl") . "/wp-content");
}
if (!defined("WP_CONTENT_DIR")) {
	define("WP_CONTENT_DIR", ABSPATH . "wp-content");
}

if (!defined("BOOKINGS_PLUGIN")) {
	$bookings_plugin=str_replace(realpath(dirname(__FILE__).'/..'),"",dirname(__FILE__));
	$bookings_plugin=substr($bookings_plugin,1);
	define("BOOKINGS_PLUGIN", $bookings_plugin);
}

if (!defined("BLOGUPLOADDIR")) {
	$upload=wp_upload_dir();
	define("BLOGUPLOADDIR",$upload['path']);
}

if (!defined("BOOKINGS_USER_CAP")) define("BOOKINGS_USER_CAP",get_option('bookings_user_cap') ? get_option('bookings_user_cap') : 'edit_posts');
if (!defined("BOOKINGS_ADMIN_CAP")) define("BOOKINGS_ADMIN_CAP",get_option('bookings_admin_cap') ? get_option('bookings_admin_cap') : 'manage_options');

define("BOOKINGS_URL", WP_CONTENT_URL . "/plugins/".BOOKINGS_PLUGIN."/");

if (defined('BOOKINGS_LIVE')) require(dirname(__FILE__).'/live.php');

$bookingsRegions['us1']=array('North America, South America & Asia Pacific','http://bookings.zingiri.net/us1/');
$bookingsRegions['eu1']=array('Europe & Africa','http://bookings-eu.zingiri.net/eu1/');
if (file_exists(dirname(__FILE__).'/regions.php')) require(dirname(__FILE__).'/regions.php');

$bookings_version=get_option("bookings_version");
if ($bookings_version != BOOKINGS_VERSION) {
	if ($bookings_version && ($bookings_version <= '1.3.0') && !get_option('bookings_region')) update_option('bookings_region','us1');
	update_option("bookings_version",BOOKINGS_VERSION);
}

if (get_option('bookings_region') && (!defined('BOOKINGS_LIVE') || get_option('bookings_siteurl'))) {
	add_action("init","bookings_init");
	if (isset($_GET['ajax']) && ($_GET['ajax'] == 1)) {
		add_action("init","bookings_ajax");
	} else {
		add_action('wp_head','bookings_header');
	}
	add_shortcode( 'bookings', 'bookings_shortcode' );
	add_shortcode( 'bookings1', 'bookings_shortcode_pages' );
	add_shortcode( 'bookings2', 'bookings_shortcode_pages' );
	add_shortcode( 'bookings3', 'bookings_shortcode_pages' );
	add_shortcode( 'bookings4', 'bookings_shortcode_pages' );
}

add_action('admin_head','bookings_admin_header');
add_action('admin_footer','bookings_admin_footer');
add_action('admin_notices','bookings_admin_notices');

register_activation_hook(__FILE__,'bookings_activate');
register_deactivation_hook(__FILE__,'bookings_deactivate');
register_uninstall_hook(__FILE__,'bookings_uninstall');

require_once(dirname(__FILE__) . '/includes/shared.inc.php');
require_once(dirname(__FILE__) . '/includes/http.class.php');
require_once(dirname(__FILE__) . '/controlpanel.php');

function bookings_admin_notices() {
	global $bookings;
	$errors=array();
	$warnings=array();
	$files=array();
	$dirs=array();

	if (isset($bookings['output']['warnings']) && is_array($bookings['output']['warnings']) && (count($bookings['output']['warnings']) > 0)) {
		$warnings=$bookings['output']['warnings'];
	}
	if (isset($bookings['output']['errors']) && is_array($bookings['output']['errors']) && (count($bookings['output']['errors']) > 0)) {
		$errors=$bookings['output']['errors'];
	}
	$upload=wp_upload_dir();
	//if (!is_writable(session_save_path())) $errors[]='PHP sessions are not properly configured on your server, the sessions save path '.session_save_path().' is not writable.';
	if ($upload['error']) $errors[]=$upload['error'];
	if (!get_option('bookings_region')) $warnings[]="Please verify your settings on the Bookings control panel and click 'Update'";
	if (get_option('bookings_debug')) $warnings[]="Debug is active, once you finished debugging, it's recommended to turn this off";
	if (phpversion() < '5') $warnings[]="You are running PHP version ".phpversion().". We recommend you upgrade to PHP 5.3 or higher.";
	if (ini_get("zend.ze1_compatibility_mode")) $warnings[]="You are running PHP in PHP 4 compatibility mode. We recommend you turn this option off.";
	if (!function_exists('curl_init')) $errors[]="You need to have cURL installed. Contact your hosting provider to do so.";

	if (count($warnings) > 0) {
		echo "<div id='zing-warning' style='background-color:greenyellow' class='updated fade'><p><strong>";
		foreach ($warnings as $message) echo 'Bookings: '.$message.'<br />';
		echo "</strong> "."</p></div>";
	}
	if (count($errors) > 0) {
		echo "<div id='zing-warning' style='background-color:pink' class='updated fade'><p><strong>";
		foreach ($errors as $message) echo 'Bookings:'.$message.'<br />';
		echo "</strong> "."</p></div>";
	}

	return array('errors'=> $errors, 'warnings' => $warnings);
}

function bookings_activate() {
	if (!get_option('bookings_key')) update_option('bookings_key',bookings_create_api_key());
	if (!get_option('bookings_secret')) update_option('bookings_secret',bookings_create_secret());
	update_option("bookings_version",BOOKINGS_VERSION);
}

function bookings_deactivate() {
	bookings_output('deactivate');
	unset($_SESSION['bookings']);
	delete_option("bookings_ftp_user"); //legacy
	delete_option("bookings_ftp_password"); //legacy
}

function bookings_uninstall() {
	bookings_output('uninstall');

	unset($_SESSION['bookings']);

	delete_option('bookings_key');

	$bookings_options=bookings_options();

	delete_option('bookings_log');
	foreach ($bookings_options as $value) {
		delete_option( $value['id'] );
	}
	delete_option("bookings_http_referer");
	delete_option("bookings_log");
	delete_option("bookings_version");
	delete_option("bookings_region");
	delete_option('bookings-support-us');
}

function bookings_shortcode( $atts, $content=null, $code="" ) {
	global $bookings,$bookings_shortcode_id;

	if (!is_page() && !is_single()) return '';

	$bookings_shortcode_id=isset($bookings_shortcode_id) ? $bookings_shortcode_id+1 : 1;

	//support old style, comma delimited format
	$attString='';
	if (is_array($atts) && count($atts) > 0) {
		foreach ($atts as $id => $value) {
			if (!is_numeric($id) && ($value!=',')) {
				if ($attString) $attString.=',';
				$attString.=$id.'='.$value;
			}
		}
		$atts=array();
		$t1=explode(',',$attString);
		foreach ($t1 as $p1) {
			$p2=explode('=',$p1);
			$atts[$p2[0]]=$p2[1];
		}
	}

	$defaults=array('template' => '','scheduleid' => '', 'calendar' => '', 'form' => 'form1');
	extract( shortcode_atts( $defaults, $atts ) );
	$pg=isset($_REQUEST['zb']) ? $_REQUEST['zb'] : 'book1';
	if ($pg=='book1') {
		$postVars=array();
		if (is_array($atts) && count($atts) > 0) {
			foreach($atts as $id => $value) {
				$postVars[$id]=$value;
			}
		}
		bookings_output($pg,$postVars);
		$output='<div id="bookings">';
		$output.=$bookings['output']['body'];
		$output.='</div>';
		return $output;
	} else {
		bookings_output($pg);
		$output='<div id="bookings">';
		$output.=$bookings['output']['body'];
		$output.='</div>';
		return $output;
	}
}

function bookings_shortcode_pages( $atts, $content=null, $code="" ) {
	if (!is_page() && !is_single()) return '';

	$step=isset($_REQUEST['zb']) ? $_REQUEST['zb'] : 'book1';
	switch ($code) {
		case 'bookings1':
			if ($step=='book1') return $content;
			break;
		case 'bookings2':
			if ($step=='book2') return $content;
			break;
		case 'bookings3':
			if ($step=='book3') return $content;
			break;
		case 'bookings4':
			if ($step=='book4') return $content;
			break;
	}
	return '';
}

function bookings_output($bookings_to_include='',$postVars=array()) {
	global $post,$bookings;
	global $wpdb;
	global $wordpressPageName;
	global $bookings_loaded;

	$ajax=isset($_REQUEST['ajax']) ? $_REQUEST['ajax'] : false;

	$http=bookings_http($bookings_to_include);
	bookings_log('Notification','Call: '.$http);
	//echo '<br />'.$http.'<br />';
	$news = new zHttpRequest($http,'bookings');
	$news->noErrors=true;
	$news->post=array_merge($news->post,$postVars);

	if (!$news->curlInstalled()) {
		bookings_log('Error','CURL not installed');
		return "cURL not installed";
	} elseif (!$news->live()) {
		bookings_log('Error','A HTTP Error occured');
		return "A HTTP Error occured";
	} else {
		if (($ajax==1) && ($_REQUEST['form']!='form_field')) {
			while (count(ob_get_status(true)) > 0) ob_end_clean();
			$buffer=$news->DownloadToString();
			$bookings['output']=json_decode($buffer,true);
			if (!$bookings['output']) {
				$bookings['output']['body']=$buffer;
				$bookings['output']['head']='';
			}
			if (isset($_REQUEST['scr'])) {
				echo $bookings['output']['body'];
			} else {
				echo '<html><head>';
				echo $bookings['output']['head'];
				echo '</head><body>';
				echo $bookings['output']['body'];
				echo '</body></html>';
			}
			die();
		} elseif (($ajax==1) && ($_REQUEST['form']=='form_field')) {
			while (count(ob_get_status(true)) > 0) ob_end_clean();
			$buffer=$news->DownloadToString();
			$output=json_decode($buffer,true);
			echo $output['body'];
			die();
		} elseif (($ajax==2) || (($ajax==1) && ($_REQUEST['form']=='form_field'))) {
			while (count(ob_get_status(true)) > 0) ob_end_clean();
			$output=$news->DownloadToString();
			foreach (array('content-disposition','content-type') as $i) {
				if (isset($news->headers[$i])) header($i.':'.$news->headers[$i]);
			}
			echo $news->body;
			die();
		} elseif ($ajax==3) {
			while (count(ob_get_status(true)) > 0) ob_end_clean();
			$buffer=$news->DownloadToString();
			$output=json_decode($buffer,true);
			echo $output['body'];
			die();
		} else {
			$buffer=$news->DownloadToString();
			if ($news->error) {
				$bookings['output']=array();
				if (is_admin()) $bookings['output']['body']='An error occured when connecting to the Bookings service.<br />If you need help with this, please contact our <a href="http://go.zingiri.com" target="_blank">technical support service</a>.';
				else $bookings['output']['body']='The service is currently not available, please try again later.';
				return false;
			}
			$bookings['output']=json_decode($buffer,true);
			if (isset($bookings['output']['reload']) && $bookings['output']['reload']) {
				$buffer=$news->DownloadToString();
				$bookings['output']=json_decode($buffer,true);
			}
			if (!$bookings['output']) {
				$bookings['output']['body']=$buffer;
				$bookings['output']['head']='';
			} else {
				if (isset($bookings['output']['http_referer'])) update_option('bookings_http_referer',$bookings['output']['http_referer']);
				else update_option('bookings_http_referer','');
			}

			$bookings['output']['body']=bookings_parser($bookings['output']['body']);
		}
	}
}

function bookings_parser($buffer) {
	global $wp_version;
	if (is_admin() && ($wp_version >= '3.3')) {
		if (!class_exists('simple_html_dom')) require(dirname(__FILE__).'/includes/simple_html_dom.php');
		$html = new simple_html_dom();
		$html->load($buffer);
		if ($textareas=$html->find('textarea[class=theEditor]')) {
			foreach ($textareas as $textarea) {
				ob_start();
				wp_editor($textarea->innertext,$textarea->id);
				$editor=ob_get_clean();
				$textarea->outertext=$editor;
			}
		}
		return $html->__toString();
	}
	return $buffer;

	return $buffer;
}

function bookings_replace($match) {
	$id=$match[1];
	$content=$match[2];
	ob_start();
	wp_editor($content,$id);
	return ob_get_clean();
}

function bookings_header() {
	global $bookings;

	echo '<script type="text/javascript">';
	echo "var bookingsPageurl='".bookings_home()."';";
	echo "var bookingsAjaxUrl='".bookings_home()."';";
	echo '</script>';
	echo '<script type="text/javascript" src="' . BOOKINGS_URL . 'js/functions.js"></script>';
	echo '<script type="text/javascript" src="' . BOOKINGS_URL . 'js/ajax.js"></script>';
	echo '<script type="text/javascript" src="' . BOOKINGS_URL . 'js/jquery.getUrlParam.js"></script>';
	$pg=isset($_REQUEST['zb']) ? $_REQUEST['zb'] : 'book1';
	if (in_array($pg,array('myschedule'))) {
		echo '<link rel="stylesheet" type="text/css" href="' . BOOKINGS_URL . 'css/css-client.css" media="screen" />';
	}
	echo '<link rel="stylesheet" type="text/css" href="' . BOOKINGS_URL . 'css/client.css" media="screen" />';
	echo '<link rel="stylesheet" type="text/css" href="' . BOOKINGS_URL . 'css/colors.css" media="screen" />';
	echo '<link rel="stylesheet" type="text/css" href="' . BOOKINGS_URL . 'css/integrated_view.css" media="screen" />';

}

function bookings_admin_header() {
	global $bookings,$wp_version;
	if (isset($_REQUEST['page']) && ($_REQUEST['page']=='bookings'))  {
		if (isset($bookings['output']['head'])) echo $bookings['output']['head'];
		echo '<script type="text/javascript">';
		echo "var bookingsPageurl='admin.php?page=bookings&';";
		echo "var bookingsAjaxUrl='".get_admin_url()."admin.php?page=bookings&';";
		echo "var aphpsAjaxURL='".get_admin_url().'admin.php?page=bookings&zb=ajax&ajax=1&form='."';";
		echo "var aphpsURL='".bookings_url(false).'aphps/fwkfor/'."';";
		echo "var wsCms='gn';";
		echo '</script>';
		echo '<link rel="stylesheet" type="text/css" href="' . BOOKINGS_URL . 'css/admin.css" media="screen" />';
		echo '<link rel="stylesheet" type="text/css" href="' . BOOKINGS_URL . 'css/colors.css" media="screen" />';
		echo '<link rel="stylesheet" type="text/css" href="' . BOOKINGS_URL . 'css/integrated_view.css" media="screen" />';
		if ($wp_version < '3.3') wp_tiny_mce( false, array( 'editor_selector' => 'theEditor' ) );
	}
}

function bookings_http($page="index") {
	global $current_user,$post,$bookings_shortcode_id;

	$vars="";
	$http=bookings_url().'?pg='.$page;
	$and="&";
	if (count($_GET) > 0) {
		foreach ($_GET as $n => $v) {
			if (!in_array($n,array('page','zb')))
			{
				if (is_array($v)) {
					foreach ($v as $w) {
						$vars.= $and.$n.'[]='.urlencode($w);
						$and="&";
					}
				} else {
					$vars.= $and.$n.'='.urlencode($v);
					$and="&";
				}
			}
		}
	}

	$and="&";

	$wp=array();
	if (is_user_logged_in()) {
		$wp['login']=$current_user->data->user_login;
		$wp['email']=$current_user->data->user_email;
		$wp['first_name']=get_user_meta($current_user->data->ID,'first_name',true) ? get_user_meta($current_user->data->ID,'first_name',true) : $current_user->data->display_name;
		$wp['last_name']=get_user_meta($current_user->data->ID,'last_name',true) ? get_user_meta($current_user->data->ID,'last_name',true) : $current_user->data->display_name;
		$wp['roles']=$current_user->roles;
	}
	$wp['lic']=get_option('bookings_lic');
	$wp['gmt_offset']=get_option('gmt_offset');
	$wp['siteurl']=get_option('bookings_siteurl') ? get_option('bookings_siteurl') : home_url();
	$wp['sitename']=get_bloginfo('name');
	$wp['pluginurl']=BOOKINGS_URL;
	if (is_admin()) {
		$wp['mode']='b';
		$wp['pageurl']=get_admin_url().'admin.php?page=bookings&';
		$wp['secret']=get_option('bookings_secret');
	} else {
		$wp['mode']='f';
		$wp['pageurl']=bookings_home();
		if (isset($post) && isset($bookings_shortcode_id)) $wp['sid']=$post->ID.'-'.$bookings_shortcode_id;
	}

	if (get_option('bookings_showcase')) {
		$wp['desc']=get_bloginfo('description');
		$wp['showcase']=1;
	}
	$wp['time_format']=get_option('time_format');
	$wp['admin_email']=get_option('admin_email');
	$wp['key']=get_option('bookings_key');
	$wp['lang']=get_option('bookings_lang') ? get_option('bookings_lang') : 'en_US'; //get_bloginfo('language');
	$wp['client_version']=BOOKINGS_VERSION;
	if (current_user_can(BOOKINGS_ADMIN_CAP)) $wp['cap']='admin';
	elseif (current_user_can(BOOKINGS_USER_CAP)) $wp['cap']='operator';

	$vars.=$and.'wp='.urlencode(base64_encode(json_encode($wp)));

	if (get_option('bookings_http_referer')) $vars.='&http_referer='.urlencode(get_option('bookings_http_referer'));

	if ($vars) $http.=$vars;

	return $http;
}

function bookings_home() {
	global $post,$page_id;

	$pageID = $page_id;

	if (get_option('permalink_structure')){
		$homePage = get_option('home');
		$wordpressPageName = get_permalink($pageID);
		$wordpressPageName = str_replace($homePage,"",$wordpressPageName);
		$home=$homePage.$wordpressPageName;
		if (substr($home,-1) != '/') $home.='/';
		$home.='?';
	}else{
		$home=get_option('home').'/?page_id='.$pageID.'&';
	}

	return $home;
}

function bookings_ajax() {
	global $bookings;
	return;
	//	print_r($bookings);
	die('Problem loading - contact support');
	die();
	echo '<head>'.$bookings['output']['head'].'</head>';
	echo '<body>'.$bookings['output']['body'].'</body>';
	die();
}

function bookings_init() {
	global $wp_version;

	ob_start();
	session_start();
	if (is_admin()) {
		if (isset($_GET['page']) && $_GET['page']=='bookings' && !current_user_can(BOOKINGS_ADMIN_CAP) && !isset($_GET['zb'])) {
			$_GET['zb']='schedule';
		}
		if ((isset($_GET['zb']) || !isset($_SESSION['bookings']['menus']))) {
			$pg=isset($_GET['zb']) ? $_GET['zb'] : 'usage';
			bookings_output($pg);
		}
		if (isset($_REQUEST['page']) && ($_REQUEST['page']=='bookings'))  {
			if ($wp_version < '3.3') {
				wp_enqueue_script(array('editor', 'thickbox', 'media-upload'));
				wp_enqueue_style('thickbox');
			}
		}
	}
	wp_enqueue_script('jquery');
	if (!is_admin() && isset($_REQUEST['zb'])) {
		wp_enqueue_script(array('jquery-ui-core','jquery-ui-dialog','jquery-ui-datepicker'));
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/flick/jquery-ui.css');
	} elseif (is_admin() && isset($_REQUEST['page']) && ($_REQUEST['page']=='bookings')) {
		wp_enqueue_script(array('jquery-ui-core','jquery-ui-dialog','jquery-ui-datepicker','jquery-ui-sortable','jquery-ui-tabs'));
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/flick/jquery-ui.css');
	}

}

function bookings_log($type=0,$msg='',$filename="",$linenum=0) {
	if (get_option('bookings_debug')) {
		if (is_array($msg)) $msg=print_r($msg,true);
		$v=get_option('bookings_log');
		if (!is_array($v)) $v=array();
		array_unshift($v,array(time(),$type,$msg));
		update_option('bookings_log',$v);
	}
}

function bookings_url($endpoint=true) { //URL end point for web services stored on Zingiri servers
	global $bookingsRegions;
	$r=get_option('bookings_region');
	if (isset($bookingsRegions[$r])) $url=$bookingsRegions[$r][1];
	else $url='http://bookings.zingiri.net/us1/';
	if ($endpoint) $url.='api.php';
	return $url;
}


function bookings_admin_footer() {
	global $bookings;
	if (isset($bookings['output']['footer'])) echo $bookings['output']['footer'];
}

