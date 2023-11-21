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
define( 'DB_NAME', 'rateck' );

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
define( 'AUTH_KEY',         '>R.z6I?H?Ek0DGj@4BX]{@ciWSQD^J2.1Zf1KPv}{kK+Vd?elEBY.}k[Hp@2||y@' );
define( 'SECURE_AUTH_KEY',  'PGoPU36p[e?1i~?Qx5f$jIIpm]83u+@J16o?F)i}|*DE{5Zqm30kY09^sz6Zc:9)' );
define( 'LOGGED_IN_KEY',    'L]jEFNEF{)4vtBs@1V3O7l!n-g+SKd~Xl_>4G#UZ_>)gzfJs;2Y(VSfab]pw3MJd' );
define( 'NONCE_KEY',        'HIrsaN`,w(HojVn`B8>3G5~$w9<8>1/Rj:8&BUGBUZrR#yM}zxxC=g49wSJyu$VA' );
define( 'AUTH_SALT',        'fGkcx I-:hKGoh(QM:_6Md~MF{#2ck^^xaz4a2aIi6ePa )%y%~aq nYO{K&EUq7' );
define( 'SECURE_AUTH_SALT', 'Tu=p-iW,s;g?]yBi4}Zv@VW@70v~32R5[^QHRWl!%*5:7bGVI{+Nh-zd@]hf#fiE' );
define( 'LOGGED_IN_SALT',   'igkp{`P05TsI<z!>,PT/u|RRP}fKbqTOGP[^d<3R.Gn_#>:Z,+^jr9<UdffX;!}@' );
define( 'NONCE_SALT',       'C754mNJ`^zgc,+ ;;5-}@>[_yzz5dD! RC1nq2Kxt+OZi7r-@Uj6WW@[_Hi}?R8r' );

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
