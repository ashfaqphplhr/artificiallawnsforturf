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
define('DB_NAME', 'nwturf_wp');

/** MySQL database username */
define('DB_USER', 'nwturf_blog');

/** MySQL database password */
define('DB_PASSWORD', '!,~{+2oNTx{%');

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
define('AUTH_KEY',         '6h^u/4am=/G@x[Q_EhnZ|fvRG0>>c,c!JE9qXx<re^Ljz-wW6POoG0|jHt3< Nk*');
define('SECURE_AUTH_KEY',  'NVy=c<{/;gmgotI>V/<+~X<3s#1RUI{^tW!LF,IO[Q:|j2mP-Q}rtPY,Xi-VsC-h');
define('LOGGED_IN_KEY',    '*^bS,#<y?>1MSPoqc12`.tvaNsS<p|R#:2!eX{KWbRoi$oc46z{Q5l+!D|rH,Byu');
define('NONCE_KEY',        ';C1zDs=Pw-igsb/i+p6SkE}iHIK^pPgTVN`4TN%<(-?5n>&n0kZEY=mzA.Cg3J1]');
define('AUTH_SALT',        'yI,mfoLRgp_,x{kBC|pz l$lv*%r*|g<IRB%7E#*ieQx%HBK`c/+Ga)0+{,-27d;');
define('SECURE_AUTH_SALT', 'Nki)C8]t<d(Wf&7f.I-8p[9?a0qh*UoIv8*yv?(,MO&-)!+fwZya@%E@XU>:edR^');
define('LOGGED_IN_SALT',   '(2XVMM/NLn[7Lh5I~[xZ^QO>Q1r{c^%y:|V5I.Oxq%!gtqI:(y:f><Z.C,Z7-H5F');
define('NONCE_SALT',       'raoB,;k@,xJKz|@LALaBXf@zf@_piyMkS$1?CG+$%wO;-xMCfolR73D_2j?451d*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'turf_';

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
