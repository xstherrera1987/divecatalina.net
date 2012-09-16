=== Bookings ===
Contributors: zingiri
Donate link: http://www.zingiri.com/donations
Tags: booking, schedule, scheduler, appointment, reservation, appointment, availability, availability calendar, Booking calendar, booking form, calendar, event calendar, events, reservation plugin, scheduling, online reservation, appointment scheduling
Requires at least: 3.0
Tested up to: 3.4.1
Stable tag: 1.7.8

Bookings is a powerful reservations scheduler.

Whether you’re running a Beauty salon, Spa, Hairdresser, Massage therapy, Acupuncture or providing hotel rooms, visitors to your site will be able to check availability of your service and make online bookings.

== Description ==

This WordPress plugin allows you to provide online booking services for your site.

* Blackout times are easy to add and manage to restrict reservations.
* Reservation minimum and maximum time limits can be set on a per-resource basis.
* Administrator has power to add and manage an unlimited number of resources. All which can be toggled active and inactive at any point.
* Administrator has control over all reservations and can browse, modify and delete any reservation in the system.
* Administrators can search through the reservation database with a very flexible search tool. Search results can be viewed as HTML, plain-text, XML or CSV.
* Calendars can be viewed in a day/week/month layout.
* Reservations can be set to be approved or not
* Supports multiple languages: English (US & GB), German, French, Spanish, Italian, Hungarian, Dutch, Finnish, Swedish, Turkish, Arabic, Bulgarian, Chinese (Traditional & Simplified), Czech, Danish, Greek, Japanese, Korean, Polish, Portuguese, Slovak and Slovenian.
* Community support via our [Forums](http://forums.zingiri.net "Forums") 
* Limited to 1 schedule and 25 bookings per month

The Pro version of the plugin additionaly offers:

* Unlimited bookings
* Unlimited schedules
* Integration of payment gateways such as Paypal etc 
* Products & services
* Customization of the booking form with custom fields
* Mobile syncing with your iPhone, iPad, Android device and more
* Possibility to edit the thank you text on the confirmation page
* Possibility to edit the confirmation emails 
* Multiple configuration options: send admin confirmation email, currency, etc
* Export reservations to your favorite calendar (Outlook, iCal, etc) from the admin back-end or your confirmation email
* Possibility to search reservations by reservation ID
* Possibility to define your own time spans
* Priority support via our [Helpdesk](http://www.zingiri.com/portal "Helpdesk")

Note: Bookings uses web services stored on Zingiri's servers, read more in the plugin's FAQ about what that means.

== Installation ==

1. Upload the `bookings` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Include the code [bookings] in any page to display the bookings form. There are differrent options for formatting the bookings form that are documented on [our site](http://www.zingiri.com/bookings#usage "our site").

Please visit [Zingiri](http://wiki.zingiri.com/index.php?title=Bookings:Main "Zingiri") for more information and support.

== Frequently Asked Questions ==

= This plugin uses web services, what exactly does that mean? =
Web services are simple way of delivering software solutions. Basically it means that the software & data is hosted on our secure servers and that you can access it from anywhere in the world. 
No need to worry about backing up your data, managing systems, we do it for you.

= What about data privacy? =
Bookings uses web services stored on Zingiri's servers. In doing so, personal data is collected and stored on our servers. 
This data includes amongst others your admin email address as this is used, together with the API key as a unique identifier for your account on Zingiri's servers. 
We have a very strict [privacy policy](http://www.zingiri.com/privacy-policy/ "privacy policy") as well as [terms & conditions](http://www.zingiri.com/terms/ "terms & conditions") governing data stored on our servers.

Please visit the [Zingiri Support Forums](http://forums.zingiri.net/forumdisplay.php?fid=60 "Zingiri Support Forum") or download our [Documentation](http://www.zingiri.com/portal/?ccce=downloads&action=displaycat&catid=6 "Documentation") for more information and support.

== Screenshots ==

Screenshots are available [here](http://www.zingiri.com/plugins-and-addons/bookings/ "screenshots").

== Changelog ==

= 1.7.8 =
* Don't allow change of time when approving a reservation
* When using 'daystoshow' don't show more dates than available
* Fixed issue with date selector not working when days to show is set to specific dates
* Added DKK currency
* Fixed issue with reservation template not being parsed in combination with multiple slot bookings
* Fixed issue with unavailability message not showing correct start and end times
* Fixed issue with prices not tallying when using hour units on product level
* Fixed issue with products+resources template not auto refreshing resource list when changing product
* Added option to select all resources from all schedules in templates products+resources and resources+products [bookings template=products+resources schedule=*]
* Ajaxified date selector on calendar page
* Fixed encoding issue with Portuguese language files

= 1.7.7 =
* Show currency symbol instead of ISO code if known
* Fixed issue where pop up boxes don't load properly (themes using ob_start)
* Fixed issue with client.css not being loaded in version 1.7.6
 
= 1.7.6 =
* Simplified error logging
* Fixed issue with help links

= 1.7.5 =
* Added reminder function (Pro)
* Added new [bookings1], [bookings2], [bookings3], [bookings4] short codes to enable display of specific text on every single bookings process page
* Added Moneybookers payment gateway (Pro)
* Fixed issue with approvals not being available in free version
* Fixed issue with non breaking space appearing as &nbsp in product summary
* Added option to select schedule by admin email in [bookings] short code
* Removed loading of Twitter and Facebook buttons on all pages except configuration page
* Changed default page to Schedule Calendar
* Fixed formatting issue of amounts in hotel1 template
* Fixed issue with double display of currency in checkout
* Fixed issue with add to calendar link
* Fixed issue with payment gateway fields not being hidden automatically (formfield.jquery.js not loaded)
* Fixed issue with resources not being refreshed when editing products (repeatable.jquery.js, not loaded)

= 1.7.4 =
* Fixed issue with parsing of [PRODUCT] template variable
* Fixed issue where [LOCATION] displayed the site name instead of the resource location in case of multi-slot bookings
* Fixed issue with formatting of Paypal amounts
* Fixed issue with Google Calendar sync links containing underscores in some cases which is not accepted as a valid URL by Google
* Fixed issue with resource name NAME template field not being filled correctly in certain cases
* Fixed issue with quantity not being applied to total price
* Allow admin users to override minimum break time between bookings when making bookings or entering blackouts in the back end
* Black out break times in between bookings if set
* Added more Swedish translations

= 1.7.3 =
* Removed console logging messages
* Added pricing unit to products & services pricing
* Fixed issue with some template fields not being available for multi slot reservations

= 1.7.2 =
* Added option to participate in show case
* Fixed formatting issue with price being displayed at the end of checkout
* Fixed issues with emails in case of multi slot reservations
* Changed formatting of default email sent
* Added customer name to default email
* Fixed issue with selection of quantity in front end process in case of multi capacity resource
* Updated Add by URL Google Calendar instructions
* Fixed issue with Google Calendar subscription links not loading
* Added customer email and phone number to search export (CSV and XML formats)

= 1.7.1 =
* Added high light of selected day in back-end calendar
* Added possibility to subscribe to Bookings calendars from Google Calendar
* Fixed user login conflict occuring in certain circumstances
* Fixed issue with format of times in schedule1 template

= 1.7.0 =
* Added multi slot booking possibility
* Fixed issue where reserved slots are not shown when selected dates are chosen for days to view
* Added possibility to capture number of participants/units to book in case of multi-capacity bookings
* Fixed issue with phone number not being captured for users who already had reservations registered
* Fixed issue where first name and last name are not being updated during new bookings
* Changed the way admin emails are being sent, instead of a Bcc, a new email is sent to the admin if requested to do so
* Changed title of admin email to distinguish it better from the customer email
* Added client phone as parameter in confirmation messages and emails
* Added possibility to use custom form fields defined in registration form in the confirmation messages and emails
* Fixed issue where total price not calculated properly when booking multiple days
* Added highlight of selected day in front end calendar
* Show name of selected product in second and third screen of bookings process
* Added product name in confirmation message and email
* Added new template rp2

= 1.6.9 =
* Fixed issue with front end calendar not showing correctly in Japanese
* Added SEK and MXN currencies
* Tested compatibility with WP 3.4

= 1.6.8 =
* Fixed release issue

= 1.6.7 =
* Updated allowed extensions to 'jpg','bmp','png','zip','pdf','gif','doc','xls','wav','jpeg','docx','ppt','pptx','mp3'
* If not using SMTP email and admin email alert activated, the email address is added to the list of recipients as BCC is not working in this case
* Added MXN currency

= 1.6.6 =
* Fixed issue with US vs Europe date formats for date field
* Added time picker widget to Time element type
* Removed europe_date element type and added option to select date format (US or Europe) to date element type

= 1.6.5 =
* Fixed issue with activation of Form Editor
* Added new currencies: NZD, AUD, CAD
* Fixed issue with saving form throwing an error
* Checked compatibility with Wordpress version 3.3.2

= 1.6.4 =
* Added possibility to create a user during reservation creation in back-end
* Removed sending of user registration confirmation to user
* Fixed issue with multi-capacity slots showing available and overlapping with blackouts

= 1.6.3 =
* Added new compact1 template displaying date selector to the left and time selector the right on the front end calendar screen
* In default, buttons and compact1 templates skip first screen if only 1 resource to select (if [bookings] short code variable skip is set to 'yes')
* In schedule1, schedule2 and hotel templates, skip the first screen displaying the 'Next' button (if [bookings] short code variable skip is set to 'yes')
* Updated readme.txt and settings page regarding the use of web services and data privacy policy
* Removed inline styles from back-end schedule calendar
* Only allocate new API key and secret if none exist
* Fixed rendering of UTF-8 characters in field labels 
* Added BOOKINGURL as a template variable representing the URL to the website page where the customer can manage their booking
* Updated css to force removal of bullets in form display
* Disabled Norwegian as it's not completely translated
* Fixed issue with open bookings not showing in front end after user cancels a booking
* Fixed issue with booking cancellation in front end not working when not using permalinks but page_id instead
* Fixed issue with booking form configuration being reset after upgrade
* Added "form" [bookings] variable to select bookings form
* Added support for multiple forms
* Fixed issue with display of multiple reservations for same resource, same time in back end schedule
* Improved display of reservations in back end schedule
* Fixed overflow display in schedule2 template
* Resource are now ordered by name in front end screen

= 1.6.2 =
* Fixed issue when switching schedules in blackouts redirecting to the schedule calendar instead of blackouts
* Fixed issue with blackouts not displaying correctly after multi-capacity upgrade

= 1.6.1 =
* Added option to download search results in XML, CSV and plain text formats
* Fixed issue with user search form in back-end where searching by letter would not work on a second booking
* Fixed issue with user search form where searching by name would redirect to the wrong page
* Fixed pagination issue in user search form
* Added class 'availability' to availability table displayed on front end
* Updated Danish language file

= 1.6.0 =
* Added support for multi-capacity reservations
* Added load of jQuery UI tabs
* Fixed issue with emails not being sent to admin in some cases
* Keep settings on deactivation
* Remove settings on uninstall
* Added secret field to account settings
* Fixed issue with date selector not showing on multi-day reservations
* Fixed formatting issue with dates when Traditional Chinese or Japanese is chosen
* Removed display of recurring or multi-day reservations in front-end calendar
* Removed bullet point in front of name on front-end calendar

= 1.5.6 =
* Allow unlicensed users access to Products & Services feature
* Added product details to reservation summary
* Fixed issue with first name and last name not being prefilled correctly for logged in users
* Added [PRODUCT] template tag for emails and confirmation messages
* Added [CLIENTNAME] template tag for emails and confirmation messages
* Disabled properties of system fields in form editor
* Fixed issue with change of date on template schedule2 not working in some cases
* Fixed issue with templates using daystoshow not showing reservations on days in the future
* Updated German language prompts

= 1.5.5 =
* Added possibility to define custom time spans
* Fixed issue with +/- buttons on product form not working
* Updated documentation and support links
* Fixed issue with product time spans not working in certain cases
* In products/resources templates, the sort order is now product name and then resource name
* Removed date fromto element from forms

= 1.5.4 =
* Fixed issue with 'link' template
* Removed obsolete css/ui-lightness folder
* Removed obsolete css/jscalendar folder
* Removed obsolet js/jscalendar folder
* Don't display unselected resources in reservation overview
* Replaced inline color styles by classes on front end reservation calendar
* Fixed issue with last name being prefilled with a question mark on registration form
* Fixed issue with 'A' beging defaulted in form fields

= 1.5.3 =
* Fixed issue with calendar.setup javascript
* Fixed issue with missing load of jQuery UI Sortable

= 1.5.2 =
* Replaced admin reservation popup window with jQuery dialog
* Replaced admin user selection and search popup window with jQuery dialog
* Set no bullet points in front end registration form
* Hide inactive resources from front end screens
* Load simple_html_dom class only when required
* Fixed wrong link to login details showing after activating calendar syncing
* Replaced Prototype/Scriptaculous scripts by jQuery
* Use WP default jQuery libraries
* Removed reminder section from blackout pop-up

= 1.5.1 =
* Fixed packaging issue

= 1.5.0 =
* Added 'event mode' allowing to define a schedule active only on certain dates
* Added new template 'schedule1' for the [bookings] short code displaying a calendar with availability for all resources (similar to the schedule calendar in the back-end)
* Added new template 'schedule2' for the [bookings] short code displaying a calendar with the possibility to search by date, showing availability for all resources
* Added new template 'hotel1' for the [bookings] short code tailored for hotels and B&B's
* Added 'daystoshow' parameter for the [bookings] short code allowing to display more than 1 day of availability in the front-end calendar
* Implemented Wordpress short code API, allowing to manage multiple bookings pages and multiple short codes on the same page
* Added reservation details on checkout page
* Fixed issue with selecting Japanese language
* Added new colors.css style sheet with the colors of the reservation statuses
* Fixed issue where when clicking 'Add' to add another product or service after having added one, the link takes you to the set up screen
* Removed loading of news info in sidebar, providing more space for other functionality
* Included local image files
* Fixed issue with back link when an error occurs creating or modifying a schedule
* Added new styling to front end buttons
* Removed seconds display from time on confirmation messages
* Displayed am/pm in lower case for consistency
* Changed default order of reservations seen by customer to show most recently created first
* Fixed issue with tooltip being offset from mouse position
* Changed Paypal item time to show reservation date instead of reservation id
* Changed Paypal invoice id to show Bookings invoice id
* Moved to same checkout form for both standard and pro users
* Fixed issue with month selector on front end calendar
* Removed showSummary javascript action from front end calendar
* Centered calendar and date jumper on front end
* Show loader icon when saving schedule or resource

= 1.4.3 =
* Fixed issue with redirects not working if PHP sessions not configured properly on client side
* Store http referer in option instead of session variable
* Delete bookings php session when deactivating
* Fixed issue with loading of Norwegian language files
* Fixed issue where Wordpress Editors and some other roles had no access to the front-end booking screens

= 1.4.2 =
* Only load admin javascript and styles on Bookings pages

= 1.4.1 =
* Fixed issue 'Invalid argument supplied for foreach() in /.../wp-content/plugins/bookings/includes/support-us.inc.php on line 51'
* Fixed issue with 'no access' being displayed on Blackouts screen
* Fixed issue with textarea element in templates

= 1.4.0 =
* Added products & services concept
* Added Paypal payment gateway (Pro)
* Added option for customers to view and cancel upcoming reservations (Pro)
* Fixed issue with timezones
* Removed 'sc1' prefix from keys
* Fixed issue with changing schedules in the 'Schedule Calendar'
* Fixed Finnish language encoding

= 1.3.3 =
* Fixed issue with url encoding

= 1.3.2 =
* Added option to send confirmation email to administrator (Pro)
* Added SMTP email settings (Pro) 
* Added approval management
* Improved role management (admin vs operator)
* Added display of region in setup panel
* Improved usability by auto redirecting after admin update
* Removed date link from front end calendar
* Removed grey background from admin screens
* Removed encapsulating html table from admin screens
* Fixed issue with front end month selector not working on some themes
* Centered day headers on front end calendar
* Removed donations reminder

= 1.3.1 =
* Added mobile sync
* Added Norwegian language
* Verified compatibility with WP 3.3
* Added new region (Europe & Africa)
* Updated documentation
* Fixed issue with Edit form link appearing on front end booking form
* Removed table containing reservation details from email when custom emails are being used
* Fixed issue with deleting resources

= 1.3.0 =
* Added possibility to define minimum time between bookings for each resource
* Added possibility to define email templates and override the default text
* Fixed issue with double body tag appearing on some pages
* Always show registration form, even for registered Wordpress users
* Updated Italian language translations
* Removed wrapping tables styling
* Changed bookings template=link parameter, 'resource' should be specified instead of 'schedule'
* Fixed 'per page' and 'cancel' links on resource page
* Fixed issue with captcha element on forms not working properly

= 1.2.0 =
* Split back-end roles in admin and user roles
* Added possibility to select required capability for admins and users
* Own reservations are now highlighted in a different color in front end
* Translated booking registration page
* Replaced [...] by 'Available' for English GB and US languages
* Added 45 minutes schedule time span
* Fixed issue with disappearing user name in front end calendar
* Changed header date format for English GB so that day appears before month
* Updated readme
* Allow navigation on days before today in back-end calendar
* Fixed Brazilian Portuguese language encoding
* Added possibility to export reservation to calendar in ICS or VCS format (Pro)
* Added 'Add to calendar' link on emails (Pro)

= 1.1.2 =
* Fixed release issue

= 1.1.1 =
* Removed Accessories and Participants tabs from reservation pop-up (back-end) as currently not used
* Fixed issue with pop-up windows not being styled properly
* Fixed issue with Change Name not working when editing a reservation in the back-end
* Fixed encoding issues with Slovenian and Slovak languages
* Fixed issue with booking confirmation not showing when default permalinks set (Pro version)

= 1.1.0 =
* Use Wordpress time settings for calendar time settings (military time vs am/pm notation)
* Fixed issue with Polish, Czech and French language files encoding
* Show registration form in all cases
* Added possibility to edit custom booking form (Pro version)

= 1.0.6 =
* Added dashboard view showing various statistics on resources and reservations
* Upgraded HttpRequest class to v1.10.02
* Added license key field for Pro features
* Days before today's date are now protected in calendar
* Added highlight of today's date in calendar

* Fixed encoding issue with Spanish and Danish language files

= 1.0.5 =
* Added new booking templates

= 1.0.4 =
* Removed obsolete cc_footer() function

= 1.0.3 =
* Fixed permissions issue for guest bookings
* Fixed issue with German language not working (encoding issue)
* Added 6 hours and 8 hours timespans

= 1.0.2 = 
* Added possibility to choose the language/locale
* Added display of reservation time in confirmation message
* Fixed issue with sending of confirmation email
* Fixed issue with minimum and maximum booking notice not being taken into account in the calendar
* Fixed issue with settings not updating properly

= 1.0.1 =
* Fixed issue with guest bookings causing a database error
* Fixed issue with multiple bookings by same anonymous user not registering

= 1.0.0 =
* Fixed issue with guest bookings throwing an HTTP 500 error on the site
* Changed menu capability level from 'administrator' to 'edit_plugins'

= 0.9.3 =
* Removed wrong plugin name in admin notices
* Forced display name as first name and/or last name when those are not specified
* Disabled check on sessions save path

= 0.9.2 =
* Fixed issue with installations running PHP 5.2 or lower
* Updated documentation and support links

= 0.9.1 =
* Beta release

= 0.9.0 =
* Alpha release