<?php
/**
 * Abstract repository class.
 *
 * @package Studiometa
 * @subpackage Repositories
 */

namespace Studiometa\Repositories;

use ArrayObject;

/** Class */
abstract class AbstractRepository {
	/**
	 * List of results.
	 *
	 * @var array|ArrayObject<int, mixed>
	 */
	private $results = array();

	/**
	 * Returns the results.
	 *
	 * @return array|ArrayObject<int, mixed>
	 */
	public function get() {
		return $this->results;
	}

	/**
	 * Set the results.
	 *
	 * @param array|ArrayObject<int, mixed> $results The results to set.
	 * @return $this
	 */
	private function set( $results ) {
		$this->results = $results;
		return $this;
	}

	/**
	 * Returns the first item in a collection. Returns null if there are 0 items in
	 * the collection.
	 *
	 * @return mixed|null
	 */
	public function first() {
		$array = (array) $this->get();
		return $array[ array_key_first( $array ) ] ?? null;
	}

	/**
	 * Get the last item in a collection, null if the collection is empty.
	 *
	 * @return mixed|null
	 */
	public function last() {
		$array = (array) $this->get();
		return $array[ array_key_last( $array ) ] ?? null;
	}

	/**
	 * Runs a query.
	 *
	 * @param array $params Query params.
	 *
	 * @return $this
	 */
	protected function query( array $params ) {
		// Clear old result sets.
		$this->reset();

		$cache_key      = __FUNCTION__ . md5( http_build_query( $params ) );
		$cached_results = wp_cache_get( $cache_key, __CLASS__ );

		if ( false !== $cached_results && count( $cached_results ) > 0 ) {
			// Use cached results.
			return $this->set( $cached_results );
		}

		$results = $this->do_query( $params );

		// Cache our results.
		if ( count( $results ) > 0 ) {
			wp_cache_set( $cache_key, $results, __CLASS__ );
		}

		return $this->set( $results );
	}

	/**
	 * Function to implement when extendding the Repository.
	 *
	 * Define the query the Repository will run.
	 *
	 * @param array $params Query params.
	 * @return mixed
	 *
	 * @example ./app/Repositories/PostRepository.php How to implement do_query().
	 */
	abstract protected function do_query( $params );

	/**
	 * Clears the current result set.
	 *
	 * @return $this
	 */
	protected function reset() {
		$this->set( array() );
		return $this;
	}
}
