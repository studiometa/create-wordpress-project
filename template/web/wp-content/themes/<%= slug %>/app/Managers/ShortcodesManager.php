<?php
/**
 * Bootstraps WordPress Shortcodes functions
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

use Studiometa\Managers\ManagerInterface;
use Timber\Timber;

/** Class */
class ShortcodesManager implements ManagerInterface {
	// phpcs:ignore Generic.Commenting.DocComment.MissingShort
	/**
	 * @inheritDoc
	 */
	public function run() {
		add_shortcode( 'studiometa_example', array( $this, 'add_example_shortcode' ) );
	}


	/**
	 * Add example shortcode
	 *
	 * @param array $params Shortcode parameters.
	 * @return template
	 *
	 * @example [studiometa_example foo="bar"]
	 */
	public function add_example_shortcode( $params ) {
		// Takes the array keys, sets these as variable.
		$attr = shortcode_atts(
			array(
				'foo'  => __( 'Default foo param value', 'studiometa' ),
			),
			$params
		);

		return Timber::compile(
			'shortcodes/example.twig',
			array(
				'foo'  => $attr['foo'],
			)
		);
	}
}
