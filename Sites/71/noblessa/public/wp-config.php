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
define( 'DB_NAME', 'noblessa_dev' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '040506' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '3V4bHR3Mn3hELj4)D5/:*0j+H5KctMbouHXs+%4C:+rbdp1a_2rjzt-4em[-~357');
define('SECURE_AUTH_KEY', '@BEB;ZKSEFI1;-%)TJ5/K+x25yN_7eDlW4tB8Ypn1%y3]/_WI0%&%PT91#We;uc8');
define('LOGGED_IN_KEY', 'oSa(C7#-9WrfGWfSj68j(&_O20!7B+Duy20*F20-27h)3uumH*BDCaK[aCn9Clf3');
define('NONCE_KEY', 'u~93h3+HP/7c6Pc2ROLU76M([TdT7L[6E4yip*zT4RYC_b7KSL14el1&F:-#UZ1r');
define('AUTH_SALT', 'gne%2R3m4489(aQXydf25Jh*H_@Bj23438-c0%6QSzYJ*T@R28;8pl)950BO04CG');
define('SECURE_AUTH_SALT', 'lw7h(l0h)K0-GP3Z7XjCO+d7|n941E719l%De60q%9108N)I[a3xHKWU5u-8Av1[');
define('LOGGED_IN_SALT', 'I[2Ys!Aa2J2*T0D]h/u00gd%APeH8Aot]6~PHx8+34h-X2(2Sa|o1%5D#e0RhHQ6');
define('NONCE_SALT', 'zT8IVmU#LpGw2&(6;i[FG3ZTiZ[!I:!utzU6mwQ:2@z0OlL(4D-QW@25E9R8|*-(');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'GCA8x_';


define('WP_ALLOW_MULTISITE', true);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
