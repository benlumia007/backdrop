<?php // phpcs:ignore
/**
 * Backdrop Core ( Sanitize.php )
 *
 * @package     Backdrop Core
 * @copyright   Copyright (C) 2019-2020. Benjamin Lu
 * @license     GNU General PUblic License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author      Benjamin Lu ( https://benjlu.com )
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Helpers;

/**
 * Regiser Menu Class
 */
class Sanitize {
	/**
	 * Loads choices for layouts
	 *
	 * @since 3.0.0
	 * @access public
	 * @param string $input     String containing a layout string.
	 * @param mixed  $settings  Object containing info about settings/controls that's being sanitized.
	 */
	public static function layouts( $input, $setting ) {
		$choices = $setting->manager->get_control( $setting->id )->choices;

		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	/**
	 * Santize checkbox
	 *
	 * @since 3.0.0
	 * @access public
	 * @param boolean $value true or false.
	 */
	public static function checkbox( $value ) {
		return( ( isset( $value ) && true === $value ) ? true : false );
	}

	/**
	 * 1.0 - Customize ( Validations )
	 *
	 * @param array $page_id output.
	 * @param array $setting output.
	 */
	public static function dropdown( $page_id, $setting ) {
		$page_id = absint( $page_id );
		return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );
	}
}
