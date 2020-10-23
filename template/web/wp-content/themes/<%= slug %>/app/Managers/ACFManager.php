<?php
/**
 * Boostrap ACF
 *
 * @package Studiometa
 */

namespace Studiometa\Managers;

/** Class **/
class ACFManager {
	/**
	 * Runs initialization tasks.
	 *
	 * @return void
	 */
	public function run() {
		add_action( 'acf/init', array( $this, 'register_acf_default_group' ) );
		add_action( 'acf/init', array( $this, 'register_acf_example_group' ) );
	}

	/**
	 * Register acf default field group
	 *
	 * Containing fields to use as clone to avoid
	 * overloading the database with fields references
	 *
	 * @link https://www.advancedcustomfields.com/resources/register-fields-via-php/
	 * @return void
	 */
	public function register_acf_default_group() {
		acf_add_local_field_group(
			array(
				'key'    => 'group_studiometa_default_group',
				'title'  => 'Default fields to use as clone',
				'fields' => array(
					array(
						'key'   => 'field_content',
						'label' => 'Content',
						'name'  => 'content',
						'type'  => 'wysiwyg',
					),
				),
			)
		);
	}

	/**
	 * Register acf example field group
	 * Using the content field from the default group
	 *
	 * @return void
	 */
	public function register_acf_example_group() {
		acf_add_local_field_group(
			array(
				'key'      => 'group_studiometa_example_group',
				'title'    => 'Custom Fields for Posts',
				'fields'   => array(
					array(
						// key is unique and should not be the same as the default field.
						'key'   => 'field_post_content',
						'label' => 'Content',
						'name'  => 'content',
						'type'  => 'clone',
						'clone' => array(
							// Use the default field key.
							'field_content',
						),
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'post',
						),
					),
				),
			)
		);
	}
}
