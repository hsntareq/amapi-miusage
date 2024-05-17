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
	use Traits\Singleton, Traits\PluginData; // Use the Singleton and PluginData trait.

	/**
	 * Miusage reset key.
	 *
	 * @var string
	 */
	private $amapi_option_key = 'amapi_miusage_data';

	/**
	 * Miusage post date key.
	 *
	 * @var string
	 */
	private $amapi_option_date_key = 'amapi_miusage_date';

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
		add_action( 'wp_ajax_amapi_retrive_data', array( $this, 'amapi_retrive_data' ) );
		add_action( 'wp_ajax_nopriv_amapi_retrive_data', array( $this, 'amapi_retrive_data' ) );

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			\WP_CLI::add_command( 'amapi refresh', array( $this, 'amapi_wp_cli_refresh_data' ) );
		}

	}

	/**
	 * Retrieve the data.
	 *
	 * @return array|string
	 */
	public function amapi_retrive_data() {
		$api_data = get_option( $this->amapi_option_key );

		if ( ! $api_data ) {
			return '';
		}

		wp_send_json_success( $api_data );

	}

	/**
	 * Refresh the data.
	 */
	public function amapi_refresh_data() {
		$is_ajax_allowed      = (bool) get_transient( $this->transient_timeout );
		$miusage_data_timeout = get_option( '_transient_timeout_' . $this->transient_timeout );

		// Return if current user does not have permission and nonce is not correct.
		if ( ! current_user_can( 'manage_options' ) || ! check_ajax_referer( 'amapi-nonce', 'nonce', false ) ) {
			wp_send_json_error( 'Unauthorized access!' );
		}

		$_post = self::sanitize_array( $_POST );

		$is_time  = get_transient( $this->transient_timeout );
		$is_event = json_decode( wp_unslash( $_post['data'] ), true )['is_event'];

		if ( false === $is_ajax_allowed && true === $is_event ) {
			$this->amapi_request_api();
		}

		$data = array(
			'data'      => ! $is_ajax_allowed,
			'remaining' => self::convert_to_hms( $miusage_data_timeout ),
			'message'   => __( 'Data refresh will be possible once the countdown is complete.', 'am-miusage' ),
		);

		wp_send_json_error( $data );
	}

	/**
	 * WP_CLI Refresh the data.
	 *
	 * @return bool|void
	 */
	public function amapi_wp_cli_refresh_data() {

		if ( true === $this->amapi_request_api() ) {
			\WP_CLI::success( __( 'Miusage data refreshed successfully!', 'am-miusage' ) );
			return null;
		}

		\WP_CLI::error( __( 'Failed to refresh data from server!', 'am-miusage' ) );
		return null;
	}

	/**
	 * Refresh the data.
	 *
	 * @return bool|void
	 */
	private function amapi_request_api() {

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

		set_transient( $this->transient_timeout, __return_true(), HOUR_IN_SECONDS ); // Set the transient.

		update_option( $this->amapi_option_key, $response ); // Update the option.
		update_option( $this->amapi_option_date_key, gmdate( 'Y-m-d h:i:s', time() ) ); // Update the option.

		$response['message'] = __( 'Data refreshed successfully!', 'am-miusage' ); // Add a message to the response.

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			return true;
		}

		$miusage_data_timeout  = get_option( '_transient_timeout_' . $this->transient_timeout );
		$response['remaining'] = self::convert_to_hms( $miusage_data_timeout );

		wp_send_json_success( $response ); // Return the response.
	}

}
