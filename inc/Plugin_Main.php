<?php
/**
 * Plugin File: AM API
 * Description: This plugin will show related random posts under each post.
 *
 * @package wordpress-plugin
 * @since 1.0
 */

namespace HasanMiusage;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin_Main Class
 */
final class Plugin_Main {
	use Traits\Singleton, Traits\PluginData; // Use the Singleton and PluginData trait.

	/**
	 * Class constructor (private to enforce singleton pattern).
	 *
	 * @return void
	 */
	private function __construct() {
		// All the initialization tasks.
		$this->register_hooks();
	}

	/**
	 * Initialize classes to the plugin.
	 * This method will run after the plugins_loaded action has been fired.
	 * This is a good place to include files and instantiate classes.
	 * This method is called by the register_hooks method.
	 *
	 * @return void
	 */
	public function init_plugin() {
		// Defining plugin constants.
		$this->define_constants();
		Vite::get_instance();
		Admin_Page::get_instance();
		AM_API_Block::get_instance();
	}

	/**
	 * Register hooks and do other setup tasks.
	 */
	private function register_hooks() {
		register_activation_hook( AM_API_PLUGIN_FILE, array( $this, 'plugin_activation' ) );
		register_deactivation_hook( AM_API_PLUGIN_FILE, array( $this, 'plugin_deactivation' ) );

		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
	}

	/**
	 * Function to define all constants.
	 */
	private function define_constants() {
		// This AM_API_PLUGIN_VERSION constant is defined 'PLUGIN_VERSION' property of the PluginMain class.
		if ( ! defined( 'AM_API_PLUGIN_VERSION' ) ) {
			define( 'AM_API_PLUGIN_VERSION', self::get_data( 'Version' ) );
		}

		// It is defined as the plugin directory path without the trailing slash.
		if ( ! defined( 'AM_API_PLUGIN_PATH' ) ) {
			define( 'AM_API_PLUGIN_PATH', untrailingslashit( plugin_dir_path( AM_API_PLUGIN_FILE ) ) );
		}

		// AM_API_PLUGIN_URL is defined as the URL for the plugin directory.
		if ( ! defined( 'AM_API_PLUGIN_URL' ) ) {
			define( 'AM_API_PLUGIN_URL', untrailingslashit( plugin_dir_url( AM_API_PLUGIN_FILE ) ) );
		}

		// AM_API_PLUGIN_ASSETS is the URL for the assets directory of the Learn Plugin.
		if ( ! defined( 'AM_API_PLUGIN_ASSETS' ) ) {
			define( 'AM_API_PLUGIN_ASSETS', AM_API_PLUGIN_URL . '/assets' );
		}
	}

	/**
	 * Run code when the plugin is activated
	 */
	public function plugin_activation() {

		if ( false === get_option( 'amapi_plugin_installed' ) ) {
			// Add option data to the database.
			\HasanMiusage\Miusage_Api::get_instance()->amapi_request_api_activate();
		}

		$installed = get_option( 'amapi_plugin_installed' ); // check if the plugin is already installed.

		if ( ! $installed ) {
			update_option( 'amapi_plugin_installed', time() );
		}

		update_option( 'amapi_plugin_version', self::get_data( 'Version' ) );
	}
	/**
	 * Run code when the plugin is activated
	 */
	public function plugin_deactivation() {
		// Clear any option or temp data.
		delete_option( 'amapi_miusage_date' );
		delete_option( 'amapi_miusage_data' );
		delete_option( 'amapi_plugin_installed' );
		delete_option( 'amapi_plugin_version' );
	}
}
