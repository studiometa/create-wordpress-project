<?php
/**
 * Bootstrap the custom post types.
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

/** Class **/
class CustomPostTypesManager {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_custom_post_types '), 1 );
	}

	/**
	 * Register custom post types.
	 *
	 * @todo use Studiometa\WP_Factory
	 * @return void
	 */
	public function register_custom_post_types() {

	}
}
