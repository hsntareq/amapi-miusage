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
