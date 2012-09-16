<?php
session_start();
/*
Plugin Name: mp-booking
Plugin URI: http://www.mathieu-piot.net/MP_Booking
Description: mp-booking is a wordpress pluggin which provide a simple button that open a simple form to complete hostel room reservations.It permit to have multiple rooms descriptions on one page and for each simply add a booking button that open a form with jqueryui functionalities such as calendar modal form?The booking process end by a captcha verification and send a mail confirmation to the user (the client) and to the admin?s mail (you).
Version: 1.0.1
Author: Mathieu Piot
Author URI: http://www.mathieu-piot.net/wordpress/mp-booking/
License: GPL v2
 
This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA 
*/

$mpb_force_sender=false;

//captcha lib
//require_once('php/kcaptcha/kcaptcha.php');
//add js scripting
add_action('wp_print_scripts', 'mp_booking_AddScripts');
//add css
add_action('wp_print_styles', 'mp_booking_AddStyle');
//hook pages or post with shortcode
add_shortcode('mp_booking', 'mp_booking_ShortCode');
//right place ?? [need review] include form once
add_action('wp_footer', 'mp_booking_add_form');
//add ajax script for callback
add_action('wp_ajax_mp_booking', 'mp_booking_callback');//logged and private
add_action('wp_ajax_nopriv_mp_booking', 'mp_booking_callback');//non logged
//add js var url for ajax query
add_action('wp_head','mp_booking_ajaxurl');



/**
 * add script
 */
function  mp_booking_AddScripts()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-dialog');
	//enqueue jq ui date picker for form
	wp_enqueue_script('jquery-ui-datepicker', plugins_url('/js/jquery-ui-datepicker.js', __FILE__), array('jquery','jquery-ui-core') );
	//enqueue jsfunction for mp-booking form (plugin)
	wp_enqueue_script('mp-booking', plugins_url('/js/mp-booking.js', __FILE__), array('jquery','jquery-ui-core','jquery-ui-datepicker') );
}



/**
 * Add style
 */
function mp_booking_AddStyle(){
	wp_enqueue_style('jquery-ui-dialog');
	//add jquery ui style (you can change theme here)
	wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/ui-lightness/jquery-ui.css'); 
	wp_enqueue_style('mp-booking', plugins_url('/css/mp-booking.css', __FILE__));
}


/**
 * Add js var url for ajax query
 */
function mp_booking_ajaxurl() {
	$ajaxUrl='<script type="text/javascript">';
	$ajaxUrl.=' var ajaxurl = "'.admin_url('admin-ajax.php').'"';
	$ajaxUrl.='</script>';
	echo $ajaxUrl;
}

/**
 * Booking form callback
 */
function mp_booking_callback() {
	$answer=array();
	//no captcha
	if(isset($_SESSION["mp_booking_no_kaptcha"]) && $_SESSION["mp_booking_no_kaptcha"]){
    			mp_booking_mail_content($_POST["bookcontent"],$_POST["mp_booking_object"],$_POST["first_name"]." ".$_POST["name"],$_POST["email"],$_POST['mp_from'],$_POST['mp_send_to']);
    			$answer["captcha"]="ok";
    			echo json_encode($answer);
    			die();
	}
	
	//verify  captcha
	if(count($_POST)>0){
		if((isset($_SESSION['captcha_keystring']) && strtolower($_SESSION['captcha_keystring']) === strtolower($_POST['captcha']))){
			$answer["captcha"]="ok";
			mp_booking_mail_content($_POST["bookcontent"],$_POST["mp_booking_object"],$_POST["first_name"]." ".$_POST["name"],$_POST["email"],$_POST['mp_from'],$_POST['mp_send_to']);     
		}else{
			$answer["captcha"]="ko";
			$answer["debug"]=$_POST["captcha"]." != ".$_SESSION['captcha_keystring'];
		}
	}
	//new captcha
	session_regenerate_id();//for generate an other captcha
	unset($_SESSION['captcha_keystring']);
	$answer["captcha_img_src"]=plugins_url()."/mp-booking/php/kcaptcha/?".session_name()."=".session_id();
	echo json_encode($answer);
	die(); // this is required to return a proper result
}



function mp_booking_display_form(){
	$mpform="
	<div id='mpi_booking_container'/>
	<form id='booking-form' action=''>
	<div class='error_form'></div>
	<div id='step1'>
	<fieldset>
		<input name='mp_from' id='mp_from' type='hidden' value=''>
		<input name='mp_send_to' id='mp_send_to' type='hidden' value=''>
		<label for='mp_booking_object' style='display:none' >Room type</label>
		<input name='mp_booking_object' id='mp_booking_object' type='hidden' value=''>
		<label for='first_name'>First Name</label>
		<input type='text' name='first_name' id='first_name' class='text ui-widget-content ui-corner-all' />
		<label for='name'>Name</label>
		<input type='text' name='name' id='name' class='text ui-widget-content ui-corner-all' />
		<label for='email'>Email</label>
		<input type='text' name='email' id='email' value='' class='text ui-widget-content ui-corner-all' />
		<label for='country'>Country</label>
		<select name='country' id='country' class='text ui-widget-content ui-corner-all'><option value=''></option></select>
		<label for='date_checkin'>Date checkin</label>
		<input type='text' name='date_checkin' id='mpb_date_checkin' class='date ui-widget-content ui-corner-all'>
		<label for='date_chekout'>Date checkout</label>
		<input type='text' name='date_chekout' id='mpb_date_chekout' class='date ui-widget-content ui-corner-all'>
		<label for='guest'>Number of guest</label>
		<select name='guest' id='guest' class='number ui-widget-content ui-corner-all'></select>
		<label for='reservation_arrival_time'>Arrival time</label>
		<select name='reservation_arrival_time' id='reservation_arrival_time' class='text ui-widget-content ui-corner-all' value='10:00 AM'>
			<option value=''></option>
			<option value='06:00 AM'>06:00 AM</option>
			<option value='07:00 AM'>07:00 AM</option>
			<option value='08:00 AM'>08:00 AM</option>
			<option value='09:00 AM'>09:00 AM</option>
			<option value='10:00 AM'>10:00 AM</option>
			<option value='11:00 AM'>11:00 AM</option>
			<option value='12:00 PM'>12:00 PM</option>
			<option value='01:00 PM'>01:00 PM</option>
			<option value='02:00 PM'>02:00 PM</option>
			<option value='03:00 PM'>03:00 PM</option>
			<option value='04:00 PM'>04:00 PM</option>
			<option value='05:00 PM'>05:00 PM</option>
			<option value='06:00 PM'>06:00 PM</option>
			<option value='07:00 PM'>07:00 PM</option>
			<option value='08:00 PM'>08:00 PM</option>
			<option value='09:00 PM'>09:00 PM</option>
			<option value='10:00 PM'>10:00 PM</option>
			<option value='11:00 PM'>11:00 PM</option>
			<option value='00:00 AM'>00:00 AM</option>
			<option value='01:00 AM'>01:00 AM</option>
			<option value='02:00 AM'>02:00 AM</option>
		</select>
		<label for='guest_comments'>Comments</label>
		<textarea  name='guest_comments' cols='50' id='reservation_guest_comments' rows='2'></textarea>
	</fieldset>
	</div>
	<div id='step2'>
			<h2 class='mp_h2'>Please verify your information</h2>
			<div id='mpb_information'></div></p>
	</div>
	";
	if(!isset($_SESSION["mp_booking_no_kaptcha"]) || !$_SESSION["mp_booking_no_kaptcha"]){
	$mpform.="<div id='step3'>
			<h2 class='mp_h2'>You must complete the captcha to finish your booking :</h2>
			<p><img id=mp_booking_captcha src='".plugins_url()."/mp-booking2/php/kcaptcha/?".session_name()."=".session_id()."'/></p>
			<label for='captcha'>Captcha</label>
			<p><input type='text' name='captcha' id='captcha'></p>
	</div>";
	}
	$mpform.="
	<div id='step4'>
			<h2 class='mp_h2'>Your booking is complete</h2>
			<p>A detail copy has been sent to your email and also to our staff.</p>
	</div>
	</form>
	</div>";
	return $mpform;
}


/**
 * Add book form
 */
function mp_booking_add_form() {
	$content = "<div id='dialog-form' title='Book now'>".mp_booking_display_form()."</div>";
	echo $content;
}

/**
 * Add button when replace short code
 */
function mp_booking_ShortCode($atts){
	//Extract shortcode attribute
	extract(shortcode_atts(array(
				'object' => '',
				'nummax' => '5',
				'label'=>'Book now',
				'from'=>'',
				'send_to'=>'',
				'captcha'=>''
	 ), $atts));
	
	$key=get_option('admin_email');
	$butt= "<button id='mpb_book_button_".$object."' object='".$object."' nummax='".$nummax."'";
	//if email are set to option add key for crypt email in the button parameter to prevent spam, (key is just admin email string)
	if($from!=''){
		$from_encrypted=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $from, MCRYPT_MODE_CBC, md5(md5($key))));
		$butt.=" from='".$from_encrypted."'";
	}
	if($send_to!=''){
		$sendto_encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $send_to, MCRYPT_MODE_CBC, md5(md5($key))));
		$butt.=" sendTo='".$sendto_encrypted."'";
	}
	if(strtolower($captcha) === "no"){
    $_SESSION["mp_booking_no_kaptcha"]=true;
    $butt.=" captcha='no'";
  }
  
	$butt.=">$label</button>";
	return $butt;
}




function mp_booking_mail_content($bookcontent, $ressource, $name, $mailuser,$from="",$mail_to=""){
	$key=get_option('admin_email');
	
	//get the current site (cause a site could have multiple domaine)
	$domain=str_replace('www.', '', $_SERVER['SERVER_NAME']); 
	
	//default
	$fromName="noreply";
	$fromMail="noreply@".$domain;
	
	$from=($from!="")?rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($from), MCRYPT_MODE_CBC, md5(md5($key))), "\0"):"";
	$mail_to=($mail_to!="")?rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($mail_to), MCRYPT_MODE_CBC, md5(md5($key))), "\0"):"";
	
	//if user specify from
	//from string is specify as : name <foo@mailprovider.com>
	//if user sepecify just name (recommanded) mail send will be like : name <name@yourdomain.com> 
	//a mail provider could consider your mail as spam if the sender (your domain) is diferent than @mail
	$matches=array();
	$matches=preg_split("#<(.*)>#",$from,-1, PREG_SPLIT_DELIM_CAPTURE|PREG_SPLIT_NO_EMPTY);
	
	if(count($matches)>0){//if $from is emty matches count = 0
		$fromName=$matches[0];//catch "name"
		$fromMail=$matches[0]."@".$domain;
	}
	if(count($matches)>1){
		$fromMail=$matches[1];//catch "foo@mailprovider.com"
	}
	
	//for the reply to line
	$replyTo=get_option('admin_email');
	if($mail_to!=""){
		$mail_to=explode(",", $mail_to);
		$replyTo=$mail_to[0];
	}
	else{
    $mail_to=get_option('admin_email');
	}
	
	//add filter wp_mail to specify mail content as html
	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
	//add filter wp_mail to specify sender name
	add_filter('wp_mail_from_name',create_function('$name', 'return "'.$fromName.'"; '));
	//add filter wp_mail to specify sender email
	add_filter('wp_mail_from',create_function('$email', 'return "'.$fromMail.'"; '));
	$object = "Pending request booking for ".$ressource;
	$user_message="Dear $name,<br>Thank you for you enquiry.<br>Your booking had been sent to our staff. We are checking your room availability.<br> You will receive a confirmation mail as soon as possible.<br><br>Here your detail : <br>".$bookcontent;
	$user_message.="<br>Please reply to : ".$replyTo;
	$admin_message="A client would like to book a ".$ressource."<br>You can see his request detail here : <br>".$bookcontent;
	$mail = wp_mail($mailuser, $object, $user_message);
	$mail = wp_mail($mail_to, $object, $admin_message);
}
?>