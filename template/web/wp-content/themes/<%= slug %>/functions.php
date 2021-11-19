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
<%_ if (acf) { _%>
use Studiometa\Managers\ACFManager;
<%_ } _%>
use Studiometa\Managers\CustomPostTypesManager;
use Studiometa\Managers\ManagerFactory;
use Studiometa\Managers\TaxonomiesManager;
use Studiometa\Managers\ThemeManager;
use Studiometa\Managers\TinyMCEManager;
use Studiometa\Managers\TwigManager;
use Studiometa\Managers\WordPressManager;
use Studiometa\WPToolkit\Managers\AssetsManager;
use Studiometa\WPToolkit\Managers\CleanupManager;

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
			new ThemeManager(),
			new WordPressManager(),
			new TwigManager(),
			new AssetsManager(),
			new CleanupManager(),
			new CustomPostTypesManager(),
			new TaxonomiesManager(),
			new TinyMCEManager(),
			<%_ if (acf) { _%>
			new ACFManager(),
			<%_ } _%>
		);

		ManagerFactory::init( $managers );
	}
);
