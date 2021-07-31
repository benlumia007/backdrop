<?php
/**
 * Backdrop Core ( Contracts\View\Engine.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   GNU General PUblic License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Contracts\View;

/**
 * View interface.
 *
 * @since  2.0.0
 * @access public
 */
interface Engine {

	/**
	 * Returns a View object.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string            $name
	 * @param  array|string      $slugs
	 * @return View
	 */
	public function view( $name, $slugs = [] );

	/**
	 * Outputs a view template.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string            $name
	 * @param  array|string      $slugs
	 * @return void
	 */
	public function display( $name, $slugs = [] );

	/**
	 * Returns a view template as a string.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string            $name
	 * @param  array|string      $slugs
	 * @return string
	 */
	function render( $name, $slugs = [] );
}