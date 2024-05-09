<?php
/**
 * Admin Page.
 *
 * @package wordpress-plugin
 */

namespace AmMiusage;

/**
 * Admin Page.
 */
class Admin_Page {
	use Traits\Singleton, Traits\Render;

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
		// add_action( 'wp_ajax_monthly_calendar_data', array( $this, 'monthly_calendar_data' ) ); // .
		// add_action( 'wp_ajax_nopriv_monthly_calendar_data', array( $this, 'monthly_calendar_data' ) ); // .
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
