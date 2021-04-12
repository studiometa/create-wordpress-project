<?php
/**
 * Bootstraps Transients related functions
 *
 * @package Studiometa
 */
namespace Studiometa\Managers;

use Studiometa\Managers\ManagerInterface;
use Studiometa\WPToolkit\TransientCleaner;
use Symfony\Component\Yaml\Yaml;

/** Class */
class TransientsManager implements ManagerInterface {
	// phpcs:ignore Generic.Commenting.DocComment.MissingShort
	/** @var string Transients cleaner configuration filepath */
	private $cleaner_config_filepath;

	/**
	 * Construct.
	 */
	public function __construct() {
		$this->cleaner_config_filepath = sprintf( '%s/config/transients_cleaner.yml', get_template_directory() );
	}

	/**
	 * Runs initialization tasks.
	 * - Initiliaze transients cleaner tool.
	 *
	 * @see https://github.com/studiometa/wp-toolkit/tree/master#transient-cleaner
	 *
	 * @return void
	 */
	public function run() {
		if ( file_exists( $this->cleaner_config_filepath ) ) {
			TransientCleaner::get_instance( Yaml::parseFile( $this->cleaner_config_filepath ) );
		}
	}
}
