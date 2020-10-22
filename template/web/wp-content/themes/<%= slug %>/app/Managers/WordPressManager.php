<?php
/**
 * Altering default WordPress.
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

/** Class **/
class WordPressManager {

	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'wp_head', array( $this, 'add_no_index' ), 10 );
	}

	/**
	 * Do not index non-production sites
	 *
	 * @return void
	 */
	public function add_no_index() {
		if ( getenv( 'APP_ENV' ) === 'production' ) {
			return;
		}

		echo '<!-- Do not index non-production site -->';
		echo "<meta name='robots' content='noindex,nofollow' />\n";
	}
}
