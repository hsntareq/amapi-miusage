<?php
/**
 * Miusage_Api class.
 *
 * @package wordress-plugin
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
	private $amapi_option_key = 'amapi_miusage_data';

	/**
	 * Transient timeout key.
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
		$is_ajax_allowed      = (bool) get_transient( $this->transient_timeout );
		$miusage_data_timeout = get_option( '_transient_timeout_' . $this->transient_timeout );

		if ( true !== $is_ajax_allowed ) {
			$this->amapi_get_miusage_data();
		}

		$data = array(
			'data'    => null,
			'message' => __( 'You need to wait for ', 'am-miusage' ) . '<u>' . self::convert_to_hms( $miusage_data_timeout ) . '</u> ' . __( ' to refresh the data.', 'am-miusage' ),
		);

		wp_send_json_error( $data );
	}

	/**
	 * Refresh the data.
	 */
	public function amapi_get_miusage_data() {

		// Return if current user does not have permission and nonce is not correct.
		if ( ! current_user_can( 'manage_options' ) || ! check_ajax_referer( 'amapi-nonce', 'nonce', false ) ) {
			wp_send_json_error( 'Unauthorized access!' );
		}

		// Sanitize the post data.
		$_post    = self::sanitize_array( $_POST );
		$response = wp_remote_get( 'https://miusage.com/v1/challenge/1/' );

		// Return if there is an error.
		if ( is_wp_error( $response ) ) {
			wp_send_json_error( $response->get_error_message() ); // Return the error message.
		}

		$response = json_decode( wp_remote_retrieve_body( $response ), __return_true() ); // Decode the response.

		// Update the date format.
		foreach ( $response['data']['rows'] as &$row ) {
			$row['date'] = gmdate( 'Y-m-d h:i:s', $row['date'] ); // Update the date format.
		}

		set_transient( $this->transient_timeout, __return_true(), 10 ); // Set the transient HOUR_IN_SECONDS.

		update_option( $this->amapi_option_key, $response ); // Update the option.

		$response['message'] = __( 'Data refreshed successfully!', 'am-miusage' ); // Add a message to the response.

		wp_send_json_success( $response ); // Return the response.
	}

}
