=== MP Booking ===
Author: mathieu-piot
Tags: backpacker, booking, hotel, hostel, b&b, tourism, destination, accommodation, shortcode, jqueryui, form, modal
Requires at least: 3.0
Tested up to: 3.2
Stable tag: 1.2.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Donate link: http://www.mathieu-piot.net/wordpress/mp-booking/
Plugin URI: http://wordpress.org/extend/plugins/mp-booking/

Booking Wordpress button. Open a booking form in a modal pane.
Just insert a shortcode into your page or post for be replac by a booking button.
Form for request booking for accomodation, hostel website.

== Description ==

MP Booking is a WordPress plugin which provides a button that opens a simple form for hostel / hotel reservations. 
The plugin allows multiple room descriptions on one page. 
The button opens a form with jQuery / JQueryui functionalities such as a modal form calendar; 
specific fields to be filled out, drop-down menus for client country, guest number, arrival time and a comment field. The booking
process ends with a captcha verification and sends an e-mail confirmation to the user and to the staff entitled to manage the reservation. 
The plugin is configurable by changing attributes in the shortcode such as: booking object / room type,
maximum number of rooms available, button label, form identification and
destination e-mail address for each instance of the form.

This plugin is inspired by "simple-booking-form" plugin written by romeluv.
It uses jQuery / jJueryui (for calendar)
Cpatcha lib: "kcaptcha"

== Installation ==

Place the booking button by entering the following shortcode on your page or posts :

[mp_booking object="Single Room" nummax="2" label="Book now"
from="noreply"
send_to="destination1@domain.com" captcha="yes"]

Configure with argument :

* @object : identifies the form instance. Examples: Single Room, Twin Room etc.
This will be identified in the Subject field of the incoming reservation e-mail as
follows: Pending reservation for <object>
* @nummax : identifies the maximum number of rooms for each plugin usage
instance
* @label : identifies the label of the button. Examples: Book now!, Booking, Reservation
etc. Can be used to translate the button label. Examples: Réservation, Prenotazione,
Buchung etc.
* @from : identifies the sending instance of the plugin.
If not defined, the default sender will be noreply@your-domain.com
If defined as a name and not an address, the sender will be name@yourdomain.
com
Can be defined as an address, for example name@gmail.com but in this particular
case, the e-mail can be treated like spam by e-mail service providers.
* @send_to : identifies destination addresses for booking notification.
Multiple comma-separated addresses can be configured. Example:
destination1@domain.com, destination2@domain.com, destination3@domain.com
First defined address is used at the bottom of client message: “Please reply to:
destination1@domain.com”
* @captcha put no if you don't want captcha

== Frequently Asked Questions ==

= I don't see any plugin entry on my dashboard after install. Is it a problem? =

This plugin don't add any configuration panel in the dashboard. You just have to add the short code :

[mp_booking object="replace_here_your_room_description" 
nummax="Replace_here_max_guest_your_room_can_contain_5_for_exemple" 
label="Replace_here_the_text_to_display_on_the_button"
from="Replace_here_your_hostel_name"
send_to="Replace_here_by_your_email" 
captcha="replace_here_by_yes_or_no"]

Exemple :
Edit your page where you want to add a button.
Under your room description add the code :
[mp_booking object="replace_here_your_room_description" nummax="Replace_here_max_guest_your_room_can_contain_5_for_exemple"]

You ca add more option if you want to change the from email adress disable captcha.
The shortcode will be replaced by the button.

= How I can change the email adress? =

If you want to change email adress I highly recomand you to use for example :
[mp_booking object="theRoom" nummax="2" label="Book now"
from="nameofmyhostel"
send_to="admin@gmail.com" captcha="yes"]

Yo can change email adress in :
* "From" :
The "from" in the mail sended.
If not defined, the default sender will be noreply@yourdomain.com
If defined as a name and not an email address, the sender will be name@yourdomain.
com
Can be defined as an address, for example name@gmail.com but in this particular
case, the e-mail can be treated like SPAM by e-mail service providers.

* "send_to" : 
The mail will be sended to this adress to notify the owner of a new client's booking.
You can use email adress such as gmail or hotmail or whatever you want, or multiple adress separated by a coma
This email will be displayed at the bottom of client message: "Please reply to:
youradress@something.com"
 
= I would like to disable the captcha. =

Add captcha="no" in the shortcode

= I want to change some text (to translate it, or other) in the form, title, field, button how could I do? =

* Change the text label
Go in your plugin direcory.
Edit mp-booking-form.php with a notepad
Find a label for exemple : 
<label for='country'>Country</label>
Change the text into <label...></label> for exemple:
<label for='country'>Pays</label>
Do not change "for=..."

Save the file.
Reload your page in your browser by ctrl+f5 (ctrl to empty page cache)

* Change "continue", "back" button :

Edit the javascript file "mp-booking.js" in the "js" folder
Find :
$('#continue-button').html('<span class="ui-button-text">Continue</span>');
Replace for example by 
$('#continue-button').html('<span class="ui-button-text">Suivant</span>');
Save the file.
Reload your page in your browser by ctrl+f5 (ctrl to empty page cache)

= I want to change the color of the form, how I can do it simply? =

You can change by a theme existing in jquery ui by changing the line :
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/ui-lightness/jquery-ui.css'); 

For exemple by :
wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/themes/base/jquery-ui.css');

You can replace /base/ by other theme:
black-tie or blitzer or cupertino or dark-hive or dot-luv or vader or ui-lightness or ui-darkness or trontastic or swanky-purse or sunny or start or south-street or smoothness or redmond or pepper-grinder etc... 
To preview it see gallery tab in :
http://jqueryui.com/themeroller/

= I want to change the form's window size. =
Edit the javascript file "mp-booking.js" in the "js" folder
Find :
$( "#dialog-form" ).dialog({
  autoOpen: false,
  height: 500,
  width: 700,
  ......
  
Change width and height size.


= I want transform a field optional. =
Edit the javascript file "mp-booking.js" in the "js" folder
find the line : 
var fieldNeeded=new Array("first_name","name","email","country","date_checkin","date_chekout");
Delete one of field for exemple checkout :  
var fieldNeeded=new Array("first_name","name","email","country","date_checkin");

= There is a display problem, the form directly appear in my page, ho I can fix it? =
Verify if the problem is not due to other plugins installed or the wordpress version.
You can try to desactive all others plugins and see if it works, then find wich is in conflict. 

= I want to add adding payment function like a paypall submition for complete booking, what can I do? =
This is currently not implemented. Maybe in a future release. 

== Other ==
Any comments, suggestions and feedback are warmly welcomed at:
http://www.mathieu-piot.net/mp-booking/
You like it and want to suport 
You can help me to improve it if you are a developer.
Or send me a mail if you want to do a gift or a paypal coffee

== Screenshots ==

1. When adding the shortcode near a description (on this example I just create a table and put the button in a row)
2. After click on button modal form open
3. At the end user need to complete captcha, then information are sent to user and admin

== Changelog ==

= 1.0 =
* First plugin release.
= 1.2 =
* Add option for configure email 
* Add an option for disable kaptcha