<?php
/**
 * Plugin Name: Hasan Miusage
 * Plugin URI: https://www.hasan-miusage.com
 * Version: 1.0.0
 * Author: Hasan Tareq
 * Author URI: https://github.com/hsntareq
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: hasan-miusage
 * Description: This plugin is designed to generate a Gutenberg block that showcases Miusage API data on the front end, while facilitating data management from the back end. Api url: <a target="_blank" href="https://miusage.com/v1/challenge/1" >https://miusage.com/v1/challenge/1</a>
 * Requires at least: 5.8
 * Requires PHP: 7.0
 * Tested up to: 5.8
 * Stable tag: 1.0.0
 *
 * @package wordpress-plugin
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define the plugin file.
if ( ! defined( 'AM_API_PLUGIN_FILE' ) ) {
	define( 'AM_API_PLUGIN_FILE', __FILE__ );
}

// Load Composer autoloader.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * FILEPATH: /wp-content/plugins/hasan-miusage/hasan-miusage.php
 *
 * Initializes the AM API plugin by creating an instance of the PluginMain class.
 *
 * @since 1.0.0
 */
HasanMiusage\Plugin_Main::get_instance();
