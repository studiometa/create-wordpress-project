<?php
/**
 * Plugin Name: Studio Meta - Maintenance mode
 * Description: Display maintenance page when maintenace is enabled.
 * Version: 1.0.0
 * Author: Studio Meta
 * Author URI: https://www.studiometa.fr/
 *
 * @package    studiometa/create-wordpress-project
 * @author     Studio Meta <agence@studiometa.fr>
 * @copyright  2021 Studio Meta
 * @license    https://opensource.org/licenses/MIT
 * @version    1.0.0
 */

/**
 * StudiometaMaintenanceMode class.
 */
class StudiometaMaintenanceMode {
	public function __construct() {
		add_action( 'wp_loaded', array( $this, 'toggle_maintenance' ) );
	}

	public function toggle_maintenance() {
		if ( ! $this->is_maintenance_mode() ) {
			return;
		}

		if ( file_exists( WP_CONTENT_DIR . '/maintenance.php' ) ) {
			$protocol = isset( $_SERVER['SERVER_PROTOCOL'] ) && 'HTTP/1.1' === $_SERVER['SERVER_PROTOCOL'] ? 'HTTP/1.1' : 'HTTP/1.0';

			header( $protocol . ' 503 Service Unavailable', true, 503 );
	        require_once WP_CONTENT_DIR . '/maintenance.php';
	        die();
	    }

	    require_once ABSPATH . WPINC . '/functions.php';
	    wp_load_translations_early();

	    wp_die(
	        __( 'Briefly unavailable for scheduled maintenance. Check back in a minute.' ),
	        __( 'Maintenance' ),
	        503
	    );
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
			|| current_user_can( 'manage_options' )
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
}

new StudiometaMaintenanceMode();
