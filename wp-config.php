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
define('DB_NAME', 'wp_dev');

/** Database username */
define('DB_USER', 'wp_dev_admin');

/** Database password */
define('DB_PASSWORD', '12345');

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
define('AUTH_KEY', 'xRYcUT8ujo>zxtaHzc0Cw|s>P.kog3En}dvIC/[iigs9[COG(EbQ.{0&rO{,^^K;');
define('SECURE_AUTH_KEY', ' 0y692)3CEkue/? #]4k3{vxKvDT7(RPLj/,7+As0~h7c9H&rS>SAhJv%4fo8Vdg');
define('LOGGED_IN_KEY', '4o[odlQLkRFa^xZxN^4gf8c2 e9pn#45Qihw7K^Icj (X1Mr10(GJOYOb#:|w(^=');
define('NONCE_KEY', '7<du$`dNB%1^o_2[M5J`m/*JLfu99FmS`,{c$sdgaFsYB=lF*Pjn%~hRVeUM?p30');
define('AUTH_SALT', '7*dd4zM.bK<7`ybq`/pBKi.J>wg<q@>p(doc G&,TS(hY}MN?5:^fSekx#Gb0U%=');
define('SECURE_AUTH_SALT', 'Z,9(A5~/acf[(q&`hL $y0B=J;ubH~i^,kkDzCs0O^%S_*ChZg}~=rZWKj:@OzFp');
define('LOGGED_IN_SALT', 'Fh#A|TsgPMF4>uhh+qE]yw_pZ+;q563ZaWhE!<Te1)c,IPmt/3.3x#P ov[u0aGp');
define('NONCE_SALT', 'yqzI>A^|/o9sT2g_ $Bs/~.hY3SS[08)Un^p3vA+b?q33{Ge [I%T*@cg+a8((J9');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
