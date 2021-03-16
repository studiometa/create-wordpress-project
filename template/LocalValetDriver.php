<?php
/**
 * For easier configuration when using Valet to serve local vhosts
 * LocalValetDriver.php file extending the default WordPressValerDriver
 * to serve the content of the web/ directory
 *
 * @see https://laravel.com/docs/8.x/valet#custom-valet-drivers
 */
class LocalValetDriver extends WordPressValetDriver {
	/**
	 * Determine if the driver serves the request.
	 *
	 * @param  string  $sitePath
	 * @param  string  $siteName
	 * @param  string  $uri
	 * @return bool
	 */
	public function serves($sitePath, $siteName, $uri) {
		$sitePath .= '/web';
		return parent::serves($sitePath, $siteName, $uri);
	}

	/**
	 * isStaticFile determine if the incoming request is for a file that is "static"
	 *
	 * @param  string  $sitePath
	 * @param  string  $siteName
	 * @param  string  $uri
	 * @return bool
	 */
	public function isStaticFile($sitePath, $siteName, $uri) {
		$sitePath .= '/web';
		return parent::isStaticFile($sitePath, $siteName, $uri);
	}

	/**
	 * Get the fully resolved path to the application's front controller.
	 *
	 * @param  string  $sitePath
	 * @param  string  $siteName
	 * @param  string  $uri
	 * @return string
	 */
	public function frontControllerPath($sitePath, $siteName, $uri) {
		$sitePath .= '/web';
		return parent::frontControllerPath(
			$sitePath,
			$siteName,
			$this->forceTrailingSlash($uri)
		);
	}
}
