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
define( 'DB_NAME', 'grtmx_wp666' );

/** MySQL database username */
define( 'DB_USER', 'grtmx_wp666' );

/** MySQL database password */
define( 'DB_PASSWORD', ')1S3RH0p.C' );

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
define( 'AUTH_KEY',         '7dossfnygcclhyg85rsvlemdwisy0g8paxlxpipddrsd2o9kfjzsyinkjs2qru4v' );
define( 'SECURE_AUTH_KEY',  'k2ktoahoesphio82rwurebriqpjafiq2fdlmycdfivofmq3ixo4vq3ltzubqanju' );
define( 'LOGGED_IN_KEY',    'byscb0thbugrcgekyelfnmzlabrx1jwkwmvepb0yovvgp7re3bid1fqhbcd7pcc0' );
define( 'NONCE_KEY',        'zvg9rhqyy2abolbl5o9hhvjxk0yb0yjuplfogcvcsjfwk2vflpepd7tkdpih9pmw' );
define( 'AUTH_SALT',        '6tnxzbnko6z7kxouzemawife7c1u0axbofllqswnuliv2bpdeqripeeink5onk3o' );
define( 'SECURE_AUTH_SALT', 'qm8xc5xjpldgkzwfrxhdsvr0kqjpp6dec012c6sjblaxddwy6l3v4zfysmbpwiso' );
define( 'LOGGED_IN_SALT',   'fv95zbuq4dp9vnuxvizoiwzcebty8b1g7z4hil8stk5rpdhrhunrydzricqbnula' );
define( 'NONCE_SALT',       'wgwby2u2g3d5nwkadk0jwprdeywsajvihw6iwy2ogsm0tigl4gxh8kywd90zusnc' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpmm_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
