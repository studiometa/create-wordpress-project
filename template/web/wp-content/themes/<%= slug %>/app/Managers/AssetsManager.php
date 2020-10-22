<?php
/**
 * Bootstraps enqueuing javascript and styles.
 *
 * @package Studiometa
 * @link https://github.com/studiometa/wp-assets
 */

namespace Studiometa\Managers;

/** Class */
class AssetsManager {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		new \Studiometa\WP\Assets( get_template_directory() );
	}
}
