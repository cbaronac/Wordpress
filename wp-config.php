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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'telematica' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'u{*pi|[v,_.M91?>xb,FGCv(A5Snxu#W2pTQB:kmcnh.XP6vV,U#PO5VQ ^GWF^#' );
define( 'SECURE_AUTH_KEY',  'A`}p58(QQPWKJ7B;6&O?19f{m^i Z,r#E:z95NJ8OjIGBh+hw 5*CzC9zzi!*t9Y' );
define( 'LOGGED_IN_KEY',    't_q}Nn,X-st^PCbZ:vu2$koEmcCD7R}87j&=A~P:~/A]eYsGtbSi1rYvz*M]_BVU' );
define( 'NONCE_KEY',        '{$5NFflV*(198^rzcPLDy1_D1/gMLE[^q$)pjhLAW3E7y~VaH350^t hBeJEED[+' );
define( 'AUTH_SALT',        '{>6nWf6tEUanb:.N3Ld^2uoJq._eZ,P.[3B5m4EUay.}{apswd=PBphQAzvW(Eu/' );
define( 'SECURE_AUTH_SALT', ';dO_CcXcXY [j+g}kDSby.R!ALI`_w7n4t[cPdNd(.uWDtFydOi,NUz1}S9`+oqt' );
define( 'LOGGED_IN_SALT',   '+onEz=lWjT@FrY1QoldakaZ7+x][{P*K~fA$zpN7tvQG V.-rtJ,SwD!+rIgRX*v' );
define( 'NONCE_SALT',       'hNl!{Ga oWgm-s[0@h#i62J[JY_N/L.C1bdr}Btv;X*X<V-]bQatPY^`#4h~^WM/' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
