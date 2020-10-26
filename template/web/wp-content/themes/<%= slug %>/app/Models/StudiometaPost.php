<?php
/**
 * Additional functionality for extending the TimberPost object.
 *
 * @package Studiometa
 */

namespace Studiometa\Models;

use Timber\Post;

/** Class */
class StudiometaPost extends Post {
	/**
	 * Example Dummy Function
	 *
	 * @return array
	 */
	public function get_related_posts_id() {
		return array( 1, 2, 3 );
	}
}
