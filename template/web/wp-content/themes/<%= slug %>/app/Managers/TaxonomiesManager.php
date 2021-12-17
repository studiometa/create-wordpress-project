<?php
/**
 * Bootstrap the custom taxonomies
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

use Studiometa\Managers\ManagerInterface;
use Studiometa\WPToolkit\Builders\TaxonomyBuilder;

/** Class **/
class TaxonomiesManager implements ManagerInterface {
	/**
	 * {@inheritdoc}
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_taxonomies' ), 1 );
	}

	/**
	 * Register custom taxonomies.
	 *
	 * Use TaxonomyBuilder from studiometa/wp-toolkit.
	 *
	 * @see https://github.com/studiometa/wp-toolkit
	 *
	 * @return void
	 */
	public function register_taxonomies() {}
}
