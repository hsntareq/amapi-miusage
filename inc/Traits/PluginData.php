<?php
/**
 * Traits of the plugin.
 *
 * @package wordpress-plugin
 */

namespace AmMiusage\Traits;

trait PluginData {
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {

	}



	/**
	 * Get the plugin version.
	 *
	 * @return string|array
	 */
	public static function get_localize() {
		return array(
			'ajaxurl'        => admin_url( 'admin-ajax.php' ),
			'nonce'          => wp_create_nonce( 'amapi-nonce' ),
			'loading'        => esc_url( includes_url() . 'js/tinymce/skins/lightgray/img//loader.gif' ),
			'loading_inline' => esc_url( includes_url() . 'js/thickbox/loadingAnimation.gif' ),
		);
	}

	/**
	 * Sanitize an array.
	 *
	 * @param mixed $array array.
	 *
	 * @return array
	 */
	public function sanitize_array( $array ) {
		// Recursive sanitization of an array using sanitize_text_field.
		$sanitized_array = array_map(
			function ( $value ) {
				return is_array( $value ) ? $this->sanitize_array( $value ) : sanitize_text_field( $value );
			},
			$array
		);

		return $sanitized_array;
	}

	/**
	 * Convert the time to hours, minutes, and seconds.
	 *
	 * @param mixed $timestamp timeString.
	 *
	 * @return string
	 */
	public function convert_to_hms( $timestamp ) {
		// Get current Unix timestamp.
		$current_time = time();

		// Calculate the difference in seconds.
		$difference_in_seconds = $timestamp - $current_time;

		// Calculate remaining hours, minutes, and seconds.
		$remaining_hours   = floor( $difference_in_seconds / 3600 ); // Calculate remaining hours.
		$remaining_minutes = floor( ( $difference_in_seconds % 3600 ) / 60 ); // Calculate remaining minutes.
		$remaining_seconds = $difference_in_seconds % 60; // Calculate remaining seconds.

		// Format the remaining time.
		$formatted_time = sprintf( '%02d:%02d:%02d', $remaining_hours, $remaining_minutes, $remaining_seconds );

		// Return formatted remaining time.
		return $formatted_time;
	}


	/**
	 * Get the plugin version.
	 *
	 * @param string $key key.
	 *
	 * @return string|array
	 */
	public static function get_data( $key = '' ) {
		if ( ! function_exists( 'get_plugin_data' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		return ( ! empty( $key ) ) ? get_plugin_data( AM_API_PLUGIN_FILE )[ $key ] : get_plugin_data( AM_API_PLUGIN_FILE );
	}

	/**
	 * Get the plugin version.
	 *
	 * @return string
	 */
	public static function get_version() {
		return self::get_data( 'Version' );
	}

	/**
	 * Get the plugin name.
	 *
	 * @return string
	 */
	public static function get_name() {
		return self::get_data( 'Name' );
	}

	/**
	 * Get the plugin description.
	 *
	 * @return string
	 */
	public static function get_description() {
		return self::get_data( 'Description' );
	}

	/**
	 * Get the plugin author.
	 *
	 * @return string
	 */
	public static function get_author() {
		return self::get_data( 'Author' );
	}

	/**
	 * Get the plugin author uri.
	 *
	 * @return string
	 */
	public static function get_author_uri() {
		return self::get_data( 'AuthorURI' );
	}

	/**
	 * Get the plugin text domain.
	 *
	 * @return string
	 */
	public static function get_text_domain() {
		return self::get_data( 'TextDomain' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_plugin_uri() {
		return self::get_data( 'PluginURI' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_php_version() {
		return self::get_data( 'RequiresPHP' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_wp_version() {
		return self::get_data( 'RequiresWP' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_license() {
		return self::get_data( 'License' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_license_uri() {
		return self::get_data( 'LicenseURI' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_domain_path() {
		return self::get_data( 'DomainPath' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_network() {
		return self::get_data( 'Network' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_title() {
		return self::get_data( 'Title' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_author_name() {
		return self::get_data( 'AuthorName' );
	}

	/**
	 * Get the plugin uri.
	 *
	 * @return string
	 */
	public static function get_author_email() {
		return self::get_data( 'AuthorEmail' );
	}
}
