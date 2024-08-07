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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'newuser' );

/** Database password */
define( 'DB_PASSWORD', 'password' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         ',Wb#)KM$Y!s_4xeKq$vO]65/Cwk]2}Gp6>uGP%;w%}=O+cIcCG8f=T>cby[ZfM5<');
define('SECURE_AUTH_KEY',  'D IYD~Pr T9l_A~z_h`m<.b;|@ir}P}WkD9Y7CFc~|_;$#K]Ld7Jvd|zuRb,-+eh');
define('LOGGED_IN_KEY',    'Vd<mA/35VfVi):%*hGTYRRQZX@~Ng0(b_:Dr+gPEKAB9d-v&r]H|7i8^yl-_Bz85');
define('NONCE_KEY',        '?L0F0=S:io2/YN-YZ;#ojn05s5Ygg}!Wwat$S]WtW-Y+Yh*,Z?HV*)bF2+::;=UG');
define('AUTH_SALT',        'O0q7t4b1S-tA: n#C`arl&vqNSTc7yTDB>*0!N2A~L,tJ/+lDapq]nHI+GdCIF;X');
define('SECURE_AUTH_SALT', '#,2O|?m}?>Z-Hw@rB,&E{L[27adkGbhF6)VV~XaQYQO>-D&[RYFKB5w,PRo|AC;Q');
define('LOGGED_IN_SALT',   ';)4uT-.A+1BY_R+ >(O`jyV_tAd;nKyCn!]/+>,[5]-rbt#hAbRg6%#8ogVAqw,w');
define('NONCE_SALT',       'WSD] bE%(ad7*&6e*xK0#+1||[5:v|Ru&]gN}{y>$C*l/@pUGAI@K$=wmQ.+E3yM');


define('WP_ALLOW_REPAIR', true);

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
//define( 'WP_DEBUG_LOG', true );
//define( 'WP_DEBUG_DISPLAY', true );


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
