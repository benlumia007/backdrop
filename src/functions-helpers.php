<?php
/**
 * Backdrop Core ( src/Core/Framework.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @author    Benjamin Lu ( https://getbenonit.com )
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop;

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