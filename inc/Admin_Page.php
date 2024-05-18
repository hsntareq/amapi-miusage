<?php
/**
 * Admin Page.
 *
 * @package wordpress-plugin
 */

namespace HasanMiusage;

use HasanMiusage\Vite;

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
		if ( isset( $_GET['page'] ) && 'hasan-miusage' === $_GET['page'] ) { // phpcs:ignore
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
		add_menu_page( __( 'Hasan Miusage' ), __( 'Hasan Miusage' ), 'manage_options', 'hasan-miusage', array( $this, 'admin_page' ), 'dashicons-database', 10 );
	}

	/**
	 * Admin page.
	 *
	 * @return void
	 */
	public function admin_page() {
		// Get the data from the options table and set variables for view.
		$miusage_option_data  = get_option( 'hasan_miusage_data' );
		$table_title          = $miusage_option_data ? $miusage_option_data['title'] : '';
		$table_time           = get_option( 'hasan_miusage_date' );
		$headers              = $miusage_option_data['data']['headers'];
		$rows                 = $miusage_option_data['data']['rows'];
		$transient_timestamp  = get_transient( 'timeout_amapi_data_loaded' );
		$available_time       = ( false === $transient_timestamp ) ? 'false' : 'true';
		$transient_timestamp  = ( $transient_timestamp - time() ) < 0 ? 0 : $transient_timestamp;
		$transient_timeout    = 'amapi_timeout_by';
		$is_ajax_allowed      = (bool) get_transient( $transient_timeout );
		$miusage_data_timeout = get_option( '_transient_timeout_' . $transient_timeout );

		// Render the admin page view.
		self::render( 'awesome-table', compact( 'miusage_option_data', 'table_title', 'headers', 'rows' ) );
	}
}
