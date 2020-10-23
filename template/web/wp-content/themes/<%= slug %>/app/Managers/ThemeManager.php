<?php
/**
 * Bootstraps WordPress theme related functions
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

use Timber\Menu;
use Timber\Site;
use Studiometa\Managers\ManagerInterface;

/** Class */
class ThemeManager implements ManagerInterface {
	/**
	 * List of theme managers.
	 *
	 * @var array
	 */
	private $managers = array();

	/**
	 * Constructor
	 *
	 * @param array $managers Array of managers.
	 */
	public function __construct( array $managers ) {
		$this->managers = $managers;

		add_filter( 'timber/context', array( $this, 'add_app_env_to_context' ) );
		add_filter( 'timber/context', array( $this, 'add_site_to_context' ) );
		add_filter( 'timber/context', array( $this, 'add_menus_to_context' ) );
		add_action( 'admin_init', array( $this, 'register_menus' ) );
	}

	/**
	 * @inheritDoc
	 */
	public function run() {
		if ( count( $this->managers ) > 0 ) {
			foreach ( $this->managers as $manager ) {
				$manager->run();
			}
		}

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
	}

	/**
	 * Adds ability to check the environment in a twig file
	 *
	 * @param array $context Timber context.
	 *
	 * @return array
	 */
	public function add_app_env_to_context( array $context ) {
		$context['APP_ENV'] = getenv( 'APP_ENV' );
		return $context;
	}

	/**
	 * Adds the ability to access site informations in a twig file
	 *
	 * @param array $context Timber context.
	 *
	 * @return array
	 */
	public function add_site_to_context( array $context ) {
		$context['site'] = new Site();

		return $context;
	}

	/**
	 * Registers and adds menus to context
	 *
	 * @param array $context Timber context.
	 *
	 * @return array
	 */
	public function add_menus_to_context( array $context ) {
		$context['header_menu'] = new Menu( 'header_menu' );
		$context['footer_menu'] = new Menu( 'footer_menu' );
		return $context;
	}

	/**
	 * Register nav menus
	 *
	 * @return void
	 */
	public function register_menus() {
		register_nav_menus(
			array(
				'header_menu' => 'Navigation Header Menu',
				'footer_menu' => 'Navigation Footer Menu',
			)
		);
	}
}
