<?php
/**
 * Bootstraps Twig Extensions and Functions.
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

use Studiometa\Managers\ManagerInterface;

/** Class */
class TwigManager implements ManagerInterface {
	/**
	 * @inheritDoc
	 */
	public function run() {
		add_filter( 'timber/twig', array( $this, 'add_twig_template_from_string' ) );
	}

	/**
	 * Adds template_from_string to Twig.
	 *
	 * @link https://twig.symfony.com/doc/2.x/functions/template_from_string.html
	 * @param \Twig\Environment $twig The Twig environment.
	 * @return \Twig\Environment
	 */
	public function add_twig_template_from_string( \Twig\Environment $twig ) {
		$twig->addExtension( new \Twig\Extension\StringLoaderExtension() );
		return $twig;
	}
}
