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
define( 'DB_NAME', 'b6_24828926_wp501' );

/** MySQL database username */
define( 'DB_USER', '24828926_1' );

/** MySQL database password */
define( 'DB_PASSWORD', 'p0rBS0.-85' );

/** MySQL hostname */
define( 'DB_HOST', 'sql103.byetcluster.com' );

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
define( 'AUTH_KEY',         's7ve5uhugfsa30rsscogxbcr177mwgelyyzfp5kl8pecgqaguybhpwsd4djtpen1' );
define( 'SECURE_AUTH_KEY',  '3fukf4quejaokqipzxituek5yon0lonr01c6aqfplp0l5dhu0m72nbzjqi2vxblu' );
define( 'LOGGED_IN_KEY',    'vsj3b6f2zsyiubkleal7cb8nkbrtktkcgkf8lb3ch5vain2mefupec52ic45qesj' );
define( 'NONCE_KEY',        'eqkyrctkzjhppcwxfpyir0nttwymssfqp4jxv3jz8uaoe027j4g139ca4j96s4jj' );
define( 'AUTH_SALT',        'fv0ow22gxhkq3n2ygvrkcbwixyr74srghcyfztcqqjnmqupzj9ihudhqhamctkrk' );
define( 'SECURE_AUTH_SALT', 'ppyirydjklgjz4njiovaxutcvi3txmfatqaaywblwkf5ehxxjacwqbhddyapopc5' );
define( 'LOGGED_IN_SALT',   'roo6kclwuzczpqiuzixqbs3qcsscnooggf83btmiruztbycd7rdytujzeyrlg3te' );
define( 'NONCE_SALT',       '1xa9pysmhfftfrgvkbj7ivkikecdmdmmwtqo7puhv0zhv7iqgiobri4jwvth1e06' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpa2_';

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
