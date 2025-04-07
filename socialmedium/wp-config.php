<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ikbenlit_wordpress_db');

/** Database username */
define('DB_USER', 'colin');

/** Database password */
define('DB_PASSWORD', 'wordpress101!');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Es[yu9HW;p`FGP~Fcwcjb f-$!9}k/_2ML*ezw]r.,@|Ll.dwP/hXO2@c^rCZ7iO');
define('SECURE_AUTH_KEY',  'YLNFv}vz43T;S-0va=jy9e% .jCx:jy@0m<-sOYk[2fA@H>!kW{NC9*2M%+Yh*E,');
define('LOGGED_IN_KEY',    'ua:o#W>IF9T[k*8.[bmVMs `E+ !$)M-/yo-I,`6(;*8b#X,}fZ4|wuZ(73GP1aV');
define('NONCE_KEY',        'sLQpDGtMZrXe2VIlf{QK^{7!eidO~vs;N[oN.XE)9qYBZwTHb5Jx1lb/~X|>r$pa');
define('AUTH_SALT',        'nW,7wRBNmh](YT;S9WNsI:?*<pC^$JW%]y6L,].[wu>z/_9X@&/_+KJ@WUL~!TV>');
define('SECURE_AUTH_SALT', '.,)[?%!P[2.5j?_8^GG942eIVQMdJ{ZlDJ!`umee|${2~+(4,,`}[?eM.=_Z6B7I');
define('LOGGED_IN_SALT',   'uUxK>t3+g;>N]dhRxC^mGJcK!4o+Efu*i?>]Mq3u1=xO%/A?b,Ud~ef: GhK9JLA');
define('NONCE_SALT',       'pJfjh8RU_U]-mN1+C@f*f5gf)U<*Bk%*=59N_v*%~@r4k>4Z.P/9-=;m8o64ZmmX');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * Custom Settings
 */

// Claude API Key
define('CLAUDE_API_KEY', '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');

// Debug instellingen
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

// Error logging configuratie
$debug_log_path = __DIR__ . '/wp-content/debug.log';
if (!file_exists($debug_log_path)) {
    touch($debug_log_path);
    chmod($debug_log_path, 0666);
}

// PHP error settings
ini_set('log_errors', 1);
ini_set('error_log', $debug_log_path);
error_reporting(E_ALL);
@ini_set('display_errors', 0);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';