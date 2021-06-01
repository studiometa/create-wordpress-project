<?php
/**
 * Bootstraps enqueuing javascript and styles.
 *
 * @package Studiometa
 * @link https://github.com/studiometa/wp-assets
 */

namespace Studiometa\Managers;

use Studiometa\Managers\ManagerInterface;
use Studiometa\WP\Assets;

/** Class */
class AssetsManager implements ManagerInterface {
	/**
	 * {@inheritdoc}
	 */
	public function run() {
		new Assets( get_template_directory() );
	}
}
