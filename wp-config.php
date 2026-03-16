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

// ** MySQL settings - Docker Configuration ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fwf_wordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'fwf_wordpress_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'FwfPassword2026' );

/** MySQL hostname - Docker container name */
define( 'DB_HOST', 'db:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * WordPress Site URL Configuration
 * These settings override the database values to ensure correct URL is used
 */
//define( 'WP_HOME', 'http://localhost:8080' );
//define( 'WP_SITEURL', 'http://localhost:8080' );
define( 'WP_HOME', 'https://fullwell.biz' );
define( 'WP_SITEURL', 'https://fullwell.biz' );


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'CJu{9(.[b0/(|(}pqx|+xr?W:A_Bf.nH<&f==aqK,o:|4d9P8J3bt-2B|nwaJ:65' );
define( 'SECURE_AUTH_KEY',  'o0Vwh8j4Mw2owtwR2D.sFOY.r^l*IPyLee1&sDR9;>juz/vWU*R7nXl{aY(B=`(!' );
define( 'LOGGED_IN_KEY',    'kl7MzjerI:e_))e1yxUkH&nkFjYsAu41CSIvg2R^`G2Mj,l|b#vD`mEBBC>I0Et9' );
define( 'NONCE_KEY',        'cZkk#xd+m~}x/~_s~j3F_[yeo2y#Txy:6)^{5X.X@$.b`/1q_}]%r?pB[|;Y//03' );
define( 'AUTH_SALT',        'XUG)01y9 78NzvU|zT4Q {0}r/`}ea[WV2yH=FY=ZO#Iebq^*+w@^)HoRXnKM;[+' );
define( 'SECURE_AUTH_SALT', '*I!x8;Y-Z7>I+AG=DBpB0_&vUZ|pFpuFwwpb#,Rr8(_5yh.%;PqhsINPQ3gS!/qv' );
define( 'LOGGED_IN_SALT',   '%/Szfg/o0:L^J66T7zlL$_@O5mX|xMkBw1WQTGzH4T=}R2(](m 5ZO9.MdR>#VyD' );
define( 'NONCE_SALT',       'r|V3E!+qJ]tqf`WFY$/sO^+i%}(-z%(7quOrBD_T$o? @fy9.T%zp$!Tvp_6eKV9' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'snl77_';

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
