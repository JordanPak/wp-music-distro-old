<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'musicdistro-dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '|sGAZ!2lDd;]{%CXVt:N@NJ,P@N<^}G|9C&syh(nH#w8i7QTy+!KUuSwlLHyP%+K');
define('SECURE_AUTH_KEY',  '>@7<3C9#kBy.9xfdD)rn}_ptiK+W$)Ylz>@e]>.+rPv=Xu0,jGa{~uQ&bJ50dufZ');
define('LOGGED_IN_KEY',    '8:l#2C-ky|]S/L~Ei=kc;u:(0F7izq@n&b)?b7vWBG##(@7A<:LrZvH:lEbh5Hg*');
define('NONCE_KEY',        'U yM?O|R^0]Xl~<SCb@c/7T V4h0FAST-WY}1Jklc0$;@|o&`HGemM>4t3gGNYYU');
define('AUTH_SALT',        'hIonL %%M8+|QP|Z.DYI%L[f$wG=.p+.*5tED5AGvE{~wQG!t(Qs|#OaVcL%8v_:');
define('SECURE_AUTH_SALT', 'z+mW`^VU|;2&#UNjn$o<SSG-eG!A1c#5#`u-,n8E2^leYEo T]r%bc|A}uwa_0UO');
define('LOGGED_IN_SALT',   'GP142jr+|imP[^6I?hkV ^6_+<$/Tlv&oL:KRY@8tZJ)uUk !,_^l@$m G+_##o(');
define('NONCE_SALT',       'L%@;;IVG*+L|_a6`z4,yE~v2-&?P`#_/$?FO*%?31hdde+CZV9:mQkv %wTIgCU9');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define( 'WP_AUTO_UPDATE_CORE', true );
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
