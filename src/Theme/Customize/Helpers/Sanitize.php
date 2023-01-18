<?php
/**
 * Backdrop Core ( Sanitize.php )
 *
 * @package   Backdrop
 * @author      Benjamin Lu ( benlumia007@gmail.com )
 * @copyright Copyright (C) 2019-2020. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Backdrop\Theme\Customize\Helpers;

/**
 * Register Menu Class
 */
class Sanitize {
	/**
	 * Loads choices for layouts
	 *
	 * @since 2.0.0
	 * @access public
	 * @param string $input
	 * @param $setting
	 * @return mixed|string
	 */
	public static function layouts( string $input, $setting ) {

		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	/**
	 * Santize checkbox
	 *
	 * @since 2.0.0
	 * @access public
	 * @param bool $value
	 * @return bool
	 */
	public static function checkbox( bool $value ): bool {

		return true === $value;
	}

	/**
	 * 1.0 - Customize ( Validations )
	 *
	 * @since  2.0.0
	 * @access public
	 * @param array $page_id output.
	 * @param array $setting output.
	 * @return void;
	 */
	public static function dropdown( array $page_id, array $setting ) {

		$page_id = absint( $page_id );
		return ( 'publish' === get_post_status( $page_id ) ? $page_id : $setting->default );
	}
}
