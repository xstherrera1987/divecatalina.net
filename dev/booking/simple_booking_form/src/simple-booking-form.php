<?php
/*
Plugin Name: Simple Booking Form
Plugin URI: http://www.romeluv.com/simple-booking-form/
Description: Just insert the [BOOKINGFORM] shorttag in posts or pages of your WordPress site to display a beautiful booking form.  The submitted form data will be immediately sent via email both to the site administrator and to the user that submitted the form.
Version: 1.0.1
Author: RomeLuv
Author URI: http://www.romeluv.com
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







 
add_action('wp_head', 'add_js_calendar_for_booking_form');



function add_js_calendar_for_booking_form()
{

echo'<script language="JavaScript" src="'.WP_PLUGIN_URL.'/simple-booking-form-wordpress-plugin/date-picker/js/datepicker.js"></script>
	<link rel="stylesheet" href="'.WP_PLUGIN_URL.'/simple-booking-form-wordpress-plugin/date-picker/css/datepicker.css">';
	//Thanks to Frequency Decoder for the Date Picker Script. http://www.frequency-decoder.com
}	
	
 
























function CleanStringRomeLuvBookingForm($content)
{return wp_kses($content,'');}


function sbf_rl_widget() {
   echo romeluv_booking_form('');
}

register_sidebar_widget("Simple Booking Form", "sbf_rl_widget");

add_shortcode('BOOKINGFORM', 'romeluv_booking_form');


 



function romeluv_booking_form($atts)
{
  
  
  
  
  
  
  
  
  
  
  
$out.='<a name="simple-wp-booking-enquiry-form"></a>';
  
  
  

global $_POST;
global $post;
$FormErrors=FALSE;





 





///VALIDAZIONE FORM, se c'è
if ($_POST['submit-enquiry'])

{ //validazione caso submit step 2
	 $number_of_guests=CleanStringRomeLuvBookingForm($_POST['number_of_guests']); 
  
$contactemail=CleanStringRomeLuvBookingForm($_POST['contactemail']);
$contactname=CleanStringRomeLuvBookingForm($_POST['contactname']);
$telephone=CleanStringRomeLuvBookingForm($_POST['telephone']);
$notes=CleanStringRomeLuvBookingForm($_POST['notes']);
$random_value= CleanStringRomeLuvBookingForm($_POST['random_value']);
$controlusercheck= $_POST[controlusercheck];
$arrivaldate=CleanStringRomeLuvBookingForm($_POST[arrivaldate]);
$departuredate =CleanStringRomeLuvBookingForm($_POST[departuredate]);
	$number_of_guests=CleanStringRomeLuvBookingForm($_POST['number_of_guests']);	 


//add sicurezza



//valido errori
if ($contactname=="") $FormErrors.="<h2 class='enquiry-form-error-message'>Please fill in the <b>Name</b> field.</h2> ";

if ( !is_email($contactemail)) $FormErrors.="<h2 class='enquiry-form-error-message'>Please fill in the <b>Email</b> field with a proper email. </h2>";

 

if (($number_of_guests=='')  )  $FormErrors.="<h2 class='enquiry-form-error-message'>Please enter the number of guests.</h2> ";


if (($telephone=='')  )  $FormErrors.="<h2 class='enquiry-form-error-message'>Please enter your phone number.</h2> ";

if (($arrivaldate=='')  )  $FormErrors.="<h2 class='enquiry-form-error-message'>Please enter your  arrival date.</h2> ";

if (($departuredate=='')  )  $FormErrors.="<h2 class='enquiry-form-error-message'>Please enter your departure date.</h2> ";

if (($controlusercheck!=$random_value+2)  )  $FormErrors.="<h2 class='enquiry-form-error-message'>Please answer correctly to the Anti-Spam question.</h2> ";



	}







/////MODULO: STEP 1
if (!$_POST OR ($FormErrors&& $_POST['submit-enquiry'] ) )


{
	
$random_value=rand(0,10);	
$out.='


<!--start of enquiry form--><div class="simple-wp-booking-enquiry-form">
 <h2>Send an enquiry</h2>
 <small style="color: red;">(ALL fields required)</small>
 <form action="'. get_permalink().'?bform=1#simple-wp-booking-enquiry-form" method="post" id="enqform" name="enqform"><input name="pid" id="pid" value="'. $post->id.'" type="hidden" />
<table width="100%" border="0" >
<tbody> <tr>
<td    width="25%" >Your dates  </td>
<td  width="75%" >
 
 
 <label for="sd">Check-In Date:  <small>(DAY/MONTH/YEAR)</small></label>
  <p><input type="text" size="10" class="w8em format-d-m-y highlight-days-67 range-low-today" name="arrivaldate" id="arrivaldate" value="'.$arrivaldate.'" maxlength="10" /></p>

  <label for="ed">Check-out Date:  <small>(DAY/MONTH/YEAR)</small></label>

  <p class="lastup"><input size="10" type="text" class="w8em format-d-m-y highlight-days-67 range-low-today" name="departuredate" id="departuredate" value="'.$departuredate.'" maxlength="10" /></p>
  
  
  </td>

</tr>
 





<tr>
<td  width="25%" >No Guests  </td>
<td    width="75%" >
<select name="number_of_guests" class="csnum">

<option value="'.$number_of_guests.'" selected="selected">';

if (isset($number_of_guests)) $out.=$number_of_guests; else $out.='Choose...';

$out.='</option>

';


for ($cit=1;$cit<12;$cit++) {
$out.='<option value="'.$cit.'"  >'.$cit.'</option>';
 }
 
$out.='
</select></td>

</tr>

 
 
  
 
<tr>
<td width="40%" nowrap>Full name</td>
<td     width="60%">
<input name="contactname"   class="secondary-bfe-inputs" value="'.$contactname.'" class="cstext" type="text"></td>
</tr>
<tr>
 <td><span class="csrequired">Email</span>  </td>

<td >
<input name="contactemail"   class="secondary-bfe-inputs" value="'.$contactemail.'" class="cstext" type="text"></td>
</tr>

<tr>
 <td>Mobile #  </td>
 <td>

 
<input name="telephone"   class="secondary-bfe-inputs" value="'.$telephone.'" class="cstext" type="text"></td>
</tr>


<tr>
 <td>  2+'.$random_value.' =    </td>
 <td>

 
<input name="controlusercheck"   class="secondary-bfe-inputs" value="" size="2" class="cstext" type="text"> <small>(Anti-spam question)</small></td>
</tr>


<tr>
<td style="vertical-align:top">Notes (Optional) 
 
</td>
 <td>
<textarea name="notes"  class="secondary-bfe-inputs"  rows="1" cols="20">'.$notes.'</textarea></td>
</tr> 
<tr>
 
<td colspan="2" >';

$out.= '<div class="simple-booking-form-errors">'.$FormErrors."</div>";

$out.='<input type="hidden" name="random_value" value='.$random_value.'>
<input name="submit-enquiry" value="Send your enquiry!" type="submit" />
</td>
</tr>
</tbody></table>
 
</form>
</div>

<div style="font-size:11px; color:#ccc;text-align:right;width:99%;height:10px"> Booking Form By <a style="color:#ccc;" href="http://www.romeluv.com/simple-booking-form/">RomeLuv</a> </div>

<div style="clear: both;"></div>  
<!--end of enquiry form--> 
';

}



 



 

global $_POST;
////STEP 2: CONFERMA e manda mail
if ($_POST['submit-enquiry']&& !$FormErrors) 
{  $out.='<div class="simple-wp-booking-enquiry-form">

 
 

<h2 class="success-enquiry">Dear '. $contactname.',
Thank you for you enquiry.

 

 <br /><br /> We  will get back to you as soon as possible.<br /><br />
			
		 


</h2>
Your enquiry:

<table width="100%" border="0" cellpaddding="1">
<tbody> 



<tr>
<td    width="25%" align="right" colspan=2> <i>'.get_the_title($post->ID).' - <small>Accommodation ID: '.$post->ID.'</small></i>
</td>
</tr>


<tr>
<td    width="25%" >Arrival date:  </td>
<td  width="75%" >
'.$arrivaldate.'  


&nbsp;&nbsp;&nbsp;
 <small>(DAY/MONTH/YEAR)</small></td>
</tr>



<tr>
<td    width="25%" nowrap >Departure date:  </td>
<td  width="75%" >
'.$departuredate.'  &nbsp;&nbsp;&nbsp; <small>(DAY/MONTH/YEAR)</small></td>
</tr>


 


<tr>
<td    width="25%" >No Guests:</td>
<td  width="75%" >
'.$number_of_guests .'  </td>
</tr>

 

 




<tr>
<td    width="25%" >Name:</td>
<td  width="75%" >
'.$_POST['contactname'].'</td>
</tr>
<tr>
<td    width="25%" ><span class="csrequired">Email:</span></td>

<td  width="75%" >
'.$_POST['contactemail'].'</td>
</tr>

<tr>
<td    width="25%" >Mobile Number: </td>
<td  width="75%" >
'  .$_POST['telephone'].'</td>
</tr>
<tr>
<td    width="25%" >Notes:</td>
<td  width="75%" >
'.$_POST['notes'].'</td>
</tr> 
 
</tbody></table>
';



$email_html = $out;
  
 
 
$post_name=get_the_title($post->ID);

$permalink = get_permalink($post->ID);
$permalink=substr($permalink,7); //levo Http://

$now=date("Y-m-d H:i:s",time()); //data e ora attuale
 
global $_SERVER;
$ipaddress=$_SERVER['REMOTE_ADDR'];
 
 



//send email
 
 
$oggetto .= "Booking request from ". $contactname." | ".get_the_title();			

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
 
 $headers .= 'From: '.get_option('blogname').' <'.get_option('admin_email').'>  ';
 



// Mail it
 
 mail($contactemail, $oggetto, $email_html, $headers);

 mail(get_option('admin_email'), $oggetto, $email_html, $headers);




 $out.='
</div>';


}





















 return $out;


  
	} //end romeluv booking form function
	
	
	
	



 
 
?>
