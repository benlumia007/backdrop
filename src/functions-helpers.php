<?php
/**
 * Backdrop Core ( src/Core/Framework.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @author    Benjamin Lu ( https://getbenonit.com )
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Benlumia007\Backdrop;

use Benlumia007\Backdrop\Proxies\App;

if ( ! function_exists( __NAMESPACE__ . '\\app' ) ) {
	/**
	 * The single instance of the app. Use this function for quickly working
	 * with data.  Returns an instance of the `\Hybrid\Core\Application`
	 * class. If the `$abstract` parameter is passed in, it'll resolve and
	 * return the value from the container.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  array   $params
	 * @return mixed
	 */
	function app( $abstract = '', $params = [] ) {
		return App::resolve( $abstract ?: 'app', $params );
	}
}

if ( ! function_exists( __NAMESPACE__ . '\\booted' ) ) {
	/**
	 * Conditional function for checking whether the application has been
	 * booted. Use before launching a new application. If booted, reference
	 * the `app()` instance directly.
	 *
	 * @since  6.0.0
	 * @access public
	 * @return bool
	 */
	function booted() {
		return defined( 'BACKDROP_BOOTED' ) && true === BACKDROP_BOOTED;
	}
}

if ( ! function_exists( __NAMESPACE__ . '\\path' ) ) {
	/**
	 * Returns the directory path of the framework. If a file is passed in,
	 * it'll be appended to the end of the path.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string  $file
	 * @return string
	 */
	function path( $file = '' ) {

		$file = ltrim( $file, '/' );

		return $file
		       ? App::resolve( 'path' ) . "/{$file}"
		       : App::resolve( 'path' );
	}
}

if ( ! function_exists( __NAMESPACE__ . '\\version' ) ) {
	/**
	 * Returns the framework version.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return string
	 */
	function version() {
		return App::resolve( 'version' );
	}
}