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


	/**
	 * Miusage reset key.
	 *
	 * @var string
	 */
	private $transient_timeout = 'amapi_timeout_by';
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
		$is_ajax_allowed = (bool) get_transient( $this->transient_timeout );
		$miusage_data_timeout = get_option( '_transient_timeout_' . $this->transient_timeout );
		$miusage_option_data = get_option( 'amapi_miusage_data' );
		// $this->amapi_get_miusage_data();

		// wp_send_json_error( true === $miusage_data );.
		if ( true !== $is_ajax_allowed ) {
			$this->amapi_get_miusage_data();
		}

		$data = array(
			'data' => null,
			'message' => 'Data not found',
		);
		wp_send_json_error( $data );

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
		$response = json_decode( wp_remote_retrieve_body( $response ), __return_true() );

		foreach ( $response['data']['rows'] as &$row ) {
			$row['date'] = gmdate( 'Y-m-d h:i:s', $row['date'] );
		}

		set_transient( $this->transient_timeout, __return_true(), 10 ); // MINUTE_IN_SECONDS.
		update_option( 'amapi_miusage_data', wp_remote_retrieve_body( $response ) );

		$response['message'] = 'Data refreshed successfully!';
		wp_send_json_success( $response );
	}


}
