<?php
/**
 * Bootstrap the custom taxonomies
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

/** Class **/
class TaxonomiesManager {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_taxonomies '), 1 );
	}

	/**
	 * Register custom taxonomies.
	 *
	 * @todo use Studiometa\WP_Factory
	 * @return void
	 */
	public function register_taxonomies() {

	}
}
