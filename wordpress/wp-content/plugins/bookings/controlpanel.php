<?php
function bookings_options() {
	global $bookings_name,$bookings_shortname,$cc_login_type,$current_user,$wp_roles,$bookingsRegions;
	$bookings_name = "Bookings";
	$bookings_shortname = "bookings";

	if (!get_option('bookings_secret')) update_option('bookings_secret',bookings_create_secret());

	$bookings_options[100] = array(  "name" => "Settings",
            "type" => "heading",
			"desc" => "This section customizes the way the Bookings plugin works.");
	$bookings_options[110] = array("name" => "API Key",
			"desc" => 'This plugin uses remote web services to provide mailing list functionality. This API key has been automatically generated for you. Once you click on Install, the API key, in combination with your web site address <strong>'.home_url().'</strong> will create an account on our servers allowing the plugin to access the remote web services.<br />The combination of API key and your web site address uniquely identifes you so please make sure to keep it in a safe place.',
			"id" => $bookings_shortname."_key",
			"type" => "text");
	$bookings_options[111] = array("name" => "Secret",
			"desc" => 'This is your secret or password, it is uniquely linked to your Bookings account, make sure to keep it in a safe place.',
			"id" => $bookings_shortname."_secret",
			"type" => "text");
	$bookings_options[120] = array("name" => "License Key",
			"desc" => 'If you wish to make use of the <strong>Bookings Pro</strong> features, enter your license key here. You can purchase a license key <a href="http://www.zingiri.com/portal/?ccce=cart&a=add&pid=121" target="blank">here</a>. The Pro version provides additional functionality and has no limits to the number of bookings and schedules you can use.',
			"id" => $bookings_shortname."_lic",
			"type" => "text");
	$regions=array();
	foreach ($bookingsRegions as $r => $a) {
		$regions[$r]=$a[0];
	}
	if (!get_option('bookings_region')) {
		$bookings_options[130] = array("name" => "Region",
			"desc" => "Select the region you are located in. This can only be set once so make sure you select the right region.",
			"id" => $bookings_shortname."_region",
			"options" => $regions,
			"type" => "selectwithkey");
	} else {
		$bookings_options[130] = array("name" => "Region",
			"desc" => "Region you are connected to.",
			"id" => $regions[get_option($bookings_shortname."_region")],
			"type" => "info");
	}
	$p=parse_url(home_url());

	$bookings_options[135] = array(	"name" => "Showcase Your Site",
			"desc" => "If you choose to participate in our showcase, we will list your site <strong style=\"color:blue\">http://".$p['host']."</strong> with the description '<strong style=\"color:blue\">".get_bloginfo('name').' - '.get_bloginfo('description')."</strong>' on our site. This is a way to show your support for this plugin and a bit of free advertising for you. Please don't join the program until your site is ready.",
			"id" => $bookings_shortname."_showcase",
			"type" => "checkbox");
	$bookings_options[140] = array(	"name" => "Debug Mode",
			"desc" => "If you have problems with the plugin, activate the debug mode to generate a debug log for our support team",
			"id" => $bookings_shortname."_debug",
			"type" => "checkbox");

	//languages
	$languages = array (
		'ar'	=> array('ar([-_][[:alpha:]]{2})?|arabic', 'ar.lang.php', 'ar', 'Arabic (&#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577;)'),
		'bg'	=> array('bg([-_][[:alpha:]]{2})?|bulgarian', 'bg.lang.php', 'bg', 'Bulgarian (&#x0411;&#x044a;&#x043b;&#x0433;&#x0430;&#x0440;&#x0441;&#x043a;&#x0438;)'),
		'zh_CN' => array('zh([-_]cn)?|chinese', 'zh_CN.lang.php', 'zh', 'Chinese Simplified (&#x7b80;&#x4f53;&#x4e2d;&#x6587;)'),
		'zh_TW'	=> array('zh([-_]tw)?|chinese', 'zh_TW.lang.php', 'zh', 'Chinese Traditional (&#x6b63;&#x9ad4;&#x4e2d;&#x6587;)'),
		'cs'	=> array('cs([-_][[:alpha:]]{2})?|czech', 'cs.lang.php', 'cs', 'Czech (&#x010c;esky)'),
		'da'	=> array('da([-_][[:alpha:]]{2})?|danish', 'da.lang.php', 'da', 'Dansk'),
		'de'	=> array('de([-_][[:alpha:]]{2})?|german', 'de.lang.php', 'de', 'Deutsch'),
		'es'	=> array('es([-_][[:alpha:]]{2})?|spanish', 'es.lang.php', 'es', 'Espa&ntilde;ol'),
		'fr'	=> array('fr([-_][[:alpha:]]{2})?|french', 'fr.lang.php', 'fr', 'Fran&ccedil;ais'),
		'el'	=> array('el([-_][[:alpha:]]{2})?|greek', 'el.lang.php', 'el', 'Greek (&#x0395;&#x03bb;&#x03bb;&#x03b7;&#x03bd;&#x03b9;&#x03ba;&#x03ac;)'),
		'en_US'	=> array('en([-_]us)?|english', 'en_US.lang.php', 'en', 'English US'),
		'en_GB'	=> array('en([-_]gb)?|english', 'en_GB.lang.php', 'en', 'English GB'),
		'it'	=> array('it([-_][[:alpha:]]{2})?|italian', 'it.lang.php', 'it', 'Italiano'),
		'ja'	=> array('ja([-_][[:alpha:]]{2})?|Japanese', 'ja_JP.lang.php', 'ja', 'Japanese'),
		'ko'	=> array('ko([-_][[:alpha:]]{2})?|korean', 'ko_KR.lang.php', 'ko', 'Korean (&#54620;&#44397;&#50612;)'),
		'hu'	=> array('hu([-_][[:alpha:]]{2})?|hungarian', 'hu.lang.php', 'hu', 'Magyar'),
		'nl'	=> array('nl([-_][[:alpha:]]{2})?|dutch', 'nl.lang.php', 'nl', 'Nederlands'),
	//'no'	=> array('no([-_][[:alpha:]]{2})?|norwegian', 'no.lang.php', 'no', 'Norwegian'),
		'pl'	=> array('pl([-_][[:alpha:]]{2})|polish', 'pl.lang.php', 'pl', 'Polski'),
		'pt_PT'	=> array('pr([-_]PT)|portuguese', 'pt_PT.lang.php', 'pt', 'Portugu&ecirc;s'),
		'pt_BR'	=> array('pr([-_]BR)|portuguese', 'pt_BR.lang.php', 'pt', 'Portugu&ecirc;s Brasileiro'),
		'ru'	=> array('ru([-_][[:alpha:]]{2})?|russian', 'ru.lang.php', 'ru', 'Russian (&#x0420;&#x0443;&#x0441;&#x0441;&#x043a;&#x0438;&#x0439;)'),
		'sk'	=> array('sk([-_][[:alpha:]]{2})?|slovakian', 'sk.lang.php', 'sk', 'Slovak (Sloven&#x010d;ina)'),
		'sl'	=> array('sl([-_][[:alpha:]]{2})?|slovenian', 'sl.lang.php', 'sl', 'Slovensko'),
		'fi'	=> array('fi([-_][[:alpha:]]{2})?|finnish', 'fi.lang.php', 'fi', 'Suomi'),
		'sv'	=> array('sv([-_][[:alpha:]]{2})?|swedish', 'sv.lang.php', 'sv', 'Swedish'),
		'tr'	=> array('fi([-_][[:alpha:]]{2})?|turkish', 'tr.lang.php', 'tr', 'T&uuml;rk&ccedil;e')
	);

	$options=array();
	foreach ($languages as $lang => $desc) {
		$options[$lang]=$desc[3];
	}
	$bookings_options[150] = array(	"name" => "Language",
			"desc" => "Bookings supports multiple languages, here you can select the language of your choice. The language will affect related settings such as the date format used to display dates. If you see blank screens after changing the language from English, please contact us as some of the language files have some encoding issues. If you see missing translations, please send us the translations and we'll incorporate them into a new version. And if you can't see your language but are interested to add it, contact us so we can see how we can work something out.",
			"id" => $bookings_shortname."_lang",
			"options" => $options,
			"std" => get_locale(),
			"type" => "selectwithkey");

	//capabilities
	$allCaps=array();
	foreach ($wp_roles->roles as $role) {
		$allCaps=array_merge($allCaps,$role['capabilities']);
	}
	ksort($allCaps);
	array_walk($allCaps,create_function('&$value,$key','$value=str_replace("_"," ",ucfirst($key));'));
	$bookings_options[160] = array(	"name" => "Admin capability",
			"desc" => "Choose the required capability for managing settings, schedules and resources. It is recommended to use an admin type of capability, such as 'Manage options'",
			"id" => $bookings_shortname."_admin_cap",
			"options" => $allCaps,
			"std" => 'manage_options',
			"type" => "selectwithkey");
	$bookings_options[161] = array(	"name" => "User capability",
			"desc" => "Choose the required capability for managing bookings. It is recommended to use an editor type of capability, such as 'Edit posts'",
			"id" => $bookings_shortname."_user_cap",
			"options" => $allCaps,
			"std" => 'edit_posts',
			"type" => "selectwithkey");

	if (defined('BOOKINGS_LIVE')) bookings_live_options($bookings_options);

	$bookings_options[999]=array(  "name" => "Before you install",
            "type" => "heading",
			"desc" => '<div style="text-decoration:underline;display:inline;font-weight:bold">IMPORTANT:</div> Bookings uses web services stored on Zingiri\'s servers. In doing so, personal data is collected and stored on our servers. 
					This data includes amongst others your admin email address as this is used, together with the API key as a unique identifier for your account on Zingiri\'s servers.
					We have a very strict <a href="http://www.zingiri.com/privacy-policy/" target="_blank">privacy policy</a> as well as <a href="http://www.zingiri.com/terms/" target="_blank">terms & conditions</a> governing data stored on our servers.
					<div style="font-weight:bold;display:inline">By installing this plugin you accept these terms & conditions.</div>');

	ksort($bookings_options);

	return $bookings_options;
}

function bookings_add_admin() {

	global $bookings_name, $bookings_shortname, $bookings;

	$bookings_options=bookings_options();

	if (isset($_GET['page']) && ($_GET['page'] == "bookings")) {

		if ( isset($_REQUEST['action']) && 'install' == $_REQUEST['action'] ) {
			unset($_SESSION['bookings']['menus']);
			delete_option('bookings_log');
			foreach ($bookings_options as $value) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) {
					update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
				} else { delete_option( $value['id'] );
				}
			}
			header("Location: admin.php?page=bookings&installed=true");
			die;
		}
	}

	if ((!get_option('bookings_region') || !get_option('bookings_version')) && current_user_can(BOOKINGS_ADMIN_CAP)) {
		add_menu_page($bookings_name, $bookings_name, BOOKINGS_USER_CAP, 'bookings','bookings_main');
		add_submenu_page('bookings', $bookings_name.' - Setup', 'Setup', BOOKINGS_ADMIN_CAP, 'bookings', 'bookings_main');
	} else {
		if (current_user_can(BOOKINGS_ADMIN_CAP)) {
			add_menu_page($bookings_name, $bookings_name, BOOKINGS_USER_CAP, 'bookings','bookings_main');
			add_submenu_page('bookings', $bookings_name.' - Setup', 'Setup', BOOKINGS_ADMIN_CAP, 'bookings', 'bookings_main');
		} else {
			add_menu_page($bookings_name, $bookings_name, BOOKINGS_USER_CAP, 'bookings','bookings_main');
		}
		if (!isset($bookings['output']['menus'])) {
			$menus=isset($_SESSION['bookings']['menus']) ? $_SESSION['bookings']['menus'] : array();
		} else {
			$menus=$bookings['output']['menus'];
			$_SESSION['bookings']['menus']=$bookings['output']['menus'];
		}
		$first=true;
		if (count($menus) > 0) {
			foreach ($menus as $menu) {
				if (current_user_can(BOOKINGS_ADMIN_CAP)) {
					if ($menu[3]=='manage_options') add_submenu_page($menu[0],$menu[1],$menu[2],BOOKINGS_ADMIN_CAP,$menu[4],$menu[5]);
					else add_submenu_page($menu[0],$menu[1],$menu[2],BOOKINGS_USER_CAP,$menu[4],$menu[5]);
				} else {
					if ($menu[3]!='manage_options')  {
						if ($first) {
							$first=false;
							//continue;
						}
						add_submenu_page($menu[0],$menu[1],$menu[2],BOOKINGS_USER_CAP,$menu[4],$menu[5]);
					}

				}
			}
		}
	}
}

function bookings_main() {
	global $bookings;

	if (!isset($_GET['zb'])) return bookings_admin();

	if (defined('BOOKINGS_LIVE') && !get_option('bookings_siteurl')) return bookings_admin();

	require(dirname(__FILE__).'/includes/support-us.inc.php');

	echo '<div class="wrap">';
	//zing_support_us_top('bookings','bookings','bookings',BOOKINGS_VERSION,false);
	echo '<div id="bookings" style="position:relative;float:left;width:100%">';
	if (isset($bookings['output']['messages']) && is_array($bookings['output']['messages']) && (count($bookings['output']['messages']) > 0)) {
		echo '<div class="error">';
		foreach ($bookings['output']['messages'] as $msg) {
			echo $msg.'<br />';
		}
		echo '</div>';
	}
	if (isset($bookings['output']['mimetype']) && ($bookings['output']['mimetype'] == 'text/plain')) {
		while (count(ob_get_status(true)) > 0) ob_end_clean();
		header('Content-Type: ' . $bookings['output']['mimetype']);
		header('Content-Disposition: attachment; filename="'.$bookings['output']['filename'].'"');
		if (isset($bookings['output']['body'])) echo trim($bookings['output']['body']);
		die();
	} elseif (isset($bookings['output']['body'])) echo $bookings['output']['body'];

	require(dirname(__FILE__).'/includes/help.inc.php');
	echo '</div>';

	zing_support_us_bottom('bookings','bookings','bookings',BOOKINGS_VERSION,false);

	echo '</div>';
}

function bookings_admin() {

	global $bookings_name, $bookings_shortname;

	$controlpanelOptions=bookings_options();

	if ( isset($_REQUEST['install']) ) echo '<div id="message" class="updated fade"><p><strong>'.$bookings_name.' settings updated.</strong></p></div>';
	if ( isset($_REQUEST['error']) ) echo '<div id="message" class="updated fade"><p>The following error occured: <strong>'.$_REQUEST['error'].'</strong></p></div>';
	require(dirname(__FILE__).'/includes/support-us.inc.php');

	?>
<div class="wrap">
<?php 	zing_support_us_top('bookings','bookings','bookings',BOOKINGS_VERSION,false);?>
	<div id="cc-left" style="position: relative; float: left; width: 100%">
		<h2>
			<b><?php echo $bookings_name; ?> </b>
		</h2>

		<?php
		$bookings_version=get_option("bookings_version");
		$submit='Update';
		?>
		<form method="post">
		<?php require(dirname(__FILE__).'/includes/cpedit.inc.php')?>

			<p class="submit">
				<input name="install" type="submit" value="<?php echo $submit;?>" /> <input type="hidden"
					name="action" value="install"
				/>
			</p>
		</form>
		<?php
		if ($bookings_version && get_option('bookings_debug')) {
			echo '<h2 style="color: green;">Debug log</h2>';
			echo '<textarea rows=10 cols=80>';
			$r=get_option('bookings_log');
			if ($r) {
				$v=$r;
				foreach ($v as $m) {
					echo date('H:i:s',$m[0]).' '.$m[1].chr(13).chr(10);
					echo $m[2].chr(13).chr(10);
				}
			}
			echo '</textarea><hr />';
		}
		require(dirname(__FILE__).'/includes/help.inc.php');
		?>
	</div>
	<!-- end cc-left -->
	<?php
	zing_support_us_bottom('bookings','bookings','bookings',BOOKINGS_VERSION,false);
}
add_action('admin_menu', 'bookings_add_admin'); ?>