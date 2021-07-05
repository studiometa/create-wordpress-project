<?php
/**
 * Display maintenance page when maintenace is enabled.
 *
 * @package    studiometa/create-wordpress-project
 * @author     Studio Meta <agence@studiometa.fr>
 * @copyright  2021 Studio Meta
 * @license    https://opensource.org/licenses/MIT
 * @since      1.0.0
 * @version    1.0.0
 */

/**
 * StudiometaMaintenanceMode class.
 */
class StudiometaMaintenanceMode {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'redirect_to_maintenance' ) );
	}

	/**
	 * Is maintenance?
	 *
	 * @return boolean Is maintenance?
	 */
	protected function is_maintenance_mode() {
		if (
			'true' !== getenv( 'MAINTENANCE_ENABLED' )
			|| is_admin()
			|| current_user_can( 'administrator' )
			|| ! file_exists( __DIR__ . '/maintenance.php' )
			|| 'wp-login.php' === $GLOBALS['pagenow']
		) {
			return false;
		}

		$allowed_ips = explode( ',', getenv( 'MAINTENANCE_IPS' ) );
		$remote_ip   = isset( $_SERVER['REMOTE_ADDR'] ) ? filter_var( wp_unslash( $_SERVER['REMOTE_ADDR'] ), FILTER_VALIDATE_IP ) : false;

		if ( in_array( $remote_ip, $allowed_ips, true ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Redirect to maintenance mode.
	 *
	 * @return void
	 */
	public function redirect_to_maintenance() {
		if ( ! $this->is_maintenance_mode() ) {
			return;
		}

		$protocol = isset( $_SERVER['SERVER_PROTOCOL'] ) && 'HTTP/1.1' === $_SERVER['SERVER_PROTOCOL'] ? 'HTTP/1.1' : 'HTTP/1.0';

		header( $protocol . ' 503 Service Unavailable', true, 503 );
		header( 'Retry-After: 3600' );
		include_once __DIR__ . '/maintenance.php';
		die();
	}
}

new StudiometaMaintenanceMode();
