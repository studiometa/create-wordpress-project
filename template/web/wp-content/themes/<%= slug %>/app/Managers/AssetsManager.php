<?php
/**
 * Bootstraps enqueuing javascript and styles.
 *
 * @package Studiometa
 * @link https://github.com/studiometa/wp-assets
 */

namespace Studiometa\Managers;

use Studiometa\Managers\ManagerInterface;

/** Class */
class AssetsManager implements ManagerInterface {
	/**
	 * @inheritDoc
	 */
	public function run() {
		new \Studiometa\WP\Assets( get_template_directory() );
	}
}
