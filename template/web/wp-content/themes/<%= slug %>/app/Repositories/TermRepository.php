<?php
/**
 * Repository entity for retrieving post type objects.
 *
 * @package Studiometa
 */

namespace Studiometa\Repositories;

use Timber\TermGetter;

/** Class */
final class TermRepository extends Repository {
	const CLASS_TYPE = '\Timber\Term';

	/**
	 * Set what the Query will return
	 *
	 * @param array  $params     Query params.
	 * @param string $class_type Class type for the query to return.
	 * @return Timber\Term
	 */
	public function do_query( $params, $class_type ) {
		return TermGetter::get_terms( $params, array(), self::CLASS_TYPE );
	}

	/**
	 * Returns a list of top level terms
	 *
	 * @param string|array $taxonomy Slug.
	 * @param array        $exclude  IDs of posts to exclude.
	 * @param int          $limit    Number of maximum results.
	 *
	 * @return Repository
	 */
	public function top_level_terms( $taxonomy, $exclude = array(), $limit = 100 ) {
		// Set sane defaults so we don't do full table scans.
		if ( $limit <= 0 || $limit > 100 ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
			trigger_error( __CLASS__ . ' ' . __FUNCTION__ . ' : $limit parameter should not be over 100 to avoid full sql table scans', E_USER_WARNING );
			$limit = 100;
		}

		$params = array(
			'taxonomy' => $taxonomy,
			'parent'   => 0, // Only get top level taxonomies.
			'limit'    => $limit,
		);

		if ( count( $exclude ) > 0 ) {
			$params['exclude'] = $exclude;
		}

		return $this->query( $params, self::CLASS_TYPE );
	}
}
