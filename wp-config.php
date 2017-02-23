<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db663918335');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         '|3%zxsj:K+`]KJz-?[mJ$j9Oj-a-MAPLaDKL$ETUrtwj~y^n/r_3M&kXm_p+,b#');
define('SECURE_AUTHKEY',  '>b*:UH .x sG}Xkg+3P0o:XY|EV+I=U}hZ0|?N/T5PB9^7.<1yWY6R:.zeA;0X?');
define('LOGGED_IN_KEY',    'reaE-hm~io4vtj>nf*wo2^O$t#SPA1qbk|uLAT~|ZK?+ttR2,bCY_aRF3LP=]-S');
define('NONCE_KEY',        '#KT#_xv[{:D1_f?|:n9uM98/Y*q|f9.RE0!]v.g,x1cpx=<T+x}[UCM/s7)hJ/Z4');
define('AUTH_SALT',        'rARY?+Nfdhk>uKU$@oq&TPH(HW=b8Gg!y>C@d$w/i1r WpBY,YUiY&^H[+4g-U}');
define('SECURE_AUTHSALT', 'S1ptD5hl)I2Ct:2oO`L|vg0QV:u:+#G9x{k~Gtb`M|^B~K>~P Da!Q.C,_s_2XY');
define('LOGGED_IN_SALT',   'W.;+B0MFMu;YWvxZ$D[CEAVY9Q(7)Y)nOf-|f3:!f;^y[=BeKd6f),)j3&DvzAD');
define('NONCE_SALT',       'OWS|+2l,VGem_*fxBqYMxI<%m]bCc9W{/N4-1VsZ~xpWG!nB_nxMF!A&Gtt/;6^');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'iriXf';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
