<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'banco' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'A>wJ-ZE.%x+sEZMab7$#Rd8+VM/ewHqIILxY[!oBG0^k!qam2`kDj #%k%2!?I$z' );
define( 'SECURE_AUTH_KEY',  'W6Hy3>[%]h6X%sk32BHNj7XRJ!`|I(26/cq^5z ??xOCjl31`sn*Rv:VtoZ+C&i]' );
define( 'LOGGED_IN_KEY',    '`*^9,y7* 5$Z5~-=.Yq~uB{-IJ)ZAAXCln[~)as 6Y}qp*$@C?;P?GBz&lwT+@/x' );
define( 'NONCE_KEY',        '~.K%J_@:BM9Fb1gwAM2*h[wKZO+nD/n2}ViW}<DK+NEeoS/D28XaCy!^*rTM7|oC' );
define( 'AUTH_SALT',        'aB8^R( ~KK&GWVBl1lJnf2xzk&7Ur1T3UG]qGW{<(O_[.Bz.{<UlN&-{]A(=8}yu' );
define( 'SECURE_AUTH_SALT', '*2eL5.(H^733@9mZhq<]RIlDOr$Tm-T)M](Sxq3PZzjqM1)C:`Qd&dE_{y7~`bJu' );
define( 'LOGGED_IN_SALT',   'yB-ZA*4^;>HN&LdZeSz|9-^I2Jo#A4k<uqKTm:giSx8x,,|PucG~_g@Fwn>tWKP8' );
define( 'NONCE_SALT',       '(d)&hQJDwpV%=I+7ML_iH&V@|}~$R<HnKgNG |@>2HDk@!a7(k[5CvFd#KeGFoLl' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
