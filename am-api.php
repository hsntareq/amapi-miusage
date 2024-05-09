<?php
/**
 * Plugin Name: AM Miusage
 * Plugin URI: https://www.am-miusage.com
 * Version: 1.0.0
 * Author: Hasan Tareq
 * Author URI: https://github.com/hsntareq
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: am-miusage
 * Description: This plugin is designed to generate a Gutenberg block that showcases Miusage API data on the front end, while facilitating data management from the back end. Api url: <a target="_blank" href="https://miusage.com/v1/challenge/1" >https://miusage.com/v1/challenge/1</a>
 *
 * @package wordpress-plugin
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'AM_API_PLUGIN_FILE' ) ) {
	define( 'AM_API_PLUGIN_FILE', __FILE__ );
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * FILEPATH: /wp-content/plugins/related-random-posts/related-random-posts.php
 *
 * Initializes the AM API plugin by creating an instance of the PluginMain class.
 *
 * @since 1.0.0
 */
AmMiusage\Plugin_Main::get_instance();
