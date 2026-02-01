<?php
/**
 * Vite class file.
 *
 * This class helps integrate Vite assets into your WordPress plugin.
 *
 * @package wordpress-plugin
 */

namespace HasanMiusage;

/**
 * Class Vite
 *
 * @package wordpress-plugin
 */
class Vite {
	use Traits\Singleton;
	use Traits\PluginData;

	/**
	 * Path to the manifest.json file.
	 *
	 * @var string
	 */
	private $manifest_path;

	/**
	 * Vite development server URL (if available).
	 *
	 * @var string|null
	 */
	private $dev_server_url;

	/**
	 * Vite development server URL (if available).
	 *
	 * @var string|null
	 */
	private $dev_server = 'http://localhost:3030';

	/**
	 * Vite constructor.
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Initialize the class.
	 */
	public function init() {
		// Set the path to the manifest.json file.
		$this->manifest_path  = esc_url( AM_API_PLUGIN_PATH . '/assets/dist/.vite/manifest.json' );
		$this->dev_server_url = esc_url( $this->dev_server . '/assets/index.php' ); // Adjust the URL according to your Vite dev server configuration.
		// Add actions to enqueue assets.
		// add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) ); // .
		add_action( 'wp_loaded', array( $this, 'amapi_plugin_notice' ) );

	}

	/**
	 * Check if manifest file exists and show notice to build assets.
	 */
	public function amapi_plugin_notice() {
		if ( ! file_exists( $this->manifest_path ) && ! $this->is_dev_server_running() ) {
			add_action( 'admin_notices', array( $this, 'show_build_assets_notice' ) );
		}
	}

	/**
	 * Show notice to build assets.
	 */
	public function show_build_assets_notice() {
		?>
		<div class="notice notice-warning notice-alt is-dismissible">
			<p><strong><?php esc_html_e( 'Hasan Miusage: ', 'hasan-miusage' ); ?> </strong>
				<?php esc_html_e( 'Please ensure that the Vite assets are built before checking the production version of the AM API plugin. Run ', 'hasan-miusage' ); ?>
				<code><?php esc_attr_e( 'npm run build', 'hasan-miusage' ); ?></code>
				<?php esc_html_e( 'to build the assets.', 'hasan-miusage' ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Enqueue assets.
	 */
	public function enqueue_assets() {

		if ( $this->is_dev_server_running() ) {
			// Enqueue assets from Vite dev server.
			$this->enqueue_dev_assets();
		} else {
			// Enqueue production assets.
			$this->enqueue_prod_assets();
		}

		wp_localize_script(
			'amapi-admin-script',
			'amapi_data',
			self::get_localize()
		);
	}

	/**
	 * Check if the Vite development server is reachable.
	 *
	 * @return bool True if reachable, false otherwise.
	 */
	public function is_dev_server_running() {
		// Check if the Vite development server is reachable.
		$response = wp_remote_get( $this->dev_server_url );
		if ( is_array( $response ) && ! is_wp_error( $response ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Enqueue development assets from Vite dev server.
	 */
	private function enqueue_dev_assets() {
		if ( $this->is_dev_server_running() ) {
			wp_enqueue_script( 'amapi-admin-script', $this->dev_server . '/src/assets-src/js/admin.js', array( 'jquery' ), self::get_data( 'Version' ), true );
			// Add type="module" attribute to the script tag.
			add_filter( 'script_loader_tag', array( $this, 'add_module_type_to_script' ), 10, 3 );
		}
	}

	/**
	 * Add type="module" to development scripts.
	 *
	 * @param mixed $tag tag.
	 * @param mixed $handle handle.
	 * @param mixed $src src.
	 *
	 * @return string|void
	 */
	public function add_module_type_to_script( $tag, $handle, $src ) {
		if ( in_array( $handle, array( 'amapi-admin-script' ), true ) ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}
		return $tag;
	}

	/**
	 * Enqueue production assets.
	 */
	private function enqueue_prod_assets() {
		// Get the manifest data.
		$manifest_data = $this->get_manifest_data();

		if ( $manifest_data ) {
			// Enqueue CSS and JS assets.
			$this->enqueue_css();
			$this->enqueue_js();
		}
	}

	/**
	 * Get the manifest data.
	 *
	 * @return array|false
	 */
	private function get_manifest_data() {
		// Read the manifest.json file.
		if ( file_exists( $this->manifest_path ) ) {
			$manifest_data = file_get_contents( $this->manifest_path ); // phpcs:ignore

			// Decode JSON data.
			$manifest_data = json_decode( $manifest_data, true );

			return $manifest_data;
		}

		return false;
	}

	/**
	 * Enqueue CSS assets.
	 */
	private function enqueue_css() {
		wp_enqueue_style( 'vite-admin-style', AM_API_PLUGIN_URL . '/assets/dist/admin.css', array(), self::get_data( 'Version' ) );
	}

	/**
	 * Enqueue JS assets.
	 */
	private function enqueue_js() {
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'amapi-admin-script', AM_API_PLUGIN_URL . '/assets/dist/admin.js', array( 'jquery' ), self::get_data( 'Version' ), true );
	}
}
