<?php
/**
 * Bootstrap the Managers.
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

/** Class **/
class ManagerFactory {
	/**
	 * Init managers
	 *
	 * @param array $managers to init.
	 * @return void
	 */
	static public function init( array $managers ) {
		foreach ( $managers as $manager ) {
			$manager->run();
		}
	}
}
