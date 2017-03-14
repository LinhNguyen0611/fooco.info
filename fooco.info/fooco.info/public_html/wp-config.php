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
define('DB_NAME', 'linh_linh');

/** MySQL database username */
define('DB_USER', 'linh_linh');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         ']0#Ak$;%h@jU PALsA_|FCJ[T>QM/Z6k|{#88>Zeu=Xj->(Un,le1Ma*Zs6Q]F?l');
define('SECURE_AUTH_KEY',  ';5BtTmbeiL<A]g3PPsR6q-X>ziV/?=2N<%6VDh3E+Nba*631!pq)hDoC?.ZKq.>^');
define('LOGGED_IN_KEY',    '(>r|%Ohi8c_x<R6}xuYJU/m:}:7bJAO=j.2Wxo*&<QJP=Vup98.n~)F3LZ!1h<U/');
define('NONCE_KEY',        'j|WOs6Pu;FU=jOi;{7k_Omay{D(BA>t5grg:cT>= !J~Q,(xG%!4.cV$<y[+e-Xi');
define('AUTH_SALT',        'dp6--!AR0gC)8{JAU(]5lb6C36#;Z&{;M3hxf]=*O&!]*ry3p#Y!BV.#G$,]e=G+');
define('SECURE_AUTH_SALT', '}IsfU2M^e8Tq=suA1`4f$eROP}iQ;=!um7Lfz,]^m0&sFCA*7H {un^hHD)h,K#,');
define('LOGGED_IN_SALT',   'OdN<B>h-IHx$[kG*>UY=a?plfA[h8rp,h>8ssb2w)!>7#O)U]`UW8u)A;K-:NGKg');
define('NONCE_SALT',       ']:flIFmzs1<&}ZbJ1$<etKT9358G`M8hWkQ2W`4xS=}jj[=fV9|m 5ytN:b^,HO]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
