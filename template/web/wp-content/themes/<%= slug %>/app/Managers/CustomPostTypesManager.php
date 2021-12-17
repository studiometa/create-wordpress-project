<?php
/**
 * Bootstrap the custom post types.
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

use Studiometa\Managers\ManagerInterface;

/** Class **/
class CustomPostTypesManager implements ManagerInterface {
	/**
	 * {@inheritdoc}
	 */
	public function run() {
		add_action( 'init', array( $this, 'register_custom_post_types' ), 1 );
		add_filter( 'Timber\PostClassMap', array( $this, 'set_timber_classmap' ) );
	}

	/**
	 * Register custom post types.
	 *
	 * @todo use Studiometa\WP_Factory
	 * @return void
	 */
	public function register_custom_post_types() {

	}

	/**
	 * Set the class map for Timber instantiation of posts.
	 *
	 * @param string $post_class The default post class.
	 * @return array The project's class map.
	 */
	public function set_timber_classmap( string $post_class ): array {
		$post_types = get_post_types();
		$class_map = array();
		$exclude_post_types = array(
			'attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset', 'oembed_cache',
			'user_request', 'wp_block', 'wp_template', 'acf-field-group', 'acf-field'
		);

		foreach ($post_types as $key => $post_type) {
			// Do not change the class_map of $exclude_post_types.
			if ( in_array($post_type, $exclude_post_types, true) ) {
				continue;
			}

			$class_map[$post_type] = "\Studiometa\Models\\" . ucfirst($post_type);
		}
		return $class_map;
	}
}
