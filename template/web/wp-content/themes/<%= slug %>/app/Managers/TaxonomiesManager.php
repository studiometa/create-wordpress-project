<?php
/**
 * Bootstrap the custom taxonomies
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

use Studiometa\Managers\ManagerInterface;

/** Class **/
class TaxonomiesManager implements ManagerInterface {
	/**
	 * @inheritDoc
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
