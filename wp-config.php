<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'divecatalina');

/** MySQL database username */
define('DB_USER', 'divecatalina');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'F]Ep#~:[-EPeK*<}5G(bLeww@<~k#Hz#:6Q8#+w?2f.sSsy5qCS&aM$R~D!i; Q0');
define('SECURE_AUTH_KEY',  '&nT@+,#*l)X9JXd@ji_.H`rAMo^A7^KSEm-#&dNj5wKF%pke *=&;a:2U96H@?Vh');
define('LOGGED_IN_KEY',    '(=QcADR-;>W|eh{`lq[65,t+_8_Cb5fWDT Gn 65ufJTU.fWq]GpwChsBF{s{bSr');
define('NONCE_KEY',        '?uzYtN34F@$xkaQWi);aX ir,H;9hsmZ5iG$$55n%;xU8Ng0l%6P$aJ{pABW*p`/');
define('AUTH_SALT',        'IWIK~MLe7@U8Q2St8oRB)R|=l[cuTg)FWUI0!-4|%<I)?NAx]Rk*qoEDBYs hfA]');
define('SECURE_AUTH_SALT', 'D4Ux)FT7r}Dew+su>}~/4ROmG$8!bXvD_e3att`!3B/w/H+Iv9W)*Z n5[~.T:JL');
define('LOGGED_IN_SALT',   'iGv|Y0J_cTxor(GNGx~EQiV&05EI6u1gc_dp[DC{sR#LF(%+^Q!g00>NLXz(B}(?');
define('NONCE_SALT',       'lQy_>m~|F6ImkE=}jdgjRFOa5,NSLB{xWGCvz;6-I;txn1{Tb9O!r,~%o>yL|crH');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
