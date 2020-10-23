<?php
/**
 * Interface for Managers
 */
namespace Studiometa\Managers;

/** Interface **/
interface ManagerInterface {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run();
}
