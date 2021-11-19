<?php
/**
 * Parent repository class. Provides a very basic, fluent interface for interacting
 * with PostCollection/PostQuery classes.
 *
 * @package Studiometa
 */

namespace Studiometa\Repositories;

use Timber\PostCollection;

/** Class */
abstract class Repository {
	/**
	 * List of posts.
	 *
	 * @var array|PostCollection
	 */
	private $result_set = array();

	/**
	 * Returns a list or collection of posts.
	 *
	 * @return array|PostCollection
	 */
	public function get() {
		return $this->result_set;
	}

	/**
	 * Returns the first item in a collection. Returns null if there are 0 items in
	 * the collection.
	 *
	 * @return mixed
	 */
	public function first() {
		$local_array = $this->get();
		return isset( $local_array[0] ) ? $local_array[0] : null;
	}

	/**
	 * Returns a slice of the collection starting at the given index.
	 * Similar to Laravel's slice().
	 *
	 * @param int $start Start index.
	 *
	 * @return array
	 */
	public function slice( $start ) {
		$local_array = $this->get();

		if ( count( $local_array ) < 1 ) {
			return array();
		}

		if ( is_object( $local_array ) && $local_array instanceof PostCollection ) {
			$local_array = $local_array->getArrayCopy();
		}

		return array_slice( $local_array, (int) $start );
	}

	/**
	 * Runs a query.
	 *
	 * @param array $params Query params.
	 *
	 * @return Repository
	 */
	protected function query( array $params ) {
		// Clear old result sets.
		$this->reset();

		$cache_key      = __FUNCTION__ . md5( http_build_query( $params ) );
		$cached_results = wp_cache_get( $cache_key, __CLASS__ );

		if ( false !== $cached_results && count( $cached_results ) > 0 ) {
			// Use cached results.
			return $this->result_set( $cached_results );
		}

		$results = $this->do_query( $params );

		// Cache our results.
		if ( count( $results ) > 0 ) {
			wp_cache_set( $cache_key, $results, __CLASS__ );
		}

		return $this->result_set( $results );
	}

	/**
	 * Function to implement when extendding the Repository.
	 *
	 * Define the query the Repository will run.
	 *
	 * @param array $params Query params.
	 * @return mixed
	 */
	abstract protected function do_query( $params );

	/**
	 * Clears the current result set.
	 *
	 * @return Repository
	 */
	protected function reset() {
		$this->result_set = array();
		return $this;
	}

	/**
	 * Returns current result set
	 *
	 * @param array|PostCollection $result_set Result set.
	 *
	 * @return Repository
	 */
	protected function result_set( $result_set = array() ) {
		$this->result_set = $result_set;
		return $this;
	}

}
