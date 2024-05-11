<?php
/**
 * Miusage_Api class.
 */

namespace AmMiusage;

/**
 * Miusage_Api class.
 */
class Miusage_Api {
	use Traits\Singleton, Traits\PluginData;


	private $miusage_reset_key = 'amapi_timeout_in';
	/**
	 * Miusage_Api constructor.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialize the class.
	 */
	public function init() {
		add_action( 'wp_ajax_amapi_refresh_data', array( $this, 'amapi_refresh_data' ) );
		add_action( 'wp_ajax_nopriv_amapi_refresh_data', array( $this, 'amapi_refresh_data' ) );
	}

	/**
	 * Refresh the data.
	 */
	public function amapi_refresh_data() {
		$get_data = get_transient( get_option( '_transient_timeout_' . $this->miusage_reset_key ) );
		$option_data = get_option( 'amapi_miusage_data' );
		// pr( $get_data );
		wp_send_json_success( $option_data );

		$this->amapi_get_miusage_data();
		// if ( $get_data ) {
		// }
		// wp_send_json_error( \WP_Error( 'error', 'Data not found' ) );
	}

	/**
	 * Refresh the data.
	 */
	public function amapi_get_miusage_data() {

		// Return if current user does not have permission and nonce is not correct.
		if ( ! current_user_can( 'manage_options' ) || ! check_ajax_referer( 'amapi-nonce', 'nonce', false ) ) {
			wp_send_json_error( 'Unauthorized access!' );
		}

		$_post = self::sanitize_array( $_POST );
		$api_url = 'https://miusage.com/v1/challenge/1/';
		$response = wp_remote_get( $api_url );

		if ( is_wp_error( $response ) ) {
			wp_send_json_error( $response->get_error_message() );
		}

		set_transient( $this->miusage_reset_key, __return_true(), MINUTE_IN_SECONDS );

		update_option( 'amapi_miusage_data', wp_remote_retrieve_body( $response ) );

		wp_send_json_success( wp_remote_retrieve_body( $response ) );
	}


}
