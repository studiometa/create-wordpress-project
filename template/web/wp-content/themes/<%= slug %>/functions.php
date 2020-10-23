<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

use Timber\Timber;
use Studiometa\Managers\ThemeManager;

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber\Timber' ) ) {
	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function( $template ) {
			die( 'Timber not activated.' );
		}
	);
	return;
}

$timber = new Timber();

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = true;

add_action(
	'after_setup_theme',
	function () {
		$managers = array(
			new \Studiometa\Managers\WordPressManager(),
			new \Studiometa\Managers\TwigManager(),
			new \Studiometa\Managers\AssetsManager(),
			new \Studiometa\Managers\CustomPostTypesManager(),
			new \Studiometa\Managers\TaxonomiesManager(),
		);

		<%_ if (acf) { _%>
		if ( function_exists( 'acf_add_local_field_group' ) ) {
			$managers[] = new \Studiometa\Managers\ACFManager();
		}
		<%_ } _%>

		$theme_manager = new ThemeManager( $managers );
		$theme_manager->run();
	}
);
