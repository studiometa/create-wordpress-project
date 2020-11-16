<?php
/**
 * Repository entity for retrieving post type objects.
 *
 * @package Studiometa
 */

namespace Studiometa\Repositories;

use Timber\TermGetter;

/** Class */
class TermRepository extends Repository {
	/**
	 * @inheritDoc
	 */
	public function do_query( $params, $class_type ) {
		return TermGetter::get_terms( $params, '\Timber\Term' );
	}

	/**
	 * Returns a list of top level terms
	 *
	 * @param string|array $taxonomy Slug.
	 * @param int          $limit    Number to return.
	 * @param array        $exclude  IDs of posts to exclude.
	 *
	 * @return Repository
	 */
	public function top_level_terms( $taxonomy, $limit = 10, $exclude = array() ) {
		$params = array(
			'taxonomy'    => $taxonomy,
			'parent'      => 0, // Only get top level taxonomies.
			'limit'       => $limit,
		);

		if ( count( $exclude ) > 0 ) {
			$params['exclude'] = $exclude;
		}

		return $this->query( $params );
	}
}
