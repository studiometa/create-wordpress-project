<?php

/**
 * Interface.
 */
interface RepositoryInterface {
	/**
	 * Get all results.
	 *
	 * @return array|\ArrayObject
	 */
	public function get();

	/**
	 * Get the first result.
	 *
	 * @return mixed
	 */
	public function first();

	/**
	 * Get the last result.
	 *
	 * @return mixed
	 */
	public function last();
}

/**
 * Class.
 */
abstract class AbstractRepository implements RepositoryInterface {
	/**
	 * The parameters.
	 *
	 * @var mixed
	 */
	protected $params;

	/**
	 * Execute the query to get the results.
	 *
	 * @return mixed The query results.
	 */
	abstract protected function query();

	/**
	 * {@inheritdoc}
	 */
	public function get() {
		return $this->query();
	}

	/**
	 * {@inheritdoc}
	 */
	public function first() {
		$results = $this->get();
		return $results[ array_key_first( $results ) ];
	}

	/**
	 * {@inheritdoc}
	 */
	public function last() {
		$results = $this->get();
		return $results[ array_key_last( $results ) ];
	}
}

/**
 * Transient cache repository trait.
 */
trait TransientCacheRepositoryTrait {
	/**
	 * Transient TTL.
	 *
	 * @var integer
	 */
	protected $transient_ttl = 1000;

	/**
	 * Implement the repository get method with transient cache.
	 *
	 * @return mixed
	 */
	public function get() {
		$cache_key      = __FUNCTION__ . md5( http_build_query( $this->params ) );
		$cached_results = get_transient( $cache_key );

		if ( $cached_results ) {
			return $cached_results;
		}

		$results = $this->query();
		set_transient( $cache_key, $results, $this->transient_ttl );

		return $results;
	}
}

/**
 * Object cache repository trait.
 */
trait ObjectCacheRepositoryTrait {
	/**
	 * Implement the repository get method with WP object cache.
	 *
	 * @return mixed
	 */
	public function get() {
		$cache_key      = __FUNCTION__ . md5( http_build_query( $this->params ) );
		$cached_results = wp_cache_get( $cache_key, __CLASS__ );

		if ( false !== $cached_results && count( $cached_results ) > 0 ) {
			return $cached_results;
		}

		$results = $this->query();

		if ( count( $results ) > 0 ) {
			wp_cache_set( $cache_key, $results, __CLASS__ );
		}

		return $results;
	}
}

/**
 * Post repository trait.
 */
trait PostRepositoryTrait {
	/**
	 * Define the post type to query.
	 *
	 * @var array
	 */
	protected $post_types = array( 'post' );

	/**
	 * The class to use to instantiate posts.
	 *
	 * @var string
	 */
	protected $class_type = '\Studiometa\Models\Post';

	/**
	 * Query posts with Timber's PostQuery helper class.
	 *
	 * @return PostQuery
	 */
	protected function query() {
		return new \Timber\PostQuery( $this->params, $this->class_type );
	}

	/**
	 * {@inheritdoc}
	 */
	public function first() {
		$this->params['limit'] = '1';
		return $this->get();
	}

	/**
	 * {@inheritdoc}
	 */
	public function last() {
		$this->params['limit'] = '1';
		$this->params['order'] = 'ASC';
		return $this->get();
	}

	/**
	 * Returns a chronological list of latest posts across all *public* post types.
	 * This acts as a "firehose" of new content so to speak.
	 *
	 * @param integer $limit      Number of posts to return.
	 * @param array   $exclude    IDs of posts to exclude.
	 * @param integer $paged      Enable pagination.
	 *
	 * @return $this
	 */
	public function latest_posts( $limit = 10, array $exclude = array(), $paged = 0 ) {

		// Set sane defaults so we don't do full table scans.
		if ( $limit <= 0 || $limit > 100 ) {
			// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_trigger_error
			trigger_error( __CLASS__ . ' ' . __FUNCTION__ . ' : $limit parameter should not be over 100 to avoid full sql table scans', E_USER_WARNING );
			$limit = 100;
		}

		$this->params = array(
			'posts_per_page' => (int) $limit,
			'post_type'      => $this->post_types,
			'post_status'    => 'publish',
			'orderby'        => 'date',
			'order'          => 'DESC',
		);

		if ( count( $exclude ) > 0 ) {
			$this->params['post__not_in'] = $exclude;
		}

		if ( (int) $paged > 0 ) {
			$this->params['paged'] = $paged;
		}

		return $this;
	}
}


class PostRepository extends AbstractRepository {
	use ObjectCacheRepositoryTrait;
	use PostRepositoryTrait;
}

class CustomPostTypeRepository extends AbstractRepository {
	use ObjectCacheRepositoryTrait;
	use PostRepositoryTrait;

	/**
	 * {@inheritdoc}
	 *
	 * @var string
	 */
	protected $class_type = '\Studiometa\Models\CustomPostType';

	/**
	 * {@inheritdoc}
	 *
	 * @var array
	 */
	protected $post_types = array( 'custom_post_type' );
}


/**
 * Class.
 */
class ExternalDataRepository extends AbstractRepository {
	use TransientCacheRepositoryTrait;

	/**
	 * Endpoint where to fetch the jobs from.
	 *
	 * @var string
	 */
	private $endpoint = 'https://www.google.com';

	/**
	 * Query jobs remotely.
	 *
	 * @return array
	 */
	protected function query() {
		$response = wp_remote_get( $this->endpoint );

		if ( ! is_wp_error( $response ) ) {
			return $response['body'];
		} else {
			return array();
		}
	}

	/**
	 * Fetch latest jobs.
	 *
	 * @param  int $limit The max number of jobs to fetch.
	 * @param  int $paged The page to fetch.
	 * @return $this
	 */
	public function latest( int $limit = 100, int $paged = 0 ) {
		$this->params = array(
			'limit' => $limit,
			'paged' => $paged,
		);
		return $this;
	}
}

$external_data_repository = new ExternalDataRepository();
$external_data            = $external_data_repository->latest()->get();
