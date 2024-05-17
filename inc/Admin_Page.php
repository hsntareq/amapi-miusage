<?php
/**
 * Admin Page.
 *
 * @package wordpress-plugin
 */

namespace AmMiusage;

use AmMiusage\Vite;

/**
 * Admin Page.
 */
class Admin_Page {
	use Traits\Singleton, Traits\Render; // Use the Singleton and Render trait.

	/**
	 * $instance
	 *
	 * @var null
	 */
	private static $instance = null;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		$this->init();
		Miusage_Api::get_instance();
	}

	/**
	 * Initialize the class.
	 *
	 * @return void
	 */
	public function init() {
		// Add admin assets if the current page is the plugin admin page.
		if ( isset( $_GET['page'] ) && 'am-miusage' === $_GET['page'] ) { // phpcs:ignore
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_vite_assets' ) );
		}
	}

	/**
	 * Enqueue Vite assets.
	 *
	 * @return void
	 */
	public function enqueue_vite_assets() {
		// Accessing the enqueue_assets method from the Vite class.
		Vite::get_instance()->enqueue_assets();
	}

	/**
	 * Add admin menu.
	 *
	 * @return void
	 */
	public function add_admin_menu() {
		add_menu_page( __( 'AM Miusage' ), __( 'AM Miusage' ), 'manage_options', 'am-miusage', array( $this, 'admin_page' ), 'dashicons-database', 10 );
	}

	/**
	 * Admin page.
	 *
	 * @return void
	 */
	public function admin_page() {

		self::render( 'awesome-table' );
	}
}
